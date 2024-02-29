<?php 
//	haal navigatie op
if ($opening_inschrijving > date('c')) {
// 	echo 'voor actiedatum<br>';
	if ($taal == "NL") $nav_text_file = $_SERVER['DOCUMENT_ROOT'].'/includes/navigatie.tijdelijk.NL.php';
	else $nav_text_file = $_SERVER['DOCUMENT_ROOT'].'/includes/navigatie.tijdelijk.EN.php';
}
else {
// 	echo 'op of na actiedatum<br>';
	if ($taal == "NL") $nav_text_file = $_SERVER['DOCUMENT_ROOT'].'/includes/navigatie.NL.php';
	else $nav_text_file = $_SERVER['DOCUMENT_ROOT'].'/includes/navigatie.EN.php';
}
// echo '$nav_text_file: '.$nav_text_file.'; date_c: '.date('c').'; $opening_inschrijving: '.$opening_inschrijving.'<br>';
$fh = fopen($nav_text_file, 'r');
$navigatie = fread($fh, filesize($nav_text_file));
fclose($fh);
// echo 'plaats_kort: '.$cursusdata['plaats_kort'].'<br>';
$navigatie = str_replace("{cursus}", $cursusdata['cursusnaam'], $navigatie);
$navigatie = str_replace("{locatie}", $cursusdata['plaats_kort'], $navigatie);
?>