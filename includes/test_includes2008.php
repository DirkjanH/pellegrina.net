<?php //Connection statement
require_once('../connections/t_inschrijf.php');

//Aditional Functions
require_once('../includes/functions.inc.php');

//Stel utf8 (uitgebreide character set) in:
mysql_query("SET NAMES UTF8");

// zet de localiteit op Nederland
setlocale (LC_ALL, 'nl_NL');

function euro($bedrag) {
	return '&euro;&nbsp;' . number_format($bedrag, 0, ',', '.');
}

// constanten:
$aantal_cursussen = 4;
$cursus_offset = 6;
$eerstecursus = $cursus_offset + 1;
$laatstecursus = $cursus_offset + $aantal_cursussen;
$jaar = 2008;

session_start();

// build the form action
$_SERVER['QUERY_STRING'] .= strip_tags(SID);
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

?>