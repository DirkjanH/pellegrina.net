<?php
//Connection statement
require_once('connections/inschrijf.php');

//Aditional Functions
require_once('includes/functions.inc.php');

// begin Recordset
$query_Recordset1 = "SELECT * FROM project_aanmelding, dlnmr, adres WHERE dlnmrId = dlnmrId_FK AND adresId = adresId_FK AND instrumentalist = 1 ORDER BY postcode";
$Recordset1 = $inschrijf->SelectLimit($query_Recordset1) or die($inschrijf->ErrorMsg());
$totalRows_Recordset1 = $Recordset1->RecordCount();
// end Recordset
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php //PHP ADODB document - made with PHAkt 3.7.0?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
  while (!$Recordset1->EOF) { 
?>
  <p><?php echo $Recordset1->Fields('naam'); ?>$<?php echo $Recordset1->Fields('adres'); ?>$
  <?php echo $Recordset1->Fields('postcode'); ?> <?php echo $Recordset1->Fields('plaats'); ?></p><?php
    $Recordset1->MoveNext(); 
  }
?>

</body>
</html>
<?php
$Recordset1->Close();
?>
