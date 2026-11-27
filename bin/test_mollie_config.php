<?php

require dirname(__DIR__) . '/includes/mollie_config.php';

function checkMollieConfig($condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

function expectMollieConfigError(string $path): void
{
    try {
        laadMollieLiveSleutel($path);
    } catch (RuntimeException $exception) {
        return;
    }
    throw new RuntimeException('An invalid live configuration must fail.');
}

$previousEnvironment = getenv('MOLLIE_LIVE_API_KEY');
$previousServer = $_SERVER['MOLLIE_LIVE_API_KEY'] ?? null;
$fixtureDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mollie-config-' . bin2hex(random_bytes(6));
if (!mkdir($fixtureDir, 0700)) {
    throw new RuntimeException('Could not create fixture directory.');
}
$configFile = $fixtureDir . DIRECTORY_SEPARATOR . 'mollie.php';
$environmentKey = 'live_' . str_repeat('a', 30);
$fileKey = 'live_' . str_repeat('b', 30);

try {
    putenv('MOLLIE_LIVE_API_KEY');
    unset($_SERVER['MOLLIE_LIVE_API_KEY']);
    checkMollieConfig(laadMollieLiveSleutel($configFile) === null, 'No configuration must retain test mode.');

    putenv('MOLLIE_LIVE_API_KEY=' . $environmentKey);
    checkMollieConfig(laadMollieLiveSleutel($configFile) === $environmentKey, 'The environment live key must be read.');

    file_put_contents($configFile, '<?php return ' . var_export(['live_api_key' => $fileKey], true) . ';');
    checkMollieConfig(laadMollieLiveSleutel($configFile) === $fileKey, 'The private file must take precedence.');

    file_put_contents($configFile, '<?php return ' . var_export(['live_api_key' => 'test_' . str_repeat('a', 30)], true) . ';');
    expectMollieConfigError($configFile);
    file_put_contents($configFile, '<?php return [];');
    expectMollieConfigError($configFile);

    unlink($configFile);
    putenv('MOLLIE_LIVE_API_KEY=');
    expectMollieConfigError($configFile);
    putenv('MOLLIE_LIVE_API_KEY');
    $_SERVER['MOLLIE_LIVE_API_KEY'] = $environmentKey;
    checkMollieConfig(laadMollieLiveSleutel($configFile) === $environmentKey, 'The server variable must be supported.');
} finally {
    if (is_file($configFile)) unlink($configFile);
    rmdir($fixtureDir);
    putenv($previousEnvironment === false ? 'MOLLIE_LIVE_API_KEY' : 'MOLLIE_LIVE_API_KEY=' . $previousEnvironment);
    if ($previousServer === null) {
        unset($_SERVER['MOLLIE_LIVE_API_KEY']);
    } else {
        $_SERVER['MOLLIE_LIVE_API_KEY'] = $previousServer;
    }
}

echo "PASS: Mollie live configuration, precedence and validation.\n";
