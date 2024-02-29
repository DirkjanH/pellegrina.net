<?php 
if ($opening_inschrijving > date('c')) {
//	echo 'voor of op actiedatum<br>';
	if ($_POST['taal'] == "NL") $mail_text_file = $_SERVER['DOCUMENT_ROOT'].'/includes/navigatie.tijdelijk.NL.txt';
	else $mail_text_file = $_SERVER['DOCUMENT_ROOT'].'/includes/navigatie.tijdelijk.EN.txt';
}
else {
//	haal navigatie op
	if ($_POST['taal'] == "NL") $nav_text_file = $_SERVER['DOCUMENT_ROOT'].'/includes/navigatie.NL.txt';
	else $nav_text_file = $_SERVER['DOCUMENT_ROOT'].'/includes/navigatie.EN.txt';
}
$fh = fopen($nav_text_file, 'r');
$navigatie = fread($fh, filesize($nav_text_file));
fclose($fh);
$navigatie = str_replace("{cursus}", $cursuskort, $navigatie);
?>