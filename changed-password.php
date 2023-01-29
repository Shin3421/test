<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password form reset</title>

    <!-- favicon -->
    <link
    rel="Webpage icon"
    type="device-icon/png"
    href="assets/images/Navigation Bar/LOGO.png"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <!-- Font awesome icons -->
      <script src="https://kit.fontawesome.com/605956740d.js" crossorigin="anonymous"></script>

      <style>
        #reset_btn {
            background-color: #00c5ce;
            color: white;
            border-radius: 5px;
            border: #fff0;
            padding: 10px 30px;
        }
        #reset_btn:hover {
            background: #980799;
            box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px,
            rgba(0, 0, 0, 0.05) 0px 5px 10px;
            transition: 0.2s ease-in-out;
        }
      </style>

</head>
<body>

 <!-- Navigation Bar Section
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
              <a class="nav-link fw-bold" href="index.php" style="color: #980799; font-size: 17px;">
                Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold" href="service-and-pricing.php" style="color: #980799; font-size: 17px;">
                Services & Prices
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold" href="contacts.php" style="color: #980799; font-size: 17px;">
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
        </div> -->


    <!-- Reset Form -->
   
    <?php include 'message.php'; ?>
<div class="container">
      <div class="row align-items-center justify-content-center
          min-vh-100">
        <div class="col-12 col-md-8 col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="mb-4">
                <h5 style="font-size: 25px; color: #980799; font-weight: 700;">Change Password</h5>
              </div>
              <form method="POST" action="password-reset-db.php">

                <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" id="email" value="<?php if(isset($_GET['email'])) {echo $_GET['email'];} ?>" class="form-control" name="email" placeholder="Enter Your Email"
                    required>
                </div>
                <div class="mb-3">
                  <label class="form-label">New Password</label>
                  <input type="password" id="new_password" class="form-control" name="new_password" placeholder="Enter Your New Password"
                    required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password"
                    required>
                </div>
                <div class="mb-3 d-grid">
                  <button class="fw-bold" type="submit" id="reset_btn" name="password_update">
                    Update password
                  </button>
                </div>
                <span>Don't have an account? <a class="text-decoration-none" href="login.php">Sign up</a></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    

</body>
</html>