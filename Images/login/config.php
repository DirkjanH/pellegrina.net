<?php
// *************************************************************************************************
// Title: 			PHP AGTC-Membership system v1.1a
// Developed by: 	Andy Greenhalgh
// Email:			andy@agtc.co.uk
// Website:			agtc.co.uk
// Copyright:		2005(C)Andy Greenhalgh - (AGTC) - Updated 04/06/06
// Licence:			GPL, You may distribute this software under the terms of this General Public License
// *************************************************************************************************
// 
// PLEASE AMEND THE CODE BELOW WITH YOUR DETAILS FOR YOUR SERVERS DATABASE
$localhost = "localhost"; // YOUR LOCAL HOST, USUALLY localhost
$dbuser = "LP"; // YOUR DATABASE USERNAME
$dbpass = "12dirig."; // YOUR DATABASE PASSWORD
$dbtable = "LP_inschrijving";// THE NAME OF YOUR DATABASE , THIS SHOULD HAVE BEEN SET WHEN YOU INSTALLED dbuserdb.sql, SO YOU CAN LEAVE THIS

// PLEASE AMEND THE CODE BELOW WITH YOUR URL & FOLDER DETAILS
$site_url = "http://www.pellegrina.net"; // CHANGE THIS TO YOUR OWN WEBSITE URL Ie.(http://www.mysite.com)
$site_folder = "../login/"; // WHERE YOUR AGTC CLICK COUNTER FOLDER IS (/myfolder/membershipscript/)
$sendersName = "La Pellegrina"; // 
// YOU DO NOT NEED TO EDIT BELOW THIS LINE
$con = mysql_connect("$localhost","$dbuser","$dbpass")

        or die("Error Could not connect");

$db = mysql_select_db("$dbtable", $con)
		or die("Error Could not select database");
?>