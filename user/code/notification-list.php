<?php 

include("../../connection.php");
include("../../assets/time.php");


$action = $_GET['action'];
$user_id = $_GET['user_id'];
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
          
          <li class="message-cont mt-2 mr-2 ml-2 p-2">
    
          <a onclick="notification('<?php echo $row['fname'] . $row['lname'] ?>', '<?php echo  $notif_date ?>','<?php echo $time ?>', '<?php echo $row['notif_message'] ?>', '<?php echo $row['notification_id']?>')" role="button" aria-pressed="true">
                  <label><?= $row['fname'] ?></label>
                  <label style="font-size: 13px; word-break: break-word; "><?= $row['notif_message'] ?></label>
                  <span style="font-size: 10px;"><?= getDateTimeDiff($row['notif_created']) ?></span>
                  </a>
              </li>
                    <?php
                  }else{
                    ?>
                  <li class="message-content-read mt-2 mr-2 ml-2 p-2">
                  <a onclick="notification('<?php echo $row['fname'] . $row['lname'] ?>', '<?php echo  $notif_date ?>','<?php echo $time ?>', '<?php echo $row['notif_message'] ?>', '<?php echo $row['notification_id']?>')" type="button">
                  <label><?= $row['fname'] ?></lab>
                  <label style="font-size: 13px; word-break: break-word; "><?= $row['notif_message'] ?></label>
                  <span style="font-size: 10px;"><?= getDateTimeDiff($row['notif_created']) ?></span>
                  </a>
              </li>
          <?php
        }
      }
    }else
    {
      echo '<p class="notif-message"> No notifications...</p>';
    }

    break;
}

?>