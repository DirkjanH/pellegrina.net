<?php
$file = "blank.gif";
	
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header("Content-Type: image/gif");
	 header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
}
	else echo('File bestaat niet!<br>');

// stel php in dat deze fouten weergeeft
ini_set('display_errors',1);

error_reporting(E_ALL);
//echo $_GET['kenmerk'].'<br>';

require_once $_SERVER["DOCUMENT_ROOT"].'/connections/connect_PDO.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/functies.php');

if (isset($_GET['kenmerk']) AND $_GET['kenmerk'] != '') {
	$query1 = <<<QUE
	SELECT
	  mailadresId
	FROM
	  mailing_adressen
	WHERE kenmerk = '{$_GET['kenmerk']}'
	  AND tijd_geopend IS NULL;
QUE;
	$mailadresId = select_query($query1, 0);
	//var_dump($query1);
	//var_dump($mailadresId);
	if (isset($mailadresId) AND $mailadresId != NULL) {
		$query2 = <<<QUE
		UPDATE
		  mailing_adressen
		SET
		  tijd_geopend = NOW()
		WHERE mailadresId = {$mailadresId};
QUE;
		exec_query($query2);
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>volg gebruiker</title>
</head>
<body>
</body>
</html>