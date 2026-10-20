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

try {
	$payment = $mollie->payments->get($mollie_id);
} catch (Throwable $exception) {
	error_log('Mollie-webhook kon betaling niet ophalen: ' . $exception->getMessage());
	http_response_code(503);
	exit('Betalingsstatus tijdelijk niet beschikbaar.');
}

$definitief_mislukt = in_array($payment->status, ['failed', 'expired', 'canceled'], true);
$definitief_betaald = $payment->status === 'paid';
if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
	$betaal_query = "UPDATE inschrijving
		SET betaalstatus = " . quote($payment->status) . ", aanbetaling = NOW(), aanbet_bedrag = " . quote($payment->amount->value) . ", aangenomen = 1
		WHERE Mollie_ID = {$mollie_id_sql}";
	if (!exec_query($betaal_query)) {
		http_response_code(503);
		exit('Betalingsstatus kon tijdelijk niet worden opgeslagen.');
	}
} elseif ($definitief_mislukt) {
	$betaal_query = "UPDATE inschrijving SET betaalstatus = " . quote($payment->status) . " WHERE Mollie_ID = {$mollie_id_sql}";
	if (!exec_query($betaal_query)) {
		http_response_code(503);
		exit('Betalingsstatus kon tijdelijk niet worden opgeslagen.');
	}

	$mail_sent_dir = $_SERVER['DOCUMENT_ROOT'] . '/mail_sent';
	if (!is_dir($mail_sent_dir) && !mkdir($mail_sent_dir, 0775, true) && !is_dir($mail_sent_dir)) {
		error_log('Mollie-foutmail kon niet worden klaargezet: mail_sent-map is niet beschikbaar.');
		http_response_code(503);
		exit('Foutmelding kan tijdelijk niet worden verzonden.');
	}

	$mail_key = preg_replace('/[^A-Za-z0-9_-]/', '', $mollie_id);
	$mail_marker = $mail_sent_dir . '/payment-failure-' . $mail_key . '.sent';
	$mail_lock = fopen($mail_marker . '.lock', 'c');
	if ($mail_lock === false || !flock($mail_lock, LOCK_EX)) {
		if (is_resource($mail_lock)) fclose($mail_lock);
		error_log('Mollie-foutmail kon niet worden vergrendeld voor betaling ' . $mail_key);
		http_response_code(503);
		exit('Foutmelding kan tijdelijk niet worden verzonden.');
	}

	$mail_verzonden = true;
	if (!is_file($mail_marker)) {
		$naam = htmlspecialchars((string) $inschrijving['naam'], ENT_QUOTES, 'UTF-8');
		$voornaam = htmlspecialchars((string) $inschrijving['voornaam'], ENT_QUOTES, 'UTF-8');
		$status = htmlspecialchars((string) $payment->status, ENT_QUOTES, 'UTF-8');
		$inschrijving_nr = (int) $inschrijving['InschId'];
		if (strtolower((string) $inschrijving['taal']) === 'en') {
			$subject = 'Payment failed for your La Pellegrina registration';
			$message = "<p>Dear {$voornaam},</p><p>Mollie has definitively reported your deposit payment for registration {$inschrijving_nr} as failed (status: {$status}). No payment confirmation was received.</p><p>Please contact <a href=\"mailto:aanmelding@pellegrina.net\">aanmelding@pellegrina.net</a> if you need help completing your registration.</p><p>Kind regards,<br>La Pellegrina</p>";
		} else {
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
			error_log('Mollie-foutmail verzonden maar marker kon niet worden opgeslagen voor betaling ' . $mail_key);
			$mail_verzonden = false;
		}
	}

	flock($mail_lock, LOCK_UN);
	fclose($mail_lock);
	if (!$mail_verzonden) {
		error_log('Mollie-foutmail niet verzonden voor betaling ' . $mail_key);
		http_response_code(503);
		exit('Foutmelding kan tijdelijk niet worden verzonden.');
	}
}

if (!$definitief_betaald && !$definitief_mislukt) {
	error_log('Mollie-webhook wacht op definitieve betalingsstatus voor betaling ' . $mollie_id . ' (status: ' . $payment->status . ').');
	http_response_code(503);
	exit('Betalingsstatus nog niet definitief.');
}

http_response_code(200);
exit;
