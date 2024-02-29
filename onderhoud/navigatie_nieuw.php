<?php
// build the form action
$editFormAction = $_SERVER['PHP_SELF'] . (isset($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : "");

?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
</head>

<body>
<form name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table width="100%">
    <tr>
      <td><div align="center">
          <input name="button" type="button" 
				action="statistiek.php'" value="Statistieken">
      </div></td>
      <td><div align="center">
          <input type="button" value="Aanm. inschr.geld" 
				action="reminder.php'">
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
          <input name="button" type="button" 
				onClick="parent.mainFrame.location='update_wanbetalers.php'" value="Aanm. cursusgeld">
      </div></td>
      <td><input name="button" type="button" 
				onClick="parent.mainFrame.location='update_zwartelijst.php" value="Zwarte lijst"></td>
     </tr>
    <tr>
      <td><div align="center">
          <input type="button" value="Persoonlijk" 
				action="persoonlijk.php'">
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