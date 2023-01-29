<?php
session_start();
include '../connection.php';
include '../assets/time.php';

if (!isset($_SESSION['email'])) {
    $_SESSION['error_alert'] = 'You are not registered yet!';
    header('Location: ../index.php');
    exit(0);
    die();
} elseif ($_SESSION['auth_role'] != '1') {
    $_SESSION['error_alert'] = 'Invalid Action!';
    header('Location: ../index.php');
    session_unset();
    session_destroy();
    die();
}

$admin_id = $_SESSION['user_id'];

$TimeZone = new DateTime();
$TimeZone->setTimezone(new DateTimeZone('Asia/Manila'));
$AsiaTime = $TimeZone->format('Y-m-d h:i:s');

/* First */
$d1 = isset($_GET['d1'])
    ? date('Y-m-d', strtotime($_GET['d1']))
    : date('Y-m-d');
$d2 = isset($_GET['d2'])
    ? date('Y-m-d', strtotime($_GET['d2']))
    : date('Y-m-d');
$data = $d1 == $d2 ? $d1 : $d1 . ' - ' . $d2;
$datetime = date_create($data);

/* third */
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
    <link href="assets/datatables/datatables.min.css" rel="stylesheet"/>
    <link href="assets/datatables/jquery.dataTables.css" rel="stylesheet"/>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">

    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css"/>

     <!-- sweetAlert -->
     <link rel="stylesheet" href="assets/css/sweetalert2.min.css"/>
        <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
        <script src="assets/js/jquery.min.js" crossorigin="anonymous"></script>

    <!-- CSS internal -->

    <style>
        .btn:hover {
            box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;
        }
        .dataTables_length
        {
            display: none;
        }

    </style>


</head>

