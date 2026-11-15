<?php

require_once dirname(__DIR__) . '/includes/stemsoorten.php';

class Kint { public static $enabled_mode; }
class VoiceRegistrationStored extends RuntimeException {}
function d(...$values) {}
function quote($value, $type = 'text') { return "'" . addslashes((string)$value) . "'"; }
function safestrtotime($format, $date) { return (new DateTimeImmutable($date))->format($format); }
function validate($value, $type, $length) { return filter_var($value, FILTER_VALIDATE_EMAIL) !== false; }
function select_query($query, $index = 2) {
    if (str_starts_with($query, 'SELECT * FROM instr')) {
        return [
            ['id' => 112, 'nl' => 'traverso', 'en' => 'flute'],
            ['id' => 20, 'nl' => 'mezzosopraan', 'en' => 'mezzosoprano'],
            ['id' => 30, 'nl' => 'alt', 'en' => 'alto'],
        ];
    }
    if (str_starts_with($query, 'SELECT InschId')) return false;
    throw new RuntimeException('Unexpected fixture query: ' . $query);
}
function exec_query($query) {
    global $voiceWrites;
    $voiceWrites[] = $query;
    if (str_contains($query, 'INSERT INTO inschrijving ')) throw new VoiceRegistrationStored($query);
    return true;
}
function checkVoices($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}
function registerVoices($language, $selection, $withInstrument = true, $gender = 'V') {
    global $voiceRoot, $voiceWrites;
    $voiceWrites = [];
    $_GET = [];
    $_SERVER['DOCUMENT_ROOT'] = $voiceRoot;
    $_SERVER['PHP_SELF'] = "/{$language}/romantic/aanmelding.php";
    $_POST = array_fill_keys(['tussenvoegsels', 'telefoon', 'mobiel', 'dieet', 'publiciteit', 'naam_aanbrenger', 'publiciteit_tx', 'stukken_i', 'stukken_z', 'acc_wens'], '');
    $_POST += [
        'submit' => $language === 'NL' ? 'verzenden' : 'submit',
        'voornaam' => 'Test', 'achternaam' => 'Example', 'adres' => 'Test 1',
        'postcode' => '1234 AB', 'plaats' => 'Test', 'geboortedatum' => '2000-02-29',
        'geslacht' => $gender, 'email' => 'test@example.invalid', 'CursusId_FK' => '1',
        'zanger' => 'on', 'voorwaarden' => 'akkoord', 'AdresId' => 2,
        'DlnmrId' => 3, 'taal' => $language, 'instr' => ['112'], 'zangstem' => $selection,
    ];
    if (!$withInstrument) unset($_POST['instr']);
    $maximumleeftijd = 100;
    $minimumleeftijd = 18;
    $ID = $password = $mollie = null;
    $instrumentenlijst = '';
    $stored = false;
    ob_start();
    try {
        require dirname(__DIR__) . "/includes/aanmelding.{$language}.php";
    } catch (VoiceRegistrationStored $exception) {
        $stored = true;
    } finally {
        $html = ob_get_clean();
    }
    return ['stored' => $stored, 'selection' => $_POST['zangstem'], 'codes' => $stemsoorten, 'writes' => $voiceWrites, 'html' => $html];
}

set_error_handler(static function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

checkVoices(normaliseer_stemsoorten(['30', '20', '30']) === ['30', '20'], 'Multiple choices must be deduplicated without losing their order.');
checkVoices(normaliseer_stemsoorten('60,40') === ['60', '40'], 'Stored comma-separated choices must be supported.');
checkVoices(normaliseer_stemsoorten(20) === ['20'], 'Legacy single integer choices must be supported.');
checkVoices(normaliseer_stemsoorten('0') === [], 'Legacy empty voice choices must remain empty.');

$voiceRoot = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'pellegrina-voices-' . bin2hex(random_bytes(6));
mkdir($voiceRoot . DIRECTORY_SEPARATOR . 'includes', 0700, true);
$stub = $voiceRoot . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'mailfuncties.inc.php';
file_put_contents($stub, '<?php');
try {
    foreach (['NL', 'EN'] as $language) {
        foreach ([
            [['30', '20'], '30, 20'],
            [['60', '40'], '60, 40'],
            [['61', '40'], '61, 40'],
            [['21', '31', '40', '60'], '21, 31, 40, 60'],
            ['20', '20'],
            ['20, 30', '20, 30'],
        ] as [$input, $expected]) {
            $result = registerVoices($language, $input);
            checkVoices($result['stored'] && $result['selection'] === $expected, "{$language}: voice choices must be stored as a comma-separated list.");
            $sql = end($result['writes']);
            checkVoices(str_contains($sql, "'112, {$expected}'") && str_contains($sql, "'{$expected}'"), "{$language}: both instr and zangstem must retain every selected voice.");
        }
        foreach ([[], ['999'], [['20']]] as $invalid) {
            $result = registerVoices($language, $invalid);
            checkVoices(!$result['stored'] && $result['writes'] === [] && str_contains($result['html'], 'aanmeldingsprobleem'), "{$language}: missing or invalid voice choices must show an error without writing data.");
        }
        $result = registerVoices($language, ['60', '40'], false);
        $sql = end($result['writes']);
        checkVoices($result['stored'] && substr_count($sql, "'60, 40'") === 2, "{$language}: singers without an instrument must retain both voices in instr and zangstem.");
        $result = registerVoices($language, ['30'], true, 'X');
        checkVoices($result['stored'] && count(array_filter($result['writes'], static fn($sql) => str_contains($sql, "geslacht='X'"))) === 1, "{$language}: gender X must be accepted and stored.");
        echo "PASS: {$language} multiple voices, mixed solo/choir choices, legacy choices, and validation; no database or mail used.\n";
    }
} finally {
    unlink($stub);
    rmdir($voiceRoot . DIRECTORY_SEPARATOR . 'includes');
    rmdir($voiceRoot);
}
