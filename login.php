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
    <link rel="stylesheet" href="assets/css/login.css" />

    <!-- Font awesome icons -->
    <script src="https://kit.fontawesome.com/605956740d.js" crossorigin="anonymous"></script>

    <link
      rel="Webpage icon"
      type="device-icon/png"
      href="assets/images/Navigation Bar/LOGO.png"
    />
    <title>Budz Laundy Hub</title>

      <!-- CSS Inline -->>
    
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
      <?php include 'message.php';?>

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
    <div class="card">
        <div class="border-card d-flex flex-lg-row flex-column-reverse">
        <div class="card card2" style="background:url(assets/images/LoginandregisterImage/login_image.jpg); background-size:cover; background-repeat: no-repeat;">
        </div>
            <div class="card1">
                <div class="row justify-content-center my-5">
                    <div class="col-md-8 col-10 my-5">
                        <h5 class="msg-info font-weight-bolder text-center" style="color: #980799;">Login your account</h5>

                        <form method="POST" action="logincode.php">
                        <div class="form-group">
                            <label class="form-control-label text-muted">Email Address</label>
                            <input type="text" id="email" name="email" placeholder="example@gmail.com" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-control-label text-muted">Password</label>
                            <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="Enter password" class="form-control ">
                              <div class="input-group-append mx-2 mt-2">
                              <a href="#" id="icon-click" style="z-index: 10;"><i class="fa-regular fa-eye" id="icon"></i></a>
                              </div>
                            </div>
                        </div>

                        <div class="row d-flex flex-row-reverse my-4">
                           <a href="password-reset.php"><small class="text-muted mr-3">Forgot Password?</small></a>
                        </div>
                        <?php include('message.php') ?>
                        <div class="row my-1 px-2">
                            <button name="login_btn" type="submit" class="btn-block btn-color font-weight-bold">Login</button>
                        </div>
                        </form>
                       
                        </div>
                        <div class="text-center mb-5">
                            <p href="#" class="">Don't have an account? <a href="register.php" class="text-primary">Sign up</a></p>
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

    <script type="text/javascript" src="assets/js/fontawesome.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="assets/js/slim.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#icon-click").click(function() {
          $("#icon").toggleClass('fa-regular fa-eye-slash')
          
          var input = $("#password");
          if(input.attr("type")=== "password"){
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
    </script>
  
  </body>
</html>