<body>
<?php include 'message.php'; ?>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center" style="padding: 3px 25px;top: 0px; background: rgba(255, 224, 253, 0.55); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);">

        <div class="d-flex align-items-center justify-content-between">
            <a href="home-page.php" class="logo d-flex align-items-center"><img src="../admin/assets/img/admin_logo.png" width="125">
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
                        $notifications_result = mysqli_query(
                            $db,
                            $notifications
                        );

                        while (
                            $row = mysqli_fetch_array($notifications_result)
                        ) {
                            if ($row['notification_count'] >= '1') {
                                echo $row['notification_count'];
                            }
                        }
                        ?>
                        </div>
                    </a>

                    <!-- End Notification Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications mr-2" style="height: 780%; overflow-y: auto;
    border-radius: 15px;">
                        <li class="dropdown-header">
                            - Admin Notification - 
                            <a onclick="clear_notif()" type="button"><span class="badge rounded-pill bg-primary p-2 ms-5">Clear All</span></a>
                        </li>
                        <div id="notif_list">

                        <?php
                        $notification_lists = $db->query(
                            "SELECT A.*, B.* FROM notification_table as A INNER JOIN user_table as B ON A.sender_id = B.user_id WHERE reciever_id = '$admin_id' ORDER BY notif_created DESC"
                        );

                        if ($notification_lists->num_rows > 0) {
                            while (
                                $row = mysqli_fetch_array($notification_lists)
                            ) {
                                if ($row['notif_status'] === '0') { ?>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="notification-item">
                        <a style="display: contents;">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4><?= $row['fname'] ?></h4>
                                <p><?= $row['notif_message'] ?></p>
                                <p><?= getDateTimeDiff($row['notif_created']) ?></p>
                            </div>
                            </a>
                        </li>                  
                        <?php } else { ?>
                            <li>
                            <hr class="dropdown-divider">
                        </li>
                        <a style="display: contents;">
                        <li class="notification-item-read">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4><?= $row['fname'] ?></h4>
                                <p><?= $row['notif_message'] ?></p>
                                <p><?= getDateTimeDiff(
                                    $row['notif_created']
                                ) ?></p>
                            </div>
                        </li>     
                        </a>           
                                <?php }
                            }
                        } else {
                            echo '<p style="text-align: center;"> No notifications...</p>';
                        }
                        ?>
                    </div>
                    </ul>
                    <!-- End Notification Dropdown Items -->

                </li>
        
                <!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <?php if (isset($_SESSION['auth_user'])); ?>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION[
                            'auth_user'
                        ]['user_fname'] ?> <?= $_SESSION['auth_user'][
     'user_lname'
 ] ?></span>
                    </a>
                    <!-- End Profile Iamge Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= $_SESSION['auth_user'][
                                'user_fname'
                            ] ?> <?= $_SESSION['auth_user'][
     'user_lname'
 ] ?></h6>
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
    <aside id="sidebar" class="sidebar" style="background-color: #ffeffe;">                       
    <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item ">
                <a class="nav-link collapsed" href="home-page.php">
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
            <li class="nav-item ">
                <a class="nav-link collapsed" href="reports.php">
                    <i class="bi bi-grid"></i>
                    <span>Reports</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link collapsed " href="customer-tasks.php">
                    <i class="bi bi-grid"></i>
                    <span>Customer Tasks</span>
                </a>
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
            <h1>Reports</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home-page.php">Home</a></li>
                    <li class="breadcrumb-item active">Reports</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                              
            <div class="container">

                        <div class="card">
                        <div class="card-header" style="background-color: #ffeffe;">
                        <div class="row m-3">
            
            <div class="col-md-5">
                    <div class="form-group">
                        <label for="" class="control-label">Date From</label>
                        <input type="date" class="form-control" name="d1" id="d1" value="<?php echo date(
                            'Y-m-d',
                            strtotime($d1)
                        ); ?>">
                    </div>
                    </div>

                    <div class="col-md-5">
                    <div class="form-group">
                        <label for="" class="control-label">Date To</label>
                        <input type="date" class="form-control" name="d2" id="d2" value="<?php echo date(
                            'Y-m-d',
                            strtotime($d2)
                        ); ?>">
                    </div>
                    </div>

                   <div class="col mt-4">
                    <div class="form-group d-grid">
                    <button class="btn text-light fw-bold" type="button" id="filter" style="background-color: #00c5ce; font-size: 15px;">Filter &nbsp;<i class="fa fa-filter"></i></button>
                    </div>
                    </div>

                   
            </div>

                    
                        </div>

                        <div class="card-body" style="height: 600px; overflow-y: auto; overflow-x:auto;">

                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <a class="nav-link active fw-bold" data-bs-toggle="tab"  role="tab"  href="#transactions_tab">Transactions</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-bold" data-bs-toggle="tab" role="tab"  href="#machines_tab">Machines</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-bold"  data-bs-toggle="tab" role="tab"  href="#customers_tab">New Customers</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-bold"  data-bs-toggle="tab" role="tab"  href="#total_booked">Total Machine Used</a>
                        </li>
                        </ul>
                        
                        <div class="tab-content schedule-cont">

                        <!-- transactions Tab -->
                        <div class="tab-pane fade show active mt-3 p-4" id="transactions_tab">

                        <div class="col mt-2">
                    <div class="form-group" style="text-align-last: end;">
                    <button class="btn text-light fw-bold" type="button" id="print_transaction" style="background-color: #980799; font-size: 15px; ">Print &nbsp;<i class="fa fa-print"></i></button>
                    </div>
                    </div>

                        <div class="row mt-4" id="print-data">
                        <div style="width:100%">

                        <p class="text-center">

						<img style="width:70px;height:50px;" src="../assets/images/Navigation Bar/LOGO.png">
                       
                       
					</p>

					<p class="text-center">
						<large><b>Budz Laundry Sales Report</b></large>
					</p>

                    <p class="text-center">
                    <large><b>514 Lapu-Lapu St. Cor. Quirino Ave, Brgy. East</b></large>
                    </p>

					<p class="text-center">
						<large><b>From: <?php echo $data; ?></b></large>
					</p>

					</div>
					<table class='table table-bordered' id="total_transaction">
                        
						<thead style="background-color: #00c5ce;">
							<tr>
                                <th class="text-center text-light fw-bold">Date and Time</th>
                                <th class="text-center text-light fw-bold">Reference Number</th>
								<th class="text-center text-light fw-bold">Customer Name</th>
                                <th class="text-center text-light fw-bold">Description</th>
								<th class="text-center text-light fw-bold">Total Amount</th>
							</tr>
						</thead>
						<tbody>
                        
                        <?php
                        $total = 0;
                        $select_sales = $db->query(
                            "SELECT A.*, B.*, C.*,D.* FROM transaction_table AS A 
                            INNER JOIN price_category_table AS B ON A.category_id = B.category_id 
                            INNER JOIN customer_schedule_table AS C ON A.schedule_id = C.schedule_id 
                            INNER JOIN user_table AS D ON A.user_id = D.user_id WHERE date(transaction_date) between '$d1' and '$d2' ORDER BY transaction_date "
                        );

                        while ($row = $select_sales->fetch_assoc()):
                            $total += $row['total_amount']; ?>
							<tr class="text-center fw-bolder">
                                <td><?php echo date(
                                    'd-m-Y / g:h A',
                                    strtotime($row['transaction_date'])
                                ); ?></td>
                                <td style="background-color: #ffeffe;"><?php echo $row[
                                    'reference_number'
                                ]; ?></td>
								<td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                <td style="background-color: #ffeffe;"><?php if (
                                    $row['service_type'] == '1'
                                ) {
                                    echo 'Self-Service';
                                } elseif ($row['service_type'] == '2') {
                                    echo 'Full Service';
                                }
                                elseif ($row['service_type'] == '5') {
                                    echo 'Reward';
                                }  ?>
                                </td>
								<td class=""><?php echo number_format($row['total_amount'], 2); ?></td>
							</tr>
                            <?php
                        endwhile;
                        ?>
						</tbody>
						<tfoot>
							<tr style="background-color:#980799;">
								<td class="text-center text-light fw-bolder" colspan="4">Total</td>
								<td class="text-left text-light fw-bolder">₱ <?php echo number_format(
            $total,
            2
        ); ?></td>
							</tr>
						</tfoot>
					</table>
				</div>
                        </div>
                        <script>
                $(document).ready( function () {
                    $('#total_transaction').dataTable( {
  "pageLength": 35
} );
        } );
                </script>
  
                        <!-- /transactions tab -->

                        <!-- machines Tab -->
                        <div class="tab-pane fade  mt-3 p-4" id="machines_tab">
                        <div class="form-group" style="text-align-last: end;">
                    <button class="btn text-light fw-bold" type="button" id="print_machine" style="background-color: #980799; font-size: 15px; ">Print &nbsp;<i class="fa fa-print"></i></button>
                    </div>
                        <div class="row mt-4" id="print_data_machine">
                        <div style="width:100%">

                        <p class="text-center">

						<img style="width:70px;height:50px;" src="../assets/images/Navigation Bar/LOGO.png">
                       
                       
					</p>
					<p class="text-center">
						<large><b>Budz Laundry Machine Report</b></large>
                       
					</p>
                    <p class="text-center">
                    <large><b>514 Lapu-Lapu St. Cor. Quirino Ave, Brgy. East</b></large>
                    </p>
					<p class="text-center">
						<large><b>From: <?php echo $data; ?></b></large>
					</p>
					</div>
                    <div class="table table-responsive p-4">
					<table class="table table-bordered" id="total_machine_table" style="width: 100%;">
                        
						<thead style="background-color: #00c5ce;">
							<tr>
                                <th class="text-center text-light fw-bold" style="width: 80px;">Date and Time</th>
                                <th class="text-center text-light fw-bold">Machine Name</th>
								<th class="text-center text-light fw-bold">Model</th>
                                <th class="text-center text-light fw-bold">Status</th>
							</tr>
						</thead>
						<tbody>
                        
                        <?php
                     
                        $select_machine = $db->query("SELECT A.*, B.* FROM machine_table AS A INNER JOIN machine_status_table AS B ON A.machine_id = B.machine_id WHERE date(machine_status_date) BETWEEN '$d1' AND '$d2' ORDER BY A.machine_id"
                        );
                        
                        while ($row = $select_machine->fetch_assoc()): $status_date = date_create($row['machine_status_date']);?>
							<tr class="text-center fw-bolder">
                                <td><?php echo date_format($status_date, 'Y-m-d / H:i A') ?></td>
                                <td style="background-color: #ffeffe;"><?php echo $row[
                                    'machine_name'
                                ]; ?></td>
								<td><?php echo $row['machine_model']; ?></td>
                                <td style="background-color: #ffeffe;"><?php if (
                                    $row['machine_status'] == '0'
                                ) {
                                    echo 'Available';
                                } elseif ($row['machine_status'] == '1') {
                                    echo 'Unavailable';
                                } elseif ($row['machine_status'] == '2') {
                                    echo 'Maintenance';
                                } ?>
                                </td>
								
							</tr>
                            <?php endwhile;
                        ?>
						</tbody>
                        <tfoot>
                                <tr></tr>
                               </tfoot>
					</table>
                    </div>
    
				</div>
                        </div>
                        <script>
                $(document).ready( function () {
                    $('#total_machine_table').dataTable( {
  "pageLength": 35
} );
        } );
                </script>
                        <!-- /machines Tab -->

                        <!-- customer Tab -->
                        <div class="tab-pane fade mt-3 p-4" id="customers_tab" >
                        <div class="form-group" style="text-align-last: end;">
                    <button class="btn text-light fw-bold" type="button" id="print_customer" style="background-color: #980799; font-size: 15px; ">Print &nbsp;<i class="fa fa-print"></i></button>
                    </div>
                        <div class="row mt-4" id="print_data_customer">
                        <div style="width:100%">

                        <p class="text-center">

						<img style="width:70px;height:50px;" src="../assets/images/Navigation Bar/LOGO.png">
                       
                       
					</p>
					<p class="text-center">
						<large><b>Budz Laundry New Users Report</b></large>
                       
					</p>
                    <p class="text-center">
                    <large><b>514 Lapu-Lapu St. Cor. Quirino Ave, Brgy. East</b></large>
                    </p>
					<p class="text-center">
						<large><b>From: <?php echo $data; ?></b></large>
					</p>
					</div>
                    <br>
					<table class="table cell-border table-responsive " id="total_new_customer" style="width: 100%;">
                        
						<thead style="background-color: #00c5ce;">
							<tr>
                                <th class="text-center text-light fw-bold" style="width:90px">Date and Time</th>
								<th class="text-center text-light fw-bold">Name</th>
                                <th class="text-center text-light fw-bold">Email</th>
                                <th class="text-center text-light fw-bold">Address</th>
							</tr>
						</thead>
						<tbody class="text-center">
                            <?php
                            $total = 0;
                            $select_sales = $db->query(
                                "SELECT * FROM user_table WHERE date(created_at) between '$d1' and '$d2' ORDER BY created_at ");

                            $select_total =$db->query("SELECT COUNT(*) AS total_cust FROM user_table WHERE date(created_at) between '$d1' and '$d2' ORDER BY created_at ");
                            while($count = $select_total->fetch_assoc())
                            {
                                $total_cust = $count['total_cust'];
                            }

                            while ($row = $select_sales->fetch_assoc()): ?>
							<tr class="text-center fw-bolder">
                                <td ><?php echo date(
                                    'd-m-Y / g:h A',
                                    strtotime($row['created_at'])
                                ); ?></td>
								<td ><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                <td style="background-color: #ffeffe;"><?php echo $row[
                                    'email'
                                ]; ?></td>
                                <td ><?php echo $row['address']; ?></td>	
							</tr>
                            <?php endwhile;
                            ?>
						</tbody>	
                        <tfoot>

                        <tr style="background-color:#980799;">
								<td class="text-center text-light fw-bold" colspan="3">Total Customer</td>
								<td class="text-center text-light fw-bold"><?php echo $total_cust?></td>
							</tr>

                    </tfoot>
					</table>
                    
				</div>
                        </div>
                        <script>
                $(document).ready( function () {
                    $('#total_new_customer').dataTable( {
  "pageLength": 35
} );
        } );
                </script>

                        <!-- /customer Tab -->

                               <!-- Total Booked Tab -->
                               <div class="tab-pane fade mt-3 p-4" id="total_booked" >
                        <div class="form-group" style="text-align-last: end;">
                    <button class="btn text-light fw-bold" type="button" id="print_total_booked" style="background-color: #980799; font-size: 15px; ">Print &nbsp;<i class="fa fa-print"></i></button>
                    </div>
                        <div class="row mt-4" id="print_data_total_booked">
                        <div style="width:100%">

                        <p class="text-center">

						<img style="width:70px;height:50px;" src="../assets/images/Navigation Bar/LOGO.png">
                       
                       
					</p>
					<p class="text-center">
						<large><b>Budz Laundry New Users Report</b></large>
                       
					</p>
                    <p class="text-center">
                    <large><b>514 Lapu-Lapu St. Cor. Quirino Ave, Brgy. East</b></large>
                    </p>
					<p class="text-center">
						<large><b>From: <?php echo $data; ?></b></large>
					</p>
					</div>
                    <br>
                    <div class="table table-responsive">
					<table class='table cell-border table-responsive' id="total_booked_table" style="width:100%;">
                        
						<thead style="background-color: #00c5ce;" >
							<tr>
                                <th class="text-center fw-bolder" >Date and Time</th>
								<th class="text-center fw-bolder">Name</th>
                                <th class="text-center fw-bolder">Schedule</th>
                                <th class="text-center fw-bolder">Machine Used</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                            $total = 0;
                            $select_sales = $db->query(
                                "SELECT A.*, B.*, C.* FROM customer_schedule_table AS A INNER JOIN user_table AS B ON A.user_id = B.user_id INNER JOIN schedule_time_table AS C ON A.schedule_time_id = C.schedule_time_id WHERE date(A.date_created) between '$d1' and '$d2' ORDER BY A.date_created ");

                            $select_total =$db->query("SELECT SUM(machine_used) AS total_used FROM customer_schedule_table WHERE date(date_created) between '$d1' and '$d2' ORDER BY date_created ");
                            while($count = $select_total->fetch_assoc())
                            {
                                $total_used = $count['total_used'];



                            }

                            while ($row = $select_sales->fetch_assoc()): $start = date_create($row['starting_time']); $end = date_create($row['end_time']);?>

							<tr class="text-center">
                                <td ><?php echo date(
                                    'd-m-Y / g:h A',
                                    strtotime($row['date_created'])
                                ); ?></td>
								<td ><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                <td ><?php echo $row['date'];?> / <?php echo date_format($start, 'g:i A') ?> - <?php echo date_format($end, 'g:i A') ?></td>

                                <td ><?php echo $row['machine_used']; ?></td>	
							</tr>
                            <?php endwhile;
                            ?>
						</tbody>	
                        <tfoot>
							<tr style="background-color:#980799;">
								<td class="text-center text-light fw-bold" colspan="3">Total Machine Used</td>
								<td class="text-center text-light fw-bold"><?php echo $total_used?></td>
							</tr>
						</tfoot>
					</table>
                    </div>
				</div>
                

                <script>
                $(document).ready( function () {
                    $('#total_booked_table').dataTable( {
  "pageLength": 35
} );
        } );
                </script>
                        </div>
                        <!-- /total Booked tab -->

                        <!-- Wednesday Tab 
                        <div class="tab-pane fade mt-3" id="wednesday_tab" >    
                        </div>
                
                        <div class="tab-pane fade mt-3" id="thursday_tab" >                
                        </div>
                 
                        <div class="tab-pane fade mt-3" id="friday_tab" >
                
                        </div>
                      
                        <div class="tab-pane fade mt-3" id="saturday_tab" >
                   
                        </div>
                     /Saturday Tab -->
                        
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
    #print_data_machine p {
				display: none;
			}
    #print_data_customer p {
				display: none;
			}
    #print_data_total_booked p {
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
                text-align: center;
			}
			.text-left{
				text-align: left;
                font-weight: bold;
			}
			.text-center{
				text-align: center;
                font-weight: bold;
			}
			p{
				margin:unset;
			}

			p.text-center {
			    text-align: center;
			}
            .dataTables_filter {
display: none;
}
.dataTables_length
{
    display: none;
}
.dataTables_paginate
{
    display: none;
}
.dataTables_info
{
    display: none;
}
			
	</style>
