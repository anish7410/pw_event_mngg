<?php
/////////////////////////////////////code for mail start///////////////////////////////////////////

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';
require_once __DIR__ . '/vendor/autoload.php';
$mail = new PHPMailer(true);
//Enable SMTP debugging.
$mail->SMTPDebug = 0;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password     
$mail->Username = "arazmailer@gmail.com";
$mail->Password = "obesbbjxzapfsjzq";
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";
//Set TCP port to connect to
$mail->Port = 587;
$mail->From = "arazmailer@gmail.com";
$mail->FromName = "Araz";

//////////////////////////////////////code for mail end///////////////////////////////////////////
?>