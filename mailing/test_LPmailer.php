<?php
// stel php in dat deze fouten weergeeft
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2024.php');
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/includes/mailfuncties.inc.php';

Kint::$enabled_mode = false;

$mail = new LPmailer();
$mail->Subject = 'TEST LPmailer';
$mail->SetFrom('dirkjan@pellegrina.net', 'Djh');
$mail->AddAddress('info@pellegrina.net', 'testadres');
$mail_body = 'proefje';
$mail->Body  = $mail_body;
$mail->AltBody = strip_tags($mail_body);

d($mail);

$mail->Send();

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>TEST LPmailer</title>
</head>

<body>
    <p>Hello World</p>
</body>

</html>