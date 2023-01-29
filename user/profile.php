<?php
session_start(); 
include('../connection.php');
include('../assets/time.php');
if(!isset($_SESSION['email'])){
  $_SESSION['error_alert'] = "You are not registered yet!";
  header("Location: ../index.php");
  exit(0);
  die();
}elseif($_SESSION['auth_role'] != "0")
{
  $_SESSION['error_alert'] = "Invalid Action!";
  header("Location: ../index.php");
  session_unset();
  session_destroy();
  die();
}
$user_id = $_SESSION['auth_user']['user_id'];


$d1 = isset($_GET['d1'])
    ? date('Y-m-d', strtotime($_GET['d1']))
    : date('Y-m-d');
$d2 = isset($_GET['d2'])
    ? date('Y-m-d', strtotime($_GET['d2']))
    : date('Y-m-d');
$data = $d1 == $d2 ? $d1 : $d1 . ' - ' . $d2;
$datetime = date_create($data);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css"
    />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/profile.css" />
    <link rel="stylesheet" href="css/home-page.css" />

    <link rel="stylesheet" href="../assets/css/CalendarPicker.style.css">
    <!-- CSS File and Fonts-->
    <link rel="stylesheet" 
    href="../assets/css/font-awesome.min.css">
    <link
     href="../assets/css/poppins.min.css"
     rel="stylesheet"
   />
   <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/datatables/datatables.min.css"/>
    <link rel="stylesheet" href="../assets/datatables/jquery.dataTables.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    
    <!-- Hover CSS -->
    <link rel="stylesheet" 
    href="hover/hover-min.css"/>
    <link rel="stylesheet" 
    href="hover/hover.css"/>
    <link
      rel="Webpage icon"
      type="device-icon/png"
      href="../assets/images/Navigation Bar/LOGO.png"
    />
  </head>
  <body>

    <!-- Navigation Bar Section -->
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="home-page.php">
          <img class="logo" src="../assets/images/Navigation Bar/LOGO.png" alt="" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav text-center" style="color: #980799;">
            <li class="nav-item">
              <a class="nav-link" href="home-page.php" style="color: #980799;">
                Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="service-and-pricing.php" style="color: #980799;">
                Services & Prices
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacts.php" style="color: #980799;">
                Contacts & MapView
              </a>
            </li>
</div>
  <!-- Notifications -->
  <div class="nav-item dropdown">
						<a href="#" class="dropdown nav-link" data-toggle="dropdown">
							<i class="fas fa-bell"></i> <span class="badge badge-pill shake"><div id="notification_count">
								<?php
                $notifications = "SELECT COUNT(*) AS notification_count FROM notification_table WHERE reciever_id = '$user_id' AND notif_status = '0'";
                $notifications_result = mysqli_query($db, $notifications);
               while($row = mysqli_fetch_assoc($notifications_result))
               {
                    if($row['notification_count'] >= '1')
                    {
                      echo $row['notification_count'];
                    }
                  }          		            
		                     ?>
		                    </div>
							</span>
						</a>
						<div class="menu-notification dropdown-menu dropdown-menu-right ">
							<div class="menu-top-header topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a onclick="clear_notif()" style="cursor: pointer; color:#9515f6;" class="clear-noti hvr-grow"> Clear All </a>
							</div>
                <div id="notif_list">
                  <ul class="notif-content">
              <?php
