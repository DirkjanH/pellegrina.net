<?php
// stel php in dat deze fouten weergeeft
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');

Kint::$enabled_mode = false;

/*
 * Initialize the Mollie API library with your API key.
 *
 * See: https://www.mollie.com/beheer/account/profielen/
 */
$mollie = new Mollie_API_Client;
$mollie->setApiKey("test_PqGy4z4RKMVpgQHzyaxSPSKsjQd5Gq");

d($mollie);
