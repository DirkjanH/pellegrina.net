<?php

class Kint { public static $enabled_mode; }
function d(...$values) {}

class OccupancyDatabase {
    public function query($sql) {
        global $fixture;
        if ($fixture['fail']) throw new PDOException('sensitive database details');
        if (!str_contains($sql, 'FROM instr')) throw new RuntimeException('Unexpected query: ' . $sql);
        return new OccupancyStatement($sql, $fixture['instruments']);
    }
    public function prepare($sql) { return new OccupancyStatement($sql); }
}
class OccupancyStatement {
    private $sql;
    private $rows;
    private $parameters = [];
    public function __construct($sql, $rows = []) { $this->sql = $sql; $this->rows = $rows; }
    public function execute($parameters) { $this->parameters = $parameters; }
    public function fetchAll($mode) {
        global $fixture;
        if (str_contains($this->sql, 'FROM instr_aantallen')) return $fixture['targets'][$this->parameters[0]] ?? [];
        if (str_contains($this->sql, 'SELECT DISTINCT DlnmrId')) return [];
        return $this->rows;
    }
    public function fetchColumn() {
        global $fixture;
        return $fixture['counts'][$this->parameters[1]][$this->parameters[0]] ?? 0;
    }
}

if (($argv[1] ?? '') === '--request') {
    set_error_handler(static function ($severity, $message, $file, $line) {
        throw new ErrorException($message, 0, $severity, $file, $line);
    });
    $fixture = json_decode(stream_get_contents(STDIN), true, 512, JSON_THROW_ON_ERROR);
    $root = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'pellegrina-occupancy-' . bin2hex(random_bytes(6));
    mkdir($root . DIRECTORY_SEPARATOR . 'includes', 0700, true);
    $bootstrap = $root . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'includes2027.php';
    $security = $root . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'LP_security.php';
    file_put_contents($bootstrap, '<?php');
    file_put_contents($security, '<?php require_once ' . var_export(dirname(__DIR__) . '/includes/LP_security.php', true) . ';');
    $_SERVER['DOCUMENT_ROOT'] = $root;
    $_SERVER['PHP_SELF'] = '/onderhoud/LP_bezettingen.php';
    $_SESSION = $_POST = $_REQUEST = [];
    $cursus_offset = 100;
    $aantal_cursussen = 2;
    $eerstecursus = 101;
    $laatstecursus = 102;
    $editFormhref = '';
    $db = new OccupancyDatabase();
    ini_set('error_log', $root . DIRECTORY_SEPARATOR . 'error.log');
    register_shutdown_function(static function () use ($root, $bootstrap, $security) {
        if (file_exists($root . DIRECTORY_SEPARATOR . 'error.log')) unlink($root . DIRECTORY_SEPARATOR . 'error.log');
        unlink($bootstrap);
        unlink($security);
        rmdir($root . DIRECTORY_SEPARATOR . 'includes');
        rmdir($root);
    });
    require dirname(__DIR__) . '/onderhoud/LP_bezettingen.php';
    exit;
}

function checkOccupancy($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}
function occupancyRequest($fixture) {
    $process = proc_open([PHP_BINARY, __FILE__, '--request'], [
        0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w'],
    ], $pipes);
    if (!is_resource($process)) throw new RuntimeException('Could not start occupancy fixture.');
    fwrite($pipes[0], json_encode($fixture, JSON_THROW_ON_ERROR));
    fclose($pipes[0]);
    $html = stream_get_contents($pipes[1]);
    $errors = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $status = proc_close($process);
    checkOccupancy($status === 0 && $errors === '', "Occupancy fixture failed:\n" . $errors . $html);
    return $html;
}

$fixture = [
    'fail' => false,
    'instruments' => [['id' => 1, 'nl' => '<script>alert(1)</script>', 'en' => 'test'], ['id' => 2, 'nl' => 'Viool', 'en' => 'Violin']],
    'targets' => [101 => [['InstrId' => 1, 'Aantal' => 3], ['InstrId' => 9, 'Aantal' => 2]]],
    'counts' => [101 => [1 => 2, 2 => 1], 102 => [2 => 4]],
];
$html = occupancyRequest($fixture);
checkOccupancy(str_contains($html, '&lt;script&gt;alert(1)&lt;/script&gt;') && !str_contains($html, '<script>alert(1)</script>'), 'Instrument names must be escaped.');
checkOccupancy((bool) preg_match('/<td>1<\/td>\s*<td>&lt;script&gt;.*?<\/td>\s*<td>2\s*<span class="klein">\(3\)<\/span><\/td>\s*<td><\/td>/s', $html), 'Counts, targets and empty cells must appear in the right courses.');
checkOccupancy((bool) preg_match('/TOTAAL:<\/strong><\/td>\s*<td><strong>3\s*<span class="klein">\(5\)<\/span><\/strong><\/td>\s*<td><strong>4\s*<span class="klein">\(0\)<\/span>/s', $html), 'Totals must include all targets and zero when no targets exist.');
echo "PASS: escaped names, counts, totals and missing targets.\n";

$fixture['instruments'] = $fixture['targets'] = $fixture['counts'] = [];
$html = occupancyRequest($fixture);
checkOccupancy(str_contains($html, 'TOTAAL:') && substr_count($html, '(0)') === 2, 'An empty result must render zero totals without warnings.');
echo "PASS: no instruments or targets render safely.\n";

$fixture['fail'] = true;
$html = occupancyRequest($fixture);
checkOccupancy(str_contains($html, 'De bezettingen konden niet worden geladen.') && !str_contains($html, 'sensitive database details'), 'Database errors must show a safe message.');
echo "PASS: database errors do not disclose details.\n";
