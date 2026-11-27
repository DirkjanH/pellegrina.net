<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
require_once __DIR__ . '/mollie_config.php';

$mollieModus = require __DIR__ . '/mollie_modus.php';

function maakMollieClient(string $modus): \Mollie\Api\MollieApiClient
{
    $sleutel = laadMollieSleutel('/var/www/vhosts/horringa.net/private/mollie.php', $modus);
    $client = new \Mollie\Api\MollieApiClient();
    $client->setApiKey($sleutel);
    return $client;
}

try {
    if (!is_string($mollieModus)) {
        throw new RuntimeException('Ongeldige Mollie-modus; kies test of live.');
    }
    $mollie = maakMollieClient($mollieModus);
} catch (RuntimeException $exception) {
    error_log('Mollie-configuratie: ' . $exception->getMessage());
    http_response_code(503);
    exit('Online betalen is tijdelijk niet beschikbaar.');
}