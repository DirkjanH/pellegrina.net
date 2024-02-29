<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

$mollie = new \Mollie\Api\MollieApiClient();
//$mollie->setApiKey("test_PqGy4z4RKMVpgQHzyaxSPSKsjQd5Gq"); // La Pellegrina test
$mollie->setApiKey("live_pSRgw8xxa67nTg834W7NyKb6eW3WVU"); // La Pellegrina live
d($mollie);
?>