<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'].'/connections/connect_PDO.php';

try
{
	include "initialize.php";
	
	$payment  = $mollie->payments->get($_POST['id']);
	$inschr_id = $payment->metadata->inschr_id;

	if ($payment->isPaid() == TRUE)
	{
		exec_query("UPDATE inschrijving_test SET mollie_payment_status = '{$payment->status}', aanbet_bedrag = aanbet_bedrag + {$payment->amount}, aanbetaling = NOW() WHERE inschId={$inschr_id}");
	}
	elseif ($payment->isOpen() == FALSE)
	{
		exec_query("UPDATE inschrijving_test SET mollie_payment_status = '{$payment->status}' WHERE inschId={$inschr_id}");
	}
}
catch (Mollie_API_Exception $e)
{
	echo "API call failed: " . htmlspecialchars($e->getMessage());
}
