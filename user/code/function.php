<?php

include("../../connection.php");
include("../../assets/time.php");

$TimeZone = new DateTime();
$TimeZone->setTimezone(new DateTimeZone('Asia/Manila'));
$AsiaTime = $TimeZone->format('Y-m-d h:i:s');

$action = isset($_POST['action']) ? $_POST['action'] : '';
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$notification_id = isset($_POST['notification_id']) ? $_POST['notification_id'] : '';
$schedule = isset($_POST['schedule']) ? $_POST['schedule'] : '';
$service_type = isset($_POST['service_type']) ? $_POST['service_type'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$machine_used = isset($_POST['machine_used']) ? $_POST['machine_used'] : '';
$schedule_id = isset($_POST['schedule_id']) ? $_POST['schedule_id'] : '';

$current_points = isset($_POST['current_points']) ? $_POST['current_points'] : '';
$redeemables = isset($_POST['redeemables']) ? $_POST['redeemables'] : '';
$modal_user_id = isset($_POST['modal_user_id']) ? $_POST['modal_user_id'] : '';

$task_id = isset($_POST['task_id']) ? $_POST['task_id'] : '';
$task_target = isset($_POST['task_target']) ? $_POST['task_target'] : '';

$redeemed_id = isset($_POST['redeemed_id']) ? $_POST['redeemed_id'] : '';
$redeemable_point = isset($_POST['redeemable_point']) ? $_POST['redeemable_point'] : '';

$resched_remark = isset($_POST['resched_remark']) ? $_POST['resched_remark'] : '';
$array_data = array ();

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

$m=7;
function redeemCode($m) {
    $characters1 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString1 = '';
  
    for ($i = 0; $i < $m; $i++) {
        $index1 = rand(0, strlen($characters1) - 1);
        $randomString1 .= $characters1[$index1];
    }
  
    return $randomString1;
};

switch($action)
{
    case '1':

        $delete_notif = "DELETE FROM notification_table WHERE reciever_id = '$user_id'";
        $delete_notif_result = mysqli_query($db, $delete_notif);

        break;

    case '2':

        $booking_code = getRef($n);
        $status = 2;

        $select_schedule = $db->query("SELECT * FROM customer_schedule_table WHERE user_id = '$user_id' AND schedule_time_id = '$schedule' AND date = '$date' AND status = '2'");

        if($select_schedule->num_rows > 0)
        {
            echo json_encode('1');
        }
        else{
            $insert_sched =$db->query("INSERT INTO customer_schedule_table (user_id, schedule_time_id, date, service_type, booking_code,machine_used, status, date_created) VALUES ('$user_id', '$schedule', '$date', '$service_type', '$booking_code','$machine_used', '$status','$AsiaTime')");

            if($insert_sched)
            {
                $select_sched = $db->query("SELECT * FROM schedule_time_table WHERE schedule_time_id = '$schedule'");

                while($rows = mysqli_fetch_array($select_sched))
                {
                    $admin_id = $rows['admin_id'];
                    $starting_time = date_create($rows['starting_time']);
                    $end_time = date_create($rows['end_time']);
                    $date = date_create($rows['date']);
                    $notification_message = "Booked a schedule on ". $date->format("M d Y"). ", time from ". date_format($starting_time, 'g:i A') . " to ". date_format($end_time, 'g:i A');
                    
                    $notification =$db->query("INSERT INTO notification_table (reciever_id, sender_id, notif_message, notif_created) VALUES ('$admin_id', '$user_id', '$notification_message','$AsiaTime')");
                }
            }
        }
        break;

    case '3':

        $id = $user_id;

        
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
                        
                        $admin_id = $rows['admin_id'];
                        $starting_time = date_create($rows['starting_time']);
                        $end_time = date_create($rows['end_time']);
                        $date = date_create($rows['date']);
                        $notification_message = "Canceled their schedule on ". $date->format("M d Y"). ", time from ". date_format($starting_time, 'g:i A') . " to ". date_format($end_time, 'g:i A');
                        
                        $notification =$db->query("INSERT INTO notification_table (reciever_id, sender_id, notif_message, notif_created) VALUES ('$admin_id', '$id', '$notification_message','$AsiaTime')");
                  
                        $delete =$db->query("DELETE FROM customer_schedule_table WHERE schedule_id = '$schedule_id'");
                    }
                }           
                }
              
            }
        }
            

        break;

    case '4':

        $receipt =$db->query("SELECT A.*, B.*, C.* FROM transaction_table AS A 
        INNER JOIN customer_schedule_table AS B ON A.schedule_id = B.schedule_id 
        INNER JOIN user_table AS C ON A.user_id = C.user_id WHERE A.schedule_id = $schedule_id");

        if($receipt)
        {
            while($row = mysqli_fetch_array($receipt))
            {
               
                $date_created = date_create($row['transaction_date']);

                $data = array ("firstname" => $row['fname'], "lastname" => $row['lname'], "transaction_date"=> date_format($date_created, 'm-d-Y / H:i A'),"reference_number"=> $row['reference_number'], "receipt_amount"=> number_format($row['total_amount'],2), "receipt_cash"=> number_format($row['total_cash'],2), "receipt_change"=> number_format($row['total_change'],2),"service_type"=> $row['service_type']);
                
            }
        }
        echo json_encode($data);

        break;

    case '5':

        $claim_task =$db->query("SELECT * FROM task_table WHERE task_id = '$task_id'");
        
        if($claim_task->num_rows > 0)
        {
            while($rows = mysqli_fetch_array($claim_task))
            {
                $task_points = $rows['task_points'];
                $update_points =$db->query("UPDATE user_table SET user_points = user_points + '$task_points' WHERE user_id = '$user_id'");

                if($update_points)
                {
                    $update_complete_table=$db->query("UPDATE complete_table SET comp_status = '1' WHERE user_id = $user_id AND comp_status = '0' LIMIT $task_target");

                    $action = "Claimed budz points from task";
                    $insert_action =$db->query("INSERT INTO actions_table (user_id, action, action_date) VALUES ('$user_id','$action', '$AsiaTime')");
                }

            }
        }
      
        break;

    case '6':

        $booking_code = getRef($n);
        $status = 5;
        $service = 5;

        $select_schedule = $db->query("SELECT * FROM customer_schedule_table WHERE user_id = '$user_id' AND schedule_time_id = '$schedule' AND date = '$date'");

        if($select_schedule->num_rows > 0)
        {  
                echo json_encode('1');
        }
        else{

            
            $select_redeem =$db->query("SELECT * FROM redeemables_table WHERE item_id = '$redeemables'");
   
            if($select_redeem->num_rows > 0)
            {
                while($re = mysqli_fetch_array($select_redeem))
                {
                    $redeemable_point = $re['redeemable_point'];
         
                    if($current_points >= $redeemable_point)
                    {
                        $update =$db->query("UPDATE user_table SET user_points = user_points - $redeemable_point WHERE user_id = '$user_id'");
          

            $insert_sched =$db->query("INSERT INTO customer_schedule_table (user_id, schedule_time_id, date, service_type, booking_code,machine_used, status, date_created) VALUES ('$user_id', '$schedule', '$date', '$service', '$booking_code','$machine_used', '$status','$AsiaTime')");

            if($insert_sched)
            {
                $select_sched = $db->query("SELECT * FROM schedule_time_table WHERE schedule_time_id = '$schedule'");

                $select_new = $db->query("SELECT * FROM customer_schedule_table WHERE user_id = '$user_id' AND schedule_time_id = '$schedule' AND date = '$date' AND status = '5'");

                while($rows = mysqli_fetch_array($select_sched) and $row = mysqli_fetch_array($select_new))
                {
                    $sched_id = $row['schedule_id'];
                    $admin = $rows['admin_id'];
                    $starting_time = date_create($rows['starting_time']);
                    $end_time = date_create($rows['end_time']);
                    $date = date_create($rows['date']);
                    $notification_message = "Booked a schedule on ". $date->format("M d Y"). ", time from ". date_format($starting_time, 'g:i A') . " to ". date_format($end_time, 'g:i A')." by redeemables.";
                    
                    $notification =$db->query("INSERT INTO notification_table (reciever_id, sender_id, notif_message, notif_created) VALUES ('$admin', '$user_id', '$notification_message','$AsiaTime')");

                    $insert_redeem =$db->query("INSERT INTO redeemed_table (item_id,user_id,redeem_code,schedule_id,redeemed_date) VALUES ('$redeemables','$user_id','$booking_code','$sched_id','$AsiaTime')");
            
                }
            }
        }else{
            echo json_encode('2');
        }
    }
}
}
        break;

        
    case '7':

        $id = $user_id;

        
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
                $booking_code = $row['booking_code'];
                $status = $row['status'];
            

                $insert_cancel =$db->query("INSERT INTO cancel_table (user_id, schedule_time_id, date, service_type, booking_code, status,date_created) VALUES ('$user','$schedule_time_id','$date','$service_type','$booking_code','$status','$AsiaTime')");

                
                if($insert_cancel)
                {
                    $select_sched = $db->query("SELECT A.*, B.* FROM schedule_time_table AS A INNER JOIN customer_schedule_table AS B ON A.schedule_time_id = B.schedule_time_id WHERE B.schedule_id = '$schedule_id'");

                    $select_user =$db->query("SELECT * FROM user_table WHERE user_id = '$user_id'");

                    if($select_sched->num_rows > 0)
                    {
    
                    while($rows = mysqli_fetch_array($select_sched) and $r = mysqli_fetch_array($select_user))
                    {
                        $admin_id = $rows['admin_id'];
                        $starting_time = date_create($rows['starting_time']);
                        $end_time = date_create($rows['end_time']);
                        $date = date_create($rows['date']);
                        $notification_message = "Canceled their schedule on ". $date->format("M d Y"). ", time from ". date_format($starting_time, 'g:i A') . " to ". date_format($end_time, 'g:i A');
                        
                        $update_points =$db->query("UPDATE user_table SET user_points = user_points + '$redeemable_point'");
                        
                        $notification =$db->query("INSERT INTO notification_table (reciever_id, sender_id, notif_message, notif_created) VALUES ('$admin_id', '$id', '$notification_message','$AsiaTime')");
                  
                        $delete =$db->query("DELETE FROM customer_schedule_table WHERE schedule_id = '$schedule_id'");

                        $delete_redeem =$db->query("DELETE FROM redeemed_table WHERE redeemed_id = '$redeemed_id'");
                    }
                }           
                }
              
            }
        }

        break;

    case '8':

        $update_status =$db->query("UPDATE customer_schedule_table SET schedule_time_id = '$schedule', date = '$date', service_type = '$service_type', machine_used = '$machine_used', status = '6', date_created = '$AsiaTime', reschedule_remarks = '$resched_remark' WHERE schedule_id = '$schedule_id'"); 
   
        if($update_status)
        {
            $select_sched = $db->query("SELECT * FROM schedule_time_table WHERE schedule_time_id = '$schedule'");

            while($rows = mysqli_fetch_array($select_sched))
            {
                $admin_id = $rows['admin_id'];
                $starting_time = date_create($rows['starting_time']);
                $end_time = date_create($rows['end_time']);
                $date_sched = date_create($date);
                $notification_message = "Has Re-scheduled on ". $date_sched->format("M d Y"). ", time from ". date_format($starting_time, 'g:i A') . " to ". date_format($end_time, 'g:i A');
                
                $notification =$db->query("INSERT INTO notification_table (reciever_id, sender_id, notif_message, notif_created) VALUES ('$admin_id', '$user_id', '$notification_message','$AsiaTime')");
            }
        }
        break;
}
?>