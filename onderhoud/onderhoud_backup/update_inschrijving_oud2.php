<?php //Connection statement
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2024.php');
//require_once ($_SERVER['DOCUMENT_ROOT'].'/login/level3_check.php');

/* echo '<pre>';
print_r($_GET);
print_r($_POST);
echo '</pre>';
 */
if (isset($_POST['InschId']) and ($_POST['InschId'] != "") and isset($_POST["Wissen"]) and ($_POST['Wissen'] == "Wissen")) {

  $deleteSQL = sprintf("DELETE FROM inschrijving WHERE InschId=%s",
                       GetSQLValueString($_POST['InschId'], "int"));

  $Result1 = $inschrijf->Execute($deleteSQL) or die($inschrijf->ErrorMsg());
}

if (isset($_POST['InschId']) and ($_POST['InschId'] != "") and isset($_POST["Wijzigen"]) and ($_POST['Wijzigen'] == "Wijzigen")) {
  $updateSQL = sprintf("
UPDATE inschrijving 
SET 
  aangenomen = %s,
  instrumentalist = %s,
  instrumenten = %s,
  `instr` = %s,
  niveau_i = %s,
  ervaring_i = %s,
  stukken_i = %s,
  groot_ensemble1 = %s,
  groot_ensemble2 = %s,
  solozanger = %s,
  zanger = %s,
  zangstem = %s,
  niveau_z = %s,
  niveau_s = %s,
  rol_z = %s,
  ervaring_z = %s,
  stukken_z = %s,
  stukken_s = %s,
  danser = %s,
  niveau_d = %s,
  ervaring_d = %s,
  stukken_d = %s,
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
  eigen_acc = %s,
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
                       GetSQLValueString($_POST['aangenomen'], "int"),
                       GetSQLValueString($_POST['instrumentalist'], "int"),
                       GetSQLValueString(htmlspecialchars($_POST['instrumenten']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['instr']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['niveau_i']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['ervaring_i']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['stukken_i']), "text"),
                       GetSQLValueString($_POST['groot_ensemble1'], "int"),
                       GetSQLValueString($_POST['groot_ensemble2'], "int"),
                       GetSQLValueString($_POST['solozanger'], "int"),
                       GetSQLValueString($_POST['zanger'], "int"),
                       GetSQLValueString(htmlspecialchars($_POST['zangstem']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['niveau_z']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['niveau_s']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['rol_z']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['ervaring_z']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['stukken_z']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['stukken_s']), "text"),
                       GetSQLValueString($_POST['danser'], "int"),
                       GetSQLValueString(htmlspecialchars($_POST['niveau_d']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['ervaring_d']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['stukken_d']), "text"),
                       GetSQLValueString($_POST['toehoorder'], "int"),
                       GetSQLValueString(htmlspecialchars($_POST['vervoer']), "text"),
					   GetSQLValueString(isset($_POST['busheen']) ? "true" : "", "defined","'1'","'0'"),
 					   GetSQLValueString(isset($_POST['busterug']) ? "true" : "", "defined","'1'","'0'"),
                       GetSQLValueString(htmlspecialchars($_POST['bus_bijzonderheden']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['acc_wens']), "text"),
                       GetSQLValueString($_POST['eenpersoons'], "int"),
                       GetSQLValueString($_POST['meerpersoons'], "int"),
                       GetSQLValueString($_POST['kamperen'], "int"),
                       GetSQLValueString($_POST['hotel_2pp'], "int"),
                       GetSQLValueString($_POST['hotel_1pp'], "int"),
                       GetSQLValueString($_POST['eigen_acc'], "int"),
                       GetSQLValueString($_POST['storting_fonds'], "int"),
                       GetSQLValueString(htmlspecialchars($_POST['donatie']), "text"),
                       GetSQLValueString(htmlspecialchars($_POST['opmerkingen']), "text"),
                       GetSQLValueString($_POST['aanbet_bedrag'], "int"),
                       GetSQLValueString($_POST['cursusgeld'], "int"),
                       GetSQLValueString($_POST['voorl_bev'], "date"),
                       GetSQLValueString(htmlspecialchars($_POST['inzeepdag']), "text"),
                       GetSQLValueString($_POST['afgewezen'], "int"),
                       GetSQLValueString($_POST['datum_inschr'], "date"),
                       GetSQLValueString($_POST['aanmaning_inschr'], "date"),
                       GetSQLValueString($_POST['DlnmrId_FK'], "int"),
                       GetSQLValueString($_POST['CursusId_FK'], "int"),
                       GetSQLValueString($_POST['InschId'], "int"));

// printf('$updateSQL = '. $updateSQL);

$Result1 = $inschrijf->Execute($updateSQL) or die($inschrijf->ErrorMsg());
}

