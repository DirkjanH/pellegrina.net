<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1);
error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');

session_start();
ob_start();

Kint::$enabled_mode = false;

d($_GET, $_POST);

// begin Recordset
$query_instrumenten = "SELECT * FROM instr ORDER BY id ASC";
$instrumenten = select_query($query_instrumenten);
$totalRows_instrumenten = count($instrumenten);
foreach ($instrumenten as $instrument) {
	$instrumententabel[$instrument['id']] = $instrument['en'];
}
d($instrumententabel);
// end Recordset

function instrument($instr)
{
	global $instrumententabel;
	d($instr);
	$ins = explode(', ', $instr);
	d($ins);
	unset($instrumenten);
	foreach ($ins as $in) $instrumenten[] = $instrumententabel[trim($in)];
	$instrumenten = implode(', ', $instrumenten);
	d($instrumenten);
	return $instrumenten;
}

function query_ensemble()
{
	global $ensemble, $inschrijf;
	$query_ensemble = "SELECT ensemble.Id as Id, ensemble.opmerking as opmerking, CONCAT_WS(': ',componist,titel) as werk, 
	docent1, docent2, ruimte, link, compleet, definitief FROM ensemble, werk 
	WHERE ensemble.Id = {$_SESSION['EnsembleId']} AND werk.Id = WerkId";
	$ensemble = select_query($query_ensemble, 1);
	$query_aantal_ensembleleden = sprintf(
		"SELECT count(Id) FROM ensemblelid as e, 
	dlnmr as d, inschrijving as i WHERE EnsembleId = %s AND e.InschId = i.InschId AND i.DlnmrId_FK = d.DlnmrId",
		GetSQLValueString($_SESSION['EnsembleId'], "int")
	);
	$ensemble['aantal'] = select_query($query_aantal_ensembleleden, 0);


	d($ensemble);
}

$pdfdirectory = '/pdf/';

if (!(isset($_SESSION['Set']) and $_SESSION['Set'] >= 0)) $_SESSION['Set'] = 1;
if (empty($_SESSION['Cursus'])) $_SESSION['Cursus'] = 1;
if (empty($_SESSION['WerkId'])) $_SESSION['WerkId'] = -1; // or $_SESSION['WerkId'] != 0
if (empty($_SESSION['EnsembleId'])) $_SESSION['EnsembleId'] = -1;
if (empty($_SESSION['zoeknaam'])) $_SESSION['zoeknaam'] = '';

if (isset($_POST['Set']) and $_POST['Set'] >= 0) {
	$_SESSION['Set'] = $_POST['Set'];
	$_SESSION['EnsembleId'] = -1;
	$_SESSION['WerkId'] = -1;
}
if (isset($_POST['Cursus']) and $_POST['Cursus'] > 0) {
	$_SESSION['Cursus'] = $_POST['Cursus'];
	$_SESSION['EnsembleId'] = -1;
	$_SESSION['WerkId'] = -1;
}
if (isset($_POST['zoeknaam'])) $_SESSION['zoeknaam'] = $_POST['zoeknaam'];
if (isset($_POST['zoekwerk'])) $_SESSION['zoekwerk'] = $_POST['zoekwerk'];
if (isset($_POST['WerkId'])) $_SESSION['WerkId'] = $_POST['WerkId'];
if (isset($_POST['EnsembleId']) and $_POST['EnsembleId'] >= 0) $_SESSION['EnsembleId'] = $_POST['EnsembleId'];
if (isset($_POST['ruimte']) and $_POST['ruimte'] != '') $_SESSION['ruimte'] = $_POST['ruimte'];

$_SESSION['Cursusnr'] = $_SESSION['Cursus'] + $cursus_offset;

d($_SESSION);

// Database-handelingen werken:

if (isset($_SESSION['WerkId']) and empty($_POST["submit_werk"])) {
	$query_werk = "SELECT * FROM werk WHERE Id = {$_SESSION['WerkId']}";
	d($query_werk);
	$werk = select_query($query_werk, 1);
	d($werk);
}

if ((isset($_POST["submit_werk"])) && ($_POST["submit_werk"] == "Add work")) {
	$insertSQL = sprintf(
		"INSERT INTO werk (componist, voornaam, titel, opmerking, bezetting) VALUES (%s, %s, %s, %s, %s)",
		GetSQLValueString(htmlspecialchars($_POST['componist']), "text"),
		GetSQLValueString(htmlspecialchars($_POST['voornaam']), "text"),
		GetSQLValueString(htmlspecialchars($_POST['titel']), "text"),
		GetSQLValueString(htmlspecialchars($_POST['opmerking']), "text"),
		GetSQLValueString(htmlspecialchars($_POST['bezetting']), "text")
	);

	exec_query($insertSQL);

	$werkId = $db->lastInsertId();
	d($werkId);
	$_SESSION['WerkId'] = $werkId;
	$query_werk = "SELECT * FROM werk WHERE Id = {$werkId}";
	d($query_werk);
	$werk = select_query($query_werk, 1);
}

