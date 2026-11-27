<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
require_once __DIR__ . '/mollie_config.php';

$mollie = new \Mollie\Api\MollieApiClient();
try {
    $mollieLiveSleutel = laadMollieLiveSleutel('/var/www/vhosts/horringa.net/private/mollie.php');
} catch (RuntimeException $exception) {
    error_log('Mollie-configuratie: ' . $exception->getMessage());
    http_response_code(503);
    exit('Online betalen is tijdelijk niet beschikbaar.');
}
if ($mollieLiveSleutel !== null) {
    //    $mollie->setApiKey($mollieLiveSleutel);
} else {
    //$mollie->setApiKey("test_PqGy4z4RKMVpgQHzyaxSPSKsjQd5Gq"); // La Pellegrina test
}
unset($mollieLiveSleutel);