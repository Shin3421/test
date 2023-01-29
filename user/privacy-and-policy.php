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
    <title>Budz Laundy Hub -  Privacy policy</title>
  </head>
  <body>
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
              <a class="nav-link " href="index.php" style="color: #980799; font-size: 17px;">
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
         <li><a href="#" class="hoverA text-decoration-none"><img src="../assets/images/Navigation Bar/gmail.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">GMAIL</span></a></li>
      </ul>
   </nav>
   <h2 class="container text-center" style="font-weight: 700; color:#980799; padding-top:120px;">Privacy and Policy</h2> 
   <div class="container">
        <div class="row">
            <div class="col-sm-12" style="line-height: 35px;">
                <br><br>

               <span style="font-weight: 700; font-size: 28px; color:#980799;"> Privacy Policy for Budz Laundry Hub</span><br><br>
               <span style="color:#980799; font-weight:700;">PRIVACY POLICY</span> <br>
This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.
We use Your Personal data to provide and improve the Service. By using the Service, You agree to the collection and use of information in accordance with this Privacy Policy.

<br> <br>


<span style="color:#980799; font-weight:700;">Interpretation and Definitions</span><br>


<span style="color:#980799; font-weight:700;">Interpretation</span> <br><br>
The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.
<br> <br>

<span style="color:#980799; font-weight:700;">Definitions</span><br><br>
For the purposes of this Privacy Policy:
•	Account means a unique account created for You to access our Service or parts of our Service. <br>
•	Customer (reffered to aseither "the Customers, "You", "They", Their" in this Agreement) refers to the Budz Laundry Hub loyal, new and potential customers who access the website. <br>
•	Company (referred to as either "the Company", "We", "Us" or "Our" in this Agreement) refers to Budz Laundry Hub, 514 Lapu-Lapu St. Cor. Quirino, General Santos City.<br>
•	Cookies are small files that are placed on Your computer, mobile device or any other device by a website, containing the details of Your browsing history on that website among its many uses.<br>
•	Country refers to: Philippines<br>
•	Device means any device that can access the Service such as a computer, a cellphone or a digital tablet.<br>
•	Personal Data is any information that relates to an identified or identifiable individual.<br>
•	Service refers to the Website.<br>
•	Service Provider means any natural or legal person who processes the data on behalf of the Company. It refers to third-party companies or individuals employed by the Company to facilitate the Service, to provide the Service on behalf of the Company, to perform services related to the Service or to assist the Company in analyzing how the Service is used.<br>
•	Usage Data refers to data collected automatically, either generated using the Service or from the Service infrastructure itself (for example, the duration of a page visit).<br>
•	Website refers to Budz Laundry Hub, accessible from www.budzlaundry.com<br>
•	You mean the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.<br>

<br><br>
<span style="color:#980799; font-weight:700;">Collecting and Using Your Personal Data</span><br><br>
Types of Data Collected
Personal Data
While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You. Personally identifiable information may include, but is not limited to:<br>
•	Email address<br>
•	First name and last name<br>
•	Phone number<br>
•	Address, State, Province, ZIP/Postal code, City

<br><br>

<span style="color:#980799; font-weight:700;">Usage Data</span><br><br>
Usage Data is collected automatically when using the Service.
Usage Data may include information such as Your Device's Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that You visit, the time and date of Your visit, the time spent on those pages, unique device identifiers and other diagnostic data.
When You access the Service by or through a mobile device, We may collect certain information automatically, including, but not limited to, the type of mobile device You use, Your mobile device unique ID, the IP address of Your mobile device, Your mobile operating system, the type of mobile Internet browser You use, unique device identifiers and other diagnostic data.
We may also collect information that Your browser sends whenever You visit our Service or when You access the Service by or through a mobile device.

