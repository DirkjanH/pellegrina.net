<?php

if (($argv[1] ?? '') === '--client') {
    $_SERVER['DOCUMENT_ROOT'] = $argv[2];
    set_error_handler(static function ($severity, $message, $file, $line) {
        throw new ErrorException($message, 0, $severity, $file, $line);
    });
    require $argv[2] . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'mollie.php';
    if ($mollie->getAuthenticator()->isTestToken() !== ($argv[3] === 'test')) {
        throw new RuntimeException('The actual client does not use the selected mode.');
    }
    exit;
}

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/includes/mollie_config.php';

function checkMollieConfig($condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

function expectMollieConfigError(string $path, string $modus): void
{
    try {
        laadMollieSleutel($path, $modus);
    } catch (RuntimeException $exception) {
        return;
    }
    throw new RuntimeException('An invalid or missing configuration must fail.');
}

class FixtureMollieApiException extends \Mollie\Api\Exceptions\ApiException
{
    public function __construct(int $code)
    {
        $this->code = $code;
    }
}

function fixtureMollieClient($result)
{
    return (object) ['payments' => new class($result) {
        private $result;
        public function __construct($result) { $this->result = $result; }
        public function get($id) {
            if ($this->result instanceof Throwable) throw $this->result;
            return $this->result;
        }
    }];
}

$variables = ['MOLLIE_TEST_API_KEY', 'MOLLIE_LIVE_API_KEY'];
$previousEnvironment = [];
$previousServer = [];
foreach ($variables as $variable) {
    $previousEnvironment[$variable] = getenv($variable);
    $previousServer[$variable] = $_SERVER[$variable] ?? null;
    putenv($variable);
    unset($_SERVER[$variable]);
}
$fixtureDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mollie-config-' . bin2hex(random_bytes(6));
if (!mkdir($fixtureDir, 0700)) {
    throw new RuntimeException('Could not create fixture directory.');
}
$configFile = $fixtureDir . DIRECTORY_SEPARATOR . 'mollie.php';
$entryDir = $fixtureDir . DIRECTORY_SEPARATOR . 'entry';
$entryIncludes = $entryDir . DIRECTORY_SEPARATOR . 'includes';
$entryVendor = $entryDir . DIRECTORY_SEPARATOR . 'vendor';
$testKey = 'test_' . str_repeat('a', 30);
$liveKey = 'live_' . str_repeat('b', 30);

try {
    expectMollieConfigError($configFile, 'test');
    expectMollieConfigError($configFile, 'live');
    expectMollieConfigError($configFile, 'invalid');
    putenv('MOLLIE_TEST_API_KEY=' . $testKey);
    putenv('MOLLIE_LIVE_API_KEY=' . $liveKey);
    checkMollieConfig(laadMollieSleutel($configFile, 'test') === $testKey, 'The test environment key must be read.');
    checkMollieConfig(laadMollieSleutel($configFile, 'live') === $liveKey, 'The live environment key must be read.');

    $fileKey = 'live_' . str_repeat('c', 30);
    file_put_contents($configFile, '<?php return ' . var_export(['live_api_key' => $fileKey], true) . ';');
    checkMollieConfig(laadMollieSleutel($configFile, 'live') === $fileKey, 'The private key must take precedence.');
    checkMollieConfig(laadMollieSleutel($configFile, 'test') === $testKey, 'A missing file key must allow its environment variable.');
    foreach ([null, '', $testKey] as $invalidKey) {
        file_put_contents($configFile, '<?php return ' . var_export(['live_api_key' => $invalidKey], true) . ';');
        expectMollieConfigError($configFile, 'live');
    }
    file_put_contents($configFile, '<?php return false;');
    expectMollieConfigError($configFile, 'live');
    unlink($configFile);
    putenv('MOLLIE_TEST_API_KEY');
    $_SERVER['MOLLIE_TEST_API_KEY'] = $testKey;
    checkMollieConfig(laadMollieSleutel($configFile, 'test') === $testKey, 'The server variable must be supported.');

    $called = 0;
    $alternate = static function () use (&$called) {
        $called++;
        return fixtureMollieClient('alternate payment');
    };
    checkMollieConfig(haalMollieBetalingOp(fixtureMollieClient('current payment'), 'tr_Fixture', $alternate) === 'current payment' && $called === 0, 'A current-mode payment must not use the other key.');
    checkMollieConfig(haalMollieBetalingOp(fixtureMollieClient(new FixtureMollieApiException(404)), 'tr_Fixture', $alternate) === 'alternate payment' && $called === 1, 'A payment from before switching must be retrieved with the other key.');
    try {
        haalMollieBetalingOp(fixtureMollieClient(new FixtureMollieApiException(429)), 'tr_Fixture', $alternate);
        throw new RuntimeException('A non-404 API error must be propagated.');
    } catch (FixtureMollieApiException $exception) {
        checkMollieConfig($exception->getCode() === 429 && $called === 1, 'Other API errors must not try the other mode.');
    }

    mkdir($entryDir);
    mkdir($entryIncludes);
    mkdir($entryVendor);
    $bootstrap = file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'mollie.php');
    $bootstrap = str_replace("'/var/www/vhosts/horringa.net/private/mollie.php'", var_export($configFile, true), $bootstrap, $replacements);
    checkMollieConfig($replacements === 1, 'The fixture must isolate the private configuration path.');
    file_put_contents($entryIncludes . DIRECTORY_SEPARATOR . 'mollie.php', $bootstrap);
    copy(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'mollie_config.php', $entryIncludes . DIRECTORY_SEPARATOR . 'mollie_config.php');
    file_put_contents($entryVendor . DIRECTORY_SEPARATOR . 'autoload.php', '<?php require ' . var_export(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php', true) . ';');
    putenv('MOLLIE_TEST_API_KEY=' . $testKey);
    putenv('MOLLIE_LIVE_API_KEY=' . $liveKey);
    foreach (['test', 'live'] as $modus) {
        file_put_contents($entryIncludes . DIRECTORY_SEPARATOR . 'mollie_modus.php', '<?php return ' . var_export($modus, true) . ';');
        $process = proc_open([PHP_BINARY, __FILE__, '--client', $entryDir, $modus], [
            1 => ['pipe', 'w'], 2 => ['pipe', 'w'],
        ], $pipes);
        if (!is_resource($process)) throw new RuntimeException('Could not start client fixture.');
        $output = stream_get_contents($pipes[1]);
        $errors = stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        checkMollieConfig(proc_close($process) === 0 && $output === '' && $errors === '', "The actual {$modus} client failed: " . $errors . $output);
    }
} finally {
    if (is_file($configFile)) unlink($configFile);
    foreach (['mollie.php', 'mollie_config.php', 'mollie_modus.php'] as $file) {
        $path = $entryIncludes . DIRECTORY_SEPARATOR . $file;
        if (is_file($path)) unlink($path);
    }
    $autoload = $entryVendor . DIRECTORY_SEPARATOR . 'autoload.php';
    if (is_file($autoload)) unlink($autoload);
    foreach ([$entryIncludes, $entryVendor, $entryDir] as $directory) {
        if (is_dir($directory)) rmdir($directory);
    }
    rmdir($fixtureDir);
    foreach ($variables as $variable) {
        putenv($previousEnvironment[$variable] === false ? $variable : $variable . '=' . $previousEnvironment[$variable]);
        if ($previousServer[$variable] === null) {
            unset($_SERVER[$variable]);
        } else {
            $_SERVER[$variable] = $previousServer[$variable];
        }
    }
}

echo "PASS: Mollie modes, secure key configuration and cross-mode payment lookup.\n";
