<?php 
// stel php in dat deze fouten weergeeft
ini_set('display_errors',1 );

error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

Kint::$enabled_mode = false;

?><!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<html>
<head>
<title>Dieet/Dieta/Régime</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/pellegrina_stijlen.css" type="text/css">
<style type="text/css">
body,td,th {
	font-family: "Alegreya Sans", Verdana, sans-serif;
}
</style>
</head>
<body>
<div class="inhoud">

<?php
//Connection statement
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/includes2024.php');
/* echo '<pre>';
print_r($_GET);
echo '</pre>';
 */
$CursusId = $eerstecursus;

while ($CursusId <= $laatstecursus) {

	// begin Recordset
	$query_passagiers = "SELECT d.naam, d.dieet FROM dlnmr d, inschrijving i 
	WHERE NOT (d.naam LIKE \"%XXX%\" OR d.naam LIKE \"%YYY%\" OR d.naam LIKE \"%ZZZ%\") AND i.CursusId_FK = {$CursusId} 
	AND d.dlnmrid = i.dlnmrid_fk AND NOT (afgewezen <=> 1) AND NOT(dieet IS NULL OR dieet LIKE \"%[geen]%\" 
	OR dieet LIKE \"%none%\") ORDER BY d.achternaam ASC";
		
	$passagiers = select_query($query_passagiers);
	$totalRows_passagiers = count($passagiers);
	
	$query_Cursusnaam = "SELECT cursusnaam_en, YEAR(datum_begin) as jaar FROM cursus WHERE CursusId = {$CursusId}";
	$Cursusnaam = select_query($query_Cursusnaam, 1);
?>
<h2>Course "<?php echo $Cursusnaam['cursusnaam_en']; ?>"</h2>
<p>&nbsp;</p>
<table width="600"  border="1" cellpadding="5">
  <tr>
    <td width="40%"><strong><em>Naam/Jmeno/Nom:</em></strong></td>
      <td width="40%"><strong><em>Dieet/Dieta/Régime:</em></strong></td>
    </tr>
  <?php
	  foreach($passagiers as $passagier) {
	?>
    <tr>
      <td width="40%"><?php echo $passagier['naam']; ?>&nbsp;</td>
	      <td width="40%"><?php echo $passagier['dieet']; ?>&nbsp;</td>
    </tr>
    <?php	  } ?>
</table>
<p>&nbsp;</p>
<?php 
	$CursusId++;

	}
?>
</div>
</body>
</html>