$notification_lists = $db->query("SELECT A.*, B.* FROM notification_table as A INNER JOIN user_table as B ON A.sender_id = B.user_id WHERE reciever_id = '$user_id' ORDER BY notif_created DESC");
if($notification_lists->num_rows > 0)
{
  while($row = mysqli_fetch_array($notification_lists))
  {
    if($row['notif_status'] === '0')
    {
      ?>
      <li class="message-cont mt-2 mr-2 ml-2 p-2">
              <a href="#">
              <label><?= $row['fname'] ?></label>
              <label style="font-size: 13px; word-break: break-word; "><?= $row['notif_message'] ?></label>
              <span style="font-size: 10px;"><?= getDateTimeDiff($row['notif_created']) ?></span>
              </a>
          </li>
                <?php
              }else{
                ?>
              <li class="message-content-read mt-2 mr-2 ml-2 p-2">
              <a>
              <label><?= $row['fname'] ?></label>
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
?>
                  </ul>
                </div>
						</div>
					</div>
<!-- user_option -->
      <?php if (isset($_SESSION['auth_user']))
      {
      ?>
<div class="nav-item dropdown">
      <a  aria-hidden="true" class="nav-link text-dark dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-circle-user" style="color: #980799;"></i>
        </a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
    <h6 class="dropdown-header" href="#" style="color:#980799; font-weight: bold; "><?= $_SESSION['auth_user']['user_fname'];?><?= $_SESSION['auth_user']['user_lname']; ?></h6>
    <a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i> Account</a>
    <form action="../assets/code.php" method="POST">
    <button type="submit" name="logout_btn" class="dropdown-item" href=""><i class="fa fa-right-from-bracket"></i> Logout</button>
    </form>
  </div>
</div>
          </nav>
        </div>
      <?php
      }
      ?>
          <?php
          $id = $_SESSION['user_id'];
          $query = "SELECT * FROM user_table WHERE user_id = '$id' ";
          $query_run = mysqli_query($db, $query);
          if(mysqli_num_rows($query_run) > 0)
          {
              foreach($query_run as $row)
              {
                $date_joined = date_create($row['created_at']);
                  ?>
    <!-- Profile -->
    <div class="container">
        <div class="row position-relative">
          <div class="col-sm pt-5 my-3 position-relative">
            <br />
            <br />
              <h2 class="title border-bottom text-center pb-2" style="color: #980799; font-weight: 700; text-transform:uppercase;">
              Profile</h2>
          <div class="containter" style="color: #980799;">
            <div class="row">
            <div class="col-md-6">
                <div class="card mt-5">  
                <div class="card-body" style="height: 374px;">
                <div class="form-group mb-3">
                        <h4 style="font-weight: bold; text-align:center; color:#980799; ">Personal Information</h4>
                    </div>
                    <div class="dropdown-divider mb-3"></div>
                <div class="form-group mb-1">
                        <label style="font-weight: bold;">Budz Points:</label>
                        <span class="badge" style="font-size: 15px;"><?= $row['user_points']; ?> Points</span>
                    </div>
                    <div class="form-group mb-1">
                        <label style="font-weight: bold;">Name</label>
                        <?= $row['fname']; ?> <?= $row['lname']; ?>
                    </div>
                    <div class="form-group mb-1">
                        <label style="font-weight: bold;">Number:</label>
                        <?= $row['number']; ?>
                    </div>
                    <div class="form-group mb-1">
                        <label style="font-weight: bold;">Email:</label>
                        <?= $row['email']; ?>
                    </div>
                    <div class="form-group mb-1">
                        <label style="word-break: break-all; font-weight: bold;">Address:</label>
                        <?= $row['address']; ?>
                    </div>             
                    <div class="form-group mb-1">
                        <label style="font-weight: bold;">Date Joined:</label>
                       <?php echo date_format($date_joined, 'F d, Y'); ?>
                    </div>
                   <div class="row mt-3" style=" justify-content: space-evenly;">
                  <a class="btn btn-info mb-2"type="button"style="color:#FFF; font-weight:bold; width: 150px;" data-toggle="modal" onclick="show_redeemed_modal('<?php echo $user_id ?>', <?php echo $row['user_points'] ?>)" >Redeem Points</a>
                  <a class="btn btn-info mb-2"href="edit-profile.php?id=<?= $row['user_id']; ?>" style="color:#FFF; font-weight:bold; width: 150px;">Edit Profile</a>
                  <a class="btn btn-info mb-2"href="edit-password.php?id=<?= $row['user_id']; ?>" style="color:#FFF; font-weight:bold; width: 150px;">Edit Password</a>
                   </div>
                    </div>
                </div>
            </div>
            <!-- options -->
            <!-- redeem modal -->
            <div class="col-md-6 mt-5">
              <div class="card">         
                <div class="card-body p-3" style="text-align: center; overflow-y: auto; height:374px;" >
                <h3 style="color: #980799;text-align: center;">Task</h3>
                <?php 
                  $select_task =$db->query("SELECT * FROM task_table ORDER BY task_id ASC");
                  if($select_task->num_rows > 0)
                  {
                    while($rows = mysqli_fetch_array($select_task))
                    {
                      $task_id = $rows['task_id'];
                      $task_name = $rows['task_name'];
                      $task_description = $rows['task_description'];
                      $task_target = $rows['task_target'];
                      $select_comp =$db->query("SELECT COUNT(*) `progress` FROM complete_table WHERE comp_status = '0' AND user_id = '$user_id'");
                      if($select_comp->num_rows > 0)
                      {
                        while($data = mysqli_fetch_array($select_comp))
                        {
                          $total = number_format($data['progress']);
                          $progress = $total;
                ?>
                <div class="row mb-2 m-1 p-3" style="background: #f8f9fa;">
                <div class="form-group" style="display: contents;">
                  <div class="col">
                  <label style="font-size: 17px;"><?php echo $task_name ?>&nbsp;</label><span class="text-secondary" style="font-size: 14px;">(<?php echo $task_description ?>)</span>
                  <div class="col">
                  <span class=""style="font-size: 12px;"><?php echo $progress ?> out of  <?php echo $task_target ?></span>
                  <progress style="width: 100%; height:20px;" name="condition" id="condition" value="<?php echo $progress ?>" max="<?php echo $task_target ?>"></progress>
                  <button class="btn btn-info" id="<?php echo $task_id ?>" onclick="claim_task('<?php echo $task_id ?>', '<?php echo $task_target ?>')"name="task_btn">Claim</button>
                </div>
                  </div>
                <script type="text/javascript">
                  var target = <?php echo $task_target ?>;
                  var task_progress = <?php echo $progress ?>;
                  var id_task = "<?php $task_id ?>";
                  if(target <= task_progress)
                  {
                    document.getElementById("<?php echo $task_id?>").disabled = false;
                  }
                  else
                  {
                    document.getElementById("<?php echo $task_id?>").disabled = true;
                  }
		            </script>
                  </div>
                </div>
                <?php
                        }
                      }
                    }
                  }
                ?>
                </div>
            </div>
              </div>
<?php
              }
            }
            ?>
            </div>
          </div>
          </div>
        </div>
             <!-- tab content -->
        <div class="containter" style="color: #980799;">
   <div class="row">
   <div class="col-md-12">
<div class="tab" style="background:#ffeffe;" >
<table >
            <tr>
  <th ><button style="color:#980799; font-weight: bold;" class="tablinks" onclick="openTabs(event, 'schedule_tab')" id="defaultOpen">Schedule</button><th>
  <th><button style="color:#980799; font-weight: bold" class="tablinks" onclick="openTabs(event, 'redeem_tab')">Redeemed</button></th>
  <th><button style="color:#980799; font-weight: bold" class="tablinks" onclick="openTabs(event, 'canceled_tab')">Canceled Schedule</button></th>
  <th><button style="color:#980799; font-weight: bold" class="tablinks" onclick="openTabs(event, 'reschedule_tab')">Re-scheduled</button></th>
  <th><button style="color:#980799; font-weight: bold" class="tablinks" onclick="openTabs(event, 'history_tab')">Completed Schedule</button></th>
  <th><button style="color:#980799; font-weight: bold" class="tablinks" onclick="openTabs(event, 'transaction_tab')">Payment History</button></th>
            </tr>
          </table>
</div>
<div id="schedule_tab" class="tabcontent" style="background-color: white;" >
  <!-- booking Table -->
              <h5 style="margin-bottom: 10px;margin:15px; color:#980799;">Recent Booking</h5>  
              <div class="table table-responsive p-3" >
                <table class="table table-striped" style="color:#980799; width:100%;" id="customer_sched">
                      <thead>
                            <tr>
                                <th style="text-align: center;">Schedule</th>
                                <th style="text-align: center;">Budz Code</th>
                                <th style="text-align: center;">Number of machines</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Action</th>
                            </tr>     
                      </thead>
                      <tbody>
                      <?php 
                        $id = $_SESSION['user_id'];
                        $select = "SELECT A.*, B.* FROM customer_schedule_table AS A INNER JOIN schedule_time_table AS B ON A.schedule_time_id = B.schedule_time_id WHERE A.user_id = '$id' AND A.status = '2' ORDER BY date_created ASC";
                        $select_run = mysqli_query($db, $select);
                        if($select_run->num_rows > 0)
                        {
                          while($row = mysqli_fetch_array($select_run))
                          {
                            $schedule_id = $row['schedule_id'];
                            $date = date_create($row['date']);
                            $start = date_create($row['starting_time']);
                        $end = date_create($row['end_time']);
                        ?>
                                        <tr>

                                            <td style="text-align: center;"><span class="d-block text-info"><?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A') ?></span><?php echo $date->format("d M Y"); ?></td> 
                                            <td style="text-align: center"><?php echo $row['booking_code'] ?></td>
                                            <td style="text-align: center;"><?php echo $row['machine_used'] ?></td> 
                                            <td style="text-align: center;"><h5><?php if($row['status'] == '2') 
                                                        {
                                                            echo '<span class="badge badge-primary">Pending </span>';
                                                        }
                                                        elseif($row['status'] == '6') 
                                                        {
                                                            echo '<span class="badge badge-warning">Re-scheduled </span>';
                                                        }
                                                        ?>
                                            </h5></td>
                                            
                                            <td style="text-align: center;"><button onclick="rescheduleOption('<?php echo $schedule_id ?>','<?php echo $row['user_id'] ?>')" type="button" class="btn btn-info btn-sm">Re-schedule</button></td>
                                            <!--<td style="text-align: center;"><button onclick="cancel_modal(<?php echo $schedule_id ?>)" type="button" class="btn btn-danger">Cancel</button></td>
                                            </tr>  
                                            <script type="text/javascript">
                                                function cancel_modal(id)
                                                {  
                                                    Swal.fire({
                                                        title: "Warning",
                                                        text: "Are you sure to cancel your schedule?",
                                                        icon: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Yes"
                                                    }).then((result) =>
                                                    {
                                                        if(result.isConfirmed)
                                                        {
                                                            cancel_schedule(id);
                                                        }
                                                    });
                                                }
                                                </script>     -->                 
                                <?php
                            }
                        }
                        ?>
                                      </tbody> 
                    </table>
                      </div>
                                    </div>
<div id="redeem_tab" class="tabcontent" style="background-color: white;" >
                            <!-- history table -->
              <h5 style="margin-bottom: 10px; color:#980799; margin:15px;">Redeem History</h5>   
              <div class="table table-responsive p-3">
                <table class="table table-striped" style="color:#980799; width:100%;" id="history_redeem">
                <thead>
                            <tr>  
                                <th style="text-align: center;">Schedule</th>
                                <th style="text-align: center;">Budz Code</th>
                                <th style="text-align: center;">Description</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Action</th>
                            </tr>     
                </thead>
                <tbody>
                                <?php
                                $id = $_SESSION['user_id'];
                                $find =$db->query("SELECT A.*, B.*, C.*, D.* FROM redeemed_table AS A INNER JOIN redeemables_table AS B ON A.item_id = B.item_id 
                                INNER JOIN customer_schedule_table AS C ON A.schedule_id = C.schedule_id 
                                INNER JOIN schedule_time_table AS D ON C.schedule_time_id = D.schedule_time_id WHERE A.user_id = $id AND A.r_status = '0' ORDER BY redeemed_date ASC");
                                if($find->num_rows > 0)
                                {
                                    while($row = mysqli_fetch_array($find))
                                    {
                                      $date = date_create($row['date']);
                                      $start = date_create($row['starting_time']);
                                      $end = date_create($row['end_time']);
                                      $redeemed_id = $row['redeemed_id'];
                                      $schedule_id = $row['schedule_id'];
                                      $redeemable_point = $row['redeemable_point']
                                ?>
                                        <tr style="text-align: center;">
                                        <td style="text-align: center;"><span class="d-block text-info"><?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A') ?></span><?php echo $date->format("d M Y"); ?></td> 
                                            <td><h5 style="color:#980799"><?= $row['redeem_code'] ?></h5></td>
                                            <td><?php echo $row['item_name']; ?></td> 
                                             <td><h5><?php if($row['r_status'] == '0') 
                                                        {
                                                            echo '<span class="badge badge-info">Pending </span>';
                                                        }
                                                        elseif($row['r_status'] == '1')
                                                        {
                                                            echo '<span class="badge badge-success">Complete </span>';
                                                        }    
                                                        ?>
                                             </h5></td>

                                            <td style="text-align: center;"><button onclick="cancel_alert('<?php echo $redeemed_id ?>','<?php echo $schedule_id ?>','<?php echo $redeemable_point ?>')" type="button" class="btn btn-danger">Cancel</button></td>
                                            </tr>  
                                            <script type="text/javascript">
                                                function cancel_alert(redeemed_id, schedule_id, redeemable_point)
                                                {  
                                                    Swal.fire({
                                                        title: "Warning",
                                                        text: "Are you sure to cancel your schedule?",
                                                        icon: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Yes"
                                                    }).then((result) =>
                                                    {
                                                        if(result.isConfirmed)
                                                        {
                                                            cancel_redeem(redeemed_id, schedule_id, redeemable_point);
                                                        }
                                                    });
                                                }
                                                </script>         
                                        </tr>
                                <?php
                            }
                        }              
                            ?>
                                </tbody>
                    </table>
              </div>
                                    </div>
         <div id="history_tab" class="tabcontent" style="background-color: white;" >
  <!-- redeemed Table -->
              <h5 style="margin-bottom: 10px;margin:15px; color:#980799;">Recent Booking</h5>  
              <div class="table table-responsive p-3">
                <table class="table table-striped" style="color:#980799; width:100%;" id="complete_sched">
                      <thead>
                            <tr> 
                                <th style="text-align: center;">Schedule</th>
                                <th style="text-align: center;">Description</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Schedule Receipt</th>
                            </tr>     
                      </thead>
                      <tbody>
                      <?php 
                        $select_complete =$db->query("SELECT A.*, B.* FROM customer_schedule_table AS A INNER JOIN schedule_time_table AS B ON A.schedule_time_id = B.schedule_time_id WHERE A.user_id = '$user_id' AND A.status = '4'  ORDER BY date_created ASC" ) ;
                        if($select_complete->num_rows > 0)
                        {
                          while($row = mysqli_fetch_array($select_complete))
                          {
                            $date = date_create($row['date']);
                            $start = date_create($row['starting_time']);
                            $end = date_create($row['end_time']);
                        ?>
                                        <tr>
                                            <td style="text-align: center;"><span class="d-block text-info"><?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A') ?></span><?php echo $date->format("d M Y"); ?></td>
                                            <td style="text-align: center;"><?php if($row['service_type'] == '1') 
                                                        {
                                                            echo 'Self Service';
                                                        }
                                                        elseif($row['service_type'] == '2')
                                                        {
                                                            echo 'Full Service';
                                                        }
                                                        elseif($row['service_type'] == '5')
                                                        {
                                                            echo 'Reward';
                                                        }
                                                        ?>
                                            </td>
                                            <td style="text-align: center;"><h5><?php if($row['status'] == '4') 
                                                        {
                                                            echo '<span class="badge badge-success">Completed </span>';
                                                        }elseif($row['status'] == '3')
                                                        {
                                                          echo '<span class="badge badge-danger">Canceled </span>';
                                                        }
                                                        ?>
                                            </h5></td>
                                           <td style="text-align: center;"><button onclick="show_receipt(<?php echo $row['schedule_id']; ?>)" type="button" class="btn btn-info"><i class="fa fa-clipboard"></i> View</button>  </td>
                                        </tr>        
                                <?php
                            }
                        }
                        ?>
                          </tbody> 
                    </table>
                      </div>
                                    </div>

                <div id="canceled_tab" class="tabcontent" style="background-color: white;" >
  <!-- cancel Table -->
              <h5 style="margin-bottom: 10px;margin:15px; color:#980799;">Recent Booking</h5>  
              <div class="table table-responsive p-3">
                <table class="table table-striped" style="color:#980799; width:100%;" id="canceled_table">
                      <thead>
                            <tr>
                                <th style="text-align: center;">Schedule</th>
                                <th style="text-align: center;">Description</th>
                                <th style="text-align: center;">Status</th>
                            </tr>     
                      </thead>
                      <tbody>
                      <?php 
                        $select_complete =$db->query("SELECT A.*, B.* FROM cancel_table AS A INNER JOIN schedule_time_table AS B ON A.schedule_time_id = B.schedule_time_id WHERE A.user_id = '$user_id' AND A.status = '3'  ORDER BY date_created ASC" ) ;
                        if($select_complete->num_rows > 0)
                        {
                          while($row = mysqli_fetch_array($select_complete))
                          {
                            $date = date_create($row['date']);
                            $start = date_create($row['starting_time']);
                            $end = date_create($row['end_time']);
                        ?>
                                        <tr>
                                            <td style="text-align: center;"><span class="d-block text-info"><?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A') ?></span><?php echo $date->format("d M Y"); ?></td>
                                            <td style="text-align: center;"><?php if($row['service_type'] == '1') 
                                                        {
                                                            echo 'Self Service';
                                                        }
                                                        elseif($row['service_type'] == '2')
                                                        {
                                                            echo 'Full Service';
                                                        }
                                                        elseif($row['service_type'] == '5')
                                                        {
                                                            echo 'Reward';
                                                        }
                                                        ?>
                                            </td>
                                            <td style="text-align: center;"><h5><?php if($row['status'] == '4') 
                                                        {
                                                            echo '<span class="badge badge-success">Completed </span>';
                                                        }elseif($row['status'] == '3')
                                                        {
                                                          echo '<span class="badge badge-danger">Canceled </span>';
                                                        }
                                                        ?>
                                            </h5></td>
                                        </tr>        
                                <?php
                            }
                        }
                        ?>
                          </tbody> 
                    </table>
                      </div>
                                    </div>

                                    
                                    <div id="reschedule_tab" class="tabcontent" style="background-color: white;" >
  <!-- booking Table -->
              <h5 style="margin-bottom: 10px;margin:15px; color:#980799;">Recent Booking</h5>  
              <div class="table table-responsive p-3" >
                <table class="table table-striped" style="color:#980799; width:100%;" id="reschedule)table">
                      <thead>
                            <tr>
                                <th style="text-align: center;">Schedule</th>
                                <th style="text-align: center;">Budz Code</th>
                                <th style="text-align: center;">Number of machines</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Action</th>
                            </tr>     
                      </thead>
                      <tbody>
                      <?php 
                        $id = $_SESSION['user_id'];
                        $select = "SELECT A.*, B.* FROM customer_schedule_table AS A INNER JOIN schedule_time_table AS B ON A.schedule_time_id = B.schedule_time_id WHERE A.user_id = '$id' AND A.status = '6' ORDER BY date_created ASC";
                        $select_run = mysqli_query($db, $select);
                        if($select_run->num_rows > 0)
                        {
                          while($row = mysqli_fetch_array($select_run))
                          {
                            $schedule_id = $row['schedule_id'];
                            $date = date_create($row['date']);
                            $start = date_create($row['starting_time']);
                        $end = date_create($row['end_time']);
                        ?>
                                        <tr>

                                            <td style="text-align: center;"><span class="d-block text-info"><?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A') ?></span><?php echo $date->format("d M Y"); ?></td> 
                                            <td style="text-align: center"><?php echo $row['booking_code'] ?></td>
                                            <td style="text-align: center;"><?php echo $row['machine_used'] ?></td> 
                                            <td style="text-align: center;"><h5><?php if($row['status'] == '2') 
                                                        {
                                                            echo '<span class="badge badge-primary">Pending </span>';
                                                        }
                                                        elseif($row['status'] == '6') 
                                                        {
                                                            echo '<span class="badge badge-warning">Re-scheduled </span>';
                                                        }
                                                        ?>
                                            </h5></td>

                                           <td style="text-align: center;"><button onclick="cancel_modal(<?php echo $schedule_id ?>)" type="button" class="btn btn-danger">Cancel</button></td>
                                            </tr>  
                                            <script type="text/javascript">
                                                function cancel_modal(id)
                                                {  
                                                    Swal.fire({
                                                        title: "Warning",
                                                        text: "Are you sure to cancel your schedule?",
                                                        icon: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Yes"
                                                    }).then((result) =>
                                                    {
                                                        if(result.isConfirmed)
                                                        {
                                                            cancel_schedule(id);
                                                        }
                                                    });
                                                }
                                                </script>                
                                <?php
                            }
                        }
                        ?>
                                      </tbody> 
                    </table>
                      </div>
                                    </div>

                                                 
                <div id="transaction_tab" class="tabcontent" style="background-color: white;" >
  <!-- Transaction Table -->
              <div class="container">
              <h5 style="margin-bottom: 10px;margin:15px; color:#980799;"></h5>  

              <div class="row">
                <div class="col">
                <div class="form-group">
                        <label for="" class="control-label">Date From</label>
                        <input type="date" class="form-control" name="d1" id="d1" value="<?php echo date(
                            'Y-m-d',
                            strtotime($d1)
                        ); ?>">
                    </div>
                </div>
                        
                <div class="col">
                <div class="form-group">
                        <label for="" class="control-label">Date To</label>
                        <input type="date" class="form-control" name="d2" id="d2" value="<?php echo date(
                            'Y-m-d',
                            strtotime($d2)
                        ); ?>">
                    </div>
                </div>
                <div class="col mt-2">
                <div class="form-group">
                <label for="" class="control-label"></label>
                    <button class="btn text-light fw-bold" type="button" id="filter" style="background-color: #00c5ce; font-size: 15px; width:100%;">Filter &nbsp;<i class="fa fa-filter"></i></button>
                    </div>
                </div>

                <div class="col mt-2">
                <div class="form-group">
                <label for="" class="control-label"></label>
                    <button class="btn text-light fw-bold " type="button" id="print_transaction" style="background-color: #980799; font-size: 15px; width:100%; ">Print &nbsp;<i class="fa fa-print"></i></button>
                    </div>
                </div>
              </div>
                        <div id="print-data">
                          <style>
                            
                          </style>
                        <div style="width:100%">

                        <p class="text-center">

						<img style="width:70px;height:50px;" src="../assets/images/Navigation Bar/LOGO.png">
                       
                       
					</p>

					<p class="text-center">
						<large><b>Budz Laundry Sales Report</b></large>
					</p>

                    <p class="text-center">
                    <large><b>514 Lapu-Lapu St. Cor. Quirino Ave, Brgy. East</b></large>
                    </p>

					<p class="text-center">
						<large><b>From: <?php echo $data; ?></b></large>
					</p>

					</div>
					<table class='table' id="total_transaction" >
                        
						<thead style="background-color: #00c5ce;">
							<tr>
                <th class="text-center text-light fw-bold" style="width: 80px;">Date and Time</th>
                <th class="text-center text-light fw-bold">Reference Number</th>
								<th class="text-center text-light fw-bold">Customer Name</th>
                <th class="text-center text-light fw-bold">Description</th>
								<th class="text-center text-light fw-bold">Total Amount</th>
							</tr>
						</thead>
						<tbody>
                        
                        <?php
                        $total = 0;
                        $select_sales = $db->query(
                            "SELECT A.*, B.*, C.*,D.* FROM transaction_table AS A 
                            INNER JOIN price_category_table AS B ON A.category_id = B.category_id 
                            INNER JOIN customer_schedule_table AS C ON A.schedule_id = C.schedule_id 
                            INNER JOIN user_table AS D ON A.user_id = D.user_id WHERE A.user_id = '$user_id' AND date(transaction_date) between '$d1' and '$d2' ORDER BY transaction_date "
                        );

                        while ($row = $select_sales->fetch_assoc()):
                            $total += $row['total_amount']; ?>
							<tr class="text-center fw-bolder">
                                <td><?php echo date(
                                    'd-m-Y / g:h A',
                                    strtotime($row['transaction_date'])
                                ); ?></td>
                                <td style="background-color: #ffeffe;"><?php echo $row[
                                    'reference_number'
                                ]; ?></td>
								<td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                <td style="background-color: #ffeffe;"><?php if (
                                    $row['service_type'] == '1'
                                ) {
                                    echo 'Self-Service';
                                } elseif ($row['service_type'] == '2') {
                                    echo 'Full Service';
                                }
                                elseif ($row['service_type'] == '5') {
                                    echo 'Reward';
                                }  ?>
                                </td>
								<td class=""><?php echo number_format($row['total_amount'], 2); ?></td>
							</tr>
                            <?php
                        endwhile;
                        ?>
						</tbody>
						<tfoot>
							<tr style="background-color:#980799;">
								<td class="text-center text-light fw-bolder" colspan="4">Total</td>
								<td class="text-center text-light fw-bolder">₱ <?php echo number_format(
            $total,
            2
        ); ?></td>
							</tr>
						</tfoot>
					</table>
				</div>
                </div>
   </div>
                <script>
                $(document).ready( function () {
                    $('#total_transaction').dataTable( {
                  "pageLength": 35
                } );
                        } );
                </script>


                <style>
	#print-data p {
				display: none;
			}
    #print_data_machine p {
				display: none;
			}
    #print_data_customer p {
				display: none;
			}
    #print_data_total_booked p {
        display: none;
    }
