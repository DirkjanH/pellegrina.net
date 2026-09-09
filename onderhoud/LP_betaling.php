<?php
// Stel PHP fouten rapportage in
//ini_set('display_errors', 1);
error_reporting(E_ALL);

// Laad globale includes en vendor libraries
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');

// Kint is development-only; production must not fail when it is not installed.
if (class_exists('Kint')) {
    Kint::$enabled_mode = false;
}
if (!function_exists('d')) {
    function d(...$values) {}
}

// Initialiseer sessie datum (standaard vandaag)
if (!(isset($_SESSION['datum']) && $_SESSION['datum'] != "")) $_SESSION['datum'] = date("d-m-Y");
if (isset($_POST['datum']) && $_POST['datum'] != "") $_SESSION['datum'] = $_POST['datum'];

// Laad alle cursusgegevens en bouw naamarray
$query_cursussen = "SELECT * FROM cursus WHERE CursusId > {$cursus_offset} ORDER BY CursusId ASC";
$cursussen = select_query($query_cursussen);

foreach ($cursussen as $cur) {
    $cursusnaam[$cur['CursusId']]['NL'] = $cur['cursusnaam_nl'];
    $cursusnaam[$cur['CursusId']]['EN'] = $cur['cursusnaam_en'];
}

// Bepaal deelnemers ID uit GET parameter
$postedDlnmrId = filter_input(INPUT_POST, 'DlnmrId', FILTER_VALIDATE_INT);
$sessionDlnmrId = filter_var($_SESSION['DlnmrId'] ?? null, FILTER_VALIDATE_INT);
$getDlnmrId = filter_input(INPUT_GET, 'DlnmrId', FILTER_VALIDATE_INT);
$id = $postedDlnmrId ?: ($sessionDlnmrId ?: ($getDlnmrId ?: -1));
if ($id > 0) {
    $_SESSION['DlnmrId'] = $id;
}
$postedInschId = filter_input(INPUT_POST, 'InschId', FILTER_VALIDATE_INT);
$selectedCursusId = filter_input(INPUT_GET, 'cursus', FILTER_VALIDATE_INT);
if (
    $selectedCursusId === false ||
    $selectedCursusId < $eerstecursus ||
    $selectedCursusId > $laatstecursus
) {
    $selectedCursusId = 0;
}

// Verwerk betaling als formulier verzonden
if ((isset($_POST["Verwerk"])) && ($_POST["Verwerk"] == "Verwerk betaling") && $postedInschId) {

    // Voeg betaling toe aan opmerkingen
    if ($_POST['betaling'] != 0) $_POST['rekening_opmerking'] = $_POST['rekening_opmerking'] . "Betaling van &#8364;&nbsp;{$_POST['betaling']} d.d. {$_POST['datum']} per {$_POST['betaalwijze']}\n";
    // Markeer cash betaling ter plekke
    if ($_POST['cash'] == 1) {
        $_POST['rekening_opmerking'] .= "Betaling ter plekke in cash afgesproken\n";
        $_POST['betaling'] = 0;
    }
    // Update database met betaalgegevens
    $updateSQL = sprintf(
        "UPDATE inschrijving SET aanbet_bedrag=%s, rekening_opmerking=%s WHERE InschId=%s",
        (float) $_POST['aanbet_bedrag'] + (float) $_POST['betaling'],
        quote($_POST['rekening_opmerking']),
        $postedInschId
    );

    d($updateSQL);

    exec_query($updateSQL);
} // update

// Query inschrijvingen voor geselecteerde deelnemer of specifieke inschrijving
$query_inschrijving = '';
// Haal inschrijvingen op voor deelnemer
$query_inschrijving = "SELECT * FROM inschrijving, dlnmr WHERE DlnmrId_FK = DlnmrId 
AND DlnmrId_FK = {$id} AND CursusId_FK > {$cursus_offset}
AND CursusId_FK <= ({$aantal_cursussen} + {$cursus_offset}) ORDER BY CursusId_FK ASC";
if ($selectedCursusId > 0) {
    $query_inschrijving = "SELECT * FROM inschrijving, dlnmr WHERE DlnmrId_FK = DlnmrId
    AND DlnmrId_FK = {$id} AND CursusId_FK = {$selectedCursusId}
    ORDER BY CursusId_FK ASC";
}