<br><br>
<span style="color:#980799; font-weight:700;">Tracking Technologies and Cookies</span><br><br>
We use Cookies and similar tracking technologies to track the activity on Our Service and store certain information. Tracking technologies used are beacons, tags, and scripts to collect and track information and to improve and analyze Our Service. The technologies We use may include:<br>
•	Cookies or Browser Cookies. A cookie is a small file placed on Your Device. You can instruct Your browser to refuse all Cookies or to indicate when a Cookie is being sent. However, if You do not accept Cookies, You may not be able to use some parts of our Service. Unless you have adjusted Your browser setting so that it will refuse Cookies, our Service may use Cookies.<br>
•	Flash Cookies. Certain features of our Service may use local stored objects (or Flash Cookies) to collect and store information about Your preferences or Your activity on our Service. Flash Cookies are not managed by the same browser settings as those used for Browser Cookies.<br>
•	Web Beacons. Certain sections of our Service and our emails may contain small electronic files known as web beacons (also referred to as clear gifs, pixel tags, and single-pixel gifs) that permit the Company, for example, to count users who have visited those pages or opened an email and for other related website statistics (for example, recording the popularity of a certain section and verifying system and server integrity).<br>
•	Cookies can be "Persistent" or "Session" Cookies. Persistent Cookies remain on Your personal computer or mobile device when You go offline, while Session Cookies are deleted as soon as You close Your web browser. <br>
We use both Session and Persistent Cookies for the purposes set out below:<br>

•	Necessary / Essential Cookies<br>
Type: Session Cookies
Administered by: Us
Purpose: These Cookies are essential to provide You with services available through the Website and to enable You to use some of its features. They help to authenticate users and prevent fraudulent use of user accounts. Without these Cookies, the services that You have asked for cannot be provided, and We only use these Cookies to provide You with those services.
•	Cookies Policy / Notice Acceptance Cookies<br>
Type: Persistent Cookies
Administered by: Us
Purpose: These Cookies identify if users have accepted the use of cookies on the Website.
•	Functionality Cookies<br>
Type: Persistent Cookies
Administered by: Us
Purpose: These Cookies allow us to remember choices You make when You use the Website, such as remembering your login details or language preference. The purpose of these Cookies is to provide You with a more personal experience and to avoid You having to re-enter your preferences every time You use the Website.
For more information about the cookies, we use and your choices regarding cookies, please visit our Cookies Policy or the Cookies section of our Privacy Policy.

<br><br>

<span style="color:#980799; font-weight:700;">Use of Your Personal Data</span><br><br>
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
The Company may use Personal Data for the following purposes:
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
To provide and maintain our Service, including monitoring the usage of our Service.
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
To manage Your Account: to manage Your registration as a user of the Service. The Personal Data You provide can give You access to different functionalities of the Service that are available to You as a registered user.
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
For the performance of a contract: the development, compliance and undertaking of the purchase contract for the products, items or services You have purchased or of any other contract with Us through the Service.
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
To contact You: To contact You by email, telephone calls, SMS, or other equivalent forms of electronic communication, such as a mobile application's push notifications regarding updates or informative communications related to the functionalities, products or contracted services, including the security updates, when necessary or reasonable for their implementation.
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
To provide You with news, special offers and general information about other goods, services and events which we offer that are similar to those that you have already purchased or enquired about unless You have opted not to receive such information.
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
To manage Your requests: To attend to and manage Your requests to Us.
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
For business transfers: We may use Your information to evaluate or conduct a merger, divestiture, restructuring, reorganization, dissolution, or another sale or transfer of some or all of Our assets, whether as a going concern or as part of bankruptcy, liquidation, or similar proceeding, in which Personal Data held by Us about our Service users is among the assets transferred.
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
For other purposes: We may use Your information for other purposes, such as data analysis, identifying usage trends, determining the effectiveness of our promotional campaigns and to evaluate and improve our Service, products, services, marketing and your experience.
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
We may share Your personal information in the following situations:
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
•	With Service Providers: We may share Your personal information with Service Providers to monitor and analyze the use of our Service, to contact You. <br> For business transfers: We may share or transfer Your personal information in connection with, or during negotiations of, any merger, sale of Company assets, financing, or acquisition of all or a portion of Our business to another company.
•	With Affiliates: We may share Your information with Our affiliates, in which case we will require those affiliates to honor this Privacy Policy. Affiliates include Our parent company and any other subsidiaries, joint venture partners or other companies that We control or that are under common control with Us.<br>
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
•	With business partners: We may share Your information with Our business partners to offer You certain products, services or promotions.<br>
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>
•	With other users: when You share personal information or otherwise interact in the public areas with other users, such information may be viewed by all users and may be publicly distributed outside.<br>
•	With Your consent: We may disclose Your personal information for any other purpose with Your consent.<br>

<br><br>