</style>
<noscript>
	<style>
			#div{
				width:100%;
			}
			table {
				border-collapse: collapse;
				width:100% !important;
			}
			tr,th,td{
				border:1px solid black;
                text-align: center;
			}
			.text-left{
				text-align: left;
                font-weight: bold;
			}
			.text-center{
				text-align: center;
                font-weight: bold;
			}
			p{
				margin:unset;
			}

			p.text-center {
			    text-align: center;
			}
            .dataTables_filter {
display: none;
}
.dataTables_length
{
    display: none;
}
.dataTables_paginate
{
    display: none;
}
.dataTables_info
{
    display: none;
}
			
	</style>
</noscript>	

</div>
<script>
  	$('#filter').click(function(){
		location.replace('profile.php?page=reports&d1='+$('#d1').val()+'&d2='+$('#d2').val())
	})
	$('#print_transaction').click(function(){
		var newWin = document.open('BudzLaundry','_blank','height=500,width=600');
		var _html = $('#print-data').clone();
		var ns = $('noscript').clone();
		newWin.document.write(ns.html())
		newWin.document.write(_html.html())
		newWin.document.close()
		newWin.print()
		setTimeout(function(){
			newWin.close()
		},1500)
	});

function openTabs(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active"
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
           </div>
       </div>
   </div>
    </div>
 <!-- Footer -->
 <div id="cont_footer" class="footer-container border-top" style="color: #980799;">
      <h3 class="social-med-h3">Social Media Accounts:</h3>
      <ul class="links-ul" style="color: #980799;">
        <li class="">
          <a href="https://www.facebook.com/budzlaundryhub/">
            <img src="../assets/images/Footer/facebook.JPG" alt="" class="image-footer" />
          </a>
        </li>
        <li class="">
          <a href="">
            <img src="../assets/images/Footer/gmail.JPG" alt="" class="image-footer" />
          </a>
        </li>
        <li class="">
          <a href="#">
            <img src="../assets/images/Footer/instagram.JPG" alt="" class="image-footer" />
          </a>
        </li>
        <li class="">
          <a href="">
            <img src="../assets/images/Footer/twitter.png" alt="" class="image-footer" />
          </a>
        </li>
      </ul>
      <footer class="py-2 my-4">
        <ul class="nav justify-content-center pb-3 mb-3">
          <li class="nav-item">
            <a href="home-page.php" class="nav-link px-2">Home</a>
          </li>
          <li class="nav-item">
            <a href="service-and-pricing.php" class="nav-link px-2">Services & Prices</a>
          </li>
          <li class="nav-item">
            <a href="contacts.php" class="nav-link px-2">Contact</a>
          </li>
          <li class="nav-item">
            <a href="aboutus.php" class="nav-link px-2">About</a>
          </li>
          <li class="nav-item">
            <a href="faqs.php" class="nav-link px-2">FAQs</a>
          </li>
        </ul>
        <p class="text-center">
          Copyright © 2022 Budz Laundry Hub, Inc. All Rights Reserved
        </p>
      </footer>
    </div>
              <!-- Modal -->
              <div class="modal fade" id="receipt_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h3 class="modal-title" id="exampleModalLabel"></h3>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="container">
                                                  <div class="row justify-content-center" >
                                                      <img src="../assets/images/Navigation Bar/LOGO.png" style="height: 80px; width: 137px;"/>
                                                  </div>
                                                  <div class="row mt-2">
                                                    <div class="col" style="text-align: center;">
                                                    <h6>514 Lapu-Lapu St.</h6>
                                                    <h6 style="margin-top: -7px ;">Cor. Quirino Ave, Brgy. East</h6>                                                  </div>
                                                  </div>

                                              <hr style="border-top: 2px solid #bbb;">

                                                  <div class="row">
                                                  <div class="col">
                                                <h6 id="modal_customer_name">Name:</h6>
                                              </div>
                                              <div class="col" style="text-align: end;">
                                              <h6 id="modal_receipt_date">Date: </h6>
                                              </div>
                                                  </div> 
                                            <div class="row">
                                              <div class="col">
                                              <h6 id="modal_reference_number">Reference Number: </h6>
                                              </div>
                                            </div>
                                          
                                            <hr style="border-top: 2px solid #bbb;">

                                            <div class="row">
                                              <div class="col mt-2">
                                                <label class="font-weight-bold">Service Type </label>
                                              </div>
                                              <div class="col mt-2" style="text-align: end;">
                                              <label id="modal_service_type"></label>
                                              </div>
                                            </div>

                                            <div class="row">
                                              <div class="col mt-2">
                                                <label class="font-weight-bold">TOTAL AMOUNT </label>
                                              </div>
                                              <div class="col mt-2" style="text-align: end;">
                                              <label id="modal_total_amount"></label>
                                              </div>
                                            </div>
                                            <div class="row mb-3">
                                              <div class="col mt-2">
                                                <label class="font-weight-bold">CASH </label>
                                              </div>
                                              <div class="col mt-2" style="text-align: end;">
                                              <label id="modal_total_cash"></label>
                                              </div>
                                            </div>
                                            <hr style="border-top: 2px dashed #bbb; margin-top: auto;margin-bottom: auto;">
                                            <div class="row">
                                              <div class="col mt-2">
                                                <label class="font-weight-bold">CHANGE </label>
                                              </div>
                                              <div class="col mt-2" style="text-align: end;">
                                              <label class="font-weight-bold" id="modal_total_change"></label>
                                              </div>
                                            </div>
                                            <hr style="border-top: 2px solid #bbb; margin-top: auto;margin-bottom: auto;"> 

                                            <div class="row mt-3">
                                              <div style="text-align: center;" class="col">
                                              <h4 >Budz Laundry Hub</h4>
                                              </div>
                                            </div>
                                          </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
<!-- Redeem -->
 <?php include 'message.php'; ?>
<div class="modal fade" id="redeem_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Redeem!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <form method="POST" id="modal_first_form">
      <input id="modal_user_id" name="modal_user_id" type="hidden" class="form-control">
      <input id="current_points"  name="current_points" type="hidden" class="form-control">
      
      <div class="modal-body">
        <div class="row justify-content-center">
        <h4 id="current_user_points" id="current_user_points">
          current points
        </h4>    
        </div>
        <label style="text-align: center;">Reedemables!</label>    
        <div class="list-group">
          <div class="form-group">
    <?php
          $select_redeemables =$db->query("SELECT * FROM redeemables_table");
          if($select_redeemables->num_rows > 0)
          {
              while($rows = mysqli_fetch_array($select_redeemables))
              {
                $item_id = $rows['item_id'];
            ?>
        <input type="radio" name="redeemables" id="<?php echo $rows['item_id']; ?>"require_once value="<?php echo $rows['item_id'] ?>" required>
        <label class="available" for="<?php echo $rows['item_id']; ?>"><?php echo $rows['item_name'] ?><span class="text-success">&nbsp;(<?php echo $rows['redeemable_point'] ?> Budz Points)</span></label>
      <?php
              }
            }
            ?>
 </div>
</div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
          Close
        </button>
      <button type="submit" name="redeem_btn" id="redeem_btn" 
        class="btn btn-info">Next</button>
      </div>
      </form>
      </div>
    </div>
  </div>

  <!-- nextOption -->
<div class="modal fade" id="booking_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Redeem Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input id="modal_user_id1" name="modal_user_id1" type="hidden" class="form-control">
      <input id="current_points1"  name="current_points1"type="hidden" class="form-control">
      <input id="redeemables1"  name="redeemables1"type="hidden" class="form-control">

             <!-- Schedule Widget -->
							<div class="card booking-schedule schedule-widget">
								<!-- Schedule Content -->
								<div class="schedule-cont">
									<div class="row">
										<div class="col-md-7">
										<div id="myCalendarWrapper"></div>	
										</div>
										<div class="col-md-5 my-sm-2">
										<h3>Pick a date to get started</h3>
											<br>
                      <form id="booking_form" method="POST">
											<div id="show_schedule_info">
											</div>
                      </form>
										</div>
							<!-- /Submit Section -->
									</div>
								</div>
								<!-- /Schedule Content -->
							</div>
							<!-- /Schedule Widget -->
      </div>
      <div class="modal-footer">
        <button onclick="backOption()"type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
      </div>
    </div>
  </div>
</div>

  <!-- Reschedule -->
  <div class="modal fade" id="reschedule_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Re-schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    

             <!-- Schedule Widget -->
							<div class="card booking-schedule schedule-widget">
								<!-- Schedule Content -->
								<div class="schedule-cont">
									<div class="row">
										<div class="col-md-7">
										<div id="myCalendarWrapper1"></div>	
										</div>
										<div class="col-md-5 my-sm-2">
										<h3>Pick a date to get started</h3>
											<br>
                      <form id="reschedule_form" method="POST">
                      <input id="resched_schedule_id" name="resched_schedule_id" type="hidden" class="form-control">
                      <input id="resched_user_id" name="resched_user_id" type="hidden" class="form-control">
											<div id="show_reschedule">
                     
											</div>
                      </form>
										</div>
							<!-- /Submit Section -->
									</div>
								</div>
								<!-- /Schedule Content -->
							</div>
							<!-- /Schedule Widget -->
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

<script>

function rescheduleOption(schedule_id, user_id)
    {
      $('#reschedule_modal').modal("show");
      $('#resched_schedule_id').val(schedule_id);
      $('#resched_user_id').val(user_id);
    }
      $('#reschedule_form').submit(function(e)
      {
        e.preventDefault();
        action = 8;

        user_id = $('#resched_user_id').val();
        schedule_id = $('#resched_schedule_id').val();
        date = $("input[name='resched_date']").val();
        schedule = $("input[name='resched_schedule']:checked").val()
        service_type =$("#resched_service_type").val();
        machine_used = $("#resched_machine_used").val();
        resched_remark = $('#resched_remark').val();
        
        $.ajax({
          url: "code/function.php",
          type: "POST",
          data: 
          {
            user_id: user_id,
            schedule_id: schedule_id,
            date: date,
            schedule: schedule,
            service_type: service_type,
            machine_used: machine_used,
            resched_remark: resched_remark,
            action: action,

          },
          success: function (data) 
          {  
            if (data[1] == 1) {
	            		Swal.fire("Error!", "You already booked a schedule", "error");
	            	} else {
	            		Swal.fire("Successful!", "Re-scheduled successfully", "success");
	                	$("#show_reschedule").load("resched-schedule.php");  
                    console.log(schedule_id, date, schedule,service_type, machine_used, resched_remark, action);
	            	}
          }
        });
      });

    $(document).ready(function ()
    {
      $('#modal_first_form').submit(function(e)
      {
        e.preventDefault();

        const first_modal_user = modal_user_id = $('#modal_user_id').val();
        const first_modal_points = current_points = $('#current_points').val();
        const first_modal_redeemables = redeemables = $("input[name='redeemables']:checked").val();

        $('#modal_user_id1').val(first_modal_user);
        $('#current_points1').val(first_modal_points);
        $('#redeemables1').val(first_modal_redeemables);

        $('#booking_modal').modal("show");
        $('#redeem_modal').modal("hide");
      });     
    });

    $('#booking_form').submit(function(e)
{
  e.preventDefault();
  action = 6;
  
  user_id = $("#modal_user_id1").val();
  current_points = $("#current_points1").val();
  redeemables = $("#redeemables1").val();
  schedule = $("input[name='schedule']:checked").val();
  machine_used = $("#machine_used").val();
  date = $("input[name='date']").val();
  $.ajax({
    url: "code/function.php",
    type: "POST",
    data: {
      user_id: user_id,
      current_points: current_points,
      redeemables: redeemables,
      schedule: schedule,
      machine_used: machine_used,
      date: date,
      action: action,
    },
    success: function (data)
    {
      if (data[1] == 1) {
	            		Swal.fire("Error!", "You already booked a schedule", "error");
	            	} else {
	            		Swal.fire("Successful!", "Scheduled successfully", "success");
	                	$("#show_schedule_info").load("schedule.php");  
	            	}
      if(data[1] == 2)
      {
        Swal.fire("Error!", "Insufficient Points!", "error");
      }
    },
  });
});

    function backOption()
    {
      $('#redeem_modal').modal("show");
      $('#booking_modal').modal("hide");
     
    };
</script>

  <script>
    $(document).ready(function()
    {
      $('#customer_sched').DataTable();
    });
    $(document).ready(function()
    {
      $('#history_redeem').DataTable();
    });
    $(document).ready(function()
    {
      $('#complete_sched').DataTable();
    });
    $(document).ready(function()
    {
      $('#canceled_table').DataTable();
    });
    $(document).ready(function()
    {
      $('#reschedule_table').DataTable();
    });
   </script>
    <script type="text/javascript">
			function Disable(){
				document.getElementById("btn_book_submit").disabled = false;
			}
      function Disable(){
				document.getElementById("btn_resched_submit").disabled = false;
			}
		</script>
      <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script type="text/javascript" src="../assets/js/fontawesome.min.js"></script>
    <script type="text/javascript" src="../assets/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="../assets/js/slim.min.js"></script>
    <script type="text/javascript" src="../assets/js/popper.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
   <script src="../assets/datatables/datatables.min.js"></script>
   <script src="../assets/datatables/jquery.dataTables.min.js"></script>

   <script src="../assets/js/script.js"></script>
        <script src="../assets/js/CalendarPicker.js"></script>

        <!-- redeem schedule -->
        <script>
const nextYear = new Date().getFullYear() + 1;
const myCalender = new CalendarPicker('#myCalendarWrapper', {
    min: new Date(),
    max: new Date(nextYear, 10), 
    locale: 'en-US', 
    showShortWeekdays: true 
});
myCalender.onValueChange((currentValue) => {
if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("show_schedule_info").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "redeem-schedule.php?user=<?php echo $user_id; ?>&week=" + (myCalender.value.getDay() + 1) + "&date=" + (myCalender.value.getFullYear() + '-' + (myCalender.value.getMonth() + 1) + '-' + myCalender.value.getDate()), true);
xmlhttp.send();
});

