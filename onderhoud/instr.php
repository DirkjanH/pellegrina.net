<?php
//Connection statement
require_once('../connections/inschrijf.php');

//Aditional Functions
require_once('../includes/functions.inc.php');

//Stel utf8 (uitgebreide character set) in:
mysql_query("SET NAMES UTF8");

// begin Recordset
$query_instr = "SELECT * FROM bezetting RIGHT JOIN instr ON bezetting.instrid_fk = instr.id ORDER BY cursusid_fk, instr.id";
$instr = $inschrijf->SelectLimit($query_instr) or die($inschrijf->ErrorMsg());
$totalRows_instr = $instr->RecordCount();
// end Recordset
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.7.1?>
<html>
<head>
<title>Bezetting cursussen</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
table {
	margin: 20px;
}
-->
</style>
</head>

<body>
<table  border="1" cellpadding="2" cellspacing="0">
   <tr>
      <td><i>Cursus:</i></td>
      <td><i>Instrument:</i></td>
      <td><i>Aantal:</i></td>
      <td><i>Opmerking:</i></td>
   </tr>
   <?php
  while (!$instr->EOF) {
?>
      <tr>
         <td><?php echo $instr->Fields('cursusid_fk')?>&nbsp;</td>
         <td><?php echo $instr->Fields('nl'); ?>&nbsp;</td>
         <td><?php echo $instr->Fields('aantal'); ?>&nbsp;</td>
         <td><?php echo $instr->Fields('opmerkingen'); ?>&nbsp;</td>
      </tr>
      <?php
    $instr->MoveNext(); 
  }
?>
</table>
</body>
</html>
<?php
$instr->Close();
?>
