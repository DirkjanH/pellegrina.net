<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google_contacts.php';

try {
    $provider = google_contacts_provider();
    if (empty($_GET['code']) && empty($_GET['error'])) {
        header('Location: ' . google_contacts_authorization_url());
        exit;
    }
    if (isset($_GET['error'])) {
        throw new RuntimeException('Google autorisatie is afgebroken.');
    }
    $expectedState = $_SESSION['google_contacts_oauth_state']
        ?? $_COOKIE['google_contacts_oauth_state']
        ?? '';
    if (
        empty($_GET['code']) || empty($_GET['state']) || $expectedState === ''
        || !hash_equals($expectedState, $_GET['state'])
    ) {
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
    echo '<h1>Google Contacts koppelen mislukt</h1><p>' . htmlspecialchars(
        $exception->getMessage(),
        ENT_QUOTES,
        'UTF-8'
    ) . '</p>';
}
