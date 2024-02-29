<?php
//Connection statement
require_once('../connections/inschrijf.php');

include "../login/level3_check.php";

//Aditional Functions
require_once('../includes/functions.inc.php');

//Stel utf8 (uitgebreide character set) in:
mysql_query("SET NAMES UTF8");

// begin Recordset
$query_instr = "SELECT id, en FROM instr ORDER BY id ASC";
$instr = $inschrijf->SelectLimit($query_instr) or die($inschrijf->ErrorMsg());
$totalRows_instr = $instr->RecordCount();
// end Recordset

// begin Recordset
$query_inschrijving = "SELECT InschId, instrumenten, zangstem, toehoorder FROM inschrijving WHERE CursusId_FK > 2 ORDER BY InschId ASC";
$inschrijving = $inschrijf->SelectLimit($query_inschrijving) or die($inschrijf->ErrorMsg());
$totalRows_inschrijving = $inschrijving->RecordCount();
// end Recordset

while (!$instr->EOF) { 
	$instrument[$instr->Fields('en')] = $instr->Fields('id');
    $instr->MoveNext(); 
  }

while (!$inschrijving->EOF) { 
	$instrumenten = explode(', ', $inschrijving->Fields('instrumenten'));
	foreach($instrumenten as $index => $ins) {
		$instrumenten[$index] = $instrument[$ins];
		}	
	$instrumenten = implode($instrumenten, ', ');
	if ($inschrijving->Fields('zangstem') != "") {
		if ($instrumenten != "")
			$instrumenten .= ', ';
		$instrumenten .= $instrument[$inschrijving->Fields('zangstem')];
	}
	if ($instrumenten == "" AND $inschrijving->Fields('toehoorder')) $instrumenten = '500';
	$updateSQL = sprintf("UPDATE inschrijving SET instr=%s WHERE InschId=%s",
                       GetSQLValueString($instrumenten, "text"),
                       GetSQLValueString($inschrijving->Fields('InschId'), "int"));

  $Result1 = $inschrijf->Execute($updateSQL) or die($inschrijf->ErrorMsg());
echo '<pre>';
echo "<br>Inschrijving nr. {$inschrijving->Fields('InschId')}:<br>";
print_r($instrumenten);
echo '</pre>';

    $inschrijving->MoveNext(); 
  }



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.7.1?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Zet instrument</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css" />
</head>
<body>
</body>
</html>
<?php
$instr->Close();

$inschrijving->Close();
?>