// begin Recordset Inschrijvingen van een deelnemer
$colname__inschrijving = '-1';
if (isset($_GET['DlnmrId']) and !(isset($_POST["Leegmaken"]) and ($_POST['Leegmaken'] == "Leegmaken"))) {
	$colname__inschrijving = $_GET['DlnmrId'];
	}
if (isset($_GET['alles']) and $_GET['alles'] == 'on')
	$query_inschrijving = "SELECT * FROM inschrijving WHERE DlnmrId_FK = {$colname__inschrijving} 
	ORDER BY CursusId_FK ASC";
else
	$query_inschrijving = "SELECT * FROM inschrijving WHERE DlnmrId_FK = {$colname__inschrijving} AND CursusId_FK BETWEEN 
	{$eerstecursus} AND {$laatstecursus} ORDER BY CursusId_FK ASC";

// printf('$query_inschrijving = '. $query_inschrijving);

if ($result = $mysqli->query($query_inschrijving)) {
//    echo "Select returned $result->num_rows rows.\n";
	$totalRows_inschrijving = $result->num_rows;
    while ($row = $result->fetch_assoc()) {
        $inschrijving[$row['InschId']] = $row;
    }

/* echo '<pre>';
print_r($inschrijving);
echo '</pre>';
 */
    $result->close();
}
else printf("Fout inschrijving. Errormessage: %s\n", $mysqli->error);
// end Recordset Inschrijvingen van een deelnemer

// begin Recordset Cursusnamen
$query_Cursussen = "SELECT CursusId, cursusnaam_nl, YEAR(datum_begin) as jaar FROM cursus ORDER BY CursusId ASC";
if ($Cursussen = $mysqli->query($query_Cursussen)) {
//    printf("Cursus select returned %d rows.\n", $Cursussen->num_rows);
    while ($row = $Cursussen->fetch_assoc()) {
        $cursus[$row['CursusId']] = $row;
    }

/* echo '<pre>';
print_r($cursus);
echo '</pre>';
 */
    $Cursussen->close();
}
else printf("Fout cursussen. Errormessage: %s\n", $mysqli->error);

// end Recordset Cursusnamen

// begin Recordset Dlnmr voor deelnemersnaam
$colname__Dlnmr = '-1';
if (isset($_GET['DlnmrId'])) {
  $colname__Dlnmr = $_GET['DlnmrId'];
}
$query_Dlnmr = sprintf("SELECT naam FROM dlnmr WHERE DlnmrId = %s", GetSQLValueString($colname__Dlnmr, "int"));
if ($Dlnmr = $mysqli->query($query_Dlnmr)) {
//    printf("Dlnmr select returned %d rows.\n", $Dlnmr->num_rows);
    $dlnmr = $Dlnmr->fetch_assoc();

/* echo '<pre>';
print_r($dlnmr);
echo '</pre>';
 */
    $Dlnmr->close();
}
else printf("Fout deelnemers. Errormessage: %s\n", $mysqli->error);
// end Recordset

