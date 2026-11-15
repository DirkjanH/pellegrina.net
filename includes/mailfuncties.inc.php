<?php /*
Mailfuncties voor aanmeldingen van pellegrina.net
Auteur: Dirkjan Horringa
Versie: 1.3
*/
	require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
	require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/LPmailer.inc.php');

	use Pelago\Emogrifier\CssInliner;

	function LPconfirmationSent(int $inschrijving_id, bool $payment_failed = false): bool
	{
		$column = $payment_failed ? 'mislukkingsmail_verzonden' : 'dankmail_verzonden';
		$inschrijving = select_query(
			"SELECT {$column} FROM inschrijving WHERE InschId = " . $inschrijving_id,
			1
		);
		if (!is_array($inschrijving)) {
			throw new RuntimeException('Verzendstatus van de betalingsmail kon niet worden opgehaald.');
		}
		$verzonden = $inschrijving[$column] ?? null;
		return !empty($verzonden) && !in_array($verzonden, ['0000-00-00', '0000-00-00 00:00:00', '0'], true);
	}

	function LPmail($to, $toname, $subject, $message, $from, $fromname)
	{
		$css = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/css/mailing.css');
		$emogrifier = CssInliner::fromHtml($message)->inlineCss($css)->render();

		d($emogrifier);

		$mail = new LPmailer();
		$mail->AddAddress($to, $toname);
		if (isset($from) and $from != '') $mail->SetFrom($from, $fromname);
		$mail->AddBCC('info@pellegrina.net', 'LP Aanmelding');
		$mail->Subject = $subject;
		$mail->Body  = $emogrifier;
		$mail->AltBody = strip_tags($emogrifier);

		$geslaagd = $mail->Send();

		$mail->clearAddresses(); // wis alle adressen uit het systeem, zodat er geen fouten ontstaan bij volgende mails
		return $geslaagd;
	}
	?>