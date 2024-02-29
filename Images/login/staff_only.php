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
include("config.php");

/* echo '<pre>';
print_r($_COOKIE);
echo '</pre>';
 */
$msg = "";

if (isset($_POST['Submit']))
{
	
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
	$result = mysql_query("Select * From login_table where user_name='$username'",$con);
	
	if(mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_array($result, MYSQL_BOTH);
		if($password == $row["user_pass"])
		{
			$jaar = time()+(3600*24*7*52);
			
			setcookie('login[loginok]', "ok", $jaar, '/');
			setcookie('login[username]', "username", $jaar, '/');
			setcookie('login[password]', "password", $jaar, '/');
			setcookie('login[level]', $row["user_level"], $jaar, '/');

			header("Location: ../onderhoud/formation.php");

		}
		else
		{
			$msg = "Password incorrect";
		}
	}
	else
	{
		$msg = "Username incorrect";
    }

}
?>

<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/login_style.css" rel="stylesheet" type="text/css">
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
</head>

<body>
<p align="center" class="nadruk">Please enter your username and password to login</p>
<form name="form1" method="post" action="">
  <p align="center"><?php echo "<font color='red'>$msg</font>" ?></p>
  <table class="table" width="35%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000">
    <tr bgcolor="#000000"> 
      <td colspan="2"><div align="center"><font color="#FC9801" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>LOGIN</strong></font></div></td>
    </tr>
    <tr> 
      <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Username:&nbsp; </font></div></td>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="username" type="text" id="username" width="200">
        </font></td>
    </tr>
    <tr> 
      <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Password:&nbsp; </font></div></td>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="password" type="password" id="password" width="200">
        </font></td>
    </tr>
    <tr> 
      <td><a href="http://www.agtc.co.uk" target="_blank"><font color="#ffffff">http://www.agtc.co.uk</font></a></td>
      <td><div align="center">
        <input type="submit" name="Submit" value="Submit">
      </div></td>
    </tr>
  </table>
<p align="center" class="smallErrorText"><a href="forgot.php">Forgot Password ? </a></p>
</form>
<p>&nbsp; </p>
</body>
</html>