if ((isset($_POST["submit_werk"])) && ($_POST["submit_werk"] == "Update work")) {
	$updateSQL = sprintf(
		"UPDATE werk SET componist=%s, voornaam=%s, titel=%s, bezetting=%s, opmerking=%s WHERE Id=%s",
		GetSQLValueString(htmlspecialchars($_POST['componist']), "text"),
		GetSQLValueString(htmlspecialchars($_POST['voornaam']), "text"),
		GetSQLValueString(htmlspecialchars($_POST['titel']), "text"),
		GetSQLValueString(htmlspecialchars($_POST['bezetting']), "text"),
		GetSQLValueString(htmlspecialchars($_POST['opmerking']), "text"),
		GetSQLValueString($_SESSION['WerkId'], "int")
	);

	exec_query($updateSQL);

	$query_werk = "SELECT * FROM werk WHERE Id = {$_SESSION['WerkId']}";
	$werk = select_query($query_werk, 1);
}

if ((isset($_POST["submit_werk"])) && ($_POST["submit_werk"] == "Edit work")) {
	$query_werk = "SELECT * FROM werk WHERE Id = {$_SESSION['WerkId']}";
	$werk = select_query($query_werk, 1);
}

if ((isset($_POST["submit_werk"])) && ($_POST["submit_werk"] == "Clear work")) {
	$query_werk = "SELECT * FROM werk WHERE Id = -1";
	$werk = select_query($query_werk, 1);
}

if ((isset($_POST["submit_werk"])) && ($_POST["submit_werk"] == "Erase work")) {
	$query_werk = "DELETE FROM werk WHERE Id = {$_SESSION['WerkId']}";
	exec_query($query_werk);
	$query_werk = "SELECT * FROM werk WHERE Id = -1";
	$werk = select_query($query_werk, 1);
}

// Database-handelingen ensemble:

if (empty($_POST["submit_ensemble"])) {
	query_ensemble();
}

if (empty($_POST["submit_ensemble"]) and isset($_POST["kies_werk"])/*  AND $_SESSION['WerkId'] >=  0*/) {
	if (isset($_SESSION['EnsembleId']) and $_SESSION['EnsembleId'] != -1) {
		$update_ensemble = "UPDATE ensemble SET WerkId = {$_SESSION['WerkId']} WHERE Id = {$_SESSION['EnsembleId']}";
		exec_query($update_ensemble);

		query_ensemble();
	} else {
		$query_ensemble = "SELECT CONCAT_WS(': ',componist,titel) as werk FROM werk WHERE Id = {$_SESSION['WerkId']}";
		$ensemble = select_query($query_ensemble);

		$insertSQL = sprintf(
			"INSERT INTO ensemble (CursusId_FK, `set`, WerkId, opmerking, link, compleet, definitief) 
		VALUES (%s, %s, %s, %s, %s, %s, %s)",
			GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int"),
			GetSQLValueString($_SESSION['Set'], "int"),
			GetSQLValueString($_SESSION['WerkId'], "int"),
			GetSQLValueString(htmlspecialchars($_POST['opmerking_ens']), "text"),
			GetSQLValueString(htmlspecialchars($_POST['link']), "text"),
			GetSQLValueString(isset($_POST['compleet']) ? "true" : "", "defined", "1", "0"),
			GetSQLValueString(isset($_POST['definitief']) ? "true" : "", "defined", "1", "0")
		);

		d($insertSQL);
		exec_query($insertSQL);

		$id = $db->lastInsertId();
		query_ensemble();
		$_SESSION['EnsembleId'] = $id;
	}
}

if ((isset($_POST["submit_ensemble"])) && ($_POST["submit_ensemble"] == "Switch to other set")) {
	if ($_SESSION['Set'] == 1) $set = 2;
	elseif ($_SESSION['Set'] == 2) $set = 1;

	$checkSQL = sprintf(
		"SELECT d.naam FROM ensemblelid as e, ensemble, inschrijving as i, dlnmr as d 
	WHERE EnsembleId=ensemble.Id AND e.InschId = i.InschId AND i.DlnmrId_FK = d.DlnmrId
	AND EnsembleId=%s AND (SELECT count(*) FROM ensemblelid, ensemble WHERE EnsembleId=ensemble.Id 
	AND ensemblelid.InschId = i.InschId and `set`=%s) > 0",
		GetSQLValueString($_SESSION['EnsembleId'], "int"),
		$set
	);

	$check = select_query($checkSQL, 1);

	//	echo 'Aantal dubbele inschrijvingen: '.$check).'<br>';

	if ($check == 0) {

		$updateSQL = sprintf(
			"UPDATE ensemble SET `set`=%s, opmerking=%s WHERE Id=%s",
			$set,
			GetSQLValueString(htmlspecialchars($_POST['opmerking_ens']), "text"),
			GetSQLValueString($_SESSION['EnsembleId'], "int")
		);

		exec_query($updateSQL);
	} else {
		echo "<script language='javascript'>\n";
		echo "alert(\"The following participants are already occupied in set {$set}: ";
		foreach ($check as $ch) {
			echo $ch['naam'] . ', ';
		}
		echo "\");\n";
		echo "</script>\n";
		// 		exit();
	}
	query_ensemble();
}


