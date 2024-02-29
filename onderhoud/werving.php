<?php
//Connection statement
require_once('../connections/aanvraag.php');

include "../login/level3_check.php";

//Aditional Functions
require_once('../includes/functions.inc.php');

// begin Recordset
$query_aanvraag1 = "SELECT * FROM aanvraag ORDER BY id ASC";
$aanvraag1 = $aanvraag->SelectLimit($query_aanvraag1) or die($aanvraag->ErrorMsg());
$totalRows_aanvraag1 = $aanvraag1->RecordCount();
// end Recordset

if ((isset($_POST['Wissen'])) && ($_POST['Wissen'] == "Wissen")) {
  $deleteSQL = sprintf("DELETE FROM aanvraag WHERE id=%s",
                       GetSQLValueString($_POST['Id'], "int"));

  $Result1 = $aanvraag->Execute($deleteSQL) or die($aanvraag->ErrorMsg());
}

// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

if ((isset($_POST["Wijzigen"])) && ($_POST["Wijzigen"] == "Wijzigen")) {

	// check email:
	if (empty($_POST['email']) or !strstr($_POST['email'], "@") or !strstr($_POST['email'], ".") or strstr($_POST['email'], " "))
		{
			echo "<p class=\"waarschuwing\">Het emailadres is niet of niet correct ingevuld</p>\n";
		}
	else
		{
		$_POST['email'] = strtolower($_POST['email']);
		$email_gelijk = false;
		$aanvraag1->MoveFirst();
		while (!$aanvraag1->EOF) {
			$email_gelijk += ((strcasecmp($aanvraag1->Fields('email'), $_POST['email']) == 0) And ($_POST['Id'] != $aanvraag1->Fields('id')));
			$aanvraag1->MoveNext(); 
		}
		if ($email_gelijk) echo "<p class=\"waarschuwing\">Dit emailadres bestaat al!</p>\n";
		else {
		  $updateSQL = sprintf("UPDATE aanvraag SET aanhef=%s, manvrouw=%s, taal=%s, email=%s, soort=%s, opmerkingen=%s WHERE id=%s",
									  GetSQLValueString($_POST['aanhef'], "text"),
									  GetSQLValueString($_POST['man/vrouw'], "text"),
									  GetSQLValueString($_POST['taal'], "text"),
									  GetSQLValueString($_POST['email'], "text"),
									  GetSQLValueString($_POST['soort'], "text"),
									  GetSQLValueString($_POST['opmerkingen'], "text"),
									  GetSQLValueString($_POST['Id'], "int"));
		
		  $Result1 = $aanvraag->Execute($updateSQL) or die($aanvraag->ErrorMsg());
		}
	}
}

