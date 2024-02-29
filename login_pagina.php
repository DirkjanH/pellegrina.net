<?php 
// stel php in dat deze fouten weergeeft
ini_set('display_errors', 1);

error_reporting(E_ALL);

ob_start();

require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');

Kint::$enabled_mode = false;

$password = array("czech", "budweis", "sion");
$username[1] = 'baroque';
$username[2] = 'romantic';

d($_POST, $password);

$taal = $_POST['taal'];
$cursusnaam = $_POST['cursusnaam'];
$_POST['username'] = strtolower($_POST['username']);

echo array_search($_POST['password'], $password);

if ($_POST['username'] != '' AND array_search($_POST['username'], $username) AND $_POST['password'] != '' AND in_array($_POST['password'], $password)) {
	switch ($_POST['username']) {

		case $username[1]:
			$h = "Location: /downloads/course_{$_POST['username']}.php";
			header($h);
			break;
		case $username[2]:
			$h = "Location: /downloads/course_{$_POST['username']}.php";
			header($h);
			break;
	}		
}
else {
	$h = "Location: /{$taal}/login_fout.php";
	header($h);
}

ob_end_flush(); ?>