if ((isset($_POST["submit_ensemble"])) && ($_POST["submit_ensemble"] == "Update ensemble")) {
	$link = rawurlencode($_POST['link']);
	if (isset($_SESSION['ruimte']) and $_SESSION['ruimte'] != '' and empty($_POST['ruimte'])) $_POST['ruimte'] = $_SESSION['ruimte'];
	$updateSQL = sprintf(
		"UPDATE ensemble SET opmerking=%s, docent1=%s, docent2=%s, ruimte=%s, link=%s, compleet=%s, definitief=%s 
	WHERE Id=%s",
		GetSQLValueString(htmlspecialchars($_POST['opmerking_ens']), "text"),
		GetSQLValueString($_POST['docent1'], "int"),
		GetSQLValueString($_POST['docent2'], "int"),
		GetSQLValueString($_POST['ruimte'], "int"),
		GetSQLValueString($link, "text"),
		GetSQLValueString(isset($_POST['compleet']) ? "true" : "", "defined", "1", "0"),
		GetSQLValueString(isset($_POST['definitief']) ? "true" : "", "defined", "1", "0"),
		GetSQLValueString($_SESSION['EnsembleId'], "int")
	);

	exec_query($updateSQL);

	query_ensemble();
}

if ((isset($_POST["submit_ensemble"])) && ($_POST["submit_ensemble"] == "Clear ensemble")) {
	$query_ensemble = "SELECT * FROM ensemble WHERE Id = -1";
	$ensemble = select_query($query_ensemble);
	$_SESSION['EnsembleId'] = -1;
}

if ((isset($_POST["submit_ensemble"])) && ($_POST["submit_ensemble"] == "Erase ensemble")) {
	$query_ensemble = "DELETE FROM ensemble WHERE Id = {$_SESSION['EnsembleId']}";
	$ensemble = select_query($query_ensemble);
	$deleteSQL = sprintf(
		"DELETE FROM ensemblelid WHERE EnsembleId=%s",
		GetSQLValueString($_SESSION['EnsembleId'], "int")
	);
	exec_query($deleteSQL);
	$query_ensemble = "SELECT * FROM ensemble WHERE Id = -1";
	$ensemble = select_query($query_ensemble);
}

// begin Recordset ensembles
$query_ensembles = sprintf(
	"SELECT ensemble.Id as Id, WerkId, CONCAT_WS(': ',componist,titel) as werk, docent1, docent2, ruimte, link, compleet, definitief
FROM ensemble, werk, cursus 
WHERE WerkId = werk.Id AND CursusId = ensemble.CursusId_FK AND CursusId=%s AND `set`=%s 
ORDER BY Id ASC",
	GetSQLValueString($_SESSION['Cursusnr'], "int"),
	GetSQLValueString($_SESSION['Set'], "int")
);

$ensembles = select_query($query_ensembles);
if (is_array($ensembles)) $aantal_ensembles = count($ensembles);
d($query_ensembles, $ensembles, $aantal_ensembles);
// end Recordset ensembles

// Databasehandelingen ensembleleden

