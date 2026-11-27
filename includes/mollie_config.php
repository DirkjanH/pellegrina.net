<?php

function laadMollieSleutel(string $configFile, string $modus): string
{
    if (!in_array($modus, ['test', 'live'], true)) {
        throw new RuntimeException('Ongeldige Mollie-modus; kies test of live.');
    }

    $veld = $modus . '_api_key';
    $key = null;
    $heeftBestandSleutel = false;
    if (file_exists($configFile)) {
        if (!is_file($configFile) || !is_readable($configFile)) {
            throw new RuntimeException('Het privébestand voor Mollie is niet leesbaar.');
        }
        $config = require $configFile;
        if (!is_array($config)) {
            throw new RuntimeException('Het privébestand voor Mollie is ongeldig.');
        }
        if (array_key_exists($veld, $config)) {
            $key = $config[$veld];
            $heeftBestandSleutel = true;
        }
    }

    if (!$heeftBestandSleutel) {
        $variabele = 'MOLLIE_' . strtoupper($modus) . '_API_KEY';
        $key = getenv($variabele);
        if ($key === false) {
            $key = $_SERVER[$variabele] ?? null;
        }
    }

    if (!is_string($key) || !preg_match('/\A' . $modus . '_[A-Za-z0-9_]{30,}\z/', $key)) {
        throw new RuntimeException('De ' . $modus . '-API-sleutel voor Mollie ontbreekt of is ongeldig.');
    }
    return $key;
}

function haalMollieBetalingOp($mollie, string $id, callable $andereModus)
{
    try {
        return $mollie->payments->get($id);
    } catch (\Mollie\Api\Exceptions\ApiException $exception) {
        if ($exception->getCode() !== 404) {
            throw $exception;
        }
        return $andereModus()->payments->get($id);
    }
}
