// *************************************************************************************************
// Title: 		PHP AGTC-Membership system v1.1a
// Developed by: Andy Greenhalgh
// Email:		andy@agtc.co.uk
// Website:		agtc.co.uk
// Copyright:	2005(C)Andy Greenhalgh - (AGTC) - Updated 04/06/06
// Licence:		GPL, You may use this software under the terms of this General Public License
// *************************************************************************************************
//
## Intro:
Thanks for downloading my new version of a simple to use membership login system.
This script was designed as a stand alone script which can be easily intergrate into any existing website as it is,
but if you want to intergrate it into a site which uses a content management format, then some alterations will have to be done for
it to work properly. Remember this is a project and I am constantly working to improve it, so I can't guarantee that
it will work for everyones needs, but dammmmd close. ;-)

## Latest Updates for v1.1a (For latest updates visit www.agtc.co.uk)
Ok, as promised I have added a 'request new password' page & a 'log out' page. I've updated the .sql file which now
has the encrypted admin password in it instead of the un encrypted one, and also I have added a duplicate username & 
email address check to the adduser.php page, and loads of other stuff. See file check below to see all what has been done in v1.1a

## Updates 04/06/06
Security patch added to adduser.php, this now checks the email address entered in the useremail field
v1.1a has had a face lift and a general tidy up, some errors have been fixed, well the ones I have been told about anyway.
If you have any questions or issues with this script please goto my coders forum at http://website-scripts.co.uk/forum/Blah.pl?

Admin Username:	admin
Admin Password:	admin



## Requirements:
PHP & MYSQL database


## Features:
1. Login Page
2. Log out link
3. User level status check
4. Four different access levels (Inc Admin level)
5. Admin backend page for listing/editing/deleting records
6. Easy to add level and login check to any of your pages
7. User membership sign up page (with auto level 1 status) Now has duplicate check for user name & email address
8. Auto responder 'Thank you' email sent to your new member on signup completion
9. Mysql database setup
10. Built in password encryption

## File Check: (You should have this list of files uploaded to your server)

adduser.php			**UPDATED** NOW CHECKS FOR DUPLICATES OF USER NAME & EMAIL ADDRESS BEFORE ADDING TO DATABASE & EMAIL ADDRESS CHECK
admin.php			**UPDATED** NOW PASSWORD IS ENCRYPTED I HAVE REMOVED EDIT PASSWORD (NOT REQUIRED) - CAN ONLY CHANGE USERLEVEL NOW IN ADMIN EDIT
config.php			**AMMENDED** ADDED SITE URL TO GO WITH SEND.PHP EMAIL
dbuserdb.sql		**UPDATED** ADDED ENCRYPTED PASSWORD
forgot.php			**NEW**
index.php			**UPDATED** ADDED DEMO MENU BAR
index2.php			**NEW** ADDED DEMO LEVEL 2 PAGE
level1_check.php	**AMMENDED**
level2_check.php	**AMMENDED**
level3_check.php	**AMMENDED**
level4_check.php	**AMMENDED**
licence.txt
login.php			**UPDATED** ADDED FORGOT PASSWORD LINK
logout.php			**NEW**
readme.txt			**UPDATED**
send.php 			**UPDATED** 
style.css			**UPDATED**
images(FOLDER)		**NEW**

## Instructions:
1. Upload all files to your server
2. Upload dbuserdb.sql to PhpMyAdmin or similar
3. Edit file config.php with your details
4. Your done....

If you have any questions or issues with this script please goto my coders forum at http://website-scripts.co.uk/forum/Blah.pl?