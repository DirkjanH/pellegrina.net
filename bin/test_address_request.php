<?php

class AddressRequestStored extends RuntimeException {}

$mailTestMode = in_array('--mail', $argv, true);
if ($mailTestMode) {
    if (function_exists('mail')) {
        throw new RuntimeException('Run mail tests with -d disable_functions=mail to prevent real email delivery.');
    }
    function mail($to, $subject, $message, $headers) {
        global $capturedMail;
        $capturedMail = compact('to', 'subject', 'message', 'headers');
        throw new AddressRequestStored('Confirmation email captured without sending.');
    }
}

function select_query($query, $index = 2) {
    return false;
}

function GetSQLValueString($value, $type) {
    global $storedValues;
    $storedValues[] = $value;
    return "'" . str_replace("'", "''", $value) . "'";
}

function exec_query($query) {
    global $mailTestMode;
    if ($mailTestMode) return true;
    throw new AddressRequestStored($query);
}

function addressRequest($language, array $post) {
    global $storedValues, $capturedMail;
    $storedValues = [];
    $capturedMail = null;
    $_POST = $post;
    $_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__);
    $_SERVER['PHP_SELF'] = "/{$language}/adres_toevoegen.php";
    unset($_SERVER['QUERY_STRING']);
    $level = ob_get_level();
    $stored = false;
    $html = '';
    ob_start();
    try {
        require dirname(__DIR__) . "/{$language}/adres_toevoegen.php";
    } catch (AddressRequestStored $exception) {
        $stored = true;
    } finally {
        while (ob_get_level() > $level) {
            $html = ob_get_clean() . $html;
        }
    }
    return ['stored' => $stored, 'html' => $html, 'values' => $storedValues, 'mail' => $capturedMail];
}

function checkAddressRequest($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}

