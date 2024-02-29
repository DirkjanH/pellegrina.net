<?php 
include_once ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/includes/includes2014.php');

// echo 'joehoe<br>';

/* echo '<pre>';
print_r($_POST);
echo '</pre>';
 */

$f = strip_tags($_POST['faso']);
$order   = array("\r\n", "\n", "\r");
$f = str_replace($order, '%', $f);

// echo $f;
$faso = explode('%%', $f);
/* echo '<pre>';
print_r($faso);
echo '</pre>';
 */
?>


<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/LP algemeen NL.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">

<!-- InstanceBeginEditable name="doctitle" -->
<title>FASO ledenlijst omzetten</title>
<!-- InstanceEndEditable -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.NL.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<link href="/css/pagina_stijlen_algemeen.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_tagmanager.php'; ?>
<div id="inhoud">
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.NL.php'; ?>
  <div id="main"> <!-- InstanceBeginEditable name="mainpage" -->
  <form action="<?php echo $editFormAction; ?>" method="post" name="form">
    <p>Hier komt de FASO-ledenlijst:</p>
    <p>
  <textarea name="faso" cols="80" rows="10"><?php echo stripslashes($_POST['faso']); ?></textarea>
    </p>
    <input name="submit" type="submit" value="submit">
  </form>
<table border="1" cellpadding="10">
  <tr>
    <td>FASO-adressen:</td>
<?php 
foreach ($faso as $f) {
	$naam = strstr($f, ' - ');
	$naam = substr($naam, 3);
	$naam = strstr($naam, 'Contactpersoon:', true);
//	echo $naam.'<br>';
	$adres = strstr($f, 'Contactpersoon: ');
	$adres = substr($adres, 16);
	$adres = strstr($adres, 'Telefoon:', true);
	$adres = explode(', ', $adres);
	if (strpos($adres[0], '(')) {
		$adres[0] = substr(strstr($adres[0], '('), 1);
		$adres[0] = str_replace(')', '', $adres[0]);
	}	
	$adres[0] = str_ireplace('De heer', 'de heer', $adres[0]);
	$adres[0] = str_ireplace('Mevrouw', 'mevrouw', $adres[0]);
	$etiket = $naam.'<br>t.a.v. ';
	foreach ($adres as $a) $etiket .= $a.'<br>';
	echo '</tr><tr><td>'.$etiket.'</td>';
}
?>
  </tr>
</table>

  
  <!-- InstanceEndEditable -->
    <h2> <a href="javascript: history.go(-1)">Terug</a></h2>
    <p>&nbsp;</p>
  </div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
</body>
<!-- InstanceEnd --></html>
