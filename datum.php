<?php

echo $_SERVER['DOCUMENT_ROOT'].'/includes/includes2011.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/includes2011.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>datum PHP</title>
</head>
<body>
<?php

$i = '1946-08-14';
echo $i;
if (function_exists('euro2'))
    echo 'euro2 bestaat! ';
else
    echo ' niks...';

if (function_exists('safestrtotime'))
    echo 'yes!<br>';

if (empty($i) or safestrtotime('Y-m-d', $i) == '1970-01-01' or (safestrtotime('Y',
    $i) < date('Y') - 80) or (safestrtotime('Y', $i) > date('Y') - 12))
{
    $error = true;
    echo "   <li>Je geboortedatum is niet of niet correct ingevuld. Graag invullen in
			cijfers: dag-maand-jaar</li>\n";
} else
{
    $j = safestrtotime('Y-m-d', $i);
    echo 'Geboortedatum: ' . $i . '; bewerkt: ' . $j;
}

?>
</body>
</html>