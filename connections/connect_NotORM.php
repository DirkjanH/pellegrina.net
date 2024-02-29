<?php include_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/includes/NotORM.php";
error_reporting( E_ALL ); 

	$HOSTNAME = 'localhost';
	$DATABASE = 'LP_inschrijving';
	$USERNAME = 'LP';
	$PASSWORD = '12dirig.';

// echo "mysql:dbname=$DATABASE";

try {
    $pdo = new PDO("mysql:host=localhost;dbname=$DATABASE", $USERNAME, $PASSWORD);
	$lp = new NotORM($pdo);
    $lp->exec("SET CHARACTER SET utf8");
    $lp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// zet de localiteit op Nederland
setlocale(LC_ALL, 'nl_NL');
date_default_timezone_set('Europe/Amsterdam');

?>