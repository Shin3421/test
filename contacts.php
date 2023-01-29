<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <link rel="stylesheet" href="assets/css/contacts.css" />

  <link rel="Webpage icon" type="device-icon/png" href="assets/images/Navigation Bar/LOGO.png" />
  <title>Budz Laundy Hub - Contacts & Map</title>
</head>

<body>
  <!-- Navigation Bar Section -->
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
    </nav>
  </div>

  <!-- Floating Section -->

  <nav class="side">
    <ul class="ulimage mb-0">
      <li class="hover_effect"><a href="https://www.facebook.com/budzlaundryhub/" target="facebook-profile" class="hoverA text-decoration-none"><img src="assets/images/Navigation Bar/facebook.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">FACEBOOK</span></a></li>

      <li><a href="#" class="hoverA text-decoration-none"><img src="assets/images/Navigation Bar/messenger.png" alt="" class="side-media"><span class="hoverp" style="color: #fff;">MESSENGER</span></a></li>

      <!--<li><a href="#" class="hoverA text-decoration-none"><img src="assets/images/Navigation Bar/gmail.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">GMAIL</span></a></li>-->
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
                  <label class="form-check-label" for="exampleCheck1" style="font-size: 11px;">I read and accepted the <a href="terms-and-conditions.php" target="termsandcondition" class="text-primary">Term & conditions</a> and <a href="privacy-policy.php" target="privacypolicy" class="text-primary">Privacy Policy</a> <span style="color: red; font-size: 15px;">*</span></label>
                  </div>
                </div>
              </div>
              <div class="col-12 text-center">
                

              <button type="submit"class="text-light font-weight-bold rounded" style="background-color: #00c5ce; padding: 5px 44%; border-color: #fff0;">
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



  <!-- Bubbles -->


  <!-- Footer -->

  <div class="footer-container border-top" style="color: #980799;">
      <h3 class="social-med-h3">Social Media Accounts:</h3>
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
      <ul class="nav justify-content-center pb-3 mb-3" style="color: #980799;">
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
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
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
          <form action="registercode.php" method="POST" id="register_form">
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
          <input type="email" name="email" id="email" placeholder="Enter Email Address" class="form-control" required>
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
          <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" require pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
          title="Password must contain one uppercase and lowercase letter, and at least 8 or more characters" required>
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
               I read and accepted the <a href="terms-and-conditions.php">Term & conditions</a> and <a href="privacy-policy.php">Privacy Policy</a> <span style="color: red; font-size: 15px;">*</span>
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

