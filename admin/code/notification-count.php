<?php



include("../../connection.php");



$action = $_GET['action'];

$user_id = $_GET['admin_id'];



switch ($action)

{

  case 'user':



    $select_notif = "SELECT COUNT(*) AS notification_count FROM notification_table WHERE reciever_id = '$user_id' AND notif_status = '0'";



   $select_notif_result = mysqli_query($db, $select_notif);



               while($row = mysqli_fetch_assoc($select_notif_result))

               {

                    if($row['notification_count'] >= '1')

                    {

                      echo $row['notification_count'];

                    }

                  }     

                  break;     		            

}

?>