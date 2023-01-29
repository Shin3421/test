<?php

session_start();
include('connection.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// require 'vendor/autoload.php';



$TimeZone = new DateTime();
$TimeZone->setTimezone(new DateTimeZone('Asia/Manila'));
$AsiaTime = $TimeZone->format('Y-m-d h:i:s');


//register

if(isset($_POST['register_btn']))
{
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $password= mysqli_real_escape_string($db, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($db, $_POST['cpassword']);

    if($password == $confirm_password)
    {
        $checkemail = "SELECT email FROM user_table WHERE email='$email'";
        $checkemail_run = mysqli_query($db, $checkemail);

        if(mysqli_num_rows($checkemail_run) > 0)
        {
            $_SESSION['error_alert'] = "Email Already Exists";
            header("Location: register.php");
            exit(0);
        }
        else
        {
            $vkey = md5(time().$email);

            $user_query= "INSERT INTO user_table (fname,lname,number,email,address,password, created_at, vkey) VALUES ('$fname','$lname','$number','$email','$address','$password' ,'$AsiaTime', '$vkey')";
            $user_query_run = mysqli_query($db, $user_query);
            
            $mail = new PHPMailer(true);
            
            if($user_query_run){ 

                try {
                     //server settings
               
                $mail->SMTP;
                $mail->Host = 'bom1plzcpnl493875.prod.bom1.secureserver.net';
                $mail->SMTPAuth = true;
                $mail->Username = 'budzlaundryhub1@budzlaundry.com'; //managbanagdosal@gmail.com  // email cpanel ncOagy75@TWQ // app password pkzsfpvbfgromswd
                $mail->Password = 'd6zvWjD]P3+l';
                $mail->SMTPSecure = 'tls';
                $mail->Port= 465;    
                // $mail->addReplyTo()
            
                // receiver 
                $mail->setFrom('budzlaundryhub1@budzlaundry.com');
                $mail->addAddress($email);

                // content html 
                $mail->isHTML(true);
                $mail->Subject = 'Email Verification';
                $mail->Body = 'Here is the verification link <b><a style="background-color: cyan; padding:8px 18px; text-decoration: none; border-radius: 8px; font-weight: 700; color: #980799; margin-bottom: 10px;" href="budzlaundry.com/verification.php?vkey='.$vkey.'">budzlaundry.com/verification.php?vkey='.$vkey.'</a></b>';
               

             if($mail->send()) {
            $_SESSION['success_alert'] = "Message has been sent successfully";
          } else {
            $_SESSION['error_alert'] = "Mailer Error: " . $mail->ErrorInfo;
       }
                    
                } catch (Exception $e) {
                    $_SESSION['error_alert'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
               
            }

            if($user_query_run)
            {
                $_SESSION['success_alert'] = "Registered Successfully, Please verify your email address!";
                header("Location: login.php");
                exit(0);
            }

            else
            {
                $_SESSION['error_alert'] = "Something went wrong";
                header("Location: register.php");
                exit(0);
            }
        }

    }
    else
    {
        $_SESSION['error_alert'] = "Password and Confirm Password does not match!";
        header("Location: register.php");
        exit(0);
    }
}
else
{  
     $_SESSION['error_alert'] = "Something went wrong";
    header("Location: register.php");
    exit(0);
}

?>








