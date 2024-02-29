<?php //Connection statement
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2011.php');
$CursusId = $eerstecursus;
if (isset($_GET['cursus']) and $_GET['cursus'] != "") 
	$CursusId = $_GET['cursus']; // cursusnummer
if (empty($_GET['niet_aangenomen']) or $_GET['niet_aangenomen'] != 1) 
	$ook_niet_aangenomen = 'AND i.aangenomen = 1'; // ook niet-aangenomen deelnemers selecteren?

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
		$sorteer = 'i.instrumenten, i.zangstem, d.achternaam';
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
$query_Cursus = "SELECT d.naam, CONCAT(a.adres, \", \", a.postcode, \" \", a.plaats, \", \", a.land) as \"adres\", d.telefoon, 		d.mobiel, d.email, i.instr, i.instrumenten, i.toehoorder, i.zangstem, i.vervoer FROM dlnmr d, adres a, inschrijving i WHERE NOT (d.naam LIKE \"%XXX%\" OR d.naam LIKE \"%YYY%\" OR d.naam LIKE \"%ZZZ%\") AND i.CursusId_FK = {$CursusId} AND d.adresid_FK = a.adresid AND d.dlnmrid = i.dlnmrid_fk 
AND NOT (afgewezen <=> 1) {$ook_niet_aangenomen} ORDER BY {$sorteer} ASC";
	
	$Cursus = $inschrijf->SelectLimit($query_Cursus) or die($inschrijf->ErrorMsg());
	$totalRows_Cursus= $Cursus->RecordCount();

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
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //PHP ADODB document - made with PHAkt 2.5.1?>
<html>
<head>

<title>Participants</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
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
-->
</style>
</head>
<body>

  
<form action="<?php echo $editFormAction; ?>" method="get" name="form" id="form">
<input name="cursus" type="hidden" value="<?php echo $_GET['cursus']; ?>">
<input name="niet_aangenomen" type="hidden" value="<?php echo $_GET['niet_aangenomen']; ?>">
<h2>Course <em><?php echo $Cursusnaam->Fields('cursusnaam_en') . '</em>&nbsp;'.$Cursusnaam->Fields('jaar').'</h2><p>'. $totalRows_Cursus;?> participants<?php if ($toehoorders_Cursus > 0) echo ", including {$toehoorders_Cursus} auditor(s)"; ?></p>
<p class="nadruk">You can sort this list on name, address, instruments, singing voice or transportation method by pressing the buttons in the heading</p>
<table >
  <tr>
    <td><input type="submit" name="sorteer" value="Name:" accesskey="N"></td>
        <td><input type="submit" name="sorteer" value="Address:" accesskey="A"></td>
        <td><i>Telephone:</i></td>
        <td><i>Mobile:</i></td>
        <td><i>E-mail:</i></td>
        <td><input type="submit" name="sorteer" value="Instruments:" accesskey="I"></td>
        <td><input type="submit" name="sorteer" value="Singing voice:" accesskey="V"></td>
        <td><input type="submit" name="sorteer" value="Transport:" accesskey="T"></td>
  </tr>
  <?php
  while (!$Cursus->EOF) {
	$ins = explode(', ', $Cursus->Fields('instr'));
	unset($instr);
	unset($zangstem);
	foreach ($ins as $in) if ($in >= 100) $instr[] = $instrumententabel[$in];
	$instr = implode(', ', $instr);
	$zangstem = $instrumententabel[$Cursus->Fields('zangstem')];
?>
    <tr>
       <td class="klein"><?php echo $Cursus->Fields('naam'); ?>&nbsp;</td>
       <td class="klein"><?php echo $Cursus->Fields('adres'); ?>&nbsp;</td>
       <td class="klein"><?php echo $Cursus->Fields('telefoon'); ?>&nbsp;</td>
       <td class="klein"><?php echo $Cursus->Fields('mobiel'); ?>&nbsp;</td>
       <td class="klein"><?php echo $Cursus->Fields('email'); ?>&nbsp;</td>
       <td class="klein"><?php echo $instr; ?>&nbsp;</td>
       <td class="klein"><?php echo $zangstem; ?>&nbsp;</td>
       <td class="klein"><?php echo $Cursus->Fields('vervoer'); ?>&nbsp;</td>
    </tr>
    <?php
    $Cursus->MoveNext(); 
  }
?>
</table>
</form>
<h2>&nbsp;</h2>
</body>
</html>
<?php
$Cursus->Close();
$Docenten->Close();
?>
