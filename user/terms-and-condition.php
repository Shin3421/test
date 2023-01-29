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
    <title>Budz Laundy Hub -  Terms and Conditions</title>
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
         <li class="hover_effect"><a href="https://www.facebook.com/budzlaundryhub/" target="facebook-profile" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/facebook.JPG" alt="" class="side-media"><span class="hoverp" style="color:#fff;">FACEBOOK</span></a></li>
         <li><a href="https://www.facebook.com/messages/t/2024978074490873" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/messenger.png" alt="" class="side-media"><span class="hoverp" style="color: #fff;">MESSENGER</span></a></li>
         <!--<li><a href="#" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/gmail.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">GMAIL</span></a></li>-->
      </ul>
   </nav>

   <!-- Terms and Conditions -->

   <h2 class="container text-center" style="font-weight: 700; color:#980799; padding-top:100px;">Terms and Conditions</h2>
   <div class="container">
        <div class="row">
            <div class="col-12" style="line-height: 30px;">
            <br>
            Your use of this site (creating an account, booking a service/schedule, account modification & management, submitting using our online forms, etc.) and/or any of the services of Budz Laundry Hub, as described/identified/provided in this website, is subject to ALL of the provisions of this Service Terms and Conditions, including all the associated Disclaimer, Booking Policy, Budz Earning  Points Policy, Redeem Rewards Policy, Budz Membership Policy, Cancellation/No Show Policy and Policy on Refunds & Damages, as well as all the Laundry Terms (Self-Service, Drop-Off /Full Service) contained herein.
            By using this website and/or any of the services of Budz Laundry Hub, as described/identified/provided in this site, you CERTIFY and AGREE that you have READ COMPLETELY, UNDERSTOOD CLEARLY, and CONCUR/ACCEPT FULLY all of the above-mentioned terms, conditions, policies and disclaimer.

            <br> <br>

<span style="color:#980799; font-weight:700;">BUDZ LAUNDRY HUB POLICY</span> <br> <br>

•	To provide you with quality service and ensure everyone's safety, please read and follow Budz Laundry Hub Rules and Policies. <br>
•	Please read and follow machine instruction when operating the machines. You may approach our laundry attendant for assistance. <br>
•	For safety reasons, children are not allowed to operate the laundry machines. Children must be restrained from touching or playing with the machines and should be supervised while in the shop. <br>
•	Prior to putting clothing/items in the machines, please check and ensure that no objects or any personal items are inside. <br>
•	No pets allowed inside the shop. <br>
•	Any items or garments that are being used by animals are not allowed in order to maintain hygienic and clean machines for the customers.<br>
•	Check machine first for any items inside before placing your own laundry items to avoid mixing of items of previous user should there be any left behind. <br>
•	Ensure that the laundry detergent, softener and bleaching solutions are properly placed in the machine.<br>
•	Ensure that the door of the machine is securely closed before starting it. If your items are fully covered in dirt, grease, sand or any other form of dirt, we request that you clean these items first until minimal dirt is only left. <br>
•	Any clothing/garment or items that are exposed in salt-water must be rinsed first by clean water before putting them in the machines. <br>
•	Ensure that all your clothes' pockets are empty before washing or drying. All pockets should be out before washing.<br>
•	Ensure that all garments with zipper and buttons are zipped and buttoned before washing. These are then to be unzipped and unbuttoned when drying. <br>
•	When using the dryer, clean the filter after every use. Brush cleaners are available for your use.<br>
•	Items that are brought for rinsing, spinning and drying only must already be cleaned. <br>
•	Do not leave clothes or items unattended. We are not responsible for any loss or damage.<br>
•	Customer will be charged for any damage to machines that are acquired during use that are due to negligence and carelessness.<br>





<br> <br>

<span style="color:#980799; font-weight:700;">BOOKING POLICY</span>  <br> <br>

•	Upon arrival at the shop, you must give or show your budz code, which is displayed in your profile account, to the staff to verify that you have booked a schedule for that day for fast and easy transactions. <br>
•	You can only book 1 schedule at a time. For example, you would like to book a schedule from 9:00 a.m. to 11:00 a.m. on November 29, 2022. If you want to add another time, they must book another time on that day. 
• Customer can use a maximum of two (2) machine slots per booking. <br>
 <br> <br>

