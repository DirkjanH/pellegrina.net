<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"] . '/includes/includes2025.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/includes/mollie.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/includes/mailfuncties.inc.php');

Kint::$enabled_mode = false;

$mollie_id = $_POST['id'] ?? $_GET['mollie_id'] ?? '';
if (!is_string($mollie_id) || !preg_match('/^tr_[A-Za-z0-9]+$/', $mollie_id)) {
	http_response_code(400);
	exit('Geen geldige ID voor Mollie.');
}

$mollie_id_sql = quote($mollie_id);
$inschrijving = select_query(
	"SELECT i.*, d.email, d.naam, d.voornaam, d.taal
	 FROM inschrijving AS i
	 INNER JOIN dlnmr AS d ON d.DlnmrId = i.DlnmrId_FK
	 WHERE i.Mollie_ID = {$mollie_id_sql}
	 LIMIT 1",
	1
);
if (!$inschrijving) {
	http_response_code(404);
	exit('Deze boeking bestaat niet in de tabel.');
}

$mail_sent_dir = $_SERVER['DOCUMENT_ROOT'] . '/mail_sent';
if (!is_dir($mail_sent_dir) && !mkdir($mail_sent_dir, 0775, true) && !is_dir($mail_sent_dir)) {
	error_log('Mollie-webhook kon mail_sent-map niet aanmaken.');
	http_response_code(503);
	exit('Webhookstatus kan tijdelijk niet worden opgeslagen.');
}

$mail_key = preg_replace('/[^A-Za-z0-9_-]/', '', $mollie_id);
$attempt_file = $mail_sent_dir . '/payment-webhook-' . $mail_key . '.attempts';
$attempt_lock = fopen($attempt_file . '.lock', 'c');
if ($attempt_lock === false || !flock($attempt_lock, LOCK_EX)) {
	if (is_resource($attempt_lock)) fclose($attempt_lock);
	error_log('Mollie-webhookpoging kon niet worden vergrendeld voor betaling ' . $mail_key);
	http_response_code(503);
	exit('Webhookstatus kan tijdelijk niet worden opgeslagen.');
}

$previous_attempts = is_file($attempt_file) ? (int) file_get_contents($attempt_file) : 0;
$attempts_exhausted_before_request = $previous_attempts >= 5;
$attempt_count = min($previous_attempts + 1, 5);
$attempts_saved = file_put_contents($attempt_file, (string) $attempt_count, LOCK_EX) !== false;
flock($attempt_lock, LOCK_UN);
fclose($attempt_lock);
if (!$attempts_saved) {
	error_log('Mollie-webhookpoging kon niet worden opgeslagen voor betaling ' . $mail_key);
	http_response_code(503);
	exit('Webhookstatus kan tijdelijk niet worden opgeslagen.');
}

$retry_webhook = static function ($message) use ($mail_key, $attempt_count, $attempts_exhausted_before_request) {
	error_log('Mollie-webhook tijdelijk mislukt voor betaling ' . $mail_key . ' (poging ' . $attempt_count . '/5): ' . $message);
	if ($attempts_exhausted_before_request) {
		http_response_code(200);
		exit('Maximumaantal webhookpogingen is bereikt.');
	}
	http_response_code(503);
	exit($attempt_count >= 5 ? 'Maximumaantal webhookpogingen bereikt; betalingsstatus is niet definitief.' : $message);
};

try {
	$payment = $mollie->payments->get($mollie_id);
} catch (Throwable $exception) {
	$retry_webhook('Betalingsstatus tijdelijk niet beschikbaar.');
}

$definitief_mislukt = in_array($payment->status, ['failed', 'expired', 'canceled'], true);
$definitief_betaald = $payment->status === 'paid';
if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
	$betaal_query = "UPDATE inschrijving
		SET betaalstatus = " . quote($payment->status) . ", aanbetaling = NOW(), aanbet_bedrag = " . quote($payment->amount->value) . ", aangenomen = 1
		WHERE Mollie_ID = {$mollie_id_sql}";
	if (!exec_query($betaal_query)) {
		$retry_webhook('Betalingsstatus kon tijdelijk niet worden opgeslagen.');
	}
} elseif ($definitief_mislukt) {
	$betaal_query = "UPDATE inschrijving SET betaalstatus = " . quote($payment->status) . " WHERE Mollie_ID = {$mollie_id_sql}";
	if (!exec_query($betaal_query)) {
		$retry_webhook('Betalingsstatus kon tijdelijk niet worden opgeslagen.');
	}

}

