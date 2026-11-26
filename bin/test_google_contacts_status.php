<?php

require dirname(__DIR__) . '/includes/google_contacts.php';

function checkContactsStatus(bool $expected, string $message): void
{
    if (google_contacts_is_linked() !== $expected) {
        throw new RuntimeException($message);
    }
}

$_SESSION = [];
checkContactsStatus(false, 'A session without a token must not appear linked.');
$_SESSION['google_contacts_token'] = ['access_token' => 'test', 'expires' => time() + 300];
checkContactsStatus(true, 'A current token must appear linked.');
$_SESSION['google_contacts_token']['expires'] = time() - 300;
checkContactsStatus(false, 'An expired token without a refresh token must not appear linked.');
$_SESSION['google_contacts_token']['refresh_token'] = 'test-refresh';
checkContactsStatus(true, 'A refreshable token must appear linked.');
unset($_SESSION['google_contacts_token']['expires']);
checkContactsStatus(false, 'A token without an expiration must not appear linked.');
$_SESSION['google_contacts_token'] = 'invalid';
checkContactsStatus(false, 'A malformed session token must not appear linked.');

echo "PASS: Google Contacts session status.\n";
