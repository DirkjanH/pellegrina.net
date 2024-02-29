<?php 
//Load composer's autoloader
require $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class LPmailer extends PHPMailer {

	//Enable SMTP debugging. 
	var $SMTPDebug = 0;
	var $Debugoutput = 'html';	
	var $Mailer = "smtp";         	// set mailer to use SMTP
	var $Host = "pellegrina.net";  	// specify main and backup server
	var $SMTPOptions = array (
        'ssl' => array(
            'verify_peer'  => false,
            'verify_peer_name'  => false,
            'allow_self_signed' => true));
	var $SMTPAuth = true;     		// turn on SMTP authentication
	var $Username = "dirkjan@pellegrina.net";                 
	var $Password = "Dirigent12.";                           
	//If SMTP requires TLS encryption then set it
	var $SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                          
	//Set TLS port to connect to 
	var $Port = 587;

	var $Body =	"html";                   	// set email format to HTML
	var $From = "info@pellegrina.net";
	var $FromName = "La Pellegrina";
	var $CharSet = "UTF-8";
	var $Timeout = 300;
}
?>
