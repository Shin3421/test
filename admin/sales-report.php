<?php

session_start();

include('../connection.php');

include('../assets/time.php');

if(!isset($_SESSION['email'])){

    $_SESSION['error_alert'] = "You are not registered yet!";

    header("Location: ../index.php");

    exit(0);

    die();

  }elseif($_SESSION['auth_role'] != "1")

  {

    $_SESSION['error_alert'] = "Invalid Action!";

    header("Location: ../index.php");

    session_unset();

    session_destroy();

    die();

  }

$admin_id = $_SESSION['user_id'];



$d1 = (isset($_GET['d1']) ? date("Y-m-d",strtotime($_GET['d1'])) : date("Y-m-d")) ;

 $d2 = (isset($_GET['d2']) ? date("Y-m-d",strtotime($_GET['d2'])) : date("Y-m-d")) ;

 $data = $d1 == $d2 ? $d1 : $d1. ' - ' . $d2;

 $datetime = date_create($data);



?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport">



    <title>Dashboard - NiceAdmin Bootstrap Template</title>

    <meta content="" name="description">

    <meta content="" name="keywords">



    <!-- Favicons -->

    <link href="../assets/images/Navigation Bar/LOGO.png" rel="icon">

    <link href="../assets/images/Navigation Bar/LOGO.png" rel="apple-touch-icon">



    <!-- Google Fonts -->

    <link href="https://fonts.gstatic.com" rel="preconnect">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">



    <!-- Vendor CSS Files -->

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <link href="assets/datatables/datatables.min.css"/>



    <!-- Template Main CSS File -->

    <link href="assets/css/style.css" rel="stylesheet">

    <link href="assets/css/admin.css" rel="stylesheet">



    <!-- fontawesome -->

    <link rel="stylesheet" href="assets/css/fontawesome.min.css"/>



     <!-- sweetAlert -->

     <link rel="stylesheet" href="assets/css/sweetalert2.min.css"/>

        <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>

        <script src="assets/js/jquery.min.js" crossorigin="anonymous"></script>





</head>



<body>

