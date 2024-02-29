<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<?php 
//Connection statement
require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/includes/includes2017.php');
require_once $_SERVER["CONTEXT_DOCUMENT_ROOT"].'/vendor/autoload.php';
require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/includes/LPmailer.inc.php');	

// stel php in dat deze fouten weergeeft
ini_set('display_errors',1);

error_reporting(E_ALL);

Kint::$enabled_mode = false;

/* Set locale to Dutch */
setlocale(LC_ALL, 'nl_NL');
date_default_timezone_set('Europe/Amsterdam');

$refreshrate = 15*60; // 15 minuten
$blokgrootte = 500;

$mailing_opdrachten = 'mailing_opdrachten';
$mailing_adressen = 'mailing_adressen';
$mailing_tekst = 'messages';

if (isset($_GET['mailing'])) {
		$mailing_nr = $_GET['mailing'];
	} 
	else {
		echo 'Mailing bestaat niet<br><br>';
	}
	
$query = "SELECT * FROM {$mailing_opdrachten} WHERE mailingId = {$mailing_nr}";

// d($query);
$stmt = $db->query($query);
$mailings = $stmt->fetchAll(PDO::FETCH_ASSOC);
$mailing = $mailings[0];
$message = $mailing['message'];
$eerder_verzonden_mails = 0;
$blokNr = (int) $eerder_verzonden_mails/$blokgrootte;

//d($mailing);

$query = "SELECT * FROM {$mailing_adressen} WHERE mailingId_FK = {$mailing_nr} AND tijd_verzonden IS NULL";
// d($query);
$stmt = $db->query($query);
$adressen = $stmt->fetchAll(PDO::FETCH_ASSOC);
// d($adressen);

$aantal_emails = count($adressen);
$regel_bericht = '';
$refresh = false;
?>
<title>Verzend restant mailing</title>
</head>

<body>
	<?php 
echo '<h3>Mailing-nr: ' . $mailing_nr . ': '.$mailing['tijd_aanmaak'].' - <span style="color: teal;">'.$mailing['subject'].'</span>. Aantal nog te versturen mailadressen: '.$aantal_emails.'</h3>';

$Subject 			= stripslashes($mailing['subject']);
$mail_text 			= stripslashes($message);
if (isset($mailing['CC']) AND $mailing['CC'] != '') $cc = true;

echo $start_bericht = '+++++++++ '.date('d/m H:i').' Startbericht: tot nu toe verzonden = '. $eerder_verzonden_mails . '; Bloknr. = '.$blokNr.'<br><br>';

$verzonden_mails = $eerder_verzonden_mails; //= $mailing['verzonden_mails'];

foreach ($adressen as $nr => $adres) {
	if ($nr >= $eerder_verzonden_mails AND $nr < $eerder_verzonden_mails+$blokgrootte) {
		$mail = new LPmailer();
		$mail->Subject = $Subject;
		$mail->SetFrom($mailing['From'], $mailing['FromName']);
		$mail->AddAddress(stripslashes($adres['email']), stripslashes($adres['naam']));
		$mail_body = str_replace("{voornaam}", $adres['voornaam'], $mail_text);
		$mail_body = str_replace("{naam}", $adres['naam'], $mail_body);
		$mail_body = str_replace("{cursus}", $adres['cursus'], $mail_body);
		$mail_body = str_replace("{password}", $adres['password'], $mail_body);
		$tracker = 'http://pellegrina.net/mailing_volg/volg.php?kenmerk='.urlencode($adres['kenmerk']);
		$mail_body = str_replace('</body>', '<img src="'.$tracker.'" border="0" /></body>', $mail_body);

		//d($mail_body);
		if (isset($cc) AND $cc) $mail->AddCC("info@pellegrina.net", "LP PHP mailer");
		$mail->Body  = $mail_body;
		$mail->AltBody = strip_tags($mail_body);
		
		//		d($mail);
		if (!$mail->Send())
			{
				$verzonden_mails++;
				$bericht = "Bericht aan {$adres['naam']} (nr. {$verzonden_mails}) kon niet verzonden worden.<br>";
				$bericht .= "Mailer Error: " . $mail->ErrorInfo . "<br>";
				echo $bericht;
				$regel_bericht .= $bericht;
			}
		else {
				$verzonden_mails++;
				$bericht = "Bericht aan {$adres['naam']} (nr. {$verzonden_mails}) verzonden.<br>";
				echo $bericht;
				$regel_bericht .= $bericht;
				$query = "
							UPDATE
							  	mailing_adressen
							SET
								tijd_verzonden = NOW()
							WHERE mailadresId = {$adres['mailadresId']};
							";
							// d($query);

							if ($db->exec($query) == 0) echo 'Tijd niet bijgewerkt<br>';

			}
		echo 'Totaal aantal mails: ' . $verzonden_mails . ' tot nu toe verzonden.<br>';
	}
}

$blokNr = (int) ceil($verzonden_mails/$blokgrootte);
$blok_bericht = '========= ' . date('d/m H:i') . ' Blok nr. '.$blokNr.' verzonden.<br>';
$blok_bericht .= 'Refresh: '.$refresh.'; verzonden: '. $verzonden_mails .'; totaal aantal mails: '.$aantal_emails;

echo ' <br>'.$blok_bericht.'<br>';
if ($verzonden_mails >= $aantal_emails) {
	$slot_bericht = '<br>********* '.date('d/m H:i').' <span style="color: red;">Mailing verzonden</span><br>';
	echo $slot_bericht;
}
if (isset($start_bericht))
	$bb = addslashes(strip_tags($start_bericht.'\r\n'));
if (isset($regel_bericht))
	$bb .= addslashes(strip_tags($regel_bericht.'\r\n'));
if (isset($blok_bericht))
	$bb .= addslashes(strip_tags($blok_bericht.'\r\n'));
if (isset($slot_bericht))
	$bb .= addslashes(strip_tags($slot_bericht.'\r\n'));
?>
</body>
</html>