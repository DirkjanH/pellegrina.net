<?php //Connection statement
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');
$CursusId = $eerstecursus;
if (isset($_GET['cursus']) and $_GET['cursus'] != "")
	$CursusId = $_GET['cursus'] + $cursus_offset; // cursusnummer

$ook_niet_aangenomen = ''; // ook niet-aangenomen deelnemers 

if (empty($_GET['gepostuleerd']) or $_GET['gepostuleerd'] != 1)
	$ook_gepostuleerd = 'AND NOT (d.naam LIKE "%XXX%" OR d.naam LIKE "%YYY%" OR d.naam LIKE "%ZZZ%")'; // geen gepostuleerde deelnemers
else
	$ook_gepostuleerd = '';

$sorteer = 'd.achternaam';

if (isset($_GET['sorteer']) and $_GET['sorteer'] != "")
	switch ($_GET['sorteer']) {
		case "Name:":
			$sorteer = 'd.achternaam';
			break;
		case "Address:":
			$sorteer = 'a.postcode, d.achternaam';
			break;
		case "Instruments:":
			$sorteer = 'i.instrumenten, d.achternaam';
			break;
		case "Singing voice:":
			$sorteer = 'i.zangstem, i.instrumenten, d.achternaam';
			break;
		case "Transport:":
			$sorteer = 'i.vervoer, d.achternaam';
			break;
	}

/* echo '<pre>';
print_r($_GET);
echo '</pre>';
 */
//Stel utf8 (uitgebreide character set) in:
mysql_query("SET NAMES UTF8");

// begin Recordset
$query_Cursus = "SELECT d.naam, CONCAT(a.adres, \", \", a.postcode, \" \", a.plaats, \", \", a.land) as \"adres\", d.telefoon, 		d.mobiel, d.email, i.instr, i.instrumenten, i.toehoorder, i.zangstem, i.vervoer, i.aangenomen FROM dlnmr d, adres a, inschrijving i WHERE i.CursusId_FK = {$CursusId} AND d.adresid_FK = a.adresid AND d.dlnmrid = i.dlnmrid_fk 
AND NOT (afgewezen <=> 1) {$ook_niet_aangenomen} {$ook_gepostuleerd} ORDER BY {$sorteer} ASC";

/* echo '<pre>';
print_r($query_Cursus);
echo '</pre>';
 */
$Cursus = $inschrijf->SelectLimit($query_Cursus) or die($inschrijf->ErrorMsg());
$totalRows_Cursus = $Cursus->RecordCount();

$toehoorders_Cursus = "SELECT * FROM inschrijving WHERE CursusId_FK = {$CursusId} AND toehoorder = 1 and NOT (afgewezen <=> 1)";
$toe = $inschrijf->SelectLimit($toehoorders_Cursus) or die($inschrijf->ErrorMsg());
$toehoorders_Cursus = $toe->RecordCount();

$query_Cursusnaam = "SELECT cursusnaam_en, YEAR(datum_begin) as jaar FROM cursus WHERE CursusId = {$CursusId}";
$Cursusnaam = $inschrijf->SelectLimit($query_Cursusnaam) or die($inschrijf->ErrorMsg());
$totalRows_Cursusnaam = $Cursusnaam->RecordCount();

$query_Docenten = "SELECT naam, CONCAT(adres, \", \", PC, \" \", plaats, \", \", land) as adres, telefoon, mobiel, email, cd.vak FROM cursus as c, cursusdocenten AS cd, docenten AS d WHERE CursusId_FK = {$CursusId} AND cd.DocId_FK = d.DocId AND c.CursusId = cd.CursusID_FK ORDER BY d.achternaam";
$Docenten = $inschrijf->SelectLimit($query_Docenten) or die($inschrijf->ErrorMsg());
$totalRows_Docenten = $Docenten->RecordCount();
// end Recordset

// begin Recordset
$query_instrumenten = "SELECT * FROM instr ORDER BY id ASC";
$instrumenten = $inschrijf->SelectLimit($query_instrumenten) or die($inschrijf->ErrorMsg());
$totalRows_instrumenten = $instrumenten->RecordCount();
while (!$instrumenten->EOF) {
	$instrumententabel[$instrumenten->Fields('id')] = $instrumenten->Fields('en');
	$instrumenten->MoveNext();
}
// end Recordset

