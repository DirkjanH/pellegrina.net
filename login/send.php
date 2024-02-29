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
include "config.php";

// DO NOT EDIT BELOW THIS LINE, UNLESS YOU KNOW WHAT YOU ARE DOING
if ($username == "" or $userpass == "" or $useremail == ""){$msg3=true;}

$email = $useremail; 
if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", $email)) {
   $msg4 = true; $pass = "no"; }
if (!isset($useremail)) 
echo "Error, Please re-send $username" ; 

$todayis = date("l, F j, Y, g:i a") ;

$subject = "You are now a registered member - Please login";

$message = " $todayis [EST] \n

From: $sendersName \n
\n
You are now registered as a member you can now login \n
This email was sent by an auto responder, you cannot reply to this email.

";

$from = "From: $sendersEmail";

if ($email != "") 
mail($email, $subject, $message, $from);

?>