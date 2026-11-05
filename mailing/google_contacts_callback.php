<?php

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

$debug = getenv('GOOGLE_CONTACTS_DEBUG') === '1';
$debugDetails = [];

try {
    $provider = google_contacts_provider();
    if (empty($_GET['code']) && empty($_GET['error'])) {
        header('Location: ' . google_contacts_authorization_url());
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

    $debugDetails = [
        'callback_has_state' => is_string($callbackState) && $callbackState !== '',
        'session_has_state' => is_string($sessionState) && $sessionState !== '',
        'cookie_has_state' => is_string($cookieState) && $cookieState !== '',
        'state_matches_session' => $matchesSession,
        'state_matches_cookie' => $matchesCookie,
        'session_cookie_received' => isset($_COOKIE[session_name()]),
        'https_detected' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'session_cookie_path' => session_get_cookie_params()['path'],
    ];

    if (
        empty($_GET['code']) || (! $matchesSession && ! $matchesCookie)
    ) {
        if ($debug) {
            error_log('Google Contacts OAuth state diagnostic: ' . json_encode($debugDetails));
        }
        throw new RuntimeException('Ongeldige Google OAuth-state.');
    }

    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code'],
    ]);
    $_SESSION['google_contacts_token'] = $token->jsonSerialize();
    unset($_SESSION['google_contacts_oauth_state']);
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
    http_response_code(500);
    header('Cache-Control: no-store');
    echo '<h1>Google Contacts koppelen mislukt</h1><p>' . htmlspecialchars(
        $exception->getMessage(),
        ENT_QUOTES,
        'UTF-8'
    ) . '</p>';
    if ($debug) {
        echo '<h2>Veilige diagnose (geen statewaarden of tokens)</h2><pre>' . htmlspecialchars(
            json_encode($debugDetails, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
            ENT_QUOTES,
            'UTF-8'
        ) . '</pre><p>Diagnostiek inschakelen met de serverinstelling GOOGLE_CONTACTS_DEBUG=1.</p>';
    }
}
