<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');

Kint::$enabled_mode = false;

if (isset($_POST['alles']) and $_POST['alles'] != '') $_SESSION['alles'] = $_POST['alles'];

if (isset($_POST['DlnmrId']) and $_POST['DlnmrId'] != '') $DlnmrId = $_SESSION['DlnmrId'] = $_POST['DlnmrId'];
elseif (isset($_SESSION['DlnmrId']) and $_SESSION['DlnmrId'] != '') $DlnmrId = $_SESSION['DlnmrId'];
else $DlnmrId = -1;

unset($_SESSION['alles']);

d($_SESSION);
d($_POST);

if (isset($_POST['InschId']) and ($_POST['InschId'] != "") and isset($_POST["Wissen"]) and ($_POST['Wissen'] == "Wissen")) {

    $deleteSQL = sprintf(
        "DELETE FROM inschrijving WHERE InschId=%s",
        $_POST['InschId']
    );
    d($deleteSQL);
    exec_query($deleteSQL);
}

if (isset($_POST['InschId']) and ($_POST['InschId'] != "") and isset($_POST["Wijzigen"]) and ($_POST['Wijzigen'] == "Wijzigen")) {
    $updateSQL = sprintf(
        "UPDATE inschrijving SET 
		  aangenomen = %s,
		  instrumentalist = %s,
		  instrumenten = %s,
		  `instr` = %s,
		  niveau_i = %s,
		  ervaring_i = %s,
		  stukken_i = %s,
		  solozanger = %s,
		  zanger = %s,
		  zangstem = %s,
		  niveau_z = %s,
		  niveau_s = %s,
		  rol_z = %s,
		  ervaring_z = %s,
		  stukken_z = %s,
		  toehoorder = %s,
		  vervoer = %s,
		  busheen = %s,
		  busterug = %s,
		  bus_bijzonderheden = %s,
		  acc_wens = %s,
		  eenpersoons = %s,
		  meerpers = %s,
		  kamperen = %s,
		  hotel_2pp = %s,
		  hotel_1pp = %s,
		  hotel_1_2pp = %s,
		  eigen_acc = %s,
		  diner = %s,
		  storting_fonds = %s,
		  donatie = %s,
		  opmerkingen = %s,
		  aanbet_bedrag = %s,
		  cursusgeld = %s,
		  voorl_bev = %s,
		  inzeepdag = %s,
		  afgewezen = %s,
		  datum_inschr = %s,
		  aanmaning_inschr = %s,
		  DlnmrId_FK = %s,
		  CursusId_FK = %s
		WHERE InschId = %s;",
        isset($_POST['aangenomen']) ? "1" : "0",
        isset($_POST['instrumentalist']) ? "1" : "0",
        quote($_POST['instrumenten']),
        quote($_POST['instr']),
        quote($_POST['niveau_i']),
        quote($_POST['ervaring_i']),
        quote($_POST['stukken_i']),
        isset($_POST['solozanger']) ? "1" : "0",
        isset($_POST['zanger']) ? "1" : "0",
        quote($_POST['zangstem']),
        quote($_POST['niveau_z']),
        quote($_POST['niveau_s']),
        quote($_POST['rol_z']),
        quote($_POST['ervaring_z']),
        quote($_POST['stukken_z']),
        isset($_POST['toehoorder']) ? "1" : "0",
        quote($_POST['vervoer']),
        isset($_POST['busheen']) ? "1" : "0",
        isset($_POST['busterug']) ? "1" : "0",
        quote($_POST['bus_bijzonderheden']),
        quote($_POST['acc_wens']),
        isset($_POST['eenpersoons']) ? "1" : "0",
        isset($_POST['meerpers']) ? "1" : "0",
        isset($_POST['kamperen']) ? "1" : "0",
        isset($_POST['hotel_2pp']) ? "1" : "0",
        isset($_POST['hotel_1pp']) ? "1" : "0",
        isset($_POST['hotel_1_2pp']) ? "1" : "0",
        isset($_POST['eigen_acc']) ? "1" : "0",
        isset($_POST['diner']) ? "1" : "0",
        isset($_POST['storting_fonds']) ? "1" : "0",
        quote($_POST['donatie']),
        quote($_POST['opmerkingen']),
        quote($_POST['aanbet_bedrag']),
        quote($_POST['cursusgeld']),
        quote($_POST['voorl_bev']),
        quote($_POST['inzeepdag']),
        isset($_POST['afgewezen']) ? "1" : "0",
        quote($_POST['datum_inschr']),
        quote($_POST['aanmaning_inschr']),
        quote($_POST['DlnmrId_FK']),
        quote($_POST['CursusId_FK']),
        quote($_POST['InschId'])
    );
    d($updateSQL);
    exec_query($updateSQL);
}

