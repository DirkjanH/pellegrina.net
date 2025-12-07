<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1);
error_reporting(E_ALL);

Kint::$enabled_mode = false;

if (isset($_POST['DlnmrId']) and $_POST['DlnmrId'] != '') $DlnmrId = $_SESSION['DlnmrId'] = $_POST['DlnmrId'];
elseif (isset($_SESSION['DlnmrId']) and $_SESSION['DlnmrId'] != '') $DlnmrId = $_SESSION['DlnmrId'];
else $DlnmrId = -1;

d($_GET, $_SESSION, $_POST);

// begin Recordset
$query_instrumenten = "SELECT * FROM instr ORDER BY id ASC";
$instrumenten = select_query($query_instrumenten);
foreach ($instrumenten as $instr) $instrumententabel[$instr['id']] = $instr['nl'];
d($instrumententabel);
// end Recordset

function instrument($instr)
{
	global $instrumententabel;
	$ins = explode(', ', $instr);
	unset($instrumenten);
	foreach ($ins as $in) $instrumenten[] = $instrumententabel[$in];
	return implode(', ', $instrumenten);
}

// begin voeg gegevens zwarte lijst toe
if (isset($DlnmrId) and $DlnmrId != '' and isset($_POST["verzend"]) and ($_POST['verzend'] == "Voeg toe")) {
	$insertSQL = sprintf(
		"INSERT INTO zwartelijst (DlnmrId_FK, categorie, datum, opmerkingen) VALUES (%s, %s, NOW(), %s)",
		quote($DlnmrId),
		quote($_POST['categorie']),
		quote($_POST['opmerkingen'])
	);
	exec_query($insertSQL);
}
// end voeg gegevens zwarte lijst toe

// begin update gegevens zwarte lijst 
if (isset($DlnmrId) and ($DlnmrId != "") and isset($_POST["verzend"]) and ($_POST['verzend'] == "Update")) {
	$query_update_zwartelijst = "UPDATE zwartelijst SET categorie = {$_POST['categorie']}, datum = NOW(), 
	opmerkingen = \"{$_POST['opmerkingen']}\" WHERE DlnmrId_FK = {$DlnmrId}";
	exec_query($query_update_zwartelijst);
}
// end update gegevens zwarte lijst 

// begin wis gegevens zwarte lijst
if (isset($DlnmrId) and ($DlnmrId != "") and isset($_POST["verzend"]) and ($_POST['verzend'] == "Wis")) {
	$insertSQL = "DELETE FROM zwartelijst WHERE DlnmrId_FK = {$DlnmrId}";
	exec_query($insertSQL);
}
// end wis gegevens zwarte lijst

// begin Recordset gegevens zwarte lijst
$colname__inschrijving = '-1';
if (isset($DlnmrId) and ($DlnmrId != "")) {
	$colname__inschrijving = $DlnmrId;
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
if (isset($zwartelijst) and is_array($zwartelijst)) $aantal_zwl = count($zwartelijst);
else $aantal_zwl = 0;
// end Recordset deelname alle ingeschrevenen zwarte lijst
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
	<title>LP zwarte lijst</title>
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css">
	<link rel="stylesheet" href="/css/zoeknaam.css">
	<style type="text/css">
		<!-- 
		.categorie1 {
			background-color: #FBFBC7;
		}

		.categorie2 {
			background-color: #FFCACA;
		}
		-->
	</style>
</head>

<body>
	<div id="zoeknaam"> <?php require_once('LP_zoeknaam.php'); ?> </div>
	<div id="mainframe">
		<header id="navigatiebalk"> <?php require_once('LP_navigatie.php'); ?>
		</header>
		<div id="mainpage" style="max-width: 900px;" class="w3-panel w3-white">
			<table class="onzichtbaar">
				<tr>
					<td colspan="3">
						<form id="zoek" name="zoek" method="GET"
							action="<?php echo $editFormAction; ?>">
							<table width="100%" border="1" align="left"
								cellpadding="5">
								<tr>
									<td><input name="DlnmrId" type="input"
											value="<?php if (isset($DlnmrId))
														echo $DlnmrId; ?>" size="5" />
										<input type="submit" name="Submit"
											value="Zoek"> &nbsp;
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
			<form action="<?php echo $editFormAction; ?>" method="POST"
				name="update" id="update">
				<div class="w3-card-4 w3-margin-top">
					<table class="w3-table w3-white w3-border-blue-gray"
						cellspacing="0" cellpadding="5">
						<tr>
							<td width="25%" rowspan="2" valign="top">
								<h2> <?php if ($deelnemer['naam'] != '') echo $deelnemer['naam']; ?>
								</h2>
							</td>
							<td>
								<label>
									<div align="right">Categorie:</div>
								</label>
							</td>
							<td class="categorie1"><label>
									<input type="radio" name="categorie"
										value="1"
										<?php if ($deelnemer['categorie'] == "1") echo 'checked'; ?>>
									waarschuwing</label>
							</td>
							<td class="categorie2"><label>
									<input type="radio" name="categorie"
										value="2"
										<?php if ($deelnemer['categorie'] == "2") echo 'checked'; ?>>
									def. ontzegging</label>
							</td>
							<td><input type="submit" name="verzend"
									value="Voeg toe" />
								<input type="submit" name="verzend"
									value="Update" />
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
								<textarea name="opmerkingen" cols="60" rows="3"
									id="opmerkingen"><?php
														echo $deelnemer['opmerkingen']; ?></textarea>
							</td>
						</tr>
					</table>
				</div> <?php if ($aantal_zwl > 0) {
							echo '<br><hr>'; ?> <table
						class="w3-table w3-striped w3-border-blue-gray">
						<caption align="top" class="w3-large w3-text-blue-grey">
							Geregistreerde personen op zwarte lijst: </caption>
						<tr>
							<th width="20%" scope="col">Naam:&nbsp;</th>
							<th width="20%" scope="col">Instrument/stem:&nbsp;</th>
							<th scope="col">Datum:&nbsp;</th>
							<th scope="col">Opmerkingen:&nbsp;</th>
						</tr> <?php foreach ($zwartelijst as $zwl) { ?> <tr>
								<td
									class="<?php echo 'categorie' . $zwl['categorie']; ?>">
									<a
										href="<?php echo $_SERVER['PHP_SELF'] . '?DlnmrId=' . $zwl['DlnmrId']; ?>">
										<?php echo $zwl['naam']; ?> </a>&nbsp;
								</td>
								<td> <?php echo instrument($zwl['instr']); ?>&nbsp;</td>
								<td> <?php echo $zwl['datum']; ?>&nbsp;</td>
								<td> <?php echo $zwl['opmerkingen']; ?>&nbsp;</td>
							</tr> <?php }
							} ?>
					</table>
					<?php echo "<p>Totaal aantal personen op de zwarte lijst: {$aantal_zwl}</p>"; ?>
			</form>
			</p>
		</div>
		<!-- InstanceEndEditable -->
	</div>
</body>

</html>