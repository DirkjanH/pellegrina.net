<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');
// stel php in dat deze fouten weergeeft
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

if (isset($_GET['DlnmrId'])) $_GET['DlnmrId'] = str_replace('SID', '', $_GET['DlnmrId']);

d($_GET);

// begin Recordset
$query_instrumenten = "SELECT * FROM instr ORDER BY id ASC";
$instrumenten = select_query($query_instrumenten);
foreach ($instrumenten as $instr) $instrumententabel[$instr['id']] = $instr['nl'];
d($instrumententabel);
// end Recordset

function instrument($instr)
{
	global $instrumententabel;
	if (isset($instr)) $ins = explode(', ', $instr);
	unset($instrumenten);
	if (is_array($ins)) foreach ($ins as $in) $instrumenten[] = $instrumententabel[$in];
	else $instrumenten[] = 'onbekend';
	return implode(', ', $instrumenten);
}

// begin voeg gegevens zwarte lijst toe
if (isset($_GET['DlnmrId']) and ($_GET['DlnmrId'] != "") and isset($_POST["verzend"]) and ($_POST['verzend'] == "Voeg toe")) {
	$insertSQL = sprintf(
		"INSERT INTO zwartelijst (DlnmrId_FK, categorie, datum, opmerkingen) VALUES (%s, %s, NOW(), %s)",
		GetSQLValueString($_GET['DlnmrId'], "int"),
		GetSQLValueString($_POST['categorie'], "int"),
		GetSQLValueString($_POST['opmerkingen'], "text")
	);
	exec_query($insertSQL);
}
// end voeg gegevens zwarte lijst toe

// begin update gegevens zwarte lijst 
if (isset($_GET['DlnmrId']) and ($_GET['DlnmrId'] != "") and isset($_POST["verzend"]) and ($_POST['verzend'] == "Update")) {
	$query_update_zwartelijst = "UPDATE zwartelijst SET categorie = {$_POST['categorie']}, datum = NOW(), 
	opmerkingen = \"{$_POST['opmerkingen']}\" WHERE DlnmrId_FK = {$_GET['DlnmrId']}";
	exec_query($query_update_zwartelijst);
}
// end update gegevens zwarte lijst 

// begin wis gegevens zwarte lijst
if (isset($_GET['DlnmrId']) and ($_GET['DlnmrId'] != "") and isset($_POST["verzend"]) and ($_POST['verzend'] == "Wis")) {
	$insertSQL = "DELETE FROM zwartelijst WHERE DlnmrId_FK = {$_GET['DlnmrId']}";
	exec_query($insertSQL);
}
// end wis gegevens zwarte lijst

// begin Recordset gegevens zwarte lijst
$colname__inschrijving = '-1';
if (isset($_GET['DlnmrId']) and ($_GET['DlnmrId'] != "")) {
	$colname__inschrijving = $_GET['DlnmrId'];
}
$query_deelnemer = sprintf(
	"SELECT * FROM dlnmr d, zwartelijst z WHERE DlnmrId = DlnmrId_FK AND DlnmrId = %s",
	$colname__inschrijving
);

$deelnemer = select_query($query_deelnemer, 1);

if (is_array($deelnemer) and count($deelnemer) < 1) {
	$query_deelnemer = sprintf(
		"SELECT * FROM dlnmr WHERE DlnmrId = %s",
		$colname__inschrijving
	);

	$deelnemer = select_query($query_deelnemer);
}
// end Recordset gegevens zwarte lijst

// begin Recordset deelname alle ingeschrevenen zwarte lijst
$query_zwartelijst = "SELECT
  naam,
  categorie,
  z.opmerkingen,
  z.datum,
  i.instr,
  d.DlnmrId
FROM zwartelijst z,
  dlnmr d,
  inschrijving i
WHERE z.DlnmrId_FK = d.DlnmrId
    AND z.DlnmrId_FK = i.DlnmrId_FK
    AND CursusId_FK = (select
                            Max(CursusId_FK)
                          from inschrijving
                          where d.DlnmrId = DlnmrId_FK)
