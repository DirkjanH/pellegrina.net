<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1);
error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2024.php');

Kint::$enabled_mode = false;

// begin Recordset
$query_instrumenten = "SELECT * FROM instr ORDER BY id ASC";
$instrumenten = select_query($query_instrumenten);
d($instrumenten);
foreach ($instrumenten as $instrument) {
	$instrumententabel[$instrument['id']] = $instrument['en'];
}
d($instrumententabel);
// end Recordset

function instrument($instr)
{
	global $instrumententabel;
	$ins = explode(', ', $instr);
	unset($instrumenten);
	foreach ($ins as $in) $instrumenten[] = $instrumententabel[$in];
	$instrumenten = implode(', ', $instrumenten);
	return $instrumenten;
}

$pdfdirectory = '/pdf/';

if (empty($_SESSION['Set'])) $_SESSION['Set'] = 1;
if (empty($_SESSION['Cursus'])) $_SESSION['Cursus'] = 1;

if (isset($_POST['Set'])) $_SESSION['Set'] = $_POST['Set'];
if (isset($_POST['Cursus'])) $_SESSION['Cursus'] = $_POST['Cursus'];

// begin Recordset Cursusnamen
$query_cursusnaam = sprintf(
	"SELECT cursusnaam_en FROM cursus WHERE CursusId=%s",
	GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int")
);
$cursusnaam = select_query($query_cursusnaam);
$cursusnaam = $cursusnaam['cursusnaam_en'];
// end Recordset Cursusnamen

// begin Recordset Ensembles
$query_ensembles = sprintf(
	"SELECT CONCAT_WS(', ', componist, titel) as stuk, ensemble.opmerking, ensemble.Id as ensembleId, docent1, docent2, ruimte, link FROM ensemble, werk WHERE CursusId_FK=%s AND `set`=%s AND WerkId = werk.Id AND WerkId > 0
ORDER BY ensemble.Id ASC",
	GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int"),
	GetSQLValueString($_SESSION['Set'], "int")
);
$ensembles = select_query($query_ensembles);
if (is_array($ensembles)) $totalRows_ensembles = count($ensembles);
// end Recordset Ensembles

// begin Recordset Docenten
$query_docenten = sprintf(
	"SELECT DocId, code FROM cursusdocenten, docenten
WHERE DocId_FK = DocId AND code IS NOT NULL AND CursusId_FK = %s ORDER BY DocId ASC",
	GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int")
);
$docenten = select_query($query_docenten);
foreach ($docenten as $docent) {
	$doc[$docent['DocId']] = $docent['code'];
}
// end Recordset Docenten

// begin Recordset Ruimtes
$query_ruimtes = "SELECT Id, aanduiding FROM classrooms";
$ruimtes = select_query($query_ruimtes);
foreach ($ruimtes as $r) {
	$ruimte[$r['Id']] = $r['aanduiding'];
}
// end Recordset Ruimtes

function ensembleleden($id)
{

	global $inschrijf;
	$query_ensembleleden = "SELECT naam, InstrId as instrument, bepaling FROM ensemblelid as e INNER JOIN inschrijving as i
	ON e.InschId=i.InschId LEFT JOIN dlnmr as d ON d.DlnmrId=i.DlnmrId_FK WHERE EnsembleId = {$id} 
	ORDER BY (SELECT id FROM instr WHERE en = instrument), bepaling, achternaam";
	d($query_ensembleleden);
	$ensembleleden = select_query($query_ensembleleden);
	echo '<p class="spelers">';
	foreach ($ensembleleden as $ensemblelid) {
		echo $ensemblelid['naam'] . ', ' . $ensemblelid['instrument'] . ' ' . $ensemblelid['bepaling'] . '<br>';
	}
	echo '</p>';
}

function geenensemble()
{

	global $inschrijf, $cursus_offset;
	$query_ensembleleden = sprintf(
		"SELECT naam, i.instr FROM inschrijving as i
	RIGHT JOIN dlnmr as d ON d.DlnmrId=i.DlnmrId_FK WHERE (SELECT COUNT(*) FROM ensemblelid LEFT JOIN ensemble as e 
	ON EnsembleId = e.Id WHERE i.InschId = ensemblelid.InschId AND CursusId_FK = %s AND `set` = %s) = 0 AND i.CursusId_FK = %s
	AND (i.toehoorder != 1 OR i.toehoorder IS NULL) AND aangenomen = 1 AND NOT(afgewezen <=> 1) 
	ORDER BY CONVERT(i.instr, UNSIGNED), achternaam",
		($_SESSION['Cursus'] + $cursus_offset),
		$_SESSION['Set'],
		($_SESSION['Cursus'] + $cursus_offset)
	);
	d($query_ensembleleden);
	$ensembleleden = select_query($query_ensembleleden);
	d($ensembleleden);
	if ($ensembleleden !== false and count($ensembleleden) > 0) {
		echo '<br><hr><h3>Participants not yet placed in an ensemble:</h3><p class="spelers">';
		foreach ($ensembleleden as $ensemblelid) {
			d($ensemblelid);
			echo $ensemblelid['naam'] . ', ' . instrument($ensemblelid['instr']) . '<br>';
		}
		echo '</p>';
	}
}

