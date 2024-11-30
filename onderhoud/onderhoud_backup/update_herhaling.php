<?php //Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');
require_once("../includes/LPmailer.inc.php");

// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

d($_GET);
d($_POST);

$cursus = $eerstecursus + 2;
if (isset($_GET['cursus']) and ($_GET['cursus'] != "")) $cursus = $_GET['cursus'] + $cursus_offset;

$herhaling[$cursus] = "donderdag/zaterdag 8-10 februari 2018";

// begin Recordset instrumententabel
$query_instrumenten = "SELECT * FROM instr ORDER BY id ASC";
$instrumenten = select_query($query_instrumenten);
$totalRows_instrumenten = count($instrumenten);
foreach ($instrumenten as $instr) $instrumententabel[$instr['id']] = $instr['nl'];
d($instrumententabel);

// end Recordset instrumententabel

function instrument($instr)
{
	global $instrumententabel;
	$ins = explode(', ', trim($instr));
	unset($instrumenten);
	d($ins);
	if (is_array($ins) and $ins[0] != '') {
		foreach ($ins as $in) if (isset($instrumententabel[$in]) and $instrumententabel[$in] != '') $instrumenten[] = $instrumententabel[$in];
		else echo 'De index = ' . $in . '<br>';
		$instrumenten = implode(', ', $instrumenten);
		return $instrumenten;
	}
}

function lijst($tabel)
{
	global $cursus;
	if (is_array($tabel)) $aantal = count($tabel);
	else $aantal = 0;
	if ($aantal > 0) {
		echo '<p class="spelers">';
		foreach ($tabel as $t) echo $t['naam'] . ', ' . instrument($t['instr']) . '<br>';
		echo '</p>';
	}
	return $aantal;
}
// begin Update gegevens deelname herhalingsconcert
if (isset($_GET['DlnmrId']) and ($_GET['DlnmrId'] != "") and isset($_POST["verzend"]) and ($_POST['verzend'] == "Update deelname herhalingsconcert")) {
	$updateSQL = sprintf(
		"UPDATE inschrijving SET herhaling=%s, herhaling_txt=%s WHERE DlnmrId_FK=%s AND CursusId_FK = %s",
		GetSQLValueString($_POST['herhaling'], "int"),
		GetSQLValueString($_POST['herhaling_txt'], "text"),
		GetSQLValueString($_GET['DlnmrId'], "int"),
		$cursus
	);

	exec_query($updateSQL);
}
// end Update gegevens deelname herhalingsconcert

// begin Recordset Cursusnamen
$query_cursussen = sprintf(
	"SELECT * FROM cursus WHERE CursusId BETWEEN %s AND %s ORDER BY CursusId ASC",
	$eerstecursus,
	$laatstecursus
);
$cursussen = select_query($query_cursussen);
$totaal_cursussen = count($cursussen);
foreach ($cursussen as $cur) $cursusnaam[$cur['CursusId']] = $cur['cursusnaam_nl'];
d($cursusnaam);
// end Recordset Cursusnamen

// begin Recordset gegevens deelname herhalingsconcert
$colname__inschrijving = '-1';
if (isset($_GET['DlnmrId']) and ($_GET['DlnmrId'] != "")) {
	$colname__inschrijving = $_GET['DlnmrId'];
}
$query_deelnemer = sprintf(
	"SELECT naam, instr, herhaling, herhaling_txt FROM inschrijving, dlnmr WHERE DlnmrId_FK = DlnmrId AND CursusId_FK = %s AND DlnmrId_FK = %s",
	$cursus,
	$colname__inschrijving
);

$deelnemer = select_query($query_deelnemer, 1);
// end Recordset gegevens deelname herhalingsconcert

// begin Recordset deelname herhalingsconcert alle ingeschrevenen
$query_inschrijving = "SELECT naam, instr, herhaling_txt FROM inschrijving, dlnmr WHERE DlnmrId = DlnmrId_FK AND aangenomen = 1 AND NOT(toehoorder <=> 1) AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND herhaling = 1 AND CursusId_FK = {$cursus} ORDER BY instr";
d($query_inschrijving);
$inschrijving = select_query($query_inschrijving);
// end Recordset deelname herhalingsconcert alle ingeschrevenen

// begin Recordset deelname herhalingsconcert alle niet-deelnemers
$query_uitschrijving = "SELECT naam, instr, herhaling_txt FROM inschrijving, dlnmr WHERE DlnmrId = DlnmrId_FK AND aangenomen = 1 AND NOT(toehoorder <=> 1) AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND herhaling = 0 AND CursusId_FK = {$cursus} ORDER BY instr";
d($query_uitschrijving);
$uitschrijving = select_query($query_uitschrijving);
// end Recordset deelname herhalingsconcert alle niet-deelnemers

