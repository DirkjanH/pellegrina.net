<?php

function mailingVerzendLock(PDO $db): bool
{
    $result = $db->query("SELECT GET_LOCK('pellegrina_mailing_worker', 0)")->fetchColumn();
    if ($result === null || $result === false) throw new RuntimeException('De mailingvergrendeling is niet beschikbaar.');
    return (int) $result === 1;
}

function mailingVerzendUnlock(PDO $db): void
{
    $db->query("SELECT RELEASE_LOCK('pellegrina_mailing_worker')");
}

function mailingControleerOpslag(PDO $db): void
{
    if ($db->getAttribute(PDO::ATTR_DRIVER_NAME) !== 'mysql') return;
    $stmt = $db->query("SELECT TABLE_NAME, ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME IN ('mailing_adressen', 'mailing_opdrachten', 'mailing_verzendtaken', 'mailing_verzendklok')");
    $engines = [];
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $engines[strtolower($row['TABLE_NAME'])] = strtolower($row['ENGINE'] ?? '');
    }
    foreach (['mailing_adressen', 'mailing_opdrachten', 'mailing_verzendtaken', 'mailing_verzendklok'] as $table) {
        if (($engines[$table] ?? '') !== 'innodb') {
            throw new RuntimeException('Tabel ' . $table . ' ontbreekt of gebruikt geen InnoDB; verzending is gestopt.');
        }
    }
}

function mailingInWachtrij(PDO $db, int $mailingId): void
{
    $stmt = $db->prepare('SELECT status, bezig_adres FROM mailing_verzendtaken WHERE mailing_id = ?');
    $stmt->execute([$mailingId]);
    $taak = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($taak === false) {
        $stmt = $db->prepare('INSERT INTO mailing_verzendtaken (mailing_id, status, volgende_poging) VALUES (?, ?, ?)');
        $stmt->execute([$mailingId, 'wacht', date('Y-m-d H:i:s')]);
    } elseif ($taak['bezig_adres'] !== null) {
        throw new RuntimeException('Controleer eerst de onzekere verzending.');
    } elseif ($taak['status'] !== 'wacht') {
        // Behoud de eerdere volgende_poging, ook na een handmatige hervatting.
        $stmt = $db->prepare('UPDATE mailing_verzendtaken SET status = ?, laatste_fout = NULL WHERE mailing_id = ?');
        $stmt->execute(['wacht', $mailingId]);
    }
}

function mailingLosOnzekereVerzendingOp(PDO $db, int $mailingId, bool $alsVerzonden): void
{
    $db->beginTransaction();
    try {
        $stmt = $db->prepare('SELECT bezig_adres FROM mailing_verzendtaken WHERE mailing_id = ? AND status = ?');
        $stmt->execute([$mailingId, 'gestopt']);
        $adresId = $stmt->fetchColumn();
        if ($adresId === false || $adresId === null) throw new RuntimeException('Er is geen onzekere verzending om te verwerken.');
        if ($alsVerzonden) {
            $stmt = $db->prepare("UPDATE mailing_adressen SET tijd_verzonden = ? WHERE mailadresId = ? AND mailingId_FK = ? AND (tijd_verzonden IS NULL OR tijd_verzonden = '')");
            $stmt->execute([date('Y-m-d H:i:s'), $adresId, $mailingId]);
            if ($stmt->rowCount() !== 1) throw new RuntimeException('De ontvanger kon niet als verzonden worden geregistreerd.');
            $stmt = $db->prepare('UPDATE mailing_opdrachten SET verzonden_mails = verzonden_mails + 1 WHERE mailingId = ?');
            $stmt->execute([$mailingId]);
        }
        $stmt = $db->prepare('UPDATE mailing_verzendtaken SET bezig_adres = NULL, status = ?, laatste_fout = NULL WHERE mailing_id = ?');
        $stmt->execute(['wacht', $mailingId]);
        $db->commit();
    } catch (Throwable $exception) {
        if ($db->inTransaction()) $db->rollBack();
        throw $exception;
    }
}

