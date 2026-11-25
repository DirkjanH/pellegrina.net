<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2027.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use Pelago\Emogrifier\CssInliner;

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/mailfuncties.inc.php');

Kint::$enabled_mode = false;

$locale = 'en';

d($_REQUEST);

$booking_reference = $confirmation_reference ?? ($_GET['res'] ?? '');
if (!is_string($booking_reference) || !preg_match('/^[A-Za-z0-9_-]+$/', $booking_reference)) {
	http_response_code(400);
	exit('Invalid booking reference.');
}
$reference_sql = quote($booking_reference);
$deelnemer_query = "SELECT * FROM dlnmr d, adres a, inschrijving i WHERE i.random_id = {$reference_sql} AND d.AdresId_FK = a.AdresId AND d.DlnmrId = i.DlnmrId_FK";
d($deelnemer_query);
$dlnmr = select_query($deelnemer_query, 1);

if (!$dlnmr) {
	http_response_code(404);
	exit('Registration not found.');
}
if (preg_match('/^tr_[A-Za-z0-9]+$/', (string) ($dlnmr['Mollie_ID'] ?? ''))
	&& !in_array($dlnmr['betaalstatus'], ['paid', 'failed', 'expired', 'canceled'], true)) {
	if (!empty($confirmation_internal)) return;
	header('Refresh: 5');
	echo 'Your payment status is being processed. This page will refresh automatically.';
	exit;
}

$adres_query = "SELECT CONCAT(a.adres, ', ', a.postcode, ' ', a.plaats, ', ', a.land) as adres FROM dlnmr d, adres a, inschrijving i WHERE i.random_id = {$reference_sql} AND d.AdresId_FK = a.AdresId AND d.DlnmrId = i.DlnmrId_FK";
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

if (isset($dlnmr['eenpersoons']) and $dlnmr['eenpersoons'] > 0 && $dlnmr['CursusId_FK'] - $cursus_offset == 1) {
	$message .= "<li>You have reserved a single room in the conservatoire. The number of rooms is limited. They will be allocated after definitive admission on {$cursus['datum_beslissing']}, in order of registration.</li>\n";
}

if (isset($dlnmr['eenpersoons']) and $dlnmr['eenpersoons'] > 0 && $dlnmr['CursusId_FK'] - $cursus_offset == 2) {
	$message .= "<li>You have reserved a single room in the Guest House (Gastenverblijf). The number of rooms is limited. They will be allocated after definitive admission on {$cursus['datum_beslissing']}, in order of registration.</li>\n";
}

if (isset($dlnmr["hotel_1pp"]) and $dlnmr["hotel_1pp"] > 0) {
	$message .= "<li>You have reserved a single room in the Gatehouse (Poortgebouw). The number of rooms is limited. They will be allocated after definitive admission on {$cursus['datum_beslissing']}, in order of registration.</li>\n";
}

if (isset($dlnmr["hotel_2pp"]) and $dlnmr["hotel_2pp"] > 0) {
	$message .= "<li>You have reserved a place in a double room with private bathroom facilities in the Gatehouse (Poortgebouw). The number of rooms is limited. They will be allocated after definitive admission on {$cursus['datum_beslissing']}, in order of registration.</li>\n";
}

