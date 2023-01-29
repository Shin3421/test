<?php

session_start(); ?>
<html>
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

    <title>Budz Laundy Hub -  About us</title>
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

    <!-- Floating icon Section -->
    <nav class="side">
      <ul class="ulimage mb-0">
         <li class="hover_effect"><a href="https://www.facebook.com/budzlaundryhub/" target="facebook-profile" class="hoverA text-decoration-none"><img src="assets/images/Navigation Bar/facebook.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">FACEBOOK</span></a></li>

         <li><a href="https://www.facebook.com/messages/t/2024978074490873" class="hoverA text-decoration-none"><img src="assets/images/Navigation Bar/messenger.png" alt="" class="side-media"><span class="hoverp" style="color: #fff;">MESSENGER</span></a></li>

         <li><a href="#" class="hoverA text-decoration-none"><img src="assets/images/Navigation Bar/gmail.JPG" alt="" class="side-media"><span class="hoverp" style="color: #fff;">GMAIL</span></a></li>
      </ul>
   </nav>

<!-- About us section -->

    <h2 class="container pt-5 text-center" style="font-weight: 700; margin-top: 70px; color:#980799;">About us</h2>
<div class="container col-xxl-8 px-4 pt-5">
  <div class="row flex-lg-row-reverse align-items-center d-flex justify-content-center g-5 py-3">
    <div class="col-10 col-sm-8 col-lg-6">
      <img
        src="assets/images/Home-page/vision.png"
        class="d-block mx-lg-auto img-fluid"
        alt="Bootstrap Themes"
        width="200"
        height="200"
        loading="lazy"
      />
    </div>
    <div class="col-lg">
      <h3 class="font-weight-bold lh-1 text-center" style="color:#980799; font-size: 30px;">
        Vision
      </h3>
      <p class="lead text-center" id="hiw-paragraph" style="color:#980799;">
        To become the most prominent laundry service provider in the area that offers customers with excellent and reliable service
        with satisfaction and ease.
      </p>
    </div>
  </div>
</div>
<div class="container col-xxl-8 px-4">
  <div class="row align-items-center d-flex justify-content-center g-5">
    <div class="col-10 col-sm-8 col-lg-6">
      <img
        src="assets/images/Home-page/hiw-image2.png"
        class="d-block img-fluid"
        alt="Bootstrap Themes"
        width="400"
        height="400"
        loading="lazy"
      />
    </div>
    <div class="col-lg-6">
      <h3 class="font-weight-bold lh-1 mb-3 text-center" style="color:#980799; font-size: 30px;">
        Mission
      </h3>
      <p class="lead text-center" id="hiw-paragraph" style="color:#980799;">
        Our mission is to provide superior customer care and laundry service through:
      </p>
      <ul class="lead" style="margin-left: 100px; color:#980799;">
        <li>Professional customer assistance</li>
        <li>Efficient and effective service</li>
        <li>Continuous innovation of products and services, and</li>
        <li>Integrity in work</li>
      </ul>
    </div>
  </div>
</div>
<div class="container col-xxl-8 px-4 py-2">
  <div class="row flex-lg-row-reverse align-items-center d-flex justify-content-center g-5 py-3">
    <div class="col-10 col-sm-8 col-lg-6">
      <img
        src="assets/images/Home-page/hiw-image3.png"
        class="mx-lg-auto img-fluid d-flex justify-content-center"
        alt="Bootstrap Themes"
        width="400"
        height="400"
        loading="lazy"
      />
    </div>
    <div class="col-lg-6">
      <h3 class="font-weight-bold text-center" style="color: #980799; font-size: 30px;">
        Core Values
      </h3>
      <p class="lead text-center" id="hiw-paragraph" style="color:#980799;">
        Integrity and Commitment <br>
        Family and Community Oriented <br>
        Professionalism <br>
        Cleanliness <br>
      </p>
    </div>
  </div>
</div>

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
    <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="assets/js/slim.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
</body>
  </html>


