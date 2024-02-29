<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2024.php');

require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

Kint::$enabled_mode = false;

d($_GET, $_POST);

if (isset($_POST['InschId']) and ($_POST['InschId'] != "") and isset($_POST["Wissen"]) and ($_POST['Wissen'] == "Wissen")) {

  $deleteSQL = sprintf("DELETE FROM inschrijving WHERE InschId=%s",
                       $_POST['InschId']);
d($deleteSQL);
  exec_query($deleteSQL);
}

if (isset($_POST['InschId']) and ($_POST['InschId'] != "") and isset($_POST["Wijzigen"]) and ($_POST['Wijzigen'] == "Wijzigen")) {
  $statement = $db->prepare("
		UPDATE IGNORE inschrijving 
		SET 
		  aangenomen = ?,
		  instrumentalist = ?,
		  instrumenten = ?,
		  `instr` = ?,
		  niveau_i = ?,
		  ervaring_i = ?,
		  stukken_i = ?,
		  solozanger = ?,
		  zanger = ?,
		  zangstem = ?,
		  niveau_z = ?,
		  niveau_s = ?,
		  rol_z = ?,
		  ervaring_z = ?,
		  stukken_z = ?,
		  toehoorder = ?,
		  vervoer = ?,
		  busheen = ?,
		  busterug = ?,
		  bus_bijzonderheden = ?,
		  acc_wens = ?,
		  eenpersoons = ?,
		  meerpers = ?,
		  kamperen = ?,
		  hotel_2pp = ?,
		  hotel_1pp = ?,
		  eigen_acc = ?,
		  storting_fonds = ?,
		  donatie = ?,
		  opmerkingen = ?,
		  aanbet_bedrag = ?,
		  cursusgeld = ?,
		  voorl_bev = ?,
		  inzeepdag = ?,
		  afgewezen = ?,
		  datum_inschr = ?,
		  aanmaning_inschr = ?,
		  DlnmrId_FK = ?,
		  CursusId_FK = ?,
		  diner = ?
		WHERE InschId = ?;");
	

		$statement->bindParam(1, $_POST['aangenomen'], PDO::PARAM_INT);
		$statement->bindParam(2, $_POST['instrumentalist'], PDO::PARAM_INT);
		$statement->bindParam(3, $_POST['instrumenten'], PDO::PARAM_STR);
		$statement->bindParam(4, $_POST['instr'], PDO::PARAM_STR);
		$statement->bindParam(5, $_POST['niveau_i'], PDO::PARAM_STR);
		$statement->bindParam(6, $_POST['ervaring_i'], PDO::PARAM_STR);
		$statement->bindParam(7, $_POST['stukken_i'], PDO::PARAM_STR);
		$statement->bindParam(8, $_POST['solozanger'], PDO::PARAM_INT);
		$statement->bindParam(9, $_POST['zanger'], PDO::PARAM_INT);
		$statement->bindParam(10, $_POST['zangstem'], PDO::PARAM_STR);
		$statement->bindParam(11, $_POST['niveau_z'], PDO::PARAM_STR);
		$statement->bindParam(12, $_POST['niveau_s'], PDO::PARAM_STR);
		$statement->bindParam(13, $_POST['rol_z'], PDO::PARAM_STR);
		$statement->bindParam(14, $_POST['ervaring_z'], PDO::PARAM_STR);
		$statement->bindParam(15, $_POST['stukken_z'], PDO::PARAM_STR);
		$statement->bindParam(16, $_POST['toehoorder'], PDO::PARAM_INT);
		$statement->bindParam(17, $_POST['vervoer'], PDO::PARAM_STR);
		$statement->bindParam(18, $_POST['busheen'], PDO::PARAM_BOOL);
		$statement->bindParam(19, $_POST['busterug'], PDO::PARAM_BOOL);
		$statement->bindParam(20, $_POST['bus_bijzonderheden'], PDO::PARAM_STR);
		$statement->bindParam(21, $_POST['acc_wens'], PDO::PARAM_STR);
		$statement->bindParam(22, $_POST['eenpersoons'], PDO::PARAM_INT);
		$statement->bindParam(23, $_POST['meerpers'], PDO::PARAM_INT);
		$statement->bindParam(24, $_POST['kamperen'], PDO::PARAM_INT);
		$statement->bindParam(25, $_POST['hotel_2pp'], PDO::PARAM_INT);
		$statement->bindParam(26, $_POST['hotel_1pp'], PDO::PARAM_INT);
		$statement->bindParam(27, $_POST['eigen_acc'], PDO::PARAM_INT);
		$statement->bindParam(28, $_POST['storting_fonds'], PDO::PARAM_INT);
		$statement->bindParam(29, $_POST['donatie'], PDO::PARAM_STR);
		$statement->bindParam(30, $_POST['opmerkingen'], PDO::PARAM_STR);
		$statement->bindParam(31, $_POST['aanbet_bedrag'], PDO::PARAM_INT);
		$statement->bindParam(32, $_POST['cursusgeld'], PDO::PARAM_INT);
		$statement->bindParam(33, $_POST['voorl_bev'], PDO::PARAM_STR);
		$statement->bindParam(34, $_POST['inzeepdag'], PDO::PARAM_STR);
		$statement->bindParam(35, $_POST['afgewezen'], PDO::PARAM_INT);
		$statement->bindParam(36, $_POST['datum_inschr'], PDO::PARAM_STR);
		$statement->bindParam(37, $_POST['aanmaning_inschr'], PDO::PARAM_STR);
		$statement->bindParam(38, $_POST['DlnmrId_FK'], PDO::PARAM_INT);
		$statement->bindParam(39, $_POST['CursusId_FK'], PDO::PARAM_INT);
		$statement->bindParam(40, $_POST['diner'], PDO::PARAM_INT);
		$statement->bindParam(41, $_POST['InschId'], PDO::PARAM_INT);

$statement->execute();
}

// begin Recordset Inschrijvingen van een deelnemer
$DlnmrId_FK = '-1';
if (isset($_GET['DlnmrId']) and !(isset($_POST["Leegmaken"]) and ($_POST['Leegmaken'] == "Leegmaken"))) {
	$DlnmrId_FK = $_GET['DlnmrId'];
	}
if (isset($_GET['alles']) and $_GET['alles'] == 'on')
	$query_inschrijving = "SELECT * FROM inschrijving WHERE DlnmrId_FK = {$DlnmrId_FK} 
	ORDER BY CursusId_FK ASC";
else
	$query_inschrijving = "SELECT * FROM inschrijving WHERE DlnmrId_FK = {$DlnmrId_FK} AND CursusId_FK BETWEEN 
	{$eerstecursus} AND {$laatstecursus} ORDER BY CursusId_FK ASC";

// printf('$query_inschrijving = '. $query_inschrijving);

$inschrijving = select_query($query_inschrijving, 'InschId');
if (is_array($inschrijving)) $aantal_inschrijvingen = count($inschrijving);
	else $aantal_inschrijvingen = 0;
// end Recordset Inschrijvingen van een deelnemer

// begin Recordset Cursusnamen
$cursus = select_query("SELECT CursusId, cursusnaam_nl, YEAR(datum_begin) as jaar FROM cursus ORDER BY CursusId ASC", 'CursusId');

// begin Recordset Dlnmr voor deelnemersnaam
$DlnmrId = '-1';
if (isset($_GET['DlnmrId'])) {
  $DlnmrId = $_GET['DlnmrId'];
}
$dlnmr = select_query("SELECT naam FROM dlnmr WHERE DlnmrId = {$DlnmrId};", 1);

// end Recordset

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Update inschrijvingen</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
		<!--
		function GP_popupConfirmMsg(msg) { //v1.0
		  document.MM_returnValue = confirm(msg);
		}
		// -->
	</SCRIPT>
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
if (isset($inschrijving['InschId'])) $_POST['InschId'] = $inschrijving['InschId'];
if (is_array($nschrijving) and count($inschrijving) > 1) {
		echo "<tr><td colspan=\"3\">";
		echo "<p><b>Kies één van de volgende inschrijvingen:</b></p>";	
		echo "<form action=\"{$editFormAction}\" method=\"get\" name=\"inschrijving\" id=\"inschrijving\"> \n <select name=\"InschId\" size=\"{$aantal_inschrijvingen}\" >";
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
d($ins);
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
      <td colspan="3"><?php if ($ins['CursusId_FK'] != "") echo "Inschrijving nr. <input name=\"InschId\" type=\"text\" class=\"uit\" value=\"{$ins['InschId']}\" size=\"2\">&nbsp;&nbsp;<b>{$cursus[$ins['CursusId_FK']]['cursusnaam_nl']}</b>"; ?>
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
      <td nowrap align="right">Zanger:</td>
      <td width="119"><input type="checkbox" name="zanger" id="zang_checkbox" value="1" <?php if (!(strcmp($ins['zanger'],"1"))) {echo "checked";} ?> /></td>
      <td width="123" align="right">solozanger:</td>
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
      <td><input type="checkbox" name="toehoorder" value="1" <?php if (!(strcmp($ins['toehoorder'],"1"))) {echo "checked";} ?> /></td>
      <td align="right">Diner bij eigen acc.</td>
      <td><input name="diner" type="checkbox" id="diner" value="1" <?php if (!(strcmp($ins['diner'],"1"))) {echo "checked";} ?> />
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
        <input type="checkbox" name="kamperen" value="1" <?php if (!(strcmp($ins['kamperen'],"1"))) {echo "checked";} ?>/></td>
      <td align="center">meerpersoons:
        <input name="meerpers" type="checkbox" id="meerpers" value="1" <?php if (!(strcmp($ins['meerpers'],"1"))) {echo "checked";} ?>/></td>
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