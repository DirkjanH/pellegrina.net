<?php //Connection statement
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2024.php');
$CursusId = $eerstecursus;

if (isset($_GET['cursus']) and $_GET['cursus'] != "") 
	$CursusId = $_GET['cursus'] + $cursus_offset; // cursusnummer

$sorteer = 'd.achternaam';

if (isset($_GET['sorteer']) and $_GET['sorteer'] != "") 
	switch ($_GET['sorteer']) {
	case "Naam:":
		$sorteer = 'd.achternaam';
		break;
	case "Postcode:":
		$sorteer = 'a.postcode';
		break;
	case "Eenpersoons:":
		$sorteer = 'i.eenpersoons DESC, d.achternaam';
		break;
	case "Panská 1-pp:":
		$sorteer = 'i.part_eenp DESC, d.achternaam';
		break;
	case "Panská 2-pp:":
		$sorteer = 'i.particulier DESC, d.achternaam';
		break;
	case "Kamperen:":
		$sorteer = 'i.kamperen DESC, d.achternaam';
		break;
}

/* echo '<pre>';
print_r($_GET);
echo '</pre>';
 */
// begin Recordset
$query_Cursus = "SELECT d.naam, i.eenpersoons, i.kamperen, i.particulier, i.part_eenp, i.acc_wens, a.postcode, i.opmerkingen FROM dlnmr d, inschrijving i, adres a WHERE NOT (d.naam LIKE \"%XXX%\" OR d.naam LIKE \"%YYY%\" OR d.naam LIKE \"%ZZZ%\") AND i.CursusId_FK = {$CursusId} AND d.dlnmrid = i.dlnmrid_fk AND d.adresId_FK = a.adresId AND aangenomen = 1 AND NOT (afgewezen <=> 1) ORDER BY {$sorteer}";
	
	$Cursus = $inschrijf->SelectLimit($query_Cursus) or die($inschrijf->ErrorMsg());
	$totalRows_Cursus= $Cursus->RecordCount();

$toehoorders_Cursus = "SELECT * FROM inschrijving WHERE CursusId_FK = {$CursusId} AND toehoorder = 1 and NOT (afgewezen <=> 1)";
	$toe = $inschrijf->SelectLimit($toehoorders_Cursus) or die($inschrijf->ErrorMsg());
	$toehoorders_Cursus = $toe->RecordCount();

$query_Cursusnaam = "SELECT cursusnaam_nl, YEAR(datum_begin) as jaar FROM cursus WHERE CursusId = {$CursusId}";
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

<title>Accommodatie</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
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
-->
</style>
</head>
<body>

  
<form action="<?php echo $editFormAction; ?>" method="get" name="form" id="form">
  <p>
    <label>
      Kies het project: 
      <input type="radio" name="cursus" value="1" <?php if (isset($_GET['cursus']) and ($_GET['cursus'] == 1)) echo 'checked';?>>
      Cursus 1</label>
    <label>
      | 
<input type="radio" name="cursus" value="2" <?php if (isset($_GET['cursus']) and ($_GET['cursus'] == 2)) echo 'checked';?>>
      Cursus 2</label>
    <label>
      | 
<input type="radio" name="cursus" value="3" <?php if (isset($_GET['cursus']) and ($_GET['cursus'] == 3)) echo 'checked';?>>
      Cursus 3</label>
    <label>
      | 
<input type="radio" name="cursus" value="4" <?php if (isset($_GET['cursus']) and ($_GET['cursus'] == 4)) echo 'checked';?>>
      Cursus 4</label>
    <input name="Verzend" type="submit" id="Verzend" value="Verzend">
    <br>
  </p>
<h2>Cursus <em><?php echo $Cursusnaam->Fields('cursusnaam_nl') . '</em>&nbsp;'.$Cursusnaam->Fields('jaar').'</h2><p>'. $totalRows_Cursus;?> participants<?php if ($toehoorders_Cursus > 0) echo ", incl. {$toehoorders_Cursus} toehoorder(s)"; ?></p>
<p class="nadruk">&nbsp;</p>
<table >
  <tr>
    <th width="10%">Naam</th>
        <th>Opmerkingen</th>
  </tr>
  <?php
  while (!$Cursus->EOF) {
?>
    <tr>
      <td width="10%"><?php echo $Cursus->Fields('naam'); ?>&nbsp;</td>
	  <td><?php echo $Cursus->Fields('opmerkingen'); ?>&nbsp;</td>
    </tr>
    <?php
    $Cursus->MoveNext(); 
  }
?>
</table>
</form>
</body>
</html>
<?php
$Cursus->Close();
?>
