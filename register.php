


<?php 
session_start();
?>
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
    <link rel="stylesheet" href="assets/css/register.css" />

    <link
      rel="Webpage icon"
      type="device-icon/png"
      href="assets/images/Navigation Bar/LOGO.png"
    />
    <title>Budz Laundy Hub</title>

    <style>
      .invalid-feedback {
        text-align: center;
        color: red;
      }
    </style>

  </head>
  <body>
    <!-- Navigation Bar Section -->
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.php">
          <img class="logo" src="assets/images/Navigation Bar/LOGO.png" alt="" />
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

    <!-- Homepage Section -->

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
    
    <div class="container mx-auto" style="margin-top: 50px;">
    <div class="card card0">
        <div class="border-card d-flex flex-lg-row flex-column-reverse">
        <div class="card card2" style="background:url(assets/images/LoginandregisterImage/login_image.jpg); background-size:cover; background-repeat: no-repeat;">
        </div>
            <div class="card1" style="margin-left: 10px;">
                
            <h5 class="msg-info my-5 font-weight-bolder text-center" style="color: #980799; font-size: 25px;">Sign up</h5>

            <div class="row">
            <div class="col-sm">

          <div class="form-group mb-3">
          <form action="registercode.php" method="POST"
          id="register_form">

            <label class="form-control-label text-muted">First Name <a style="color: red;">*</a></label>
            <input type="text" name="fname" id="fname" placeholder="Enter First Name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
        <label class="form-control-label text-muted">Mobile Number</label>
          <input type="text" name="number" id="number" placeholder="Enter Number" class="form-control">
        </div>
          </div>
          <div class="col-sm">
          <div class="form-group mb-3">
          <label class="form-control-label text-muted">Last Name <a style="color: red;">*</a></label>
          <input type="text" name="lname" id="lname" placeholder="Enter Last Name" class="form-control" required>
        </div>
        <div class="form-group mb-3">
          <label class="form-control-label text-muted">Address</label>
          <input type="text" name="address" id="address" placeholder="Enter Address" class="form-control">
          
        </div>
          </div>
            </div>

            <div class="row">
            <div class="col-sm">
          <div class="form-group mb-3">
            <label class="form-control-label text-muted">Password  <a style="color: red;">*</a></label>
            <div class="input-group">
            <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" require pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain one uppercase and lowercase letter, and at least 8 or more characters" required>
            <div class="input-group-append mx-2 mt-2">
              <a href="#" id="icon-click" style="z-index: 10;"><i class="fa-regular fa-eye" id="icon"></i></a>
            </div>
            </div>
            
        </div>
      
          </div>
          <div class="col-sm">
          <div class="form-group mb-3">
          <label class="form-control-label text-muted">Confirm Password <a style="color: red;">*</a></label>
          <div class="input-group">
          <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" class="form-control" required>
          <div class="input-group-append mx-2 mt-2">
            <a href="#" id="icon-cpassword-click" style="z-index: 10;"><i class="fa-regular fa-eye" id="icon-cpassword"></i></a>
            </div>
          </div>
        </div>
          </div>
          <div class="col-sm-12">
          <div class="form-group mb-3 text-center">
        <label class="form-control-label text-muted">Email Address <a style="color: red;">*</a></label>
          <input type="email" name="email" id="email" placeholder="Enter you email address" class="form-control">
        </div>
          </div>

            </div>


        <div class="row">
            <div class="col-lg-12 mt-2">

            <div class="form-group text-center">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required />
            <label class="form-check-label" for="invalidCheck2" style="font-size: 13px;">
               I read and accepted the <a href="terms-and-conditions.php" class="text-primary">Term & conditions</a> and <a href="privacy-policy.php" class="text-primary">Privacy Policy</a> <span style="color: red; font-size: 15px;">*</span>
              </label>
            </div> 
 
         <div class="form-group text-center">
           <!-- <button type="submit" class="btn_user_register" name="register_btn">
             Register
           </button> -->
           <button type="submit" name="register_btn" class="btn-block btn-color font-weight-bold" >Register</button>
         </div>
</form>
         <div class="form-group text-center">
           <label>Already have an Account?<a class="link text-primary" href="login.php"> Login Here!</a></label>
         </div> 
            </div>
        </div>
        
   
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

    <script type="text/javascript" src="assets/js/fontawesome.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="assets/js/slim.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
 

    <script type="text/javascript">
      $(document).ready(function(){
        $("#icon-click").click(function() {
          $("#icon").toggleClass('fa-regular fa-eye-slash')
          
          var input = $("#password");

          if(input.attr("type") === "password"){
            input.attr("type", "text");
          }
          else {
            input.attr("type", "password");
          }
          });

          $("#icon-click").click(function() {
            $("#icon").toggleClass('fa-eye')
          });
        });

        $(document).ready(function() {
        $("#icon-cpassword-click").click(function() {
          $("#icon-cpassword").toggleClass('fa-regular fa-eye-slash')

          var input_cpassword = $("#cpassword");

          if(input_cpassword.attr("type") === "password"){
            input_cpassword.attr("type", "text");
          }
          else {
            input_cpassword.attr("type", "password");
          }
          });

          $("#icon-cpassword-click").click(function() {
            $("#icon-cpassword").toggleClass('fa-eye')
        });
      });
        
    </script>

    <script src="assets/js/bootstrap-validate.js"></script>

    <script>
    bootstrapValidate('#fname', 'required: Please fill out this field!');
    bootstrapValidate('#lname', 'required: Please fill out this field!');
    bootstrapValidate('#email', 'email:Enter a valid email address');
    bootstrapValidate('#password', 'min:8:* Atleast 8 characters, one uppercase and lowercase letter.');
    bootstrapValidate('#cpassword', 'min:8:* Please match your password!');
    bootstrapValidate('#number', 'startsWith:09:+63:* Mobile number needs to start with 09 and 11 digits.');
    
    </script>
  </body>
</html>