$definitieve_status = $definitief_betaald || $definitief_mislukt;
if (!$definitieve_status) {
	$retry_webhook('Betalingsstatus nog niet definitief (status: ' . $payment->status . ').');
}

$mail_type = $definitief_betaald ? 'confirmation' : 'failure';
$mail_marker = $mail_sent_dir . '/payment-' . $mail_type . '-' . $mail_key . '.sent';
$mail_lock = fopen($mail_marker . '.lock', 'c');
if ($mail_lock === false || !flock($mail_lock, LOCK_EX)) {
	if (is_resource($mail_lock)) fclose($mail_lock);
	$retry_webhook('Mailstatus kon niet worden vergrendeld.');
}

$mail_verzonden = true;
if (!is_file($mail_marker)) {
	$naam = htmlspecialchars((string) $inschrijving['naam'], ENT_QUOTES, 'UTF-8');
	$voornaam = htmlspecialchars((string) $inschrijving['voornaam'], ENT_QUOTES, 'UTF-8');
	$inschrijving_nr = (int) $inschrijving['InschId'];
	if ($definitief_betaald) {
		if (strtolower((string) $inschrijving['taal']) === 'en') {
			$subject = 'Payment received for your La Pellegrina registration';
			$message = "<p>Dear {$voornaam},</p><p>Mollie has confirmed receipt of your deposit payment for registration {$inschrijving_nr}. Your registration is confirmed.</p><p>Kind regards,<br>La Pellegrina</p>";
		} else {
			$subject = 'Betaling ontvangen voor je inschrijving bij La Pellegrina';
			$message = "<p>Beste {$voornaam},</p><p>Mollie heeft de ontvangst van je aanbetaling voor inschrijving {$inschrijving_nr} bevestigd. Je inschrijving is bevestigd.</p><p>Met muzikale groet,<br>La Pellegrina</p>";
		}
	} elseif (strtolower((string) $inschrijving['taal']) === 'en') {
		$status = htmlspecialchars((string) $payment->status, ENT_QUOTES, 'UTF-8');
		$subject = 'Payment failed for your La Pellegrina registration';
		$message = "<p>Dear {$voornaam},</p><p>Mollie has definitively reported your deposit payment for registration {$inschrijving_nr} as failed (status: {$status}). No payment confirmation was received.</p><p>Please contact <a href=\"mailto:aanmelding@pellegrina.net\">aanmelding@pellegrina.net</a> if you need help completing your registration.</p><p>Kind regards,<br>La Pellegrina</p>";
	} else {
		$status = htmlspecialchars((string) $payment->status, ENT_QUOTES, 'UTF-8');
		$subject = 'Betaling mislukt voor je inschrijving bij La Pellegrina';
		$message = "<p>Beste {$voornaam},</p><p>Mollie heeft de betaling van je aanbetaling voor inschrijving {$inschrijving_nr} definitief als mislukt gemeld (status: {$status}). We hebben geen betalingsbevestiging ontvangen.</p><p>Neem contact op met <a href=\"mailto:aanmelding@pellegrina.net\">aanmelding@pellegrina.net</a> als je hulp nodig hebt bij het afronden van je inschrijving.</p><p>Met muzikale groet,<br>La Pellegrina</p>";
	}

	$mail_verzonden = LPmail(
		(string) $inschrijving['email'],
		(string) $inschrijving['naam'],
		$subject,
		$message,
		'aanmelding@pellegrina.net',
		'LP Aanmelding'
	);
	if ($mail_verzonden && file_put_contents($mail_marker, date('c'), LOCK_EX) === false) {
		error_log('Mollie-mail verzonden maar marker kon niet worden opgeslagen voor betaling ' . $mail_key);
		$mail_verzonden = false;
	}
}

flock($mail_lock, LOCK_UN);
fclose($mail_lock);
if (!$mail_verzonden) {
	$retry_webhook('Mail kon niet worden verzonden.');
}

if ($definitief_betaald && !exec_query("UPDATE inschrijving SET dankmail_verzonden = NOW() WHERE Mollie_ID = {$mollie_id_sql}")) {
	$retry_webhook('Verzendstatus van de bevestigingsmail kon niet worden opgeslagen.');
}

http_response_code(200);
exit;
