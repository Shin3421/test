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

<!DOCTYPE html>

<html lang="en">



<head>

  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Budz Laundry Hub - Services & Price</title>



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

   <link rel="stylesheet" href="../assets/css/serviceandpricing.css" />

    <script type="text/javascript" src="js/jquery.min.js"></script>



    <!-- Hover CSS -->

    <link rel="stylesheet" 

    href="hover/hover-min.css"/>

    <link rel="stylesheet" 

    href="hover/hover.css"/>

    

    <link rel="Webpage icon" type="device-icon/png" href="../assets/images/Navigation Bar/LOGO.png" />



    <style>

      @media only screen and (max-width: 991px) {

        #serviceandpricingbanner {

            display: none;

        }

      }

    </style>
    <style>
      .menu-notification {
    height: 650%;
    width: 295%;
    overflow-y: auto;
    background: #ffeffe;
    border-radius: 15px;
}

.menu-top-header {
    padding-right: 15px;
    padding-left: 15px;
    font-size: 14px;
    line-height: 40px;
}

.clear-noti {
    float: right;
    color: #9515f6;
    text-transform: uppercase;
    font-size: 13px;
}

.message-cont {
    padding-left: 15px;
    background: #FFFFFF;
    margin: 5px 5px 5px 5px;
    display: grid;
    border-radius: 10px;
    transition: color .3s ease-in-out, box-shadow .3s ease-in-out;
}

.message-cont:hover {
    box-shadow: inset 350px 0 0 0 #ffe1ff;
}

.message-content-read {
    padding-left: 15px;
    background: #ffe1ff;
    margin: 5px 5px 5px 5px;
    display: grid;
    border-radius: 10px;
    transition: color .3s ease-in-out, box-shadow .3s ease-in-out;
}


/*.message-content:hover {
    background: #f0c0ea;
}
*/

.mess-list {
    display: grid;
    margin-top: 10px;
}

.notif-message {
    text-align: center;
    margin-top: 15px;
}

.shake {
    animation: shake-animation 3s ease infinite;
    transform-origin: 50% 50%;
}
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

@keyframes shake-animation {
    0% {
        transform: translate(0, 0)
    }
    1.78571% {
        transform: translate(5px, 0)
    }
    3.57143% {
        transform: translate(0, 0)
    }
    5.35714% {
        transform: translate(5px, 0)
    }
    7.14286% {
        transform: translate(0, 0)
    }
    8.92857% {
        transform: translate(5px, 0)
    }
    10.71429% {
        transform: translate(0, 0)
    }
    100% {
        transform: translate(0, 0)
    }
}
      </style>
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

              <a class="nav-link " href="../user/home-page.php" style="color: #980799; font-size: 17px;">

                Home

                <span class="sr-only">(current)</span>

              </a>

            </li>

            <li class="nav-item">

              <a class="nav-link" href="../user/service-and-pricing.php" style="color: #980799; font-size: 17px;">

                Services & Prices

              </a>

            </li>

            <li class="nav-item">

              <a class="nav-link " href="../user/contacts.php" style="color: #980799; font-size: 17px;">

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