// begin Recordset deelname herhalingsconcert allen die nog niet gereageerd hebben
$query_onbekend = "SELECT naam, instr, herhaling_txt FROM inschrijving, dlnmr WHERE DlnmrId = DlnmrId_FK AND aangenomen = 1 AND Not (afgewezen <=> 1) AND NOT(toehoorder <=> 1) AND achternaam NOT LIKE \"%XXX%\" AND achternaam NOT LIKE \"%YYY%\" AND achternaam NOT LIKE \"%ZZZ%\" AND (herhaling IS NULL OR herhaling = 2) AND CursusId_FK = {$cursus} ORDER BY instr";
d($query_onbekend);
$onbekend = select_query($query_onbekend);
// end Recordset deelname herhalingsconcert allen die nog niet gereageerd hebben

?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Update deelname herhalingsconcert</title>
	<link rel="stylesheet" href="../css/pellegrina_stijlen.css" type="text/css">
	<link rel="stylesheet" href="../css/w3.css" type="text/css">
	<SCRIPT TYPE="text/javascript">
		<!--
		function ZoekCursus(nr) {
			document.zoek.cursus.value = nr;
			document.zoek.submit();
		}
		-->
	</SCRIPT>
</head>

<body>
	<table class="w3-table">
		<tr>
			<td colspan="3">
				<form id="zoek" name="zoek" method="get" action="<?php echo $editFormAction; ?>">
					<table width="100%" border="1" align="left" cellpadding="5" class="onzichtbaar">
						<tr>
							<td><input name="DlnmrId" type="input" value="<?php if (isset($_GET['DlnmrId'])) echo $_GET['DlnmrId']; ?>" size="5" />
								<input type="submit" name="Submit" value="Zoek">
								&nbsp;
							</td>
							<td>Cursus:
								<input type="radio" name="cursus" value="1" <?php
																			if (isset($_GET['cursus']) and ($_GET['cursus'] == "1")) echo 'checked'; ?> onClick="ZoekCursus(1)">
								I klassiek&nbsp;
								<input type="radio" name="cursus" value="2" <?php
																			if (isset($_GET['cursus']) and ($_GET['cursus'] == "2")) echo 'checked'; ?> onClick="ZoekCursus(2)">
								II romantisch
							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
	<form action="<?php echo $editFormAction; ?>" method="POST" name="update" id="update">
		<h4>Cursus: <em><?php echo $cursusnaam[$cursus]; ?></em></h4>
		<h2><?php $instrumenten = instrument($deelnemer['instr']);
			if ($deelnemer['naam'] != '') echo $deelnemer['naam'] . ', ' . $instrumenten; ?>
		</h2>
		<p>
			<label>Neemt |
				<input type="radio" name="herhaling" value="1" id="herhaling_1" <?php
																				if ($deelnemer['herhaling'] == "1") echo 'checked'; ?>>
				wel | </label>
			<label><input type="radio" name="herhaling" value="0" id="herhaling_0" <?php
																					if ($deelnemer['herhaling'] != "1") echo 'checked'; ?>>
				niet | </label>
			<label><input type="radio" name="herhaling" value="2" id="herhaling_2" <?php
																					if ($deelnemer['herhaling'] == "2") echo 'checked'; ?>>
				[weet nog niet] | </label>deel aan herhalingsconcert <?php echo $herhaling[$cursus] ?>
		</p>
		<label class="w3-left">Opmerkingen: <textarea name="herhaling_txt" cols="70" rows="1" id="herhaling_txt"><?php echo $deelnemer['herhaling_txt']; ?></textarea></label>
		<div class="w3-left">
			<input class="w3-btn w3-margin-left w3-green" type="submit" name="verzend" value="Update deelname herhalingsconcert" />
		</div>
	</form>
	<div class="w3-panel w3-container w3-left">
		<hr>
		<h3>Geregistreerde deelnemers herhalingsconcert <?php echo $cursusnaam[$cursus] ?>:</h3>
		<?php $aantal_inschrijving = lijst($inschrijving); ?>
		<p>Totaal deelnemers: <?php echo $aantal_inschrijving ?></p>

		<hr>
		<h3>Niet mee doen:</h3>
		<?php $aantal_uitschrijving = lijst($uitschrijving); ?>
		<p>Totaal niet-deelnemers: <?php echo $aantal_uitschrijving ?></p>

		<hr>
		<h3>Nog niet gereageerd hebben:</h3>
		<?php $aantal_onbekend = lijst($onbekend); ?>
		<p>Totaal nog niet gereageerd: <?php echo $aantal_onbekend ?></p>
	</div>
</body>

</html>