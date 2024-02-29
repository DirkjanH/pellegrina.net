<?php 
require $_SERVER["CONTEXT_DOCUMENT_ROOT"].'/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

class LPmailer extends PHPMailer {

	//Enable SMTP debugging. 
	var $SMTPDebug = 0;
	var $Debugoutput = 'html';	
	var $Mailer = "smtp";         			// set mailer to use SMTP
	var $Host = "smtp.gmail.com";  			// specify main and backup server
	var $SMTPAuth = true;     				// turn on SMTP authentication
	var $Username = "dhorringa@gmail.com";                 
	var $Password = "12Dirigent.";                           
	//If SMTP requires TLS encryption then set it
	var $SMTPSecure = "tls";                           
	//Set TCP port to connect to 
	var $Port = 587;

	var $Body =	"html";                     // set email format to HTML
	var $From = "info@pellegrina.net";
	var $FromName = "La Pellegrina";
	var $CharSet = "utf-8";
	var $Timeout = 300;
	//var $AddAttachment("/var/tmp/file.tar.gz");         // add attachments
	//var $AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
}
?>
