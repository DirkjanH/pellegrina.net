<?php

use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Token\AccessToken;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

function google_contacts_config(): array
{
    $configFile = '/var/www/vhosts/horringa.net/private/google_contacts.php';
    $config = is_readable($configFile) ? require $configFile : [];

    if (!is_array($config)) {
        throw new RuntimeException('Google Contacts-configuratie is ongeldig.');
    }

    $config += [
        'clientId' => getenv('GOOGLE_CLIENT_ID') ?: '',
        'clientSecret' => getenv('GOOGLE_CLIENT_SECRET') ?: '',
        'redirectUri' => getenv('GOOGLE_CONTACTS_REDIRECT_URI') ?: '',
    ];

    foreach (['clientId', 'clientSecret', 'redirectUri'] as $key) {
        if ($config[$key] === '') {
            throw new RuntimeException('Google Contacts-configuratie ontbreekt: ' . $key);
        }
    }

    return $config;
}

function google_contacts_provider(): Google
{
    $config = google_contacts_config();
    $clientId = $config['clientId'];
    if (!str_contains($clientId, '.apps.googleusercontent.com')) {
        throw new RuntimeException('Google clientId lijkt geen OAuth-client-ID te zijn.');
    }

    return new Google([
        'clientId' => $clientId,
        'clientSecret' => $config['clientSecret'],
        'redirectUri' => $config['redirectUri'],
    ]);
}

function google_contacts_authorization_url(): string
{
    $provider = google_contacts_provider();
    $authorizationUrl = $provider->getAuthorizationUrl([
        'scope' => ['https://www.googleapis.com/auth/contacts.readonly'],
        'access_type' => 'offline',
        'approval_prompt' => 'force',
    ]);
    $_SESSION['google_contacts_oauth_state'] = $provider->getState();
    setcookie('google_contacts_oauth_state', $provider->getState(), [
        'expires' => time() + 600,
        'path' => '/mailing',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    return $authorizationUrl;
}

function google_contacts_access_token(): string
{
    if (empty($_SESSION['google_contacts_token'])) {
        throw new RuntimeException('Google Contacts is nog niet gekoppeld.');
    }

    $token = new AccessToken($_SESSION['google_contacts_token']);
    if ($token->hasExpired()) {
        if (!$token->getRefreshToken()) {
            throw new RuntimeException('De Google Contacts-koppeling is verlopen; autoriseer opnieuw.');
        }
        $token = google_contacts_provider()->getAccessToken('refresh_token', [
            'refresh_token' => $token->getRefreshToken(),
        ]);
        $_SESSION['google_contacts_token'] = $token->jsonSerialize();
    }

    return $token->getToken();
}

function google_contacts_request(string $endpoint, array $parameters = []): array
{
    $client = new Client(['timeout' => 30]);
    try {
        $response = $client->get(
            'https://people.googleapis.com/v1/' . ltrim($endpoint, '/'),
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . google_contacts_access_token(),
                ],
                'query' => $parameters,
            ]
        );
        $data = json_decode((string) $response->getBody(), true);
    } catch (GuzzleException $exception) {
        $status = 0;
        $body = $exception->getMessage();
        if ($exception instanceof RequestException && $exception->hasResponse()) {
            $status = $exception->getResponse()->getStatusCode();
            $body = (string) $exception->getResponse()->getBody();
        }
        throw new RuntimeException('Google People API-fout (' . $status . '): ' . $body, 0, $exception);
    }

    $response = $data;
    if (!is_array($response)) {
        throw new RuntimeException('Google People API gaf geen geldige JSON terug.');
    }

    return $response;
}

function google_contacts_groups(): array
{
    $groups = [];
    $pageToken = null;
    do {
        $parameters = [
            'pageSize' => 1000,
            'groupFields' => 'name,resourceName',
        ];
        if ($pageToken) {
            $parameters['pageToken'] = $pageToken;
        }
        $response = google_contacts_request('contactGroups', $parameters);
        foreach ($response['contactGroups'] ?? [] as $group) {
            if (!empty($group['name']) && !empty($group['resourceName'])) {
                $groups[$group['name']] = $group['resourceName'];
            }
        }
        $pageToken = $response['nextPageToken'] ?? null;
    } while ($pageToken);

    return $groups;
}

function google_contacts_read(string $group = ''): array
{
    $groups = google_contacts_groups();
    $groupNames = array_flip($groups);
    $groupResourceName = '';
    if ($group !== '') {
        if (!isset($groups[$group])) {
            return [];
        }
        $groupResourceName = $groups[$group];
    }

    $contacts = [];
    $pageToken = null;
    do {
        $parameters = [
            'pageSize' => 1000,
            'personFields' => 'names,emailAddresses,addresses,memberships',
            'sortOrder' => 'LAST_NAME_ASCENDING',
        ];
        if ($pageToken) {
            $parameters['pageToken'] = $pageToken;
        }
        $response = google_contacts_request('people/me/connections', $parameters);
        foreach ($response['connections'] ?? [] as $person) {
            $memberships = $person['memberships'] ?? [];
            $inGroup = $groupResourceName === '';
            foreach ($memberships as $membership) {
                if (($membership['contactGroupMembership']['contactGroupResourceName'] ?? '') === $groupResourceName) {
                    $inGroup = true;
                    break;
                }
            }
            if (!$inGroup) {
                continue;
            }

            $labels = [];
            foreach ($memberships as $membership) {
                $resourceName = $membership['contactGroupMembership']['contactGroupResourceName'] ?? '';
                if (isset($groupNames[$resourceName])) {
                    $labels[] = $groupNames[$resourceName];
                }
            }
            if (in_array('Geen folders', $labels, true)) {
                continue;
            }

            $email = '';
            foreach ($person['emailAddresses'] ?? [] as $emailAddress) {
                if (filter_var($emailAddress['value'] ?? '', FILTER_VALIDATE_EMAIL)) {
                    $email = $emailAddress['value'];
                    break;
                }
            }
            if ($email === '') {
                continue;
            }

            $name = $person['names'][0] ?? [];
            $address = $person['addresses'][0] ?? [];
            $contacts[] = [
                'naam' => $name['displayName'] ?? $email,
                'voornaam' => $name['givenName'] ?? '',
                'email' => $email,
                'postcode' => $address['postalCode'] ?? '',
                'groep' => implode(', ', $labels),
            ];
        }
        $pageToken = $response['nextPageToken'] ?? null;
    } while ($pageToken);

    return $contacts;
}