<?php include('message.php') ?>

    <!-- ======= Header ======= -->

    <header id="header" class="header fixed-top d-flex align-items-center">



        <div class="d-flex align-items-center justify-content-between">

            <a href="home-page.php" class="logo d-flex align-items-center">

                <img src="../assets/images/Navigation Bar/LOGO.png" alt="">

                <span class="d-none d-lg-block">Budz Admin</span>

            </a>

            <i class="bi bi-list toggle-sidebar-btn"></i>

        </div>

        <!-- End Logo -->





        <nav class="header-nav ms-auto">

            <ul class="d-flex align-items-center">

                <!-- End Search Icon-->



                <li class="nav-item dropdown">



                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">

                        <i class="bi bi-bell"></i>

                        <div class="badge bg-primary badge-number" id="notification_count">

                        <?php 

                        $notifications = "SELECT COUNT(*) AS notification_count FROM notification_table WHERE reciever_id = '$admin_id' AND notif_status = '0'";

                        $notifications_result = mysqli_query($db, $notifications);



                        while($row = mysqli_fetch_array($notifications_result))

                        {

                            if($row['notification_count'] >= '1')

                            {

                                echo $row['notification_count'];

                            }

                        }

                    ?>

                        </div>

                    </a>



                    <!-- End Notification Icon -->



                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications mr-2">

                        <li class="dropdown-header">

                            - Admin Notification - 

                            <a onclick="clear_notif()" type="button"><span class="badge rounded-pill bg-primary p-2 ms-5">Clear All</span></a>

                        </li>

                        <div id="notif_list">



                        <?php 

                         $notification_lists = $db->query("SELECT A.*, B.* FROM notification_table as A INNER JOIN user_table as B ON A.sender_id = B.user_id WHERE reciever_id = '$admin_id' ORDER BY notif_created DESC");



                         if($notification_lists->num_rows > 0)

                         {

                           while($row = mysqli_fetch_array($notification_lists))

                           {

                             if($row['notif_status'] === '0')

                             {

                         ?>



                        <li>

                            <hr class="dropdown-divider">

                        </li>

                        <li class="notification-item">

                            <i class="bi bi-exclamation-circle text-warning"></i>

                            <div>

                                <h4><?= $row['fname'] ?></h4>

                                <p><?= $row['notif_message'] ?></p>

                                <p><?= getDateTimeDiff($row['notif_created']) ?></p>

                            </div>

                        </li>                     

                        <?php

                             }else{

                                ?>

                            <li>

                            <hr class="dropdown-divider">

                        </li>

                        <li class="notification-item-read">

                            <i class="bi bi-exclamation-circle text-warning"></i>

                            <div>

                                <h4><?= $row['fname'] ?></h4>

                                <p><?= $row['notif_message'] ?></p>

                                <p><?= getDateTimeDiff($row['notif_created']) ?></p>

                            </div>

                        </li>                

                                <?php

                             }

                            }

                        }else{

                            echo '<p> No notifications...</p>';

                        }

                        ?>

                        <li>

                            <hr class="dropdown-divider">

                        </li>

                        <li class="dropdown-footer">

                            <a href="#">Show all notifications</a>

                        </li>



                    </div>

                    </ul>

                    <!-- End Notification Dropdown Items -->



                </li>

        

                <!-- End Messages Nav -->



                <li class="nav-item dropdown pe-3">



                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

                    <?php if(isset($_SESSION['auth_user'])) ?>

                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['auth_user']['user_fname']?> <?= $_SESSION['auth_user']['user_lname']?></span>

                    </a>

                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                        <li class="dropdown-header">

                            <h6><?= $_SESSION['auth_user']['user_fname']?> <?= $_SESSION['auth_user']['user_lname']?></h6>

                            <span>Admin

                            </span>

                        </li>

                        <li>

                            <hr class="dropdown-divider">

                        </li>

                        <li>

                            <form action="../assets/code.php" method="POST">

                            <button type="submit" name="logout_btn" class="dropdown-item d-flex align-items-center">

                                <i class="bi bi-box-arrow-right"></i>

                                <span>Logout</span>

                            </button>

                            </form>

                        </li>

          </ul>

                    <!-- End Profile Dropdown Items -->

                </li>

                <!-- End Profile Nav -->



            </ul>

        </nav>

        <!-- End Icons Navigation -->



    </header>

    <!-- End Header -->



    <!-- ======= Sidebar ======= -->

    <aside id="sidebar" class="sidebar">



        <ul class="sidebar-nav" id="sidebar-nav">



            <li class="nav-item">

                <a class="nav-link " href="home-page.php">

                    <i class="bi bi-grid"></i>

                    <span>Dashboard</span>

                </a>

            </li>

            <!-- End Dashboard Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#manage-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="manage-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="registered-users.php">
                            <i class="bi bi-circle"></i><span>Registered User</span>
                        </a>
                        <a href="set-schedules.php">
                            <i class="bi bi-circle"></i><span>Set Schedules</span>
                        </a>
                        <a href="booking-schedules.php">
                            <i class="bi bi-circle"></i><span>Booking Schedules</span>
                        </a>
                        <a href="set-redeemables.php">
                            <i class="bi bi-circle"></i><span>Set Redeemables</span>
                        </a>
                        <a href="machines.php">
                            <i class="bi bi-circle"></i><span>Machines</span>
                        </a>
                        <a href="prices-category.php">
                            <i class="bi bi-circle"></i><span>Prices Category</span>
                        </a>
                    </li>
                </ul>
            </li>

            

            <li class="nav-item">

                <a class="nav-link collapsed" data-bs-target="#history-nav" data-bs-toggle="collapse" href="#">

                    <i class="bi bi-menu-button-wide"></i><span>History</span><i class="bi bi-chevron-down ms-auto"></i>

                </a>

                <ul id="history-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>

                        <a href="login-history.php">

                            <i class="bi bi-circle"></i><span>Login History</span>

                        </a>

                        <a href="redeem-history.php">

                            <i class="bi bi-circle"></i><span>Redeem History</span>

                        </a>

                    </li>

                </ul>

            </li>

        </ul>



    </aside>

    <!-- End Sidebar-->



    <!-- body content -->

    <main id="main" class="main">



        <div class="pagetitle">

            <h1>Dashboard</h1>

            <nav>

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="home-page.php">Home</a></li>

                    <li class="breadcrumb-item active">Dashboard</li>

                </ol>

            </nav>

        </div>



        <section class="section dashboard">

            <div class="row">

                              

            <div class="container-fluid px-4">



                        <div class="card">

                        <div class="card-header">

                    <h4>

                        Week Schedule

                    </h4>    

                    

                        </div>



                        <div class="card-body">



                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">



                        <li class="nav-item" role="presentation">

                            <a class="nav-link active" data-bs-toggle="tab"  role="tab"  href="#sunday_tab">Sunday</a>

                        </li>

                        <li class="nav-item" role="presentation">

                            <a class="nav-link" data-bs-toggle="tab" role="tab"  href="#monday_tab">Monday</a>

                        </li>

                        <li class="nav-item" role="presentation">

                            <a class="nav-link "  data-bs-toggle="tab" role="tab"  href="#tuesday_tab">Tuesday</a>

                        </li>

                        <li class="nav-item" role="presentation">

                            <a class="nav-link "  data-bs-toggle="tab" role="tab"  href="#wednesday_tab">Wednesday</a>

                        </li>

                        <li class="nav-item" role="presentation">

                            <a class="nav-link " data-bs-toggle="tab" role="tab"  href="#thursday_tab">Thursday</a>

                        </li>

                        <li class="nav-item" role="presentation">

                            <a class="nav-link " data-bs-toggle="tab" role="tab"  href="#friday_tab">Friday</a>

                        </li>

                        <li class="nav-item" role="presentation">

                            <a class="nav-link" data-bs-toggle="tab" role="tab"  href="#saturday_tab">Saturday</a>

                        </li>

                       

                        </ul>

                        

                        <div class="tab-content schedule-cont">



                        <!-- Sunday Tab -->

                        <div class="tab-pane fade show active mt-3" id="sunday_tab">

                        <div class="card">

                        <div class="card-header">

            

                    <div class="row m-3">

            

                    <div class="col-md-3">

                            <div class="form-group">

                                <label for="" class="control-label">Date From</label>

                                <input type="date" class="form-control" name="d1" id="d1" value="<?php echo date("Y-m-d",strtotime($d1)) ?>">

						    </div>

                            </div>



                            <div class="col-md-3">

                            <div class="form-group">

                                <label for="" class="control-label">Date To</label>

                                <input type="date" class="form-control" name="d2" id="d2" value="<?php echo date("Y-m-d",strtotime($d2)) ?>">

						    </div>

                            </div>



                           <div class="col mt-4">

                            <div class="form-group d-grid">

                            <button class="btn btn-primary " type="button" id="filter"><i class="fa fa-filter"></i> Filter</button>

						    </div>

                            </div>



                            <div class="col mt-4">

                            <div class="form-group d-grid">

                            <button class="btn btn-primary" type="button" id="print"><i class="fa fa-print"></i> Print</button>

						    </div>

                            </div>

                    </div>



                        </div>

                            

                        <div class="card-body">

                        <div class="container">



                        <div class="row mt-4" id="print-data">

                        <div style="width:100%">

					<p class="text-center">

						<large><b>Budz Laundry Sales Report</b></large>

                       

					</p>

                    <p class="text-center">

                    <large><b>514 Lapu-Lapu St. Cor. Quirino Ave, Brgy. East</b></large>

                    </p>

					<p class="text-center">

						<large><b>From: <?php echo $data ?></b></large>

					</p>

					</div>

					<table class='table table-bordered'>

                        

						<thead>

							<tr>

								<th>Date</th>

								<th>Customer Name</th>

								<th>Total Amount</th>

							</tr>

						</thead>

						<tbody>

                        

                        <?php 

                        $total = 0;

                         $select_sales =$db->query("SELECT A.*,B.* FROM receipt_table AS A INNER JOIN user_table AS B ON A.user_id = B.user_id WHERE date(receipt_date_created) between '$d1' and '$d2' ORDER BY receipt_date_created ");



                         while($row=$select_sales->fetch_assoc()):

                            $total += $row['receipt_total'];

                        ?>

							<tr >

								<td><?php echo date("M d, Y",strtotime($row['receipt_date_created'])) ?></td>

								<td><?php echo $row['fname']. $row['lname'] ?></td>

								<td class="text-right"><?php echo number_format($row['receipt_total'],2) ?></td>

							</tr>

                            <?php endwhile; ?>

						</tbody>

						<tfoot>

							<tr>

								<td class="text-right" colspan="2">Total</td>

								<td class="text-right"><?php echo number_format($total,2) ?></td>

							</tr>

						</tfoot>

					</table>

				</div>

                        </div>

                        </div>

                        </div>

                        </div>

                        <!-- /sunday tab -->



                        <!-- Monday Tab -->

                        <div class="tab-pane fade  mt-3" id="monday_tab">

                    

                        </div>

                        <!-- /Monday Tab -->



                        <!-- Tuesday Tab -->

                        <div class="tab-pane fade mt-3" id="tuesday_tab" >

                      

                        </div>

                        <!-- /Tuesday Tab -->



                        <!-- Wednesday Tab -->

                        <div class="tab-pane fade mt-3" id="wednesday_tab" >    

                        </div>

                        <!-- /Wednesday Tab -->



                        <!-- Thursday Tab -->

                        <div class="tab-pane fade mt-3" id="thursday_tab" >                

                        </div>

                        <!-- /Thursday Tab -->

                        

                        <!-- Friday Tab -->

                        <div class="tab-pane fade mt-3" id="friday_tab" >

                

                        </div>

                        <!-- /Friday Tab -->



                        <!-- Saturday Tab -->

                        <div class="tab-pane fade mt-3" id="saturday_tab" >

                   

                        </div>

                        <!-- /Saturday Tab -->

                        

                                </div>

                            </div>

                        </div>

                    </div>



            </div>

        </section>

    </main>

    <!-- /body content -->



    <style>

	#print-data p {

				display: none;

			}

