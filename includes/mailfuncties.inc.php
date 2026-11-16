<?php /*
Mailfuncties voor aanmeldingen van pellegrina.net
Auteur: Dirkjan Horringa
Versie: 1.3
*/
	require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
	require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/LPmailer.inc.php');

	use Pelago\Emogrifier\CssInliner;

	function LPmailPlainText($mail, string $html): string
	{
		$html = preg_replace_callback(
			'~<a\b[^>]*\bhref\s*=\s*(["\'])(https?://[^"\']+|mailto:[^"\']+)\1[^>]*>(.*?)</a\s*>~is',
			static function ($match) {
				$label = trim(html_entity_decode(strip_tags($match[3]), ENT_QUOTES, 'UTF-8'));
				$url = html_entity_decode($match[2], ENT_QUOTES, 'UTF-8');
				return $match[3] . ($label === $url || 'mailto:' . $label === $url ? '' : ' (' . $match[2] . ')');
			},
			$html
		);
		$html = preg_replace('/<\s*br\s*\/?\s*>|<\/\s*(?:p|div|li|tr|h[1-6])\s*>/i', "\n", $html);
		return $mail->html2text($html);
	}

	function LPmailingAfzender($mail, string $from, string $name): void
	{
		if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
			throw new InvalidArgumentException('Ongeldig afzenderadres voor de mailing.');
		}
		$domain = strtolower(substr(strrchr($from, '@'), 1));
		$alignedFrom = $domain === 'pellegrina.net' ? $from : 'info@pellegrina.net';
		if (!$mail->setFrom($alignedFrom, $name)) {
			throw new RuntimeException('Afzenderadres voor de mailing kon niet worden ingesteld.');
		}
		if ($alignedFrom !== $from && !$mail->addReplyTo($from, $name)) {
			throw new RuntimeException('Antwoordadres voor de mailing kon niet worden ingesteld.');
		}
	}

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
		$mail->AltBody = LPmailPlainText($mail, $emogrifier);

		$geslaagd = $mail->Send();

		$mail->clearAddresses(); // wis alle adressen uit het systeem, zodat er geen fouten ontstaan bij volgende mails
		return $geslaagd;
	}
	?>