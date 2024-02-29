<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>test random</title>
</head>

<body>
<?php
require_once $_SERVER["CONTEXT_DOCUMENT_ROOT"].'/vendor/autoload.php';

d($_FILES, $_SERVER);
	
echo $string = bin2hex(random_bytes(8));	
	
d($string);
	
?>
	
</body>
</html>