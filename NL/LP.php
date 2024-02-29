<?php 
//	echo dirname(__FILE__);
	$filenaam = explode('/', str_replace('/var', '', dirname(__FILE__)));
//Add filename without file extension
	$filenaam[7] = basename(__FILE__,".php");	
//	print_r($filenaam);	
   switch ($filenaam[6])  {
		case 'romantic': $cursus = 1;
		break;
		case 'baroque':  $cursus = 2;
		break;
	}
//	echo 'Cursus is: '.$cursus.'<br>';
	$taal = $filenaam[5];
//	echo 'taal is: '.$taal.'<br>';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/cursusdata.php'; ?>

<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP.dwt.php" codeOutsideHTMLIsLocked="false" -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
   <link rel="stylesheet" href="/css/pagina_stijlen.css" type="text/css">

<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Over La Pellegrina</title>

<!-- InstanceEndEditable -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
</head>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_tagmanager.php'; ?>
<div class="inhoud">
  <div id="main"> 
  <!-- InstanceBeginEditable name="mainpage" -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/NL/over_pellegrina.php'; ?>
    <!-- InstanceEndEditable --> 
  </div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
</body>
<!-- InstanceEnd --></html>
