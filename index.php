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
    <link rel="stylesheet" href="assets/css/index.css" />

    <link
      rel="Webpage icon"
      type="device-icon/png"
      href="assets/images/Navigation Bar/LOGO.png"
    />
    <title>Budz Laundy Hub -  Home</title>
  </head>
  
   <!-- Splash Screen --> 

  <!--<div id="splash-screen">-->
  <!--        <img class="logo_spash_screen" src="assets/images/Navigation Bar/LOGO.png" alt="">-->
  <!--</div>-->
  
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

    <!-- Floating icon Section -->
    <nav class="side">
      <ul class="ulimage mb-0">
         <li class="hover_effect"><a href="https://www.facebook.com/budzlaundryhub/" target="facebook-profile" class="hoverA text-decoration-none"><img src="assets/images/Navigation Bar/facebook.JPG" alt="" class="side-media"><span class="hoverp" style="color:#fff;">FACEBOOK</span></a></li>
         <li><a href="https://www.facebook.com/messages/t/2024978074490873" class="hoverA text-decoration-none"><img src="assets/images/Navigation Bar/messenger.png" alt="" class="side-media"><span class="hoverp" style="color: #fff;">MESSENGER</span></a></li>
         <!--<li><a href="#" class="hoverA text-decoration-none"><img src="assets/images/Navigation Bar/gmail.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">GMAIL</span></a></li>-->
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
          <div class="col-xl pt-5 my-3 position-relative">
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
            
            <button class="btn mt-3" id="button_reserve" style="position: relative; left: 0;"><a href="user/schedule-of-book.php" class="btn_sched" style="text-decoration: none; color: #fff;">
              BOOK NOW!
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin: 2px 2px 4px 15px;">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
              </svg>
            </a></button>
          </div>
          <div class="col-xl justify-content-center mt-5">
            <img src="assets/images/Home-page/home-banner.png" alt="" class="img-fluid pb-5" />
          </div>
        </div>
      </div>
    </div>

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
                  <img class="img_deals" src="assets/images/Home-page/flow.png" alt="">
                </li>
            </div>
            <div class="col-xs d-flex justify-content-center align-items-center">
              <li class="list-unstyled mx-5">
                <img class="img_deals" src="assets/images/Home-page/system_points.png" alt="">
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
            src="assets/images/Home-page/register.png"
            class="d-block mx-lg-auto img-fluid"
            alt="Bootstrap Themes"
            width="400"
            height="300"
            loading="lazy"
          />
        </div>
        <div class="col-lg-6" style="color: #980799;">
          <h3 class="font-weight-bold text-center" style="font-size: 30px; color: #980799;">
            Register
          </h2>
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
            src="assets/images/Home-page/book.png"
            class="d-block img-fluid"
            alt="Bootstrap Themes"
            width="400"
            height="400"
            loading="lazy"
          />
        </div>
        <div class="col-lg-6" style="color: #980799;">
          <h3 class="font-weight-bold mb-3 text-center" style="font-size: 30px; color: #980799;">
              Reserve
          </h3>
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
            src="assets/images/Home-page/hiw-image1.png"
            class="mx-lg-auto img-fluid d-flex justify-content-center"
            alt="Bootstrap Themes"
            width="150"
            height="150"
            loading="lazy"
          />
        </div>
        <div class="col-lg-6" style="color: #980799;">
          <h3 class="font-weight-bold text-center" style="font-size: 30px; color: #980799;">
              Notification
          </h3>
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
            src="assets/images/Home-page/points.png"
            class="d-block img-fluid"
            alt="Bootstrap Themes"
            width="300"
            height="300"
            loading="lazy"
          />
        </div>
        <div class="col-lg-6" style="color: #980799;">
          <h3 class="font-weight-bold lh-1 mb-3 text-center" style="font-size: 30px; color: #980799">
            Points
          </h3>
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
          <div class="imgContainer"><img src="assets/images/Home-page/aila.png" /></div>
          <div class="content" style="color: #980799;">
          <div class="text-left my-2"><img src="assets/images/Home-page/first_qoute.PNG"></div>
            <p>
              Nice place to wash nice assistant they text you when laundry is done, thank you!
            </p>
            <div class="text-right my-2"><img src="assets/images/Home-page/second_qoute.PNG"></div>
            <h6>Maricel A.</h6>
          </div>
        </div>
        <div class="card d-flex position-relative flex-column">
          <div class="imgContainer"><img src="assets/images/Home-page/estelle.png" /></div>
          <div class="content" style="color: #980799;">
          <div class="text-left my-2"><img src="assets/images/Home-page/first_qoute.PNG"></div>
            <p>
              Comfortable place to do laundry with friendly staff
            </p >
            <div class="text-right my-2"><img src="assets/images/Home-page/second_qoute.PNG"></div>
            <h6>Trixy E.</h6>
          </div>
        </div>
        <div class="card d-flex position-relative flex-column">
          <div class="imgContainer"><img src="assets/images/Home-page/russele.png" /></div>
          <div class="content" style="color: #980799;">
          <div class="text-left my-2"><img src="assets/images/Home-page/first_qoute.PNG"></div>
            <p class="fw-bolder">
              Very approachable and friendly.
            </p>
            <div class="text-right my-2"><img src="assets/images/Home-page/second_qoute.PNG"></div>
            <h6>Michel E.</h6>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->

    <div class="footer-container border-top" style="color: #980799;">
      <h3 class="social-med-h3">
Follow us on our Social Media Accounts</h3>
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
    <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="assets/js/slim.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    //  <script>
    //   setTimeout(() => {document.getElementById('splash-screen').classList.toggle('fade');}, 1500);
    // </script>
  </body>
</html>

