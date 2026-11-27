<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"] . '/includes/includes2027.php');
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
	$payment = haalMollieBetalingOp($mollie, $mollie_id, static function () use ($mollieModus) {
		try {
			return maakMollieClient($mollieModus === 'live' ? 'test' : 'live');
		} catch (RuntimeException $exception) {
			error_log('Mollie-configuratie voor eerdere betaling: ' . $exception->getMessage());
			throw $exception;
		}
	});
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

$booking_reference = (string) ($inschrijving['random_id'] ?? '');
if (!preg_match('/^[A-Za-z0-9_-]+$/', $booking_reference)) {
	$retry_webhook('Boekingsreferentie voor de dankmail ontbreekt of is ongeldig.');
}

$language = strtolower((string) $inschrijving['taal']) === 'en' ? 'EN' : 'NL';
$confirmation_sent = (static function ($language, $confirmation_reference, $cursus_offset) {
	$confirmation_internal = true;
	$confirmation_success = false;
	require dirname(__DIR__) . '/' . $language . '/dank.php';
	return $confirmation_success;
})($language, $booking_reference, $cursus_offset);
if (!$confirmation_sent) {
	$retry_webhook('Dankmail kon niet worden verzonden of geregistreerd.');
}

http_response_code(200);
exit;
