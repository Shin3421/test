<?php 
include("../../connection.php");
include("../../assets/time.php");

$action = $_GET['action'];
$user_id = $_GET['admin_id'];
$notification_lists;
switch ($action)
{
  case 'user':
    $notification_lists = $db->query("SELECT A.*, B.* FROM notification_table as A INNER JOIN user_table as B ON A.sender_id = B.user_id WHERE reciever_id = '$user_id' ORDER BY notif_created DESC");
    if($notification_lists->num_rows > 0)
    {
      while($row = mysqli_fetch_array($notification_lists))
      {
        $date = date_create($row['notif_created']);
        $time = getDateTimeDiff($row['notif_created']);
        $notif_date = date_format($date, 'd M Y g: i A');

        if($row['notif_status'] === '0')
        {
    ?>
   <li>
       <hr class="dropdown-divider">
   </li>
   <li class="notification-item">
    <a style="display:contents;" onclick="notification('<?php echo $row['fname'] . $row['lname'] ?>', '<?php echo  $notif_date ?>','<?php echo $time ?>', '<?php echo $row['notif_message'] ?>', '<?php echo $row['notification_id']?>')">
       <i class="bi bi-exclamation-circle text-warning"></i>
       <div>
           <h4><?php echo $row['fname'] ?></h4>
           <p><?php echo $row['notif_message'] ?></p>
           <p><?php echo getDateTimeDiff($row['notif_created']) ?></p>
       </div>
    </a>
   </li>                     
   <?php
        }else{
           ?>
       <li>
       <hr class="dropdown-divider">
   </li>
   <li class="notification-item-read">
    <a style="display:contents;" onclick="notification('<?php echo $row['fname'].' '.$row['lname'] ?>', '<?php echo $date->format('d M Y g:i A')?>','<?php echo $time ?>', '<?php echo $row['notif_message'] ?>', '<?php echo $row['notification_id']?>')">
       <i class="bi bi-exclamation-circle text-warning"></i>
       <div>
           <h4><?php echo $row['fname'] ?></h4>
           <p><?php echo $row['notif_message'] ?></p>
           <p><?php echo getDateTimeDiff($row['notif_created']) ?></p>
       </div>
        </a>
   </li>                
           <?php
        }
       }
   }else{
       echo '<p style="text-align: center;"> No notifications...</p>';
   }
      ?>
    </div>
    </ul>
<?php
    break;
}
?>