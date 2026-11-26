<?php

$repository = dirname(__DIR__);
if (extension_loaded('xdebug') && !in_array($argv[1] ?? '', ['--run', '--request'], true)) {
    $process = proc_open([PHP_BINARY, '-d', 'xdebug.mode=off', __FILE__, '--run'], [1 => STDOUT, 2 => STDERR], $pipes);
    if (!is_resource($process)) throw new RuntimeException('Could not start unsubscribe tests.');
    exit(proc_close($process));
}
if (($argv[1] ?? '') === '--request') {
    $_SERVER['DOCUMENT_ROOT'] = $argv[2];
    $_SERVER['REQUEST_METHOD'] = $argv[3];
    $_GET = ['token' => $argv[4], 'lang' => $argv[5]];
    $_POST = $argv[6] === 'one-click' ? ['List-Unsubscribe' => 'One-Click']
        : ($argv[6] === 'confirm' ? ['confirm' => '1'] : []);
    register_shutdown_function(static function () {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/status', (string) (http_response_code() ?: 200));
    });
    require $repository . '/algemeen/afmelden.php';
    exit;
}

require $repository . '/vendor/autoload.php';
require $repository . '/includes/mailing_afmelden.php';
date_default_timezone_set('Europe/Amsterdam');

function checkUnsubscribe($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}

function requestUnsubscribe($root, $method, $token, $language = 'nl', $post = '') {
    $process = proc_open([PHP_BINARY, __FILE__, '--request', $root, $method, $token, $language, $post],
        [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);
    if (!is_resource($process)) throw new RuntimeException('Could not start unsubscribe request.');
    $output = stream_get_contents($pipes[1]);
    $errors = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $exit = proc_close($process);
    checkUnsubscribe($exit === 0, 'Unsubscribe request failed: ' . $errors);
    return [(int) file_get_contents($root . '/status'), $output];
}

$root = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'lp-unsubscribe-' . bin2hex(random_bytes(6));
mkdir($root);
mkdir($root . '/connections');
mkdir($root . '/includes');
mkdir($root . '/vendor');
file_put_contents($root . '/connections/connect_PDO.php', <<<'PHP'
<?php
$db = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->sqliteCreateFunction('GET_LOCK', static fn($name, $timeout) => 1);
$db->sqliteCreateFunction('RELEASE_LOCK', static fn($name) => 1);
$db->sqliteCreateFunction('UNIX_TIMESTAMP', static fn($date) => $date === null ? null : strtotime($date));
PHP);
file_put_contents($root . '/includes/functies.php',
    '<?php require ' . var_export($repository . '/includes/functies.php', true) . ';');
file_put_contents($root . '/includes/mailing_afmelden.php',
    '<?php require ' . var_export($repository . '/includes/mailing_afmelden.php', true) . ';');
file_put_contents($root . '/includes/mailing_verzenden.php',
    '<?php require ' . var_export($repository . '/includes/mailing_verzenden.php', true) . ';');
file_put_contents($root . '/afmelden.php',
    '<?php require ' . var_export($repository . '/algemeen/afmelden.php', true) . ';');
file_put_contents($root . '/send.php',
    '<?php require ' . var_export($repository . '/mailing/send mailing.php', true) . ';');
file_put_contents($root . '/statistiek_mailing.php',
    '<?php require ' . var_export($repository . '/mailing/statistiek_mailing.php', true) . ';');
file_put_contents($root . '/vendor/autoload.php', '<?php class Kint { public static $enabled_mode; } function d(...$args) {}');
file_put_contents($root . '/includes/includes2027.php', <<<'PHP'
<?php
session_start();
$db = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/db.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->sqliteCreateFunction('NOW', static fn() => '2026-01-01 00:00:00');
$db->sqliteCreateFunction('CONCAT', static fn($a, $b) => $a . $b);
$db->sqliteCreateFunction('GET_LOCK', static fn($name, $timeout) => 1);
$db->sqliteCreateFunction('RELEASE_LOCK', static fn($name) => 1);
PHP);
file_put_contents($root . '/includes/mailfuncties.inc.php', <<<'PHP'
<?php
class LPmailer {
    public $Timeout, $Subject, $Body, $AltBody, $ErrorInfo = '', $recipient, $headers = [];
    public function AddAddress($address, $name) { $this->recipient = $address; return true; }
    public function addCustomHeader($name, $value) { $this->headers[$name] = $value; return true; }
    public function Send() {
        if ($this->recipient === 'failure@example.org') { $this->ErrorInfo = 'SMTP test error'; return false; }
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/sent', json_encode([
            'recipient' => $this->recipient, 'body' => $this->Body, 'headers' => $this->headers,
        ]) . "\n", FILE_APPEND);
        return true;
    }
}
function LPmailingAfzender($mail, $from, $name) {}
function LPmailPlainText($mail, $html) { return strip_tags($html); }
PHP);

