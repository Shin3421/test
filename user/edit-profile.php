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
?>
<?php include 'message.php'; ?>
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
    <!-- CSS File and Fonts-->
    <link rel="stylesheet" 
    href="../assets/css/font-awesome.min.css">
    <link
     href="../assets/css/poppins.min.css"
     rel="stylesheet"
   />
   <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert2.min.css">
   <link rel="stylesheet" href="css/home-page.css" />
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
  </li>
<?php
}
?>
    <!-- edit -->
    <div class="container">
        <div class="row position-relative">
          <div class="col-sm pt-5 my-3 position-relative">
            <br />
            <br />
        <div class="col-md-12"  >
            <div class="card"  >
                <div class="card-header" style="background: white;">
                    <h4 class="font-weight-bold"  style="color: #980799; text-align: center;">Edit Profile
                  </h4>   
                </div>
                <div class="card-body">
            <?php
                if(isset($_GET['id']))
                        {
                            $user_id = $_GET['id'];
                            $sql_user = "SELECT * FROM user_table WHERE user_id='$user_id' ";
                            $sql_user_run = mysqli_query($db, $sql_user);
                            if(mysqli_num_rows($sql_user_run) > 0)
                            {
                                foreach($sql_user_run as $user)
                                {
                                ?>
                                <div class="container">
                                <form action="../assets/code.php" method="POST">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'];?>">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="">First Name<a style="color:red;">*</a></label>
                                        <input type="text" name="fname" value="<?= $user['fname'];?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Last Name</label>
                                        <input type="text" name="lname" value="<?= $user['lname'];?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Mobile Number</label>
                                        <input type="text" name="number" value="<?= $user['number'];?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Email<a style="color:red;">*</a></label>
                                        <input type="text" name="email" value="<?= $user['email'];?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Address<a style="color:red;">*</a></label>
                                        <input type="text" name="address" value="<?= $user['address'];?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 text-center mb-3">
                                    <button type="submit" name="update_profile" class="btn btn-primary" style="margin-top: 30px;">Update Profile</button>
                                    <a href="profile.php" class="btn btn-danger" style="margin-top: 30px;">Back</a>
                                    </div>
                                </div>
                                </form>
                                </div>
                        <?php
                                }
                            }
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- Footer -->
 <div id="cont_footer" class="footer-container border-top" style="color: #980799;">
      <h3 class="social-med-h3">Social Media Accounts:</h3>
      <ul class="links-ul" style="color: #980799;">
        <li class="">
          <a href="">
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
<!-- edit code -->
<?php 
if(isset($_POST['update_profile']))
{
    $user_id = $_POST['user_id'];
    $fname= $_POST['fname'];
    $lname= $_POST['lname'];
    $number= $_POST['number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $query = "UPDATE user_table SET fname='$fname', lname='$lname',number='$number', email='$email',address='$address'
                WHERE user_id ='$user_id' ";
    $query_run = mysqli_query($db, $query);
    if($query_run)
    {
        $_SESSION['success_alert'] = "Updated Successfully";
        header("Location: profile.php");
        exit(0);
    }
}
?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="../assets/js/fontawesome.min.js"></script>
    <script type="text/javascript" src="../assets/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="../assets/js/slim.min.js"></script>
    <script type="text/javascript" src="../assets/js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

   <script type="text/javascript">
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
  