<span style="color:#980799; font-weight:700;">BUDZ EARNING POINTS POLICY</span> <br> <br>

•	Budz Earning Points Rewards is a privilege for registered users as part of the Budz Membership program where they can earn points simply by booking and completing the transaction in the system. <br>
•	You can track and monitor all the points they earned by checking the Profile Account page on the website.  <br>
•	You can earn points per completed laundry transaction. <br>
•	Points are automatically added to the budz points when the booked laundry transaction is completed successfully.  <br>
•	The customer will receive a notification on how many points were given.   <br>
•	Rewards points are depending on the laundry service you purchased. The reward of points is based on the budz laundry hub points system. 
 <br> <br>

<span style="color:#980799; font-weight:700;">REDEEM REWARDS POLICY</span><br> <br>
<span style="display: flex; justify-content: center;">
•	You can redeem rewards by simply choosing laundry services they want to redeem. However, you must reach the minimum number of needed points for that particular laundry service before they can able to redeem a reward or service. <br>
•	Once you are already done selecting the laundry service, it is needed to book a schedule right after when will you use the laundry service you redeemed using your budz points.  <br>
Note: <br>
•	You will not receive any points if the booking has either been canceled or you didn't show up at the given waiting time.  <br>
•	The redeemed reward will expire if you do not arrive or show up on the date and time you book to use your redeemed rewards or service. <br>
• Budz Points can only be used to redeem any services offered by the company and not
be used for any payment-related transactions.

</span><br> <br>

<span style="color:#980799; font-weight:700;">BUDZ MEMBERSHIP POLICY</span><br> <br>

•	To be part of the Budz Membership program the customer must registered an account online using the system. <br>
•	Only registered customers in the website can receive and earn points. <br>
•	Only registered customers website can redeem rewards such as free laundry services. <br>
•	Only registered customers website can book a schedule. 
 <br> <br>

<span style="color:#980799; font-weight:700;">CANCELLATION/NO SHOW POLICY</span> <br> <br>

•	Cancellation of Booking Policy - The customer is allowed to modify/cancel the booking schedule by using the website. <br>
•	No-Show Policy - You must arrive on or before the booked schedule. Customers who booked a schedule have a 10–15-minute wait time; if they do not arrive within that time, their booked schedule will be canceled.
 <br> <br>

<span style="color:#980799; font-weight:700;">SELF-SERVICE LAUNDRY </span><br> <br>

Budz Laundry Hub has the right to receive or decline any self-service laundry.Declining
of this service is upon the discretion of the company with the basis on checking if
clothing/garment or item is suitable to be machine-washed and dried using the machine
dryer. Customer shall take all full responsibility in doing their laundry. Budz Laundry Hub
shall not be held liable should there be any damages incurred during the washing and drying
of clothing and/or garment by the customer/client. In addition,Budz Laundry Hub is not
responsible for clothing bleeding, shrinking or otherwise changing asaresult of normal
washing procedures. Precautions will be taken to avoid such problems to arise. Budz
Laundry Hub does not guarantee to remove all stains on clothing/garment or items as the
service provided is only for regular washing. Budz Laundry Hub is not liable for loss of or
damage to any personal or non-cleanable items that are left in clothing/garment or laundry. <br> <br>

<span style="color:#980799; font-weight:700;">FULL-SERVICE LAUNDRY</span><br> <br>

Budz Laundry Hub has the right to receive or decline any full service type of laundry. Declining of this service is upon the discretion of the company with the basis on checking if clothing/garment or item is suitable to be machine-washed and dried using the machine dryer. remove all stains Budz Laundry Hub will provide washing,drying and folding of items that are subjected for full-service. All items are to be listed and itemized to verify and confirm correct number of items to customer/client prior to fully receiving and washing. All listed items must be checked and verified by the customer/client prior to endorsing it to Budz Laundry Hub. Any damages that are found during checking of items shall not be the responsibility of the company should they be endorsed.Budz Laundry Hub does not guaranteet on clothing/garment or items as the service provided is only for regular washing. Budz Laundry Hub is not liable for loss of or damage to any personal or non-cleanable items that are left in clothing/garment or laundry bags/basket such as money,jewelry or any other item not limited to the previous mentioned.Customer/Client agrees not to leave such items/belongings in their clothing/garment and/or laundry bags or baskets.. The customer/client is responsible for any and all damage caused by any items left in the customer's clothing or laundry bag that causes damage to the clothing of machines of the company. Budz Laundry Hub does not read all safe care labels attached to the garment/item. This responsibility is solely up to the customer.Budz Laundry Hub is not to be in any way held liable for special care of any item.Budz Laundry Hub will not leave items to any other person that is not the owner of those items unless the owner has given prior consent <br> <br>