// Overschrijf query als specifieke inschrijving verzonden
if ($postedInschId) {
    $query_inschrijving = "SELECT * FROM inschrijving, dlnmr WHERE DlnmrId_FK = DlnmrId 
    AND InschId = {$postedInschId} AND CursusId_FK > {$cursus_offset}
	AND CursusId_FK <= ({$aantal_cursussen} + {$cursus_offset}) 
	AND achternaam NOT LIKE '%XXX%'
    AND achternaam NOT LIKE '%YYY%'
    AND achternaam NOT LIKE '%ZZZ%'
	ORDER BY CursusId_FK ASC";
}

d($query_inschrijving);

if ($query_inschrijving != '') {
    $inschrijving = select_query($query_inschrijving) ?: [];
}
$totalRows_inschrijving = count($inschrijving);
$ins = $totalRows_inschrijving === 1 ? $inschrijving[0] : [];

// Haal alle nog openstaande rekeningen op
$query_openstaand = "SELECT *
FROM inschrijving,
  dlnmr
WHERE DlnmrId_FK = DlnmrId
    AND CursusId_FK BETWEEN {$eerstecursus}
    AND {$laatstecursus}
    AND ((cursusgeld + IFNULL(donatie, 0) - IFNULL(aanbet_bedrag, 0)) != 0)
    AND aangenomen = 1
	AND NOT(afgewezen <=> 1)
    AND achternaam NOT LIKE '%XXX%'
    AND achternaam NOT LIKE '%YYY%'
    AND achternaam NOT LIKE '%ZZZ%'
	AND geboortedatum != 0  
ORDER BY CursusId_FK, achternaam ASC";

d($query_openstaand);

$openstaand = select_query($query_openstaand);
$totalRows_openstaand = count($openstaand);

// Bereken totale openstaande bedragen per cursus
$query_bedrag = "SELECT
  SUM(cursusgeld + IFNULL(donatie, 0) - IFNULL(aanbet_bedrag, 0)) AS tebetalen
FROM inschrijving,
  dlnmr
WHERE DlnmrId_FK = DlnmrId
    AND CursusId_FK BETWEEN {$eerstecursus}
    AND {$laatstecursus}
    AND aangenomen = 1
	AND NOT(afgewezen <=> 1)
    AND achternaam NOT LIKE '%XXX%'
    AND achternaam NOT LIKE '%YYY%'
    AND achternaam NOT LIKE '%ZZZ%'
	AND geboortedatum != 0  
GROUP BY CursusId_FK";

$bedrag = select_query($query_bedrag);

$openstaand_bedrag['totaal'] = 0;
foreach ($bedrag as $i => $bedr) {
    $openstaand_bedrag[$i + 1] = $bedr['tebetalen'];
    $openstaand_bedrag['totaal'] += $openstaand_bedrag[$i + 1];
    $openstaand_bedrag[$i + 1] = euro2($openstaand_bedrag[$i + 1]);
}
$openstaand_bedrag['Etotaal'] = euro2($openstaand_bedrag['totaal']);

d($openstaand_bedrag);

// Bereken openstaande cash betalingen (ter plekke afgesproken)
$query_bedrag = "SELECT
  SUM(cursusgeld + IFNULL(donatie, 0) - IFNULL(aanbet_bedrag, 0)) AS tebetalen
FROM inschrijving,
  dlnmr
WHERE DlnmrId_FK = DlnmrId
    AND CursusId_FK BETWEEN {$eerstecursus}
    AND {$laatstecursus}
    AND aangenomen = 1
	AND NOT(afgewezen <=> 1)
   AND achternaam NOT LIKE '%XXX%'
   AND achternaam NOT LIKE '%YYY%'
   AND achternaam NOT LIKE '%ZZZ%'
	AND geboortedatum != 0 
	AND rekening_opmerking LIKE '%cash%'
GROUP BY CursusId_FK";

$cashbedrag = select_query($query_bedrag);

$openstaand_cashbedrag['totaal'] = 0;
foreach ($cashbedrag as $i => $cashbedr) {
    $openstaand_cashbedrag[$i + 1] = $cashbedr['tebetalen'];
    $openstaand_cashbedrag['totaal'] += $openstaand_cashbedrag[$i + 1];
    $openstaand_cashbedrag[$i + 1] = euro2($openstaand_cashbedrag[$i + 1]);
}
$openstaand_cashbedrag['Etotaal'] = euro2($openstaand_cashbedrag['totaal']);
d($openstaand_cashbedrag);

