<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );
error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

Kint::$enabled_mode = false;

d($_GET);
d($_POST);

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2026.php');

$_SESSION['Cursus'] = 2; // Baroque op Nieuw Sion

if (empty($_SESSION['Set'])) $_SESSION['Set'] = 1;

if (isset($_POST['Set'])) $_SESSION['Set'] = $_POST['Set'];

// begin Recordset
$query_instrumenten = "SELECT * FROM instr ORDER BY id ASC";
$instrumenten = select_query($query_instrumenten);
$totalRows_instrumenten = count($instrumenten);
foreach ($instrumenten as $instrument) {
	$instrumententabel[$instrument['id']] = $instrument['en'];
}
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
$query_cursus = sprintf(
	"SELECT cursusnaam_en, locatie FROM cursus WHERE CursusId=%s",
	GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int")
);
$cursus = select_query($query_cursus, 1);
$cursusnaam = $cursus['cursusnaam_en'];
$locatie = $cursus['locatie'];
// end Recordset Cursusnamen

// begin Recordset Ensembles
$query_ensembles = sprintf(
	"SELECT CONCAT_WS(', ', componist, titel) as stuk, ensemble.opmerking, ensemble.Id as ensembleId, docent1, docent2, ruimte, link, definitief, compleet FROM ensemble, werk WHERE CursusId_FK=%s AND `set`=%s AND WerkId = werk.Id AND WerkId > 0
ORDER BY ensemble.Id ASC",
	GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int"),
	GetSQLValueString($_SESSION['Set'], "int")
);
$ensembles = select_query($query_ensembles);
$totalRows_ensembles = count($ensembles);
// end Recordset Ensembles

// begin Recordset Docenten
$query_docenten = sprintf(
	"SELECT DocId, naam, code FROM cursusdocenten, docenten
WHERE DocId_FK = DocId AND code IS NOT NULL AND CursusId_FK = %s ORDER BY achternaam ASC",
	GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int")
);
$docenten = select_query($query_docenten);
foreach ($docenten as $docent) {
	$doc[$docent['DocId']]['code'] = $docent['code'];
	$doc[$docent['DocId']]['name'] = $docent['naam'];
}

// end Recordset Docenten

