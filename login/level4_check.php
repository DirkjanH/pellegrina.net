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
// THIS IS THE USER LEVEL 4 ACCEPTANCE CHECK
// ADD OR INCLUDE THIS AT THE TOP OF ANY PAGES THAT ALLOW USER LEVEL 4 ACCESS 
include $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/login/config.php';

if(!isset($_COOKIE['login']['level'])){
echo"Error - You have not got authority to enter this page (ERR code: sesslev unset line 8)";		
}
if ($_COOKIE['login']['level'] != "4") {

echo"Your are not authorised to access this area - if this is incorrect please contact administration - <a href='/login/login.php'>CLICK HERE TO LOGIN</a>";
exit();
}
?>