function mailingVerzendBlok(PDO $db, int $mailingId, callable $maakMailer): void
{
    $stmt = $db->prepare('SELECT * FROM mailing_opdrachten WHERE mailingId = ?');
    $stmt->execute([$mailingId]);
    $mailing = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$mailing) {
        throw new RuntimeException('De mailing bestaat niet meer.');
    }

    $stmt = $db->prepare('SELECT * FROM mailing_adressen WHERE mailingId_FK = ? ORDER BY mailadresId');
    $stmt->execute([$mailingId]);
    $adressen = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $verzonden = 0;
    $mailText = stripslashes($mailing['message']);
    $from = filter_var($mailing['From'], FILTER_VALIDATE_EMAIL);
    if (!$from) {
        throw new RuntimeException('Ongeldig afzenderadres.');
    }

    foreach ($adressen as $adres) {
        if ($verzonden >= 40) break;
        if (!empty($adres['tijd_verzonden'])) continue;

        $recipient = filter_var(trim(stripslashes($adres['email'])), FILTER_VALIDATE_EMAIL);
        if (!$recipient) {
            throw new RuntimeException('Ongeldig e-mailadres bij mailadresId ' . (int) $adres['mailadresId'] . '.');
        }
        $afmeldStatus = mailingAfmeldStatus($db, $recipient);
        if ($afmeldStatus !== null && $afmeldStatus['afgemeld_op'] !== null) continue;
        $afmeldToken = mailingHeeftAfmeldlink($mailText) ? mailingAfmeldToken($db, $recipient) : null;

        $mail = $maakMailer();
        $mail->Timeout = 20;
        $mail->Subject = stripslashes($mailing['subject']);
        LPmailingAfzender($mail, $from, stripslashes($mailing['FromName']));
        if (!$mail->AddAddress($recipient, stripslashes($adres['naam']))) {
            throw new RuntimeException('Ontvanger kon niet worden ingesteld bij mailadresId ' . (int) $adres['mailadresId'] . '.');
        }
        $body = $mailText;
        foreach (['voornaam', 'naam', 'cursus', 'password'] as $veld) {
            if (isset($adres[$veld]) && $adres[$veld] !== '') {
                $body = str_replace('{' . $veld . '}', $adres[$veld], $body);
            }
        }
        $encrypt = '';
        if (isset($adres['DlnmrId']) && $adres['DlnmrId'] != '') {
            $key = hash('sha256', 'Mach a Šebestová');
            $iv = substr(hash('sha256', 'Sudoměřice u Bechyně'), 0, 16);
            $encrypted = openssl_encrypt($adres['DlnmrId'], 'AES-256-CBC', $key, 0, $iv);
            if ($encrypted === false) throw new RuntimeException('De deelnemerslink kon niet worden aangemaakt.');
            $encrypt = base64_encode($encrypted);
        }
        $body = str_replace('DlnmrIdx', $encrypt, $body);
        if ($afmeldToken !== null) $body = mailingAfmeldHeaders($mail, $body, $afmeldToken);
        $tracker = 'https://pellegrina.net/mailing/volg/volg.php?kenmerk=' . urlencode($adres['kenmerk']);
        $body = str_replace('</body>', '<img src="' . htmlspecialchars($tracker, ENT_QUOTES, 'UTF-8') . '" border="0" alt=""/></body>', $body);
        if (!empty($mailing['CC']) && !$mail->AddCC('info@pellegrina.net', 'LP PHP mailer')) {
            throw new RuntimeException('CC-adres kon niet worden ingesteld.');
        }
        $mail->Body = $body;
        $mail->AltBody = LPmailPlainText($mail, $body);
        $stmt = $db->prepare('UPDATE mailing_verzendtaken SET bezig_adres = ? WHERE mailing_id = ?');
        $stmt->execute([(int) $adres['mailadresId'], $mailingId]);
        if (!$mail->Send()) {
            throw new RuntimeException('Verzending mislukt bij mailadresId ' . (int) $adres['mailadresId'] . ': ' . $mail->ErrorInfo);
        }

        // SMTP-acceptatie en de database-update kunnen niet atomair worden uitgevoerd.
        $db->beginTransaction();
        try {
            $stmt = $db->prepare('UPDATE mailing_adressen SET tijd_verzonden = ? WHERE mailadresId = ? AND mailingId_FK = ?');
            $stmt->execute([date('Y-m-d H:i:s'), (int) $adres['mailadresId'], $mailingId]);
            if ($stmt->rowCount() !== 1) {
                throw new RuntimeException('Verzonden bericht kon niet worden geregistreerd bij mailadresId ' . (int) $adres['mailadresId'] . '.');
            }
            $stmt = $db->prepare('UPDATE mailing_opdrachten SET verzonden_mails = verzonden_mails + 1 WHERE mailingId = ?');
            $stmt->execute([$mailingId]);
            $stmt = $db->prepare('UPDATE mailing_verzendtaken SET bezig_adres = NULL WHERE mailing_id = ?');
            $stmt->execute([$mailingId]);
            $db->commit();
        } catch (Throwable $exception) {
            if ($db->inTransaction()) $db->rollBack();
            throw $exception;
        }
        $verzonden++;
    }

    if ((int) mailingAfmeldVerzendStatus($db, $mailingId)['resterend'] === 0) {
        $stmt = $db->prepare('UPDATE mailing_verzendtaken SET status = ?, laatste_fout = NULL WHERE mailing_id = ?');
        $stmt->execute(['afgerond', $mailingId]);
    }
}

