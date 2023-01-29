<?php
session_start();
include('../connection.php');
include('../assets/time.php');
if(!isset($_SESSION['email'])){
  $_SESSION['error_alert'] = "You are not registered yet!";
  header("Location: ../login.php");
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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Budz Laundry Hub - Schedule first book</title>
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
    <link rel="stylesheet" href="../assets/css/schedule_of_book.css" />
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
    <!--  -->
		<link rel="stylesheet" href="../assets/css/CalendarPicker.style.css">
    <link rel="stylesheet" href="../assets/css/style.css">

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


  <script>
    $(document).ready(function(){
        $("#noShow_policy").modal('show');
    });
    </script>

<!-- Modal -->
<div class="modal fade" id="noShow_policy" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(255 212 255)">
        <h4 class="modal-title" id="staticBackdropLabel" >WELCOME MESSAGE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Welcome to Budz Laundry Hub!</label>
        <div class="row">
          <div class="col">
          • Upon arrival at the shop, please present your Budz code to the staff, which is displayed in your profile account, to verify that you booked a schedule for that day.
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
          •	No-Show Policy - You must arrive on or before the booked schedule. Customers who booked a schedule have a 10–15-minute wait time; if they do not arrive within that time, their booked schedule will be canceled.
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
          •	Wear your face mask at all times and observe proper COVID-19 etiqutte.
          </div>
        </div>
   
        <div class="row mt-2">
          <div class="col">
          Thank you and happy washing!
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info"  data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
    <!-- Navigation Bar Section -->
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.php">
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
<!-- Modal -->
<div class="modal show in" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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
              $notification_lists = $db->query("SELECT A.*, B.* FROM notification_table as A INNER JOIN user_table as B ON A.sender_id = B.user_id WHERE reciever_id = '$user_id' ORDER BY notif_created ASC");
              if($notification_lists->num_rows > 0)
              {
                while($row = mysqli_fetch_array($notification_lists))
                {
                  if($row['notif_status'] === '0')
                  {
                    ?>
                  <li class="message-cont mt-2 mr-2 ml-2 p-2">
                  <a><?= $row['fname'] ?></a>
                  <a style="font-size: 13px; word-break: break-word; "><?= $row['notif_message'] ?></a>
                  <span style="font-size: 10px;"><?= getDateTimeDiff($row['notif_created']) ?></span>
              </li>
                    <?php
                  }else{
                    ?>
                  <li class="message-content-read mt-2 mr-2 ml-2 p-2" id="notif_list">
                  <a><?= $row['fname'] ?></a>
                  <a style="font-size: 13px; word-break: break-word; "><?= $row['notif_message'] ?></a>
                  <span style="font-size: 10px;"><?= getDateTimeDiff($row['notif_created']) ?></span>
              </li>
                    <?php
                  }
                }
               }else{
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
        <!--<li>-->
        <!--  <a href="#" class="hoverA text-decoration-none">-->
        <!--    <img src="../assets/images/Navigation Bar/gmail.JPG" alt="" class="side-media" />-->
        <!--    <span class="hoverp" style="color: #fff;">TWITTER</span>-->
        <!--  </a>-->
        <!--</li>-->
      </ul>
    </nav>
    <br />
      <br />
      <br />
    <!-- Reserve -->
      <div class="container mt-5">
        <h2 class="pb-1 text-center" style="font-weight: 700; color: #980799; ">
        Reserve Time Slot</h2>
<!-- calendar -->
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
      </div>
    <div class="container text-center" id="slideshow_id">
    <h2 class="mt-5" style="font-size: 30px; padding-bottom: 10px; color:#980799; font-weight: 700;">Updates</h1>
    <div class="row">
      <div class="col-md">
      <div class="slideshow-container d-flex justify-content-center align-items-center mt-5">
            <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="../assets/images/schedule&zipcode/own_pic.png" style="width:70%; height: 100%; box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px,
            rgba(0, 0, 0, 0.05) 0px 5px 10px;">
        </div>
            <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="../assets/images/schedule&zipcode/update.png" style="width: 50%; height: 50%; box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px,
        rgba(0, 0, 0, 0.05) 0px 5px 10px;">
        </div>
            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="../assets/images/schedule&zipcode/calumpang_branch.jpg" style="width:50%; box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px,
                rgba(0, 0, 0, 0.05) 0px 5px 10px;">
          </div>
        </div>
          <br>
            <div style="text-align:center">
              <span class="dot"></span> 
              <span class="dot"></span> 
              <span class="dot"></span> 
          </div>
        </div>
      </div>
    </div>
        <div class="footer-container border-top" style="color:#980799;">
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
          &copy; Copyright © 2022 PowerWash Laundromat, Inc. All Rights Reserved
        </p>
      </footer>
    </div>
    <!-- slides -->
        <script>
            let slideIndex = 0;
            showSlides();
            function showSlides() {
              let i;
              let slides = document.getElementsByClassName("mySlides");
              let dots = document.getElementsByClassName("dot");
              for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
              }
              slideIndex++;
              if (slideIndex > slides.length) {slideIndex = 1}    
              for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex-1].style.display = "block";  
              dots[slideIndex-1].className += " active";
              setTimeout(showSlides, 2000); // Change image every 2 seconds
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

		<!-- Bootstrap Core JS -->
		<!-- Custom JS -->
		<script src="../assets/js/script.js"></script>
        <script src="../assets/js/CalendarPicker.js"></script>
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
    datatype: "json",
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
<!-- calendar -->
<script type="text/javascript">
			function Disable(){
        document.getElementById("services").style.display = "block";
				document.getElementById("btn_book_submit").disabled = false;
			}
		</script>
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
                    xmlhttp.open("GET", "schedule.php?user=<?php echo $user_id; ?>&week=" + (myCalender.value.getDay() + 1) + "&date=" + (myCalender.value.getFullYear() + '-' + (myCalender.value.getMonth() + 1) + '-' + myCalender.value.getDate()), true);
xmlhttp.send();
});
$('#booking_form').submit(function(e)
{
  e.preventDefault();
  action = 2;
  user_id = $("input[name='user_id']").val();
  schedule = $("input[name='schedule']:checked").val();
  service_type = $("#service_type").val();
  machine_used = $("#machine_used").val();
  date = $("input[name='date']").val();
  $.ajax({
    url: "code/function.php",
    type: "POST",
    data: {
      user_id: user_id,
      schedule: schedule,
      service_type: service_type,
      date: date,
      machine_used: machine_used,
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
    },
  });
});
</script>
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
    function showShow()
    {
      $("#notif_modal").modal("show");
    }
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
  