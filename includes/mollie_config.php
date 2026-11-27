<?php

function laadMollieLiveSleutel(string $configFile): ?string
{
    if (file_exists($configFile)) {
        if (!is_file($configFile) || !is_readable($configFile)) {
            throw new RuntimeException('Het privébestand voor Mollie is niet leesbaar.');
        }
        $config = require $configFile;
        if (!is_array($config) || !array_key_exists('live_api_key', $config)) {
            throw new RuntimeException('Het privébestand voor Mollie bevat geen live-API-sleutel.');
        }
        $key = $config['live_api_key'];
    } else {
        $key = getenv('MOLLIE_LIVE_API_KEY');
        if ($key === false) {
            $key = $_SERVER['MOLLIE_LIVE_API_KEY'] ?? null;
        }
        if ($key === null) {
            return null;
        }
    }

    if (!is_string($key) || !preg_match('/\Alive_[A-Za-z0-9_]{30,}\z/', $key)) {
        throw new RuntimeException('De live-API-sleutel voor Mollie is ongeldig.');
    }
    return $key;
}