set_error_handler(static function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

$complete = [
    'MM_insert' => 'info-aanvraag', 'actie' => 'alles',
    'voornaam' => 'Test', 'achternaam' => 'Example', 'email' => 'test@example.invalid',
    'instrstem' => 'Violin', 'adres' => 'Test street 1', 'postcode' => '1234 AB',
    'plaats' => 'Test city', 'land' => 'Netherlands', 'telefoon' => '+31 6 12345678',
    'geboortedatum' => '29-02-2000',
];

if ($mailTestMode) {
    foreach (['NL' => ['toevoegen', 'updaten', 'activiteiten'], 'EN' => ['adding', 'updating', 'activities']] as $language => [$adding, $updating, $activities]) {
        foreach (['alles' => $adding, 'email' => $updating] as $action => $verb) {
            $result = addressRequest($language, array_merge($complete, ['actie' => $action]));
            $mail = $result['mail'];
            checkAddressRequest($mail !== null && $mail['to'] === $complete['email'], "{$language}: confirmation must be addressed to the applicant.");
            checkAddressRequest(str_contains($mail['message'], $verb), "{$language}: {$action} confirmation uses the wrong action.");
            checkAddressRequest(!str_contains($mail['message'], $action === 'alles' ? $updating : $adding), "{$language}: confirmation mixes adding and updating.");
            checkAddressRequest(str_contains($mail['message'], $activities) === ($action === 'alles'), "{$language}: only adding must confirm future activity updates.");
            $subjectAction = $language === 'NL' ? ($action === 'alles' ? 'toegevoegd' : 'bijgewerkt') : ($action === 'alles' ? 'added' : 'updated');
            checkAddressRequest(str_contains($mail['subject'], $subjectAction), "{$language}: subject must distinguish adding from updating.");
            checkAddressRequest(str_contains($mail['message'], $complete['email']), "{$language}: registered details must remain in the confirmation.");
        }
        echo "PASS: {$language} confirmation mail distinguishes adding and updating without sending mail.\n";
    }
    exit(0);
}

foreach (['NL', 'EN'] as $language) {
    $initial = addressRequest($language, []);
    libxml_use_internal_errors(true);
    $document = new DOMDocument();
    $document->loadHTML($initial['html']);
    libxml_clear_errors();
    libxml_use_internal_errors(false);
    $xpath = new DOMXPath($document);
    foreach (['voornaam', 'achternaam', 'email', 'adres', 'postcode', 'plaats', 'land', 'instrstem', 'telefoon', 'geboortedatum'] as $field) {
        checkAddressRequest($xpath->query("//input[@name='{$field}' and @required]")->length === 1, "{$language}: {$field} must be required in the form.");
        $invalid = array_merge($complete, [$field => '   ']);
        $result = addressRequest($language, $invalid);
        checkAddressRequest(!$result['stored'] && str_contains($result['html'], 'role="alert"'), "{$language}: missing {$field} must show errors without saving.");
    }
    checkAddressRequest($xpath->query("//input[@name='mobiel']")->length === 0, "{$language}: separate mobile field remains.");
    checkAddressRequest($xpath->query("//input[@name='telefoon' and @type='tel']")->length === 1, "{$language}: telephone input must use type tel.");
    checkAddressRequest($xpath->query("//div[@class='adresformulier-naam']/div[1]/select[@name='geslacht' and not(@required)]/option[@value='X']")->length === 1, "{$language}: optional gender selector with X must precede the first name.");
    checkAddressRequest($xpath->query("//input[@name='geslacht']")->length === 0, "{$language}: old gender radio buttons remain.");
    $result = addressRequest($language, array_merge($complete, ['geslacht' => 'X']));
    checkAddressRequest($result['stored'] && $result['values'][6] === 'X', "{$language}: gender X must be saved.");
    $result = addressRequest($language, array_merge($complete, ['geslacht' => 'X', 'email' => '']));
    checkAddressRequest(preg_match('/value="X"\s+selected/', $result['html']) === 1, "{$language}: selected gender must remain after a validation error.");

    foreach (['31-02-2000', '01-01-2999', 'not-a-date', "01-01-\0"] as $date) {
        $result = addressRequest($language, array_merge($complete, ['geboortedatum' => $date]));
        checkAddressRequest(!$result['stored'], "{$language}: invalid birthday accepted.");
    }
    $result = addressRequest($language, array_merge($complete, ['email' => 'test@@example.invalid']));
    checkAddressRequest(!$result['stored'], "{$language}: invalid email accepted.");
    $result = addressRequest($language, array_merge($complete, ['instrstem' => ['Violin']]));
    checkAddressRequest(!$result['stored'], "{$language}: array input must show a validation error.");

    $result = addressRequest($language, array_merge($complete, ['mobiel' => 'old mobile value']));
    checkAddressRequest($result['stored'], "{$language}: valid submission rejected.");
    checkAddressRequest($result['values'][4] === $language, "{$language}: wrong registration language.");
    checkAddressRequest($result['values'][11] === $complete['telefoon'] && $result['values'][12] === '', "{$language}: telephone must be saved once, without the removed mobile field.");

    $unsubscribe = array_intersect_key($complete, array_flip(['MM_insert', 'voornaam', 'achternaam', 'email']));
    $unsubscribe['actie'] = 'delete';
    checkAddressRequest(addressRequest($language, $unsubscribe)['stored'], "{$language}: unsubscribe must only require name and email.");
    unset($unsubscribe['email']);
    checkAddressRequest(!addressRequest($language, $unsubscribe)['stored'], "{$language}: unsubscribe must require email.");

    $result = addressRequest($language, array_merge($complete, ['adres' => '', 'opmerkingen' => '"><script>alert(1)</script>']));
    checkAddressRequest(str_contains($result['html'], '&lt;script&gt;alert(1)&lt;/script&gt;'), "{$language}: submitted values must be escaped when redisplayed.");
    echo "PASS: {$language} required fields, validation errors, optional fields, unsubscribe, and single telephone storage.\n";
}

$process = proc_open([PHP_BINARY, '-d', 'disable_functions=mail', __FILE__, '--mail'], [1 => STDOUT, 2 => STDERR], $pipes);
if (!is_resource($process)) throw new RuntimeException('Could not start isolated confirmation mail tests.');
exit(proc_close($process));
