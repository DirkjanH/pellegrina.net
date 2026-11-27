<?php

class BadgeFixtureDatabase
{
    public function prepare($query)
    {
        if ($query !== 'SELECT CursusId, cursusnaam_en FROM cursus WHERE YEAR(datum_begin) = ? ORDER BY datum_begin, CursusId') {
            throw new RuntimeException('Unexpected course query: ' . $query);
        }
        return new BadgeFixtureStatement();
    }
}

class BadgeFixtureStatement
{
    public function execute($parameters)
    {
        if ($parameters !== [2027]) {
            throw new RuntimeException('The configured course year must be used.');
        }
    }

    public function fetchAll($mode)
    {
        global $fixture;
        if ($mode !== PDO::FETCH_ASSOC) {
            throw new RuntimeException('Unexpected fetch mode.');
        }
        return $fixture['courses'];
    }
}

function select_query($query, $index = 2)
{
    if (str_starts_with($query, 'SELECT id, en FROM instr')) {
        return [['id' => 1, 'en' => 'violin']];
    }
    if (str_contains($query, 'FROM dlnmr d')) {
        if (!preg_match('/i\.CursusId_FK = (\d+)/', $query, $match)) {
            throw new RuntimeException('Participant query has no course ID.');
        }
        return [['naam' => 'Deelnemer ' . $match[1], 'land' => 'Nederland', 'instr' => '1', 'zangstem' => '']];
    }
    if (str_contains($query, 'FROM cursusdocenten cd')) {
        if (!preg_match('/cd\.CursusID_FK = (\d+)/', $query, $match)) {
            throw new RuntimeException('Tutor query has no course ID.');
        }
        return [['naam' => 'Docent ' . $match[1], 'land' => 'Nederland', 'vak' => 'violin']];
    }
    throw new RuntimeException('Unexpected fixture query: ' . $query);
}

if (($argv[1] ?? '') === '--request') {
    $fixture = json_decode(stream_get_contents(STDIN), true, 512, JSON_THROW_ON_ERROR);
    $_GET = $fixture['get'];
    $_REQUEST = $_GET;
    $jaar = 2027;
    $cursus_offset = 100;
    $eerstecursus = 101;
    $db = new BadgeFixtureDatabase();

    $root = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'pellegrina-badges-' . bin2hex(random_bytes(6));
    mkdir($root . DIRECTORY_SEPARATOR . 'includes', 0700, true);
    mkdir($root . DIRECTORY_SEPARATOR . 'vendor', 0700, true);
    $bootstrap = $root . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'includes2027.php';
    $autoload = $root . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
    file_put_contents($bootstrap, '<?php');
    file_put_contents($autoload, '<?php');
    register_shutdown_function(static function () use ($root, $bootstrap, $autoload) {
        unlink($bootstrap);
        unlink($autoload);
        rmdir($root . DIRECTORY_SEPARATOR . 'includes');
        rmdir($root . DIRECTORY_SEPARATOR . 'vendor');
        rmdir($root);
    });
    $_SERVER['DOCUMENT_ROOT'] = $root;
    require dirname(__DIR__) . '/onderhoud/LP_badges.php';
    exit;
}

function checkBadges($condition, $message)
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

function badgeRequest($get, $courses)
{
    $process = proc_open([PHP_BINARY, __FILE__, '--request'], [
        0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w'],
    ], $pipes);
    if (!is_resource($process)) {
        throw new RuntimeException('Could not start badge fixture.');
    }
    fwrite($pipes[0], json_encode(compact('get', 'courses'), JSON_THROW_ON_ERROR));
    fclose($pipes[0]);
    $output = stream_get_contents($pipes[1]);
    $errors = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $status = proc_close($process);
    checkBadges($status === 0 && $errors === '', "Badge fixture failed:\n" . $errors . $output);
    return $output;
}

$courses = [
    ['CursusId' => 101, 'cursusnaam_en' => 'First course'],
    ['CursusId' => 104, 'cursusnaam_en' => 'Second & course'],
    ['CursusId' => 110, 'cursusnaam_en' => 'Third course'],
];

$html = badgeRequest([], $courses);
checkBadges(str_contains($html, '?cursus_id=101') && str_contains($html, '?cursus_id=104') && str_contains($html, '?cursus_id=110'), 'Every configured-year course must be selectable, including noncontiguous IDs.');
checkBadges(str_contains($html, 'Second &amp; course') && str_contains($html, 'Deelnemer 101'), 'Course names must be escaped and the first configured course selected by default.');

$html = badgeRequest(['cursus_id' => '110'], $courses);
checkBadges(str_contains($html, 'Deelnemer 110') && str_contains($html, 'Docent 110'), 'The chosen course must select its own participants and tutors.');
checkBadges((bool)preg_match('/name="cursus_id"\s+value="110"/', $html), 'The selected course ID must be retained by the form.');
checkBadges(str_contains($html, '"cursus_id":110') && str_contains($html, '"cursus":10'), 'Saved JSON must carry both the course ID and the legacy offset.');
checkBadges(str_contains($html, "params.set('cursus_id', String(lpBadgesData.cursus_id))"), 'Loading JSON must reopen the editor for the chosen course.');

$json = json_decode(badgeRequest(['cursus_id' => '104', 'json' => '1', 'extra' => 'Extra naam#Nederland#flute'], $courses), true, 512, JSON_THROW_ON_ERROR);
checkBadges($json['result'][0]['name'] === 'Deelnemer 104' && $json['result'][1]['name'] === 'Docent 104', 'JSON must contain the selected course, not another course.');
checkBadges($json['result'][2]['name'] === 'Extra naam', 'Extra entries must be retained for the selected course.');
$legacy = json_decode(badgeRequest(['cursus' => '4', 'json' => '1'], $courses), true, 512, JSON_THROW_ON_ERROR);
checkBadges($legacy['result'][0]['name'] === 'Deelnemer 104', 'Existing offset-based course links must remain usable.');

foreach (['editor', 'print'] as $mode) {
    $html = badgeRequest(['cursus_id' => '110', $mode => '1', 'extra' => 'Extra naam#Nederland#flute'], $courses);
    checkBadges(str_contains($html, 'Deelnemer 110') && str_contains($html, 'Extra naam') && !str_contains($html, 'Deelnemer 101'), "$mode must use the selected course and extra entries.");
}

$otherCourses = [['CursusId' => 80, 'cursusnaam_en' => '<script>alert("test")</script>']];
$html = badgeRequest([], $otherCourses);
checkBadges(str_contains($html, 'Deelnemer 80') && str_contains($html, '"cursus_id":80'), 'The first available course must be selected even when its ID is below the legacy offset.');
checkBadges(str_contains($html, '&lt;script&gt;') && !str_contains($html, '<script>alert("test")</script>'), 'Course names must not inject HTML or scripts.');

foreach ([['cursus_id' => '99'], ['cursus' => '2'], ['cursus_id' => ['110']], ['cursus' => (string)PHP_INT_MAX]] as $invalid) {
    $message = badgeRequest($invalid, $courses);
    checkBadges(str_contains($message, 'Ongeldige cursuskeuze.') || str_contains($message, 'niet bij het ingestelde cursusjaar'), 'Invalid and out-of-year courses must be rejected explicitly.');
}
checkBadges(str_contains(badgeRequest([], []), 'Geen cursussen gevonden voor cursusjaar 2027.'), 'An empty configured year must be reported explicitly.');

echo "PASS: configured-year course selection, legacy links, badge output and invalid selections.\n";
