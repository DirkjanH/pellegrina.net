<?php
//Connection statement
require_once('../connections/aanvraag.php');

//Aditional Functions
require_once('../includes/functions.inc.php');

// begin Recordset
$query_werving1 = "SELECT * FROM werving ORDER BY id ASC";
$werving1 = $werving->SelectLimit($query_werving1) or die($werving->ErrorMsg());
$totalRows_werving1 = $werving1->RecordCount();
// end Recordset

if ((isset($_POST['Wissen'])) && ($_POST['Wissen'] == "Delete")) {
  $deleteSQL = sprintf("DELETE FROM werving WHERE id=%s",
                       GetSQLValueString($_POST['Id'], "int"));

  $Result1 = $werving->Execute($deleteSQL) or die($werving->ErrorMsg());
}

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

if ((isset($_POST["Wijzigen"])) && ($_POST["Wijzigen"] == "Change")) {

	// check email:
	if (empty($_POST['email']) or !strstr($_POST['email'], "@") or !strstr($_POST['email'], ".") or strstr($_POST['email'], " "))
		{
			echo "<p class=\"waarschuwing\">The email address is not present or not correct</p>\n";
		}
	else
		{
		$_POST['email'] = strtolower($_POST['email']);
		$email_gelijk = false;
		$werving1->MoveFirst();
		while (!$werving1->EOF) {
			$email_gelijk += ((strcasecmp($werving1->Fields('email'), $_POST['email']) == 0) And ($_POST['Id'] != $werving1->Fields('id')));
			$werving1->MoveNext(); 
		}
		if ($email_gelijk) echo "<p class=\"waarschuwing\">This email address already exists!</p>\n";
		else {
		  $updateSQL = sprintf("UPDATE werving SET aanhef=%s, manvrouw=%s, taal=%s, email=%s, soort=%s, opmerkingen=%s WHERE id=%s",
									  GetSQLValueString($_POST['aanhef'], "text"),
									  GetSQLValueString($_POST['man/vrouw'], "text"),
									  GetSQLValueString($_POST['taal'], "text"),
									  GetSQLValueString($_POST['email'], "text"),
									  GetSQLValueString($_POST['soort'], "text"),
									  GetSQLValueString($_POST['opmerkingen'], "text"),
									  GetSQLValueString($_POST['Id'], "int"));
		
		  $Result1 = $werving->Execute($updateSQL) or die($werving->ErrorMsg());
		}
	}
}

if ((isset($_POST["Toevoegen"])) && ($_POST["Toevoegen"] == "Add")) {

	// check email:
	if (empty($_POST['email']) or !strstr($_POST['email'], "@") or !strstr($_POST['email'], ".") or strstr($_POST['email'], " "))
		{
			echo "<p class=\"waarschuwing\">Het emailadres is niet of niet correct ingevuld</p>\n";
		}
	else
		{
		$_POST['email'] = strtolower($_POST['email']);
		$email_gelijk = false;
		$werving1->MoveFirst();
		while (!$werving1->EOF) {
			$email_gelijk += (strcasecmp($werving1->Fields('email'), $_POST['email']) == 0);
			$werving1->MoveNext(); 
		}
		if ($email_gelijk) echo "<p class=\"waarschuwing\">Dit emailadres bestaat al!</p>\n";
		else {
			$insertSQL = sprintf("INSERT INTO werving (aanhef, manvrouw, taal, email, soort, opmerkingen) VALUES (%s, %s, %s, %s, %s, %s)",
									  GetSQLValueString($_POST['aanhef'], "text"),
									  GetSQLValueString($_POST['man/vrouw'], "text"),
									  GetSQLValueString($_POST['taal'], "text"),
									  GetSQLValueString($_POST['email'], "text"),
									  GetSQLValueString($_POST['soort'], "text"),
									  GetSQLValueString($_POST['opmerkingen'], "text"));
		
		  $Result1 = $werving->Execute($insertSQL) or die($werving->ErrorMsg());
		}
	}
}

// begin Recordset
$colname__Item = '-1';
if (isset($_POST['Id'])) {
  $colname__Item = $_POST['Id'];
}

if (isset($_POST['Leegmaken'])) {
  $colname__Item = 0;
}
$query_Item = sprintf("SELECT * FROM werving WHERE id = %s", $colname__Item);
$Item = $werving->SelectLimit($query_Item) or die($werving->ErrorMsg());
$totalRows_Item = $Item->RecordCount();
// end Recordset

// begin Recordset
$query_werving1 = "SELECT * FROM werving ORDER BY id ASC";
$werving1 = $werving->SelectLimit($query_werving1) or die($werving->ErrorMsg());
$totalRows_werving1 = $werving1->RecordCount();
// end Recordset

//PHP ADODB document - made with PHAkt 3.5.1
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html>
<head>
<title>wervings-adressen</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
caption {
	font-size: 120%;
	font-weight: bold;
}
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	background-color: #FFFFCC;
}
.klein {
	font-size: 60%;
}
.waarschuwing {
	font-size: 200%;
	line-height: 30mm;
	font-weight: bold;
	text-transform: uppercase;
	color: #FF0000;
	text-align: center;
}
-->
</style>
<script type="text/JavaScript">
<!--
function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
//-->
</script>
</head>
<body>
<?php 		$werving1->MoveFirst();
?>
<table width="90%"  border="2" align="center" cellpadding="2" cellspacing="0">
   <tr>
      <td><b>id</b></td>
      <td><b>opening</b></td>
      <td><b>male/female</b></td>
      <td><b>language</b></td>
      <td><b>email</b></td>
      <td><b>type</b></td>
      <td><b>remarks</b></td>
   </tr>
   <?php
  while (!$werving1->EOF) {
?>
   <tr>
      <td class="klein"><?php echo $werving1->Fields('id'); ?></td>
      <td class="klein"><?php echo $werving1->Fields('aanhef'); ?></td>
      <td class="klein"><?php echo $werving1->Fields('manvrouw'); ?></td>
      <td class="klein"><?php echo $werving1->Fields('taal'); ?></td>
      <td class="klein"><?php echo $werving1->Fields('email'); ?></td>
      <td class="klein"><?php echo $werving1->Fields('soort'); ?></td>
      <td class="klein"><?php echo $werving1->Fields('opmerkingen'); ?></td>
   </tr>
   <?php
    $werving1->MoveNext(); 
  }
