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

$TimeZone = new DateTime();
$TimeZone->setTimezone(new DateTimeZone('Asia/Manila'));
$AsiaTime = $TimeZone->format('Y-m-d');

$admin_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Budz Laundry Hub - Admin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/images/Navigation Bar/LOGO.png" rel="icon">
    <link href="../assets/images/Navigation Bar/LOGO.png" rel="apple-touch-icon">

    <!-- Google Fonts and icons -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/datatables/datatables.min.css"/>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css"/>

     <!-- sweetAlert -->
     <link rel="stylesheet" href="assets/css/sweetalert2.min.css"/>
        <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.min.js"></script>

    <!-- dataTables -->

        <link rel="stylesheet" type="text/css" href="assets/datatables/jquery.dataTables.css">



        <!-- CSS inline code -->
        <style>
            .btn:hover {
                background: #980799;
                box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;
            }
            .time-container {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
            }

            .time-slots {
                background-color: #980799;
                border: 1px solid #980799;
                border-radius: 4px;
                color: #fff;
                font-size: 14px;
                margin: 10px 10px 0 0;
                padding: 6px 15px;
            }

            .time-slots a {
                color: #e642e6;
                display: inline-block;
                margin-left: 5px;
            }

            .time-slots a:hover {
                color: #fff;
            }

            .edit-link {
                color: #e642e6;
                font-size: 16px;
                margin-top: 4px;
            }

            .nav-link {
                color: #e642e6;
            }

            .nav-link:hover {
                color: #980799;
            }

            .schedules {
                background-color: #fff;
                border: 1px solid #f0f0f0;
                border-radius: 4px;
                display: flex;
                flex-wrap: wrap;
                margin-bottom: 20px;
                padding: 20px;
            }

            .schedule-list {
                padding: 20px;
                background-color: #fff;
                border: 1px solid #f0f0f0;
            }

            .schedule-info {
                margin-right: auto;
                text-align: left;
            }

            .schedule-choices {
                margin-left: auto;
                margin-top: auto;
                margin-bottom: auto;
            }

            .button-div {
                margin-right: auto;
                text-align: left;
            }

            .message-cont {
                padding-left: 15px;
                background: #FFFFFF;
                margin: 5px 5px 5px 5px;
                display: grid;
                border-radius: 10px;
                transition: color .3s ease-in-out, box-shadow .3s ease-in-out;
            }

            .message-cont:hover {
                box-shadow: inset 350px 0 0 0 #ffe1ff;
            }

            .message-content-read {
                padding-left: 15px;
                background: #ffe1ff;
                margin: 5px 5px 5px 5px;
                display: grid;
                border-radius: 10px;
                transition: color .3s ease-in-out, box-shadow .3s ease-in-out;
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

            <div class="container">
                        
                        <div class="card" style="background-color: #ffeffe; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">

                        <div class="card-header" style="background-color: #ffeffe; border-color: rgba(252, 167, 246, 0.44);">
                            <h4 class="text-dark fw-bold lead">Reports</h4>
                        </div>
                        <div class="card-body mt-4" id="statistics_card">
                         
                         <!-- total user -->
                         <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body mt-2 ">
                                       Registered Users
                                        <?php
                                        $dash_user_query =
                                            'SELECT * FROM user_table';
                                        $dash_user_query_run = mysqli_query(
                                            $db,
                                            $dash_user_query
                                        );

                                        if (
                                            $user_total = mysqli_num_rows(
                                                $dash_user_query_run
                                            )
                                        ) {
                                            echo '<h4 class="mb-0 mt-2"><i class="fa fa-users fa-fw"></i> ' .
                                                $user_total .
                                                ' </h4>';
                                        } else {
                                            echo '<h4 class="mb-0 mt-2"><i class="fa fa-users fa-fw"></i> No data </h4>';
                                        }
                                        ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="registered-users.php">View Details</a>
                                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- total profits -->
                                               <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-black mb-4">
                                    <div class="card-body mt-2">
                                         Profit Today
                                        <?php
                                        $date_form = date_create($AsiaTime);
                                        $total_profit = $db->query(
                                            "SELECT SUM(total_amount) as `count` FROM transaction_table where date(transaction_date)= '" .date('Y-m-d') ."'");

                                        if ($total_profit->num_rows > 0) {
                                            while (
                                                $rows = mysqli_fetch_array(
                                                    $total_profit
                                                )
                                            ) {
                                                $total_amount = number_format(
                                                    $rows['count'],
                                                    2
                                                );

                                                echo '<h4 class="mb-0 mt-2"><i class="fa fa-peso-sign fa-fw"></i> ' .
                                                    $total_amount .
                                                    ' </h4>';
                                            }
                                        } else {
                                            echo '<h4 class="mb-0 mt-2"><i class="fa fa-peso-sign fa-fw"></i> No data </h4>';
                                        }
                                        ?>                      
                                    </div>      
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="reports.php">View Details</a>
                                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            
                            <!-- total profits -->
                            <div class="col-xl-3 col-md-6">
                                    <div class="card bg-success text-white mb-4">
                                        <div class="card-body mt-2">
                                                New Customers
                                            <?php
                                            $select_customer = $db->query(
                                                "SELECT count(user_id) as `count` FROM user_table where date(created_at)= '" .
                                                    date('Y-m-d') .
                                                    "'"
                                            );

                                            if (
                                                $select_customer->num_rows > 0
                                            ) {
                                                while (
                                                    $row = mysqli_fetch_array(
                                                        $select_customer
                                                    )
                                                ) {
                                                    $total_customer = number_format(
                                                        $row['count']
                                                    );

                                                    echo '<h4 class="mb-0 mt-2"><i class="fa fa-user"></i> ' .
                                                        $total_customer .
                                                        ' </h4>';
                                                }
                                            } else {
                                                echo '<h4 class="mb-0 mt-2"><i class="fa fa-user"></i> No data </h4>';
                                            }
                                            ?>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="reports.php">View Details</a>
                                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                    </div>
                                </div>

                                <!-- total user -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body mt-2">
                                        Booked Schedule Today
                                        <?php
                                        $select_schedule = $db->query(
                                            "SELECT COUNT(*) AS `schedule_count` FROM customer_schedule_table WHERE date(date_created)= '" .
                                                date('Y-m-d') .
                                                "'"
                                        );

                                        if ($select_schedule->num_rows > 0) {
                                            while (
                                                $row = mysqli_fetch_array(
                                                    $select_schedule
                                                )
                                            ) {
                                                $total_booked =
                                                    $row['schedule_count'];

                                                echo '<h4 class="mb-0"><i class="fa fa-book fa-fw"></i> ' .
                                                    $total_booked .
                                                    ' </h4>';
                                            }
                                        } else {
                                            echo '<h4 class="mb-0"><i class="fa fa-book fa-fw"></i> No data </h4>';
                                        }
                                        ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="booking-schedules.php">View Details</a>
                                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                               <!-- total redeem -->

                               <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body mt-2">
                                       Redeems
                                        
                                        <?php
                                        $redeem_total = $db->query(
                                            "SELECT COUNT(*) AS redeem_count FROM redeemed_table WHERE date(redeemed_date)= '" .
                                                date('Y-m-d') .
                                                "'"
                                        );

                                        if ($redeem_total->num_rows > 0) {
                                            while (
                                                $row = mysqli_fetch_array(
                                                    $redeem_total
                                                )
                                            ) {
                                                $redeem_count =
                                                    $row['redeem_count'];
                                            }
                                            echo '<h4 class="mb-0"><i class="fa fa-barcode fa-fw"></i> ' .
                                                $redeem_count .
                                                ' </h4>';
                                        } else {
                                            echo '<h4 class="mb-0"><i class="fa fa-barcode fa-fw"></i> No data </h4>';
                                        }
                                        ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="redeem-history.php">View Details</a>
                                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                        </div>

                         <!-- total redeem -->

                         <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body mt-2">
                                        Machines
                                        
                                        <?php
                                        $machine_select = $db->query(
                                            'SELECT * FROM machine_table'
                                        );

                                        if (
                                            $machine_select = mysqli_num_rows(
                                                $machine_select
                                            )
                                        ) {
                                            echo '<h4 class="mb-0"><i class="fa fa-box fa-fw"></i> ' .
                                                $machine_select .
                                                ' </h4>';
                                        } else {
                                            echo '<h4 class="mb-0"><i class="fa fa-box fa-fw"></i> No data </h4>';
                                        }
                                        ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="machines.php">View Details</a>
                                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                        </div>

                              <!-- total machine Used -->

                              <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4" style="background-color:darkorange;">
                                    <div class="card-body mt-2">
                                       Machine Used Today
                                        
                                        <?php
                                        $total_machine_used = $db->query(
                                            "SELECT SUM(machine_used) AS 'total' FROM customer_schedule_table WHERE date(date_created)= '" .
                                                $AsiaTime.
                                                "'"
                                        );

                                        if ($total_machine_used->num_rows > 0) {
                                            while (
                                                $row = mysqli_fetch_array(
                                                    $total_machine_used
                                                )
                                            ) {
                                                $total =
                                                    $row['total'];
                                            }
                                            echo '<h4 class="mb-0"><i class="fa fa-box fa-fw"></i> ' .
                                                $total .' </h4>';
                                        } else {
                                            echo '<h4 class="mb-0"><i class="fa fa-box fa-fw"></i> No data </h4>';
                                        }
                                        ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="reports.php">View Details</a>
                                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                        </div>
                        </div>
            </div>
                       
            </div>
        </section>

    </main>
    <!-- /body content -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Budz Laundry</span></strong>. All Rights Reserved
        </div>
    </footer>
    <!-- End Footer -->


            <script src="assets/js/jquery.min.js"></script>
            <script>
              $(function() {
                    $("#total_cost, #payment").on("input", total);
                    function total() {
                    $("#total_change").val(Number($("#payment").val()) - Number($("#total_cost").val()));
                    }
                });
            </script>



                    

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>    
    <script src="assets/js/jquery.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/datatables/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/fontawesome.all.js" crossorigin="anonymous"></script>
    

    <script type="text/javascript">
$(document).ready(function() {
        var table = $('#search_user').DataTable();
          
        /* Add event listeners to the two range filtering inputs */
        $('#min, #max').keyup( function() {
            table.draw();
        } );
    } );
</script>

<script type="text/javascript">
    function search_code()
    {
        $('#search_modal').modal("show");
    };
    function setup_schedules()
    {
        $('#setup_schedules').modal("show");
    }
    
    function transaction_complete(sched_id, code, user_id)
{
    $('#complete_modal').modal("show");
    $('#budz_code').val(code);
    $('#schedule_id').val(sched_id);
    $('#user_id').val(user_id);
    
};
    $('#transact_form').submit(function(e)
    {
        action = 5;
        e.preventDefault();
        budz_code = $('#budz_code').val();
        schedule_id = $('#schedule_id').val();
        total_cost = $('#total_cost').val();
        payment = $('#payment').val();
        total_change = $('#total_change').val();
        user_id = $('#user_id').val()
        user_points = 2;
        $.ajax({
            url: "function/action-code.php",
            type: "POST",
            datatype: 'json',
            data:
            {
                budz_code: budz_code,
                user_id: user_id,
                schedule_id: schedule_id,
                total_cost: total_cost,
                payment: payment,
                total_change: total_change,
                user_points: user_points,
                action: action,
                
            },
            success: function()
            {
                Swal.fire("Success", "Success","success");
                $('#complete_modal').modal("hide");
                setTimeout(() => {
                document.location.reload();
                }, 1000);
                console.log("Success");
            },
            error: function()
            {
                Swal.fire("Error", "error","error");
                $('#complete_modal').modal("hide");
                setTimeout(() => {
                document.location.reload();
                }, 1000);
                console.log("error");
            }
        });
    });
function close_modal()
{
    $('#search_modal').modal("hide");
};
</script>

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
    }, 1000);


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
    }, 1000);



    function clear_notif()
    {
      action = '1';
      admin_id = <?php echo $admin_id; ?>;
      $.ajax({
        url: "code/function.php",
        type: "POST",
        dataType: "text",
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
<script type="text/javascript">
    function add_time(data)
    {
        $('#week').val(data);
        $('#add_time_slot').modal("show");
        $('.modal-title').text("Add Schedule Slot");
    }
    $('#add_time_form').submit(function(e)
    {
        action = 1;
        e.preventDefault();
        week_id = $('#week').val();
        admin_id = $('#admin_id').val();
        var start =[];
        var end =[];
        $('.start').each(function()
        {
            start.push($(this).val());
        });
        $('.end').each(function()
        {
            end.push($(this).val());
        });
        $.ajax({
            url: "function/action-code.php",
            type: "POST",
            datatype: "json",
            data:
            {
                week_id: week_id,
                admin_id: admin_id,
                start: start,
                end: end,
                action: action,
            },
        })
            .done(function(response)
            {
                console.log("success");
                Swal.fire("Added Successfully!", "", "success");
                $("#add_time_slot").modal("hide");
                $("#sunday_tab").load("sched/sunday.php");
                $("#monday_tab").load("sched/monday.php");
                $("#tuesday_tab").load("sched/tuesday.php");
                $("#wednesday_tab").load("sched/wednesday.php");
                $("#thursday_tab").load("sched/thursday.php");
                $("#friday_tab").load("sched/friday.php");
                $("#saturday_tab").load("sched/saturday.php");
            })
            .fail(function(response)
            {
                console.log("error");
                Swal.fire("Something went wrong!", "", "error");
                $("#add_time_slot").modal("hide");
                $("#sunday_tab").load("sched/sunday.php");
                $("#monday_tab").load("sched/monday.php");
                $("#tuesday_tab").load("sched/tuesday.php");
                $("#wednesday_tab").load("sched/wednesday.php");
                $("#thursday_tab").load("sched/thursday.php");
                $("#friday_tab").load("sched/friday.php");
                $("#saturday_tab").load("sched/saturday.php");
            }) 
        });
        function edit_time(sched_id, admin_id)
    {
        $('#schedule_time_id').val(sched_id);
        $('#edit_time_slot').modal("show");
        $('.modal-title').text("Edit Schedule Slot");
    }
    $('#edit_time_form').submit(function(e)
    {
        action = 2;
        e.preventDefault();
        schedule_time_id = $('#schedule_time_id').val();
        admin_id =  $('#edit_admin_id').val();
        start = $('#edit_start').val();
        end = $('#edit_end').val();
        $.ajax({
            url: "function/action-code.php",
            type: "POST",
            datatype: "json",
            data:
            {
                schedule_time_id: schedule_time_id,
                admin_id: admin_id,
                start: start,
                end: end,
                action: action,
            },
        })
            .done(function()
            {
                console.log("success");
                Swal.fire("Edited Successfully!", "", "success");
                $("#edit_time_slot").modal("hide");
                $("#sunday_tab").load("sched/sunday.php");
                $("#monday_tab").load("sched/monday.php");
                $("#tuesday_tab").load("sched/tuesday.php");
                $("#wednesday_tab").load("sched/wednesday.php");
                $("#thursday_tab").load("sched/thursday.php");
                $("#friday_tab").load("sched/friday.php");
                $("#saturday_tab").load("sched/saturday.php");
            })
            .fail(function()
            {
                console.log("error");
                Swal.fire("Something went wrong!", "", "error");
                $("#edit_time_slot").modal("hide");
                $("#sunday_tab").load("sched/sunday.php");
                $("#monday_tab").load("sched/monday.php");
                $("#tuesday_tab").load("sched/tuesday.php");
                $("#wednesday_tab").load("sched/wednesday.php");
                $("#thursday_tab").load("sched/thursday.php");
                $("#friday_tab").load("sched/friday.php");
                $("#saturday_tab").load("sched/saturday.php");
            }); 
        });    
        function delete_week_time(data)
           { 
            action = 3;
            schedule_time_id = data;
            $.ajax({
                url: "function/action-code.php",
                type: "POST",
                datatype: "json",
                data:
                {
                    schedule_time_id: schedule_time_id,
                    action: action,
                },
                success:function()
            {
                console.log("success");
                Swal.fire("Deleted Successfully!", "", "success");
                $("#add_time_slot").modal("hide");
                $("#sunday_tab").load("sched/sunday.php");
                $("#monday_tab").load("sched/monday.php");
                $("#tuesday_tab").load("sched/tuesday.php");
                $("#wednesday_tab").load("sched/wednesday.php");
                $("#thursday_tab").load("sched/thursday.php");
                $("#friday_tab").load("sched/friday.php");
                $("#saturday_tab").load("sched/saturday.php");
            },
                error:function()
            {
                console.log("error");
                Swal.fire("Something went wrong!", "", "error");
                $("#add_time_slot").modal("hide");
                $("#sunday_tab").load("sched/sunday.php");
                $("#monday_tab").load("sched/monday.php");
                $("#tuesday_tab").load("sched/tuesday.php");
                $("#wednesday_tab").load("sched/wednesday.php");
                $("#thursday_tab").load("sched/thursday.php");
                $("#friday_tab").load("sched/friday.php");
                $("#saturday_tab").load("sched/saturday.php");
            }
            });
        }
</script>
</body>

</html>

  <!-- Add Time Modal --> 
  <div class="modal fade custom-modal" id="add_time_slot">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
        <div class="modal-body">
            <form id="add_time_form" method="post">
                <div class="hours-info">
                    <div class="row form-row hours-cont">
                        <div class="col-12 col-md-10">
                            <div class="row form-row">
                            <input type="hidden" class="form-control display" id="week" name="week" value="">
                            <input type="hidden" class="form-control display" id="admin_id" name="admin_id" value="<?php echo $admin_id ?>">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                    <label>Start Time</label>
                                    <input class="form-control start" type="time" required>
                                    </div> 
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                    <label>End Time</label>
                                    <input class="form-control end" type="time" required>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="submit-section text-center mt-4">
                        <button type="submit" class="btn btn-primary submit-btn" name="add">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Time Slot Modal -->
<div class="modal fade custom-modal" id="edit_time_slot">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</button>
</div>
<div class="modal-body">
<form id="edit_time_form" method="post">
<div class="hours-info">
<div class="display">
<input class="form-control" type="hidden" id="schedule_time_id" name="schedule_time_id" value="">
<input class="form-control" type="hidden" id="edit_admin_id" name="edit_admin_id" value="<?php echo $admin_id ?>">
</div>
<div class="row form-row hours-cont">
<div class="col-12 col-md-10">
<div class="row form-row">
<div class="col-12 col-md-6">
<div class="form-group">
<label>Start Time</label>
<input class="form-control" type="time" id="edit_start" name="edit_start" value="">
</div> 
</div>
<div class="col-12 col-md-6">
<div class="form-group">
<label>End Time</label>
<input class="form-control" type="time"  id="edit_end" name="edit_end"value="">
</div> 
</div>
</div>
</div>
</div>
</div>
<div class="submit-section text-center mt-4">
<button type="submit" class="btn btn-primary submit-btn" name="edit">Save Changes</button>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- /Edit Time Slot Modal -->
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
  