function nulensemble()
{

	global $inschrijf, $cursus_offset;
	$query_ensembleleden = sprintf(
		"SELECT naam, i.instr FROM ensemblelid as e
	LEFT JOIN inschrijving as i ON i.InschId=e.InschId LEFT JOIN dlnmr as d ON d.DlnmrId=i.DlnmrId_FK 
	LEFT JOIN ensemble ON ensembleId = ensemble.Id 
	WHERE ensemble.WerkId = 0 AND ensemble.CursusId_FK=%s AND `set`=%s AND aangenomen = 1 ORDER BY achternaam",
		GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int"),
		GetSQLValueString($_SESSION['Set'], "int")
	);

	d($query_ensembleleden);

	$ensembleleden = select_query($query_ensembleleden);
	if ($ensembleleden !== false and count($ensembleleden) > 0) {
		echo '<br><hr><h3>At own request not includes in this set:</h3><p class="spelers">';
		foreach ($ensembleleden as $ensemblelid) {
			d($ensemblelid);
			echo $ensemblelid['naam'] . ', ' . instrument($ensemblelid['instr']) . '<br>';
		}
		echo '</p>';
	}
}

?>
<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
		<!--
		function ToggleSet() {
			if (document.getElementById('Set').value == 1 || !(document.getElementById('Set').value))
				document.getElementById('Set').value = 2;
			else if (document.getElementById('Set').value != 1)
				document.getElementById('Set').value = 1;
			document.getElementById('cursus_set').submit();
		}

		function TuttiSet() {
			document.getElementById('Set').value = 0;
			document.getElementById('cursus_set').submit();
		}

		function CursusZoek(Nr) {
			document.getElementById('Cursus').value = Nr;
			document.getElementById('cursus_set').submit();
		}
		-->
	</SCRIPT>
	<title>sets of formations</title>
	<style type="text/css">
		<!--
		.opmerking {
			font-family: Georgia, "Times New Roman", Times, serif;
			margin-top: 5px;
			color: #663366;
		}

		body {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 13px;
		}

		.spelers {
			font-size: 13px;
			margin-left: 32px;
		}

		.toets {
			font-size: 70%;
			color: #FF0000;
		}
		-->
	</style>
	<meta name="robots" content="noindex, nofollow">
</head>

<body>
	<div id="cursus_form">
		<form id="cursus_set" method="post" action="<?php echo $editFormAction; ?>">
			<input type="hidden" name="Cursus" id="Cursus" value="<?php echo $_SESSION['Cursus']; ?>">
			<input type="hidden" name="Set" id="Set" value="<?php echo $_SESSION['Set']; ?>">
			<button ACCESSKEY="b" name="cursus" type="button" onClick="CursusZoek(1)">Course 1 <span class="toets">(Shift-Alt-1)</span></button>
			<button ACCESSKEY="k" name="cursus" type="button" onClick="CursusZoek(2)">Course 2 <span class="toets">(Shift-Alt-2)</span></button>
			<button ACCESSKEY="r" name="cursus" type="button" onClick="CursusZoek(3)">Course 3 <span class="toets">(Shift-Alt-3)</span></button>
			<button ACCESSKEY="t" name="set" type="button" onClick="ToggleSet()">Toggle
				set <span class="toets">(Shift-Alt-T)</span></button>
			<button ACCESSKEY="o" name="tutti" type="button" onClick="TuttiSet()">Orchestra/Tutti
				<span class="toets">(Shift-Alt-O)</span></button>
		</form>
	</div>
	<hr>
	<p>
		<?php
		echo '<h1>' . $cursusnaam . '</h1>';
		echo '<h2>Chamber Music Formations d.d. ' . date('d-m-Y');
		echo '<h2>set of formations nr. ' . $_SESSION['Set'] . '</h2>';
		foreach ($ensembles as $i => $ensemble) {
			$ens = '<h2>' . ($i + 1) . '. ';
			if ($ensemble['link'] != '') {
				$ensemble['link'] = rawurldecode($ensemble['link']);
				$ens .= "<a href=\"{$ensemble['link']}\" target=\"_blank\">";
			}
			$ens .= stripslashes($ensemble['stuk']);
			if ($ensemble['link'] != '') $ens .= "</a>";
			if ($ensemble['docent1'] > 0) $ens .= '&nbsp;&nbsp;' . $doc[$ensemble['docent1']];
			if ($ensemble['docent2'] > 0) $ens .= '/' . $doc[$ensemble['docent2']];
			if ($ensemble['ruimte'] > 0) $ens .= ' (' . $ruimte[$ensemble['ruimte']] . ')';
			$ens .= '</h2>';
			echo $ens;
			ensembleleden($ensemble['ensembleId']);
			if ($ensemble['opmerking'] != "") echo '<p class="opmerking">' . stripslashes($ensemble['opmerking']) . '</p>';
		}
		nulensemble();
		geenensemble();
		?>
	</p>
</body>

</html>