if (isset($dlnmr['kamperen']) and $dlnmr['kamperen'] > 0) {
	$message .= "<li>You want to camp in the monastery garden. The number of places is limited. They will be allocated after the definitive admission on {$cursus['datum_beslissing']}, in order of registration.</li>\n";
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
		$message .= "<p>Your registration will be processed immediately once we have received payment of the deposit on our bank account <strong>NL60 BUNQ 2177 4957 25</strong> in the name of La Pellegrina, Utrecht. For bank transfers from outside the EU: BIC BUNQ NL2A. The deposit is {$cursus['inschrijfgeld']} or half of the total course amount due if it is less than {$cursus['inschrijfgeld']} </p>";
		break;
	case 'failed':
	case 'expired':
	case 'canceled':
		$message .= "<p>Your payment through Mollie was unsuccessful. We have not received your deposit. Your registration will be processed once we receive the deposit of {$cursus['inschrijfgeld']} in account <strong>NL60 BUNQ 2177 4957 25</strong> in the name of La Pellegrina, Utrecht (BIC BUNQ NL2A). If you have any questions, please contact <a href=\"mailto:aanmelding@pellegrina.net\">aanmelding@pellegrina.net</a>.</p>";
		break;
	default:
		$message .= "<p>We have not yet confirmed your deposit.<br>
			Your registration will be processed immediately once we have received payment of the deposit of {$cursus['inschrijfgeld']} in our bank account <strong>NL60 BUNQ 2177 4957 25</strong> in the name of La Pellegrina, Utrecht. For bank transfers from outside the EU: BIC BUNQ NL2A. Czech participants can pay their deposit in CZK to ČSOB account 375170575/0300 in the name of Horringa Dirk Johannes.</p>";
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

$mail_sent_dir = $_SERVER['DOCUMENT_ROOT'] . '/mail_sent';
$mail_sent_file = $booking_reference !== '' ? $mail_sent_dir . '/' . $booking_reference . '.sent' : '';
$mollie_id = (string) ($dlnmr['Mollie_ID'] ?? '');
$is_mollie_registration = preg_match('/^tr_[A-Za-z0-9]+$/', $mollie_id) === 1;
$payment_confirmation_file = $is_mollie_registration
	? $mail_sent_dir . '/payment-confirmation-' . preg_replace('/[^A-Za-z0-9_-]/', '', $mollie_id) . '.sent'
	: '';

$db_mail_already_sent = isset($dlnmr['dankmail_verzonden']) && !empty($dlnmr['dankmail_verzonden']) && $dlnmr['dankmail_verzonden'] !== '0000-00-00' && $dlnmr['dankmail_verzonden'] !== '0000-00-00 00:00:00' && $dlnmr['dankmail_verzonden'] !== '0';
$file_mail_already_sent = $mail_sent_file !== '' && file_exists($mail_sent_file);

$mail_already_sent = $db_mail_already_sent || $file_mail_already_sent
	|| ($payment_confirmation_file !== '' && file_exists($payment_confirmation_file));
$payment_mail_lock = false;
$payment_mail_lock_failed = false;

if ($mail_sent_file !== '' && !is_dir($mail_sent_dir) && !mkdir($mail_sent_dir, 0775, true) && !is_dir($mail_sent_dir)) {
	error_log('Map voor dankmailstatus kon niet worden aangemaakt.');
	if (!empty($confirmation_internal)) return;
	exit('The email could not be sent.');
}

if ($is_mollie_registration) {
	$payment_mail_lock = fopen($payment_confirmation_file . '.lock', 'c');
	if ($payment_mail_lock === false || !flock($payment_mail_lock, LOCK_EX)) {
		if (is_resource($payment_mail_lock)) fclose($payment_mail_lock);
		$payment_mail_lock = false;
		$payment_mail_lock_failed = true;
		error_log('Bevestigingsmail kon niet worden vergrendeld voor betaling ' . $mollie_id);
	} else {
		$mail_already_sent = file_exists($payment_confirmation_file)
			|| ($mail_sent_file !== '' && file_exists($mail_sent_file))
			|| LPconfirmationSent((int) $dlnmr['InschId']);
	}
}

// bericht ter bevestiging:
if ($payment_mail_lock_failed) {
	if (empty($confirmation_internal)) echo "The email was not sent!<br>";
} elseif (!$mail_already_sent) {
	if (!empty($dlnmr) && !empty($to)) {
		$mail_verstuurd = LPmail($to, $naam, $subject, $mail_text, 'aanmelding@pellegrina.net', 'LP Aanmelding');
		if (!$mail_verstuurd) {
			error_log('Dankmail kon niet worden verzonden voor boeking ' . $booking_reference);
			if (empty($confirmation_internal)) echo "The email was not sent!<br>";
		} else {
			$marker_saved = $mail_sent_file !== '' && file_put_contents($mail_sent_file, time(), LOCK_EX) !== false;
			$db_saved = false;
			if (isset($dlnmr['InschId']) && !empty($dlnmr['InschId'])) {
				$db_saved = exec_query("UPDATE inschrijving SET dankmail_verzonden = NOW() WHERE InschId = " . intval($dlnmr['InschId']));
			}
			if ($payment_confirmation_file !== '' && file_put_contents($payment_confirmation_file, date('c'), LOCK_EX) === false) {
				error_log('Bevestigingsmail verzonden maar Mollie-marker kon niet worden opgeslagen voor betaling ' . $mollie_id);
			}
			if (!$marker_saved || !$db_saved) error_log('Verzendstatus van dankmail kon niet volledig worden opgeslagen voor boeking ' . $booking_reference);
			$confirmation_success = $marker_saved || $db_saved;
		}
	} else {
		error_log('Ontvanger voor dankmail ontbreekt voor boeking ' . $booking_reference);
	}
} elseif ($mail_already_sent) {
	$confirmation_success = true;
}
if (is_resource($payment_mail_lock)) {
	flock($payment_mail_lock, LOCK_UN);
	fclose($payment_mail_lock);
}
if (!empty($confirmation_internal)) return;
if (empty($confirmation_success) && !$payment_mail_lock_failed && !empty($mail_verstuurd)) {
	echo "The email delivery status could not be saved.<br>";
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
	<title>Thank you for registering!</title>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
</head>

<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
	<div id="inhoud">
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>
		<div id="main"> <?php echo $message; ?> <h2> <a
					href="javascript: history.go(-1)">Back</a></h2>
			<p>&nbsp;</p>
		</div>
	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>