<span style="color:#980799; font-weight:700;">PAYMENT</span><br> <br> 

Budz Laundry Hub reserves the right to collect payment from customer/client prior to using the machines and availing the services. Failure to pay signifies that customer cannot avail or use any services of Budz Laundry Hub.Budz Laundry Hub does not accept promissory notes as collateral payment. Staggered payment is upon the discretion of Budz Laundry Hub. <br> <br>

<span style="color:#980799; font-weight:700;">REFUND</span> <br><br> 
Budz Laundry Hub does not issue any refund once service is already availed. In the event that incidents such as,but not limited to, power failure and machine error, Budz Laundry Hub has the discretion and right to provide refund or to continue availing the services paid if applicable.
<br> <br>


<span style="color:#980799; font-weight:700;">LOSS OR DAMAGE</span> <br><br> 
For Self-service Laundry,Budz Laundry Hub is not liable for any loss or damages on the items that were washed and/or dried by the customers/clients themselves. For Full Service Laundry,any damage or missing items must be reported within 24 hours upon pick-up or delivery of items.Failure to report within 24 hours shall remove any liability of Budz Laundry Hub for the missing or damaged item. In the event that any item is reported to be lost or damaged by the Budz Laundry Hub, the company will issue a refund or credit for the value of the item. For missing items, customer must present the job order of the service in order for Budz Laundry Hub to validate such loss. For damage items, if customer is able to provide proof of purchase of the item, Budz Laundry hub will provideafull refund based on the value stipulated in the proof of purchase. If customer is not able to provide proof of purchase, Budz Laundry Hub will refund or provide credit value based on the current market value of the item with consideration on the deprecation brought by age and usage. Bud Laundy Hub is not liable for any preexisting damage to garments. If any preexisting damage is found or there isaconcern about the colorfastness, or the age or weakness of the fabric, the company will contact the customer/client to obtain approval before proceeding to care for the item. If the company is unable to obtain authorization inatimely manner, then the item may be returned without cleaning it.
<br> <br>

<span style="color:#980799; font-weight:700;">CONFIDENTIALITY</span> <br><br> 
All information provided by the customer to Budz Laundry Hub, in connection to availing of services, including, but not limited to, any information with respect to the customer's privacy, is confidential and Budz Laundry Hub must not disclose such information to any third party without the prior written consent of the customer.
<br> <br>

<span style="color:#980799; font-weight:700;">Legal Disclaimer:</span> <br><br> 
The liability of Budz Laundry Hub under this Terms and Condition shall only be restricted to the monetary damages not to exceed the amount incurred by the customer/client for the service that have been provided within the transaction where the damages have transpired. This liability shall be the extent of Budz Laundry Hub liability regardless of the form in which any legal or equitable action may be brought and the foregoing shall constitute customer/client's exclusive remedy.In no event will Budz Laundry Hub be held liable or be responsible for any consequential, special, indirect,incidental or punitive loss or damages,whether or not the company knew or should have known of the likelihood of any such loss or damages.Budz Laundry Hub disclaims all warranties express or implied with respect to the services rendered under this agreement. Upon customer/client's authorization to avail of the services, the terms of this Agreement shall be binding. <br> For your comments, suggestions, or complaints, please approach any of our staff and contact us for a Customer Suggestion/Complain using our contact form which can be accessed on Our website. Please be assured that we take your feedback seriously and we will do the necessary actions to make our service better.
<br> <br>




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
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
   <script type="text/javascript" src="js/jquery.min.js"></script>
   
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



 