// begin Recordset Inschrijvingen van een deelnemer
$DlnmrId_FK = '-1';
if (isset($_SESSION['DlnmrId']) and $_SESSION['DlnmrId'] != '' and !(isset($_POST["Leegmaken"]) and ($_POST['Leegmaken'] == "Leegmaken"))) {
    $DlnmrId_FK = $_SESSION['DlnmrId'];
}
if (isset($_POST['alles']) and $_POST['alles'] == 'on')
    $query_inschrijving = "SELECT * FROM inschrijving WHERE DlnmrId_FK = {$DlnmrId_FK} 
	ORDER BY CursusId_FK ASC";
else
    $query_inschrijving = "SELECT * FROM inschrijving WHERE DlnmrId_FK = {$DlnmrId_FK} AND CursusId_FK BETWEEN 
	{$eerstecursus} AND {$laatstecursus} ORDER BY CursusId_FK ASC";

d($query_inschrijving);

$inschrijving = select_query($query_inschrijving, 'InschId');
if (is_array($inschrijving)) $aantal_inschrijvingen = count($inschrijving);
else $aantal_inschrijvingen = 0;
// end Recordset Inschrijvingen van een deelnemer

// begin Recordset Cursusnamen
$cursus = select_query("SELECT CursusId, cursusnaam_nl, YEAR(datum_begin) as jaar FROM cursus ORDER BY CursusId ASC", 'CursusId');

// begin Recordset Dlnmr voor deelnemersnaam
$DlnmrId = '-1';
if (isset($_SESSION['DlnmrId']) and $_SESSION['DlnmrId'] != '') {
    $DlnmrId = $_SESSION['DlnmrId'];
}
$dlnmr = select_query("SELECT naam FROM dlnmr WHERE DlnmrId = {$DlnmrId};", 1);

d($cursus, $dlnmr, $inschrijving);

// end Recordset

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
    <title>LP bewerk inschrijving</title>
    <link rel="stylesheet" href="/css/pellegrina_stijlen.css">
    <link rel="stylesheet" href="/css/LP_onderhoud.css">
    <SCRIPT>
        function GP_popupConfirmMsg(msg) { //v1.0
            document.MM_returnValue = confirm(msg);
        }
    </SCRIPT>
</head>

