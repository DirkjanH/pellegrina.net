<?php // stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);

error_reporting(E_ALL);

require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2019.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');

Kint::$enabled_mode = false;

$id = $_GET['id'];
$gdpr = $_GET['gdpr'];

if (isset($gdpr) AND $gdpr != 1) $gdpr = '0';

$query = "UPDATE dlnmr SET gdpr = {$gdpr} WHERE DlnmrId = {$id}";
d($query);

if (isset($id) AND $id != '') exec_query($query);

?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<!doctype html>
<title>Update GDPR</title>
</head>

<body>
</body>
</html>