if ((isset($_POST["ensemblelid_bewerken"])) && ($_POST["ensemblelid_bewerken"] == "toevoegen")) {

	$checkSQL = sprintf(
		"SELECT count(*) as aantal FROM ensemblelid, ensemble WHERE EnsembleId=ensemble.Id AND CursusId_FK=%s 
	AND `set`=%s AND InschId=%s",
		GetSQLValueString($_SESSION['CursusId'], "int"),
		GetSQLValueString($_SESSION['Set'], "int"),
		GetSQLValueString($_POST['InschId'], "int")
	);

	$check = select_query($checkSQL, 1);

	//	echo 'Aantal inschrijvingen: '.$check['aantal'].'<br>';

	if ($check['aantal'] != "" and $check['aantal'] == 0) {

		$query_ensemblelid = sprintf("SELECT naam, instr FROM inschrijving, dlnmr 
		WHERE InschId = %s AND DlnmrId = DlnmrId_FK", GetSQLValueString($_POST['InschId'], "int"));
		$ensemblelid = select_query($query_ensemblelid, 1);

		if ($ensemblelid['instr'] != "") $ins = explode(', ', $ensemblelid['instr']);

		$toevoegenSQL = sprintf(
			"INSERT INTO ensemblelid (EnsembleId, InschId, InstrId, Bepaling, Instrumenten) VALUES (%s, %s, %s, %s, %s)",
			GetSQLValueString($_SESSION['EnsembleId'], "int"),
			GetSQLValueString($_POST['InschId'], "int"),
			GetSQLValueString(instrument($ins[0]), "text"),
			GetSQLValueString(htmlspecialchars($_POST['Bepaling']), "text"),
			GetSQLValueString(instrument($ensemblelid['instr']), "text")
		);

		//	echo $toevoegenSQL.'<br>';

		exec_query($toevoegenSQL);
	} else {
		echo 'This participant is already member of an ensemble in this set';
	}
}

if ((isset($_POST["ensemblelid_bewerken"])) && ($_POST["ensemblelid_bewerken"] == "update")) {
	if ((isset($_POST["instr_bewerken"])) && ($_POST["instr_bewerken"] != ""))
		$editSQL = sprintf(
			"UPDATE ensemblelid SET InstrId=%s, Bepaling=%s WHERE Id=%s",
			GetSQLValueString(htmlspecialchars($_POST['instr_bewerken']), "text"),
			GetSQLValueString(htmlspecialchars($_POST['bepaling_bewerken']), "text"),
			GetSQLValueString($_POST['LidId'], "int")
		);
	else
		$editSQL = sprintf(
			"UPDATE ensemblelid SET Bepaling=%s WHERE Id=%s",
			GetSQLValueString(htmlspecialchars($_POST['bepaling_bewerken']), "text"),
			GetSQLValueString($_POST['LidId'], "int")
		);

	//	echo $editSQL.'<br>';

	exec_query($editSQL);
}

if ((isset($_POST["ensemblelid_bewerken"])) && ($_POST["ensemblelid_bewerken"] == "delete")) {
	$deleteSQL = sprintf(
		"DELETE FROM ensemblelid WHERE Id=%s",
		GetSQLValueString($_POST['LidId'], "int")
	);

	exec_query($deleteSQL);
}

// begin Recordset {Zoek deelnemers}
$query_Inschr = sprintf(
	"SELECT i.InschId, naam, instr 
FROM dlnmr as d, inschrijving as i WHERE naam LIKE \"%%%s%%\" AND d.DlnmrId=i.DlnmrId_FK AND i.CursusId_FK = %s 
AND NOT (afgewezen <=> 1) AND NOT (toehoorder <=> 1) AND aangenomen <=> 1
AND (SELECT count(*) as aantal FROM ensemblelid, ensemble WHERE EnsembleId=ensemble.Id AND InschId=i.InschId 
AND CursusId_FK=%s AND `set`=%s) = 0 
ORDER BY CONVERT(i.instr, UNSIGNED), achternaam",
	$_SESSION['zoeknaam'],
	($_SESSION['Cursus'] + $cursus_offset),
	($_SESSION['Cursus'] + $cursus_offset),
	$_SESSION['Set']
);
d($query_Inschr);
$Inschr = select_query($query_Inschr);
d($Inschr);
if (is_array($Inschr)) $aantal_mensen = count($Inschr);
else $aantal_mensen = 0;

// begin Recordset {Zoek werken}
if (isset($_SESSION['zoekwerk']) and $_SESSION['zoekwerk'] != "") {
	$colname__Werk = $_SESSION['zoekwerk'];
	$query_werken = sprintf("SELECT Id as WerkId, CONCAT_WS(': ', componist, titel) as stuk FROM werk 
	WHERE CONCAT_WS(': ', componist, titel) LIKE \"%%%s%%\" ORDER BY componist, titel ASC", $colname__Werk);
} else $query_werken = "SELECT Id as WerkId, CONCAT_WS(': ', componist, titel) as stuk FROM werk ORDER BY componist, titel ASC";
$werken = select_query($query_werken);
if (is_array($werken)) $aantal_werken = count($werken);
else $aantal_werken = 0;
// end Recordset {Zoek werken}

// begin Recordset Cursusnamen
$query_cursusnaam = sprintf(
	"SELECT cursusnaam_nl FROM cursus WHERE CursusId=%s",
	GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int")
);
$cursusnaam = select_query($query_cursusnaam);
$cursusnaam = $cursusnaam['cursusnaam_nl'];
// end Recordset

// begin Recordset Docenten
$query_docenten = sprintf(
	"SELECT DocId, code FROM docenten, cursusdocenten 
WHERE DocId_FK = DocId AND code IS NOT NULL AND CursusId_FK = %s ORDER BY achternaam ASC",
	GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int")
);
$docenten = select_query($query_docenten);
$doc[0] = '[none]';
foreach ($docenten as $docent) {
	$doc[$docent['DocId']] = $docent['code'];
}

// end Recordset Docenten

d($doc);

// begin Recordset Ruimtes
$query_ruimtes = "SELECT * FROM
  classrooms
WHERE locatie =
  (SELECT
    locatie
  FROM
    cursus
  WHERE CursusId = {$_SESSION['Cursusnr']})
  ORDER BY Id ASC";

d($query_ruimtes);

$ruimtes = select_query($query_ruimtes);

$ruimte[0]['oms'] = '[none]';
$ruimte[0]['bezet'] = 0;
foreach ($ruimtes as $ruim) {
	$txt = $ruim['aanduiding'] . ': ' . $ruim['omschrijving'];
	if (is_null($ruim['piano']) or !$ruim['piano'] === '-') $txt .= ', ' . $ruim['piano'];
	$ruimte[$ruim['Id']]['oms'] = $txt;
	$ruimte[$ruim['Id']]['bezet'] = 0;
}

$query_bezet = sprintf(
	"SELECT k.Id, COUNT(*) as bezet FROM classrooms as k, ensemble 
WHERE k.Id = ruimte AND CursusId_FK = %s AND `set` = %s GROUP BY ruimte ORDER BY k.Id ASC",
	GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int"),
	GetSQLValueString($_SESSION['Set'], "int")
);
$bezet = select_query($query_bezet);

foreach ($bezet as $bz) $ruimte[$bz['Id']]['bezet'] = $bz['bezet'];
// end Recordset Ruimtes

d($ruimtes, $ruimte);

?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">

	<SCRIPT language="JavaScript" type="text/javascript">
		<!--
		function ToggleSet() {
			if (document.cursus_set.Set.value == 1 || !(document.cursus_set.Set.value))
				document.cursus_set.Set.value = 2;
			else if (document.cursus_set.Set.value != 1)
				document.cursus_set.Set.value = 1;
			document.cursus_set.submit();
		}

		function TuttiSet() {
			document.cursus_set.Set.value = 0;
			document.cursus_set.submit();
		}

		function CursusZoek(Nr) {
			document.cursus_set.Cursus.value = Nr;
			document.cursus_set.submit();
		}

		function GP_popupConfirmMsg(msg) { //v1.0
			document.MM_returnValue = confirm(msg);
		}

		function InschId(Id) {
			document.ensemble.InschId.value = Id;
			document.ensemble.ensemblelid_bewerken.value = 'toevoegen';
			document.ensemble.submit();
		}

		function updateLid(Id) {
			document.ensemble.LidId.value = Id;
			if (bepaling = document.getElementById('bep' + Id)) {
				document.ensemble.bepaling_bewerken.value = bepaling.value;
			}
			if (instr = document.getElementById('Instr' + Id)) {
				document.ensemble.instr_bewerken.value = instr.value;
			}
			document.ensemble.ensemblelid_bewerken.value = 'update';
			document.ensemble.submit();
		}

		function deleteLid(Id) {
			if (confirm("Should this participant really be deleted?")) {
				document.ensemble.LidId.value = Id;
				document.ensemble.ensemblelid_bewerken.value = 'delete';
				document.ensemble.submit();
			}
		}

		function WerkId(Id) {
			document.zoek_werkid.WerkId.value = Id;
			document.zoek_werkid.submit();
		}

		function deleteWerk(Id) {
			if (confirm("Should this work really be deleted?")) {
				document.zoek_werkid.WerkId.value = Id;
				document.zoek_werkid.werk_bewerken.value = 'delete';
				document.zoek_werkid.submit();
			}
		}

		function EnsembleId(Id) {
			document.zoek_ensembleid.EnsembleId.value = Id;
			document.zoek_ensembleid.submit();
		}
		-->
	</SCRIPT>
	<html>

	<head>
		<title>Chamber Music Ensemble Formation</title>
		<meta charset="utf-8">
		<style type="text/css">
			<!--
			body {
				margin: 10px;
			}

			p,
			td {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 11px;
			}

			table.selectie {
				border: 1px solid #000000;
				border-collapse: collapse;
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 11px;
				background: #FFF;
			}

			th {
				background: #CCCCCC;
				font-size: 120%;
			}

			td {
				padding: 4px;
			}

			img.geenlijn {
				border-style: none;
			}

			form {
				margin-bottom: 0;
			}

			button {
				line-height: normal;
			}

			.zoeknamen {
				width: 220px;
				background-color: #FFFFCC;
				padding: 8px;
				border-width: medium;
				border-style: double;
			}

			.klein {
				font-size: 70%;
			}

			.zoek_werk {
				background-color: #FFFFCC;
				border-width: medium;
				border-style: double;
			}

			#navcontainer ul {
				margin-left: 0px;
				padding-left: 0px;
				list-style-type: none;
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 11px;
			}

			#navcontainer li {
				padding-bottom: 0px;
				padding-top: 0px;
				margin-top: 3px;
				margin-bottom: 0px;
				margin-left: 8px;
			}

			#navcontainer a {
				display: block;
				border-bottom: 1px solid #006633;
				font-weight: bold;
				text-decoration: none;
			}

			#navcontainer a:link,
			#navlist a:visited {
				color: #006633;
			}

			#navcontainer a:hover,
			#navlist a:active {
				background-color: #006633;
				color: #fff;
			}

			.groot {
				font-size: 150%;
			}

			.incompleet {
				color: #FF0000;
			}

			.set0 {
				background-color: #BFFFFF;
			}

			.set1 {
				background-color: #D5FFD5;
			}

			.set2 {
				background-color: #FFCCCC;
			}

			.toets {
				font-size: 70%;
				color: #FF0000;
			}

			select option:disabled {
				color: lightpink;
			}
			-->
		</style>
	</head>

