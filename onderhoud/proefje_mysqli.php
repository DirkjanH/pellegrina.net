<?php 
$mysqli = new mysqli('localhost', 'LP', '12dirig.', 'LP_inschrijving');

/*
 * This is the "official" OO way to do it,
 * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0.
 */
/* if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
 */
/*
 * Use this instead of $connect_error if you need to ensure
 * compatibility with PHP versions prior to 5.2.9 and 5.3.0.
 */
if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

echo "Success... {$mysqli->host_info} {$mysqli->server_info} \n";

/* Select queries return a resultset */
if ($result = $mysqli->query("SELECT * FROM dlnmrs")) {
    printf("Select returned %d rows.\n", $result->num_rows);
}
echo $mysqli->info;

$mysqli->close();
?><!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP.dwt.php" codeOutsideHTMLIsLocked="false" -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
   <link rel="stylesheet" href="/css/pagina_stijlen.css" type="text/css">

<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>proefje met Mysqli</title>
<!-- InstanceEndEditable -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
</head>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_tagmanager.php'; ?>
<div class="inhoud">
  <div id="main"> 
  <!-- InstanceBeginEditable name="mainpage" -->
<h2>Proefje met mysqli</h2>
<!-- InstanceEndEditable --> 
  </div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
</body>
<!-- InstanceEnd --></html>
