<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"].'/includes/includes2024.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/includes/mollie.php');

Kint::$enabled_mode = true;

//$_POST['id'] = 'tr_DvUa8oMFZ5';

if (isset($_POST['id']) AND $_POST['id'] != '') $mollie_id = $_POST['id'];
	elseif (isset($_GET['mollie_id']) AND $_GET['mollie_id'] != '') $mollie_id = $_GET['mollie_id'];
else exit('Geen geldige ID voor Mollie<br>');

$bestaat_boeking = select_query("SELECT count(*) FROM inschrijving WHERE `Mollie_ID` = '$mollie_id';", 0);

d($_REQUEST, $_POST['id'], $mollie_id, $bestaat_boeking);

if (!is_null($bestaat_boeking) AND $bestaat_boeking == true) {
	
	$inschrijving_query = "SELECT * FROM inschrijving WHERE `Mollie_ID` = '$mollie_id';";
	$inschrijving = select_query($inschrijving_query, 1);
	d($inschrijving_query, $inschrijving); 
	
	try {
			$payment = $mollie->payments->get($mollie_id);
			$random_id = $payment->metadata->random_id;
			d($payment->status);
			if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {
				$betaal_query = "UPDATE inschrijving SET `betaalstatus` = '{$payment->status}', `aanbetaling` = NOW(), aanbet_bedrag = {$payment->amount->value} WHERE `Mollie_ID` = '$mollie_id';";
				d($betaal_query);
				$gelukt = exec_query($betaal_query);
				d($payment, $gelukt);
			}
		}
		catch (exception $e) {
   			echo $e->getMessage();
		}
	header('Location: https://pellegrina.net/EN/dank.php?res=' . $random_id, true, 303);
}
else exit('Deze boeking bestaat niet in de tabel.<br');
?>