<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Google\Cloud\ResourceManager\V3\ContactsServiceClient;

/**
 * Example:
 * ```
 * list_contacts($projectId);
 * ```
 *
 * @param string $projectId Your Cloud Project ID
 */
function list_contacts(string $projectId): void
{
    // Instantiate a client.
    $client = new ContactsServiceClient();

    $formattedParent = $client->projectName($projectId);
    $response = $client->listContacts($formattedParent);

    // Print the contacts.
    $contacts = $response->iterateAllElements();
    foreach ($contacts as $contact) {
        printf('Contact: %s' . PHP_EOL, $contact->getName());
    }
}  
?>