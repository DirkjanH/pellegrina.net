<?php
//Connection statement
require_once('../connections/inschrijf_oud.php');

// begin Recordset
$query_inzeep1 = "SELECT naam, inzeepdag FROM inschrijvingen WHERE inzeepdag Is Not Null AND Cursus1 = '1' ORDER BY achternaam ASC";
$inzeep1 = $inschrijf->SelectLimit($query_inzeep1) or die($inschrijf->ErrorMsg());
$totalRows_inzeep1 = $inzeep1->RecordCount();
// end Recordset

// begin Recordset
$query_inzeep2 = "SELECT naam, inzeepdag FROM inschrijvingen WHERE inzeepdag Is Not Null AND Cursus2 = '1' ORDER BY achternaam ASC";
$inzeep2 = $inschrijf->SelectLimit($query_inzeep2) or die($inschrijf->ErrorMsg());
$totalRows_inzeep2 = $inzeep2->RecordCount();
// end Recordset

?><!DOCTYPE HTML>
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html>
<head>
<title>niet aanwezig op de inzeeprepetitie</title>
<meta charset="utf-8">
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
</head>

<body>
<h2>Aanwezig op de inzeepdag </h2>
<p>&nbsp;</p>
<p><b>Cursus 1: <?php echo $totalRows_inzeep1; ?></b> cursisten niet aanwezig
op de inzeepdag:</p>
<table  border="1" cellpadding="2" cellspacing="0">
   <tr>
      <th><p>naam</p>      </th>
      <th>inzeepdag</th>
   </tr>
   <?php
  while (!$inzeep1->EOF) {
?>
   <tr>
      <td><?php echo $inzeep1->Fields('naam'); ?></td>
      <td><?php echo $inzeep1->Fields('inzeepdag'); ?></td>
   </tr>
   <?php
    $inzeep1->MoveNext(); 
  }
?>
</table>
<p><b>Cursus 2: <?php echo $totalRows_inzeep2; ?></b> cursisten niet aanwezig op de inzeepdag:</p>
<table  border="1" cellpadding="2" cellspacing="0">
   <tr>
      <th><p>naam</p></th>
      <th>inzeepdag</th>
   </tr>
   <?php
  while (!$inzeep2->EOF) {
?>
   <tr>
      <td><?php echo $inzeep2->Fields('naam'); ?></td>
      <td><?php echo $inzeep2->Fields('inzeepdag'); ?></td>
   </tr>
   <?php
    $inzeep2->MoveNext(); 
  }
?>
</table>
<p></p>
</body>
</html>
<?php
$inzeep1->Close();
?>
