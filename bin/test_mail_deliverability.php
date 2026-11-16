<?php

$_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__);
require $_SERVER['DOCUMENT_ROOT'] . '/includes/mailfuncties.inc.php';

function checkMail($condition, $message) {
    if (!$condition) throw new RuntimeException($message);
}

$html = '<html><head><style>.secret { color: red; }</style></head><body>'
    . '<p>Beste deelnemer,<br>Bekijk <a href="https://pellegrina.net/cursus?a=1&amp;b=2">de cursus</a>.</p>'
    . '<p>Mail <a href="mailto:info@pellegrina.net">info@pellegrina.net</a>.</p></body></html>';

foreach ([
    ['contact@pellegrina.net', 'contact@pellegrina.net', null],
    ['someone@example.org', 'info@pellegrina.net', 'someone@example.org'],
] as [$requested, $expectedFrom, $expectedReplyTo]) {
    $mail = new LPmailer();
    LPmailingAfzender($mail, $requested, 'La Pellegrina');
    $mail->addAddress('recipient@example.invalid');
    $mail->Subject = 'Test';
    $mail->Body = $html;
    $mail->AltBody = LPmailPlainText($mail, $html);
    checkMail($mail->From === $expectedFrom, 'The sender must use the authorized domain.');
    checkMail($mail->Sender === $expectedFrom, 'The envelope sender must match the From address.');
    $replyTo = $mail->getReplyToAddresses();
    checkMail($expectedReplyTo === null ? !$replyTo : ($replyTo[0][0] ?? null) === $expectedReplyTo, 'Reply-To must preserve an external sender.');
    checkMail(str_contains($mail->AltBody, "Beste deelnemer,\nBekijk"), 'Text must preserve line breaks.');
    checkMail(str_contains($mail->AltBody, 'de cursus (https://pellegrina.net/cursus?a=1&b=2)'), 'Text must retain link targets.');
    checkMail(str_contains($mail->AltBody, 'info@pellegrina.net') && !str_contains($mail->AltBody, '.secret'), 'Text must retain content but exclude CSS.');
    checkMail($mail->preSend(), 'The message must compile without contacting a mail server.');
    $mime = $mail->getSentMIMEMessage();
    checkMail(str_contains($mime, 'From: La Pellegrina <' . $expectedFrom . '>'), 'MIME From header is incorrect.');
    checkMail(($expectedReplyTo === null && !str_contains($mime, 'Reply-To:'))
        || ($expectedReplyTo !== null && str_contains($mime, 'Reply-To: La Pellegrina <' . $expectedReplyTo . '>')), 'MIME Reply-To header is incorrect.');
    checkMail(str_contains($mime, 'multipart/alternative') && str_contains($mime, 'text/plain') && str_contains($mime, 'text/html'), 'Both message alternatives must be present.');
}

try {
    LPmailingAfzender(new LPmailer(), "bad@example.org\r\nBcc: other@example.org", 'Test');
    throw new RuntimeException('Invalid sender was accepted.');
} catch (InvalidArgumentException $expected) {
}

echo "PASS: sender alignment, reply address, and text/HTML MIME without sending mail.\n";
