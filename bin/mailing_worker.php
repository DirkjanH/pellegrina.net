<?php

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('Alleen beschikbaar via de opdrachtregel.');
}

$_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__);
date_default_timezone_set('Europe/Amsterdam');
require $_SERVER['DOCUMENT_ROOT'] . '/connections/connect_PDO.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/mailfuncties.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/mailing_afmelden.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/mailing_verzenden.php';

try {
    mailingVerwerkWachtrij($db, static fn() => new LPmailer());
} catch (Throwable $exception) {
    error_log('Mailingwerker mislukt: ' . $exception->getMessage());
    exit(1);
}