// Bereken giraal bedrag (totaal minus cash)
$openstaand_giraal = euro2($openstaand_bedrag['totaal'] - $openstaand_cashbedrag['totaal']);

?>
<!DOCTYPE HTML>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <META NAME="robots" CONTENT="noindex, nofollow">
    <link rel="apple-touch-icon" sizes="180x180"
        href="https://pellegrina.net/Images/Logos/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="https://pellegrina.net/Images/Logos/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://pellegrina.net/Images/Logos/favicon-16x16.png">
    <link rel="manifest"
        href="https://pellegrina.net/Images/Logos/site.webmanifest">
    <link rel="mask-icon"
        href="https://pellegrina.net/Images/Logos/safari-pinned-tab.svg"
        color="#5bbad5">
    <link rel="shortcut icon"
        href="https://pellegrina.net/Images/Logos/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config"
        content="https://pellegrina.net/Images/Logos/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Pagina titel en stijlen -->
    <title>LP betalingen</title>
    <!-- Stijlsheets voor opmaak -->
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
    <link rel="stylesheet" href="/css/LP_onderhoud.css" type="text/css">
    <meta charset="utf-8">
    <!-- JavaScript functie voor inschrijving selecteren -->
    <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
        function SetInschId(Id) {
            try {
                document.form.InschId.value = Id;
                document.form.Verwerk.value = '';
                document.form.submit();
            } catch (err) {
                alert('Dit werkt niet...;');
                for (var i in err) {
                    alert(i + ': ' + err(i));
                }
            }
        }
    </SCRIPT>
</head>

