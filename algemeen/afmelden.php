<?php
ini_set('display_errors', '0');
error_reporting(E_ALL);
header('Cache-Control: no-store');
header('Referrer-Policy: no-referrer');

require_once $_SERVER['DOCUMENT_ROOT'] . '/connections/connect_PDO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/mailing_afmelden.php';

$english = ($_GET['lang'] ?? '') === 'en';
$token = is_string($_GET['token'] ?? null) ? $_GET['token'] : '';
$method = $_SERVER['REQUEST_METHOD'] ?? '';
$validToken = preg_match('/\A[a-f0-9]{64}\z/', $token) === 1;
$oneClick = $method === 'POST' && ($_POST['List-Unsubscribe'] ?? '') === 'One-Click';
$confirmed = $method === 'POST' && ($_POST['confirm'] ?? '') === '1';

if (!$validToken || !in_array($method, ['GET', 'POST'], true) || ($method === 'POST' && !$oneClick && !$confirmed)) {
    http_response_code(400);
    exit($english ? 'Invalid unsubscribe request.' : 'Ongeldig afmeldverzoek.');
}

try {
    if ($method === 'POST') {
        if (!mailingAfmelden($db, $token)) {
            http_response_code(404);
            exit($english ? 'This unsubscribe link is invalid.' : 'Deze afmeldlink is ongeldig.');
        }
        if ($oneClick) {
            http_response_code(200);
            exit;
        }
        $message = $english ? 'You have been unsubscribed from future mailings.' : 'Je bent afgemeld voor toekomstige mailings.';
    } else {
        $stmt = $db->prepare('SELECT 1 FROM mailing_afmeldingen WHERE token = ?');
        $stmt->execute([$token]);
        if ($stmt->fetchColumn() === false) {
            http_response_code(404);
            exit($english ? 'This unsubscribe link is invalid.' : 'Deze afmeldlink is ongeldig.');
        }
        $message = $english ? 'Unsubscribe from all future mailings?' : 'Afmelden voor alle toekomstige mailings?';
    }
} catch (Throwable $exception) {
    error_log('Afmelden voor mailing mislukt: ' . $exception->getMessage());
    http_response_code(500);
    exit($english ? 'Unsubscribing failed. Please contact info@pellegrina.net.' : 'Afmelden is mislukt. Neem contact op met info@pellegrina.net.');
}
?>
<!doctype html>
<html lang="<?= $english ? 'en' : 'nl' ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $english ? 'Unsubscribe' : 'Afmelden' ?> - La Pellegrina</title>
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css">
</head>
<body class="afmeldpagina">
    <main class="adresformulier">
        <img src="/Images/Logos/LP_nieuw.png" alt="La Pellegrina" width="300" height="57" class="w3-image">
        <h1><?= $english ? 'Unsubscribe' : 'Afmelden' ?></h1>
        <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
        <?php if ($method === 'GET'): ?>
            <form method="post">
                <input type="hidden" name="confirm" value="1">
                <button type="submit" class="w3-btn w3-green"><?= $english ? 'Unsubscribe' : 'Afmelden' ?></button>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>
