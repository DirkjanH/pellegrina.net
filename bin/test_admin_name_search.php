<?php

class Kint { public static $enabled_mode; }
function d(...$values) {}

function select_query($query) {
    global $fixture, $queries;
    $queries[] = $query;
    if (str_starts_with($query, 'SELECT DISTINCT DlnmrId')) return $fixture['rows'];
    if (str_contains($query, 'SELECT CursusId_FK')) return [];
    throw new RuntimeException('Unexpected fixture query: ' . $query);
}

if (($argv[1] ?? '') === '--request') {
    set_error_handler(static function ($severity, $message, $file, $line) {
        throw new ErrorException($message, 0, $severity, $file, $line);
    });
    $fixture = json_decode(stream_get_contents(STDIN), true, 512, JSON_THROW_ON_ERROR);
    $_POST = $fixture['post'];
    $_SESSION = $fixture['session'];
    $_REQUEST = $_POST;
    $_SERVER['PHP_SELF'] = $fixture['page'];
    $eerstecursus = 101;
    $laatstecursus = 102;
    $cursus_offset = 100;
    $aantal_cursussen = 2;
    $queries = [];
    ob_start();
    require dirname(__DIR__) . '/onderhoud/LP_zoeknaam.php';
    $html = ob_get_clean();
    echo json_encode(['html' => $html, 'session' => $_SESSION, 'queries' => $queries], JSON_THROW_ON_ERROR);
    exit;
}

function checkSearch($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}

function searchRequest($session, $post, $page, $rows) {
    $process = proc_open([PHP_BINARY, __FILE__, '--request'], [
        0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w'],
    ], $pipes);
    if (!is_resource($process)) throw new RuntimeException('Could not start name-search fixture.');
    fwrite($pipes[0], json_encode(compact('session', 'post', 'page', 'rows'), JSON_THROW_ON_ERROR));
    fclose($pipes[0]);
    $output = stream_get_contents($pipes[1]);
    $errors = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $status = proc_close($process);
    checkSearch($status === 0 && $errors === '', "Name-search fixture failed:\n" . $errors . $output);
    return json_decode($output, true, 512, JSON_THROW_ON_ERROR);
}

$rows = [['DlnmrId' => 501, 'naam' => 'Voorbeeld & Test']];
$post = ['zoek' => 'zoek', 'zoeknaam' => 'Voorbeeld & Test', 'oude_dlnrs' => '1', 'cursus' => 'alles', 'DlnmrId' => '501'];
$result = searchRequest([], $post, '/onderhoud/LP_persoonlijk.php', $rows);
checkSearch($result['session']['LP_zoeknaam']['oude_dlnrs'] === '1', 'Historical-participant search must be saved.');
checkSearch($result['session']['Inschr'] === $rows, 'Historical search results must replace the saved list.');

foreach (['LP_inschrijving.php', 'LP_financieel.php', 'LP_rekening.php'] as $page) {
    $result = searchRequest($result['session'], [], '/onderhoud/' . $page, $rows);
    checkSearch(str_contains($result['html'], 'value="Voorbeeld &amp; Test"'), $page . ': search text must remain visible and escaped.');
    checkSearch((bool) preg_match('/id="oude_dlnrs"[^>]*checked/s', $result['html']), $page . ': historical-participant checkbox must remain selected.');
    checkSearch(str_contains($result['html'], 'ToonId(501)'), $page . ': matching participant must remain in the list.');
    checkSearch($result['session']['DlnmrId'] === '501', $page . ': selected participant must be retained.');
    checkSearch(str_contains($result['queries'][0], 'FROM dlnmr WHERE naam LIKE "%Voorbeeld & Test%"'), $page . ': search must still include historical participants.');
}
echo "PASS: historical search, results and selected participant survive three page changes.\n";

$result = searchRequest($result['session'], ['bewerk' => 'bewerk', 'zoeknaam' => 'Anders', 'cursus' => '1'], '/onderhoud/LP_persoonlijk.php', $rows);
checkSearch($result['session']['LP_zoeknaam'] === ['zoeknaam' => 'Voorbeeld & Test', 'oude_dlnrs' => '1', 'cursus' => 'alles'], 'An unrelated form submission must not overwrite search settings.');
echo "PASS: unrelated form submissions preserve the search.\n";

$currentRows = [['DlnmrId' => 502, 'naam' => 'Huidige testdeelnemer', 'voorl_bev' => null]];
$result = searchRequest($result['session'], ['zoek' => 'zoek', 'zoeknaam' => 'Huidige', 'cursus' => '2'], '/onderhoud/LP_inschrijving.php', $currentRows);
$result = searchRequest($result['session'], [], '/onderhoud/LP_rekening.php', $currentRows);
checkSearch($result['session']['LP_zoeknaam']['oude_dlnrs'] === '', 'An unchecked historical-participant checkbox must clear the saved option.');
checkSearch(!(bool) preg_match('/id="oude_dlnrs"[^>]*checked/s', $result['html']), 'The historical-participant checkbox must remain unchecked after navigation.');
checkSearch(str_contains($result['html'], 'value="Huidige"'), 'A changed search term must replace the previous term.');
checkSearch(str_contains($result['queries'][0], 'CursusId_FK=102'), 'The chosen course must also survive navigation.');
echo "PASS: changed search, unchecked option and course filter survive navigation.\n";

$result = searchRequest($result['session'], ['zoek' => 'zoek', 'zoeknaam' => 'Geen resultaat', 'oude_dlnrs' => '1', 'cursus' => 'alles'], '/onderhoud/LP_persoonlijk.php', false);
$result = searchRequest($result['session'], [], '/onderhoud/LP_inschrijving.php', false);
checkSearch($result['session']['Inschr'] === [], 'No matches must clear the previous result list.');
checkSearch(!str_contains($result['html'], 'ToonId(' . 502 . ')'), 'No matches must not redisplay stale results.');
checkSearch(str_contains($result['html'], '(totaal:0)'), 'No matches must show a zero count.');
echo "PASS: an empty historical search remains empty after navigation.\n";

$result = searchRequest($result['session'], ['zoek' => 'zoek', 'zoeknaam' => '', 'cursus' => 'alles'], '/onderhoud/LP_persoonlijk.php', $currentRows);
$result = searchRequest($result['session'], [], '/onderhoud/LP_rekening.php', $currentRows);
checkSearch($result['session']['LP_zoeknaam']['zoeknaam'] === '', 'An explicitly cleared search must remain empty.');
checkSearch(str_contains($result['queries'][0], 'naam LIKE "%%"'), 'An explicitly cleared search must not restore the old term.');
echo "PASS: clearing the search remains effective after navigation.\n";

$result = searchRequest(['cursuskeuze' => '2'], [], '/onderhoud/LP_persoonlijk.php', []);
checkSearch(str_contains($result['queries'][0], 'CursusId_FK=102'), 'Existing saved course choices must remain supported.');
echo "PASS: first use with a previously saved course filter works without warnings.\n";
