<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use Pelago\Emogrifier\CssInliner;

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mailfuncties.inc.php');

Kint::$enabled_mode = false;

$locale = 'en';

d($_REQUEST);

$deelnemer_query = "SELECT * FROM dlnmr d, adres a, inschrijving i WHERE i.random_id = '{$_GET['res']}' AND d.AdresId_FK = a.AdresId AND d.DlnmrId = i.DlnmrId_FK";
d($deelnemer_query);
$dlnmr = select_query($deelnemer_query, 1);

if (isset($dlnmr) and str_contains($dlnmr['Mollie_ID'], 'tr_') and $dlnmr['betaalstatus'] == 'open') {
	sleep(3);
	$dlnmr = select_query($deelnemer_query, 1); // haal inschrijving na 3 seconden nog een keer op
}

$adres_query = "SELECT CONCAT(a.adres, ', ', a.postcode, ' ', a.plaats, ', ', a.land) as adres FROM dlnmr d, adres a, inschrijving i WHERE i.random_id = '{$_GET['res']}' AND d.AdresId_FK = a.AdresId AND d.DlnmrId = i.DlnmrId_FK";
$dlnmr['adres'] = select_query($adres_query, 0);
d($adres_query);
$naam = $dlnmr['naam'];
$dlnmr['aanbetaling'] = euro_en($dlnmr['aanbet_bedrag']);

if (isset($dlnmr['CursusId_FK']) and $dlnmr['CursusId_FK'] != '') $cursus_query = "SELECT * FROM cursus WHERE CursusId = {$dlnmr['CursusId_FK']}";
else exit('Geen cursus geselecteerd');
$cursus = select_query($cursus_query, 1);

$cursus['datum_begin'] = format_datum_noyear($cursus['datum_begin'], $locale);
$cursus['datum_eind'] = format_datum($cursus['datum_eind'], $locale);
$cursus['datum_beslissing'] = format_datum_short($cursus['datum_beslissing'], $locale);
$cursus['datum_betaling'] = format_datum_short($cursus['datum_betaling'], $locale);
$cursus['inschrijfgeld'] = euro_en($cursus['inschrijfgeld']);

$instrumenten = select_query("SELECT * FROM instr ORDER BY id ASC");
foreach ($instrumenten as $row) {
	$instrumententabel[$row['id']] = $row['en'];
}

$ins = explode(', ', trim($dlnmr['instr']));
$zangst = explode(', ', trim($dlnmr['zangstem']));
unset($instr);
unset($zangstem);
foreach ($ins as $in) if ($in >= 100) $instr[] = $instrumententabel[$in];
foreach ($zangst as $zangs) if ($zangs < 100) $zangstem[] = $instrumententabel[$zangs];
if (isset($instr)) $instrumentenlijst = implode(', ', $instr);
if (isset($zangstem)) $zangstem = implode(', ', $zangstem);

d($instrumenten, $instrumentenlijst, $deelnemer_query, $dlnmr, $cursus_query, $cursus, $instrumententabel, $ins, $zangstem);

// gegevens voor het mailtje:
$to = stripslashes($dlnmr['email']);
$subject = "Application for La Pellegrina Summer School '{$cursus['cursusnaam_en']}'";

// maak de tekst van het emailbericht aan:
$message =
	<<<MESSAGE
	<p>Dear {$dlnmr['voornaam']},</p>
	<p>Thank you for registering for the summer school <strong>{$cursus['cursusnaam_en']}</strong>, which will take place at {$cursus['cursusplaats_en']}, from {$cursus['datum_begin']} to {$cursus['datum_eind']}. The following data have been registered:</p>\n\n
	<ul>
		<li>Name: {$dlnmr['naam']}</li>
		<li>Registration nr.: {$dlnmr['InschId']}</li>
		<li>Address: {$dlnmr['adres']}</li>
		<li>Tel. {$dlnmr['telefoon']}
MESSAGE;
if ($dlnmr['mobiel'] != '') $message .= " | mobile {$dlnmr['mobiel']}</li>";
else $message .= "</li>";

if (isset($dlnmr['instrumentalist']) and $dlnmr['instrumentalist'] > 0) {
	$message .= "<li>You have registered as instrumentalist, with instrument(s): {$instrumentenlijst}.</li>\n";
}

if (isset($dlnmr['zanger']) and $dlnmr['zanger'] > 0) {
	$message .= "<li>You have registered as singer, with voice type {$zangstem}.</li>\n";
}

if (isset($dlnmr['solozanger']) and $dlnmr['solozanger'] > 0) {
	$message .= "<li>You have registered as solo singer, with voice type {$zangstem}.</li>\n";
}

if (isset($dlnmr['toehoorder']) and $dlnmr['toehoorder'] > 0) {
	$message .= "<li>You have registered as auditor.</li>\n";
}

if (isset($dlnmr['eenpersoons']) and $dlnmr['eenpersoons'] > 0) {
	$message .= "<li>You have reserved a single room in the Guest House (Gastenverblijf). The number of rooms is limited. They will be allocated after definitive admission on {$cursus['datum_beslissing']}, in order of registration.</li>\n";
}

if (isset($dlnmr["hotel_1pp"]) and $dlnmr["hotel_1pp"] > 0) {
	$message .= "<li>You have reserved a single room in the Gatehouse (Poortgebouw). The number of rooms is limited. They will be allocated after definitive admission on {$cursus['datum_beslissing']}, in order of registration.</li>\n";
}

