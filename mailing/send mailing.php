<?php 
// stel php in dat deze fouten weergeeft
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Connection statement
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2023.php');
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/mailfuncties.inc.php';

Kint::$enabled_mode = true;

d($_GET);

/**
 * simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same when encrypting and decrypting
 * 
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
 *
 * @return string
 */
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'Mach a Šebestová';
    $secret_iv = 'Sudoměřice u Bechyně';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

/* Set locale to Dutch */
setlocale(LC_ALL, 'nl_NL');
date_default_timezone_set('Europe/Amsterdam');

$refreshrate = 15*60; // 15 minuten
$blokgrootte = 50;

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

d($query);

$mailing = select_query($query, 1);
$message = $mailing['message'];
$eerder_verzonden_mails = $mailing['verzonden_mails'];
$blokNr = (int) $eerder_verzonden_mails/$blokgrootte;

d($mailing);

$query = "SELECT * FROM {$mailing_adressen} WHERE mailingId_FK = {$mailing_nr}";

d($query);

$adressen = select_query($query);
$aantal_emails = count($adressen);

d($adressen, $aantal_emails);

$regel_bericht = '';
$refresh = false;
if ($eerder_verzonden_mails < $aantal_emails-$blokgrootte) $refresh = true;

d($refresh, $refreshrate);

$querystring = str_replace('SID', '', $_SERVER['QUERY_STRING']);
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<?php if ($refresh) echo "<META HTTP-EQUIV=Refresh CONTENT=\"{$refreshrate}; URL={$_SERVER['PHP_SELF']}?{$querystring}\">" ?>
	<title>Verzend mailing</title>
</head>

<body>
	<?php 
echo '<h3>Mailing-nr: ' . $mailing_nr . ': '.$mailing['tijd_aanmaak'].' - <span style="color: teal;">'.$mailing['subject'].'</span>. Aantal mailadressen: '.$aantal_emails.'</h3>';

$Subject 			= stripslashes($mailing['subject']);
$mail_text 			= stripslashes($message);
if (isset($mailing['CC']) AND $mailing['CC'] != '') $cc = true;

echo $start_bericht = '+++++++++ '.date('d/m H:i').' Startbericht: tot nu toe verzonden = '. $eerder_verzonden_mails . '; Bloknr. = '.$blokNr.'<br><br>';

$verzonden_mails = $eerder_verzonden_mails = $mailing['verzonden_mails'];

foreach ($adressen as $nr => $adres) {
	$nog_niet_verzonden = select_query("SELECT tijd_verzonden FROM mailing_adressen WHERE mailadresId = {$adres['mailadresId']}");
	if (($nr >= $eerder_verzonden_mails OR is_Null($nog_niet_verzonden)) AND $nr < $eerder_verzonden_mails+$blokgrootte) {
		$encrypt = '';
		if ($adres['DlnmrId'] != '') $encrypt = encrypt_decrypt('encrypt', $adres[ 'DlnmrId' ]);
		$mail = new LPmailer();
		$mail->Subject = $Subject;
		$mail->SetFrom($mailing['From'], $mailing['FromName']);
		$mail->AddAddress(stripslashes($adres['email']), stripslashes($adres['naam']));
		if (isset($adres['voornaam']) and $adres['voornaam'] != '') $mail_body = str_replace("{voornaam}", $adres['voornaam'], $mail_text);
		if (isset($adres['naam']) and $adres['naam'] != '') $mail_body = str_replace("{naam}", $adres['naam'], $mail_body);
		if (isset($adres['cursus']) and $adres['cursus'] != '') $mail_body = str_replace("{cursus}", $adres['cursus'], $mail_body);
		if (isset($adres['password']) and $adres['password'] != '') $mail_body = str_replace("{password}", $adres['password'], $mail_body);
		$mail_body = str_replace("DlnmrIdx", $encrypt, $mail_body);
		$tracker = 'https://pellegrina.net/volg/volg.php?kenmerk='.urlencode($adres['kenmerk']);
		$mail_body = str_replace('</body>', '<img src="'.$tracker.'" border="0" alt=""/></body>', $mail_body);

		d($mail_body);
		
		if (isset($cc) AND $cc) $mail->AddCC("info@pellegrina.net", "LP PHP mailer");
		$mail->Body  = $mail_body;
		$mail->AltBody = strip_tags($mail_body);
		
		d($mail);
		
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
try 
	{ 
		$query = "
		UPDATE
		  mailing_opdrachten
		SET
			verzonden_mails = {$verzonden_mails},
			`log` = CONCAT(
				`log`,
				'{$bb}'
			)
		WHERE mailingId = {$mailing_nr};
		";
		// d($query);
		
		if ($db->exec($query) == 0) echo 'Log niet geschreven <br>';
	} 
	catch(PDOException $e) 
	{ 
		$sMsg = '<p> 
				Regelnummer: '.$e->getLine().'<br /> 
				Bestand: '.$e->getFile().'<br /> 
				Foutmelding: '.$e->getMessage().' 
			</p>'; 
		 
		trigger_error($sMsg); 
	} 
?>
</body>
</html>