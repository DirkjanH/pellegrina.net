<?php
// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php //PHP ADODB document - made with PHAkt 3.5.1?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="content-script-type" CONTENT="text/javascript">

<title>navigatie</title>
<link href="/css/w3.css" rel="stylesheet" type="text/css">
<link href="/css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	padding: 5px 0px 0px 0px;
}
-->
</style>
</head>

<body>
<form name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table width="100%">
    <tr>
      <td><div align="center">
          <input name="button" type="button" 
				onClick="parent.mainFrame.location='update_statistiek.php'" value="Statistieken">
      </div></td>
      <td><div align="center">
          <input type="button" value="Aanm. inschr.geld" 
				onClick="parent.mainFrame.location='update_reminder.php'">
      </div></td>
      <td><div align="center">
          <input type="button" value="Bezettingen" 
				onClick="parent.mainFrame.location='update_bezettingen.php'">
      </div></td>
      <td><div align="center">
          <input type="button" value="Herhaling" 
				onClick="parent.mainFrame.location='update_herhaling.php'">
      </div></td>
      <td><div align="center">
          <input name="button4" type="button" 
				onClick="parent.mainFrame.location='update_wanbetalers.php'" value="Aanm. cursusgeld">
      </div></td>
      <td><input name="button2" type="button" 
				onClick="parent.mainFrame.location='update_zwartelijst.php'" value="Zwarte lijst"></td>
     </tr>
    <tr>
      <td><div align="center">
          <input type="button" value="Persoonlijk" 
				onClick="parent.mainFrame.location='update_persoonlijk.php'">
      </div></td>
      <td><div align="center">
          <input type="button" value="Inschrijving" 
				onClick="parent.mainFrame.location='update_inschrijving.php'">
      </div></td>
      <td><div align="center">
          <INPUT TYPE="button" VALUE="Voorl. bevestiging" 
				onClick="parent.mainFrame.location='update_financieel.php'">
      </div></td>
      <td><div align="center">
          <INPUT TYPE="button" VALUE="Rekening" 
				onClick="parent.mainFrame.location='update_rekening.php'">
      </div></td>
      <td><div align="center">
          <input name="button5" type="button" 
				onClick="parent.mainFrame.location='update_betaling.php'" value="Betaling">
       </div></td>
      <td><div align="center"></div></td>
     </tr>
  </table>
</form>
</body>
</html>