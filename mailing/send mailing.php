<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/includes2027.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/mailing_afmelden.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/mailing_verzenden.php';

function h($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$mailing_nr = filter_input(INPUT_GET, 'mailing', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1],
]);
if (!$mailing_nr) {
    http_response_code(400);
    exit('Ongeldig mailingnummer.');
}

try {
    $stmt = $db->prepare('SELECT * FROM mailing_opdrachten WHERE mailingId = ?');
    $stmt->execute([$mailing_nr]);
    $mailing = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$mailing) {
        http_response_code(404);
        exit('Mailing bestaat niet.');
    }

    if (empty($_SESSION['mailing_csrf'])) {
        $_SESSION['mailing_csrf'] = bin2hex(random_bytes(32));
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!hash_equals($_SESSION['mailing_csrf'], (string) ($_POST['csrf_token'] ?? ''))) {
            http_response_code(403);
            exit('Ongeldige beveiligingstoken.');
        }
        if (!mailingVerzendLock($db)) {
            http_response_code(409);
            exit('De mailingwerker is bezig. Probeer het over enkele ogenblikken opnieuw.');
        }
        try {
            $actie = $_POST['actie'] ?? 'starten';
            if ($actie === 'pauzeren') {
                $stmt = $db->prepare("UPDATE mailing_verzendtaken SET status = 'gepauzeerd' WHERE mailing_id = ? AND status = 'wacht' AND bezig_adres IS NULL");
                $stmt->execute([$mailing_nr]);
                if ($stmt->rowCount() !== 1) throw new RuntimeException('Pauzeren is niet mogelijk; controleer de status van de mailing.');
            } elseif ($actie === 'opnieuw' || $actie === 'registreren') {
                mailingLosOnzekereVerzendingOp($db, $mailing_nr, $actie === 'registreren');
            } elseif ($actie === 'starten') {
                mailingInWachtrij($db, $mailing_nr);
            } else {
                throw new RuntimeException('Ongeldige actie.');
            }
        } finally {
            mailingVerzendUnlock($db);
        }
        header('Location: ' . $_SERVER['PHP_SELF'] . '?mailing=' . $mailing_nr, true, 303);
        exit;
    }

    $mailing_status = mailingAfmeldVerzendStatus($db, $mailing_nr);
    $stmt = $db->prepare('SELECT * FROM mailing_verzendtaken WHERE mailing_id = ?');
    $stmt->execute([$mailing_nr]);
    $taak = $stmt->fetch(PDO::FETCH_ASSOC);
    $onzekerAdres = null;
    if ($taak && $taak['status'] === 'gestopt' && $taak['bezig_adres'] !== null) {
        $stmt = $db->prepare('SELECT email FROM mailing_adressen WHERE mailingId_FK = ? AND mailadresId = ?');
        $stmt->execute([$mailing_nr, $taak['bezig_adres']]);
        $onzekerAdres = $stmt->fetchColumn();
    }
} catch (PDOException | RuntimeException $exception) {
    error_log('Mailingwachtrij niet beschikbaar: ' . $exception->getMessage());
    http_response_code(500);
    exit('De mailingwachtrij is niet beschikbaar. Controleer de installatie en de serverlog.');
}
?>
<!DOCTYPE HTML>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Mailing verzenden</title>
</head>
<body>
    <h3>Mailing-nr: <?= h($mailing_nr) ?>: <?= h($mailing['subject']) ?></h3>
    <p>
        <strong>Totaal aantal mails:</strong> <?= h($mailing_status['totaal']) ?><br>
        <strong>Te verzenden mails:</strong> <?= h($mailing_status['resterend']) ?>
    </p>
    <?php if ($taak && $taak['status'] === 'wacht'): ?>
        <p>De mailing staat in de wachtrij. De server verwerkt deze in blokken van maximaal 40 mails.</p>
        <p>Volgende poging vanaf: <?= h($taak['volgende_poging']) ?>. Ververs deze pagina om de voortgang te bekijken.</p>
        <form method="post" action="<?= h($_SERVER['PHP_SELF']) ?>?mailing=<?= h($mailing_nr) ?>">
            <input type="hidden" name="csrf_token" value="<?= h($_SESSION['mailing_csrf']) ?>">
            <input type="hidden" name="actie" value="pauzeren">
            <button type="submit">Mailing pauzeren</button>
        </form>
    <?php elseif ($taak && $taak['status'] === 'afgerond'): ?>
        <p>Mailing afgehandeld.</p>
    <?php else: ?>
        <?php if ($taak && $taak['status'] === 'gestopt'): ?>
            <p>De verzending is gestopt: <?= h($taak['laatste_fout']) ?></p>
            <?php if ($taak['bezig_adres'] !== null): ?>
                <p>Het is onzeker of het bericht aan <?= h($onzekerAdres ?: 'mailadresId ' . $taak['bezig_adres']) ?> is afgeleverd. Controleer de maillogs en los de fout op voordat je een keuze maakt.</p>
                <form method="post" action="<?= h($_SERVER['PHP_SELF']) ?>?mailing=<?= h($mailing_nr) ?>">
                    <input type="hidden" name="csrf_token" value="<?= h($_SESSION['mailing_csrf']) ?>">
                    <button type="submit" name="actie" value="opnieuw" onclick="return confirm('Opnieuw proberen kan een dubbele mail veroorzaken. Doorgaan?')">Opnieuw proberen en hervatten</button>
                    <button type="submit" name="actie" value="registreren" onclick="return confirm('Alleen kiezen als de mail daadwerkelijk verzonden is. Doorgaan?')">Als verzonden registreren en hervatten</button>
                </form>
            <?php else: ?>
                <p>Los de fout op voordat je de mailing hervat.</p>
            <?php endif; ?>
        <?php elseif ($taak && $taak['status'] === 'gepauzeerd'): ?>
            <p>De mailing is gepauzeerd.</p>
        <?php endif; ?>
        <?php if (!$taak || $taak['bezig_adres'] === null): ?>
            <form method="post" action="<?= h($_SERVER['PHP_SELF']) ?>?mailing=<?= h($mailing_nr) ?>">
                <input type="hidden" name="csrf_token" value="<?= h($_SESSION['mailing_csrf']) ?>">
                <button type="submit"><?= $taak ? 'Mailing hervatten' : 'Mailing starten' ?></button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
    <p>Je kunt deze pagina sluiten zodra de geplande taak op de server is ingesteld.</p>
</body>
</html>
