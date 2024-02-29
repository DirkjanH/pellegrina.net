<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors',1 );

error_reporting(E_ALL);

require_once $_SERVER["CONTEXT_DOCUMENT_ROOT"].'/vendor/autoload.php';

Kint::$enabled_mode = false;

d($_GET);
d($_POST);

require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2019.php');

$_SESSION['Cursus'] = 3; // Romantic

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

function instrument($instr) {
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
$query_cursusnaam = sprintf("SELECT cursusnaam_en FROM cursus WHERE CursusId=%s",
GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int"));
$cursusnaam = select_query($query_cursusnaam, 1);
$cursusnaam = $cursusnaam['cursusnaam_en'];
// end Recordset Cursusnamen

// begin Recordset Ensembles
$query_ensembles = sprintf("SELECT CONCAT_WS(', ', componist, titel) as stuk, ensemble.opmerking, ensemble.Id as ensembleId, docent1, docent2, ruimte, link, definitief, compleet FROM ensemble, werk WHERE CursusId_FK=%s AND `set`=%s AND WerkId = werk.Id AND WerkId > 0
ORDER BY ensemble.Id ASC", 
GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int"),
GetSQLValueString($_SESSION['Set'], "int"));
$ensembles = select_query($query_ensembles);
$totalRows_ensembles = count($ensembles);
// end Recordset Ensembles

// begin Recordset Docenten
$query_docenten = sprintf("SELECT DocId, naam, code FROM cursusdocenten, docenten
WHERE DocId_FK = DocId AND code IS NOT NULL AND CursusId_FK = %s ORDER BY achternaam ASC", 
GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int"));
$docenten = select_query($query_docenten);
foreach ($docenten as $docent) {
	$doc[$docent['DocId']]['code'] = $docent['code'];
	$doc[$docent['DocId']]['name'] = $docent['naam'];
}

// end Recordset Docenten

function ensembleleden ($id) {

	global $inschrijf;
	$query_ensembleleden = "SELECT naam, InstrId as instrument, bepaling FROM ensemblelid as e INNER JOIN inschrijving as i
	ON e.InschId=i.InschId LEFT JOIN dlnmr as d ON d.DlnmrId=i.DlnmrId_FK WHERE EnsembleId = {$id} 
	ORDER BY (SELECT id FROM instr WHERE en = instrument), bepaling, achternaam";
	//	echo $query_ensembleleden.'<br>';
	$ensembleleden = select_query($query_ensembleleden);
	echo '<p class="spelers">';
	foreach ($ensembleleden as $ensemblelid) {
		echo $ensemblelid['naam'].', '.$ensemblelid['instrument'].' '.$ensemblelid['bepaling'].'<br>';
	}
	echo '</p>';
}

function geenensemble () {

	global $inschrijf, $cursus_offset;
	$query_ensembleleden = sprintf("SELECT naam, i.instr FROM inschrijving as i
	LEFT JOIN dlnmr as d ON d.DlnmrId=i.DlnmrId_FK WHERE (SELECT COUNT(*) FROM ensemblelid LEFT JOIN ensemble as e 
	ON EnsembleId = e.Id WHERE i.InschId = ensemblelid.InschId AND CursusId_FK = %s AND `set` = %s) = 0 AND i.CursusId_FK = %s
	AND NOT (i.toehoorder <=> 1) AND aangenomen = 1 AND NOT (i.afgewezen <=> 1)
	ORDER BY CONVERT(i.instr, UNSIGNED), achternaam",
	($_SESSION['Cursus'] + $cursus_offset),
	$_SESSION['Set'],
	($_SESSION['Cursus'] + $cursus_offset));
	d($query_ensembleleden);
	$ensembleleden = select_query($query_ensembleleden);
	if ($ensembleleden !== false AND count($ensembleleden) > 0) {
		echo '<br><hr><h3>Participants not yet placed in ensembles:</h3><p class="spelers">';
		foreach ($ensembleleden as $ensemblelid) {
			echo $ensemblelid['naam'].', '.instrument($ensemblelid['instr']).'<br>';
		}
		echo '</p>';
	}
}

function nulensemble () {

	global $inschrijf, $cursus_offset;
	$query_ensembleleden = sprintf("SELECT naam, i.instr FROM ensemblelid as e
	LEFT JOIN inschrijving as i ON i.InschId=e.InschId LEFT JOIN dlnmr as d ON d.DlnmrId=i.DlnmrId_FK 
	LEFT JOIN ensemble ON ensembleId = ensemble.Id 
	WHERE ensemble.WerkId = 0 AND ensemble.CursusId_FK=%s AND `set`=%s AND aangenomen = 1 ORDER BY achternaam",
	GetSQLValueString(($_SESSION['Cursus'] + $cursus_offset), "int"),
	GetSQLValueString($_SESSION['Set'], "int"));

	//	echo $query_ensembleleden.'<br>';

	$ensembleleden = select_query($query_ensembleleden);
	if ($ensembleleden !== false AND count($ensembleleden) > 0) {
		echo '<br><hr><h3>At own request not includes in this set:</h3><p class="spelers">';
		foreach ($ensembleleden as $ensemblelid) {
			echo $ensemblelid['naam'].', '.instrument($ensemblelid['instr']).'<br>';
		}
		echo '</p>';
	}
}

function tutorcodes () {

	global $doc;
	if (isset($doc) AND count($doc) > 0) {
		echo '<br><hr><h3>Key to the tutor codes:</h3><p class="spelers">';
		foreach ($doc as $d) {
			echo $d['code'].' = '.$d['name'].'<br>';
		}
		echo '</p>';
	}
}
?>
<!DOCTYPE HTML>
<?php //PHP ADODB document - made with PHAkt 3.7.1?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
<!--
function ToggleSet () {
	if (document.getElementById('Set').value == 1 || !(document.getElementById('Set').value))
		document.getElementById('Set').value = 2;
	else if (document.getElementById('Set').value != 1)
		document.getElementById('Set').value = 1;
	document.getElementById('cursus_set').submit();
}

function TuttiSet () {
	document.getElementById('Set').value = 0;
	document.getElementById('cursus_set').submit();
}

function CursusZoek (Nr) {
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
   <link rel="stylesheet" href="/css/pagina_stijlen.css" type="text/css">

<!-- InstanceBeginEditable name="doctitle" -->
<title>List of ensemble formation, course nr. <?php echo $_SESSION['Cursus'] ?></title>
<meta name="robots" content="noindex, nofollow">
<!-- InstanceEndEditable -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<link href="css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
<!-- InstanceEndEditable -->
</head>
<body>
<div id="inhoud">
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.EN.php'; ?>
  <div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
<div id="cursus_form">
<form id="cursus_set" method="post"
	action="<?php echo $editFormAction; ?>">

  <table width="100%" border="0" cellpadding="0">
    <tr>
      <td colspan="2" align="center" valign="bottom"><h1><?php echo $cursusnaam; ?></h1></td>
      </tr>
    <tr>
      <td width="50%" valign="top"><h2>
        <input type="hidden" name="Cursus" id="Cursus"
	value="<?php echo $_SESSION['Cursus']; ?>">
        <input type="hidden" name="Set" id="Set"
	value="<?php echo $_SESSION['Set']; ?>">
                Chamber Music Formations d.d. <?php echo date('d-m-Y') ?> </h2>
        <h2> set of formations            <span class="formation">nr. <?php echo $_SESSION['Set']; ?></span><br>
        </h2>
        <p>Please use this button to move from set to set:
          <button ACCESSKEY="t" name="set" type="button" onClick="ToggleSet()"> Toggle
  set <span class="nadruk">(Shift-Alt-T)</span></button>
      <td width="50%" valign="top"><p>N.B.: Ensembles can have one of two states, designated by the following icons: </p>
<p><img src="Images/Logos/ok.png" alt="confirmed" class="geenlijn">&nbsp;means: this ensemble is complete and the work has been fixed</p>
        <p> <img src="Images/Logos/question.png" alt="confirmed" class="geenlijn">&nbsp;means:  this ensemble is complete, but the work still has to be decided. Please take up contact with the other members and/or the tutor to discuss what to play and let <em>La Pellegrina</em> know the outcome.</p></td>
    </tr>
  </table>
</form></div>
<?php 
$i = 1;
foreach ($ensembles as $i => $ensemble) {
	$ens = '<h2>'. ($i+1) . '. ';
	if ($ensemble['link'] != '') {
		$ensemble['link'] = rawurldecode($ensemble['link']);
		$ens .= "<a href=\"{$ensemble['link']}\" target=\"_blank\">";
	}
	$ens .= stripslashes($ensemble['stuk']);
	if ($ensemble['link'] != '') $ens .= "</a>";
	if ($ensemble['docent1'] > 0) $ens .= '&nbsp;&nbsp;'.$doc[$ensemble['docent1']]['code'];
	if ($ensemble['docent2'] > 0) $ens .= '/'.$doc[$ensemble['docent2']]['code'];
	if ($ensemble['ruimte'] > 0) $ens .= ' ('.$ensemble['ruimte'].')';
	if ($ensemble['definitief'] > 0) $ens .= '&nbsp;<img src="Images/Logos/ok.png" alt="confirmed" class="geenlijn">'; 
		else $ens .= '&nbsp;<img src="Images/Logos/question.png" alt="not confirmed" class="geenlijn">';
	$ens .= '</h2>';
	echo $ens;
	ensembleleden($ensemble['ensembleId']);
	if ($ensemble['opmerking'] != "") echo '<p class="opmerking">'.$ensemble['opmerking'].'</p>';
}
nulensemble();
geenensemble();
tutorcodes();
?>
<!-- InstanceEndEditable -->
    <h2> <a href="javascript: history.go(-1)">Back</a></h2>
    <p>&nbsp;</p>
  </div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
</body>
<!-- InstanceEnd --></html>