function mailingVerwerkWachtrij(PDO $db, callable $maakMailer): bool
{
    if (!mailingVerzendLock($db)) return false;
    try {
        $klok = $db->query('SELECT volgende_blok FROM mailing_verzendklok WHERE id = 1')->fetchColumn();
        if ($klok === false) throw new RuntimeException('De verzendklok ontbreekt.');
        if ($klok > date('Y-m-d H:i:s')) return false;

        $stmt = $db->prepare('SELECT mailing_id FROM mailing_verzendtaken WHERE status = ? AND volgende_poging <= ? ORDER BY volgende_poging, mailing_id LIMIT 1');
        $stmt->execute(['wacht', date('Y-m-d H:i:s')]);
        $mailingId = $stmt->fetchColumn();
        if ($mailingId === false) return false;
        $mailingId = (int) $mailingId;

        // Reserveer de volgende poging vooraf, ook wanneer het proces onverwacht stopt.
        $stmt = $db->prepare('UPDATE mailing_verzendtaken SET volgende_poging = ? WHERE mailing_id = ?');
        $stmt->execute([date('Y-m-d H:i:s', time() + 15 * 60), $mailingId]);
        $stmt = $db->prepare('UPDATE mailing_verzendklok SET volgende_blok = ? WHERE id = 1');
        $stmt->execute([date('Y-m-d H:i:s', time() + 15 * 60)]);
        try {
            mailingControleerOpslag($db);
            $stmt = $db->prepare('SELECT bezig_adres FROM mailing_verzendtaken WHERE mailing_id = ?');
            $stmt->execute([$mailingId]);
            if ($stmt->fetchColumn() !== null) {
                throw new RuntimeException('De vorige verzending is onzeker. Controleer de ontvanger voordat je hervat.');
            }
            mailingVerzendBlok($db, $mailingId, $maakMailer);
        } catch (Throwable $exception) {
            $melding = 'Mailing ' . $mailingId . ' gestopt: ' . $exception->getMessage();
            error_log($melding);
            $stmt = $db->prepare('UPDATE mailing_verzendtaken SET status = ?, laatste_fout = ?, volgende_poging = ? WHERE mailing_id = ?');
            $stmt->execute(['gestopt', $melding, date('Y-m-d H:i:s', time() + 15 * 60), $mailingId]);
            throw $exception;
        } finally {
            $volgende = date('Y-m-d H:i:s', time() + 15 * 60);
            $stmt = $db->prepare('UPDATE mailing_verzendtaken SET volgende_poging = ? WHERE mailing_id = ?');
            $stmt->execute([$volgende, $mailingId]);
            $stmt = $db->prepare('UPDATE mailing_verzendklok SET volgende_blok = ? WHERE id = 1');
            $stmt->execute([$volgende]);
        }
        return true;
    } finally {
        mailingVerzendUnlock($db);
    }
}