?>
<!DOCTYPE HTML>
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
// -->
</SCRIPT>
<html>
<head>
<title>Update inschrijvingen</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/pellegrina_stijlen.css" type="text/css">
</head>
<body>
<table width="600" border="0" align="left" style="clear: both;">
  <tr>
    <td colspan="3"><form id="zoek" name="zoek" method="get" action="<?php echo $editFormAction; ?>">
        <input name="DlnmrId" type="hidden" value="<?php if (isset($_GET['DlnmrId'])) echo $_GET['DlnmrId']; ?>" size="5" />
        <input type="submit" name="Submit" value="Zoek">
        (alle inschrijvingen van de afgelopen jaren:
        <input name="alles" type="checkbox" <?php
if (isset($_GET['alles']) and stristr($_GET['alles'], 'on') !== false) echo 'checked'; ?>>
        )
      </form></td>
  </tr>
  <?php 
$_POST['InschId'] = $inschrijving['InschId'];
if ($totalRows_inschrijving > 1) {
		echo "<tr><td colspan=\"3\">";
		echo "<p><b>Kies één van de volgende inschrijvingen:</b></p>";	
		echo "<form action=\"{$editFormAction}\" method=\"get\" name=\"inschrijving\" id=\"inschrijving\"> \n <select name=\"InschId\" size=\"{$totalRows_inschrijving}\" >";
      foreach ($inschrijving as $ins){
			echo "<option value=\"{$ins['InschId']}\"";
			if (!(strcmp($ins['InschId'], $_GET['InschId']))) echo "SELECTED";
			echo '>' . $cursus[$ins['CursusId_FK']]['cursusnaam_nl'];
			}
		echo "</option>\n</select>";
		echo '<input name="DlnmrId" type="hidden" value="';
		if (isset($_GET['DlnmrId'])) echo $_GET['DlnmrId'] . '" />';
		if (isset($_GET['alles'])) echo "<input name=\"alles\" type=\"hidden\" value=\"on\">";	
		echo '<input type="submit" name="Submit" value="Zoek" />';
		echo '</form></td></tr>';
	} 
