<?php

function mailingAfmeldEmail(string $email): string
{
    $email = strtolower(trim($email));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidArgumentException('Ongeldig e-mailadres.');
    }
    return $email;
}

function mailingAfmeldStatus(PDO $db, string $email): ?array
{
    $stmt = $db->prepare('SELECT token, afgemeld_op FROM mailing_afmeldingen WHERE email = ?');
    $stmt->execute([mailingAfmeldEmail($email)]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row === false ? null : $row;
}

function mailingAfmeldVerzendStatus(PDO $db, int $mailingId): array
{
    $stmt = $db->prepare(
        "SELECT COUNT(*) AS totaal, " .
        "SUM(CASE WHEN (m.tijd_verzonden IS NULL OR m.tijd_verzonden = '') " .
        "AND NOT EXISTS (SELECT 1 FROM mailing_afmeldingen a WHERE a.email = LOWER(TRIM(REPLACE(m.email, CHAR(92), ''))) AND a.afgemeld_op IS NOT NULL) " .
        "THEN 1 ELSE 0 END) AS resterend " .
        "FROM mailing_adressen m WHERE m.mailingId_FK = ?"
    );
    $stmt->execute([$mailingId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function mailingAfmeldToken(PDO $db, string $email): string
{
    $email = mailingAfmeldEmail($email);
    $entry = mailingAfmeldStatus($db, $email);
    if ($entry === null) {
        try {
            $stmt = $db->prepare('INSERT INTO mailing_afmeldingen (email, token) VALUES (?, ?)');
            $stmt->execute([$email, bin2hex(random_bytes(32))]);
        } catch (PDOException $exception) {
            if ($exception->getCode() !== '23000') {
                throw $exception;
            }
        }
        $entry = mailingAfmeldStatus($db, $email);
    }
    if ($entry === null) {
        throw new RuntimeException('Afmeldtoken kon niet worden opgeslagen.');
    }
    if ($entry['afgemeld_op'] !== null) {
        throw new RuntimeException('Dit adres is afgemeld.');
    }
    return $entry['token'];
}

function mailingAfmelden(PDO $db, string $token): bool
{
    if (!preg_match('/\A[a-f0-9]{64}\z/', $token)) {
        return false;
    }
    $stmt = $db->prepare('UPDATE mailing_afmeldingen SET afgemeld_op = COALESCE(afgemeld_op, CURRENT_TIMESTAMP) WHERE token = ?');
    $stmt->execute([$token]);
    $stmt = $db->prepare('SELECT 1 FROM mailing_afmeldingen WHERE token = ?');
    $stmt->execute([$token]);
    return $stmt->fetchColumn() !== false;
}

function mailingAfmeldHeaders($mail, string $body, string $token): string
{
    if (!preg_match('/\A[a-f0-9]{64}\z/', $token) || !str_contains($body, '{afmeldtoken}')) {
        throw new InvalidArgumentException('Ongeldige afmeldlink.');
    }
    $url = 'https://pellegrina.net/algemeen/afmelden.php?token=' . $token;
    if (!$mail->addCustomHeader('List-Unsubscribe', '<' . $url . '>')
        || !$mail->addCustomHeader('List-Unsubscribe-Post', 'List-Unsubscribe=One-Click')) {
        throw new RuntimeException('Afmeldheaders konden niet worden ingesteld.');
    }
    return str_replace('{afmeldtoken}', $token, $body);
}