if ((isset($_POST["Toevoegen"])) && ($_POST["Toevoegen"] == "Toevoegen")) {

	// check email:
	if (empty($_POST['email']) or !strstr($_POST['email'], "@") or !strstr($_POST['email'], ".") or strstr($_POST['email'], " "))
		{
			echo "<p class=\"waarschuwing\">Het emailadres is niet of niet correct ingevuld</p>\n";
		}
	else
		{
		$_POST['email'] = strtolower($_POST['email']);
		$email_gelijk = false;
		$aanvraag1->MoveFirst();
		while (!$aanvraag1->EOF) {
			$email_gelijk += (strcasecmp($aanvraag1->Fields('email'), $_POST['email']) == 0);
			$aanvraag1->MoveNext(); 
		}
		if ($email_gelijk) echo "<p class=\"waarschuwing\">Dit emailadres bestaat al!</p>\n";
		else {
			$insertSQL = sprintf("INSERT INTO aanvraag (aanhef, manvrouw, taal, email, soort, opmerkingen) VALUES (%s, %s, %s, %s, %s, %s)",
									  GetSQLValueString($_POST['aanhef'], "text"),
									  GetSQLValueString($_POST['man/vrouw'], "text"),
									  GetSQLValueString($_POST['taal'], "text"),
									  GetSQLValueString($_POST['email'], "text"),
									  GetSQLValueString($_POST['soort'], "text"),
									  GetSQLValueString($_POST['opmerkingen'], "text"));
		
		  $Result1 = $aanvraag->Execute($insertSQL) or die($aanvraag->ErrorMsg());
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
$query_Item = sprintf("SELECT * FROM aanvraag WHERE id = %s", $colname__Item);
$Item = $aanvraag->SelectLimit($query_Item) or die($aanvraag->ErrorMsg());
$totalRows_Item = $Item->RecordCount();
// end Recordset

// begin Recordset
$query_aanvraag1 = "SELECT * FROM aanvraag ORDER BY id ASC";
$aanvraag1 = $aanvraag->SelectLimit($query_aanvraag1) or die($aanvraag->ErrorMsg());
$totalRows_aanvraag1 = $aanvraag1->RecordCount();
// end Recordset

//PHP ADODB document - made with PHAkt 3.5.1
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html>
<head>
<title>aanvraags-adressen</title>
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
<?php 		$aanvraag1->MoveFirst();
?>
<table width="90%"  border="2" align="center" cellpadding="2" cellspacing="0">
   <tr>
      <td><b>id</b></td>
      <td><b>aanhef</b></td>
      <td><b>man/vrouw</b></td>
      <td><b>taal</b></td>
      <td><b>email</b></td>
      <td><b>soort</b></td>
      <td><b>opmerkingen</b></td>
   </tr>
   <?php
  while (!$aanvraag1->EOF) {
?>
   <tr>
      <td class="klein"><?php echo $aanvraag1->Fields('id'); ?></td>
      <td class="klein"><?php echo $aanvraag1->Fields('aanhef'); ?></td>
      <td class="klein"><?php echo $aanvraag1->Fields('manvrouw'); ?></td>
      <td class="klein"><?php echo $aanvraag1->Fields('taal'); ?></td>
      <td class="klein"><?php echo $aanvraag1->Fields('email'); ?></td>
      <td class="klein"><?php echo $aanvraag1->Fields('soort'); ?></td>
      <td class="klein"><?php echo $aanvraag1->Fields('opmerkingen'); ?></td>
   </tr>
   <?php
    $aanvraag1->MoveNext(); 
  }
?>
<tr><td colspan="7"><div align="center">
   Het totale aantal regels is: <?php echo $totalRows_aanvraag1;?>
</div></td>
</tr>
</table>
<form action="<?php echo $editFormAction; ?>" method="POST" name="aanvraag" id="aanvraag">
   <table width="90%" border="1" align="center" cellpadding="3" cellspacing="0">
      <caption>
     Items toevoegen/wijzigen/deleten:
     </caption>
      <tr>
         <td colspan="4"><div align="center">Bestaand item met id.: 
            <input name="Id" type="text" id="Id" value="<?php echo $Item->Fields('id'); ?>" size="5">
            <input name="zoek" type="submit" id="zoek" value="zoek">
         </div></td>
      </tr>
      <tr>
         <td colspan="2"><label for="aanhef">
            Aanhef:&nbsp;            </label>
            <input name="aanhef" type="text" id="aanhef" tabindex="1" value="<?php echo $Item->Fields('aanhef'); ?>" size="50" maxlength="50"></td>
         <td width="173" valign="top"><p>
            <label> <b>Taal:</b><br>
            <input <?php if (!(strcmp($Item->Fields('taal'),"NL"))) {echo "CHECKED";} ?> name="taal" type="radio" value="NL" checked>
               Nederlands</label>
            <br>
            <label>
               <input <?php if (!(strcmp($Item->Fields('taal'),"EN"))) {echo "CHECKED";} ?> type="radio" name="taal" value="EN">
               Engels</label>
            <br>
            <label>
               <input <?php if (!(strcmp($Item->Fields('taal'),"DE"))) {echo "CHECKED";} ?> type="radio" name="taal" value="DE">
               Duits</label>
            <br>
         </p></td>
         <td width="175" valign="top"><p>
               <label><b>Geslacht:</b><br>
                  <input <?php if (!(strcmp($Item->Fields('manvrouw'),"M"))) {echo "CHECKED";} ?> name="man/vrouw" type="radio" value="M" checked>
                  Man</label>
               <br>
               <label>
                  <input <?php if (!(strcmp($Item->Fields('manvrouw'),"V"))) {echo "CHECKED";} ?> type="radio" name="man/vrouw" value="V">
                  Vrouw</label>
               <br>
         </p></td>
      </tr>
      <tr>
         <td width="387"><label for="email">Email:&nbsp;</label>
         <input name="email" type="text" id="email" value="<?php echo $Item->Fields('email'); ?>" size="50" maxlength="50"></td>
         <td colspan="3"><label for="soort">Soort:</label>
            &nbsp;
            <select name="soort" id="soort">
               <option value="zangdocent" <?php if (!(strcmp("zangdocent", $Item->Fields('soort')))) {echo "SELECTED";} ?>>zangdocent</option>
               <option value="koordirigent" <?php if (!(strcmp("koordirigent", $Item->Fields('soort')))) {echo "SELECTED";} ?>>koordirigent</option>
               <option value="koorbestuurder" <?php if (!(strcmp("koorbestuurder", $Item->Fields('soort')))) {echo "SELECTED";} ?>>koorbestuurder</option>
               <option value="orkestdirigent" <?php if (!(strcmp("orkestdirigent", $Item->Fields('soort')))) {echo "SELECTED";} ?>>orkestdirigent</option>
               <option value="orkestbestuurder" <?php if (!(strcmp("orkestbestuurder", $Item->Fields('soort')))) {echo "SELECTED";} ?>>orkestbestuurder</option>
               <option value="cursusorganisator" <?php if (!(strcmp("cursusorganisator", $Item->Fields('soort')))) {echo "SELECTED";} ?>>cursusorganisator</option>
               <option value="overig" <?php if (!(strcmp("overig", $Item->Fields('soort')))) {echo "SELECTED";} ?>>overig, zie opmerkingen</option>
            </select>         </td>
      </tr>
      <tr>
         <td colspan="1"><label for="textfield">Opmerkingen:&nbsp;</label></td>
         <td colspan="3"><textarea name="opmerkingen" cols="50" rows="5" id="opmerkingen"><?php echo $Item->Fields('opmerkingen'); ?></textarea></td>
      </tr>
      <tr>
         <td>            <div align="right">
            <input name="Toevoegen" type="submit" id="Toevoegen" value="Toevoegen">         
         </div></td>
         <td>            <div align="center">
            <input name="Wijzigen" type="submit" id="Wijzigen" value="Wijzigen">         
         </div></td>
         <td onClick="GP_popupConfirmMsg('Moeten deze gegevens werkelijk gewist worden?');return document.MM_returnValue"><input name="Wissen" type="submit" id="Wissen" value="Wissen"></td>
         <td><input name="Leegmaken" type="submit" id="Leegmaken" value="Leegmaken"></td>
      </tr>
   </table>
</form>

<p>&nbsp;</p>
</body>
</html>
<?php
$aanvraag1->Close();

$Item->Close();
?>
