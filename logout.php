<?php

session_start();

$user_id = $_SESSION['user_id'];

include('connection.php');

if(isset($_POST['logout_btn']))

{
    $update_status =$db->query("UPDATE user_table SET user_status = '0' WHERE user_id = '$user_id'");

    unset( $_SESSION['auth']);

    unset( $_SESSION['auth_role']);

    unset( $_SESSION['auth_user']);

    session_unset();

	session_destroy();

    $_SESSION['success_alert'] = "Logged Out Successfully";

    header("Location: index.php");

    exit(0);

    die();

}



?>