<body>
    <div id="zoeknaam"> <?php require_once('LP_zoeknaam.php'); ?> </div>
    <div id="mainframe">
        <header id="navigatiebalk"> <?php require_once('LP_navigatie.php'); ?>
        </header>
        <div id="mainpage" class="w3-panel w3-white">
            <?php Kint::$enabled_mode = false; ?> <table width="600" border="0"
                align="left" style="clear: both;">
                <tr>
                    <td colspan="3">
                        <form id="zoek" name="zoek" method="post"
                            action="<?php echo $editFormAction; ?>">
                            <input name="DlnmrId" id="DlnmrId" type="hidden"
                                value="<?php if (isset($_SESSION['DlnmrId'])) echo $_SESSION['DlnmrId']; ?>"
                                size="5" />
                            <input type="submit" name="Submit" value="Zoek">
                            (alle inschrijvingen van de afgelopen jaren: <input
                                name="alles" id="alles" type="checkbox"
                                <?php if (isset($_POST['alles']) and stristr($_POST['alles'], 'on') !== false) echo 'checked'; ?>>
                            )
                        </form>
                    </td>
                </tr> <?php
                        if (isset($inschrijving['InschId'])) $_POST['InschId'] = $inschrijving['InschId'];
                        if (is_array($inschrijving)) $aantal_inschrijvingen = count($inschrijving);
                        else $aantal_inschrijvingen = 0;
                        if ($aantal_inschrijvingen > 1) {
                            echo "<tr><td colspan=\"3\">";
                            echo "<p><b>Kies één van de volgende inschrijvingen:</b></p>";
                            echo "<form action=\"{$editFormAction}\" method=\"post\" name=\"inschrijving\" id=\"inschrijving\"> \n <select name=\"InschId\" size=\"{$aantal_inschrijvingen}\" >";
                            foreach ($inschrijving as $ins) {
                                echo "<option value=\"{$ins['InschId']}\"";
                                if (!(strcmp($ins['InschId'], $_POST['InschId']))) echo "SELECTED";
                                echo '>' . $cursus[$ins['CursusId_FK']]['cursusnaam_nl'];
                            }
                            echo "</option>\n</select>";
                            echo '<input name="DlnmrId" type="hidden" value="';
                            if (isset($_SESSION['DlnmrId'])) echo $_SESSION['DlnmrId'] . '" />';
                            if (isset($_POST['alles'])) echo "<input name=\"alles\" type=\"hidden\" value=\"on\">";
                            echo '<input type="submit" name="Submit" value="Zoek" />';
                            echo '</form></td></tr>';
                        }
                        if (isset($_POST['InschId'])) $ins = $inschrijving[$_POST['InschId']];
                        elseif (is_array($inschrijving)) $ins = current($inschrijving);
                        d($_POST, $ins);
                        ?>
            </table>
            <form id="inschrijf" name="inschrijf" method="post"
                action="<?php echo $editFormAction; ?>">
                <p>&nbsp;</p>
                <table width="626" border="0" style="clear: both;">
                    <tr valign="baseline">
                        <td width="119" align="right" nowrap>
                            <p>Naam:</p>
                        </td>
                        <td colspan="2">
                            <b><?php echo $dlnmr['naam']; ?>&nbsp;</b>
                        </td>
                        <td width="247">Deelnemersnummer: <input
                                name="DlnmrId_FK" type="text"
                                value="<?php echo stripslashes($ins['DlnmrId_FK']); ?>"
                                size="3">
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Cursus:</td>
                        <td colspan="3">
                            <?php if ($ins['CursusId_FK'] != "") echo "Inschrijving nr. <input name=\"InschId\" type=\"text\" class=\"uit\" value=\"{$ins['InschId']}\" size=\"2\">&nbsp;&nbsp;<b>{$cursus[$ins['CursusId_FK']]['cursusnaam_nl']}</b>"; ?>
                            <input name="CursusId_FK" type="hidden"
                                value="<?php echo stripslashes($ins['CursusId_FK']); ?>">
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Instrumentalist:</td>
                        <td colspan="3"><input type="checkbox"
                                name="instrumentalist" id="instr_checkbox"
                                value="1"
                                <?php if (!(strcmp($ins['instrumentalist'], "1"))) echo "checked"; ?> />
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Instrumenten:</td>
                        <td colspan="3"><input type="text" name="instrumenten"
                                value="<?php echo stripslashes($ins['instrumenten']); ?>"
                                size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Instr. &amp; zangstem:</td>
                        <td colspan="3"><input type="text" name="instr"
                                value="<?php echo stripslashes($ins['instr']); ?>"
                                size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Niveau_i:</td>
                        <td colspan="3"><input type="text" name="niveau_i"
                                value="<?php echo stripslashes($ins['niveau_i']); ?>"
                                size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Ervaring_i:</td>
                        <td colspan="3"><input type="text" name="ervaring_i"
                                value="<?php echo stripslashes($ins['ervaring_i']); ?>"
                                size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right" valign="top">Stukken_i:</td>
                        <td colspan="3"><textarea name="stukken_i" cols="80"
                                rows="5"><?php echo stripslashes($ins['stukken_i']); ?></textarea>
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Groot_ensemble1:</td>
                        <td width="119"><input type="checkbox"
                                name="groot_ensemble1" value="1" <?php if (!(strcmp($ins['groot_ensemble1'], "1"))) {
                                                                        echo "checked";
                                                                    } ?> />
                        </td>
                        <td width="123" align="right" nowrap>Groot_ensemble2:
                        </td>
                        <td><input type="checkbox" name="groot_ensemble2"
                                value="1" <?php if (!(strcmp($ins['groot_ensemble2'], "1"))) {
                                                echo "checked";
                                            } ?> />
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Zanger:</td>
                        <td><input type="checkbox" name="zanger"
                                id="zang_checkbox" value="1"
                                <?php if (!(strcmp($ins['zanger'], "1"))) echo "checked"; ?> />
                        </td>
                        <td align="right">solozanger:</td>
                        <td><input type="checkbox" name="solozanger"
                                id="solozang_checkbox" value="1"
                                <?php if (!(strcmp($ins['solozanger'], "1"))) echo "checked"; ?> />
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Zangstem:</td>
                        <td><input type="text" name="zangstem"
                                value="<?php echo stripslashes($ins['zangstem']); ?>"
                                size="32" /></td>
                        <td align="right">rollen:</td>
                        <td><input name="rol_z" type="text" id="rol_z"
                                value="<?php echo stripslashes($ins['rol_z']); ?>"
                                size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Niveau_z:</td>
                        <td><input type="text" name="niveau_z"
                                value="<?php echo stripslashes($ins['niveau_z']); ?>"
                                size="32" /></td>
                        <td nowrap align="right">Niveau_s:</td>
                        <td><input type="text" name="niveau_s"
                                value="<?php echo stripslashes($ins['niveau_s']); ?>"
                                size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Ervaring_z:</td>
                        <td colspan="3"><input type="text" name="ervaring_z"
                                value="<?php echo stripslashes($ins['ervaring_z']); ?>"
                                size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right" valign="top">Stukken_z:</td>
                        <td colspan="3"><textarea name="stukken_z" cols="80"
                                rows="5"><?php echo stripslashes($ins['stukken_z']); ?></textarea>
                        </td>
                    </tr>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Toehoorder:</td>
                        <td><input type="checkbox" name="toehoorder" value="1"
                                <?php if (!(strcmp($ins['toehoorder'], "1"))) echo "checked"; ?> />
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">vervoer:</td>
                        <td><input type="text" name="vervoer"
                                value="<?php echo stripslashes($ins['vervoer']); ?>"
                                size="32" /></td>
                        <td align="right" nowrap>korting:</td>
                        <td><input type="text" name="korting"
                                value="<?php echo stripslashes($ins['korting']); ?>"
                                size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td>&nbsp;</td>
                        <td colspan="3">
                            <table width="100%" class="w3-table w3-panel"
                                border="0" cellpadding="5">
                                <tr>
                                    <td><input type="checkbox"
                                            name="eenpersoons" value="1"
                                            <?php if (!(strcmp($ins['eenpersoons'], "1"))) echo "checked"; ?> /><label
                                            for="eenpersoons">&nbsp;1pp
                                            (GV)</label>
                                    </td>
                                    <td><input type="checkbox" name="hotel_1pp"
                                            value="1"
                                            <?php if (!(strcmp($ins['hotel_1pp'], "1"))) echo "checked"; ?> /><label
                                            for="hotel_1pp">&nbsp;1pp PG</label>
                                    </td>
                                    <td><input type="checkbox" name="hotel_2pp"
                                            value="1"
                                            <?php if (!(strcmp($ins['hotel_2pp'], "1"))) echo "checked"; ?> /><label
                                            for="hotel_2pp">&nbsp;2pp PG</label>
                                    </td>
                                    <td><input type="checkbox"
                                            name="hotel_1_2pp" value="1"
                                            <?php if (!(strcmp($ins['hotel_1_2pp'], "1"))) echo "checked"; ?> /><label
                                            for="hotel_1_2pp">&nbsp;1pp in 2pp
                                            PG</label></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="kamperen"
                                            value="1"
                                            <?php if (!(strcmp($ins['kamperen'], "1"))) echo "checked"; ?> /><label
                                            for="kamperen">&nbsp;kamperen</label>
                                    </td>
                                    <td><input type="checkbox" name="meerpers"
                                            value="1"
                                            <?php if (!(strcmp($ins['meerpers'], "1"))) echo "checked"; ?> /><label
                                            for="meerpers">&nbsp;meerpers.</label>
                                    </td>
                                    <td><input type="checkbox" name="eigen_acc"
                                            value="1"
                                            <?php if (!(strcmp($ins['eigen_acc'], "1"))) echo "checked"; ?> /><label
                                            for="eigen_acc">&nbsp;eigen
                                            acc.</label>
                                    </td>
                                    <td><input type="checkbox" name="diner"
                                            value="1"
                                            <?php if (!(strcmp($ins['diner'], "1"))) echo "checked"; ?> /><label
                                            for="diner">&nbsp;diner bij eigen
                                            acc.</label></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td>&nbsp;</td>
                        <td><input type="checkbox" name="storting_fonds"
                                value="1"
                                <?php if (!(strcmp($ins['storting_fonds'], "1"))) echo "checked"; ?> /><label
                                for="storting_fonds">&nbsp;Storting
                                fonds</label>
                        </td>
                        <td align="right">Donatie:</td>
                        <td>&euro;&nbsp; <input type="text" name="donatie"
                                value="<?php echo stripslashes($ins['donatie']); ?>"
                                size="6" />
                        </td>
                        <input name="storting_fonds" type="hidden"
                            value="<?php if ($ins['donatie'] > 0) echo 1; ?>">
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Accommodatie- wens:</td>
                        <td colspan="3"><textarea name="acc_wens" cols="80"
                                rows="5"><?php echo stripslashes($ins['acc_wens']); ?></textarea>
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right" valign="top">Opmerkingen:</td>
                        <td colspan="3"><textarea name="opmerkingen" cols="80"
                                rows="5"><?php echo stripslashes($ins['opmerkingen']); ?></textarea>
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Aanbetaald bedr.:</td>
                        <td>&euro;&nbsp; <input type="text" name="aanbet_bedrag"
                                value="<?php echo stripslashes($ins['aanbet_bedrag']); ?>"
                                size="5" />
                        </td>
                        <td>Cursusgeld:</td>
                        <td>&euro;&nbsp; <input name="cursusgeld" type="text"
                                value="<?php echo stripslashes($ins['cursusgeld']); ?>"
                                size="6" />
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Datum inschr.:</td>
                        <td><input type="text" name="datum_inschr"
                                value="<?php echo stripslashes($ins['datum_inschr']); ?>"
                                size="10" /></td>
                        <td>datum aanmaning:</td>
                        <td><input type="text" name="aanmaning_inschr"
                                value="<?php echo stripslashes($ins['aanmaning_inschr']); ?>"
                                size="10" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Voorlopige bev.: </td>
                        <td><input name="voorl_bev" type="text" id="voorl_bev"
                                value="<?php echo stripslashes($ins['voorl_bev']); ?>"
                                size="10" /></td>
                        <td>bus vanaf station:</td>
                        <td>
                            <p>heen: <input name="busheen" type="checkbox"
                                    id="busheen" value="1"
                                    <?php if (!(strcmp($ins['busheen'], "1"))) echo "checked"; ?> />
                                terug: <input name="busterug" type="checkbox"
                                    id="busterug" value="1"
                                    <?php if (!(strcmp($ins['busterug'], "1"))) echo "checked"; ?> />
                            </p>
                        </td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Bijzonderheden</td>
                        <td><input type="text" name="bus_bijzonderheden"
                                value="<?php echo stripslashes($ins['bus_bijzonderheden']); ?>"
                                size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Aangenomen:</td>
                        <td><input
                                <?php if (!(strcmp($ins['aangenomen'], 1))) echo "checked"; ?>
                                name="aangenomen" type="checkbox"
                                id="aangenomen" value="1"></td>
                        <td>Inzeepdag:</td>
                        <td><input type="text" name="inzeepdag"
                                value="<?php echo stripslashes($ins['inzeepdag']); ?>"
                                size="32" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">Afgewezen:</td>
                        <td><input
                                <?php if (!(strcmp($ins['afgewezen'], 1))) echo "checked"; ?>
                                name="afgewezen" type="checkbox" id="afgewezen"
                                value="1"></td>
                        <td
                            onClick="GP_popupConfirmMsg('Moeten deze gegevens werkelijk gewist worden?'); return document.MM_returnValue">
                            &nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap align="right">&nbsp;</td>
                        <td><input name="Wijzigen" type="submit" id="Wijzigen"
                                value="Wijzigen" /></td>
                        <td
                            onClick="GP_popupConfirmMsg('Moeten deze gegevens werkelijk gewist worden?'); return document.MM_returnValue">
                            <input name="Wissen" type="submit" id="Wissen"
                                value="Wissen">
                        </td>
                        <td><input name="Leegmaken" type="submit" id="Leegmaken"
                                value="Leegmaken" /><br>
                            <br><br>
                        </td>
                    </tr>
                </table>
                <input name="InschId" type="hidden"
                    value="<?php echo stripslashes($ins['InschId']); ?>">
            </form>
            </td>
            </tr>
            </table>
        </div>
    </div>
</body>

</html>