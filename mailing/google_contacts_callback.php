<?php
putenv('GOOGLE_CONTACTS_DEBUG=1');
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.use_strict_mode', '1');
    session_set_cookie_params([
        'httponly' => true,
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'samesite' => 'Lax',
    ]);
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google_contacts.php';

// $debug = getenv('GOOGLE_CONTACTS_DEBUG') === '1';
$debugDetails = [];

try {
    header('Cache-Control: no-store');
    $config = google_contacts_config();
    $redirect = parse_url($config['redirectUri']);
    if (
        !is_array($redirect) || ($redirect['scheme'] ?? '') !== 'https'
        || empty($redirect['host']) || empty($redirect['path'])
        || isset($redirect['user']) || isset($redirect['pass'])
        || isset($redirect['query']) || isset($redirect['fragment'])
    ) {
        throw new RuntimeException('Google redirectUri moet een volledige HTTPS-callback-URL zonder query zijn.');
    }

    $callbackAuthority = $redirect['host']
        . (isset($redirect['port']) ? ':' . $redirect['port'] : '');
    $debugDetails = [
        'request_host' => $_SERVER['HTTP_HOST'] ?? '',
        'configured_callback_host' => $callbackAuthority,
        'configured_callback_path' => $redirect['path'],
        'session_active' => session_status() === PHP_SESSION_ACTIVE,
        'session_cookie_received' => isset($_COOKIE[session_name()]),
        'https_detected' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'session_cookie_path' => session_get_cookie_params()['path'],
        'session_cookie_domain' => session_get_cookie_params()['domain'],
        'session_cookie_secure' => session_get_cookie_params()['secure'],
    ];

    // Maak state pas aan op de host waar Google de browser terugstuurt.
    if (
        empty($_GET['code']) && empty($_GET['error'])
        && strcasecmp($_SERVER['HTTP_HOST'] ?? '', $callbackAuthority) !== 0
    ) {
        if ($debug) {
            error_log('Google Contacts OAuth canonical redirect: ' . json_encode($debugDetails));
        }
        header('Location: ' . $config['redirectUri']);
        exit;
    }
    if (session_status() !== PHP_SESSION_ACTIVE) {
        throw new RuntimeException('De PHP-sessie kon niet worden gestart.');
    }

    $provider = google_contacts_provider();
    if (empty($_GET['code']) && empty($_GET['error'])) {
        $authorizationUrl = google_contacts_authorization_url();
        if (!session_write_close()) {
            throw new RuntimeException('De Google OAuth-state kon niet in de PHP-sessie worden opgeslagen.');
        }
        if ($debug) {
            error_log('Google Contacts OAuth start: ' . json_encode($debugDetails + [
                'session_state_created' => !empty($_SESSION['google_contacts_oauth_state']),
                'session_write_completed' => true,
            ]));
        }
        header('Location: ' . $authorizationUrl);
        exit;
    }
    if (isset($_GET['error'])) {
        throw new RuntimeException('Google autorisatie is afgebroken.');
    }

    $callbackState = $_GET['state'] ?? '';
    $sessionState = $_SESSION['google_contacts_oauth_state'] ?? '';
    $cookieState = $_COOKIE['google_contacts_oauth_state'] ?? '';
    $matchesSession = is_string($callbackState) && is_string($sessionState)
        && $callbackState !== '' && $sessionState !== ''
        && hash_equals($sessionState, $callbackState);
    $matchesCookie = is_string($callbackState) && is_string($cookieState)
        && $callbackState !== '' && $cookieState !== ''
        && hash_equals($cookieState, $callbackState);

    $debugDetails += [
        'callback_has_state' => is_string($callbackState) && $callbackState !== '',
        'session_has_state' => is_string($sessionState) && $sessionState !== '',
        'cookie_has_state' => is_string($cookieState) && $cookieState !== '',
        'state_matches_session' => $matchesSession,
        'state_matches_cookie' => $matchesCookie,
    ];

    if (
        empty($_GET['code']) || (!$matchesSession && !$matchesCookie)
    ) {
        throw new RuntimeException('Ongeldige Google OAuth-state.');
    }

    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code'],
    ]);
    $_SESSION['google_contacts_token'] = $token->jsonSerialize();
    unset($_SESSION['google_contacts_oauth_state']);
    if (!session_write_close()) {
        throw new RuntimeException('Het Google Contacts-token kon niet in de PHP-sessie worden opgeslagen.');
    }
    setcookie('google_contacts_oauth_state', '', [
        'expires' => time() - 3600,
        'path' => '/mailing',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    header('Location: /mailing/mailing.php?google_contacts=connected');
    exit;
} catch (Throwable $exception) {
    error_log('Google Contacts OAuth mislukt (' . get_class($exception) . ')');
    if ($debug) {
        error_log('Google Contacts OAuth diagnostic: ' . json_encode($debugDetails));
    }
    http_response_code(500);
    header('Cache-Control: no-store');
    echo '<h1>Google Contacts koppelen mislukt</h1><p>' . htmlspecialchars(
        $exception->getMessage(),
        ENT_QUOTES,
        'UTF-8'
    ) . '</p>';
    echo '<p><a href="/mailing/google_contacts_callback.php">Start een nieuwe Google Contacts-koppeling</a>'
        . ' (gebruik niet opnieuw een oude terugkeerlink van Google).</p>';
    if ($debug) {
        echo '<h2>Veilige diagnose (geen statewaarden of tokens)</h2><pre>' . htmlspecialchars(
            json_encode($debugDetails, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
            ENT_QUOTES,
            'UTF-8'
        ) . '</pre><p>Diagnostiek inschakelen met de serverinstelling GOOGLE_CONTACTS_DEBUG=1.</p>';
    }
}