</script>

        <!-- Reschedule schedule -->
        <script>
const nextYear1 = new Date().getFullYear() + 1;
const myCalender1 = new CalendarPicker('#myCalendarWrapper1', {
    min: new Date(),
    max: new Date(nextYear1, 10), 
    locale: 'en-US', 
    showShortWeekdays: true 
});
myCalender1.onValueChange((currentValue) => {
if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("show_reschedule").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "resched-schedule.php?user=<?php echo $user_id; ?>&week=" + (myCalender1.value.getDay() + 1) + "&date=" + (myCalender1.value.getFullYear() + '-' + (myCalender1.value.getMonth() + 1) + '-' + myCalender1.value.getDate()), true);
xmlhttp.send();
});

</script>

   <script type="text/javascript">
 
 

    function show_redeemed_modal(modal_user_id, points)
    {
      $('#redeem_modal').modal("show");
      $('#modal_user_id').val(modal_user_id);
      $('#current_points').val(points);
      $('#current_user_points').text("Current Points: "+points);
    };
    function show_receipt(id)
    {
       action = '4';
       schedule_id = id;
       $.ajax(
        {
          url: "code/function.php",
          type: "POST",
          datatype: "json",
          data: 
          {
            schedule_id: schedule_id,
            action: action
          },
          success: function(response)
          {
            var data = JSON.parse(response);

            if(data.service_type == 1)
            {
              var service = "Self-Service";
            }if(data.service_type == 2)
            {
              var service = "Full Service";
            }
            if(data.service_type == 5)
            {
              var service = "Reward";
            }

            $("#modal_receipt_id").text('Receipt ID:'+' '+ data.receipt_id);
            $("#modal_receipt_date").text(data.transaction_date);
            $("#modal_schedule_id").text('Schedule ID: '+' '+ data.schedule_id);
            $("#modal_reference_number").text('Ref. No: '+' '+ data.reference_number);
            $("#modal_total_amount").text('₱'+' '+ data.receipt_amount);
            $("#modal_total_cash").text('₱'+' '+ data.receipt_cash);
            $("#modal_total_change").text('₱'+' '+ data.receipt_change);
            $("#modal_service_type").text(service);
            $("#modal_customer_name").text('Name:'+' '+ data.firstname +' '+ data.lastname);
          },
        });
        $('#receipt_modal').modal("show");
    };
    function claim_task(task_id, task_target)
    {
      action = 5;
      task_id = task_id;
      user_id = <?php echo $user_id ?>;
      task_target = task_target;
      $.ajax({
        url: "code/function.php",
        type: "POST",
        data:
        {
          task_id: task_id,
          user_id: user_id,
          task_target: task_target,
          action: action,
        },
        success: function()
        {
          console.log("success");
          Swal.fire("Claimed Successfully!", "", "success");   
          setTimeout(() => {
                document.location.reload();
                }, 1000);
        },
        error: function()
        {
          console.log("error");
          Swal.fire("Something Went Wrong!", "", "error");   
          setTimeout(() => {
                document.location.reload();
                }, 1000);
        }
      });
    };
    function cancel_schedule(id)
    {
      action = 3;
      schedule_id = id;
      user_id = <?php echo $user_id ?>;
      $.ajax({
        url: "code/function.php",
        type: "POST",
        data:
        {
          schedule_id: schedule_id,
          user_id, user_id,
          action: action,
        },
        success: function()
        {
          console.log("success");
          Swal.fire("The Schedule have been canceled!", "", "success");   
          setTimeout(() => {
                document.location.reload();
                }, 1000);
        },
        error: function()
        {
          console.log("error");
          Swal.fire("Somewthing went wrong!", "", "error");   
          setTimeout(() => {
                document.location.reload();
                }, 1000);
        }
      });
    };
    function cancel_redeem(redeemed_id, schedule_id, redeemable_point)
    {
      action = 7;
      redeemed_id = redeemed_id;
      schedule_id = schedule_id;
      redeemable_point = redeemable_point;
      user_id = <?php echo $user_id ?>;
      $.ajax({
        url: "code/function.php",
        type: "POST",
        data:
        {
          redeemable_point: redeemable_point,
          redeemed_id: redeemed_id,
          schedule_id: schedule_id,
          user_id, user_id,
          action: action,
        },
        success: function()
        {
          console.log("success");
          Swal.fire("The Schedule have been canceled!", "", "success");   
          setTimeout(() => {
                document.location.reload();
                }, 1000);
        },
        error: function()
        {
          console.log("error");
          Swal.fire("Somewthing went wrong!", "", "error");   
          setTimeout(() => {
                document.location.reload();
                }, 1000);
        }
      });
    };
    function notification_count()
    {
      if(window.XMLHttpRequest)
      {
        xmlhttp = new XMLHttpRequest();
      }else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function()
      {
        if(this.readyState == 4 && this.status == 200)
        {
          document.getElementById("notification_count").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "code/notification-count.php?user_id=<?php echo $user_id ?>&action=user");
      xmlhttp.send();
    };
    setInterval(function()
    {
      notification_count();
    }, 2000);
    function notification_list()
    {
      if(window.XMLHttpRequest)
      {
        xmlhttp = new XMLHttpRequest();
      }else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function()
      {
        if(this.readyState == 4 && this.status == 200)
        {
          document.getElementById("notif_list").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "code/notification-list.php?user_id=<?php echo $user_id ?>&action=user");
      xmlhttp.send();
    };
    setInterval(function()
    {
      notification_list();
    }, 2000);
    function clear_notif()
    {
      action = '1';
      user_id = <?php echo $user_id ?>;
      $.ajax({
        url: "code/function.php",
        type: "POST",
        dataType: "text",
        data:
        {
          user_id: user_id,
          action: action
        },
        success: function()
        {
          console.log("success");
        },
        error: function()
        {
          console.log("error");
        }
      });
    };
   </script>
  </body>
</html>
<?php
?>

<script type="text/javascript">
   //notif_modal
   function notification(name, date, time, message, notification_id)
    {
     option = 1;
        notification_id = notification_id;
        $.ajax({
            url: "code/notif-code.php",
            type: "POST",
            data: 
            {
                notification_id: notification_id,
                option: option,
            },
            success: function(response)
            {
                $("#notif_modal").modal("show");
        $("#sender_name").text(name);
        $("#notif_date").text(date);
        $("#notif_time").text('('+ time + ')');
        $("#notif_message").text(message);
        console.log("success");
               
                
            },
            
        }); 


        
    };

</script>
        <!-- notif modal -->
        <div class="modal fade bd-example-modal-lg" id="notif_modal" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header" style="background-color: rgba(255, 224, 253, 0.55);">
                  <h5 class="modal-title">Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
               </div>
               
               <?php
               /*
                $select_notif =$db->query("SELECT A.*, B.* FROM notification_table AS A INNER JOIN user_table AS B ON A.sender_id = B.user_id WHERE notification_id = '$notification_id'");
                */
               ?> 
               	<div class="modal-body mt-2">
                    <div class="row">
                        <div class="col-lg-1 mt-auto mb-auto">
                        <h5>From:</h4>
                        </div>
                        <div class="col-lg-8 mt-auto mb-auto">
                            
                        <h5 id="sender_name">Budz</h5>
                        </div>
                        <div class="col-lg mt-auto mb-auto">
                            <h6 id="notif_date">Nov 20, 2000</h6>
                        <label id="notif_time">(15 days ago)</label>
                        </div>
                       
                    </div>
                </div>
                <hr>
                <div class="modal-body" >
                    <div class="row justify-content-center mt-3 mb-3">
                    <div class="col text-center">
                    <img src="../assets/images/information.gif" style="height: 100px; width: 100px;">
                        <h5 class="mt-2" id="notif_message">Schedule Message</h5>
                        </div>
                    </div>
                    </div>
                    <hr>
                <div class="modal-body">
                    <div class="row justify-content-center">
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0" >
                    <button onclick="window.location.href='profile.php'" style="width: 100%;" type="submit" class="btn btn-secondary">Go to schedules</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
         </div>
  