<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3" align="center" class="kop">
				<form name="cursus_set" id="cursus_set" method="post" action="<?php echo $editFormAction; ?>">
					<input type="hidden" name="Cursus" id="Cursus" value="<?php echo $_SESSION['Cursus']; ?>">
					<input type="hidden" name="Set" id="Set" value="<?php echo $_SESSION['Set']; ?>">
					<button accesskey="c" name="cursus" type="button" onclick="CursusZoek(1)">Cursus 1<span class="toets"> </span><span class="toets">(Shift-Alt-C)</span></button>
					<button accesskey="b" name="cursus" type="button" onclick="CursusZoek(2)">Cursus 2<span class="toets"> (Shift-Alt-B)</span></button>
					<button accesskey="r" name="cursus" type="button" onclick="CursusZoek(3)">Cursus 3<span class="toets"> (Shift-Alt-R)</span></button>
					<button accesskey="t" name="set" type="button" onclick="ToggleSet()">Toggle set <span class="toets">(Shift-Alt-T)</span></button>
					<button accesskey="o" name="tutti" type="button" onclick="TuttiSet()">Orchestra/Tutti <span class="toets">(Shift-Alt-O)</span></button>
				</form>
			</td>
		</tr>
		<tr>
			<!-- ZOEK NAMEN -->
			<td width="220" valign="top" class="zoeknamen">
				<form id="vinden" method="post" action="<?php echo $editFormAction; ?>">
					<p align="center">Name:&nbsp;
						<input name="zoeknamen" type="text" id="zoeknaam" size="5" value="<?php echo $_SESSION['zoeknaam']; ?>">
						&nbsp;
						<input name="zoek" type="submit" id="zoek" value="Search">
						<br>
						<br>
						<strong>Select a name:</strong>
					</p>
					<?php if (isset($Inschr)) { ?>
						<div id="navcontainer">
							<ul id="navlist">
								<?php foreach ($Inschr as $ins) { ?>
									<li id="active"><a href="javascript:InschId(<?php echo $ins['InschId']; ?>)">
											<?php
											$instrumenten = instrument($ins['instr']);
											echo "{$ins['naam']}&nbsp;<span class=\"klein\">({$instrumenten})</span>"; ?>
										</a></li>
								<?php	} ?>
							</ul>
						</div>
						<div align="center">
						<?php }
					echo "<br>Total number of participants to be placed: {$aantal_mensen}<br>"; ?>
						</div>
				</form>
			</td>

			<!-- EIND ZOEK NAMEN -->

			<!-- BEWERK WERKENLIJST -->

			<td valign="top">
				<form name="ensemble" method="post" id="ensemble" action="<?php echo $editFormAction; ?>">
					<table width="100%" border="1" class="selectie">
						<tr valign="baseline">
							<th colspan="4">Edit work nr. <?php echo $werk['Id']; ?></th>
						</tr>
						<tr valign="baseline">
							<td width="160" align="right" nowrap="nowrap">Composer:</td>
							<td width="232"><input type="text" name="componist" value="<?php echo $werk['componist']; ?>" size="50"></td>
							<td width="68" align="right" nowrap="nowrap">First name:</td>
							<td width="68"><input type="text" name="voornaam" value="<?php echo $werk['voornaam']; ?>" size="20"></td>
						</tr>
						<tr valign="baseline">
							<td width="160" align="right" nowrap="nowrap">Title:</td>
							<td><input type="text" name="titel" value="<?php echo stripslashes($werk['titel']); ?>" size="50"></td>
							<td align="right" nowrap="nowrap">Formation:</td>
							<td><input type="text" name="bezetting" value="<?php echo $werk['bezetting']; ?>" size="20"></td>
						</tr>
						<tr valign="baseline">
							<td align="right" valign="middle">
								<div align="right">Remarks:</div>
							</td>
							<td colspan="3" valign="top">
								<h1>
									<textarea name="opmerking" cols="70" rows="1" wrap="virtual"><?php echo $werk['opmerking']; ?></textarea>
								</h1>
							</td>
						</tr>
						<tr valign="baseline">
							<td colspan="4" align="center"><input name="submit_werk" type="submit" value="Add work">
								<input name="submit_werk" type="submit" value="Update work">
								<input name="submit_werk" type="submit" value="Clear work">
								<input name="submit_werk" type="submit" value="Erase work" onClick="deleteWerk(<?php echo ($werkId); ?>)">
							</td>
						</tr>
					</table>
					<!-- EINDE BEWERK WERKENLIJST -->

					<!-- BEWERK ENSEMBLELIJST -->
					<table width="100%" border="1" class="selectie">
						<tr valign="baseline">
							<th colspan="3">Edit ensemble list for course <?php echo $cursusnaam; ?>, set <?php echo $_SESSION['Set']; ?> </th>
						</tr>
						<tr valign="baseline" class="set<?php echo $_SESSION['Set']; ?>">
							<td width="50" align="right" valign="middle" nowrap="nowrap">Ens. nr.&nbsp;<?php echo $ensemble['Id']; ?>:&nbsp;</td>
							<td valign="baseline"><strong><?php echo stripslashes($ensemble['werk']); ?></strong>&nbsp;complete:
								<input name="compleet" type="checkbox" <?php if ($ensemble['compleet'] == '1') echo 'checked'; ?>>
								&nbsp;definitive: <input name="definitief" type="checkbox" <?php if ($ensemble['definitief'] == '1') echo 'checked'; ?>> nr. of participants: <?php echo $ensemble['aantal']; ?>
							</td>
							<td width="50">
								<div align="right">
									<input name="kies_werk" type="submit" id="kies_werk" value="Select work above">
								</div>
							</td>
						</tr>
						<tr valign="top" class="set<?php echo $_SESSION['Set']; ?>">
							<td width="50" align="right" valign="middle" nowrap="nowrap">Tutor 1: </td>
							<td colspan="2"><select name="docent1" size="1" id="docent1">
									<?php foreach ($doc as $DocId => $code) {
										$txt = '<option value="' . $DocId . '"';
										if ($ensemble['docent1'] == $DocId) $txt .= ' SELECTED ';
										$txt .= '>';
										$txt .= $code . "</option>\n";
										echo $txt;
									} ?>
								</select>
								&nbsp;&nbsp;Tutor 2:&nbsp;
								<select name="docent2" size="1" id="docent2">
									<?php foreach ($doc as $DocId => $code) {
										$txt = '<option value="' . $DocId . '"';
										if ($ensemble['docent2'] == $DocId) $txt .= ' SELECTED ';
										$txt .= '>';
										$txt .= $code . "</option>\n";
										echo $txt;
									} ?>
								</select>
								&nbsp;Classroom:&nbsp;
								<select name="ruimte" size="1" name="ruimte" id="ruimte">
									<?php foreach ($ruimte as $Id => $r) {
										$txt = '<option value="' . $Id . '"';
										if (isset($ensemble['ruimte']) and $ensemble['ruimte'] == $Id) $txt .= ' SELECTED ';
										if ($r['bezet'] == 1) $txt .= ' DISABLED ';
										$txt .= '>';
										$txt .= $r['oms'] . "</option>\n";
										echo $txt;
									} ?>
								</select>
							</td>
						</tr>
						<tr valign="top" class="set<?php echo $_SESSION['Set']; ?>">
							<td align="right" valign="middle" nowrap="nowrap">Link:</td>
							<td colspan="2"><input name="link" type="text" id="link" value="<?php echo rawurldecode($ensemble['link']); ?>" size="70" maxlength="600"></td>
						</tr>
						<tr valign="top" class="set<?php echo $_SESSION['Set']; ?>">
							<td width="50" align="right" valign="middle">
								<div align="right">Remark:</div>
							</td>
							<td colspan="2"><textarea name="opmerking_ens" cols="70" rows="3" wrap="virtual"><?php echo stripslashes($ensemble['opmerking']); ?></textarea></td>
						</tr>
						<tr valign="baseline" class="set<?php echo $_SESSION['Set']; ?>">
							<td colspan="3" align="center">&nbsp;
								<input name="submit_ensemble" type="submit" id="submit_ensemble" value="Update ensemble">
								&nbsp;
								<input name="submit_ensemble" type="submit" id="submit_ensemble" value="Clear ensemble">
								&nbsp;
								<input name="submit_ensemble" type="submit" id="submit_ensemble" value="Switch to other set">
								&nbsp;
								<input name="submit_ensemble" type="submit" id="submit_ensemble" value="Erase ensemble">
							</td>
						</tr>
					</table>

					<!-- EINDE BEWERK ENSEMBLELIJST -->

					<!-- BEWERK ENSEMBLELEDEN -->

					<table width="100%" border="1" cellpadding="0" cellspacing="0" class="selectie">
						<tr valign="baseline">
							<th width="200">Name:</th>
							<th width="100">Instrument:</th>
							<th width="30">Provision:</th>
							<th width="30">Action:</th>
							<input name="InschId" type="hidden" id="InschId">
							<input name="LidId" type="hidden" id="LidId">
							<input name="ensemblelid_bewerken" type="hidden" id="ensemblelid_bewerken">
							<input name="bepaling_bewerken" type="hidden" id="bepaling_bewerken">
							<input name="instr_bewerken" type="hidden" id="instr_bewerken">
						</tr>
						<?php // begin Recordset ensembleleden
						if ($_SESSION['EnsembleId'] != -1) {
							$query_ensembleleden = sprintf(
								"SELECT id as LidId, naam, InstrId, bepaling, e.instrumenten FROM ensemblelid as e, 
			dlnmr as d, inschrijving as i WHERE EnsembleId = %s AND e.InschId = i.InschId AND i.DlnmrId_FK = d.DlnmrId 
			ORDER BY (SELECT id FROM instr WHERE en = InstrId), bepaling",
								GetSQLValueString($_SESSION['EnsembleId'], "int")
							);
							$ensembleleden = select_query($query_ensembleleden);
							// end Recordset

							foreach ($ensembleleden as $ensemblelid) {
						?>
								<tr valign="baseline" class="set<?php echo $_SESSION['Set']; ?>">
									<td width="70" nowrap="nowrap"><?php echo $ensemblelid['naam']; ?></td>
									<td width="30" nowrap="nowrap">
										<?php
										d($ensemblelid);
										$LidId = $ensemblelid['LidId'];
										$ins = explode(', ', $ensemblelid['instrumenten']);
										if (count($ins) == 1) {
											echo $ensemblelid['InstrId'];
											echo '<input name="InstrId" type="hidden" value="' . $ensemblelid['InstrId'] . '">';
										} else {
											echo "<select id=\"Instr{$LidId}\">";
											foreach ($ins as $instr) {
												if ($instr == $ensemblelid['InstrId']) $sel = ' SELECTED';
												else $sel = '';
												echo '<OPTION' . $sel . '>' . $instr . "</OPTION>\n";
											}
											echo "</select>\n";
										} ?>
									</td>
									<td width="30" nowrap="nowrap"><input type="text" id="bep<?php echo $LidId; ?>" value="<?php
																															echo $ensemblelid['bepaling']; ?>" size="15"></td>
									<td nowrap="nowrap"><img src="../Images/Logos/b_edit.png" alt="edit" width="16" height="16" onclick="updateLid(<?php echo $LidId; ?>)"> &nbsp; <img src="../Images/Logos/b_drop.png" alt="delete" width="16" height="16" ] onclick="deleteLid(<?php echo $LidId; ?>)"></td>
								</tr>
						<?php }
						} ?>
						<tr class="set<?php echo $_SESSION['Set']; ?>">
							<td colspan="4">
								<p class="groot">Select an ensemble:</p>
								<div id="navcontainer">
									<ul id="navlist">
										<?php
										foreach ($ensembles as $i => $ensemble) {
											if ($ensemble['WerkId'] != 0) {
												$ens = '<li>';
												$ens .= '<a href="javascript:EnsembleId(';
												$ens .= $ensemble['Id'] . ')">';
												if ($ensemble['compleet'] != '1') $ens .= '<span class="incompleet">';
												$ens .= ($i + 1) . '. ' . stripslashes($ensemble['werk']);
												if ($ensemble['docent1'] > 0) $ens .= '&nbsp;&nbsp;|&nbsp;&nbsp;' . $doc[$ensemble['docent1']];
												if ($ensemble['docent2'] > 0) $ens .= '/' . $doc[$ensemble['docent2']];
												if ($ensemble['ruimte'] > 0) $ens .= ' (' . $ruimte[$ensemble['ruimte']]['oms'] . ')';
												if ($ensemble['compleet'] != 1) $ens .= '</span>';
												if ($ensemble['definitief'] == 1)
													$ens .= '&nbsp;<img src="../Images/Logos/ok-klein.png" alt="definitive" class="geenlijn">';
												$ens .= "</a></li>\n";
												echo $ens;
											} else {
												$niet = '<li id="active"><a href="javascript:EnsembleId(';
												$niet .= $ensemble['Id'] . ')">';
												$niet .= stripslashes($ensemble['werk']);
												$niet .= "</a></li>\n";
											}
										}
										if (isset($niet)) echo '<br><hr color="black">' . $niet;
										?>
									</ul>
								</div>
							</td>
						</tr>

					</table>
				</form>

				<!-- EINDE BEWERK ENSEMBLELEDEN -->

				<!-- LIJST ENSEMBLES -->


			</td>

			<!-- EINDE LIJST ENSEMBLES -->

			<!-- ZOEK WERK -->

			<td width="220" valign="top" class="zoek_werk">
				<form action="<?php echo $editFormAction; ?>" method="post" name="zoek_werk">
					<p align="center">Name:&nbsp;
						<input name="zoekwerk" type="text" id="zoekwerk" size="5" value="<?php echo $_SESSION['zoekwerk']; ?>">
						&nbsp;
						<input name="zoek_werk" type="submit" id="zoek" value="Search work">
						<br>
						<br>
						<strong>Select a work:</strong>
					</p>
					<div align="left">
						<?php if (isset($werken)) { ?>
					</div>
					<div id="navcontainer">
						<div align="left">
							<ul id="navlist">
								<?php
								foreach ($werken as $werkje) { ?>
									<li id="active"><a href="javascript:WerkId(<?php echo $werkje['WerkId']; ?>)"> <?php
																													echo stripslashes($werkje['stuk']); ?> </a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<div align="left">
						<p>
						<?php } ?>
						<br>
						Total number of works: <?php echo $aantal_werken; ?><br>
						</p>
					</div>
				</form>
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>

	<!-- EINDE ZOEK WERK -->

	<form name="zoek_werkid" method="post" id="zoek_werkid" action="<?php echo $editFormAction; ?>">
		<input name="WerkId" id="WerkId" type="hidden" value="<?php echo $_SESSION['WerkId']; ?>">
		<input name="submit_werk" type="hidden" id="submit_werk" value="Edit work">
		<input type="hidden" name="Set" id="Set" value="<?php echo $_SESSION['Set']; ?>">
	</form>
	<form name="zoek_ensembleid" method="post" id="zoek_werkid" action="<?php echo $editFormAction; ?>">
		<input name="EnsembleId" id="EnsembleId" type="hidden" value="">
		<input name="kies_ensemble" type="hidden" id="kies_ensemble" value="Bewerk">
	</form>
</body>

</html>
<?php ob_end_flush(); ?>