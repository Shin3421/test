<?php
session_start();
include('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


function send_password_reset($get_email, $token) {

    try{

        $mail = new PHPMailer(true); 
        $mail->SMTP;                
        $mail->Host       = 'bom1plzcpnl493875.prod.bom1.secureserver.net';                 
        $mail->SMTPAuth   = true;                                  
        $mail->Username   = 'budzlaundryhub1@budzlaundry.com';                         
        $mail->Password   = 'd6zvWjD]P3+l';                                   
        $mail->SMTPSecure = 'tls';                                 
        $mail->Port       = 465;                                
    
        //Recipients
        $mail->setFrom('budzlaundryhub1@budzlaundry.com');
        $mail->addAddress($get_email);  
        
        
        // content html 
        $mail->isHTML(true); 
        $mail->Subject      = 'Reset Password Link';
        $email_template     = "<h2>Hey Budz!</h2> <h3>You're receiving this email because we received a password reset request for your account.</h3>
        <br/><br/><a style='background-color: cyan; padding:8px 18px; text-decoration: none; border-radius: 8px; font-weight: 700; color: #980799; margin-bottom: 10px;' href='budzlaundry.com/changed-password.php?token=$token&email=$get_email'>Click To Change Password</a>
        ";
        $mail->Body         = $email_template;
         if($mail->send()) {
            $_SESSION['success_alert'] = "Email change password link has been sent successfully";
          } 
          else 
          {
            $_SESSION['error_alert'] = "Mailer Error: " . $mail->ErrorInfo;
       }
    } catch(Exception $e) {
        $_SESSION['error_alert'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
     //Server settings

}


if(isset($_POST['password_reset_link'])){

    $email = mysqli_real_escape_string($db, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM user_table WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($db, $check_email);

    if(mysqli_num_rows($check_email_run) > 0) {
        $row = mysqli_fetch_array($check_email_run);
        $get_email = $row['email'];

        $update_token = "UPDATE user_table SET vkey='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($db, $update_token);

        if($update_token_run) {

            send_password_reset($get_email, $token);
            $_SESSION['status'] = "Something went wrong!";
            header("Location: password-reset.php");
            exit(0);
        } else {
            $_SESSION['status'] = "Something went wrong!";
            header("Location: password-reset.php");
            exit(0);
        }
    }
    else {
        $_SESSION['status'] = "No Email Found";
        header("Location: password-reset.php");
        exit(0);
    }
} else {

}

if(isset($_POST['password_update'])) {

    $email = mysqli_real_escape_string($db, $_POST['email']);
    $new_password = mysqli_real_escape_string($db, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);

    $token = mysqli_real_escape_string($db, $_POST['password_token']);


    if(!empty($token))
    {
        if(!empty($email) && !empty($new_password) && !empty($confirm_password))
        {
            $check_token = "SELECT vkey FROM user_table WHERE vkey='$token' LIMIT 1";
            $check_token_run = mysqli_query($db, $check_token);

            if(mysqli_num_rows($check_token_run) > 0)
            {
                if($new_password == $confirm_password)
                {
                    $update_password = "UPDATE user_table SET password='$new_password' WHERE vkey='$token' LIMIT 1";
                    $update_passwor_run = mysqli_query($db, $update_password);

                    if($update_passwor_run)
                    {
                        $_SESSION['success_alert'] = "New Password Successfully Updated!";
                        header("Location: login.php");
                        exit(0);  
                    }
                    else
                    {
                        $_SESSION['error_alert'] = "Did not update password. Something wrong!";
                        header("Location: changed-password.php?token=$token&email=$email");
                        exit(0);  
                    }
                }
                else
                {
                    $_SESSION['error_alert'] = "Password and Confirm Password does not match";
                    header("Location: changed-password.php?token=$token&email=$email");
                    exit(0);  
                }
            }
            else
            {
                $_SESSION['error_alert'] = "Invalid Token";
                header("Location: changed-password.php?token=$token&email=$email");
                exit(0);  
            }
        }
        else
        {
            $_SESSION['error_alert'] = "All Filed Are Mandatory!";
            header("Location: changed-password.php?token=$token&email=  $email");
            exit(0);  
        }
    }
    else
    {
        $_SESSION['error_alert'] = "No Token Available";
        header("Location: password-reset.php");
        exit(0); 
    }
}

?>