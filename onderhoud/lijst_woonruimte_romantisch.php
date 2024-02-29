<?php //Connection statement
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2024.php');
$cursus = 4; 

// begin Recordset
$query_woonruimte = "SELECT naam, particulier, acc_wens, eenpersoons, kamperen, CursusId_FK FROM inschrijving, dlnmr WHERE dlnmrid = dlnmrid_fk AND naam NOT LIKE \"%XXX%\" AND aangenomen = 1 AND CursusId_FK = {$cursus} order by cursusid_fk, achternaam";
$woonruimte = $inschrijf->SelectLimit($query_woonruimte) or die($inschrijf->ErrorMsg());
$totalRows_woonruimte = $woonruimte->RecordCount();
// end Recordset
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.7.1?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Woonruimte</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<table  border="1" cellpadding="4">
  <tr>
    <td>Nr:</td>
    <td>Naam:</td>
    <td>Accommodatie wens:</td>
    <td>Eenp.:</td>
    <td>Kamp.:</td>
    <td>Part.:</td>
  </tr>
  <?php
  while (!$woonruimte->EOF) {
?>
    <tr>
      <td><?php echo $woonruimte->Fields('CursusId_FK'); ?></td>
      <td><?php echo $woonruimte->Fields('naam'); ?></td>
      <td><?php echo $woonruimte->Fields('acc_wens'); ?></td>
      <td><?php if ($woonruimte->Fields('eenpersoons') != "0") echo $woonruimte->Fields('eenpersoons'); ?></td>
      <td><?php if ($woonruimte->Fields('kamperen') != "0") echo $woonruimte->Fields('kamperen'); ?></td>
      <td><?php if ($woonruimte->Fields('hotel_2pp') != "0") echo $woonruimte->Fields('hotel_2pp'); ?></td>
    </tr>
    <?php
    $woonruimte->MoveNext(); 
  }
?>
</table>
</body>
</html>
<?php
$woonruimte->Close();
?>
