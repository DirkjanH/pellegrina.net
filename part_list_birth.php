<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');

require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2023.php');

ob_start();

Kint::$enabled_mode = false;

$CursusId = $eerstecursus;
if (isset($_GET['cursus']) and $_GET['cursus'] > 0) 
	$CursusId = $_GET['cursus'] + $cursus_offset; // cursusnummer
if (empty($_GET['niet_aangenomen']) or $_GET['niet_aangenomen'] != 1) 
	$ook_niet_aangenomen = 'AND i.aangenomen = 1'; // niet-aangenomen deelnemers uitsluiten
	else
	$ook_niet_aangenomen = '';
if (empty($_GET['gepostuleerd']) or $_GET['gepostuleerd'] != 1) 
	$ook_gepostuleerd = 'AND NOT (d.achternaam LIKE "%XXX%" OR d.achternaam LIKE "%YYY%" OR d.achternaam LIKE "%ZZZ%")'; // geen gepostuleerde deelnemers
	else
	$ook_gepostuleerd = '';
if (empty($_GET['gecanceld']) or $_GET['gecanceld'] != 1) 
	$ook_gecanceld = 'AND NOT (afgewezen <=> 1)'; // geen afgewezen of gecancelde deelnemers
	else
	$ook_gecanceld = '';

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

d($sorteer, $ook_gepostuleerd, $ook_niet_aangenomen, $ook_gecanceld);

 // begin Recordset
$deelnemers_query = "SELECT d.naam, d.achternaam, CONCAT(a.adres, \", \", a.postcode, \" \", a.plaats, \", \", a.land) as \"adres\", d.geboortedatum, d.telefoon, d.mobiel, d.email, i.instr, i.instrumenten, i.toehoorder, i.zangstem, i.vervoer, i.aangenomen, i.afgewezen FROM dlnmr d, adres a, inschrijving i WHERE i.CursusId_FK = {$CursusId} AND d.adresid_FK = a.adresid AND d.dlnmrid = i.dlnmrid_fk  {$ook_niet_aangenomen} {$ook_gepostuleerd} {$ook_gecanceld} ORDER BY {$sorteer} ASC";
$Cursussen = select_query($deelnemers_query);
$aantal_deelnemers= count($Cursussen);

$toehoorders_Cursus = select_query("SELECT count(*) FROM inschrijving WHERE CursusId_FK = {$CursusId} AND toehoorder = 1 and NOT (afgewezen <=> 1)", 0);

$cursusnaam = select_query("SELECT cursusnaam_en, YEAR(datum_begin) as jaar FROM cursus WHERE CursusId = {$CursusId}", 1);

$Docenten = select_query("SELECT naam, CONCAT(adres, \", \", PC, \" \", plaats, \", \", land) as adres, telefoon, mobiel, email, cd.vak FROM cursus as c, cursusdocenten AS cd, docenten AS d WHERE CursusId_FK = {$CursusId} AND cd.DocId_FK = d.DocId AND c.CursusId = cd.CursusID_FK ORDER BY d.achternaam");
// end Recordset

d($deelnemers_query, $Cursussen, $docenten);

// begin Recordset
$instrumenten = select_query("SELECT * FROM instr ORDER BY id ASC");
foreach ($instrumenten as $record) $instrumententabel[$record['id']] = $record['en'];
// end Recordset

?>
<!DOCTYPE HTML>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/pellegrina_stijlen.css">
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<meta charset="utf-8">
<meta name="robots" content="noindex, nofollow">
<html>
<head>
<title>List of participants</title>
<style type="text/css">
<!--
body {
	margin-left: 20px;
	margin-top: 20px;
	margin-right: 20px;
}
table {
	/* [disabled]table-layout: auto; */
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
tr.afgewezen {
	background: pink;
}
div#inhoud {
	margin-left: 0px;
	border: none;
	background-color: white;
}
div#header {
	border: none;
	background-color: white;
}
-->
</style>
<style type="text/css" media="print">
<!--
.no-print {
	display: none;
}
div#inhoud, div#top {
	margin-left: 0px;
	border: none;
}
div#top img {
	border:hidden;
	}
-->
</style>

</head>
<body>
<div id="inhoud">
  <div id="header" class="no-print w3-center w3-padding-top"><img class="geenlijn" src="Images/Logos/Pellegrina.gif" width="402" height="75" alt="La Pellegrina"/></div>
