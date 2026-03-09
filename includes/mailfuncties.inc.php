<!--
Mailfuncties voor aanmeldingen van pellegrina.net
Auteur: Dirkjan Horringa
Versie: 1.3
--> <?php
	require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
	require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/LPmailer.inc.php');

	use Pelago\Emogrifier\CssInliner;

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