$server = null;
try {
    $db = new PDO('sqlite:' . $root . '/db.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->sqliteCreateFunction('GET_LOCK', static fn($name, $timeout) => 1);
    $db->sqliteCreateFunction('RELEASE_LOCK', static fn($name) => 1);
    $_SERVER['DOCUMENT_ROOT'] = $root;
    require $root . '/includes/mailfuncties.inc.php';
    require $repository . '/includes/mailing_verzenden.php';
    $db->exec('CREATE TABLE mailing_afmeldingen (email TEXT PRIMARY KEY, token TEXT NOT NULL UNIQUE, afgemeld_op TEXT)');
    $db->exec('CREATE TABLE mailing_adressen (mailadresId INTEGER PRIMARY KEY, mailingId_FK INTEGER, naam TEXT, voornaam TEXT, email TEXT, cursus TEXT, password TEXT, DlnmrId TEXT, kenmerk TEXT, tijd_verzonden TEXT, tijd_geopend TEXT)');
    $db->exec('CREATE TABLE mailing_opdrachten (mailingId INTEGER PRIMARY KEY, message TEXT, subject TEXT, `From` TEXT, FromName TEXT, CC TEXT, verzonden_mails INTEGER, tijd_aanmaak TEXT, log TEXT)');
    $db->exec('CREATE TABLE mailing_verzendtaken (mailing_id INTEGER PRIMARY KEY, status TEXT, volgende_poging TEXT, laatste_fout TEXT, bezig_adres INTEGER)');
    $db->exec("CREATE TABLE mailing_verzendklok (id INTEGER PRIMARY KEY, volgende_blok TEXT); INSERT INTO mailing_verzendklok VALUES (1, '2000-01-01 00:00:00')");
    $token = mailingAfmeldToken($db, ' First@Example.org ');
    $other = mailingAfmeldToken($db, 'other@example.org');
    checkUnsubscribe(strlen($token) === 64 && $token !== $other, 'Tokens must be random per address.');
    checkUnsubscribe(mailingAfmeldToken($db, 'first@example.org') === $token, 'Addresses must be normalized.');

    $html = '<p><a href="https://pellegrina.net/algemeen/afmelden.php?token={afmeldtoken}&amp;lang=en">Unsubscribe</a></p>';
    $html = Pelago\Emogrifier\CssInliner::fromHtml($html)->inlineCss('')->render();
    $encodedHtml = str_replace('{afmeldtoken}', '%7Bafmeldtoken%7D', $html);
    checkUnsubscribe(mailingHeeftAfmeldlink($encodedHtml), 'URL-encoded placeholders must be recognized.');
    checkUnsubscribe(str_contains(mailingAfmeldHeaders(new PHPMailer\PHPMailer\PHPMailer(), $encodedHtml, $token), 'token=' . $token),
        'URL-encoded placeholders must be replaced with a personal token.');
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->setFrom('info@pellegrina.net');
    $mail->addAddress('first@example.org');
    $mail->Subject = 'Test';
    $mail->Body = mailingAfmeldHeaders($mail, $html, $token);
    checkUnsubscribe(!str_contains($mail->Body, '{afmeldtoken}') && str_contains($mail->Body, $token), 'The personal link must survive HTML inlining.');
    checkUnsubscribe($mail->preSend(), 'The message must compile without sending.');
    $mime = $mail->getSentMIMEMessage();
    checkUnsubscribe(str_contains($mime, 'List-Unsubscribe: <https://pellegrina.net/algemeen/afmelden.php?token=' . $token . '>'), 'Missing one-click URL.');
    checkUnsubscribe(str_contains($mime, 'List-Unsubscribe-Post: List-Unsubscribe=One-Click'), 'Missing one-click POST header.');

    [$status, $page] = requestUnsubscribe($root, 'GET', $token, 'nl');
    checkUnsubscribe($status === 200 && str_contains($page, 'Afmelden voor alle toekomstige mailings?'), 'Dutch confirmation page is incorrect.');
    checkUnsubscribe(mailingAfmeldStatus($db, 'first@example.org')['afgemeld_op'] === null, 'GET must never unsubscribe.');
    [$status, $page] = requestUnsubscribe($root, 'GET', $token, 'en');
    checkUnsubscribe($status === 200 && str_contains($page, 'Unsubscribe from all future mailings?'), 'English confirmation page is incorrect.');
    [$status] = requestUnsubscribe($root, 'POST', $token);
    checkUnsubscribe($status === 400 && mailingAfmeldStatus($db, 'first@example.org')['afgemeld_op'] === null, 'A POST without confirmation must not unsubscribe.');
    [$status, $page] = requestUnsubscribe($root, 'POST', $token, 'en', 'confirm');
    checkUnsubscribe($status === 200 && str_contains($page, 'You have been unsubscribed'), 'Confirmation must unsubscribe.');
    checkUnsubscribe(mailingAfmeldStatus($db, 'first@example.org')['afgemeld_op'] !== null, 'Unsubscribe must persist.');
    [$status] = requestUnsubscribe($root, 'POST', $token, 'nl', 'one-click');
    checkUnsubscribe($status === 200, 'Repeat one-click requests must succeed.');
    [$status] = requestUnsubscribe($root, 'POST', $other, 'nl', 'one-click');
    checkUnsubscribe($status === 200 && mailingAfmeldStatus($db, 'other@example.org')['afgemeld_op'] !== null, 'One-click POST must persist.');
    [$status] = requestUnsubscribe($root, 'POST', str_repeat('a', 64), 'nl', 'one-click');
    checkUnsubscribe($status === 404, 'Unknown token must fail.');
    [$status] = requestUnsubscribe($root, 'POST', 'invalid', 'nl', 'one-click');
    checkUnsubscribe($status === 400, 'Invalid token must fail.');

    $httpToken = mailingAfmeldToken($db, 'http@example.org');
    $socket = stream_socket_server('tcp://127.0.0.1:0', $errno, $error);
    checkUnsubscribe($socket !== false, 'Could not reserve a local test port.');
    $port = (int) substr(strrchr(stream_socket_get_name($socket, false), ':'), 1);
    fclose($socket);
    $server = proc_open([PHP_BINARY, '-d', 'xdebug.mode=off', '-S', '127.0.0.1:' . $port, '-t', $root],
        [0 => ['pipe', 'r'], 1 => ['file', $root . '/server.log', 'a'], 2 => ['file', $root . '/server.log', 'a']], $pipes);
    checkUnsubscribe(is_resource($server), 'Could not start the local HTTP test server.');
    fclose($pipes[0]);
    $ready = false;
    for ($i = 0; $i < 50; $i++) {
        $connection = @stream_socket_client('tcp://127.0.0.1:' . $port, $errno, $error, 0.1);
        if ($connection !== false) {
            fclose($connection);
            $ready = true;
            break;
        }
        usleep(100000);
    }
    checkUnsubscribe($ready, 'Local HTTP test server did not start.');
    $url = 'http://127.0.0.1:' . $port . '/afmelden.php?token=' . $httpToken;
    $context = stream_context_create(['http' => [
        'method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'content' => 'List-Unsubscribe=One-Click', 'ignore_errors' => true,
    ]]);
    file_get_contents($url, false, $context);
    checkUnsubscribe(str_contains($http_response_header[0] ?? '', '200') && mailingAfmeldStatus($db, 'http@example.org')['afgemeld_op'] !== null,
        'Real HTTP one-click POST must unsubscribe without cookies.');

    $db->exec("INSERT INTO mailing_adressen (mailadresId, mailingId_FK, naam, voornaam, email, cursus, password, DlnmrId, kenmerk, tijd_verzonden) VALUES
        (1, 1, 'First', 'First', ' FIRST@EXAMPLE.ORG ', '', '', '', 'track1', NULL),
        (2, 1, 'Other', 'Other', 'other@example.org', '', '', '', 'track2', NULL),
        (3, 1, 'Allowed', 'Allowed', 'allowed@example.org', '', '', '', 'track3', NULL),
        (4, 1, 'Sent', 'Sent', 'sent@example.org', '', '', '', 'track4', '2026-01-01'),
        (5, 2, 'First', 'First', 'first@example.org', '', '', '', 'track5', NULL)");
    $status = mailingAfmeldVerzendStatus($db, 1);
    checkUnsubscribe((int) $status['totaal'] === 4 && (int) $status['resterend'] === 1, 'Unsubscribed recipients must be excluded from queued mailings.');
    checkUnsubscribe((int) mailingAfmeldVerzendStatus($db, 2)['resterend'] === 0, 'Unsubscribes must apply to other mailings too.');
    $stmt = $db->prepare('INSERT INTO mailing_opdrachten VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([1, $encodedHtml, 'Test', 'info@pellegrina.net', 'La Pellegrina', '', 1, '2026-01-01', '']);
    $legacyUrl = 'http://127.0.0.1:' . $port . '/send.php?mailing=1';
    $noRedirect = stream_context_create(['http' => ['follow_location' => 0, 'ignore_errors' => true]]);
    file_get_contents($legacyUrl, false, $noRedirect);
    checkUnsubscribe(str_contains($http_response_header[0] ?? '', '302')
        && in_array('Location: statistiek_mailing.php?mailing=1', $http_response_header, true)
        && !file_exists($root . '/sent'), 'Old links must redirect to statistics without starting a mailing.');
    $legacyPost = stream_context_create(['http' => ['method' => 'POST', 'ignore_errors' => true]]);
    file_get_contents($legacyUrl, false, $legacyPost);
    checkUnsubscribe(str_contains($http_response_header[0] ?? '', '405'), 'Old POST requests must not execute mailing actions.');
    $sendUrl = 'http://127.0.0.1:' . $port . '/statistiek_mailing.php?mailing=1';
    $form = file_get_contents($sendUrl);
    checkUnsubscribe(str_contains($form, 'Mailing starten') && str_contains($form, 'aantal emails = 4'), 'Statistics must show mailing controls and progress.');
    checkUnsubscribe(str_contains($form, 'href="mailing.php"') && str_contains($form, 'Mailing opstellen'), 'Statistics must link to the mailing editor.');
    checkUnsubscribe(preg_match('/name="csrf_token"\s+value="([^"]+)"/', $form, $csrf) === 1, 'Mailing confirmation token missing.');
    $cookie = '';
    foreach ($http_response_header as $header) {
        if (stripos($header, 'Set-Cookie:') === 0) $cookie = trim(explode(';', substr($header, 11))[0]);
    }
    checkUnsubscribe($cookie !== '', 'Mailing session cookie missing.');
    $invalidContext = stream_context_create(['http' => [
        'method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\nCookie: {$cookie}\r\n",
        'content' => http_build_query(['csrf_token' => 'invalid', 'actie' => 'starten']), 'ignore_errors' => true,
    ]]);
    file_get_contents($sendUrl, false, $invalidContext);
    checkUnsubscribe(str_contains($http_response_header[0] ?? '', '403')
        && (int) $db->query('SELECT COUNT(*) FROM mailing_verzendtaken')->fetchColumn() === 0,
        'Invalid CSRF tokens must not queue a mailing.');
    $context = stream_context_create(['http' => [
        'method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\nCookie: {$cookie}\r\n",
        'content' => http_build_query(['csrf_token' => $csrf[1], 'actie' => 'starten']), 'ignore_errors' => true,
    ]]);
    $result = file_get_contents($sendUrl, false, $context);
    checkUnsubscribe(str_contains($result, 'staat in de wachtrij') && !file_exists($root . '/sent'), 'POST must queue without sending.');
    $page = new DOMDocument();
    $page->loadHTML('<?xml encoding="UTF-8">' . $result, LIBXML_NOERROR | LIBXML_NOWARNING);
    $xpath = new DOMXPath($page);
    checkUnsubscribe($xpath->query('//div[contains(concat(" ", normalize-space(@class), " "), " verzendkop ")]/h3')->length === 1
        && $xpath->query('//div[contains(concat(" ", normalize-space(@class), " "), " verzendkop ")]/form/button[@value="pauzeren"]')->length === 1,
        'The pause action must appear alongside the sending date.');
    $db->sqliteCreateFunction('GET_LOCK', static fn($name, $timeout) => 0);
    checkUnsubscribe(!mailingVerwerkWachtrij($db, static fn() => new LPmailer()) && !file_exists($root . '/sent'), 'A busy worker lock must prevent sending.');
    $db->sqliteCreateFunction('GET_LOCK', static fn($name, $timeout) => 1);
    checkUnsubscribe(mailingVerwerkWachtrij($db, static fn() => new LPmailer()), 'Worker did not process queued mailing.');
    $sent = array_map(static fn($line) => json_decode($line, true, 512, JSON_THROW_ON_ERROR), file($root . '/sent', FILE_IGNORE_NEW_LINES));
    checkUnsubscribe(count($sent) === 1 && $sent[0]['recipient'] === 'allowed@example.org', 'Mailing must send only to non-unsubscribed recipients.');
    checkUnsubscribe(isset($sent[0]['headers']['List-Unsubscribe-Post']) && !mailingHeeftAfmeldlink($sent[0]['body'])
        && preg_match('/token=[a-f0-9]{64}/', $sent[0]['body']) === 1, 'Mailing must include a personal one-click link.');
    checkUnsubscribe((int) mailingAfmeldVerzendStatus($db, 1)['resterend'] === 0, 'No sendable recipients should remain after the batch.');
    checkUnsubscribe($db->query('SELECT status FROM mailing_verzendtaken WHERE mailing_id = 1')->fetchColumn() === 'afgerond', 'Completed mailing must be marked complete.');

    $stmt->execute([3, $html, 'Blocks', 'info@pellegrina.net', 'La Pellegrina', '', 0, '2026-01-01', '']);
    $insert = $db->prepare('INSERT INTO mailing_adressen (mailingId_FK, naam, voornaam, email, cursus, password, DlnmrId, kenmerk) VALUES (3, ?, ?, ?, ?, ?, ?, ?)');
    for ($i = 0; $i < 41; $i++) {
        $insert->execute(['Name', 'Name', 'user' . $i . '@example.org', '', '', '', 'track']);
    }
    $resumeContext = stream_context_create(['http' => [
        'method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\nCookie: {$cookie}\r\n",
        'content' => http_build_query(['csrf_token' => $csrf[1], 'actie' => 'starten']), 'ignore_errors' => true,
    ]]);
    $resumeResult = file_get_contents('http://127.0.0.1:' . $port . '/statistiek_mailing.php?mailing=3', false, $resumeContext);
    checkUnsubscribe(str_contains($resumeResult, 'staat in de wachtrij'), 'A second mailing must be selectable and queueable from statistics.');
    checkUnsubscribe(!mailingVerwerkWachtrij($db, static fn() => new LPmailer()), 'The global pause must also apply to another mailing.');
    $db->exec("UPDATE mailing_verzendklok SET volgende_blok = '2000-01-01 00:00:00' WHERE id = 1");
    checkUnsubscribe(mailingVerwerkWachtrij($db, static fn() => new LPmailer()), 'First block was not processed.');
    checkUnsubscribe((int) mailingAfmeldVerzendStatus($db, 3)['resterend'] === 1, 'First block must send exactly 40 recipients.');
    checkUnsubscribe(!mailingVerwerkWachtrij($db, static fn() => new LPmailer()), 'The next block must wait 15 minutes.');
    $pauseContext = stream_context_create(['http' => [
        'method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\nCookie: {$cookie}\r\n",
        'content' => http_build_query(['csrf_token' => $csrf[1], 'actie' => 'pauzeren']), 'ignore_errors' => true,
    ]]);
    $pauseResult = file_get_contents('http://127.0.0.1:' . $port . '/statistiek_mailing.php?mailing=3', false, $pauseContext);
    checkUnsubscribe(str_contains($pauseResult, 'mailing is gepauzeerd'), 'A queued mailing must be pausable from the browser.');
    checkUnsubscribe($db->query('SELECT status FROM mailing_verzendtaken WHERE mailing_id = 3')->fetchColumn() === 'gepauzeerd', 'Pause must persist.');
    $resumeResult = file_get_contents('http://127.0.0.1:' . $port . '/statistiek_mailing.php?mailing=3', false, $resumeContext);
    checkUnsubscribe(str_contains($resumeResult, 'staat in de wachtrij'), 'A paused mailing must be resumable from statistics.');
    checkUnsubscribe(!mailingVerwerkWachtrij($db, static fn() => new LPmailer()), 'Requeueing must not bypass the delay.');
    $db->exec("UPDATE mailing_verzendtaken SET volgende_poging = '2000-01-01 00:00:00' WHERE mailing_id = 3");
    $db->exec("UPDATE mailing_verzendklok SET volgende_blok = '2000-01-01 00:00:00' WHERE id = 1");
    checkUnsubscribe(mailingVerwerkWachtrij($db, static fn() => new LPmailer()), 'Second block was not processed.');
    checkUnsubscribe((int) mailingAfmeldVerzendStatus($db, 3)['resterend'] === 0, 'The second block must resume with the remaining recipient.');

    $stmt->execute([4, $html, 'Failure', 'info@pellegrina.net', 'La Pellegrina', '', 0, '2026-01-01', '']);
    $db->exec("INSERT INTO mailing_adressen (mailingId_FK, naam, voornaam, email, cursus, password, DlnmrId, kenmerk) VALUES (4, 'Fail', 'Fail', 'failure@example.org', '', '', '', 'track')");
    mailingInWachtrij($db, 4);
    $db->exec("UPDATE mailing_verzendklok SET volgende_blok = '2000-01-01 00:00:00' WHERE id = 1");
    try {
        mailingVerwerkWachtrij($db, static fn() => new LPmailer());
        throw new RuntimeException('SMTP failure was not reported.');
    } catch (RuntimeException $exception) {
        checkUnsubscribe(str_contains($exception->getMessage(), 'SMTP test error'), 'Unexpected worker error.');
    }
    checkUnsubscribe($db->query('SELECT status FROM mailing_verzendtaken WHERE mailing_id = 4')->fetchColumn() === 'gestopt', 'A failed mailing must pause.');
    checkUnsubscribe(!mailingVerwerkWachtrij($db, static fn() => new LPmailer()), 'A paused mailing must not be retried automatically.');
    $failurePage = file_get_contents('http://127.0.0.1:' . $port . '/statistiek_mailing.php?mailing=4');
    $failurePage = preg_replace('/\s+/', ' ', $failurePage);
    checkUnsubscribe(str_contains($failurePage, 'failure@example.org')
        && str_contains($failurePage, 'Opnieuw proberen en hervatten')
        && str_contains($failurePage, 'Als verzonden registreren en hervatten'),
        'Statistics must show uncertain delivery and both resolution options.');
    try {
        mailingInWachtrij($db, 4);
        throw new RuntimeException('Uncertain mail was resumed without a decision.');
    } catch (RuntimeException $exception) {
        checkUnsubscribe(str_contains($exception->getMessage(), 'onzekere verzending'), 'Unexpected resume error.');
    }
    mailingLosOnzekereVerzendingOp($db, 4, false);
    checkUnsubscribe(!mailingVerwerkWachtrij($db, static fn() => new LPmailer()), 'Resuming a failed mailing must retain the delay.');
    $db->exec("UPDATE mailing_verzendtaken SET bezig_adres = (SELECT mailadresId FROM mailing_adressen WHERE mailingId_FK = 4), volgende_poging = '2000-01-01 00:00:00' WHERE mailing_id = 4");
    $db->exec("UPDATE mailing_verzendklok SET volgende_blok = '2000-01-01 00:00:00' WHERE id = 1");
    try {
        mailingVerwerkWachtrij($db, static fn() => new LPmailer());
        throw new RuntimeException('Interrupted delivery was retried without a decision.');
    } catch (RuntimeException $exception) {
        checkUnsubscribe(str_contains($exception->getMessage(), 'vorige verzending is onzeker'), 'Interrupted delivery was not detected.');
    }
    $resolveContext = stream_context_create(['http' => [
        'method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\nCookie: {$cookie}\r\n",
        'content' => http_build_query(['csrf_token' => $csrf[1], 'actie' => 'registreren']), 'ignore_errors' => true,
    ]]);
    $resolveResult = file_get_contents('http://127.0.0.1:' . $port . '/statistiek_mailing.php?mailing=4', false, $resolveContext);
    checkUnsubscribe(str_contains($resolveResult, 'staat in de wachtrij'), 'An administrator must be able to confirm an uncertain delivery.');
    checkUnsubscribe((int) mailingAfmeldVerzendStatus($db, 4)['resterend'] === 0, 'Confirmed delivery must be recorded before resumption.');
    $stmt->execute([5, $html, 'Empty', 'info@pellegrina.net', 'La Pellegrina', '', 0, '2026-01-01', '']);
    $emptyPage = file_get_contents('http://127.0.0.1:' . $port . '/statistiek_mailing.php?mailing=5');
    checkUnsubscribe(str_contains($emptyPage, 'Mailing starten') && str_contains($emptyPage, 'aantal emails = 0'),
        'Statistics must work before any recipients have been sent.');
    $deleteContext = stream_context_create(['http' => [
        'method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\nCookie: {$cookie}\r\n",
        'content' => http_build_query(['csrf_token' => $csrf[1], 'delete_mailing' => 5]), 'ignore_errors' => true,
    ]]);
    file_get_contents('http://127.0.0.1:' . $port . '/statistiek_mailing.php?mailing=5', false, $deleteContext);
    checkUnsubscribe((int) $db->query('SELECT COUNT(*) FROM mailing_opdrachten WHERE mailingId = 5')->fetchColumn() === 0,
        'Deleting a mailing from statistics must still work.');
    try {
        mailingAfmeldToken($db, 'first@example.org');
        throw new RuntimeException('Unsubscribed address was allowed to receive a token.');
    } catch (RuntimeException $exception) {
        checkUnsubscribe($exception->getMessage() === 'Dit adres is afgemeld.', 'Unexpected error for an unsubscribed address.');
    }
    echo "PASS: unsubscribe, queued mailing, batching, resumption and failure handling.\n";
} finally {
    if (is_resource($server)) {
        proc_terminate($server);
        proc_close($server);
    }
    unset($exception);
    $stmt = null;
    $insert = null;
    $db = null;
    gc_collect_cycles();
    foreach (['status', 'db.sqlite', 'server.log', 'sent', 'afmelden.php', 'send.php', 'statistiek_mailing.php', 'connections/connect_PDO.php', 'includes/functies.php', 'includes/mailing_afmelden.php', 'includes/mailing_verzenden.php', 'includes/includes2027.php', 'includes/mailfuncties.inc.php', 'vendor/autoload.php'] as $file) {
        $path = $root . '/' . $file;
        if (file_exists($path)) unlink($path);
    }
    rmdir($root . '/connections');
    rmdir($root . '/includes');
    rmdir($root . '/vendor');
    rmdir($root);
}