if (isset($dlnmr["hotel_2pp"]) and $dlnmr["hotel_2pp"] > 0) {
	$message .= "<li>You have reserved a place in a double room with private bathroom facilities in the Gatehouse (Poortgebouw). The number of rooms is limited. They will be allocated after definitive admission on {$cursus['datum_beslissing']}, in order of registration.</li>\n";
}

if (isset($dlnmr['kamperen']) and $dlnmr['kamperen'] > 0) {
	$message .= "<li>You have reserved a camping spot in the monastery garden. The number of places is limited. They will be allocated after the definitive admission on {$cursus['datum_beslissing']}, in order of registration.</li>\n";
}

if (isset($dlnmr['eigen_acc']) and $dlnmr['eigen_acc'] > 0) {
	$message .= "<li>You have indicated that you want to arrange your own accommodation. Please contact one of the various accommodations for this. It is advisable not to wait too long.</li>\n";
}

if (isset($dlnmr['diner']) and $dlnmr['diner'] > 0) {
	$message .= "<li>You have indicated that you arrange your own accommodation and would like to join the communal dinner.</li>\n";
}

if (isset($dlnmr['acc_wens']) and $dlnmr['acc_wens'] > 0) {
	$tmp = stripslashes($dlnmr['acc_wens']);
	$message .= "<li>Your special wishes about accommodation are: {$tmp}</li>\n";
}

if (isset($dlnmr['opmerkingen']) and $dlnmr['opmerkingen'] > 0) {
	$tmp = stripslashes($dlnmr['opmerkingen']);
	$message .= "<li>Your other remarks are: {$tmp}</li>\n";
}

$message .= "</ul>";

switch ($dlnmr['betaalstatus']) {
	case 'paid':
		$message .= "<p>We have received your deposit in our account. If that payment was made using a bank account, the full amount of {$cursus['inschrijfgeld']} has been received. Please note that if the payment was made by credit card, the credit card company has deducted a commission of about 3&nbsp;%. We will offset this against the next payment.</p>";
		break;
	case 'transfer':
		$message .= "<p>Your registration will be processed immediately once we have received payment of the deposit on our bank account <strong>NL33 ASNB 0707 2500 72</strong> in the name of La Pellegrina, Utrecht. For bank transfers from outside the EU: BIC ASNB NL21. The deposit is {$course['enrolment fee']} or half of the total course amount due if it is less than {$cursus['inschrijfgeld']} </p>";
		break;
	default:
		$message .= "<p>For some reason we have not (yet) received your deposit. The payment may have failed or been aborted by yourself. In that case no money has been debited from your account.<br>
			It is also possible that the payment has not yet been processed. Therefore, it makes sense to refresh this page (Ctrl-R) and see if the payment is then reported.<br>
			Your registration will be processed immediately once we have received payment of the deposit of {$cursus['inschrijfgeld']} in our bank account <strong>NL33 ASNB 0707 2500 72</strong> in the name of La Pellegrina, Utrecht. For bank transfers from outside the EU: BIC ASNB NL21. Czech participants can pay their deposit in CZK to Komerční Banka account 538940301/0100.</p>";
		break;
}

$message .=
	<<<MESSAGE
	<p>Because a balance in terms of instrumental and vocal groups and levels will be considered when putting together the group, final confirmation of participation can only be given later, ultimately on {$cursus['datum_beslissing']}. If you could not be placed, your deposit will of course be returned. The full course fee should be paid ultimately on {$cursus['datum_betaling']}.</p>
	<p>In case you want to <b>register for more than one project </b> please fill out the form for each project. If you fill out your personal login code &quot;<strong>{$dlnmr['password']}</strong>&quot; under &quot;find last year's data&quot; and click the button, the form will be pre-filled with your personal information. Please <b>don't use the form with your personal login code for another person,</b> because the information will get corrupted.</p>
	<p>Musical greetings,</p>
	<p>Dirkjan Horringa<br>
	<em>La Pellegrina</em>
	</p>
MESSAGE;

$message .= '<p class="facebook">P.S. Did you know <em>La Pellegrina</em> is  active on Facebook too? <a title="La Pellegrina on Facebook" href="https://www.facebook.com/pellegrina.net" target="_blank"><img src="https://www.pellegrina.net/Images/Logos/facebook_logo.png" alt="La Pellegrina on Facebook" width="25" height="25" class="geenlijn w3-image"></a> <a title="La Pellegrina on facebook" href="http://www.facebook.com/pellegrina.net" target="_blank">www.facebook.com/pellegrina.net</a>. We are very pleased when you click the \'Like\' button and share the course news with your musical friends</p>';


$mail_text_file = ($_SERVER['DOCUMENT_ROOT'] . '/bevestiging/briefhoofd_EN.htm');
$mail_text = file_get_contents($mail_text_file);

$mail_text = str_replace("</html>", stripslashes($message) . "</body></html>", $mail_text);

d($to, $naam, $subject, $mail_text);

// bericht ter bevestiging:

if (!LPmail($to, $naam, $subject, $mail_text, 'aanmelding@pellegrina.net', 'LP Aanmelding')) echo "The email was not sent!<br>";
?>

<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP algemeen EN.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">

	<!-- CSS: -->
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

	<!-- InstanceBeginEditable name="doctitle" -->
	<title>Thank you for registering!</title>
	<!-- InstanceEndEditable -->
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
	<link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
	<!-- InstanceBeginEditable name="head" -->
	<!-- InstanceEndEditable -->
</head>

<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
	<div id="inhoud">
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>
		<div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
			<?php echo $message; ?>
			<!-- InstanceEndEditable -->
			<h2> <a href="javascript: history.go(-1)">Back</a></h2>
			<p>&nbsp;</p>
		</div>
	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
<!-- InstanceEnd -->

</html>