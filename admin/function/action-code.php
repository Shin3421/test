<?php

include('../../connection.php');
include('../../assets/time.php');

$TimeZone = new DateTime();
$TimeZone->setTimezone(new DateTimeZone('Asia/Manila'));
$AsiaTime = $TimeZone->format('Y-m-d h:i:s');

$today = date("Y-m-d");
$date_today = date_create($today);
$action = isset($_POST['action']) ? $_POST['action'] : '';
$week_id = isset($_POST['week_id']) ? $_POST['week_id'] : '';
$role_as = isset($_POST['role_as']) ? $_POST['role_as'] : '';
$start = isset($_POST['start']) ? $_POST['start'] : '';
$end = isset($_POST['end']) ? $_POST['end'] : '';
$admin_id = isset($_POST['admin_id']) ? $_POST['admin_id'] : '';
$user_points = isset($_POST['user_points']) ? $_POST['user_points'] : '';
$machine_number = isset($_POST['machine_number']) ? $_POST['machine_number'] : '';
$schedule_id = isset($_POST['schedule_id']) ? $_POST['schedule_id'] : '';
$slot_schedule = isset($_POST['slot_schedule']) ? $_POST['slot_schedule'] : '';
$schedule_time_id = isset($_POST['schedule_time_id']) ? $_POST['schedule_time_id']: '';

$budz_code = isset($_POST['budz_code']) ? $_POST['budz_code'] : '';
$total_cost = isset($_POST['total_cost']) ? $_POST['total_cost'] : '';
$payment = isset($_POST['payment']) ? $_POST['payment'] : '';
$total_change = isset($_POST['total_change']) ? $_POST['total_change'] : '';
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

$send_data = array();

$n=10;
function getRef($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
};

$num=15;
function reference_number($num) {
    $numbers = '0123456789';
    $random = '';
  
    for ($i = 0; $i < $num; $i++) {
        $generate = rand(0, strlen($numbers) - 1);
        $random .= $numbers[$generate];
    }
  
    return $random;
};


