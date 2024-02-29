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
// YOU MUST INCLUDE THIS BIT OF CODE TO CHECK LOGIN AND USER LEVEL AUTHORITY
// PROTECT ANY OF YOUR PAGES BY INCLUDING THIS SECTION OF CODE AT THE VERY TOP OF YOUR PROTECTED PAGE
// IF YOU WANT TO CHANGE LEVEL AUTHORITY, INCLUDE THE APPRORIATE LEVEL CHECK PAGE
// THIS EXAMPLE IS FOR LEVEL 1 AUTHORITY (level1_check.php)

include "level2_check.php";

?>
<?php 
echo "<span class='medTextBlack'>You Login Level is :".$_SESSION['level']."<br><br></span>"; ?>
<link href='../css/login_style.css' rel='stylesheet' type='text/css'>
<p class="medTextBlack">This page will accept Level 2, 3, 4 members only.</p>
<p class="medTextBlack">Welcome to the demonstration index page #2, you are logged in. <br>
  <br>
  Click on selection here for demonstration pages -->&nbsp;<a href='index.php'>Main index page </a> ¦ <a href='adduser.php'>Add User</a> ¦ <a href='admin.php'>Admin Page</a>¦  <a href='login.php'>Log in Page</a>¦  <a href='forgot.php'>Forgot Password Page</a>¦  <a href='logout.php'>Log out Page</a><BR>
  <br>
  This page is access level 2 and above only.</p>
<p class="medTextBlack">So if you can read this your access level is 2, 3 or 4 (admin) </p>
<p>

*************************************************************************************************************************<br>
Title: 		PHP AGTC-Membership system v1.1a<br>
Developed by: Andy Greenhalgh<br>
Email:		andy@agtc.co.uk<br>
Website:		agtc.co.uk<br>
Copyright:	2005(C)Andy Greenhalgh - (AGTC) - Updated 04/06/06 <br>
Licence:		GPL, You may distribute this software under the terms of this General Public License<br>
*************************************************************************************************************************<br>
</p>
 