<?php 
require $_SERVER["CONTEXT_DOCUMENT_ROOT"].'/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

class LPmailer extends PHPMailer {

	var $SMTPDebug 		= 0;
	var $Debugoutput 	= 'html';	
	var $Mailer 		= 'smtp';         		// set mailer to use SMTP
	var $SMTPAuth   	= false;                // enable SMTP authentication
	var $SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
		);
	var $CharSet 		= 'UTF-8';
	var $Host       	= "server93.hosting2go.nl"; // sets the SMTP server
	var $Port       	= 25;                    // set the SMTP port
	var $From 			= "info@pellegrina.net";
	var $FromName 		= "La Pellegrina";

// Replace the default error_handler
    function error_handler($msg) {
        print("LP mailer fout");
        print("Beschrijving: ");
        printf("%s", $msg);
        exit;
    }}
?>
