<?php
//Connection statement
require_once('../connections/inschrijf_oud.php');

// begin Recordset
$query_Cursus1 = "SELECT * FROM inschrijvingen WHERE cursus1 = 1 AND aangenomen = 1 AND toehoorder <> 1 ORDER BY instrumenten ASC, zangstem, achternaam";
$Cursus1 = $inschrijf->SelectLimit($query_Cursus1) or die($inschrijf->ErrorMsg());
$totalRows_Cursus1 = $Cursus1->RecordCount();
// end Recordset

//Connection statement
require_once('../connections/inschrijf_oud.php');

// begin Recordset
$query_Cursus2 = "SELECT * FROM inschrijvingen WHERE cursus2 = 1 AND aangenomen = 1 AND toehoorder <> 1 ORDER BY instrumenten ASC, zangstem, achternaam";
$Cursus2 = $inschrijf->SelectLimit($query_Cursus2) or die($inschrijf->ErrorMsg());
$totalRows_Cursus2 = $Cursus2->RecordCount();
// end Recordset

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html>
<head>
<title>Cursisten op instrument</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="http://www.xs4all.nl/%7Ehorringa/Pellegrina/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
</head>

<body>
<h2>Cursus 1 (<?php echo $totalRows_Cursus1;?> actieve deelnemers):</h2>
<p>&nbsp;</p>
<table  border="2" cellpadding="2" cellspacing="0">
   <tr>
      <td height="29">InschId</td>
      <td>naam</td>
      <td>plaats</td>
      <td>taal</td>
      <td>email</td>
      <td>instrumenten</td>
      <td>zangstem</td>
      <td>datum_inschr</td>
   </tr>
   <?php
  while (!$Cursus1->EOF) {
?>
   <tr>
      <td class="klein"><?php echo $Cursus1->Fields('InschId'); ?></td>
      <td class="klein"><?php echo $Cursus1->Fields('naam'); ?></td>
      <td class="klein"><?php echo $Cursus1->Fields('plaats'); ?></td>
      <td class="klein"><?php echo $Cursus1->Fields('taal'); ?></td>
      <td class="klein"><?php echo $Cursus1->Fields('email'); ?></td>
      <td class="klein"><?php echo $Cursus1->Fields('instrumenten'); ?></td>
      <td class="klein"><?php echo $Cursus1->Fields('zangstem'); ?></td>
      <td class="klein"><?php echo $Cursus1->Fields('datum_inschr'); ?></td>
   </tr>
   <?php
    $Cursus1->MoveNext(); 
  }
?>
</table>
<p>&nbsp;</p>
<h2>Cursus 2 (<?php echo $totalRows_Cursus2;?> actieve deelnemers):</h2>
<p>&nbsp;</p>
<table  border="2" cellpadding="2" cellspacing="0">
   <tr>
      <td>InschId</td>
      <td>naam</td>
      <td>plaats</td>
      <td>taal</td>
      <td>email</td>
      <td>instrumenten</td>
      <td>groot_ensemble1</td>
      <td>groot_ensemble2</td>
      <td>datum_inschr</td>
   </tr>
   <?php
  while (!$Cursus2->EOF) {
?>
   <tr>
      <td class="klein"><?php echo $Cursus2->Fields('InschId'); ?></td>
      <td class="klein"><?php echo $Cursus2->Fields('naam'); ?></td>
      <td class="klein"><?php echo $Cursus2->Fields('plaats'); ?></td>
      <td class="klein"><?php echo $Cursus2->Fields('taal'); ?></td>
      <td class="klein"><?php echo $Cursus2->Fields('email'); ?></td>
      <td class="klein"><?php echo $Cursus2->Fields('instrumenten'); ?></td>
      <td class="klein"><?php echo $Cursus2->Fields('groot_ensemble1'); ?></td>
      <td class="klein"><?php echo $Cursus2->Fields('groot_ensemble2'); ?></td>
      <td class="klein"><?php echo $Cursus2->Fields('datum_inschr'); ?></td>
   </tr>
   <?php
    $Cursus2->MoveNext(); 
  }
?>
</table>
</body>
</html>
<?php
$Cursus1->Close();

$Cursus2->Close();
?>
