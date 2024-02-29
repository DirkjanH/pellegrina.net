<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>test mail()</title>
</head>

<body>
<?php
require_once $_SERVER["CONTEXT_DOCUMENT_ROOT"].'/vendor/autoload.php';
d($_SERVER);

echo require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/includes/LPmailer.inc.php');	

// stel php in dat deze fouten weergeeft
ini_set('display_errors',1);

error_reporting(E_ALL);
//Kint::$enabled_mode = false;
$To      = 'dhorringa@gmail.com';
$ToName	= 'DjH test';
$Subject = 'the subject';
$mail_text = <<<MSG
<div id="inhoud">
  <div id="top" class="w3-hide-small w3-hide-medium"> <a href="/index.php" target="_parent"><img src="/Images/Logos/LP_25let.jpg" alt="La Pellegrina logo" width="600" height="106" class="w3-image geenlijn"/></a></div>
  <div id="main" class="w3-container">
    <h2 class="begin w3-hover-blue">Formulier succesvol verstuurd!<br>
    </h2>
    <p class="w3-teal">Beste Dirkjan,</p>
    <p>Dank voor het versturen van dit formulier. Je ontvangt een voorlopige bevestiging
      van je inschrijving voor het project <b>Speel kamermuziek met het Kinsky Trio Prague & Friends</b> op het emailadres <strong>organisatie@trajectivoces.net</strong>. 
      Zodra wij je inschrijfgeld hebben ontvangen laten we je dat - eveneens per email - weten. </p>
    <p>Omdat bij het samenstellen van de groep
      wordt gekeken naar een evenwichtig geheel qua bezetting en niveau, kan
      definitieve bevestiging van deelname pas later, namelijk <strong>uiterlijk op  1 maart</strong>, verstrekt worden. Indien je niet geplaatst zou kunnen worden, ontvang je uiteraard je aanbetaling terug. Het volledige cursusgeld moet uiterlijk op 15 juni betaald zijn. </p>
    <p>Wil je je voor <b>meer dan één</b> project  opgeven, vul dan het formulier voor ieder project apart in. Als je je persoonlijke inlogcode "<strong>xxxx</strong>" invult onder "zoek oude gegevens" en de knop aanklikt, worden je persoonlijke gegevens weer ingevuld.</p>
    <p>Met muzikale groet, </p>
    <p>Dirkjan Horringa <em><br>
      La Pellegrina</em> </p>
      
    <p class="facebook">P.S. Wist je dat <em>La Pellegrina</em> nu ook op <strong>facebook</strong> actief is? <a title="La Pellegrina on Facebook" href="http://www.facebook.com/pellegrina.net" target="_blank"><img alt="La Pellegrina on Facebook" src="http://www.pellegrina.net/Images/Logos/facebook_logo.png" width="25" height="25"></a> <a title="La Pellegrina nu ook op facebook" href="http://www.facebook.com/pellegrina.net" target="_blank">www.facebook.com/pellegrina.net</a>. Wij vinden het erg fijn als je ons 'like't en het cursusnieuws deelt met je muzikale vrienden!</p>
    <h2><a href="javascript: history.go(-1)">Terug</a></h2>
  </div>
</div>
MSG;
d($To, $ToName, $Subject, $mail_text);

$emogrifier = new \Pelago\Emogrifier();

$css = file_get_contents($_SERVER["CONTEXT_DOCUMENT_ROOT"].'/css/w3.css').PHP_EOL;
$css .= file_get_contents($_SERVER["CONTEXT_DOCUMENT_ROOT"].'/css/mailing.css');

d($css);
	
$emogrifier->setHtml(stripslashes($mail_text));
$emogrifier->setCss($css);
$mail_text = $emogrifier->emogrify();
	
d($mail_text);

$mail = new LPmailer();
$mail->AddAddress(stripslashes($To), stripslashes($ToName));
$mail->AddBCC('aanmelding@pellegrina.net', 'TEST Aanmelding');
$mail->Subject = $Subject;
$mail->Body  = $mail_text;
$mail->AltBody = strip_tags($mail_text);
if (!$mail->Send())
	{
		$bericht = "Bericht aan {$ToName} kon niet verzonden worden.<br>";
		$bericht .= "Mailer Error: {$mail->ErrorInfo}<br>";
		echo $bericht;
	}
else {
		$bericht = "Bericht aan {$ToName} verzonden.<br>";
		echo $bericht;
		}

?>
</body>
</html>