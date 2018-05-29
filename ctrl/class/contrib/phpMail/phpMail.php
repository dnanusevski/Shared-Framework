<?php
namespace contrib\phpMail;

use PHPMailer\PHPMailer\PHPMailer ;//as contrib\phpMail\src
use PHPMailer\PHPMailer\Exception ;//as contrib\phpMail\src

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

class phpMail{
	public $mail;
	/*
	* Constructor for phpMailer taken from GIHT HUB
	* Modified for dentarc 
	* COnstructor sets neccecery data for testing
	*/
	function __construct(){
		$this->mail = new PHPMailer(true);                              				// Passing `true` enables exceptions
		try {
			date_default_timezone_set('Etc/UTC');
			//Server settings
			//$this->mail->SMTPDebug = 2;                                				// Enable verbose debug output
			$this->mail->isSMTP();                                      				// Set mailer to use SMTP
			$this->mail->Host = MAIL_HOST;  					  					// Specify main and backup SMTP servers
			$this->mail->SMTPAuth = true;                               				// Enable SMTP authentication
			$this->mail->Username = MAIL_USERNAME;    	// SMTP username
			$this->mail->Password = MAIL_PASSWORD;                           			// SMTP password
			$this->mail->SMTPSecure = 'tls';                            				// Enable TLS encryption, `ssl` also accepted
			$this->mail->Port = 587;     //25 465 587                               	// TCP port to connect to
			
			
		} catch (Exception $e) {
			echo 'Error';
			echo 'Mailer Error: ' . $this->mail->ErrorInfo;
		}
	}
	
	// to attach a file in mail, needs to be set before mail is sent
	function attach_file($file){
		if(file_exists ($file)){
			$this->mail->addAttachment($file);
		}
	}
	
	/*
	* Send mail with possible options
	
	* $options['name'] = 'Name of the recipient';
	* $options['replay_to'] = Mail to repaly to 'support@dentarc.com';
	* $options['replay_name'] =NAme of the person to replay to 'Milos replaj';
	* $options['from_mail'] = mail of sender - in most cases noreplay@dentarc.com;
	* $options['from_name'] = name of persont that sent mail - usualy Dentarc support;
	*/
	
	function send_mail($subject,$body,$to,$options=[]){
		try {
			date_default_timezone_set('Etc/UTC');
			
			//if we have option from_mail and from_name
			if(isset($options['from_mail']) AND isset($options['from_name'])){
				if($options['from_mail'] != '' AND $options['from_name'] != '')
					$this->mail->setFrom($options['from_mail'], $options['from_name']);
			}
			else $this->mail->setFrom('noreaply@dentarc.com', 'Dentarc support');
			
			
			if(isset($options['name']) AND $options['name'] != '')
				$this->mail->addAddress($to, $options['name']);
			else
				$this->mail->addAddress($to);		
			
			
			if(isset($options['replay_to']) AND $options['replay_to']!=''){
				if(isset($options['replay_name'])){
					if($options['replay_to'] != '' AND $options['replay_name'] != '')
						$this->mail->addReplyTo($options['replay_to'], $options['replay_name']);
				}
				else 
					$this->mail->addReplyTo($options['replay_to']);
			}


			//Content
			$this->mail->isHTML(true);       // Set email format to HTML
			$this->mail->Subject = $subject;
			$this->mail->Body    = $body;
			if(isset($options['alt_body']) AND $options['alt_body']!='')
				$this->mail->AltBody = $alt_body;

			$this->mail->send();
			return true;
		} catch (phpmailerException $e) {
		  echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
		  echo $e->getMessage(); //Boring error messages from anything else!
		}
	}
}