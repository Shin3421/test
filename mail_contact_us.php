<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


    $mail = new PHPMailer(true);

    try {

   $mail->SMTP;
   $mail->Host = 'bom1plzcpnl493875.prod.bom1.secureserver.net';
   $mail->SMTPAuth = true;
   $mail->Username = 'budzlaundryhub1@budzlaundry.com'; //managbanagdosal@gmail.com  // email cpanel ncOagy75@TWQ // app password pkzsfpvbfgromswd
   $mail->Password = 'd6zvWjD]P3+l';
   $mail->SMTPSecure = 'tls';
   $mail->Port= 465;    
   // $mail->addReplyTo()

   // receiver 
   $mail->setFrom($_POST['c_email']);
   $mail->addAddress('gensanbudzlaundry@gmail.com');

   // content html 
   $mail->isHTML(true);
$mail->Subject = 'Queries';
   $mail->Body = $_POST['c_message'];

    $mail->send();
    $_SESSION['success_alert'] = "Message has been sent successfully";
    header("Location: contacts.php");
    exit(0);
       
   } catch (Exception $e) {
    $_SESSION['error_alert'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}
    ";
    header("Location: contacts.php");
    exit(0);
   }

?>