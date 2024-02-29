<?php //Connection statement
error_reporting( E_ALL ); 
require_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/includes/PDO_2014.php');
//include ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/login/level3_check.php'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Ophalen mailing-adressen</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
</head>
<body>
<?php // begin Recordset
foreach ($lp->query('
SELECT 
  * 
FROM
  dlnmr AS d,
  adres AS a
  LEFT JOIN zwartelijst AS z 
    ON d.DlnmrId = z.DlnmrId_FK 
WHERE z.DlnmrId_FK IS NULL 
  AND AdresId = AdresId_FK 
  AND taal LIKE "%NL%" 
  AND achternaam NOT LIKE "%XXX%" 
  AND achternaam NOT LIKE "%YYY%" 
  AND achternaam NOT LIKE "%ZZZ%" 
ORDER BY a.AdresId 
') as $dlnmr) {
	$deelnemers[] = $dlnmr;
}

$dlnmrs[0]['AdresId'] = '';
$i = 0;
	
foreach ($deelnemers as $d) {
	$current = $dlnmrs[$i];
	if ($current['AdresId'] == $d['AdresId']) {
		$current['naam'] .= ' & '.$d['naam'];
		$dlnmrs[$i] = $current;
	}
	else {
		$dlnmrs[] = $d;	
		$i++;
	}
}
// Sorteer op postcode
foreach ($dlnmrs as $key => $row) {
    $postcode[$key]  = $row['postcode'];
}
array_multisort($postcode, SORT_ASC, $dlnmrs);

echo 'Aantal adressen: '.(count($dlnmrs)-1);

foreach ($dlnmrs as $d) {
	echo '<p>';
	echo $d['naam'].' '.'<br>';
	echo $d['adres'].'<br>';
	echo $d['postcode'].' '.$d['plaats'];
	if ($d['land'] != "Nederland" AND $d['land'] != "Netherlands") echo '<br>'.strtoupper($d['land']);
	echo '</p>';
}
$lp = NULL;

?>
</body>
</html>