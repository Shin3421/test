<?php
include("../../connection.php");
include("../../assets/time.php");

$TimeZone = new DateTime();
$TimeZone->setTimezone(new DateTimeZone('Asia/Manila'));
$AsiaTime = $TimeZone->format('Y-m-d h:i:s');

$type = isset($_POST['type']) ? $_POST['type'] : '';
$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
$category_name = isset($_POST['category_name']) ? $_POST['category_name'] : '';
$category_description = isset($_POST['category_description']) ? $_POST['category_description'] : '';
$category_price = isset($_POST['category_price']) ? $_POST['category_price'] : '';
$category_points = isset($_POST['category_points']) ? $_POST['category_points'] : '';

$schedule_id = isset($_POST['schedule_id']) ? $_POST['schedule_id'] : '';
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
$weight = isset($_POST['weight']) ? $_POST['weight'] : '';
$unit_price = isset($_POST['unit_price']) ? $_POST['unit_price'] : '';
$total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : '';
$total_change = isset($_POST['total_change']) ? $_POST['total_change'] : '';
$total_cash = isset($_POST['total_cash']) ? $_POST['total_cash'] : '';
$total_points = isset($_POST['total_points']) ? $_POST['total_points'] : '';

$notification_id = isset($_POST['notification_id']) ? $_POST['notification_id'] : '';
$schedule = isset($_POST['schedule']) ? $_POST['schedule'] : '';
$service_type = isset($_POST['service_type']) ? $_POST['service_type'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$machine_used = isset($_POST['machine_used']) ? $_POST['machine_used'] : '';
$schedule_id = isset($_POST['schedule_id']) ? $_POST['schedule_id'] : '';
$resched_remark = isset($_POST['resched_remark']) ? $_POST['resched_remark'] : '';

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


switch($type)
{

    
case '1':
    $update =$db->query("UPDATE price_category_table SET category_name = '$category_name', category_description = '$category_description',category_price = '$category_price', category_points = '$category_points' WHERE category_id = '$category_id'");

    break;
    
case '2':
    $delete_category =$db->query("DELETE FROM price_category_table WHERE category_id = '$category_id'");
    break;


case '3':


    $refNumber = reference_number($num);
    $insert_transaction =$db->query("INSERT INTO transaction_table (category_id, schedule_id, weight, user_id, unit_price, total_amount, total_change, total_cash, transaction_date, reference_number) VALUES ('$category_id','$schedule_id','$weight','$user_id','$unit_price','$total_amount','$total_change','$total_cash','$AsiaTime','$refNumber')");

    $insert_complete =$db->query("INSERT INTO complete_table (user_id, schedule_id, complete_date) VALUES ('$user_id', '$schedule_id', '$AsiaTime')");

    if($insert_complete)
    {
        $complete_sched =$db->query("UPDATE customer_schedule_table SET status = '4', date_created ='$AsiaTime' WHERE schedule_id = '$schedule_id'");

        $update_points =$db->query("UPDATE user_table SET user_points = user_points + '$total_points' WHERE user_id = '$user_id'");

        $select_table = $db->query ("SELECT A.*, B.* FROM customer_schedule_table AS A INNER JOIN schedule_time_table AS B ON A.schedule_time_id = B.schedule_time_id WHERE schedule_id = '$schedule_id'");
               
        while($rows = mysqli_fetch_array($select_table))
        {
            $user_id = $rows['user_id'];
            $admin_id = $rows['admin_id'];
            $starting_time = date_create($rows['starting_time']);
            $end_time = date_create($rows['end_time']);
            $date = date_create($rows['date']);
            $notification_message = "Transaction Complete on ". $date->format("M d Y"). ". You earned ". $total_points ." Budz Points.";
            
            $accept_notif =$db->query("INSERT INTO notification_table (reciever_id, sender_id, notif_message, notif_created) VALUES ('$user_id', '$admin_id', '$notification_message', '$AsiaTime')");

            $update_redeem =$db->query("UPDATE redeemed_table SET r_status = '1' WHERE schedule_id = '$schedule_id'");
        }
    }
    

    break;

    case '4':

        $update_status =$db->query("UPDATE customer_schedule_table SET schedule_time_id = '$schedule', date = '$date', status = '6', date_created = '$AsiaTime', reschedule_remarks = '$resched_remark' WHERE schedule_id = '$schedule_id'"); 
   
        if($update_status)
        {
            $select_sched = $db->query("SELECT * FROM schedule_time_table WHERE schedule_time_id = '$schedule'");

            while($rows = mysqli_fetch_array($select_sched))
            {
                $admin_id = $rows['admin_id'];
                $starting_time = date_create($rows['starting_time']);
                $end_time = date_create($rows['end_time']);
                $date_sched = date_create($date);
                $notification_message = "Has Re-scheduled you on ". $date_sched->format("M d Y"). ", time from ". date_format($starting_time, 'g:i A') . " to ". date_format($end_time, 'g:i A');
                
                $notification =$db->query("INSERT INTO notification_table (reciever_id, sender_id, notif_message, notif_created) VALUES ('$user_id', '$admin_id', '$notification_message','$AsiaTime')");
            }
        }
        break;
}
    ?>