ORDER BY achternaam";

$zwartelijst = select_query($query_zwartelijst);
$aantal_zwl = count($zwartelijst);
// end Recordset deelname alle ingeschrevenen zwarte lijst

?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Update zwarte lijst</title>
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
	<style type="text/css">
		.categorie1 {
			background-color: #FBFBC7;
		}

		.categorie2 {
			background-color: #FFCACA;
		}
	</style>
</head>

<body>
	<div class="w3-panel w3-white">
		<table class="onzichtbaar">
			<tr>
				<td colspan="3">
					<form id="zoek" name="zoek" method="GET" action="<?php echo $editFormAction; ?>">
						<table width="100%" border="1" align="left" cellpadding="5">
							<tr>
								<td><input name="DlnmrId" type="input" value="<?php if (isset($_GET['DlnmrId']))
																					echo $_GET['DlnmrId']; ?>" size="5" />
									<input type="submit" name="Submit" value="Zoek"> &nbsp;
								</td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
		</table>
		<form action="<?php echo $editFormAction; ?>" method="POST" name="update" id="update">
			<div class="w3-card-4 w3-margin-top">
				<table class="w3-table w3-border-blue-gray">
					<tr>
						<td width="25%" rowspan="2" valign="top">
							<h2>
								<?php if (isset($deelnemer['naam']) and $deelnemer['naam'] != '') echo $deelnemer['naam']; ?>
							</h2>
						</td>
						<td>
							<label>
								<div align="right">Categorie:</div>
							</label>
						</td>
						<td class="categorie1"><label>
								<input type="radio" name="categorie" value="1" <?php if ($deelnemer['categorie'] == "1") echo 'checked'; ?>>
								waarschuwing</label>
						</td>
						<td class="categorie2"><label>
								<input type="radio" name="categorie" value="2" <?php if ($deelnemer['categorie'] == "2") echo 'checked'; ?>>
								def. ontzegging</label>
						</td>
						<td>&nbsp;&nbsp;<input type="submit" name="verzend" value="Voeg toe" />
							<input type="submit" name="verzend" value="Update" />
							<input type="submit" name="verzend" value="Wis">
						</td>
					</tr>
					<tr>
						<td valign="top">
							<label>
								<div align="right">Opmerkingen: </div>
							</label>
						</td>
						<td colspan="3">
							<textarea name="opmerkingen" cols="70" rows="3" id="opmerkingen"><?php
																								echo $deelnemer['opmerkingen']; ?></textarea>
						</td>
					</tr>
				</table>
			</div>
			<?php if ($aantal_zwl > 0) {
				echo '<br><hr>'; ?>
				<table class="w3-table w3-striped w3-border-blue-gray">
					<caption align="top" class="w3-large w3-text-blue-grey">
						Geregistreerde personen op zwarte lijst:
					</caption>
					<tr>
						<th width="20%" scope="col">Naam:&nbsp;</th>
						<th width="20%" scope="col">Instrument/stem:&nbsp;</th>
						<th scope="col">Datum:&nbsp;</th>
						<th scope="col">Opmerkingen:&nbsp;</th>
					</tr>
					<?php foreach ($zwartelijst as $zwl) { ?>
						<tr>
							<td class="<?php echo 'categorie' . $zwl['categorie']; ?>">
								<a href="<?php echo $_SERVER['PHP_SELF'] . '?DlnmrId=' . $zwl['DlnmrId']; ?>">
									<?php echo $zwl['naam']; ?>
								</a>&nbsp;
							</td>
							<td>
								<?php echo instrument($zwl['instr']); ?>&nbsp;</td>
							<td>
								<?php echo $zwl['datum']; ?>&nbsp;</td>
							<td>
								<?php echo $zwl['opmerkingen']; ?>&nbsp;</td>
						</tr>
				<?php }
				} ?>
				</table>
				<?php echo "<p>Totaal aantal personen op de zwarte lijst: {$aantal_zwl}</p>"; ?>
		</form>
		</p>
	</div>
</body>

</html>