<div class="w3-content">
      <form action="<?php echo $editFormAction; ?>" method="get" name="form" id="form">
        <input name="cursus" type="hidden" value="<?php echo $_GET['cursus']; ?>">
        <input name="niet_aangenomen" type="hidden" value="<?php echo $_GET['niet_aangenomen']; ?>">
        <input name="gecanceld" type="hidden" value="<?php echo $_GET['gecanceld']; ?>">
        <h2>Course <em><?php echo $cursusnaam['cursusnaam_en'] . '</em>&nbsp;'.$jaar.'</h2><p>'. $aantal_deelnemers;?> participants<?php if ($toehoorders_Cursus > 0) echo ", including {$toehoorders_Cursus} auditor(s)"; ?>
        </p>
        <p class="nadruk">You can sort this list on name, address, instruments, singing voice or transportation method by pressing the buttons in the heading</p>
        <table>
          <tr>
            <th width="20%"><input type="submit" name="sorteer" value="Name:" accesskey="N"></th>
            <th width="20%">Date of Birth - Datum nárození</th>
            <th width="30%"><input type="submit" name="sorteer" value="Address:" accesskey="A"></th>
            <th>Telephone:</th>
            <th>Mobile:</th>
            <th>E-mail:</th>
          </tr>
          <?php
  foreach ($Cursussen as $cursus) {
	$ins = explode(', ', trim($cursus['instr']));
	$zangst = explode(', ', trim($cursus['zangstem']));
	d($ins, $zangst);
	unset($instr);
	unset($zangstem);
	foreach ($ins as $in) if ($in >= 100) $instr[] = $instrumententabel[$in];
	foreach ($zangst as $zangs) if ($zangs < 100) $zangstem[] = $instrumententabel[$zangs];
	if (isset($instr)) $instr = implode(', ', $instr);
	if (isset($zangstem)) $zangstem = implode(', ', $zangstem);
?>
          <tr <?php if ($cursus['aangenomen'] != 1) echo 'class="niet_aangenomen"';
	  			if ($cursus['afgewezen'] == 1) echo 'class="afgewezen"';
			  if (strpos($cursus['achternaam'], "XXX") !== false OR strpos($cursus['achternaam'], "YYY") 
			  !== false OR strpos($cursus['achternaam'], "ZZZ") !== false) echo 'class="gepostuleerd"'; 
	?>>
            <td class="klein"><?php echo $cursus['naam']; ?>&nbsp;</td>
            <td class="klein"><?php echo $cursus['geboortedatum']; ?>&nbsp;</td>
            <td class="klein"><?php echo $cursus['adres']; ?>&nbsp;</td>
            <td class="klein"><?php echo $cursus['telefoon']; ?>&nbsp;</td>
            <td class="klein"><?php echo $cursus['mobiel']; ?>&nbsp;</td>
            <td class="klein"><?php echo $cursus['email']; ?>&nbsp;</td>
          </tr>
          <?php
  }
?>
        </table>
        <input name="niet_aangenomen" type="hidden" value="<?php echo $_GET['niet_aangenomen']; ?>">
        <input name="gepostuleerd" type="hidden" value="<?php echo $_GET['gepostuleerd']; ?>">
      </form>
      <h2>Tutors:</h2>
      <table style="margin-top: 0px">
        <tr>
          <th><i>Name:</i></th>
          <th><i>Address:</i></th>
          <th><i>Telephone:</i></th>
          <th><i>Mobile:</i></th>
          <th><i>Email:</i></th>
          <th><i>Subject:</i></th>
        </tr>
        <?php
  foreach ($Docenten as $docent) {
?>
        <tr>
          <td class="klein"><?php echo $docent['naam']; ?>&nbsp;</td>
          <td class="klein"><?php echo $docent['adres']; ?>&nbsp;</td>
          <td class="klein"><?php echo $docent['telefoon']; ?>&nbsp;</td>
          <td class="klein"><?php echo $docent['mobiel']; ?>&nbsp;</td>
          <td class="klein"><?php echo $docent['email']; ?>&nbsp;</td>
          <td class="klein"><?php echo $docent['vak']; ?>&nbsp;</td>
        </tr>
        <?php
  }
?>
      </table>
      <p>&nbsp;</p>
   </div>
</div>
<a title="Real Time Web Analytics" href="https://getclicky.com/66381795"><img alt="Real Time Web Analytics" src="https://static.getclicky.com/media/links/badge.gif" border="0" /></a> 
<script src="https://static.getclicky.com/js" type="text/javascript"></script> 
<script type="text/javascript">try{ clicky.init(66381795); }catch(err){}</script>
<noscript>
<p><img alt="Clicky" width="1" height="1" src="https://in.getclicky.com/66381795ns.gif" /></p>
</noscript>
</body>
</html>
<?php ob_end_flush(); ?>