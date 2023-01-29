<?php

session_start();

include('../../connection.php');

$TimeZone = new DateTime();

$TimeZone->setTimezone(new DateTimeZone('Asia/Manila'));

$AsiaTime = $TimeZone->format('Y-m-d h:i:s');

if(isset($_POST['add_task_btn']))

{

    $task_name = $_POST['add_task_name'];

    $task_description= $_POST['add_task_description'];

    $task_points= $_POST['add_task_points'];

    $task_target= $_POST['add_task_target'];

    $insert_task =$db->query("INSERT INTO task_table (task_name, task_description ,task_points, task_target, task_created) VALUES ('$task_name', '$task_description','$task_points','$task_target', '$AsiaTime')");

    if($insert_task)

    {

        $_SESSION['success_alert'] = "Added Successfully";

        header("Location: ../customer-tasks.php");

        exit(0);

    }

};

if(isset($_POST['add_redeemable_btn']))

{

    $item_name = $_POST['add_item_name'];

    $description= $_POST['add_description'];

    $redeemable_point= $_POST['add_redeemable_point'];

    $insert_redeemable =$db->query("INSERT INTO redeemables_table (item_name, description,redeemable_point, redeemable_added) VALUES ('$item_name', '$description','$redeemable_point', '$AsiaTime')");

    if($insert_redeemable)

    {

        $_SESSION['success_alert'] = "Added Successfully";

        header("Location: ../set-redeemables.php");

        exit(0);

    }

};

if(isset($_POST['add_machine_btn']))

{

    $machine_name = $_POST['add_machine_name'];

    $machine_model= $_POST['add_machine_model'];

    $machine_status= $_POST['add_machine_status'];

    $insert_machine =$db->query("INSERT INTO machine_table (machine_name, machine_model, machine_status, machine_added) VALUES ('$machine_name', '$machine_model','$machine_status', '$AsiaTime')");

    if($insert_machine)

    {

        $select_machine = $db->query("SELECT * FROM machine_table WHERE machine_status = '0'");

            if($total_machine = mysqli_num_rows($select_machine))

            {

                $update_schedule =$db->query("UPDATE schedule_time_table SET slots = $total_machine");

            }

        $_SESSION['success_alert'] = "Added Successfully";

        header("Location: ../machines.php");

        exit(0);

    }

};

if(isset($_POST['add_category_btn']))

{

    $category_name = $_POST['add_category_name'];

    $category_description= $_POST['add_category_description'];

    $category_price= $_POST['add_category_price'];

    $category_points= $_POST['add_category_points'];



    $insert_category =$db->query("INSERT INTO price_category_table (category_name, category_description, category_price, category_points) VALUES ('$category_name', '$category_description','$category_price','$category_points')");



    if($insert_category)

    {

        $_SESSION['success_alert'] = "Added Successfully";

        header("Location: ../prices-category.php");

        exit(0);

    }



 



};



if(isset($_POST['update_user']))

{

    $user_id = $_POST['euser_id'];

    $fname= $_POST['efname'];

    $lname= $_POST['elname'];

    $number= $_POST['enumber'];

    $address = $_POST['eaddress'];

    $points = $_POST['epoints'];

    $query = "UPDATE user_table SET fname='$fname', lname='$lname',number='$number',address='$address',user_points = $points WHERE user_id ='$user_id' ";

    $query_run = mysqli_query($db, $query);

    if($query_run)

    {

        $_SESSION['success_alert'] = "Updated Successfully";

        header("Location: ../registered-users.php");

        exit(0);

    }

};

//add user

if(isset($_POST['add_user_btn']))

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

            header("Location: ../registered-users.php");

            exit(0);

        }

        else

        {

            $user_query= "INSERT INTO user_table (fname,lname,number,email,address,password, created_at) VALUES ('$fname','$lname','$number','$email','$address','$password','$AsiaTime')";

            $user_query_run = mysqli_query($db, $user_query);

            if($user_query_run)

            {

                $_SESSION['success_alert'] = "Add Successfully!";

                header("Location: ../registered-users.php");

                exit(0);

            }

            else

            {

                $_SESSION['error_alert'] = "Something went wrong";

                header("Location: ../registered-users.php");

                exit(0);

            }

        }

    }

    else

    {

        $_SESSION['error_alert'] = "Password and Confirm Password does not match!";

        header("Location: ../registered-users.php");

        exit(0);

    }

}

else

{  

     $_SESSION['error_alert'] = "Something went wrong";

    header("Location: ../registered-users.php");

    exit(0);

};

?>

