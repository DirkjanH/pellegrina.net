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

include "level1_check.php";

?>
<?php 
echo "<span class='medTextBlack'>You Login Level is :".$_COOKIE['level']."<br><br></span>"; ?>
<link href='../css/login_style.css' rel='stylesheet' type='text/css'>
<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #FF9900}
.style3 {color: #FF0000}
-->
</style>
<p class="medTextBlack">This page will accept all levels.</p>
<p class="medTextBlack">Welcome to the demonstration index page #1, you are logged in. <br>
  <br>
  Click on selection here for demonstration pages -->&nbsp;<a href='adduser.php'>Add User Page</a>  <a href='admin.php'>Admin Page</a>  <a href='forgot.php'>Forgot Password Page</a>  <a href='index2.php'>Level 2 access only page</a> <a href='login.php'>Log in Page</a>  <a href='forgot.php'>Forgot Password Page</a>  <a href='logout.php'>Log out Page</a><BR>
  <br>
  REMEMBER: If your using this on your server, change the config.php file with your details or it will not work properly.<br>
  </p>
<p class="medTextBlack">Lets play ! .. Click on 'Add User' sign up as a member then logout, try login back in with your new username and password, you will automatically be set to user level 1.</p>
<p class="medTextBlack">Now try clicking on 'Level 2 Access only page' , you are not authorised..!!</p>
<p class="medTextBlack">Log back out and login as admin using 'admin' 'admin' as both username and password, then go to Admin Page' and change your user level to 2, then try login back in again using you member login. Try accessing 'Level 2 access only page', you will see this time your allow access. </p>
<p class="medTextBlack">&nbsp;</p>
<p class="medTextBlack">Add this code to the top of your protected pages, changing the level as required..</p>
<p class="medTextBlack style1">&lt;?php include &quot;level1_check.php&quot;; ?&gt; // Change the level to 1,2,3 or 4 , 4 being admin only </p>
<p class="medTextBlack">&nbsp;</p>
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
 