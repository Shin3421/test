<?php

include("../../connection.php");

include("../../assets/time.php");



$TimeZone = new DateTime();

$TimeZone->setTimezone(new DateTimeZone('Asia/Manila'));

$AsiaTime = $TimeZone->format('Y-m-d h:i:s');



$action = isset($_POST['action']) ? $_POST['action'] : '';

$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

$admin_id = isset($_POST['admin_id']) ? $_POST['admin_id'] : '';

$notification_id = isset($_POST['notification_id']) ? $_POST['notification_id'] : '';

$task_id = isset($_POST['task_id']) ? $_POST['task_id'] : '';

$task_name = isset($_POST['task_name']) ? $_POST['task_name'] : '';

$task_description = isset($_POST['task_description']) ? $_POST['task_description'] : '';

$task_points = isset($_POST['task_points']) ? $_POST['task_points'] : '';

$task_target = isset($_POST['task_target']) ? $_POST['task_target'] : '';

$machine_id = isset($_POST['machine_id']) ? $_POST['machine_id'] : '';

$machine_name = isset($_POST['machine_name']) ? $_POST['machine_name'] : '';

$machine_model = isset($_POST['machine_model']) ? $_POST['machine_model'] : '';

$machine_status = isset($_POST['machine_status']) ? $_POST['machine_status'] : '';

$item_id = isset($_POST['item_id']) ? $_POST['item_id'] : '';

$item_name = isset($_POST['item_name']) ? $_POST['item_name'] : '';

$description = isset($_POST['description']) ? $_POST['description'] : '';

$redeemable_point = isset($_POST['redeemable_point']) ? $_POST['redeemable_point'] : '';

$price = isset($_POST['price']) ? $_POST['price'] : '';







$array_data = array ();

switch($action)

{

    case '1':

        $delete_notif = "DELETE FROM notification_table WHERE reciever_id = '$admin_id'";

        $delete_notif_result = mysqli_query($db, $delete_notif);

        break;

    case '2':

        $edit_task =$db->query("UPDATE task_table SET task_name = '$task_name', task_description = '$task_description', task_points = '$task_points', task_target = '$task_target' WHERE task_id = '$task_id'");

        break;

    case '3':

        $delete_task =$db->query("DELETE FROM task_table WHERE task_id = '$task_id'");

        break;



        case '8':

            $edit_machine =$db->query("UPDATE machine_table SET machine_name = '$machine_name', machine_model = '$machine_model', machine_status = '$machine_status' WHERE machine_id = '$machine_id'");

            $insert_machine_status =$db->query("INSERT INTO machine_status_table (machine_id,machine_status,machine_status_date) VALUES ('$machine_id','$machine_status','$AsiaTime')");

            if($edit_machine)
            {
                $select_machine = $db->query("SELECT * FROM machine_table WHERE machine_status = '0'");
               

                if($total_machine = mysqli_num_rows($select_machine))
                {
                    $update_schedule =$db->query("UPDATE schedule_time_table SET slots = $total_machine");
                   
                }
            }

            break;

    case '9':

        $delete_machine =$db->query("DELETE FROM machine_table WHERE machine_id = '$machine_id'");

        if($delete_machine)

        {

            $select_machine = $db->query("SELECT * FROM machine_table WHERE machine_status = '0'");

                if($total_machine = mysqli_num_rows($select_machine))

                {

                    $update_schedule =$db->query("UPDATE schedule_time_table SET slots = $total_machine");

                }

        }

        break;

        case '10':

           $redeemables =$db->query("SELECT * FROM redeemables_table WHERE item_id = '$item_id'");

           if($redeemables)

           {

                while($row = mysqli_fetch_array($redeemables))

                {

                    $data = array ("id" => $row['item_id'], "name" => $row['item_name'], "desc" =>$row['description'], "point" =>$row['redeemable_point'], "item_price" => $row['price']);

                    $array_data = $data;

                }

           }

           echo json_encode($array_data);

            break;



        case '11':

            $delete_redeem =$db->query("DELETE FROM redeemables_table WHERE item_id = '$item_id'");

            break;



    case '12':

        $update =$db->query("UPDATE redeemables_table SET item_name = '$item_name', description = '$description',redeemable_point = '$redeemable_point'WHERE item_id = '$item_id'");

        break;



}

?>