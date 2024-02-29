<?php
//Connection statement
require_once('../connections/inschrijf.php');

//Aditional Functions
require_once('../includes/functions.inc.php');

//Stel utf8 (uitgebreide character set) in:
mysql_query("SET NAMES UTF8");

// begin Recordset
$query_Cursus1 = "SELECT `d`.`naam`, `a`.`adres`, CONCAT(`a`.`postcode`, \" \", `a`.`plaats`, IF(`a`.`land` IS NOT NULL AND `a`.`land` NOT IN (\"Netherlands\", \"Nederland\") , CONCAT(\", \", `a`.`land`), \"\")) as \"PC + plaats\", d.telefoon, d.mobiel, d.email, `i`.`instrumenten`, `i`.`zangstem`, `i`.`vervoer` FROM dlnmr d, adres a, inschrijving i, cursus c WHERE (c.Cursusnr = \"0601\" AND d.adresid_FK = a.adresid AND d.inschrid = i.dlnmrid_fk AND i.cursusid_fk = c.cursusid) AND aangenomen = 1 ORDER BY `d`.`achternaam` ASC";
$Cursus1 = $t_inschrijf->SelectLimit($query_Cursus1) or die($t_inschrijf->ErrorMsg());
$totalRows_Cursus1 = $Cursus1->RecordCount();
// end Recordset

// begin Recordset
$query_Cursus2 = "SELECT `d`.`naam`, `a`.`adres`, `a`.`Postcode`, `a`.`Plaats`, `a`.`land`, d.telefoon, d.mobiel, d.email, `i`.`instrumenten`, `i`.`vervoer` FROM dlnmr d, adres a, inschrijving i, cursus c WHERE (c.Cursusnr = \"0602\" AND d.adresid_FK = a.adresid AND d.inschrid = i.dlnmrid_fk AND i.cursusid_fk = c.cursusid) AND aangenomen = 1 ORDER BY `d`.`achternaam` ASC";
$Cursus2 = $t_inschrijf->SelectLimit($query_Cursus2) or die($t_inschrijf->ErrorMsg());
$totalRows_Cursus2 = $Cursus2->RecordCount();
// end Recordset

// begin Recordset
$query_cursus1 = "SELECT * FROM cursus WHERE cursusnr LIKE \"0601\"";
$cursus1 = $t_inschrijf->SelectLimit($query_cursus1) or die($t_inschrijf->ErrorMsg());
$totalRows_cursus1 = $cursus1->RecordCount();
// end Recordset

// begin Recordset
$query_cursus2 = "SELECT * FROM cursus WHERE cursusnr LIKE \"0602\"";
$cursus2 = $t_inschrijf->SelectLimit($query_cursus2) or die($t_inschrijf->ErrorMsg());
$totalRows_cursus2 = $cursus2->RecordCount();
// end Recordset

// begin Recordset
$query_Docenten1 = "SELECT * FROM cursusdocenten AS cd, docenten AS d WHERE cd.CursusId_FK=1 AND cd.DocId_FK = d.DocId ORDER BY d.achternaam";
$Docenten1 = $t_inschrijf->SelectLimit($query_Docenten1) or die($t_inschrijf->ErrorMsg());
$totalRows_Docenten1 = $Docenten1->RecordCount();
// end Recordset

// begin Recordset
$query_Docenten2 = "SELECT * FROM cursusdocenten AS cd, docenten AS d WHERE cd.CursusId_FK=2 AND cd.DocId_FK = d.DocId ORDER BY d.achternaam";
$Docenten2 = $t_inschrijf->SelectLimit($query_Docenten2) or die($t_inschrijf->ErrorMsg());
$totalRows_Docenten2 = $Docenten2->RecordCount();
// end Recordset

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html>
<head>
<title>Deelnemerslijsten</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
</head>

