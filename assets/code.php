<?php

session_start();

include('../connection.php');

$TimeZone = new DateTime();
$TimeZone->setTimezone(new DateTimeZone('Asia/Manila'));
$AsiaTime = $TimeZone->format('Y-m-d h:i:s');

$n=7;
function getRef($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
};
//user edit profile
if(isset($_POST['update_profile']))
{

    $user_id = $_POST['user_id'];
    $fname= $_POST['fname'];
    $lname= $_POST['lname'];
    $number= $_POST['number'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $query = "UPDATE user_table SET fname='$fname', lname='$lname',number='$number', email='$email',address='$address'
                WHERE user_id ='$user_id' ";
    $query_run = mysqli_query($db, $query);
    
    if($query_run)
    {
        $_SESSION['success_alert'] = "Updated Successfully";
        header("Location: ../user/profile.php");
        exit(0);
    }
}

//user edit password
if(isset($_POST['update_password']))
{
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];
    $user_id = $_POST['user_id'];

    $checkpassword = "SELECT * FROM user_table WHERE user_id='$user_id' AND password='$current_pass'";
    $checkpassword_run = mysqli_query($db,$checkpassword);
    
    if(mysqli_num_rows($checkpassword_run)>0)
    {

        if($new_pass == $confirm_pass)
        {
            $sql_confirm = "UPDATE user_table SET password='$new_pass' WHERE user_id = '$user_id'";
            $sql_confirm_run = mysqli_query($db, $sql_confirm);
        }
        if($sql_confirm_run)
        {
            $_SESSION['success_alert'] = "Password Updated!";
            header("Location: ../user/edit-password.php?id=$user_id");
            exit(0);
        }
        else
        {
            $_SESSION['error_alert'] = "New Password and Confirm Password Does not Match!";
            header("Location: ../user/edit-password.php?id=$user_id");
            exit(0);
        }
    }
    else
    {
        $_SESSION['error_alert'] = "Current Password Does Not Match!";
        header("Location: ../user/edit-password.php?id=$user_id");
        exit(0);
    }
}
//redeem
if(isset($_POST['redeem_btn']))
{
   $redeemables = $_POST['redeemables'];
   $user_id = $_POST['modal_user_id'];
   $current_points = $_POST['current_points'];
   $budz_code = getRef($n);

   $select_redeem =$db->query("SELECT * FROM redeemables_table WHERE item_id = '$redeemables'");
   
   if($select_redeem->num_rows > 0)
   {
       while($rows = mysqli_fetch_array($select_redeem))
       {
           $redeemable_point = $rows['redeemable_point'];

           if($current_points >= $redeemable_point)
           {
               $update =$db->query("UPDATE user_table SET user_points = user_points - $redeemable_point WHERE user_id = '$user_id'");

               $insert =$db->query("INSERT INTO redeemed_table (item_id,user_id ,redeem_code,redeemed_date) VALUES ('$redeemables','$user_id','$budz_code', '$AsiaTime')");
               
               if($insert)
                {

                    $_SESSION['success_alert'] = "Points Redeemed!";
                    header("Location: ../user/profile.php");
                    exit(0);
                }     
            }    
            else
            {
                $_SESSION['error_alert'] = "Insufficient Points!";
                header("Location: ../user/profile.php");
                exit(0);
            }  
       }
   }
}
//Logout

if(isset($_POST['logout_btn']))
{
    $user_id = $_SESSION['user_id'];

    $update_status =$db->query("UPDATE user_table SET user_status = '0' WHERE user_id = '$user_id'");
    
    unset( $_SESSION['auth']);
    unset( $_SESSION['auth_role']);
    unset( $_SESSION['auth_user']);

    $_SESSION['success_alert'] = "Logged Out Successfully";
    header("Location: ../index.php");
    exit(0);
    die();
}