switch ($action)
{
    case '1':
        
        $select_machine = $db->query("SELECT * FROM machine_table WHERE machine_status = '0'");

        if($total_machine = mysqli_num_rows($select_machine))
        {

        foreach($start as $index => $st)
        {
            $add_start = $st;
            $add_end = $end[$index];
            $insert_time = "INSERT INTO schedule_time_table (admin_id, week_id, starting_time, end_time, slots, schedule_added) VALUES ('$admin_id', '$week_id', '$add_start', '$add_end', '$total_machine', '$AsiaTime')";
            $insert_time_result = mysqli_query($db, $insert_time);

            break;
        }
    }
        break;

    case '2':


        $update_time = "UPDATE schedule_time_table SET starting_time = '$start', end_time = '$end' WHERE schedule_time_id = '$schedule_time_id'";
        $update_time_result = mysqli_query($db, $update_time);

        $select_sched = $db->query("SELECT A.*, B.* FROM schedule_time_table AS A INNER JOIN customer_schedule_table AS B ON A.schedule_time_id = B.schedule_time_id WHERE B.schedule_id = '$schedule_id'");

        if($select_sched->num_rows > 0)
        {

        while($rows = mysqli_fetch_array($select_sched))
        {
            
            $starting_time = date_create($rows['starting_time']);
            $end_time = date_create($rows['end_time']);
            $date = date_create($rows['date']);
            $notification_message = "Cancelled a schedule on ". $date->format("M d Y"). ", time from ". date_format($starting_time, 'g:i A') . " to ". date_format($end_time, 'g:i A');
            
            $notification =$db->query("INSERT INTO notification_table (reciever_id, sender_id, notif_message, notif_created) VALUES ('$user_id', '$admin_id', '$notification_message','$AsiaTime')");
        }
    }

        break;
    
    case '3':

        $id = $admin_id;

        $update_status =$db->query("UPDATE customer_schedule_table SET status = '3' WHERE schedule_id = '$schedule_id'");

        $select =$db->query("SELECT * FROM customer_schedule_table WHERE schedule_id = '$schedule_id'");

        if($select->num_rows > 0)
        {
            while($row = mysqli_fetch_array($select))
            {
                $user = $row['user_id'];
                $schedule_time_id = $row['schedule_time_id'];
                $date = $row['date'];
                $service_type = $row['service_type'];
                $machine_id = $row['machine_id'];
                $booking_code = $row['booking_code'];
                $status = $row['status'];

                $insert_cancel =$db->query("INSERT INTO cancel_table (user_id, schedule_time_id, date, service_type, machine_id, booking_code, status,date_created) VALUES ('$user','$schedule_time_id','$date','$service_type','$machine_id','$booking_code','$status','$AsiaTime')");

                if($insert_cancel)
                {
                    $select_sched = $db->query("SELECT A.*, B.* FROM schedule_time_table AS A INNER JOIN customer_schedule_table AS B ON A.schedule_time_id = B.schedule_time_id WHERE B.schedule_id = '$schedule_id'");

                    if($select_sched->num_rows > 0)
                    {
    
                    while($rows = mysqli_fetch_array($select_sched))
                    {
                        
                        $user_id = $rows['user_id'];
                        $starting_time = date_create($rows['starting_time']);
                        $end_time = date_create($rows['end_time']);
                        $date = date_create($rows['date']);
                        $notification_message = "Cancelled your schedule on ". $date->format("M d Y"). ", time from ". date_format($starting_time, 'g:i A') . " to ". date_format($end_time, 'g:i A');
                        
                        $notification =$db->query("INSERT INTO notification_table (reciever_id, sender_id, notif_message, notif_created) VALUES ('$user_id', '$id', '$notification_message','$AsiaTime')");

                        $delete =$db->query("DELETE FROM customer_schedule_table WHERE schedule_id = '$schedule_id'");
                    }
                }
                }
              
            }
        }
        
            break;
            

    case '5':

        $refNumber = reference_number($num);
        $insert_complete =$db->query("INSERT INTO complete_table (user_id, schedule_id, complete_date) VALUES ('$user_id', '$schedule_id', '$AsiaTime')");

        $update_points =$db->query("UPDATE user_table SET user_points = user_points + '$user_points' WHERE user_id = '$user_id'");

        if($insert_complete)
        {
            $complete_sched =$db->query("UPDATE customer_schedule_table SET status = '4' WHERE schedule_id = '$schedule_id'");

            $insert_receipt =$db->query("INSERT INTO receipt_table (user_id,schedule_id,receipt_total,receipt_cash,receipt_change, receipt_date_created, reference_number) VALUES ('$user_id','$schedule_id','$total_cost','$payment','$total_change', '$AsiaTime', '$refNumber')");

            if($insert_receipt)
            {
           
                $select_table = $db->query ("SELECT A.*, B.* FROM customer_schedule_table AS A INNER JOIN schedule_time_table AS B ON A.schedule_time_id = B.schedule_time_id WHERE schedule_id = '$schedule_id'");
               
    
                    while($rows = mysqli_fetch_array($select_table))
                    {
                        $user_id = $rows['user_id'];
                        $admin_id = $rows['admin_id'];
                        $user_points = 2;
                        $starting_time = date_create($rows['starting_time']);
                        $end_time = date_create($rows['end_time']);
                        $date = date_create($rows['date']);
                        $notification_message = "Transaction Complete on ". $date->format("M d Y"). ". You earned ".$user_points." Budz Points.";
                        
                        $accept_notif =$db->query("INSERT INTO notification_table (reciever_id, sender_id, notif_message, notif_created) VALUES ('$user_id', '$admin_id', '$notification_message', '$AsiaTime')");
    
                    }
            }
        }

        break;

            
    case '6':

        $delete_time = "DELETE FROM schedule_time_table WHERE schedule_time_id = '$schedule_time_id'";
        $delete_time_result = mysqli_query($db, $delete_time);

        break;

}


?>


