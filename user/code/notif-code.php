<?php 

include("../../connection.php");
include("../../assets/time.php");


$option = isset($_POST['option']) ? $_POST['option'] : '';
$notification_id = isset($_POST['notification_id']) ? $_POST['notification_id'] : '';
$sender_id = isset($_POST['sender_id']) ? $_POST['sender_id'] : '';

$message_data = array ();

switch($option)
{
    case '1':

        $select_notif ="SELECT A.*, B.* FROM notification_table AS A INNER JOIN user_table AS B ON A.sender_id = B.user_id WHERE notification_id = '$notification_id'";
        $result = mysqli_query($db, $select_notif);

        if($result)
        {
            
            $update = $db->query("UPDATE notification_table SET notif_status = '1' WHERE notification_id = '$notification_id'");
          
        }


        break;

    case '2':

        $update = $db->query("UPDATE notification_table SET notif_status = '1' WHERE notification_id = '$notification_id'");

        if($update)
        {
            $select_notif =$db->query("SELECT A.*, B.* FROM notification_table AS A INNER JOIN user_table AS B ON A.sender_id = B.user_id WHERE notification_id = '$notification_id' AND sender_id = '$sender_id'");
        
            if($select_notif->num_rows > 0)
            {
              
                while($rows = mysqli_fetch_array($select_notif))
                {
                    $date = date_create($rows['notif_created']);
    
                    $data = array ( "sender_name" => $rows['fname'], "notif_date" => $date->format("d M Y g:i A"), "notif_time" => getDateTimeDiff($rows["notif_created"]), "mes" => $rows['notif_message']);
    
                    
                }
            
            }
 
        }
        echo json_encode($message_data);
      

 

        break;
}