<?php
// *************************************************************************************************
// Title: 		PHP AGTC-Membership system v1.1a
// Developed by: Andy Greenhalgh
// Email:		andy@agtc.co.uk
// Website:		agtc.co.uk
// Copyright:	2005(C)Andy Greenhalgh - (AGTC)
// Licence:		GPL, You may distribute this software under the terms of this General Public License
// *************************************************************************************************
//

// SIMPLE LOG OUT OF SESSION
if ($_POST['submit'] == "Yes") {
			
			$_COOKIE['loginok'] = "logout"; // NOT USED YET
			$_COOKIE['level'] = "0"; // CHANGE SESSION LEVEL TO '0'
					header("Location: index.php"); // DIRECTED TO INDEX, YOU WILL BE REFUSED ACCESS NOW
} else if ($_POST['submit'] == "No"){   // ELSE WE SEND BACK TO INDEX PAGE STILL LOGGED IN
header("Location: index.php");
} 
?>
<!-- LOG OUT FORM -->
<html>
<head>
<title>Logout</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/login_style.css" rel="stylesheet" type="text/css">
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
</head>

<body>
<form name="form1" method="post" action="">
  <table class="table" width="35%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000">
    <tr bgcolor="#000000"> 
      <td colspan="2"><div align="center"><font color="#FC9801" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>LOG OUT </strong></font></div></td>
    </tr>
    <tr> 
      <td><div align="center">Are you sure you want to log out ?<br><br>
        <input type="submit" name="submit" value="Yes">&nbsp;
		<input type="submit" name="submit" value="No">
      </div></td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
</body>
</html>
