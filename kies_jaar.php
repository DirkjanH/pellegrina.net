<?php //Connection statement
require_once('../../connections/evaluatie.php');

//Aditional Functions
require_once('../../includes/functions.inc.php');

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

// Kies jaar
$evaluatie_tabel = 'evaluatie_'.date('Y');
if (isset($_GET['jaar']) AND $_GET['jaar'] != '') $evaluatie_tabel = 'evaluatie_'.$_GET['jaar'];

?>