</style>

<noscript>

	<style>

			#div{

				width:100%;

			}

			table {

				border-collapse: collapse;

				width:100% !important;

			}

			tr,th,td{

				border:1px solid black;

			}

			.text-right{

				text-align: right

			}

			.text-right{

				text-align: center

			}

			p{

				margin:unset;

			}



			p.text-center {

			    text-align: center;

			}

			

			

	</style>

</noscript>	



<script>

	$('#filter').click(function(){

		location.replace('sales-report.php?page=reports&d1='+$('#d1').val()+'&d2='+$('#d2').val())

	})

	$('#print').click(function(){

		var newWin = document.open('BudzLaundry','_blank','height=500,width=600');

		var _html = $('#print-data').clone();

		var ns = $('noscript').clone();

		newWin.document.write(ns.html())

		newWin.document.write(_html.html())

		newWin.document.close()

		newWin.print()

		setTimeout(function(){

			newWin.close()

		},1500)

	});

</script>



    <!-- ======= Footer ======= -->

    <footer id="footer" class="footer">

        <div class="copyright">

            &copy; Copyright <strong><span>Budz Laundry</span></strong>. All Rights Reserved

        </div>

        <div class="credits">

            <!-- All the links in the footer should remain intact. -->

            <!-- You can delete the links only if you purchased the pro version. -->

            <!-- Licensing information: https://bootstrapmade.com/license/ -->

            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->

            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>

        </div>

    </footer>

    <!-- End Footer -->

<!-- add script --> 



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



    <script src="assets/js/jquery.min.js" crossorigin="anonymous"></script>

    <!-- Vendor JS Files -->

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <!-- Template Main JS File -->



    <script src="assets/js/main.js"></script>    

    <script src="assets/js/scripts.js"></script>

    <script src="assets/datatables/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    <script src="assets/js/fontawesome.all.js" crossorigin="anonymous"></script>

    

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



      xmlhttp.open("GET", "code/notification-count.php?admin_id=<?php echo $admin_id ?>&action=user");



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



      xmlhttp.open("GET", "code/notification-list.php?admin_id=<?php echo $admin_id ?>&action=user");



      xmlhttp.send();

    };



    setInterval(function()

    {

      notification_list();

    }, 2000);

  



    function clear_notif()

    {

      action = '1';

      admin_id = <?php echo $admin_id ?>;

      $.ajax({

        url: "code/function.php",

        type: "POST",

        datatype: "json",

        data:

        {

            admin_id: admin_id,

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