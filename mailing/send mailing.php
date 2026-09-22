<?php
// Toon interne foutdetails nooit aan bezoekers van dit verzendendpoint.
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

//Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2027.php');
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/includes/mailfuncties.inc.php';

Kint::$enabled_mode = false;

/**
 * simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same when encrypting and decrypting
 * 
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
 *
 * @return string
 */
function encrypt_decrypt($action, $string)
{
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$secret_key = 'Mach a Šebestová';
	$secret_iv = 'Sudoměřice u Bechyně';
	// hash
	$key = hash('sha256', $secret_key);

	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ($action == 'encrypt') {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if ($action == 'decrypt') {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
}

function h($value)
{
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/* Set locale to Dutch */
setlocale(LC_ALL, 'nl_NL');
date_default_timezone_set('Europe/Amsterdam');

$refreshrate = 15 * 60; // 15 minuten
$blokgrootte = 40;
$smtp_timeout = 20; // Voorkom dat een onbereikbare SMTP-server de aanvraag minuten blokkeert.
set_time_limit(120); // Een batch mag nooit onbeperkt lang blijven draaien.

$mailing_opdrachten = 'mailing_opdrachten';
$mailing_adressen = 'mailing_adressen';
$mailing_tekst = 'messages';

// Valideer de identifier voordat deze verderop in queries wordt gebruikt.
$mailing_nr = filter_input(INPUT_GET, 'mailing', FILTER_VALIDATE_INT, [
	'options' => ['min_range' => 1],
]);
if ($mailing_nr === false || $mailing_nr === null) {
	http_response_code(400);
	exit('Ongeldig mailingnummer.');
}

$stmt = $db->prepare("SELECT * FROM {$mailing_opdrachten} WHERE mailingId = :mailing LIMIT 1");
$stmt->execute(['mailing' => $mailing_nr]);
$mailing = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$mailing) {
	http_response_code(404);
	exit('Mailing bestaat niet.');
}

if (empty($_SESSION['mailing_csrf'])) {
	$_SESSION['mailing_csrf'] = bin2hex(random_bytes(32));
}

// Een GET-request mag alleen de bevestigingspagina tonen; POST start het verzenden.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
?>
	<!DOCTYPE HTML>
	<html lang="nl">

	<head>
		<meta charset="utf-8">
		<title>Mailing verzenden</title>
	</head>

	<body>
		<h3>Mailing-nr: <?= h($mailing_nr) ?>: <?= h($mailing['subject']) ?></h3>
		<p>Controleer de mailing voordat deze wordt verzonden.</p>
		<form method="post"
			action="<?= h($_SERVER['PHP_SELF']) ?>?mailing=<?= h($mailing_nr) ?>">
			<input type="hidden" name="csrf_token"
				value="<?= h($_SESSION['mailing_csrf']) ?>">
			<button type="submit">Mailing verzenden</button>
		</form>
	</body>

	</html><?php
			exit;
		}

		$csrf_token = (string) ($_POST['csrf_token'] ?? '');
		if (!hash_equals((string) $_SESSION['mailing_csrf'], $csrf_token)) {
			http_response_code(403);
			exit('Ongeldige beveiligingstoken.');
		}

		$message = $mailing['message'];
		$eerder_verzonden_mails = $mailing['verzonden_mails'];
		$blokNr = (int) floor($eerder_verzonden_mails / $blokgrootte);

		$stmt = $db->prepare("SELECT * FROM {$mailing_adressen} WHERE mailingId_FK = :mailing ORDER BY mailadresId");
		$stmt->execute(['mailing' => $mailing_nr]);
		$adressen = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$aantal_emails = count($adressen);

		$regel_bericht = '';
		$refresh = false;
		if ($eerder_verzonden_mails < $aantal_emails) $refresh = true;
			?>
<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<title>Verzend mailing</title>
</head>

<body> <?php
		echo '<h3>Mailing-nr: ' . h($mailing_nr) . ': ' . h($mailing['tijd_aanmaak']) . ' - <span style="color: teal;">' . h($mailing['subject']) . '</span>. Aantal mailadressen: ' . h($aantal_emails) . '</h3>';

		$Subject 			= stripslashes($mailing['subject']);
		$mail_text 			= stripslashes($message);
		$cc = !empty($mailing['CC']);

		echo $start_bericht = '+++++++++ ' . date('d/m H:i') . ' Startbericht: tot nu toe verzonden = ' . $eerder_verzonden_mails . '; Bloknr. = ' . $blokNr . '<br><br>';

		$verzonden_mails = (int) $mailing['verzonden_mails'];
		$blok_verzonden = 0;

		foreach ($adressen as $nr => $adres) {
			if ($blok_verzonden < $blokgrootte && empty($adres['tijd_verzonden'])) {
				$encrypt = '';
				if ($adres['DlnmrId'] != '') $encrypt = encrypt_decrypt('encrypt', $adres['DlnmrId']);
				$mail = new LPmailer();
				// PHPMailer gebruikt standaard 300 seconden; dat is te lang voor een webaanvraag.
				$mail->Timeout = $smtp_timeout;
				$mail->Subject = $Subject;
				$from = filter_var($mailing['From'], FILTER_VALIDATE_EMAIL);
				$recipient = filter_var(stripslashes($adres['email']), FILTER_VALIDATE_EMAIL);
				if (!$from || !$recipient) {
					$regel_bericht .= 'Ongeldig e-mailadres overgeslagen.<br>';
					continue;
				}
				$mail->SetFrom($from, stripslashes($mailing['FromName']));
				$mail->AddAddress($recipient, stripslashes($adres['naam']));
				$mail_body = $mail_text;
				if (isset($adres['voornaam']) and $adres['voornaam'] != '') $mail_body = str_replace("{voornaam}", $adres['voornaam'], $mail_text);
				if (isset($adres['naam']) and $adres['naam'] != '') $mail_body = str_replace("{naam}", $adres['naam'], $mail_body);
				if (isset($adres['cursus']) and $adres['cursus'] != '') $mail_body = str_replace("{cursus}", $adres['cursus'], $mail_body);
				if (isset($adres['password']) and $adres['password'] != '') $mail_body = str_replace("{password}", $adres['password'], $mail_body);
				$mail_body = str_replace("DlnmrIdx", $encrypt, $mail_body);
				$tracker = 'https://pellegrina.net/mailing/volg/volg.php?kenmerk=' . urlencode($adres['kenmerk']);
				$mail_body = str_replace('</body>', '<img src="' . h($tracker) . '" border="0" alt=""/></body>', $mail_body);

				if ($cc) $mail->AddCC("info@pellegrina.net", "LP PHP mailer");
				$mail->Body  = $mail_body;
				$mail->AltBody = strip_tags($mail_body);

				if (!$mail->Send()) {
					$bericht = "Bericht aan " . h($adres['naam']) . " kon niet verzonden worden.<br>";
					$bericht .= "De fout is intern gelogd.<br>";
					echo $bericht;
					$regel_bericht .= $bericht;
					// Een transportfout geldt voor de hele SMTP-verbinding; probeer niet 39 keer opnieuw.
					break;
				} else {
					$verzonden_mails++;
					$blok_verzonden++;
					$bericht = "Bericht aan " . h($adres['naam']) . " (nr. {$verzonden_mails}) verzonden.<br>";
					echo $bericht;
					$regel_bericht .= $bericht;
					$updateAdres = $db->prepare("UPDATE {$mailing_adressen} SET tijd_verzonden = NOW() WHERE mailadresId = :adres");
					$updateAdres->execute(['adres' => (int) $adres['mailadresId']]);
				}
				echo 'Totaal aantal mails: ' . $verzonden_mails . ' tot nu toe verzonden.<br>';
			}
		}

		$blokNr = (int) ceil($verzonden_mails / $blokgrootte);
		$blok_bericht = '========= ' . date('d/m H:i') . ' Blok nr. ' . $blokNr . ' verzonden.<br>';
		$blok_bericht .= 'Refresh: ' . $refresh . '; verzonden: ' . $verzonden_mails . '; totaal aantal mails: ' . $aantal_emails;

		echo ' <br>' . $blok_bericht . '<br>';
		if ($verzonden_mails >= $aantal_emails) {
			$slot_bericht = '<br>********* ' . date('d/m H:i') . ' <span style="color: red;">Mailing verzonden</span><br>';
			echo $slot_bericht;
		} elseif ($refresh) {
			// Ga na een pauze verder met het volgende blok via POST, inclusief CSRF-token.
			echo '<form id="volgende-blok" method="post" action="' . h($_SERVER['PHP_SELF']) . '?mailing=' . h($mailing_nr) . '">';
			echo '<input type="hidden" name="csrf_token" value="' . h($_SESSION['mailing_csrf']) . '">';
			echo '<button type="submit">Volgende blok verzenden</button></form>';
			echo '<script>setTimeout(function () { document.getElementById("volgende-blok").submit(); }, ' . ($refreshrate * 1000) . ');</script>';
		}
		$bb = strip_tags(($start_bericht ?? '') . '\r\n' . ($regel_bericht ?? '') . '\r\n' . ($blok_bericht ?? '') . '\r\n' . ($slot_bericht ?? ''));
		try {
			// Gebruik parameters, omdat ook de logtekst apostrofs of speciale tekens kan bevatten.
			$updateMailing = $db->prepare("UPDATE {$mailing_opdrachten} SET verzonden_mails = :verzonden, `log` = CONCAT(`log`, :log) WHERE mailingId = :mailing");
			$updateMailing->execute([
				'verzonden' => $verzonden_mails,
				'log' => $bb,
				'mailing' => $mailing_nr,
			]);
		} catch (PDOException $e) {
			error_log('Mailinglog kon niet worden bijgewerkt: ' . $e->getMessage());
			echo 'Log niet geschreven.<br>';
		}
		?> </body>

</html>