if (isset($_GET['InschId'])) $ins = $inschrijving[$_GET['InschId']];
elseif (is_array($inschrijving)) $ins = current($inschrijving);
?>
</table>
<form id="inschrijf" name="inschrijf" method="post" action="<?php echo $editFormAction; ?>">
<p>&nbsp;</p>
  <table width="626" border="0" style="clear: both;">
    <tr valign="baseline">
      <td width="119" align="right" nowrap><p>Naam:</p></td>
      <td colspan="2"><b><?php echo $dlnmr['naam']; ?>&nbsp;</b></td>
      <td width="247">Deelnemersnummer:
        <input name="DlnmrId_FK" type="text" value="<?php echo stripslashes($ins['DlnmrId_FK']); ?>" size="3"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Cursus:</td>
      <td colspan="3"><?php if ($ins['CursusId_FK'] != "") echo "Inschrijving nr. <input name=\"InschId\" type=\"text\" class=\"uit\" value=\"{$ins['InschId']}\" size=\"2\">&nbsp;<b>{$cursus[$ins['CursusId_FK']]['cursusnaam_nl']}</b>"; ?>
        <input name="CursusId_FK" type="hidden" value="<?php echo stripslashes($ins['CursusId_FK']); ?>"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Instrumentalist:</td>
      <td colspan="3"><input type="checkbox" name="instrumentalist" id="instr_checkbox" value="1" <?php if (!(strcmp($ins['instrumentalist'],"1"))) {echo "checked";} ?> /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Instrumenten:</td>
      <td colspan="3"><input type="text" name="instrumenten" value="<?php echo stripslashes($ins['instrumenten']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Instr. &amp; zangstem:</td>
      <td colspan="3"><input type="text" name="instr" value="<?php echo stripslashes($ins['instr']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Niveau_i:</td>
      <td colspan="3"><input type="text" name="niveau_i" value="<?php echo stripslashes($ins['niveau_i']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Ervaring_i:</td>
      <td colspan="3"><input type="text" name="ervaring_i" value="<?php echo stripslashes($ins['ervaring_i']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Stukken_i:</td>
      <td colspan="3"><textarea name="stukken_i" cols="80" rows="5"><?php echo stripslashes($ins['stukken_i']); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Groot_ensemble1:</td>
      <td width="119"><input type="checkbox" name="groot_ensemble1" value="1" <?php if (!(strcmp($ins['groot_ensemble1'],"1"))) {echo "checked";} ?> /></td>
      <td width="123" align="right" nowrap>Groot_ensemble2:</td>
      <td><input type="checkbox" name="groot_ensemble2" value="1" <?php if (!(strcmp($ins['groot_ensemble2'],"1"))) {echo "checked";} ?> /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Zanger:</td>
      <td><input type="checkbox" name="zanger" id="zang_checkbox" value="1" <?php if (!(strcmp($ins['zanger'],"1"))) {echo "checked";} ?> /></td>
      <td align="right">solozanger:</td>
      <td><input type="checkbox" name="solozanger" id="solozang_checkbox" value="1" <?php if (!(strcmp($ins['solozanger'],"1"))) {echo "checked";} ?> /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Zangstem:</td>
      <td><input type="text" name="zangstem" value="<?php echo stripslashes($ins['zangstem']); ?>" size="32" /></td>
      <td align="right">rollen:</td>
      <td><input name="rol_z" type="text" id="rol_z" value="<?php echo stripslashes($ins['rol_z']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Niveau_z:</td>
      <td><input type="text" name="niveau_z" value="<?php echo stripslashes($ins['niveau_z']); ?>" size="32" /></td>
      <td nowrap align="right">Niveau_s:</td>
      <td><input type="text" name="niveau_s" value="<?php echo stripslashes($ins['niveau_s']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Ervaring_z:</td>
      <td colspan="3"><input type="text" name="ervaring_z" value="<?php echo stripslashes($ins['ervaring_z']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Stukken_z:</td>
      <td colspan="3"><textarea name="stukken_z" cols="80" rows="5"><?php echo stripslashes($ins['stukken_z']); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Danser:</td>
      <td><input type="checkbox" name="dans_checkbox" id="dans_checkbox" value="1" <?php if (!(strcmp($ins['danser'],"1"))) {echo "checked";} ?> /></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Niveau_d:</td>
      <td><input type="text" name="niveau_d" value="<?php echo stripslashes($ins['niveau_d']); ?>" size="32" /></td>
      <td nowrap align="right">Ervaring_d:</td>
      <td><input type="text" name="ervaring_d" value="<?php echo stripslashes($ins['ervaring_d']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Stukken_d:</td>
      <td colspan="3"><textarea name="stukken_d" cols="80" rows="5"><?php echo stripslashes($ins['stukken_d']); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Toehoorder:</td>
      <td colspan="3"><input type="checkbox" name="toehoorder" value="1" <?php if (!(strcmp($ins['toehoorder'],"1"))) {echo "checked";} ?> /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">vervoer:</td>
      <td><input type="text" name="vervoer" value="<?php echo stripslashes($ins['vervoer']); ?>" size="32" /></td>
      <td align="right" nowrap>korting:</td>
      <td><input type="text" name="korting" value="<?php echo stripslashes($ins['korting']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">1-pp. internaat:</td>
      <td><input type="checkbox" name="eenpersoons" value="1" <?php if (!(strcmp($ins['eenpersoons'],"1"))) {echo "checked";} ?> /></td>
      <td align="right" nowrap>kamperen:
        <input type="checkbox" name="kamperen" value="1" <?php if (!(strcmp($ins['kamperen'],"1"))) {echo "checked";} ?>" /></td>
      <td align="center">meerpersoons:
        <input name="meerpers" type="checkbox" id="meerpers" value="1" <?php if (!(strcmp($ins['meerpers'],"1"))) {echo "checked";} ?>" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Hotel 2-pp.:</td>
      <td><input type="checkbox" name="hotel_2pp" value="1" <?php if (!(strcmp($ins['hotel_2pp'],"1"))) {echo "checked";} ?> /></td>
      <td align="right" nowrap>Hotel 1-pp.:</td>
      <td><input name="hotel_1pp" type="checkbox" id="hotel_1pp" value="1" <?php if (!(strcmp($ins['hotel_1pp'],"1"))) {echo "checked";} ?> />
      &nbsp;&nbsp;&nbsp;eigen accommodatie: 
      <input name="eigen_acc" type="checkbox" id="eigen_acc" value="1" <?php if (!(strcmp($ins['eigen_acc'],"1"))) {echo "checked";} ?> /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Storting_fonds:</td>
      <td><input type="checkbox" name="storting_fonds" value="1" <?php if (!(strcmp($ins['storting_fonds'],"1"))) {echo "checked";} ?> /></td>
      <td align="right">Donatie:</td>
      <td>&euro;&nbsp;
        <input type="text" name="donatie" value="<?php echo stripslashes($ins['donatie']); ?>" size="6" /></td>
      <input name="storting_fonds" type="hidden" value="<?php if ($ins['donatie'] > 0) echo 1; ?>">
    </tr>
    <tr>
      <td nowrap align="right">Acc_wens:</td>
      <td colspan="3"><textarea name="acc_wens" cols="80" rows="5"><?php echo stripslashes($ins['acc_wens']); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Opmerkingen:</td>
      <td colspan="3"><textarea name="opmerkingen" cols="80" rows="5"><?php echo stripslashes($ins['opmerkingen']); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Aanbetaald bedr.:</td>
      <td>&euro;&nbsp;
        <input type="text" name="aanbet_bedrag" value="<?php echo stripslashes($ins['aanbet_bedrag']); ?>" size="5" /></td>
      <td>Cursusgeld:</td>
      <td>&euro;&nbsp;
        <input name="cursusgeld" type="text" value="<?php echo stripslashes($ins['cursusgeld']); ?>" size="6"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Datum inschr.:</td>
      <td><input type="text" name="datum_inschr" value="<?php echo stripslashes($ins['datum_inschr']); ?>" size="10" /></td>
      <td>datum aanmaning:</td>
      <td><input type="text" name="aanmaning_inschr" value="<?php echo stripslashes($ins['aanmaning_inschr']); ?>" size="10" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Voorlopige bev.: </td>
      <td><input name="voorl_bev" type="text" id="voorl_bev" value="<?php echo stripslashes($ins['voorl_bev']); ?>" size="10" /></td>
      <td>bus Praag: </td>
      <td><p>heen:
        <input name="busheen" type="checkbox" id="busheen" value="1" <?php if (!(strcmp($ins['busheen'],"1"))) {echo "checked";} ?> />
        terug:
        <input name="busterug" type="checkbox" id="busterug" value="1" <?php if (!(strcmp($ins['busterug'],"1"))) {echo "checked";} ?> />
      </p></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>Bijzonderheden</td>
      <td><input type="text" name="bus_bijzonderheden" value="<?php echo stripslashes($ins['bus_bijzonderheden']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Aangenomen:</td>
      <td><input <?php if (!(strcmp($ins['aangenomen'],1))) {echo "checked";} ?> name="aangenomen" type="checkbox" id="aangenomen" value="1"></td>
      <td>Inzeepdag:</td>
      <td><input type="text" name="inzeepdag" value="<?php echo stripslashes($ins['inzeepdag']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Afgewezen:</td>
      <td><input <?php if (!(strcmp($ins['afgewezen'],1))) echo "checked"; ?> name="afgewezen" type="checkbox" id="afgewezen" value="1"></td>
      <td onClick="GP_popupConfirmMsg('Moeten deze gegevens werkelijk gewist worden?'];return document.MM_returnValue">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input name="Wijzigen" type="submit" id="Wijzigen" value="Wijzigen" /></td>
      <td onClick="GP_popupConfirmMsg('Moeten deze gegevens werkelijk gewist worden?'];return document.MM_returnValue"><input name="Wissen" type="submit" id="Wissen" value="Wissen"></td>
      <td><input name="Leegmaken" type="submit" id="Leegmaken" value="Leegmaken" /><br>
<br><br>
</td>
    </tr>
  </table>
  <input name="InschId" type="hidden" value="<?php echo stripslashes($ins['InschId']); ?>">
</form>
</td>
</tr>
</table>
</body>
</html>