<span style="color:#980799; font-weight:700;">Retention of Your Personal Data</span><br><br>
The Company will retain Your Personal Data only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use Your Personal Data to the extent necessary to comply with our legal obligations (for example, if we are required to retain your data to comply with applicable laws), resolve disputes, and enforce our legal agreements and policies.
The Company will also retain Usage Data for internal analysis purposes. Usage Data is generally retained for a shorter period of time, except when this data is used to strengthen the security or to improve the functionality of Our Service, or We are legally obligated to retain this data for longer time periods.

<br><br>
<span style="color:#980799; font-weight:700;">Transfer of Your Personal Data</span> <br><br>
Your information, including Personal Data, is processed at the Company's operating offices and in any other places where the parties involved in the processing are located. It means that this information may be transferred to — and maintained on — computers located outside of Your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from Your jurisdiction.
Your consent to this Privacy Policy followed by Your submission of such information represents Your agreement to that transfer.
The Company will take all steps reasonably necessary to ensure that Your data is treated securely and in accordance with this Privacy Policy and no transfer of Your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of Your data and other personal information.

<br><br>

<span style="color:#980799; font-weight:700;">Disclosure of Your Personal Data</span> 
<br><br>
<span style="color:#980799; font-weight:700;">Business Transactions</span> <br><br>
If the Company is involved in a merger, acquisition or asset sale, Your Personal Data may be transferred. We will provide notice before Your Personal Data is transferred and becomes subject to a different Privacy Policy.
<br><br>
<span style="color:#980799; font-weight:700;">Law enforcement</span> <br><br>
Under certain circumstances, the Company may be required to disclose Your Personal Data if required to do so by law or in response to valid requests by public authorities (e.g. a court or a government agency).
<br><br>
<span style="color:#980799; font-weight:700;">Other legal requirements</span> <br><br>
The Company may disclose Your Personal Data in the good faith belief that such action is necessary to: <br>
•	Comply with a legal obligation <br>
•	Protect and defend the rights or property of the Company<br>
•	Prevent or investigate possible wrongdoing in connection with the Service<br>
•	Protect the personal safety of Users of the Service or the public<br>
•	Protect against legal liability<br>

<br>
<span style="color:#980799; font-weight:700;">Security of Your Personal Data</span> <br><br>
The security of Your Personal Data is important to Us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While We strive to use commercially acceptable means to protect Your Personal Data, We cannot guarantee its absolute security.
<br><br>
<span style="color:#980799; font-weight:700;">Children's Privacy</span> <br><br>
Our Service does not address anyone under the age of 13. We do not knowingly collect personally identifiable information from anyone under the age of 13. If You are a parent or guardian and You are aware that Your child has provided Us with Personal Data, please contact Us. If We become aware that We have collected Personal Data from anyone under the age of 13 without verification of parental consent, We take steps to remove that information from Our servers.
If We need to rely on consent as a legal basis for processing Your information and Your country requires consent from a parent, We may require Your parent's consent before We collect and use that information.

<br><br>
<span style="color:#980799; font-weight:700;">Links to Other Websites</span> <br><br>
Our Service may contain links to other websites that are not operated by Us. If You click on a third party link, You will be directed to that third party's site. We strongly advise You to review the Privacy Policy of every site You visit.
We have no control over and assume no responsibility for the content, privacy policies or practices of any third-party sites or services.

<br><br>

<span style="color:#980799; font-weight:700;">Changes to this Privacy Policy</span> <br><br>
We may update Our Privacy Policy from time to time. We will notify You of any changes by posting the new Privacy Policy on this page.
We will let You know via email and/or a prominent notice on Our Service, prior to the change becoming effective and update the "Last updated" date at the top of this Privacy Policy.
You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.

<br><br>
              
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
            <a href="index.php" style="color: #980799;" class="nav-link px-2">Home</a>
          </li>
          <li class="nav-item">
            <a href="service-and-pricing.php" style="color: #980799;" class="nav-link px-2">Services & Prices</a>
          </li>
          <li class="nav-item">
            <a href="contacts.php" style="color: #980799;" class="nav-link px-2">Contact</a>
          </li>
          <li class="nav-item">
            <a href="aboutus.php" style="color: #980799;" class="nav-link px-2">About us</a>
          </li>
          <li class="nav-item">
            <a href="faqs.php" style="color: #980799;" class="nav-link px-2">FAQs</a>
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
  