function ensembleleden($id)
{

	global $inschrijf;
	$query_ensembleleden = "SELECT naam, InstrId as instrument, bepaling FROM ensemblelid as e INNER JOIN inschrijving as i
	ON e.InschId=i.InschId LEFT JOIN dlnmr as d ON d.DlnmrId=i.DlnmrId_FK WHERE EnsembleId = {$id} 
	ORDER BY (SELECT id FROM instr WHERE en = instrument), bepaling, achternaam";
	//	echo $query_ensembleleden.'<br>';
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
	LEFT JOIN dlnmr as d ON d.DlnmrId=i.DlnmrId_FK WHERE (SELECT COUNT(*) FROM ensemblelid LEFT JOIN ensemble as e 
	ON EnsembleId = e.Id WHERE i.InschId = ensemblelid.InschId AND CursusId_FK = %s AND `set` = %s) = 0 AND i.CursusId_FK = %s
	AND NOT (i.toehoorder <=> 1) AND aangenomen = 1 AND NOT (i.afgewezen <=> 1)
	ORDER BY CONVERT(i.instr, UNSIGNED), achternaam",
		($_SESSION['Cursus'] + $cursus_offset),
		$_SESSION['Set'],
		($_SESSION['Cursus'] + $cursus_offset)
	);
	d($query_ensembleleden);
	$ensembleleden = select_query($query_ensembleleden);
	if ($ensembleleden !== false and count($ensembleleden) > 0) {
		echo '<br><hr><h3>Participants not yet placed in ensembles:</h3><p class="spelers">';
		foreach ($ensembleleden as $ensemblelid) {
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

	//	echo $query_ensembleleden.'<br>';

	$ensembleleden = select_query($query_ensembleleden);
	if ($ensembleleden !== false and count($ensembleleden) > 0) {
		echo '<br><hr><h3>At own request not includes in this set:</h3><p class="spelers">';
		foreach ($ensembleleden as $ensemblelid) {
			echo $ensemblelid['naam'] . ', ' . instrument($ensemblelid['instr']) . '<br>';
		}
		echo '</p>';
	}
}

function tutorcodes()
{

	global $doc;
	if (isset($doc) and count($doc) > 0) {
		echo '<div style="float: left; margin-right: 40px;"><hr><h3>Key to the tutor codes:</h3><p class="spelers">';
		foreach ($doc as $d) {
			echo $d['code'] . ' = ' . $d['name'] . '<br>';
		}
		echo '</p></div>';
	}
}

// begin Recordset Ruimtes
$query_ruimtes = "SELECT Id, aanduiding, omschrijving, verdieping FROM classrooms WHERE locatie = '{$locatie}' ORDER BY verdieping;";
$ruimtes = select_query($query_ruimtes);
foreach ($ruimtes as $r) {
	$ruimte[$r['Id']] = $r['aanduiding'];
}
// end Recordset Ruimtes

function ruimtecodes()
{

	global $ruimtes, $doc, $locatie;
	if (isset($doc) and count($doc) > 0) {
		echo '<div style="float: left;"><hr><h3>Key to the classroom codes:</h3><p class="spelers">';
		foreach ($ruimtes as $r) {
			$t = $r['aanduiding'] . ' = ' . $r['omschrijving'];
			if ($locatie == 'CB') {
				$t .= ' (floor ' . $r['verdieping'] . ')<br>';
				$t = str_replace('floor 0', 'ground floor', $t);
				$t = str_replace('floor 1', 'first floor', $t);
				$t = str_replace('floor 2', 'second floor', $t);
				$t = str_replace('floor 3', 'area F', $t);
				echo $t;
			} else echo $t . '<br>';
		}
		echo '</p></div>';
	}
}
?>
<!DOCTYPE HTML>
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
<html><!-- InstanceBegin template="/Templates/LP algemeen EN.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">

	<!-- CSS: -->
	<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

	<!-- InstanceBeginEditable name="doctitle" -->
	<title>List of ensemble formation, course nr. <?php echo $_SESSION['Cursus'] ?></title>
	<meta name="robots" content="noindex, nofollow">
	<!-- InstanceEndEditable -->
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.EN.php'; ?>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
	<link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
	<!-- InstanceBeginEditable name="head" -->
	<link href="css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
	<!-- InstanceEndEditable -->
</head>

<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_tagmanager.php'; ?>
	<div id="inhoud">
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>
		<div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
			<div id="cursus_form">
				<form id="cursus_set" method="post" action="<?php echo $editFormAction; ?>">
					<div class="w3-panel w3-center">
						<h1><?php echo $cursusnaam; ?></h1>
						<input type="hidden" name="Cursus" id="Cursus" value="<?php echo $_SESSION['Cursus']; ?>">
						<input type="hidden" name="Set" id="Set" value="<?php echo $_SESSION['Set']; ?>">
						<h2 class="set<?php echo $_SESSION['Set']; ?>">Chamber Music Formations d.d. <?php echo date('d-m-Y') ?>, set <span class="formation">nr. <?php echo $_SESSION['Set']; ?></span></h2>
						<p>Please use these buttons to move from set to set:
							<button name="set" type="button" onClick="ToggleSet()" class="w3-btn w3-pale-yellow w3-border w3-round-medium">Go to <strong>other</strong> chamber music set</button>
							<button name="tutti" type="button" onClick="TuttiSet()" class="w3-btn w3-pale-yellow w3-border w3-round-medium">Tutti programme</button>
						</p>
					</div>
					<div class="w3-panel">
						<div class="w3-panel w3-pale-blue w3-leftbar w3-rightbar w3-border w3-border-blue">
							<h6>N.B.: Ensembles can be marked with the following icons: </h6>
							<ol>
								<li><img src="Images/Logos/ok.png" alt="confirmed" class="geenlijn">&nbsp;means: this ensemble is complete and the work has been fixed</li>
								<li><img src="Images/Logos/question.png" alt="confirmed" class="geenlijn">&nbsp;means: this ensemble is complete, but the work still has to be decided. Please take up contact with the other members and/or the tutor to discuss what to play and let <em>La Pellegrina</em> know the outcome.</li>
							</ol>
						</div>
				</form>
				<?php
				$i = 1;
				foreach ($ensembles as $i => $ensemble) {
					$ens = '<h2>' . ($i + 1) . '. ';
					if ($ensemble['link'] != '') {
						$ensemble['link'] = rawurldecode($ensemble['link']);
						$ens .= "<a href=\"{$ensemble['link']}\" target=\"_blank\">";
					}
					$ens .= stripslashes($ensemble['stuk']);
					if ($ensemble['link'] != '') $ens .= "</a>";
					if ($ensemble['docent1'] > 0) $ens .= '&nbsp;&nbsp;' . $doc[$ensemble['docent1']]['code'];
					if ($ensemble['docent2'] > 0) $ens .= '/' . $doc[$ensemble['docent2']]['code'];
					if ($ensemble['ruimte'] > 0) $ens .= ' (' . $ruimte[$ensemble['ruimte']] . ')';
					if ($ensemble['definitief'] > 0) $ens .= '&nbsp;<img src="Images/Logos/ok.png" alt="confirmed" class="geenlijn">';
					elseif ($ensemble['compleet'] > 0) $ens .= '&nbsp;<img src="Images/Logos/question.png" alt="not confirmed" class="geenlijn">';
					$ens .= '</h2>';
					echo $ens;
					ensembleleden($ensemble['ensembleId']);
					if ($ensemble['opmerking'] != "") echo '<p class="opmerking">' . $ensemble['opmerking'] . '</p>';
				}
				nulensemble();
				geenensemble();
				tutorcodes();
				// ruimtecodes();
				?>
			</div>
			<!-- InstanceEndEditable -->
			<h2> <a href="javascript: history.go(-1)">Back</a></h2>
			<p>&nbsp;</p>
		</div>
	</div>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
<!-- InstanceEnd -->

</html>