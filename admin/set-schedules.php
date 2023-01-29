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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Budz Laundry - Admin</title>
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
            <h1>Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home-page.php">Home</a></li>
                    <li class="breadcrumb-item active">Management</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">
            <div class="container-fluid px-4">
                        <div class="card">
                        <div class="card-header" style="background-color: #ffeffe;">
                    <h4 class="text-dark fw-bold lead">
                        Set Schedules
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
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Time Slots</span>
                        <button onclick="add_time('1')" class="btn text-light" style="background-color: #00c5ce;"><i class="fa fa-plus-circle"></i> Add Slot</button>
                        </h4>
                        <div class="time-container">
                        <?php 
                        $select_sunday = "SELECT * FROM schedule_time_table WHERE admin_id = '$admin_id' AND week_id = '1' ORDER BY starting_time ASC";
                        $select_sunday_result = mysqli_query($db, $select_sunday);
                            if($select_sunday_result->num_rows > 0)
                            {
                                while($row = mysqli_fetch_array($select_sunday_result))
                                {
                                    $schedule_time_id = $row['schedule_time_id'];
                                    $start = date_create($row['starting_time']);
                                    $end = date_create($row['end_time']);
                                    
                                    ?>
                                    <div class="time-slots">
                                        <?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A')?> <span class=" text-light">(Slots: <?php echo $row['slots'];?>)</span>
                                        <a onclick="edit_time('<?php echo $schedule_time_id ?>', '<?php echo $admin_id ?>')" class="delete_schedule">
                                    <i class="fa fa-pen"></i>
                                    </a>
                                    <a onclick="delete_time<?php echo $schedule_time_id ?>()" class="delete_schedule">
                                <i class="fa fa-times"></i>
                                </a>
                                    </div>
                                    <script type="text/javascript">
                                        function delete_time<?php echo $schedule_time_id?>()
                                        {
                                            Swal.fire({
                                                title: "Warning",
                                                text: "Are you sure to delete?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonText: "Yes"
                                            }).then((result) => 
                                            {
                                                if(result.isConfirmed)
                                                {
                                                    delete_week_time(<?php echo $schedule_time_id ?>);
                                                }
                                            });
                                        }
                                    </script>
                                    <?php
                                }
                            } else 
                            {
                                echo '<p class="text-muted mb-0">Not Available </p>';
                            }
                            ?>
                        </div>
                        </div>
                        <!-- /sunday tab -->
                        <!-- Monday Tab -->
                        <div class="tab-pane fade  mt-3" id="monday_tab">
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Time Slots</span>
                            <button onclick="add_time('2')" class="btn text-light" style="background-color: #00c5ce;"><i class="fa fa-plus-circle"></i> Add Slot</button>
                        </h4>
                        <div class="time-container">
                        <?php 
                        $select_sunday = "SELECT * FROM schedule_time_table WHERE admin_id = '$admin_id' AND week_id = '2' ORDER BY starting_time ASC";
                        $select_sunday_result = mysqli_query($db, $select_sunday);
                            if($select_sunday_result->num_rows > 0)
                            {
                                while($row = mysqli_fetch_array($select_sunday_result))
                                {
                                    $schedule_time_id = $row['schedule_time_id'];
                                    $start = date_create($row['starting_time']);
                                    $end = date_create($row['end_time']);
                                    ?>
                                    <div class="time-slots">
                                        <?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A')?><span class=" text-light"> (Slots: <?php echo $row['slots'];?>)</span>
                                        <a onclick="edit_time(<?php echo $schedule_time_id ?>)" class="delete_schedule">
                                    <i class="fa fa-pen"></i>
                                    </a>
                                    <a onclick="delete_time<?php echo $schedule_time_id ?>()" class="delete_schedule">
                                <i class="fa fa-times"></i>
                                </a>
                                    </div>
                                    <script type="text/javascript">
                                        function delete_time<?php echo $schedule_time_id?>()
                                        {
                                            Swal.fire({
                                                title: "Warning",
                                                text: "Are you sure to delete?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonText: "Yes"
                                            }).then((result) => 
                                            {
                                                if(result.isConfirmed)
                                                {
                                                    delete_week_time(<?php echo $schedule_time_id ?>);
                                                }
                                            });
                                        }
                                    </script>
                                    <?php
                                }
                            } else 
                            {
                                echo '<p class="text-muted mb-0">Not Available </p>';
                            }
                            ?>
                        </div>
                        </div>
                        <!-- /Monday Tab -->
                        <!-- Tuesday Tab -->
                        <div class="tab-pane fade mt-3" id="tuesday_tab" >
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Time Slots</span>
                            <button onclick="add_time('3')" class="btn text-light" style="background-color: #00c5ce;"><i class="fa fa-plus-circle"></i> Add Slot</button>
                        </h4>
                        <div class="time-container">
                        <?php 
                        $select_sunday = "SELECT * FROM schedule_time_table WHERE admin_id = '$admin_id' AND week_id = '3' ORDER BY starting_time ASC";
                        $select_sunday_result = mysqli_query($db, $select_sunday);
                            if($select_sunday_result->num_rows > 0)
                            {
                                while($row = mysqli_fetch_array($select_sunday_result))
                                {
                                    $schedule_time_id = $row['schedule_time_id'];
                                    $start = date_create($row['starting_time']);
                                    $end = date_create($row['end_time']);
                                    ?>
                                    <div class="time-slots">
                                        <?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A')?><span class=" text-light"> (Slots: <?php echo $row['slots'];?>)</span>
                                        <a onclick="edit_time(<?php echo $schedule_time_id ?>)" class="delete_schedule">
                                    <i class="fa fa-pen"></i>
                                    </a>
                                    <a onclick="delete_time<?php echo $schedule_time_id ?>()" class="delete_schedule">
                                <i class="fa fa-times"></i>
                                </a>
                                    </div>
                                    <script type="text/javascript">
                                        function delete_time<?php echo $schedule_time_id?>()
                                        {
                                            Swal.fire({
                                                title: "Warning",
                                                text: "Are you sure to delete?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonText: "Yes"
                                            }).then((result) => 
                                            {
                                                if(result.isConfirmed)
                                                {
                                                    delete_week_time(<?php echo $schedule_time_id ?>);
                                                }
                                            });
                                        }
                                    </script>
                                    <?php
                                }
                            } else 
                            {
                                echo '<p class="text-muted mb-0">Not Available </p>';
                            }
                            ?>
                        </div>
                        </div>
                        <!-- /Tuesday Tab -->
                        <!-- Wednesday Tab -->
                        <div class="tab-pane fade mt-3" id="wednesday_tab" >
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Time Slots</span>
                            <button onclick="add_time('4')" class="btn text-light" style="background-color: #00c5ce;"><i class="fa fa-plus-circle"></i> Add Slot</button>
                        </h4>
                        <div class="time-container">
                        <?php 
                        $select_sunday = "SELECT * FROM schedule_time_table WHERE admin_id = '$admin_id' AND week_id = '4' ORDER BY starting_time ASC";
                        $select_sunday_result = mysqli_query($db, $select_sunday);
                            if($select_sunday_result->num_rows > 0)
                            {
                                while($row = mysqli_fetch_array($select_sunday_result))
                                {
                                    $schedule_time_id = $row['schedule_time_id'];
                                    $start = date_create($row['starting_time']);
                                    $end = date_create($row['end_time']);
                                    ?>
                                    <div class="time-slots">
                                        <?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A')?><span class=" text-light"> (Slots: <?php echo $row['slots'];?>)</span>
                                        <a onclick="edit_time(<?php echo $schedule_time_id ?>)" class="delete_schedule">
                                    <i class="fa fa-pen"></i>
                                    </a>
                                    <a onclick="delete_time<?php echo $schedule_time_id ?>()" class="delete_schedule">
                                <i class="fa fa-times"></i>
                                </a>
                                    </div>
                                    <script type="text/javascript">
                                        function delete_time<?php echo $schedule_time_id?>()
                                        {
                                            Swal.fire({
                                                title: "Warning",
                                                text: "Are you sure to delete?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonText: "Yes"
                                            }).then((result) => 
                                            {
                                                if(result.isConfirmed)
                                                {
                                                    delete_week_time(<?php echo $schedule_time_id ?>);
                                                }
                                            });
                                        }
                                    </script>
                                    <?php
                                }
                            } else 
                            {
                                echo '<p class="text-muted mb-0">Not Available </p>';
                            }
                            ?>
                        </div>
                        </div>
                        <!-- /Wednesday Tab -->
                        <!-- Thursday Tab -->
                        <div class="tab-pane fade mt-3" id="thursday_tab" >
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Time Slots</span>
                            <button onclick="add_time('5')" class="btn text-light" style="background-color: #00c5ce;"><i class="fa fa-plus-circle"></i> Add Slot</button>
                        </h4>
                        <div class="time-container">
                        <?php 
                        $select_sunday = "SELECT * FROM schedule_time_table WHERE admin_id = '$admin_id' AND week_id = '5' ORDER BY starting_time ASC";
                        $select_sunday_result = mysqli_query($db, $select_sunday);
                            if($select_sunday_result->num_rows > 0)
                            {
                                while($row = mysqli_fetch_array($select_sunday_result))
                                {
                                    $schedule_time_id = $row['schedule_time_id'];
                                    $start = date_create($row['starting_time']);
                                    $end = date_create($row['end_time']);
                                    ?>
                                    <div class="time-slots">
                                        <?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A')?><span class=" text-light"> (Slots: <?php echo $row['slots'];?>)</span>
                                        <a onclick="edit_time(<?php echo $schedule_time_id ?>)" class="delete_schedule">
                                    <i class="fa fa-pen"></i>
                                    </a>
                                    <a onclick="delete_time<?php echo $schedule_time_id ?>()" class="delete_schedule">
                                <i class="fa fa-times"></i>
                                </a>
                                    </div>
                                    <script type="text/javascript">
                                        function delete_time<?php echo $schedule_time_id?>()
                                        {
                                            Swal.fire({
                                                title: "Warning",
                                                text: "Are you sure to delete?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonText: "Yes"
                                            }).then((result) => 
                                            {
                                                if(result.isConfirmed)
                                                {
                                                    delete_week_time(<?php echo $schedule_time_id ?>);
                                                }
                                            });
                                        }
                                    </script>
                                    <?php
                                }
                            } else 
                            {
                                echo '<p class="text-muted mb-0">Not Available </p>';
                            }
                            ?>
                        </div>
                        </div>
                        <!-- /Thursday Tab -->
                        <!-- Friday Tab -->
                        <div class="tab-pane fade mt-3" id="friday_tab" >
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Time Slots</span>
                            <button onclick="add_time('6')" class="btn text-light" style="background-color: #00c5ce;"><i class="fa fa-plus-circle"></i> Add Slot</button>
                        </h4>
                        <div class="time-container">
                        <?php 
                        $select_sunday = "SELECT * FROM schedule_time_table WHERE admin_id = '$admin_id' AND week_id = '6' ORDER BY starting_time ASC";
                        $select_sunday_result = mysqli_query($db, $select_sunday);
                            if($select_sunday_result->num_rows > 0)
                            {
                                while($row = mysqli_fetch_array($select_sunday_result))
                                {
                                    $schedule_time_id = $row['schedule_time_id'];
                                    $start = date_create($row['starting_time']);
                                    $end = date_create($row['end_time']);
                                    ?>
                                    <div class="time-slots">
                                        <?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A')?><span class=" text-light"> (Slots: <?php echo $row['slots'];?>)</span>
                                        <a onclick="edit_time(<?php echo $schedule_time_id ?>)" class="delete_schedule">
                                    <i class="fa fa-pen"></i>
                                    </a>
                                    <a onclick="delete_time<?php echo $schedule_time_id ?>()" class="delete_schedule">
                                <i class="fa fa-times"></i>
                                </a>
                                    </div>
                                    <script type="text/javascript">
                                        function delete_time<?php echo $schedule_time_id?>()
                                        {
                                            Swal.fire({
                                                title: "Warning",
                                                text: "Are you sure to delete?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonText: "Yes"
                                            }).then((result) => 
                                            {
                                                if(result.isConfirmed)
                                                {
                                                    delete_week_time(<?php echo $schedule_time_id ?>);
                                                }
                                            });
                                        }
                                    </script>
                                    <?php
                                }
                            } else 
                            {
                                echo '<p class="text-muted mb-0">Not Available </p>';
                            }
                            ?>
                        </div>
                        </div>
                        <!-- /Friday Tab -->
                        <!-- Saturday Tab -->
                        <div class="tab-pane fade mt-3" id="saturday_tab" >
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Time Slots</span>
                            <button onclick="add_time('7')" class="btn text-light" style="background-color: #00c5ce;"><i class="fa fa-plus-circle"></i> Add Slot</button>
                        </h4>
                        <div class="time-container">
                        <?php 
                        $select_sunday = "SELECT * FROM schedule_time_table WHERE admin_id = '$admin_id' AND week_id = '7' ORDER BY starting_time ASC";
                        $select_sunday_result = mysqli_query($db, $select_sunday);
                            if($select_sunday_result->num_rows > 0)
                            {
                                while($row = mysqli_fetch_array($select_sunday_result))
                                {
                                    $schedule_time_id = $row['schedule_time_id'];
                                    $start = date_create($row['starting_time']);
                                    $end = date_create($row['end_time']);
                                    ?>
                                    <div class="time-slots">
                                        <?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A')?><span class=" text-light"> (Slots: <?php echo $row['slots'];?>)</span>
                                        <a onclick="edit_time(<?php echo $schedule_time_id ?>)" class="delete_schedule">
                                    <i class="fa fa-pen"></i>
                                    </a>
                                    <a onclick="delete_time<?php echo $schedule_time_id ?>()" class="delete_schedule">
                                <i class="fa fa-times"></i>
                                </a>
                                    </div>
                                    <script type="text/javascript">
                                        function delete_time<?php echo $schedule_time_id?>()
                                        {
                                            Swal.fire({
                                                title: "Warning",
                                                text: "Are you sure to delete?",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonText: "Yes"
                                            }).then((result) => 
                                            {
                                                if(result.isConfirmed)
                                                {
                                                    delete_week_time(<?php echo $schedule_time_id ?>);
                                                }
                                            });
                                        }
                                    </script>
                                    <?php
                                }
                            } else 
                            {
                                echo '<p class="text-muted mb-0">Not Available </p>';
                            }
                            ?>
                        </div>
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
                                    <input class="form-control start" type="time" min="07:00" max="19:00" required>
                                    </div> 
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                    <label>End Time</label>
                                    <input class="form-control end" type="time" min="07:00" max="19:00" required>
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
<!-- add script --> 
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
                Swal.fire("Updated Successfully!", "", "success");
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
            action = 6;
            schedule_time_id = data;
            $.ajax({
                url: "function/action-code.php",
                type: "POST",
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
  