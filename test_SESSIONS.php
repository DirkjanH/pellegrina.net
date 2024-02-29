<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>test $_SESSIONS</title>
</head>

<body>
<?php //Connection statement
include_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/includes/includes2017.php');
require_once $_SERVER["CONTEXT_DOCUMENT_ROOT"].'/vendor/autoload.php';

// stel php in dat deze fouten weergeeft
ini_set('display_errors',1);

error_reporting(E_ALL);

session_name('pellegrina');
session_start();
	
Kint::dump($_POST, $_SESSION);

?>

</body>
</html>