</noscript>	


<script>
    
	$('#filter').click(function(){
		location.replace('reports.php?page=reports&d1='+$('#d1').val()+'&d2='+$('#d2').val())
	})
	$('#print_transaction').click(function(){
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
    $('#print_machine').click(function(){
		var newWin = document.open('BudzLaundry','_blank','height=500,width=600');
		var _html = $('#print_data_machine').clone();
		var ns = $('noscript').clone();
		newWin.document.write(ns.html())
		newWin.document.write(_html.html())
		newWin.document.close()
		newWin.print()
		setTimeout(function(){
			newWin.close()
		},1500)
	});
    $('#print_customer').click(function(){
		var newWin = document.open('BudzLaundry','_blank','height=500,width=600');
		var _html = $('#print_data_customer').clone();
		var ns = $('noscript').clone();
		newWin.document.write(ns.html())
		newWin.document.write(_html.html())
		newWin.document.close()
		newWin.print()
		setTimeout(function(){
			newWin.close()
		},1500)
	});

    $('#print_total_booked').click(function(){
		var newWin = document.open('BudzLaundry','_blank','height=500,width=600');
		var _html = $('#print_data_total_booked').clone();
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
    <script src="assets/datatables/datatables.min.js" crossorigin="anonymous"></script>
    <script src="assets/datatables/jquery.dataTables.min.js"></script>
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

      xmlhttp.open("GET", "code/notification-count.php?admin_id=<?php echo $admin_id; ?>&action=user");

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

      xmlhttp.open("GET", "code/notification-list.php?admin_id=<?php echo $admin_id; ?>&action=user");

      xmlhttp.send();
    };

    setInterval(function()
    {
      notification_list();
    }, 2000);
  

    function clear_notif()
    {
      action = '1';
      admin_id = <?php echo $admin_id; ?>;
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
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button onclick="window.location.href='booking-schedules.php'" style="width: 100%;" type="submit" class="btn btn-secondary">Go to schedules</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
         </div>
  