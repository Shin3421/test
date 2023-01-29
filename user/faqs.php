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

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

   <title>Budz Laundy Hub - Frequently Ask Question</title>

</head>

<body>



  <!-- NavBar Section -->

  <div class="fixed-top">

    <nav class="navbar navbar-expand-lg navbar-light">

      <a class="navbar-brand" href="home-page.php">

        <img class="logo" src="../assets/images/Navigation Bar/LOGO.png" alt="" />

      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

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



      <!-- Floating icon Section -->

      <nav class="side">

      <ul class="ulimage mb-0">

        <li class="hover_effect">

          <a

            href="https://www.facebook.com/budzlaundryhub/"

            target="facebook-profile"

            class="hoverA text-decoration-none"

          >

            <img src="../assets/images/Navigation Bar/facebook.JPG" alt="" class="side-media" />

            <span class="hoverp" style="color: #fff;">FACEBOOK</span>

          </a>

        </li>

        <li>

          <a href="#" class="hoverA text-decoration-none">

            <img

              src="../assets/images/Navigation Bar/messenger.png"

              alt=""

              class="side-media"

            />

            <span class="hoverp" style="color: #fff;">MESSENGER</span>

          </a>

        </li>

        <li>

          <a href="#" class="hoverA text-decoration-none">

            <img src="../assets/images/Navigation Bar/gmail.JPG" alt="" class="side-media" />

            <span class="hoverp" style="color: #fff;">GMAIL</span>

          </a>

        </li>

      </ul>

    </nav>



<!-- FAQ's -->



<h2 class="container pt-5 text-center" style="font-weight: 700; margin-top: 50px; color:#980799">Frequently Ask Questions</h2>



<div id="accordion">

  <div class="card text-center mt-4">

    <div class="card-header" id="headingOne">

      <h5 class="mb-0">

        <button class="btn_faqs btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color:#980799; font-weight: 600; font-size: 20px; border-color: #ffffff00;">

          How do I get started or schedule my first book?

        </button>

      </h5>

    </div>



    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">

      <div class="card-body" style="color: #980799;">

        You can schedule your first book on our website (Budz website) on your mobile and desktop. <br>

        create your free account. Fill out your details to sign up. Once registration is complete, you can start booking your request for pick up.

      </div>

    </div>

  </div>

  <div class="card text-center mt-4">

    <div class="card-header" id="headingTwo">

      <h5 class="mb-0">

        <button class="btn_faqs btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color:#980799; font-weight: 600; font-size: 20px; border-color: #ffffff00;">

          What can I expect to happen in my first book? 

        </button>

      </h5>

    </div>

    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">

      <div class="card-body" style="color: #980799;">

        You will sign up for your registered account to proceed on our book page. <br>

        You will be a part of Budz laundry Hub and your personal data will be stored in our database system. <br>

        Our Budz laundry system has a feature, that every customer avail of our services in every transaction to gain loyalty points.

      </div>

    </div>

  </div>

  <div class="card text-center mt-4">

    <div class="card-header" id="headingThree">

      <h5 class="mb-0">

        <button class="btn_faqs btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="color:#980799; font-weight: 600; font-size: 20px; border-color: #ffffff00;">

          What are the basic services?

        </button>

      </h5>

    </div>

    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">

      <div class="card-body" style="color: #980799;">

        Budz laundry Hub offers full-Service and Self-Service. Full service offers cleaning, folding, and packing laundries. <br> In Self-service, the customer can walk in into the laundry shop, find a vacant washing machine, load their dirty laundry, and pay to use the machine by themselves.

      </div>

    </div>

  </div>

  <div class="card text-center mt-4">

    <div class="card-header" id="headingFour">

      <h5 class="mb-0">

        <button class="btn_faqs btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour" style="color:#980799; font-weight: 600; font-size: 20px; border-color: #ffffff00;">

          How to earn Budz points?

        </button>

      </h5>

    </div>



    <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion">

      <div class="card-body" style="color: #980799;">

        You can earn Budz loyalty points by booking in (www.Budz laundryhub.com). You can earn points for every booking transaction you complete.

      </div>

    </div>

  </div>

  <div class="card text-center mt-4">

    <div class="card-header" id="headingFive">

      <h5 class="mb-0">

        <button class="btn_faqs btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive" style="color:#980799; font-weight: 600; font-size: 20px; border-color: #ffffff00;">

          How to claim Budz points?

        </button>

      </h5>

    </div>



    <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordion">

      <div class="card-body" style="color: #980799;">

        Go to the shop claim your reward using your coupon code.

      </div>

    </div>

  </div>

   <div class="card text-center mt-4">

    <div class="card-header" id="headingSix">

      <h5 class="mb-0">

        <button class="btn_faqs btn-link" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix" style="color:#980799; font-weight: 600; font-size: 20px; border-color: #ffffff00;">

          Where can I view my transaction history?

        </button>

      </h5>

    </div>



    <div id="collapseSix" class="collapse show" aria-labelledby="headingSix" data-parent="#accordion">

      <div class="card-body" style="color: #980799;">

        You can view your transaction history HERE (localhost/Budz/user/edit-profile.php?id=4).

      </div>

    </div>

  </div> 

  <div class="card text-center mt-4">

    <div class="card-header" id="headingSeven">

      <h5 class="mb-0">

        <button class="btn_faqs btn-link" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven" style="color:#980799; font-weight: 600; font-size: 20px; border-color: #ffffff00;">

          How do I update my profile and password?

        </button>

      </h5>

    </div>



    <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven" data-parent="#accordion">

      <div class="card-body" style="color: #980799;">

        You can update your profile and password HERE (localhost/Budz/user/edit-password.php?id=4)

      </div>

    </div>

  </div>

  <div class="card text-center mt-4">

    <div class="card-header" id="headingEight">

      <h5 class="mb-0">

        <button class="btn_faqs btn-link" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight" style="color:#980799; font-weight: 600; font-size: 20px; border-color: #ffffff00;">

        Can’t find what you’re looking for?

        </button>

      </h5>

    </div>



    <div id="collapseEight" class="collapse show" aria-labelledby="headingEight" data-parent="#accordion">

      <div class="card-body" style="color: #980799;">

        You can contact <a href="contacts.php">HERE!</a> 

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

          <a href="index.php" class="nav-link px-2" style="color: #980799;">Home</a>

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