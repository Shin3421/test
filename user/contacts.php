<?php
session_start();
include '../connection.php';
include '../assets/time.php';
if (!isset($_SESSION['email'])) {
    $_SESSION['error_alert'] = 'You are not registered yet!';
    header('Location: ../index.php');
    exit(0);
    die();
} elseif ($_SESSION['auth_role'] != '0') {
    $_SESSION['error_alert'] = 'Invalid Action!';
    header('Location: ../index.php');
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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Bootstrap CSS -->
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
   <link rel="stylesheet" href="css/contacts.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- Hover CSS -->
    <link rel="stylesheet" 
    href="hover/hover-min.css"/>
    <link rel="stylesheet" 
    href="hover/hover.css"/>
  <link rel="Webpage icon" type="device-icon/png" href="../assets/images/Navigation Bar/LOGO.png" />
  <title>Budz Laundy Hub - Contacts & Map</title>
<style>
  .nav-link:after {
    content: "";
    position: absolute;
    background-color: #980799;
    height: 2px;
    width: 0;
    left: 50%;
    bottom: -7px;
    transition: 0.4s ease-out;
  }
  .nav-link:hover:after {
    left: 0;
    width: 100%;
  }
</style>
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
          <ul class="navbar-nav text-center">
          <li class="nav-item">
              <a class="nav-link " href="home-page.php" style="color: #980799; font-size: 17px;">
                Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="service-and-pricing.php" style="color: #980799; font-size: 17px;">
                Services & Prices
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="contacts.php" style="color: #980799; font-size: 17px;">
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
<?php if (isset($_SESSION['auth_user'])) { ?>
<div class="nav-item dropdown">
<a  aria-hidden="true" class="nav-link text-dark dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
  <i class="fa fa-circle-user" style="color: #980799;"></i>
  </a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
<h6 class="dropdown-header" href="#" style="color:#980799; font-weight: bold; ">
<?= $_SESSION['auth_user']['user_fname'];?><?= $_SESSION['auth_user']['user_lname']; ?></h6>
<a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i> Account</a>
<form action="../assets/code.php" method="POST">
<button type="submit" name="logout_btn" class="dropdown-item" href=""><i class="fa fa-right-from-bracket"></i> Logout</button>
</form>
</div>
</div>
    </nav>
  </div>
  </li>
<?php } ?>
<?php include 'message.php'; ?>
<!-- Floating Section -->
<nav class="side">
  <ul class="ulimage mb-0">
    <li class="hover_effect"><a href="https://www.facebook.com/budzlaundryhub/" target="facebook-profile" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/facebook.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">FACEBOOK</span></a></li>
    <li><a href="#" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/messenger.png" alt="" class="side-media"><span class="hoverp" style="color: #fff;">MESSENGER</span></a></li>
    <!--<li><a href="#" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/gmail.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">GMAIL</span></a></li>-->
  </ul>
</nav>
<!-- Bubbles -->
<div class="bubbles_container">
      <span class="bub a "></span>
      <span class="bub b "></span>
      <span class="bub c "></span>
      <span class="bub d"></span>
      <span class="bub e"></span>
      <span class="bub f"></span>
      <span class="bub g"></span>
      <span class="bub h"></span>
      <span class="bub i"></span>
      <span class="bub j "></span>
      <span class="bub k"></span>
  </div>
  <!-- Bubbles -->
<!-- Contact Section -->
<div class="row" id="contact_id">
    <div class="container mt-5" style="z-index: 10">
      <h2 class="pb-2 text-center" style="font-weight: 700; color: #980799;">Contacts and MapView</h2>
      <?php include 'message.php'; ?>
      <div class="row d-flex justify-content-center">
        <div class="col-md-6">
          <form action="mail_contact_us.php" class="form_container" method="POST">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <input name="c_email" id="c_email" type="email" class="form-control mt-2" placeholder="Email Address" required />
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input name="c_number" id="c_number" type="phone-number" class="form-control mt-2" placeholder="Mobile Number" required />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <textarea name="c_message" id="c_message" class="form-control" id="exampleFormControlTextarea1" placeholder="Write a Message..." rows="3" required></textarea>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                  <label class="form-check-label" for="exampleCheck1" style="font-size: 11px;">I read and accepted the <a href="../user/terms-and-condition.php" target="termsandcondition" class="text-primary">Term & conditions</a> and <a href="../user/privacy-and-policy.php" target="privacypolicy" class="text-primary">Privacy Policy</a> <span style="color: red; font-size: 15px;">*</span></label>
                  </div>
                </div>
              </div>
              <div class="col-12 text-center">
              <button type="submit" id="contact_us_btn"class="text-light font-weight-bold rounded" style="background-color: #00c5ce; padding: 5px 44%; border-color: #fff0;">
                Submit
              </button>
              </div>
            </div>
          </form>
          <div class="" style="color:#980799;">
            <h2 class="mt-4 font-weight-bold">Where we are</h2>
            <i class="fa fa-phone mt-3"></i>
            <a href="tel:+" style="color: #980799;">(083)877 6148</a>
            <br />
            <i class="fa fa-phone mt-3"></i>
            <a href="tel:+" style="color: #980799;">
              09429656743
            </a>
            <br />
            <i class="fa fa-envelope mt-3"></i>
            <a href="" style="color: #980799;">budzlaundryhub@gmail.com</a>
            <br />
            <i class="fa fa-globe mt-3"></i>
            514 Lapu-Lapu St. Cor. Quirino Ave, Brgy. East
            <br />
            <i class="fa fa-globe mt-3"></i>
            DOOR 3 SAFI Complex, Brgy. Calumpang
            <br />
            <div class="my-4">
              <a target="facebook" href="https://www.facebook.com/budzlaundryhub/"><i class="fa-brands fa-facebook fa-2x pr-3 text-info"></i></a>
              <a target="instagram" href="https://www.instagram.com/budzlaundryhub/?fbclid=IwAR2cdm1GJ8bioPZULpN86LzDkRsRZt4F86IXcsMVjFUqsYx9VU86WPVPqtE"><i class="fa-brands fa-instagram fa-2x text-info"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container" style="z-index: 10">
    <h2 class="pb-2 text-center" style="font-weight: 700; color: #980799;">MapView</h2>
      <div class="row d-flex justify-content-center">
      <div class="col-md-6 maps">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.7810918999281!2d125.17543668168139!3d6.113954643943688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9f07f161a0b41f9e!2sBUDZ%20Laundry%20Hub!5e0!3m2!1sen!2sph!4v1650346111778!5m2!1sen!2sph" width="200" height="300" style="border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
<!-- Footer -->
<div class="footer-container border-top" style="color: #980799;">
      <h3 class="social-med-h3">Follow us on our Social Media Accounts</h3>
      <ul class="links-ul">
      <li>
          <a href="https://www.facebook.com/budzlaundryhub/" target="facebook">
            <img src="../assets/images/Footer/facebook.JPG" alt="" class="image-footer" />
          </a>
        </li>
        <li>
          <a href="https://www.instagram.com/budzlaundryhub/?fbclid=IwAR2cdm1GJ8bioPZULpN86LzDkRsRZt4F86IXcsMVjFUqsYx9VU86WPVPqtE" target="instagram"> 
            <img src="../assets/images/Footer/instagram.JPG" alt="" class="image-footer" />
          </a>
        </li>
        <li>
          <a href="mailto:budzlaundryhub@gmail.com" target="gmail">
            <img src="../assets/images/Footer/gmail.png" alt="" class="image-footer" />
          </a>
        </li>
      </ul>
      <footer class="py-2 my-4">
        <ul class="nav justify-content-center pb-3 mb-3">
        <li class="nav-item">
          <a href="home-page.php" class="nav-link px-2" style="color: #980799;">Home</a>
        </li>
        <li class="nav-item">
          <a href="service-and-pricing.php" class="nav-link px-2" style="color: #980799;">Services & Prices</a>
        </li>
        <li class="nav-item">
          <a href="contacts.php" class="nav-link px-2" style="color: #980799;">Contact</a>
        </li>
        <li class="nav-item">
          <a href="about-us.php" class="nav-link px-2" style="color: #980799;">About us</a>
        </li>
        <li class="nav-item">
          <a href="faqs.php" class="nav-link px-2" style="color: #980799;">FAQs</a>
        </li>
        </ul>
        <p class="text-center" style="color: #980799;">
          Copyright © 2022 Budz Laundry Hub, Inc. All Rights Reserved
        </p>
      </footer>
    </div>
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
  xmlhttp.open("GET", "code/notification-count.php?user_id=<?php echo $user_id; ?>&action=user");
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
  xmlhttp.open("GET", "code/notification-list.php?user_id=<?php echo $user_id; ?>&action=user");
  xmlhttp.send();
};
setInterval(function()
{
  notification_list();
}, 2000);
function clear_notif()
{
  action = '1';
  user_id = <?php echo $user_id; ?>;
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

</script>
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