<?php
//Connection statement
require_once('../connections/inschrijf_oud.php');

// begin Recordset
$query_CD1 = "SELECT naam, instrumenten, zangstem FROM inschrijvingen WHERE cd_1 = 1 ORDER BY achternaam ASC";
$CD1 = $inschrijf->SelectLimit($query_CD1) or die($inschrijf->ErrorMsg());
$totalRows_CD1 = $CD1->RecordCount();
// end Recordset

// begin Recordset
$query_CD2 = "SELECT naam, instrumenten FROM inschrijvingen WHERE cd_2 = 1 ORDER BY achternaam ASC";
$CD2 = $inschrijf->SelectLimit($query_CD2) or die($inschrijf->ErrorMsg());
$totalRows_CD2 = $CD2->RecordCount();
// end Recordset
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html>
<head>
<title>CD-bestellingen</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<p>CD 1:</p>
<table  border="1" cellpadding="2" cellspacing="0">
   <tr>
      <td>naam</td>
      <td>instrumenten</td>
      <td>zangstem</td>
   </tr>
   <?php
  while (!$CD1->EOF) {
?>
   <tr>
      <td><?php echo $CD1->Fields('naam'); ?></td>
      <td><?php echo $CD1->Fields('instrumenten'); ?></td>
      <td><?php echo $CD1->Fields('zangstem'); ?></td>
   </tr>
   <?php
    $CD1->MoveNext(); 
  }
?>
</table>
<p>&nbsp;</p>
<p>CD 2:</p>
<table  border="1" cellpadding="2" cellspacing="0">
   <tr>
      <td>naam</td>
      <td>instrumenten</td>
   </tr>
   <?php
  while (!$CD2->EOF) {
?>
   <tr>
      <td><?php echo $CD2->Fields('naam'); ?></td>
      <td><?php echo $CD2->Fields('instrumenten'); ?></td>
   </tr>
   <?php
    $CD2->MoveNext(); 
  }
?>
</table>
</body>
</html>
<?php
$CD1->Close();

$CD2->Close();
?>
