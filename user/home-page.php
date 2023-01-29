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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <title>Budz Laundy Hub -  Home</title>
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
    <!-- Floating icon Section -->
    <nav class="side">
      <ul class="ulimage mb-0">
         <li class="hover_effect"><a href="https://www.facebook.com/budzlaundryhub/" target="facebook-profile" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/facebook.JPG" alt="" class="side-media"><span class="hoverp" style="color:#fff;">FACEBOOK</span></a></li>
         <li><a href="https://www.facebook.com/messages/t/2024978074490873" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/messenger.png" alt="" class="side-media"><span class="hoverp" style="color: #fff;">MESSENGER</span></a></li>
         <!--<li><a href="#" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/gmail.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">GMAIL</span></a></li>-->
      </ul>
   </nav>
    <!-- Homepage Section -->
    <br />
      <br />
      <br />
      <?php include 'message.php'; ?>
<!-- Buubbles -->
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
      <div class="container">
        <div class="row position-relative">
          <div class="col-sm pt-5 my-3 position-relative">
            <br />
            <br />
            <h2 class="pt-md-5">
              <span style="color: #34dcd4; font-size: 50px; font-weight: 600;">b<span style="color:#980799;">u</span>dz</span>
              <span style="color: #980799; font-size: 50px; font-weight: 600;">Laundry Hub</span>
            </h2>
            <p class="lead" style="color: #980799;">
              A dependable laundromat. We will take care of your laundry so
              that you Don't have to waste time doing it.
            </p>
            <?php
            $select = 'SELECT * FROM user_table WHERE user_id = 1';
            $select_run = mysqli_query($db, $select);
            if (mysqli_num_rows($select_run) > 0) {
                foreach ($select_run as $row) { ?>
            <button class="btn mt-3" id="button_reserve" style="position: relative; left: 0;"><a href="schedule-of-book.php" class="btn_sched" style="text-decoration: none; color: #fff;">
              BOOK NOW!
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin: 2px 2px 4px 15px;">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
              </svg>
            </a></button>
          </div>
          <div class="col-xl justify-content-center mt-5">
            <img src="../assets/images/Home-page/home-banner.png" alt="" class="img-fluid pb-5" />
          </div>
        </div>
      </div>
    </div>
<?php }
            }
            ?>
    <!-- Buddy Membership Deals -->
    <h2 class="container mb-5 text-center mt-5" style="font-weight: 700; color:#980799;">Buddy Membership Deals</h2>
        <div class="container">
          <div class="row">
            <div class="col-sm">
              <p class="lead text-center" style="color: #980799;">
              Budz Laundry Hub membership gives you access to exclusive offers and rewards. You will earn corresponding points and redeem exciting rewards as you avail of our laundry services. Using just one of these offers can save you more than the cost of your laundry expenses.
              </p>
            </div>
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-xs d-flex justify-content-center align-items-center">
                <li class="list-unstyled mx-5">
                  <img class="img_deals" src="../assets/images/Home-page/flow.png" alt="">
                </li>
            </div>
            <div class="col-xs d-flex justify-content-center align-items-center">
              <li class="list-unstyled mx-5">
                <img class="img_deals" src="../assets/images/Home-page/system_points.png" alt="">
              </li>
            </div> 
          </div>
        </div>
    <!-- How it Works Section -->
    <h2 class="container pt-5 text-center" style="font-weight: 700; color:#980799;">How it Works</h2>
    <div class="container col-xxl-8 px-4 pt-5">
      <div class="row flex-lg-row-reverse align-items-center d-flex justify-content-center g-5 py-3">
        <div class="col-10 col-sm-8 col-lg-6" >
          <img
            src="../assets/images/Home-page/register.png"
            class="d-block mx-lg-auto img-fluid"
            alt="Bootstrap Themes"
            width="400"
            height="300"
            loading="lazy"
          />
        </div>
        <div class="col-lg-6" style="color: #980799;">
          <h1 class="font-weight-bold lh-1 text-center" style="font-size: 30px; color: #980799;">
            Register
          </h1>
          <p class="lead text-center" id="hiw-paragraph">
              Create an Account to be a Member 
          </p>
        </div>
      </div>
    </div>
    <div class="container col-xxl-8 px-4">
      <div class="row align-items-center d-flex justify-content-center g-5">
        <div class="col-10 col-sm-8 col-lg-6" style="display: flex; justify-content: center;">
          <img
            src="../assets/images/Home-page/book.png"
            class="d-block img-fluid"
            alt="Bootstrap Themes"
            width="400"
            height="400"
            loading="lazy"
          />
        </div>
        <div class="col-lg-6" style="color: #980799">
          <h1 class="font-weight-bold lh-1 mb-3 text-center" style="font-size: 30px; color: #980799;">
              Reserve
          </h1>
          <p class="lead text-center" id="hiw-paragraph">
              Schedule preffered date and time to reserve a slot.
          </p>
        </div>
      </div>
    </div>
    <div class="container col-xxl-8 px-4 py-2">
      <div class="row flex-lg-row-reverse align-items-center d-flex justify-content-center g-5 py-3">
        <div class="col-10 col-sm-8 col-lg-6" style="display: flex; justify-content: center;">
          <img
            src="../assets/images/Home-page/hiw-image1.png"
            class="mx-lg-auto img-fluid d-flex justify-content-center"
            alt="Bootstrap Themes"
            width="150"
            height="150"
            loading="lazy"
          />
        </div>
        <div class="col-lg-6" style="color: #980799;">
          <h1 class="font-weight-bold text-center" style="font-size: 30px; color: #980799;">
              Notification
          </h1>
          <p class="lead text-center" id="hiw-paragraph">
              Check notification for more details and to be updated about your booking status.
          </p>
        </div>
      </div>
    </div>
    <div class="container col-xxl-8 px-4">
      <div class="row align-items-center d-flex justify-content-center g-5">
        <div class="col-10 col-sm-8 col-lg-6" style="display: flex; justify-content: center;">
          <img
            src="../assets/images/Home-page/points.png"
            class="d-block img-fluid"
            alt="Bootstrap Themes"
            width="300"
            height="300"
            loading="lazy"
          />
        </div>
        <div class="col-lg-6" style="color: #980799;">
          <h1 class="font-weight-bold lh-1 mb-3 text-center" style="font-size: 30px; color: #980799;">
            Points
          </h1>
          <p class="lead text-center" id="hiw-paragraph">
            End booking transaction to claim exclusive points and you're done.
          </p>
        </div>
      </div>
    </div>
    <!-- Testimonials Section -->
    <div id="testimonials" class="testimonials-cont">
      <h2 class="pb-2-testimonials text-center" style="font-weight: 700; color:#980799;">Testimonials</h2>
      <div
        class="t-container d-flex align-items-center justify-content-center position-relative flex-wrap"
      >
        <div class="card d-flex position-relative flex-column">
          <div class="imgContainer"><img src="../assets/images/Home-page/aila.png" /></div>
          <div class="content" style="color: #980799;">
          <div class="text-left my-2"><img src="../assets/images/Home-page/first_qoute.PNG"></div>
            <p>
              Nice place to wash nice assistant they text you when laundry is done, thank you!
            </p>
            <div class="text-right my-2"><img src="../assets/images/Home-page/second_qoute.PNG"></div>
            <h6>Maricel A.</h6>
          </div>
        </div>
        <div class="card d-flex position-relative flex-column">
          <div class="imgContainer"><img src="../assets/images/Home-page/estelle.png" /></div>
          <div class="content" style="color: #980799;">
          <div class="text-left my-2"><img src="../assets/images/Home-page/first_qoute.PNG"></div>
            <p>
              Comfortable place to do laundry with friendly staff
            </p >
            <div class="text-right my-2"><img src="../assets/images/Home-page/second_qoute.PNG"></div>
            <h6>Trixy E.</h6>
          </div>
        </div>
        <div class="card d-flex position-relative flex-column">
          <div class="imgContainer"><img src="../assets/images/Home-page/russele.png" /></div>
          <div class="content" style="color: #980799;">
          <div class="text-left my-2"><img src="../assets/images/Home-page/first_qoute.PNG"></div>
            <p class="fw-bolder">
              Very approachable and friendly.
            </p>
            <div class="text-right my-2"><img src="../assets/images/Home-page/second_qoute.PNG"></div>
            <h6>Michel E.</h6>
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
        <p class="text-center">
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
    }, 1000);
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
    }, 1000);
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
  