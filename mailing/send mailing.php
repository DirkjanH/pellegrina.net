<?php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    header('Allow: GET');
    exit('Gebruik de mailingstatistieken om de verzending te beheren.');
}

$mailing = filter_input(INPUT_GET, 'mailing', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1],
]);
if (!$mailing) {
    http_response_code(400);
    exit('Ongeldig mailingnummer.');
}

header('Location: statistiek_mailing.php?mailing=' . $mailing, true, 302);
exit;
