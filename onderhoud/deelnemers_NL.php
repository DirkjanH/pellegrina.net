<?php
//Connection statement
require_once('../connections/inschrijf.php');

//Aditional Functions
require_once('../includes/functions.inc.php');

//Stel utf8 (uitgebreide character set) in:
mysql_query("SET NAMES UTF8");

// begin Recordset
$query_lijst = "SELECT DISTINCT naam, voornaam, email FROM inschrijving, dlnmr, adres WHERE dlnmrid = dlnmrid_fk AND adresid_fk = adresid and taal = 'NL' ORDER BY achternaam ASC";
$lijst = $inschrijf->SelectLimit($query_lijst) or die($inschrijf->ErrorMsg());
$totalRows_lijst = $lijst->RecordCount();
// end Recordset

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html>
<head>
<title>tabel deelnemers</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: xx-small;
}
-->
</style>
</head>

<body>
<table  border="1" cellpadding="4">
  <tr>
    <td>naam</td>
    <td>voornaam</td>
    <td>email</td>
  </tr>
  <?php
  while (!$lijst->EOF) {
?>
    <tr>
      <td><?php echo $lijst->Fields('naam'); ?></td>
      <td><?php echo $lijst->Fields('voornaam'); ?></td>
      <td><?php echo $lijst->Fields('email'); ?></td>
    </tr>
    <?php
    $lijst->MoveNext(); 
  }
?>
</table>
</body>
</html>
<?php
$lijst->Close();
?>
