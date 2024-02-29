<?php
//Connection statement
require_once('../connections/inschrijf_oud.php');

// begin Recordset
$query_Recordset1 = "SELECT * FROM inschrijvingen WHERE aanbet_bedrag IS NULL AND aangenomen = 1 ORDER BY achternaam ASC";
$Recordset1 = $inschrijf->SelectLimit($query_Recordset1) or die($inschrijf->ErrorMsg());
$totalRows_Recordset1 = $Recordset1->RecordCount();
// end Recordset

// begin Recordset
$query_Recordset2 = "SELECT * FROM inschrijvingen WHERE (aangenomen <> \"1\" OR aangenomen IS NULL) AND (afgewezen IS NULL OR afgewezen <> 1) ORDER BY achternaam ASC";
$Recordset2 = $inschrijf->SelectLimit($query_Recordset2) or die($inschrijf->ErrorMsg());
$totalRows_Recordset2 = $Recordset2->RecordCount();
// end Recordset

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html>
<head>
<title>Nog geen aanbetaling ontvangen</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="http://www.xs4all.nl/%7Ehorringa/Pellegrina/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
</head>

<body>
<h2>Nog geen aanbetaling ontvangen: <?php echo $totalRows_Recordset1; ?></h2>
<h2>&nbsp;</h2>
<table  border="2" cellpadding="2" cellspacing="0">
   <tr>
      <td class="klein"><b>InschId</b></td>
      <td class="klein"><b>cursus1</b></td>
      <td class="klein"><b>cursus2</b></td>
      <td class="klein"><b>naam</b></td>
      <td class="klein"><b>taal</b></td>
      <td class="klein"><b>telefoon</b></td>
      <td class="klein"><b>mobiel</b></td>
      <td class="klein"><b>email</b></td>
      <td class="klein"><b>korting</b></td>
      <td class="klein"><b>student</b></td>
      <td class="klein"><b>oost</b></td>
      <td class="klein"><b>eenpersoons</b></td>
      <td class="klein"><b>kamperen</b></td>
      <td class="klein"><b>hotel eenpers.</b></td>
      <td class="klein"><b>hotel tweepers.</b></td>
      <td class="klein"><b>storting_fonds</b></td>
      <td class="klein"><b>donatie</b></td>
      <td class="klein"><b>aanbetaling</b></td>
      <td class="klein"><b>aanbet_bedrag</b></td>
      <td class="klein"><b>cursusgeld</b></td>
      <td class="klein"><b>voorl_bev</b></td>
      <td class="klein"><b>datum_inschr</b></td>
   </tr>
   <?php
  while (!$Recordset1->EOF) {
?>
   <tr>
      <td class="klein"><?php echo $Recordset1->Fields('InschId'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('cursus1'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('cursus2'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('naam'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('taal'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('telefoon'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('mobiel'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('email'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('korting'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('student'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('oost'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('eenpersoons'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('kamperen'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('hotel_1pp'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('hotel_2pp'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('storting_fonds'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('donatie'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('aanbetaling'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('aanbet_bedrag'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('cursusgeld'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('voorl_bev'); ?></td>
      <td class="klein"><?php echo $Recordset1->Fields('datum_inschr'); ?></td>
   </tr>
   <?php
    $Recordset1->MoveNext(); 
  }
?>
</table>
<h2>Niet aangenomen: <?php echo $totalRows_Recordset2; ?></h2>
<h2>&nbsp;</h2>
<table  border="2" cellpadding="2" cellspacing="0">
   <tr>
      <td class="klein"><b>InschId</b></td>
      <td class="klein"><b>cursus1</b></td>
      <td class="klein"><b>cursus2</b></td>
      <td class="klein"><b>naam</b></td>
      <td class="klein"><b>taal</b></td>
      <td class="klein"><b>telefoon</b></td>
      <td class="klein"><b>mobiel</b></td>
      <td class="klein"><b>email</b></td>
      <td class="klein"><b>korting</b></td>
      <td class="klein"><b>student</b></td>
      <td class="klein"><b>oost</b></td>
      <td class="klein"><b>eenpersoons</b></td>
      <td class="klein"><b>kamperen</b></td>
      <td class="klein"><b>particulier</b></td>
      <td class="klein"><b>storting_fonds</b></td>
      <td class="klein"><b>donatie</b></td>
      <td class="klein"><b>aanbetaling</b></td>
      <td class="klein"><b>aanbet_bedrag</b></td>
      <td class="klein"><b>cursusgeld</b></td>
      <td class="klein"><b>voorl_bev</b></td>
      <td class="klein"><b>datum_inschr</b></td>
   </tr>
   <?php
  while (!$Recordset2->EOF) {
?>
   <tr>
      <td class="klein"><?php echo $Recordset2->Fields('InschId'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('cursus1'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('cursus2'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('naam'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('taal'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('telefoon'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('mobiel'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('email'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('korting'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('student'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('oost'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('eenpersoons'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('kamperen'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('hotel_2pp'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('storting_fonds'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('donatie'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('aanbetaling'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('aanbet_bedrag'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('cursusgeld'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('voorl_bev'); ?></td>
      <td class="klein"><?php echo $Recordset2->Fields('datum_inschr'); ?></td>
   </tr>
   <?php
    $Recordset2->MoveNext(); 
  }
?>
</table>
</body>
</html>
<?php
$Recordset1->Close();
?>