?>
<tr><td colspan="7"><div align="center">
   Total number of entries: <?php echo $totalRows_werving1;?>
</div></td>
</tr>
</table>
<form action="<?php echo $editFormAction; ?>" method="POST" name="werving" id="werving">
   <table width="90%" border="1" align="center" cellpadding="3" cellspacing="0">
      <caption>
     Add / change / delete items:
      </caption>
      <tr>
         <td colspan="4"><div align="center">Existing item with id.: 
               <input name="Id" type="text" id="Id" value="<?php echo $Item->Fields('id'); ?>" size="5">
            <input name="find" type="submit" id="find" value="find">
         </div></td>
      </tr>
      <tr>
         <td colspan="2"><label for="aanhef">
            Opening:&nbsp;            </label>
            <input name="aanhef" type="text" id="aanhef" tabindex="1" value="<?php echo $Item->Fields('aanhef'); ?>" size="50" maxlength="50"></td>
         <td width="173" valign="top"><p>
            <label> <b>Taal:</b><br>
            <input <?php if (!(strcmp($Item->Fields('taal'),"NL"))) {echo "CHECKED";} ?> name="taal" type="radio" value="NL" checked>
               Dutch</label>
            <br>
            <label>
               <input <?php if (!(strcmp($Item->Fields('taal'),"EN"))) {echo "CHECKED";} ?> type="radio" name="taal" value="EN">
               English</label>
            <br>
            <label>
               <input <?php if (!(strcmp($Item->Fields('taal'),"DE"))) {echo "CHECKED";} ?> type="radio" name="taal" value="DE">
               German</label>
            <br>
         </p></td>
         <td width="175" valign="top"><p>
               <label><b>Geslacht:</b><br>
                  <input <?php if (!(strcmp($Item->Fields('manvrouw'),"M"))) {echo "CHECKED";} ?> name="man/vrouw" type="radio" value="M" checked>
                  Male</label>
               <br>
               <label>
                  <input <?php if (!(strcmp($Item->Fields('manvrouw'),"V"))) {echo "CHECKED";} ?> type="radio" name="man/vrouw" value="V">
                  Female</label>
               <br>
         </p></td>
      </tr>
      <tr>
         <td width="387"><label for="email">Email:&nbsp;</label>
         <input name="email" type="text" id="email" value="<?php echo $Item->Fields('email'); ?>" size="50" maxlength="50"></td>
         <td colspan="3"><label for="soort">Type:</label>
            &nbsp;
            <select name="soort" id="soort">
               <option value="zangdocent" <?php if (!(strcmp("zangdocent", $Item->Fields('soort')))) {echo "SELECTED";} ?>>singing
               tutor</option>
               <option value="koordirigent" <?php if (!(strcmp("koordirigent", $Item->Fields('soort')))) {echo "SELECTED";} ?>>choir
               conductor</option>
               <option value="koorbestuurder" <?php if (!(strcmp("koorbestuurder", $Item->Fields('soort')))) {echo "SELECTED";} ?>>choir
               administrator</option>
               <option value="orkestdirigent" <?php if (!(strcmp("orkestdirigent", $Item->Fields('soort')))) {echo "SELECTED";} ?>>orchestral
               conductor</option>
               <option value="orkestbestuurder" <?php if (!(strcmp("orkestbestuurder", $Item->Fields('soort')))) {echo "SELECTED";} ?>>orchestra
               administrator</option>
               <option value="cursusorganisator" <?php if (!(strcmp("cursusorganisator", $Item->Fields('soort')))) {echo "SELECTED";} ?>>course
               organiser</option>
               <option value="overig, zie opmerkingen" <?php if (!(strcmp("overig, zie opmerkingen", $Item->Fields('soort')))) {echo "SELECTED";} ?>>other,
               see remarks</option>
            </select>         </td>
      </tr>
      <tr>
         <td colspan="1"><label for="textfield">Remarks:&nbsp;</label></td>
         <td colspan="3"><textarea name="opmerkingen" cols="50" rows="5" id="opmerkingen"><?php echo $Item->Fields('opmerkingen'); ?></textarea></td>
      </tr>
      <tr>
         <td>            <div align="right">
            <input name="Toevoegen" type="submit" id="Toevoegen" value="Add">         
         </div></td>
         <td>            <div align="center">
            <input name="Wijzigen" type="submit" id="Wijzigen" value="Change">         
         </div></td>
         <td onClick="GP_popupConfirmMsg('Should these data really be deleted?');return document.MM_returnValue"><input name="Wissen" type="submit" id="Wissen" value="Delete"></td>
         <td><input name="Leegmaken" type="submit" id="Leegmaken" value="Reset form"></td>
      </tr>
   </table>
</form>

<p>&nbsp;</p>
</body>
</html>
<?php
$werving1->Close();

$Item->Close();
?>
