<?php //Connection statement
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2024.php');
$query_Cursus = "SELECT InschId, naam, instr, instrumenten, zangstem FROM inschrijving, dlnmr WHERE DlnmrId_FK = DlnmrId and instr IS NOT NULL ORDER BY InschId";
	
	$Cursus = $inschrijf->SelectLimit($query_Cursus) or die($inschrijf->ErrorMsg());
	$totalRows_Cursus= $Cursus->RecordCount();

while (!$Cursus->EOF) {
	$ins = explode(', ', $Cursus->Fields('instr'));
	unset($instr);
	$zangstem = '';
	foreach ($ins as $in) {
		if ($in < 100) $zangstem = $in;
		elseif ($in >= 400 and $in < 500) $zangstem = $in - 400;
		elseif ($in == 500) $instr[] = $in;
		else $instr[] = $in;
		}
	$instr = implode(', ', $instr);

echo "Naam: {$Cursus->Fields('naam')}; Zangstem: {$zangstem}; Instrumenten: {$instr}<br>";

  	$updateSQL = sprintf("UPDATE inschrijving SET instrumenten=%s, zangstem=%s WHERE InschId=%s",
					   GetSQLValueString($instr, "text"),
                       GetSQLValueString($zangstem, "text"),
                       GetSQLValueString($Cursus->Fields('InschId'), "int"));

  	$Result1 = $inschrijf->Execute($updateSQL) or die($inschrijf->ErrorMsg());

echo $updateSQL.'<br>';

    $Cursus->MoveNext(); 
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>
&nbsp;
</body>
</html>
