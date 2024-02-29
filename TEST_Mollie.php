<?php 
// stel php in dat deze fouten weergeeft
ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');

Kint::$enabled_mode = true;

$_POST['InschrId'] = 'test';

$mollie = new Mollie_API_Client;
$mollie->setApiKey("test_PqGy4z4RKMVpgQHzyaxSPSKsjQd5Gq");

// Creating a new payment.
$payment = $mollie->payments->create(array(
    "amount"      => 10.00,
    "description" => "Mijn eerste API betaling",
    "redirectUrl" => "http://pellegrina.net/NL/dank.php?id={$_POST['InschrId']}",
    "webhookUrl"  => "http://pellegrina.net/Mollie/webhook.php",
));
d($payment);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>TEST Mollie</title>
<link href="css/w3.css" rel="stylesheet" type="text/css">
</head>
<?php 
$paymentId = $mollie->payments->get($payment->id);
	
d($paymentId);
	
if ($paymentId->isPaid())
{
    echo "Payment received.";
}
	else echo "Not received";
?>

<body>
</body>
</html>