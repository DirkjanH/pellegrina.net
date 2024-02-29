<?php //Connection statement
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');

Kint::$enabled_mode = false;

require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2020.php');

if (empty($_GET['niet_aangenomen']) or $_GET['niet_aangenomen'] != 1) 
	$ook_niet_aangenomen = 'AND i.aangenomen = 1'; // niet-aangenomen deelnemers uitsluiten
	else
	$ook_niet_aangenomen = '';
if (empty($_GET['gepostuleerd']) or $_GET['gepostuleerd'] != 1) 
	$ook_gepostuleerd = 'AND NOT (d.achternaam LIKE "%XXX%" OR d.achternaam LIKE "%YYY%" OR d.achternaam LIKE "%ZZZ%")'; // geen gepostuleerde deelnemers
	else
	$ook_gepostuleerd = '';

$sorteer = 'i.CursusId_FK, d.achternaam';

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

 // begin Recordset
$cursistenSQL = "SELECT d.naam, d.achternaam, CONCAT(a.adres, \", \", a.postcode, \" \", a.plaats, \", \", a.land) as \"adres\", d.telefoon, 		d.mobiel, d.email, i.instr, i.instrumenten, i.toehoorder, i.zangstem, i.vervoer, i.aangenomen, i.ACMP, i.CursusId_FK AS CursusId FROM dlnmr d, adres a, inschrijving i WHERE i.ACMP = 1 AND d.adresid_FK = a.adresid AND d.dlnmrid = i.dlnmrid_fk AND i.CursusId_FK BETWEEN {$eerstecursus} AND {$laatstecursus} AND NOT (afgewezen <=> 1) {$ook_niet_aangenomen} {$ook_gepostuleerd} ORDER BY {$sorteer} ASC";

//echo($cursistenSQL);
$Cursussen = select_query($cursistenSQL);
$aantal_deelnemers= count($Cursussen);
// end Recordset

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
<title>List of ACMP registrations</title>
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
	margin-bottom: 50px;
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
div#inhoud {
	margin-left: 0px;
	border: none;
	background-color: white;
	padding-bottom: 50px;
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
        <h2>Courses <?php echo $jaar.'</h2><p>'. $aantal_deelnemers;?> participants ticked the ACMP membership box on the registration form</p>
         <table>
          <tr>
            <th>Name:</th>
            <th width="30%">Address:</th>
            <th>Telephone:</th>
            <th>Mobile:</th>
            <th>E-mail:</th>
            <th>Course:</th>
            <th>Instruments:</th>
            <th>Singing voice:</th>
          </tr>
          <?php
  foreach ($Cursussen as $cursus) {
	$ins = explode(', ', trim($cursus['instr']));
	$zangst = explode(', ', trim($cursus['zangstem']));
	// var_dump($ins);
	unset($instr);
	unset($zangstem);
	foreach ($ins as $in) if ($in >= 100) $instr[] = $instrumententabel[$in];
	foreach ($zangst as $zangs) if ($zangs < 100) $zangstem[] = $instrumententabel[$zangs];
	if (isset($instr)) $instr = implode(', ', $instr);
	if (isset($zangstem)) $zangstem = implode(', ', $zangstem);
?>
          <tr <?php if ($cursus['aangenomen'] != 1) echo 'class="niet_aangenomen"';
			  if (strpos($cursus['achternaam'], "XXX") !== false OR strpos($cursus['achternaam'], "YYY") 
			  !== false OR strpos($cursus['achternaam'], "ZZZ") !== false) echo 'class="gepostuleerd"'; 
	?>>
            <td class="klein"><?php echo $cursus['naam']; ?>&nbsp;</td>
            <td class="klein"><?php echo $cursus['adres']; ?>&nbsp;</td>
            <td class="klein"><?php echo $cursus['telefoon']; ?>&nbsp;</td>
            <td class="klein"><?php echo $cursus['mobiel']; ?>&nbsp;</td>
            <td class="klein"><?php echo $cursus['email']; ?>&nbsp;</td>
            <td class="klein"><?php echo $cursus['CursusId']; ?>&nbsp;</td>
            <td class="klein"><?php if (isset($instr)) echo $instr; ?>&nbsp;</td>
            <?php if ($CursusId != $eerstecursus+2) echo '<td class="klein">';
			if (isset($zangstem)) echo $zangstem; ?>
              <?php if ($CursusId != $eerstecursus) echo '&nbsp;</td>' ?>
          </tr>
          <?php
  }
?>
        </table>
        <input name="niet_aangenomen" type="hidden" value="<?php echo $_GET['niet_aangenomen']; ?>">
        <input name="gepostuleerd" type="hidden" value="<?php echo $_GET['gepostuleerd']; ?>">
      </form>
   </div>
</div>
<a title="Real Time Web Analytics" href="http://getclicky.com/66381795"><img alt="Real Time Web Analytics" src="http://static.getclicky.com/media/links/badge.gif" border="0" /></a> 
<script src="http://static.getclicky.com/js" type="text/javascript"></script> 
<script type="text/javascript">try{ clicky.init(66381795); }catch(err){}</script>
<noscript>
<p><img alt="Clicky" width="1" height="1" src="http://in.getclicky.com/66381795ns.gif" /></p>
</noscript>
</body>
</html>
