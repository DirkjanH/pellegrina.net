<?php 
	$HOSTNAME = 'localhost';
	$DATABASE = 'mysql:pellegrina_db';
	$DBTYPE   = preg_replace('/:.*$/', '', $DATABASE);
	$DATABASE = preg_replace('/^[^:]*?:/', '', $DATABASE);
	$USERNAME = 'pellegrina_lp';
	$PASSWORD = '12dirig.';
	$LOCALE = 'En';
	$MSGLOCALE = 'En';	
	$CTYPE = 'P';
	$KT_locale = $MSGLOCALE;
	$KT_dlocale = $LOCALE;
	$KT_serverFormat = '%Y-%m-%d %H:%M:%S';
	$QUB_Caching = 'false';

	$KT_localFormat = $KT_serverFormat;
	
$mysqli = new mysqli("localhost", $USERNAME, $PASSWORD, $DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* change character set to utf8 */
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
//    printf("Current character set: %s\n", $mysqli->character_set_name());
}
?>