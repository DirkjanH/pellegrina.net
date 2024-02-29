<?php 
($_SERVER["CONTEXT_DOCUMENT_ROOT"]);

Kint::dump($_POST, $_SESSION, $adressen);

require_once $_SERVER["CONTEXT_DOCUMENT_ROOT"].'/vendor/autoload.php';

require $_SERVER["CONTEXT_DOCUMENT_ROOT"].'/includes/LPmailer.inc.php';

//echo require_once $_SERVER["CONTEXT_DOCUMENT_ROOT"].'/vendor/autoload.php';

Kint::dump($_POST, $GLOBALS, $_SERVER);

$mail = new LPMailer;

$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->Debugoutput = 'html';

/* //$mail->isSMTP();                                      // Set mailer to use SMTP
//$mail->Host = 'mail.pellegrina.net';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = false;                               // Enable SMTP authentication
//$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
		);
 */
$mail->Host = 'mail.pellegrina.net';  						// Specify main and backup SMTP servers
$mail->setFrom('dirkjan@pellegrina.net', 'Mailer');
$mail->addAddress('dhorringa@gmail.com', 'DjH');     // Add a recipient
$mail->addReplyTo('info@pellegrina.net', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

Kint::dump($mail);

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has inderdaad been sent';
}
?>