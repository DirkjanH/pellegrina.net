<?php
//Connection statement
require_once('../connections/inschrijf_oud.php');

// begin Recordset
$query_Kamers1 = "SELECT naam FROM inschrijvingen WHERE cursus1 = 1 AND aangenomen = 1 AND eenpersoons = 1 ORDER BY achternaam ASC";
$Kamers1 = $inschrijf->SelectLimit($query_Kamers1) or die($inschrijf->ErrorMsg());
$totalRows_Kamers1 = $Kamers1->RecordCount();
// end Recordset

// begin Recordset
$query_Kamers2 = "SELECT naam FROM inschrijvingen WHERE cursus2 = 1 AND aangenomen = 1 AND eenpersoons = 1 ORDER BY achternaam ASC";
$Kamers2 = $inschrijf->SelectLimit($query_Kamers2) or die($inschrijf->ErrorMsg());
$totalRows_Kamers2 = $Kamers2->RecordCount();
// end Recordset

// begin Recordset
$query_Kampeer1 = "SELECT naam FROM inschrijvingen WHERE cursus1 = 1 AND aangenomen = 1 AND kamperen = 1 ORDER BY achternaam ASC";
$Kampeer1 = $inschrijf->SelectLimit($query_Kampeer1) or die($inschrijf->ErrorMsg());
$totalRows_Kampeer1 = $Kampeer1->RecordCount();
// end Recordset

// begin Recordset
$query_Kampeer2 = "SELECT naam FROM inschrijvingen WHERE cursus2 = 1 AND aangenomen = 1 AND kamperen = 1 ORDER BY achternaam ASC";
$Kampeer2 = $inschrijf->SelectLimit($query_Kampeer2) or die($inschrijf->ErrorMsg());
$totalRows_Kampeer2 = $Kampeer2->RecordCount();
// end Recordset

// begin Recordset
$query_Rest1 = "SELECT naam FROM inschrijvingen WHERE cursus1 = 1 AND aangenomen = 1 AND NOT (eenpersoons = 1 OR kamperen = 1) ORDER BY achternaam ASC";
$Rest1 = $inschrijf->SelectLimit($query_Rest1) or die($inschrijf->ErrorMsg());
$totalRows_Rest1 = $Rest1->RecordCount();
// end Recordset

// begin Recordset
$query_Rest2 = "SELECT naam FROM inschrijvingen WHERE cursus2 = 1 AND aangenomen = 1 AND NOT (eenpersoons = 1 OR kamperen = 1) ORDER BY achternaam ASC";
$Rest2 = $inschrijf->SelectLimit($query_Rest2) or die($inschrijf->ErrorMsg());
$totalRows_Rest2 = $Rest2->RecordCount();
// end Recordset


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html>
<head>
<title>Kamerindeling</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="http://www.xs4all.nl/%7Ehorringa/Pellegrina/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
</head>

<body>
<h2>Kamerindeling zomercursussen </h2>
<h2>&nbsp;</h2>
<table>
   <caption>
      Cursus 1:
   </caption>
   <tr>
      <td width="30">&nbsp;</td>
      <td width="250"><b>eenpersoons:</b></td>
      <td width="250"><b>kamperen:</b></td>
      <td width="250"><b>rest:</b></td>
   </tr>
   <tr valign="top">
      <td width="30">&nbsp;</td>
      <td width="250"><table  border="1" cellpadding="2" cellspacing="0">
         <?php
  while (!$Kamers1->EOF) {
?>
         <tr>
            <td><?php echo $Kamers1->Fields('naam'); ?></td>
         </tr>
         <?php
    $Kamers1->MoveNext(); 
  }
?>
      </table></td>
      <td width="250"><table  border="1" cellpadding="2" cellspacing="0">
         <?php
  while (!$Kampeer1->EOF) {
?>
         <tr>
            <td><?php echo $Kampeer1->Fields('naam'); ?></td>
         </tr>
         <?php
    $Kampeer1->MoveNext(); 
  }
?>
      </table></td>
      <td width="250"><table  border="1" cellpadding="2" cellspacing="0">
         <?php
  while (!$Rest1->EOF) {
?>
         <tr>
            <td><?php echo $Rest1->Fields('naam'); ?></td>
         </tr>
         <?php
    $Rest1->MoveNext(); 
  }
?>
      </table></td>
   </tr>
   <tr>
      <td width="30">&nbsp;</td>
      <td colspan="3"><p>In totaal: <?php echo ($totalRows_Kamers1 + $totalRows_Kampeer1 + $totalRows_Rest1); ?> deelnemers </p></td>
   </tr>
</table>
<p>&nbsp;</p>
<table>
   <caption>
      Cursus 2:
   </caption>
   <tr>
      <td width="30">&nbsp;</td>
      <td width="250"><b>eenpersoons:</b></td>
      <td width="250"><b>kamperen:</b></td>
      <td width="250"><b>rest:</b></td>
   </tr>
   <tr valign="top">
      <td width="30">&nbsp;</td>
      <td width="250"><table  border="1" cellpadding="2" cellspacing="0">
         <?php
  while (!$Kamers2->EOF) {
?>
         <tr>
            <td><?php echo $Kamers2->Fields('naam'); ?></td>
         </tr>
         <?php
    $Kamers2->MoveNext(); 
  }
?>
      </table></td>
      <td width="250"><table  border="1" cellpadding="2" cellspacing="0">
         <?php
  while (!$Kampeer2->EOF) {
?>
         <tr>
            <td><?php echo $Kampeer2->Fields('naam'); ?></td>
         </tr>
         <?php
    $Kampeer2->MoveNext(); 
  }
?>
      </table></td>
      <td width="250"><table  border="1" cellpadding="2" cellspacing="0">
         <?php
  while (!$Rest2->EOF) {
?>
         <tr>
            <td><?php echo $Rest2->Fields('naam'); ?></td>
         </tr>
         <?php
    $Rest2->MoveNext(); 
  }
?>
      </table></td>
   </tr>
   <tr>
      <td width="30">&nbsp;</td>
      <td colspan="3"><p>In totaal: <?php echo ($totalRows_Kamers2 + $totalRows_Kampeer2 + $totalRows_Rest2); ?> deelnemers </p></td>
   </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
$Kamers1->Close();
$Kampeer1->Close();
$Rest1->Close();
$Kamers2->Close();
$Kampeer2->Close();
$Rest2->Close();
?>
