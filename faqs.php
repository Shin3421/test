<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"
    />
    
    <!-- CSS File and Fonts-->
    <link rel="stylesheet" 
    href="assets/css/font-awesome.min.css">
    <link
     href="assets/css/poppins.min.css"
     rel="stylesheet"
   />
   <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/faqs.css" />

    <link
       rel="Webpage icon"
       type="device-icon/png"
       href="assets/images/Navigation Bar/LOGO.png"
     />
   <title>Budz Laundy Hub - Frequently Ask Question</title>
</head>
<body>

  <!-- NavBar Section -->
  <div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="index.php">
        <img class="logo" src="assets/images/Navigation Bar/LOGO.png" alt="" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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


          <a href="login.php">
         <button type="button" class="btn .sign" style="color: #ffffff;">
            Sign in<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16" style="margin: 0px 0px 1.5px 5px;">
              <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
              <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg></button>
          </a>

      </div>
      </ul>
      </nav>
  </div>

      <!-- Floating icon Section -->
      <nav class="side">
      <ul class="ulimage mb-0">
        <li class="hover_effect">
          <a
            href="https://www.facebook.com/budzlaundryhub/"
            target="facebook-profile"
            class="hoverA text-decoration-none"
          >
            <img src="assets/images/Navigation Bar/facebook.JPG" alt="" class="side-media" />
            <span class="hoverp" style="color: #fff;">FACEBOOK</span>
          </a>
        </li>
        <li>
          <a href="#" class="hoverA text-decoration-none">
            <img
              src="assets/images/Navigation Bar/messenger.png"
              alt=""
              class="side-media"
            />
            <span class="hoverp" style="color: #fff;">MESSENGER</span>
          </a>
        </li>
        <li>
          <a href="#" class="hoverA text-decoration-none">
            <img src="assets/images/Navigation Bar/gmail.JPG" alt="" class="side-media" />
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
            <img src="assets/images/Footer/facebook.JPG" alt="" class="image-footer" />
          </a>
        </li>
        <li>
          <a href="https://www.instagram.com/budzlaundryhub/?fbclid=IwAR2cdm1GJ8bioPZULpN86LzDkRsRZt4F86IXcsMVjFUqsYx9VU86WPVPqtE" target="instagram"> 
            <img src="assets/images/Footer/instagram.JPG" alt="" class="image-footer" />
          </a>
        </li>
        <li>
          <a href="mailto:budzlaundryhub@gmail.com" target="gmail">
            <img src="assets/images/Footer/gmail.png" alt="" class="image-footer" />
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
    <script type="text/javascript" src="assets/js/fontawesome.min.js"></script>
    <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="assets/js/slim.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
</body>
</html>

 <!-- signup form modal -->

<div class="modal fade" id="register_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle">Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="container">
      <div class="row" style="display: flex; justify-content: flex-end; margin: 20px 15px 0px 0px; font-size: 12px; color: red;">
        <div>
          <p>
            Fields with asterisks(*) are required
          </p>
        </div>
      </div>
      </div>
      <div class="container">
      <div class="modal-body">
      <div class="row">
          <div class="col-sm">
          <div class="form-group mb-3">
          <form action="registsercode.php" method="POST" id="register_form">
            <label>First Name <a style="color: red;">*</a></label>
            <input type="text" name="fname" id="fname" placeholder="Enter First Name" class="form-control" required>
            
        </div>
        <div class="form-group mb-3">
        <label>Last Name <a style="color: red;">*</a></label>
          <input type="text" name="lname" id="lname" placeholder="Enter Last Name" class="form-control" required>
        </div>
          </div>
          <div class="col-sm">
          <div class="form-group mb-3">
          <label>Number</label>
          <input type="text" name="number" id="number" placeholder="Enter Number" class="form-control">
        </div>
        <div class="form-group mb-3">
          <label>Email <a style="color: red;">*</a></label>
          <input type="text" name="email" id="email" placeholder="Enter Email Address" class="form-control" required>
        </div>
          </div>
        </div>

       <div class="row">
         <div class="col-sm">
         <div class="form-group mb-3">
          <label>Address</label>
          <input type="text" name="address" id="address" placeholder="Enter Address" class="form-control" >
        </div>
        <div class="form-group mb-3">
          <label>Password <a style="color: red;">*</a></label>
          <input type="password" name="password" id="password" require pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Enter Password" class="form-control" required>
        </div>
         </div>
         <div class="col-sm">
         <div class="form-group mb-3">
          <label>Confirm Password <a style="color: red;">*</a></label>
          <input type="password" name="cpassword" id="cpassword" placeholder="Enter Confirm Password" class="form-control" required>
        </div>
         </div>
       </div>
      </div>
        
        <div class="col-12">
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required />
              <label class="form-check-label" for="invalidCheck2" style="font-size: 13px;">
               I read and accepted the <a href="termsandconditions.php">Term & conditions</a> and <a href="privacypolicy.php">Privacy Policy</a> <span style="color: red; font-size: 15px;">*</span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group mb-3">
          <button type="submit" class="btn_register" name="register_btn">
            Register
          </button>
        </div>
        <div class="form-group mb-3">
          <label>Already have an Account?<a class="link" href="" data-target="#login_modal" data-toggle="modal" class="close" data-dismiss="modal" aria-label="Close"> Login Here!</a></label>
        </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>

<!-- modal login -->

<div class="modal fade" id="login_modal" tabindex="-1" 
    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group mb-3">
      
      <form action="logincode.php"method="POST">
            <div class="form-group mb-3">
                <label>Email</label>
                <input name="email" type="text" placeholder="Enter Email Address" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label>Password</label>
                <input name="password" type="password" placeholder="Enter Password" class="form-control">
            </div>
                <div class="form-group mb-3">
                    <button name="login_btn" type="submit" class="btn_login">Login Now</button>
                </div>
                <div class="form-group mb-3">
                    <label>Don't have an Account yet?<a a class="link" href="" data-target="#register_modal"  data-toggle="modal" class="close" data-dismiss="modal" aria-label="Close"> Register Now!</a></label>
                </div>
        </form>
    
      </div>
    </div>
  </div>
</div>
 </div>