<body>
    <!-- Zoeknaam formulier -->
    <div id="zoeknaam"> <?php require_once('LP_zoeknaam.php'); ?> </div>
    <!-- Hoofd betalingsformulier -->
    <div id="mainframe">
        <!-- Navigatiebalk laden -->
        <header id="navigatiebalk"> <?php require_once('LP_navigatie.php'); ?>
        </header>
        <!-- Betalinggegevens tabel -->
        <div id="mainpage">
            <table width="100%" border="0" align="left">
                <!-- Zoekveld voor deelnemers ID -->
                <tr>
                    <td colspan="2">
                        <form id="zoek" name="zoek" method="get"
                            action="<?php echo $editFormAction; ?>"> Id: <input
                                name="DlnmrId" type="text"
                                value="<?php echo $id > 0 ? $id : ''; ?>"
                                size="5" />
                            <input type="submit" name="Submit" value="Zoek">
                        </form>
                    </td>
                </tr> <?php
                        if ($totalRows_inschrijving > 1) {
                            echo "<tr><td colspan=\"3\">";
                            echo "<p><b>Kies één van de volgende inschrijvingen:</b></p>";
                            echo "<form action=\"{$editFormAction}\" method=\"get\" name=\"inschrijving\" id=\"inschrijving\"> \n <select name=\"cursus\" size=\"{$totalRows_inschrijving}\" >";
                            foreach ($inschrijving as $inschrijvingOptie) {
                                echo "<option value=\"{$inschrijvingOptie['CursusId_FK']}\"";
                                if ($inschrijvingOptie['CursusId_FK'] == $selectedCursusId) {
                                    echo "SELECTED";
                                }
                                echo '>' . $cursusnaam[$inschrijvingOptie['CursusId_FK']]['NL'];
                            }
                            echo "</option>\n</select>";
                            echo '<input name="DlnmrId" type="hidden" value="';
                            if ($id > 0) echo $id . '" />';
                            echo '<input type="submit" name="Submit" value="Zoek">';
                            echo '</form></td></tr>';
                        } elseif ($totalRows_inschrijving === 1) {
                            $ins = $inschrijving[0];
                        } else {
                            echo '<tr><td colspan="2"><p>Geen inschrijving gevonden voor deze deelnemer.</p></td></tr>';
                        }
                        ?> <?php if ($ins !== []) { ?><form
                        action="<?php echo $editFormAction; ?>" method="POST"
                        name="form" id="form">
                        <tr>
                            <td height="50" colspan="2" valign="top">
                                <h2>Naam:&nbsp;<?php echo $ins['naam']; ?></h2>
                                <?php if ($ins['CursusId_FK'] != "") echo "<p>Inschrijving nr. 
			<input name=\"Id\" type=\"text\" DISABLED value=\"{$ins['InschId']}\"
			size=\"2\">&nbsp;voor cursus:&nbsp;<b>{$cursusnaam[$ins['CursusId_FK']]['NL']}</b></p>"; ?> <input name="aanbet_bedrag"
                                    type="hidden" value="<?php
                                                            echo $ins['aanbet_bedrag']; ?>">
                                <input name="InschId" id="InschId" type="hidden"
                                    value="<?php
                                            echo $ins['InschId']; ?>">
                                <input name="CursusId_FK" type="hidden" value="<?php
                                                                                echo $ins['CursusId_FK']; ?>">
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td width="100" align="right" nowrap>
                                <div align="right">Cursusgeld:</div>
                            </td>
                            <td><?php echo euro2($ins['cursusgeld']); ?></td>
                        </tr>
                        <tr valign="baseline">
                            <td width="100">
                                <div align="right">Gedoneerd bedrag: </div>
                            </td>
                            <td><?php echo euro2($ins['donatie']); ?></td>
                        </tr>
                        <tr valign="baseline">
                            <td width="100" align="right" nowrap>
                                <div align="right">Totaal te betalen: </div>
                            </td>
                            <td><?php echo euro2($ins['cursusgeld'] + $ins['donatie']); ?>&nbsp;
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td width="100" align="right" nowrap>
                                <div align="right">Al betaald:</div>
                            </td>
                            <td><?php echo euro2($ins['aanbet_bedrag']); ?></td>
                        </tr>
                        <tr valign="middle">
                            <td width="100" align="right" valign="top" nowrap>
                                <div align="right">Nog openstaand </div>
                            </td>
                            <td valign="top" nowrap>
                                <?php echo euro2($ins['cursusgeld'] + $ins['donatie'] - $ins['aanbet_bedrag']); ?>&nbsp;
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td colspan="2" valign="top" nowrap>
                                <!-- Betaaldatum, betaalwijze en bedrag selectie -->
                                Betaling d.d. <input name="datum" type="text"
                                    id="datum" size="10"
                                    value="<?php echo $_SESSION['datum'] ?>"> per
                                <label>
                                    <input name="betaalwijze" type="radio"
                                        value="Postbank" checked> Postbank</label>
                                <label>
                                    <input type="radio" name="betaalwijze"
                                        value="KB"> KB</label>
                                <label>
                                    <input type="radio" name="betaalwijze"
                                        value="PayPal"> PayPal</label>
                                <label>
                                    <input type="radio" name="betaalwijze"
                                        value="kas"> kas van &nbsp;&#8364;&nbsp;
                                    <input name="betaling" type="text" id="betaling"
                                        size="5"
                                        value="<?php echo ($ins['cursusgeld'] + $ins['donatie'] - $ins['aanbet_bedrag']); ?>">
                                    &nbsp;
                                    <!-- Checkbox voor cash ter plekse afgesproken -->
                                    Betaling tijdens cursus in contanten
                                    afgesproken: <input name="cash" type="checkbox"
                                        value="1"
                                        <?php if (isset($_POST['cash'])) echo 'checked'; ?>>
                                </label>
                            </td>
                        </tr>
                        <tr valign="middle">
                            <td colspan="2" valign="top" nowrap>
                                <div align="left">Opmerkingen over de betaling:<br>
                                    <textarea name="rekening_opmerking" cols="80"
                                        rows="3"
                                        id="rekening_opmerking"><?php
                                                                if ($ins['rekening_opmerking'] != "") echo stripslashes($ins['rekening_opmerking']); ?></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td>&nbsp;</td>
                            <td valign="baseline">
                                <div class="links">
                                    <input name="Verwerk" type="submit"
                                        class="fotobijschrift" id="Verwerk"
                                        value="Verwerk betaling" />
                                </div>
                            </td>
                        </tr>
                        <tr valign="baseline">
                            <td colspan="2">
                                <p class="groot">Nog openstaande rekeningen:</p>
                                <div id="navcontainer" style="width: 300px;">
                                    <ul id="navlist"> <?php
                                                        foreach ($openstaand as $open) {
                                                            $grijs = TRUE;
                                                            if (stripos($open['rekening_opmerking'], 'Betaling ter plekke in cash') === FALSE)
                                                                $grijs =  FALSE;
                                                            $bedrag = $open['cursusgeld'] + $open['donatie']
                                                                - $open['aanbet_bedrag'];
                                                            $opens = '<li id="active"><a href="javascript:SetInschId(';
                                                            $opens .= $open['InschId'] . ')">';
                                                            if ($grijs) $opens .= '<span class="grijs">';
                                                            $opens .= $open['naam'] . ' (';
                                                            $opens .= euro2($bedrag);
                                                            $opens .= ")";
                                                            if ($grijs) $opens .= '</span>';
                                                            $opens .= "</a></li>\n";
                                                            echo $opens;
                                                        }
                                                        ?> </ul>
                                </div>
                                <!-- Huidige inschrijving invoice weergeven -->
                                <?php if (isset($ins['CursusId_FK']) && $ins['CursusId_FK'] != "") { ?>
                                    <hr style="margin-top: 20px;">
                                    <p><strong>Huidige inschrijving:</strong></p>
                                    <div style="font-size: 12px;">
                                        <div
                                            style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 8px;">
                                            <div
                                                style="flex: 1; min-width: 200px; text-align: right; padding-right: 10px;">
                                                <strong>Cursus:</strong>
                                            </div>
                                            <div style="flex: 1; min-width: 200px;">
                                                <?php echo $cursusnaam[$ins['CursusId_FK']]['NL']; ?>
                                            </div>
                                        </div>
                                        <div
                                            style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 8px;">
                                            <div
                                                style="flex: 1; min-width: 200px; text-align: right; padding-right: 10px;">
                                                Cursusgeld:</div>
                                            <div style="flex: 1; min-width: 200px;">
                                                <?php echo euro2($ins['cursusgeld']); ?>
                                            </div>
                                        </div>
                                        <div
                                            style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 8px;">
                                            <div
                                                style="flex: 1; min-width: 200px; text-align: right; padding-right: 10px;">
                                                Gedoneerd:</div>
                                            <div style="flex: 1; min-width: 200px;">
                                                <?php echo euro2($ins['donatie']); ?>
                                            </div>
                                        </div>
                                        <div
                                            style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 8px; padding-top: 8px; border-top: 1px solid #ccc;">
                                            <div
                                                style="flex: 1; min-width: 200px; text-align: right; padding-right: 10px;">
                                                <strong>Totaal:</strong>
                                            </div>
                                            <div style="flex: 1; min-width: 200px;">
                                                <strong><?php echo euro2($ins['cursusgeld'] + $ins['donatie']); ?></strong>
                                            </div>
                                        </div>
                                        <div
                                            style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 8px;">
                                            <div
                                                style="flex: 1; min-width: 200px; text-align: right; padding-right: 10px;">
                                                Al betaald:</div>
                                            <div style="flex: 1; min-width: 200px;">
                                                <?php echo euro2($ins['aanbet_bedrag']); ?>
                                            </div>
                                        </div>
                                        <div
                                            style="display: flex; flex-wrap: wrap; gap: 10px; padding-top: 8px; border-top: 1px solid #ccc;">
                                            <div
                                                style="flex: 1; min-width: 200px; text-align: right; padding-right: 10px;">
                                                <strong>Openstaand:</strong>
                                            </div>
                                            <div style="flex: 1; min-width: 200px;">
                                                <strong><?php echo euro2($ins['cursusgeld'] + $ins['donatie'] - $ins['aanbet_bedrag']); ?></strong>
                                            </div>
                                        </div>
                                    </div> <?php } ?>
                            </td>
                        </tr>
                    </form><?php } ?>
            </table> <?php echo '<p>Aantal nog openstaande rekeningen: ' . $totalRows_openstaand . "; Totaal nog openstaand bedrag: cash {$openstaand_cashbedrag['Etotaal']} + giraal {$openstaand_giraal} = {$openstaand_bedrag['Etotaal']}<br>";
                        foreach ($openstaand_bedrag as $key => $value) {
                            if (strpos($key, 'totaal') === false) {
                                echo "Cursus {$key}: ";
                                echo $value . " | ";
                            }
                        }
                        echo '</p>';
                        ?> </td>
            </tr>
            </table>
        </div>
    </div>
</body>

</html>