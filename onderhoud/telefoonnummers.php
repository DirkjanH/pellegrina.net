<?php //Connection statement
require_once('../connections/inschrijf_oud.php');

//Aditional Functions
require_once('../includes/functions.inc.php');

// begin Recordset
$colname__Recordset1 = '-1';
if (isset($_GET['InschId'])) {
  $colname__Recordset1 = $_GET['InschId'];
}
$query_Recordset1 = sprintf("SELECT * FROM inschrijvingen WHERE InschId = %s", $colname__Recordset1);
$Recordset1 = $inschrijf->SelectLimit($query_Recordset1) or die($inschrijf->ErrorMsg());
$totalRows_Recordset1 = $Recordset1->RecordCount();
// end Recordset

if (isset($_POST['telefoon']) and $_POST['telefoon'] !== "") $tel = $_POST['telefoon'];
if (isset($_POST['mobiel']) and $_POST['mobiel'] !== "") $mobiel = $_POST['mobiel'];
if (isset($_POST['email']) and $_POST['email'] !== "") $email = $_POST['email'];
if (isset($_POST['land']) and $_POST['land'] !== "") $land = $_POST['land'];

// echo "Tel = $tel, mobiel = $mobiel, email = $email.<br>";

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

if ((isset($_POST["bewerk"])) && ($_POST["bewerk"] == "bewerk")) {
	if (isset($_POST['telefoon']) and stristr($_POST['telefoon'], "+") === false) $tel = '+31 (' . ltrim($_POST['telefoon'], '0');
	$oud = array("-", " ", ".", "/");
	$tel = str_replace("-", ") ", $tel);
	if (!strpos($tel, ") ")) $tel = substr_replace($tel, ") ", strpos($tel, " ", 5), 1);
	if (isset($_POST['mobiel']) and $_POST['mobiel'] !== "" and stristr($_POST['mobiel'], "+") === false) {
		$mobiel = '+31' . ltrim($_POST['mobiel'], '0');
		$mobiel = str_replace($oud, "", $mobiel);
		$mobiel = chunk_split($mobiel, 3, " ");
		}
}
// echo "Na Bewerking: Tel = $tel, mobiel = $mobiel, email = $email.<br>";

if ((isset($_POST["bewaar"])) && ($_POST["bewaar"] == "bewaar")) {

//echo "Na drukken op Bewaar: Tel = $tel, mobiel = $mobiel, email = $email.<br>";

  $updateSQL = sprintf("UPDATE inschrijvingen SET telefoon=%s, mobiel=%s, email=%s, land=%s WHERE InschId=%s",
                       GetSQLValueString($_POST['telefoon'], "text"),
                       GetSQLValueString($_POST['mobiel'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['land'], "text"),
                       GetSQLValueString($_GET['InschId'], "int"));

  $Result1 = $inschrijf->Execute($updateSQL) or die($inschrijf->ErrorMsg());
}

?>

<!DOCTYPE HTML>
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html><!-- InstanceBegin template="/Templates/LP.dwt.php" codeOutsideHTMLIsLocked="false" -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">

   <!-- CSS: -->
   <link rel="stylesheet" href="/css/pellegrina_stijlen.css" type="text/css">
   <link rel="stylesheet" href="/css/pagina_stijlen.css" type="text/css">

<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.EN.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
</head>
<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_tagmanager.php'; ?>
<div class="inhoud">
  <div id="main"> 
  <!-- InstanceBeginEditable name="mainpage" -->
<form id="zoek" name="zoek" method="get" action="<?php echo $editFormAction; ?>">
   Id:
   <input name="InschId" type="text" value="<?php if (isset($_GET['InschId'])) echo $_GET['InschId']; ?>" size="5" />
   <input type="submit" name="Submit" value="Zoek">
</form>
<form method="POST" id="form1" action="<?php echo $editFormAction; ?>">
   <table align="left">
      <tr valign="baseline">
         <td nowrap align="right">Naam </td>
         <td><?php echo $Recordset1->Fields('naam'); ?></td>
      </tr>
      <tr valign="baseline">
         <td nowrap align="right">Telefoon:</td>
         <td><input type="text" name="telefoon" value="<?php if (!isset($tel)) echo $Recordset1->Fields('telefoon'); else echo $tel;
?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
         <td nowrap align="right">Mobiel:</td>
         <td><input type="text" name="mobiel" value="<?php if (!isset($mobiel)) echo $Recordset1->Fields('mobiel'); else echo $mobiel; ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
         <td nowrap align="right">Email:</td>
         <td><input type="text" name="email" value="<?php if (!isset($email)) echo $Recordset1->Fields('email'); else echo $email; ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
         <td nowrap align="right">Land:</td>
         <td><input name="land" type="text" value="<?php if (!isset($land)) echo $Recordset1->Fields('land'); else echo $land; ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
         <td nowrap align="right"><input name="bewerk" type="submit" id="bewerk" value="bewerk" /></td>
         <td><input name="bewaar" type="submit" id="bewaar" value="bewaar" /></td>
      </tr>
   </table>
</form>
<!-- InstanceEndEditable --> 
  </div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
</body>
<!-- InstanceEnd --></html>
<?php
$Recordset1->Close();
?>