<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Budz Laundry Hub - Services & Price</title>

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
    <link rel="stylesheet" href="assets/css/serviceandpricing.css" />

    <link rel="Webpage icon" type="device-icon/png" href="assets/images/Navigation Bar/LOGO.png" />
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
         <button type="button" id="btn_serviceNprice" class="btn .sign" style="color: #ffffff;">
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

  <!-- Services introduction  -->

  <div class="container col-xxl-8" style="margin-top: 100px;">
    <div class="row flex-lg-row-reverse align-items-center py-5">
      <div id="serviceandpricingbanner" class="col-10 col-sm-8 col-lg-6 mt-5">
        <img src="assets/images/Services & Pricing/gif_snp.gif" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="500" height="500" loading="lazy" />
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3"> <span class="superwash_highlight">b<span class="laundromat_highlight">u</span>dz</span> <span class="laundromat_highlight">Laundry Hub</span></h1>
        <p class="lead" style="text-align:justify; color: #980799;">
          budz Laundry Hub provides effortless Reserving and scheduling that will help to be more productive and save your time.
        </p>
        <button class="btn" id="button_reserve" style="position: relative; left: 0;"><a href="user/schedule-of-book.php" class="" style="text-decoration: none; color: #fff; flex-direction: row-reverse;">
            BOOK NOW!
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin: 2px 2px 4px 15px;">
              <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
            </svg>
          </a></button>
      </div>
    </div>
  </div>

  <!-- Services and Pricing Description -->
  <h2 class="pb-2 text-center" style="font-weight: 700; color:#980799; ">Services</h2>

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
              <a id="btn_serviceNprice" type="button" class="font-weight-bold text-light rounded" href="login.php">Book Now</a>
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
          <img src="assets/images/Services & Pricing/process_guide.png" class="img-fluid" width="600" alt="">
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
              <a id="btn_serviceNprice" type="button" class="text-transform-lowercase font-weight-bold text-light rounded" href="login.php">Book Now</a>
            </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <br><br><br><br><br>

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
      <p class="text-center" style="color: #980799;">
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
          <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" require pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"title="Password must contain one uppercase and lowercase letter, and at least 8 or more characters" required>
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

