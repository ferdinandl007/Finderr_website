<?php

// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
// error_reporting(-1);

session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/*
 * ------------------------------------
 * Contact Form Configuration
 * ------------------------------------
 */ 
$to    = "info@finderr.cf"; // <--- Your email ID here
$to1   = "ferdinand@finderr.cf";
$to2   = "ck@finderr.cf";
$to3   = "choonkiat.lee@gmail.com";

/*
 * ------------------------------------
 * END CONFIGURATION
 * ------------------------------------
 */
 
$name  = $_REQUEST["name"];
$email = $_REQUEST["email"];
$subject = $_REQUEST["subject"];
$msg   = $_REQUEST["message"];

$website = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
$website = dirname($website);
$website = dirname($website);

if (isset($email) && isset($name)) {


		$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= "From: ckl41@srcf.net"."\r\n"."Reply-To: ".$email."\r\n" ;
$msg     = "Hello,<br/><br/> You have received a message from your website contact form. Here are the details. <br/><br/> From: $name<br/> Email: $email <br/>Message: $msg <br><br> -- <br>This e-mail was sent from a contact form on $website";
	
//    $mail =  mail($to, $subject, $msg, $headers);
//    $mail =  mail($to1, $subject, $msg, $headers);
//    $mail =  mail($to2, $subject, $msg, $headers);
//    $mail =  mail($to3, $subject, $msg, $headers);
//   	if($mail)
// 	{
// 		echo 'success';
// 	}

// 	else
// 	{
// 		echo 'failed';
// 	}

	$server_email = "ckl41@srcf.net";
	$server_name = "Finderr Contact Form";

	// Send mail using PHP Mailer

	require 'PHPMailerNew/src/PHPMailer.php';
	require 'PHPMailerNew/src/SMTP.php';
	require 'PHPMailerNew/src/Exception.php';

	//require 'phpmailer/PHPMailerAutoload.php';

	//Create a new PHPMailer instance
	$mail = new PHPMailer(true);

	include './passwords.php';

	//Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    //$mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.srcf.net';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'ckl41@srcf.net';                     // SMTP username
    $mail->Password   = $SMTP_SERVER_PW;                               // SMTP password (included from passwords.php)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above




	//Set who the message is to be sent from
	$mail->setFrom($server_email, $server_name);
	//Set an alternative reply-to address
	$mail->addReplyTo($email, $name);
	//Set who the message is to be sent to
	$mail->addAddress($to);
	$mail->addAddress($to1);
	$mail->addAddress($to2);
	$mail->addAddress($to3);

	//Set the HTML True
	$mail->isHTML(true);

	$mail->Subject = $subject;
	$mail->Body = $msg;

	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "success";
	}

	$fp = fopen('/home/ckl41/contact_form.txt', 'a');
	fwrite($fp, 'From: '.$email.'\t\t'.$msg);
	fclose($fp);

	// $command = escapeshellcmd('./send_email.py '.$msg);
	// $output = shell_exec($command);
	// echo $output;

	// $_SESSION['success_msg'] =  "Submit Successful!"; 
	// header("Location: ../index.html");
	exit(); 

}

?>