<?php include 'message.php'; ?>

  <!-- Floating icon Section -->



  <nav class="side">

    <ul class="ulimage mb-0">

      <li class="hover_effect"><a href="https://www.facebook.com/budzlaundryhub/" target="facebook-profile" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/facebook.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">FACEBOOK</span></a></li>



      <li><a href="#" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/messenger.png" alt="" class="side-media"><span class="hoverp" style="color: #fff;">MESSENGER</span></a></li>



      <!--<li><a href="#" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/gmail.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">GMAIL</span></a></li>-->

    </ul>

  </nav>



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



  <!-- Services introduction  -->



  <div class="container col-xxl-8" style="margin-top: 100px;">

    <div class="row flex-lg-row-reverse align-items-center py-5">

      <div id="serviceandpricingbanner" class="col-10 col-sm-8 col-lg-6 mt-5">

        <img src="../assets/images/Services & Pricing/gif_snp.gif" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="500" height="500" loading="lazy" />

      </div>

      <div class="col-lg-6">

        <h1 class="display-5 fw-bold lh-1 mb-3"> <span class="superwash_highlight">b<span class="laundromat_highlight">u</span>dz</span> <span class="laundromat_highlight">Laundry Hub</span></h1>

        <p class="lead" style="text-align:justify; color: #980799;">

          budz Laundry Hub provides effortless Reserving and scheduling that will help to be more productive and save your time.

        </p>

        <button class="btn" id="button_reserve" style="position: relative; left: 0;"><a href="schedule-of-book.php" class="" style="text-decoration: none; color: #fff; flex-direction: row-reverse;">

           BOOK NOW!

            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin: 2px 2px 4px 15px;">

              <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />

            </svg>

          </a></button>

      </div>

    </div>

  </div>



  <!-- Services and Pricing Description -->

  <h2 class="pb-2 text-center" style="font-weight: 700; color:#980799;"> Services </h2>



  <div class="container">

  <div id="accordion" style="display: flex; width: 100%; justify-content: center; align-items: center; flex-direction: column-reverse;">

    

    <div class="card">

      <div class="card-header" id="headingTwo" style="background: #00c5ce;">

        <h5 class="SandB_title mb-0">

          <button class="btn_SandP_collapse" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color:#fff">

            Full-Service Laundry

          </button>

        </h5>

      </div>

      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">

        <div class="text-center mx-5 py-5" style="color:#980799;">

          Budz Laundry Hub offers full service so there is no need for you to do anything except drop off your laundry at the shop. Full Service offers clean, fold and pack your laundries. We take the hassle out of getting your clothes back to you by washing, drying, folding that make it very helpful for working moms and busy professionals who value their time and effort at an affordable price.

        </div>



        <!-- <div class="container text-center mb-3">

          <h5 class="text-center font-weight-bolder" style="color: #980799;">Process Flow</h5>

          <img src="assets/images/Services & Pricing/process_guide.png" width="600" alt="">

        </div> -->





        <div class="container">

          <div class="row d-flex justify-content-center">

            <div class="col-md-6">

              <div class="deal-bottom">

              <div class="text-center font-weight-bolder p-2" style="background-color: #ffeffe;"><span style="font-size: 20px; color: #980799;">Wash And Dry</span></div>

              <ul class="deal-item" style="color: #980799;">

                  <li class="">

                    <div class="container">

                      <div class="row">

                        <div class="col-sm text-center font-weight-bold" style="color: #980799;">

                        Regular Clothes (T-shirt, polo, shorts, dress, pillow case, under garments, etc).

                        </div>

                        <div class="col-sm text-center d-flex justify-content-center align-items-center">

                        <h2 class="font-weight-bolder" style="color:#00c5ce;">₱35</h2>

                        </div>

                      </div>

                    </div>

                  </li>

                  <li class="">

                    <div class="container">

                      <div class="row">

                        <div class="col-sm text-center font-weight-bold" style="color: #980799;">

                        Jeans, Towels (Blankets, jackets, sweaters, bedsheets).

                        </div>

                        <div class="col-sm text-center d-flex justify-content-center align-items-center">

                        <h2 class="font-weight-bolder" style="color:#00c5ce;">₱55</h2>

                        </div>

                      </div>

                    </div>

                  </li>

                  <li class="">

                    <div class="container">

                      <div class="row">

                        <div class="col-sm text-center font-weight-bold" style="color: #980799;">

                        Comforters (Curtains, seat covers).

                        </div>

                        <div class="col-sm text-center d-flex justify-content-center align-items-center">

                        <h2 class="font-weight-bolder" style="color:#00c5ce;">₱75</h2>

                        </div>

                      </div>

                    </div>

                  </li>

                </ul>

                <br>

              </div>

            </div>

          </div>

        </div>

        <div class="container text-center">

            <div class="btn-area">

              <a id="btn_serviceNprice" type="button" class="font-weight-bold text-light rounded" href="schedule-of-book.php">Book Now</a>

            </div>

        </div>



      </div>

    </div>





    <div class="card">

      <div class="card-header" id="headingOne" style="background: #00c5ce;">

        <h5 class="SandB_title mb-0">

          <button type="button" class="btn_SandP_collapse" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color:#fff;">

            Self-Service Laundry

          </button>

        </h5>

      </div>



      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">

        <div class="text-center mx-5 py-5" style="color: #980799;">

          Budz Laundry Hub offers self-service laundry services; where our value customers can just pop into the laundry shop, find a vacant washing machine, load their dirty laundry, and pay to use the machine by themselves. Budz Laundry Hub are equipped with the finest washing machines and dryers that are easy to use; this make it easy for anyone to wash or dry their own laundry and frees you up to enjoy more time to do more of what you love that saves time and money.

        </div>



        <div class="container text-center mb-3">

          <h5 class="text-center font-weight-bolder" style="color: #980799;">Process Flow</h5>

          <img src="../assets/images/Services & Pricing/process_guide.png" class="img-fluid" width="600" alt="">

        </div>







        <div class="container">

          <div class="row">

            <div class="col-md-6">

              <div class="deal-bottom">

              <div class="text-center font-weight-bolder p-2 rounded" style="background-color: #ffeffe;"><span style="font-size: 20px; color: #980799;">Dry</span></div>

              <ul class="deal-item" >

                  <li class="">

                    <div class="container">

                      <div class="row">

                        <div class="col-sm text-center font-weight-bold" style="color: #980799;">

                        40 minutes <br> Ideal for comforters and thick fabric

                        </div>

                        <div class="col-sm text-center d-flex justify-content-center align-items-center">

                        <h2 class="font-weight-bolder" style="color:#00c5ce;">₱60</h2>

                        </div>

                      </div>

                    </div>

                  </li>

                  <li class="">

                    <div class="container">

                      <div class="row">

                        <div class="col-sm text-center font-weight-bold" style="color: #980799;">

                        30 minutes <br>Ideal for regular and medium heavy 7kgs and below

                        </div>

                        <div class="col-sm text-center d-flex justify-content-center align-items-center">

                        <h2 class="font-weight-bolder" style="color:#00c5ce;">₱45</h2>

                        </div>

                      </div>

                    </div>

                  </li>

                  <li class="">

                    <div class="container">

                      <div class="row">

                        <div class="col-sm text-center font-weight-bold" style="color: #980799;">

                        10 minutes add on Drying Time 

                        </div>

                        <div class="col-sm text-center d-flex justify-content-center align-items-center">

                        <h2 class="font-weight-bolder" style="color:#00c5ce;">₱15</h2>

                        </div>

                      </div>

                    </div>

                  </li>

                </ul>

                <br>

              </div>

            </div>

            <div class="col-md-6">

              <div class="deal-bottom">

              <div class="text-center font-weight-bolder p-2 rounded" style="font-size: 20px; color: #980799; background-color: #ffeffe;">Wash</div>

                <ul class="deal-item">

                  <li class="">

                    <div class="container">

                      <div class="row">

                        <div class="col-sm text-center font-weight-bold" style="color: #980799;">

                        Regular Wash<br>(35min per load, 8kgs max)

                        </div>

                        <div class="col-sm text-center d-flex justify-content-center align-items-center">

                        <h2 class="font-weight-bolder" style="color:#00c5ce;">₱65</h2>

                        </div>

                      </div>

                    </div>

                  </li>

                  <li class="">

                    <div class="container">

                      <div class="row">

                        <div class="col-sm text-center font-weight-bold" style="color: #980799;">

                        Super Wash<br>(45min per load, 8kgs max)

                        </div>

                        <div class="col-sm text-center d-flex justify-content-center align-items-center">

                        <h2 class="font-weight-bolder" style="color:#00c5ce;">₱85</h2>

                        </div>

                      </div>

                    </div>

                  </li>

                </ul>

              </div>

            </div>

          </div>

        </div>

        <div class="container text-center">

            <div class="btn-area">

              <a id="btn_serviceNprice" type="button" class="font-weight-bold text-light rounded" href="schedule-of-book.php">Book Now</a>

            </div>

        </div>

      </div>

    </div>

  </div>

  </div>

  

<!-- Footer -->



  <div class="footer-container border-top">

    <h3 class="social-med-h3" style="color: #980799;">Follow us on our Social Media Accounts</h3>

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

      <ul class="nav justify-content-center pb-3 mb-3" style="color: #980799;">

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




 