<body>
<h2>Course 1, <?php echo $cursus1->Fields('cursusnaam_en'); ?> (<?php echo $totalRows_Cursus1;?> participants):</h2>
<br>
<table  border="1" cellpadding="2" cellspacing="0">
   <tr>
      <td><div align="left"><i>Name:</i></div></td>
      <td><div align="left"><i>Address:</i></div></td>
      <td><div align="left"><i>City:</i></div></td>
      <td><div align="left"><i>Telephone:</i></div></td>
      <td><div align="left"><i>Mobile:</i></div></td>
      <td><div align="left"><i>E-mail:</i></div></td>
      <td><div align="left"><i>Instruments:</i></div></td>
      <td><div align="left"><i>Singing voice: </i></div></td>
      <td><div align="left"><i>Transport:</i></div></td>
   </tr>
   <?php
  while (!$Cursus1->EOF) {
if ($Cursus1->Fields('toehoorder')) $instr = "auditor"; else $instr = $Cursus1->Fields('instrumenten');  
?>
   <tr>
      <td class="klein"><div align="left"><?php echo $Cursus1->Fields('naam'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus1->Fields('adres'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus1->Fields('PC + plaats'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus1->Fields('telefoon'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus1->Fields('mobiel'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus1->Fields('email'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $instr; ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus1->Fields('zangstem'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus1->Fields('vervoer'); ?></div></td>
   </tr>
   <?php
    $Cursus1->MoveNext(); 
  }
?>
</table>
<h2>Tutors<b> course 1:</b></h2>
<br>
<table  border="1" cellpadding="2" cellspacing="0">
   <tr>
      <td><div align="left"><i>Name:</i></div></td>
      <td><div align="left"><i>Address:</i></div></td>
      <td><div align="left"><i>PC:</i></div></td>
      <td><div align="left"><i>City:</i></div></td>
      <td><div align="left"><i>Country:</i></div></td>
      <td><div align="left"><i>Telephone:</i></div></td>
      <td><div align="left"><i>Mobile:</i></div></td>
      <td><div align="left"><i>Email:</i></div></td>
      <td><div align="left"><i>Subject:</i></div></td>
   </tr>
   <?php
  while (!$Docenten1->EOF) {
?>
      <tr>
         <td class="klein"><div align="left"><?php echo $Docenten1->Fields('naam'); ?></div></td>
         <td class="klein"><div align="left"><?php echo $Docenten1->Fields('adres'); ?></div></td>
         <td class="klein"><div align="left"><?php echo $Docenten1->Fields('PC'); ?></div></td>
         <td class="klein"><div align="left"><?php echo $Docenten1->Fields('plaats'); ?></div></td>
         <td class="klein"><div align="left"><?php echo $Docenten1->Fields('land'); ?></div></td>
         <td class="klein"><div align="left"><?php echo $Docenten1->Fields('telefoon'); ?></div></td>
         <td class="klein"><div align="left"><?php echo $Docenten1->Fields('mobiel'); ?></div></td>
         <td class="klein"><div align="left"><?php echo $Docenten1->Fields('email'); ?></div></td>
         <td class="klein"><div align="left"><?php echo $Docenten1->Fields('vak'); ?></div></td>
      </tr>
      <?php
    $Docenten1->MoveNext(); 
  }
?>
</table>
<br>
<h2>Course 2, <?php echo $cursus2->Fields('cursusnaam_en'); ?> (<?php echo $totalRows_Cursus2;?> participants):</h2>
<br>
<table  border="1" cellpadding="2" cellspacing="0">
   <tr>
      <td><div align="left"><i>Name:</i></div></td>
      <td><div align="left"><i>Address:</i></div></td>
      <td><div align="left"><i>Postal code:</i></div></td>
      <td><div align="left"><i>City:</i></div></td>
      <td><div align="left"><i>Country:</i></div></td>
      <td><div align="left"><i>Telephone:</i></div></td>
      <td><div align="left"><i>Mobile:</i></div></td>
      <td><div align="left"><i>E-mail:</i></div></td>
      <td><div align="left"><i>Instruments:</i></div></td>
      <td><div align="left"><i>Transport:</i></div></td>
   </tr>
   <?php
  while (!$Cursus2->EOF) {
if ($Cursus2->Fields('toehoorder')) $instr = "auditor"; else $instr = $Cursus2->Fields('instrumenten');  
?>
   <tr>
      <td class="klein"><div align="left"><?php echo $Cursus2->Fields('naam'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus2->Fields('adres'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus2->Fields('Postcode'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus2->Fields('Plaats'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus2->Fields('land'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus2->Fields('telefoon'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus2->Fields('mobiel'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus2->Fields('email'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $instr; ?></div></td>
      <td class="klein"><div align="left"><?php echo $Cursus2->Fields('vervoer'); ?></div></td>
   </tr>
   <?php
    $Cursus2->MoveNext(); 
  }
?>
</table>
<h2>Tutors<b> course 2:</b></h2>
<br>
<table  border="1" cellpadding="2" cellspacing="0">
   <tr>
      <td><div align="left"><i>Name:</i></div></td>
      <td><div align="left"><i>Address:</i></div></td>
      <td><div align="left"><i>PC:</i></div></td>
      <td><div align="left"><i>City:</i></div></td>
      <td><div align="left"><i>Country:</i></div></td>
      <td><div align="left"><i>Telephone:</i></div></td>
      <td><div align="left"><i>Mobile:</i></div></td>
      <td><div align="left"><i>Email:</i></div></td>
      <td><div align="left"><i>Subject:</i></div></td>
   </tr>
   <?php
  while (!$Docenten2->EOF) {
?>
   <tr>
      <td class="klein"><div align="left"><?php echo $Docenten2->Fields('naam'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Docenten2->Fields('adres'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Docenten2->Fields('PC'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Docenten2->Fields('plaats'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Docenten2->Fields('land'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Docenten2->Fields('telefoon'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Docenten2->Fields('mobiel'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Docenten2->Fields('email'); ?></div></td>
      <td class="klein"><div align="left"><?php echo $Docenten2->Fields('vak'); ?></div></td>
   </tr>
   <?php
    $Docenten2->MoveNext(); 
  }
?>
</table>
</body>
</html>
<?php
$Cursus1->Close();

$Cursus2->Close();

$cursus1->Close();

$cursus2->Close();

$Docenten1->Close();

$Docenten2->Close();
?>