/* echo '<pre>';
print_r($instrumententabel);
echo '</pre>';
 */
?>
<!DOCTYPE HTML>
<?php //PHP ADODB document - made with PHAkt 2.5.1
?>
<html><!-- InstanceBegin template="/Templates/LP.dwt.php" codeOutsideHTMLIsLocked="false" -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

<!-- CSS: -->
<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
<link rel="stylesheet" href="/css/pagina_stijlen.css" type="text/css">

<head>
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>List of participants</title>

	<style type="text/css">
		<!--
		body {
			margin-left: 20px;
			margin-top: 20px;
			margin-right: 20px;
		}

		table {
			table-layout: auto;
			width: 100%;
			border: 3px double #000000;
			border-collapse: collapse;
		}

		td {
			border: 1px solid #000000;
			padding: 0.4em;
		}

		td.iks {
			text-align: center;
		}

		tr.gepostuleerd {
			background: #FCF;
		}

		tr.niet_aangenomen {
			background: #9FC;
		}
		-->
	</style>
	<!-- InstanceEndEditable -->
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
</head>

<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
	<div class="inhoud">
		<div id="main">
			<!-- InstanceBeginEditable name="mainpage" -->
			<div id="inhoud">
				<form action="<?php echo $editFormAction; ?>" method="get" name="form" id="form">
					<input name="cursus" type="hidden" value="<?php echo $_GET['cursus']; ?>">
					<input name="niet_aangenomen" type="hidden" value="<?php echo $_GET['niet_aangenomen']; ?>">
					<h2>Course <em><?php echo $Cursusnaam->Fields('cursusnaam_en') . '</em>&nbsp;' . $Cursusnaam->Fields('jaar') . '</h2><p>' . $totalRows_Cursus; ?> participants<?php if ($toehoorders_Cursus > 0) echo ", including {$toehoorders_Cursus} auditor(s)"; ?>
							<table>
								<tr>
									<th><input type="submit" name="sorteer" value="Name:" accesskey="N"></th>
									<th><input type="submit" name="sorteer" value="Instruments:" accesskey="I"></th>
									<th><input type="submit" name="sorteer" value="Singing voice:" accesskey="V"></th>
									<th>Telephone:</th>
									<th>Mobile:</th>
								</tr>
								<?php
								while (!$Cursus->EOF) {
									$ins = explode(', ', $Cursus->Fields('instr'));
									unset($instr);
									unset($zangstem);
									foreach ($ins as $in) if ($in >= 100) $instr[] = $instrumententabel[$in];
									if (isset($instr)) $instr = implode(', ', $instr);
									$zangstem = $instrumententabel[$Cursus->Fields('zangstem')];
								?>
									<tr <?php if ($Cursus->Fields('aangenomen') != 1) echo 'class="niet_aangenomen"';
										if (
											strpos($Cursus->Fields('naam'), "XXX") or strpos($Cursus->Fields('naam'), "YYY")
											or strpos($Cursus->Fields('naam'), "ZZZ")
										) echo 'class="gepostuleerd"';
										?>>
										<td class="klein"><?php echo $Cursus->Fields('naam'); ?>&nbsp;</td>
										<td class="klein"><?php echo $instr; ?>&nbsp;</td>
										<td class="klein"><?php echo $zangstem; ?>&nbsp;</td>
										<td class="klein"><?php echo $Cursus->Fields('telefoon'); ?>&nbsp;</td>
										<td class="klein"><?php echo $Cursus->Fields('mobiel'); ?>&nbsp;</td>
									</tr>
								<?php
									$Cursus->MoveNext();
								}
								?>
							</table>
							<input name="niet_aangenomen" type="hidden" value="<?php echo $_GET['niet_aangenomen']; ?>">
							<input name="gepostuleerd" type="hidden" value="<?php echo $_GET['gepostuleerd']; ?>">
				</form>
			</div>
			<!-- InstanceEndEditable -->
		</div>
	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
<!-- InstanceEnd -->

</html>
<?php
$Cursus->Close();
$Docenten->Close();
?>