<?php
session_start();

include('connection.php');

$TimeZone = new DateTime();
$TimeZone->setTimezone(new DateTimeZone('Asia/Manila'));
$AsiaTime = $TimeZone->format('Y-m-d h:i:s');


//Login
if(isset($_POST['login_btn']))
{
    
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $login_query =$db->query("SELECT * FROM user_table WHERE email ='$email' AND password = '$password' AND verified = 1 LIMIT 1");

    $is_verified = null;

    while($row =  mysqli_fetch_assoc($login_query)) {
        $is_verified = $row['verified'];
        $user_pass = $row['password'];
    }
        if($is_verified == 1)
        {
            
            if($password == $user_pass)
        {


            foreach($login_query as $data)
            {
                $user_id = $data['user_id'];
                $user_fname = $data['fname'];
                $user_lname = $data['lname'];
                $user_number = $data['number'];
                $user_email = $data['email'];
                $user_address = $data['address'];
                $user_password = $data['password'];
                $user_created_at = $data['created_at'];      
                $role_as = $data['role_as'];
                $user_points = $data['user_points'];
    
            }
            $_SESSION['auth'] = true;
            $_SESSION['auth_role'] = "$role_as";
            $_SESSION['auth_user'] = [
                'user_id'=>$user_id,
                'user_fname'=>$user_fname,
                'user_lname'=>$user_lname,
                'user_number'=>$user_number,
                'user_email'=>$user_email,
                'user_address'=> $user_address,
                'user_created_at'=> $user_created_at,
                'user_password'=>$user_password,
    
            ];
            $_SESSION['user_id'] = "$user_id";
            $_SESSION['email'] = "$user_email";
            $_SESSION['password'] = "$user_password";
        
    
            if($_SESSION['auth_role'] == "1")
            {
                $insert_login_admin =$db->query("INSERT INTO login_history_table (user_id, login_date) VALUES ('$user_id', '$AsiaTime')");
                
                $active_staus =$db->query("UPDATE user_table SET user_status = '1' WHERE user_id = '$user_id'");
    
                $_SESSION['success_alert'] = "Welcome, " . $user_fname ."!";
                header("Location: admin/home-page.php");
                exit(0);
            }
            elseif($_SESSION['auth_role'] == "0")
            {
                $insert_login =$db->query("INSERT INTO login_history_table (user_id, login_date) VALUES ('$user_id', '$AsiaTime')");
                
                $active_staus =$db->query("UPDATE user_table SET user_status = '1' WHERE user_id = '$user_id'");
    
                $_SESSION['success_alert'] = "Welcome, " . $user_fname . "!";
                header("Location: user/home-page.php");
                exit(0);
            }
        }else{
                  $_SESSION['error_alert'] = "Invalid Email or Password";
            header("Location: login.php");
            exit(0);
          
        }
    }else {
    
            $_SESSION['error_alert'] = "Account not verified";
                header("Location: login.php");
                exit(0);
    }
   
}   
else
{
    $_SESSION['error_alert'] = "Something Went Wrong";
    header("Location: login.php");
    exit(0);

}

?>