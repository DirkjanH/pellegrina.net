<?php
//Connection statement
require_once('../connections/inschrijf.php');

//Aditional Functions
require_once('../includes/functions.inc.php');

//Stel utf8 (uitgebreide character set) in:
mysql_query("SET NAMES UTF8");

if ((isset($_GET["zoek"])) AND ($_GET["zoek"] == "zoek")) {

	// begin Recordset
	$query_instr = "SELECT * FROM instr ORDER BY id ASC";
	$instr = $inschrijf->SelectLimit($query_instr) or die($inschrijf->ErrorMsg());
	$totalRows_instr = $instr->RecordCount();
	// end Recordset

	while (!$instr->EOF) { 
		$instrument[$instr->Fields('id')] = $instr->Fields($_GET['taal']);
		$instr->MoveNext(); 
	  }

	// begin Recordset
	$query_inschrijving = "SELECT naam, instr, instrumenten, zangstem, toehoorder FROM dlnmr, inschrijving 
	WHERE CursusId_FK > 2 AND DlnmrId = DlnmrId_FK ORDER BY InschId ASC";
	$inschrijving = $inschrijf->SelectLimit($query_inschrijving) or die($inschrijf->ErrorMsg());
	$totalRows_inschrijving = $inschrijving->RecordCount();
	// end Recordset
} // Zoek

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.7.1?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>test taal instrument</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css" />
</head>


<body>
<form id="form1" method="get" action="<?php echo $_SERVER['../PHP_SELF']; ?>">
  <strong>Taal:
  </strong><br>
  <table width="200">
    <tr>
      <td><label>
        <input type="radio" name="taal" value="nl">
        Nederlands</label></td>
    </tr>
    <tr>
      <td><label>
        <input type="radio" name="taal" value="en">
        Engels</label></td>
    </tr>
    <tr>
      <td><label>
        <input type="radio" name="taal" value="de">
        Duits</label></td>
    </tr>
  </table>
<input name="zoek" type="submit" value="zoek" />
</form>
<p>&nbsp;</p>
<table  border="1" cellpadding="5">
  <tr>
    <td><strong>naam</strong></td>
    <td><strong>Instrument &amp; zangstem </strong></td>
  </tr>
  <?php
  while (!$inschrijving->EOF) {
	$ins = explode(', ', $inschrijving->Fields('instr'));
	foreach($ins as $index => $in) {
		$ins[$index] = $instrument[$in];
		}	
	$ins = implode($ins, ', ');

?>
    <tr>
      <td><?php echo $inschrijving->Fields('naam'); ?></td>
      <td><?php echo $ins; ?></td>
    </tr>
    <?php
    $inschrijving->MoveNext(); 
  }
?>
</table>
</body>
</html>
<?php
$inschrijving->Close();
?>
