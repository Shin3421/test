<?php
session_start();
include('../connection.php');
include('../assets/time.php');
$phTimeZone = new DateTime();
$phTimeZone->setTimezone(new DateTimeZone('Asia/Manila'));
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
    <title>Budz Laundry Hub - Admin</title>
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
    <link rel="stylesheet" href="../assets/css/CalendarPicker.style.css">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css"/>
     <!-- sweetAlert -->
     <link rel="stylesheet" href="assets/css/sweetalert2.min.css"/>
        <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.min.js"></script>

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
            .available-info {
                font-size: 13px;
                color: #757575;
                font-weight: 400;
                list-style: none;
                padding: 0;
                margin-bottom: 15px;
            }

            .display-on {
    display: block;
}

.display {
    display: none;
}

.center {
    margin-left: auto;
    margin-right: auto;
}

input[type="radio"] {
    display: none;
}

label.not {
    position: relative;
    color: #ddd;
    font-size: 15px;
    border: 2px solid #ddd;
    border-radius: 5px;
    padding: 10px 50px;
    display: flex;
    align-items: center;
}

label.not:before {
    content: "";
    width: 12px;
    height: 12px;
    border: 3px solid #ddd;
    border-radius: 50%;
    margin-right: 20px;
    transform: scale(1.5);
    transition: all 0.3s ease;
}

label.available {
    position: relative;
    color: #0069d9;
    font-size: 15px;
    border: 2px solid #0069d9;
    border-radius: 5px;
    cursor: pointer;
    padding: 10px 50px;
    display: flex;
    align-items: center;
}

label.available:before {
    content: "";
    width: 12px;
    height: 12px;
    border: 3px solid #0069d9;
    border-radius: 50%;
    margin-right: 20px;
    transform: scale(1.5);
    transition: all 0.3s ease;
}

input[type="radio"]:checked+label.available {
    background-color: #0069d9;
    color: #fff;
}

input[type="radio"]:checked+label.available:before {
    height: 16px;
    width: 16px;
    border: 3px solid #ffffff;
    background-color: #0069d9;
}

        </style>

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
                       Booking Schedules
                    </h4>    
                        </div>
                        <div class="card-body mt-4">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" role="tab"  href="#accepted_tab">Schedules</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link "  data-bs-toggle="tab" role="tab"  href="#cancelled_tab">Canceled</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " data-bs-toggle="tab" role="tab"  href="#reschedule_tab">Re-scheduled</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " data-bs-toggle="tab" role="tab"  href="#completed_tab">Completed</a>
                        </li>
                        </ul>
                        <div class="tab-content schedule-cont">
                        <!-- accepted tab -->

                        <div class="tab-pane fade mt-3 show active" id="accepted_tab" >
                        <div class="table table-responsive p-4">
                    <table id="datatable_accept" class="table table-hover" style="width: 100%;">
                        <thead style="text-align: center;">
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Schedule</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Budz Code</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                        <?php
                        $accept_table =$db->query("SELECT A. *, B. *,C. * FROM customer_schedule_table as A 
                        INNER JOIN schedule_time_table AS B ON A.schedule_time_id = B.schedule_time_id 
                        INNER JOIN user_table AS C ON A.user_id = C.user_id 
                        WHERE A.status = '2' OR A.status = '5' ORDER BY A.date ASC");
                        if($accept_table->num_rows > 0)
                        {
                            while($row = mysqli_fetch_array($accept_table))
                            {
                                $date = date_create($row['date']);
                                $start = date_create($row['starting_time']);
                                $end = date_create($row['end_time']);
                                $date_created = date_create($row['date_created']);
                                $sched_id = $row['schedule_id'];
                                $user_id = $row['user_id'];
                                $code = $row['booking_code'];
                                $name = $row['fname'].' '.$row['lname'];
                        ?>
                            <tr>
                                <td><?php echo $row['fname'].' '.$row['lname']?></td>
                                <td><?php echo $date->format("M d, Y").' / '. date_format($start, 'g:i A').' to '.date_format($end, 'g:i A') ?></td>
                                <td><?php if($row['service_type'] == '1')
                                {
                                    echo '<span class="badge text-bg-info">Self-Service</span>';
                                }
                                elseif($row['service_type'] == '2')
                                {
                                    echo '<span class="badge text-bg-info">Full Service</span>';
                                }
                                elseif($row['service_type'] == '5')
                                {
                                    echo '<span class="badge text-bg-warning">Reward</span>';
                                }
                                ?>
                               </td>
                                <td><?php echo $row['booking_code'] ?></td>
                                <td><span class="badge text-bg-primary"><?php if($row['status'] == '2')
                                {
                                    echo 'Pending';
                                }elseif ($row['status'] == '5')
                                {
                                    echo 'Pending';
                                }
                                ?></span></td>    
                                <td class=" text-lg-center text-info"><a class="btn text-light" style="background-color: #00c5ce;" onclick="transaction_complete('<?php echo $name ?>','<?php echo $sched_id?>','<?php echo $user_id ?>')">Pay</a>
                                
                                <a class="btn btn-secondary" onclick="showReschedule('<?php echo $sched_id?>','<?php echo $user_id ?>')">Re-schedule</a></td>

                                <!--<a class="btn " style="background-color: #ed4949; color:#FFF;" onclick="cancel_modal('<?php echo $sched_id?>')">Cancel</a></td>

                                <script type="text/javascript">                       
                                    function cancel_modal(id)
                                    {  
                                        Swal.fire({
                                            title: "Warning",
                                            text: "Are you sure to cancel the schedule?",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonText: "Yes"
                                        }).then((result) =>
                                        {
                                            if(result.isConfirmed)
                                            {
                                                cancel_schedule(id);
                                            }
                                        });
                                    }
                                    </script>  -->
                            </tr>   
                        <?php 
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                                <tr></tr>
                               </tfoot>
                    </table>
                        </div>
                        <script src="assets/js/jquery.min.js"></script>
            <script>
              $(function() {
                    $("#total_cost, #payment").on("input", total);
                    function total() {
                    $("#total_change").val(Number($("#payment").val()) - Number($("#total_cost").val()));
                    }
                });
            </script>
                        </div>
                        <!-- /accepted tab -->
                        <!-- cancelled tab -->
                        <div class="tab-pane fade mt-3" id="cancelled_tab">
                <div class="table table-responsive p-4">
                    <table id="datatable_cancel" class="table table-hover" style="width: 100%;" >
                        <thead>
                            <tr >
                                <th class="text-center">Name</th>
                                <th class="text-center">Schedule</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Budz Code</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Date</th>
                            </tr>
                        </thead >
                        <tbody style="text-align: center;">
                        <?php
                        $cancel_table =$db->query("SELECT A.*, B. *,C.* FROM cancel_table as A INNER JOIN schedule_time_table AS B ON A.schedule_time_id = B.schedule_time_id INNER JOIN user_table AS C ON A.user_id = C.user_id WHERE A.status = '3' ORDER BY A.date ASC");
                        if($cancel_table->num_rows > 0)
                        {
                            while($row = mysqli_fetch_array($cancel_table))
                            {
                                $date = date_create($row['date']);
                                $start = date_create($row['starting_time']);
                                $end = date_create($row['end_time']);
                                $date_created = date_create($row['date_created']);
                        ?>
                            <tr>
                                <td><?php echo $row['fname'].' '.$row['lname']?></td>
                                <td><?php echo $date->format("M d, Y").' / '. date_format($start, 'g:i A').' - '.date_format($end, 'g:i A') ?></td>
                                <td><?php if($row['service_type'] == '1')
                                {
                                    echo '<span class="badge text-bg-info">Self-Service</div>';
                                }
                                elseif($row['service_type'] == '2')
                                {
                                    echo '<span class="badge text-bg-info">Full Service</div>';
                                }
                                elseif($row['service_type'] == '5')
                                {
                                    echo '<span class="badge text-bg-warning">Reward</div>';
                                }
                                ?>
                                </span></td>
                                <td><?php echo $row['booking_code'] ?></td>
                                <td><span class="badge text-bg-danger"><?php if($row['status'] == '3'){echo 'Cancelled';}?></span></td>
                                <td><?php echo date_format($date_created, 'M d, Y g:i A') ?></td>
                            </tr>
                        <?php 
                            }
                        }
                        ?>
                               </tbody>
                               <tfoot>
                                <tr></tr>
                               </tfoot>
                    </table>
                </div>
                        </div>
                        <!--/cancelled tab -->
                        <!-- completed tab -->
                        <div class="tab-pane fade mt-3" id="completed_tab">
                <div class="table table-responsive p-5">
                    <table id="datatable_complete" class="table table-hover">
                        <thead style="text-align: center;">
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Schedule</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Budz Code</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Date</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                        <?php
                        $complete_table =$db->query("SELECT A. *, B. *,C. * FROM customer_schedule_table as A INNER JOIN schedule_time_table AS B ON A.schedule_time_id = B.schedule_time_id INNER JOIN user_table AS C ON A.user_id = C.user_id WHERE A.status = '4' ORDER BY A.date ASC");
                        if($complete_table->num_rows > 0)
                        {
                            while($row = mysqli_fetch_array($complete_table))
                            {
                                $date = date_create($row['date']);
                                $start = date_create($row['starting_time']);
                                $end = date_create($row['end_time']);
                                $date_created = date_create($row['date_created']);
                        ?>
                            <tr>
                                <td><?php echo $row['fname'].' '.$row['lname']?></td>
                                <td><?php echo $date->format("M d, Y").' / '. date_format($start, 'g:i A').' - '.date_format($end, 'g:i A') ?></td>
                                <td><?php if($row['service_type'] == '1')
                                {
                                    echo '<span class="badge text-bg-info">Self-Service</span>';
                                }
                                elseif($row['service_type'] == '2')
                                {
                                    echo '<span class="badge text-bg-info">Full Service</span>';
                                }
                                elseif($row['service_type'] == '5')
                                {
                                    echo '<span class="badge text-bg-warning">Reward</span>';
                                }
                                ?>
                                </span></td>
                                <td><?php echo $row['booking_code'] ?></td>
                                <td><span class="badge text-bg-success"><?php if($row['status'] == '4'){echo 'Completed';}?></span></td>
                                <td><?php echo date_format($date_created, 'M d, Y g:i A') ?></td>
                            </tr>
                        <?php 
                            }
                        }
                        ?>
                          </tbody>
                          <tfoot>
                            <tr></tr>
                          </tfoot>
                    </table>
                </div>
                        </div>

                             <!-- accepted tab -->

                             <div class="tab-pane fade mt-3" id="reschedule_tab" >
                        <div class="table table-responsive p-4">
                    <table id="datatable_reschedule" class="table table-hover" style="width: 100%;">
                        <thead style="text-align: center;">
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Schedule</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Budz Code</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                        <?php
                        $accept_table =$db->query("SELECT A. *, B. *,C. * FROM customer_schedule_table as A 
                        INNER JOIN schedule_time_table AS B ON A.schedule_time_id = B.schedule_time_id 
                        INNER JOIN user_table AS C ON A.user_id = C.user_id 
                        WHERE A.status = '6' ORDER BY A.date ASC");
                        if($accept_table->num_rows > 0)
                        {
                            while($row = mysqli_fetch_array($accept_table))
                            {
                                $date = date_create($row['date']);
                                $start = date_create($row['starting_time']);
                                $end = date_create($row['end_time']);
                                $date_created = date_create($row['date_created']);
                                $sched_id = $row['schedule_id'];
                                $user_id = $row['user_id'];
                                $code = $row['booking_code'];
                                $name = $row['fname'].' '.$row['lname'];
                        ?>
                            <tr>
                                <td><?php echo $row['fname'].' '.$row['lname']?></td>
                                <td><?php echo $date->format("M d, Y").' / '. date_format($start, 'g:i A').' to '.date_format($end, 'g:i A') ?></td>
                                <td><?php if($row['service_type'] == '1')
                                {
                                    echo '<span class="badge text-bg-info">Self-Service</span>';
                                }
                                elseif($row['service_type'] == '2')
                                {
                                    echo '<span class="badge text-bg-info">Full Service</span>';
                                }
                                elseif($row['service_type'] == '5')
                                {
                                    echo '<span class="badge text-bg-warning">Reward</span>';
                                }
                                ?>
                               </td>
                                <td><?php echo $row['booking_code'] ?></td>
                                <td><span class="badge text-bg-warning"><?php if($row['status'] == '6')
                                {
                                    echo 'Re-scheduled';
                                }
                                ?></span></td>    
                                <td class=" text-lg-center text-info"><a class="btn text-light" style="background-color: #00c5ce;" onclick="transaction_complete('<?php echo $name ?>','<?php echo $sched_id?>','<?php echo $user_id ?>')">Pay</a>
                                
                                <a class="btn " style="background-color: #ed4949; color:#FFF;" onclick="cancel_modal('<?php echo $sched_id?>')">Cancel</a></td>

                                <script type="text/javascript">                       
                                    function cancel_modal(id)
                                    {  
                                        Swal.fire({
                                            title: "Warning",
                                            text: "Are you sure to cancel the schedule?",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonText: "Yes"
                                        }).then((result) =>
                                        {
                                            if(result.isConfirmed)
                                            {
                                                cancel_schedule(id);
                                            }
                                        });
                                    }
                                    </script>  
                            </tr>   
                        <?php 
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                                <tr></tr>
                               </tfoot>
                    </table>
                        </div>
                        <script src="assets/js/jquery.min.js"></script>
            <script>
              $(function() {
                    $("#total_cost, #payment").on("input", total);
                    function total() {
                    $("#total_change").val(Number($("#payment").val()) - Number($("#total_cost").val()));
                    }
                });
            </script>
                        </div>
            </div>
        </section>
    </main>
    <!-- /body content -->
    <!-- complete Modal -->
    <div class="modal fade" id="complete_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Payment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  <form id="payment_form" method="POST">
      <div class="modal-body">
      <h4 style="text-align: center;" id="customer_name" name="customer_name">Name</h4>
      <input class="form_control" id="trans_schedule_id" name="trans_schedule_id"type="hidden"/>
      <input class="form_control" id="trans_user_id" name="trans_user_id"type="hidden"/>
      <hr>
      <div class="row">
        <div class="col">
         <div class="form-group">
            <h6>Category</h6>
            <select class="custom-select form-select" id="category_id" name="category_id">
            <?php 
                 $select_cat =$db->query("SELECT * FROM price_category_table ORDER BY category_id ASC");

                 while($rows = $select_cat->fetch_assoc()):
    
                ?>
                <option value="<?php echo $rows['category_id'] ?>" data-points="<?php echo $rows['category_points'] ?>" data-price="<?php echo $rows['category_price'] ?>"><?php echo $rows['category_name'] ?></option>

                <?php endwhile; ?>
            </select>
         </div>
        </div>
        <div class="col">
        <div class="form-group">
            <h6>Load/kg</h6>
            <input type="number" step="any" min="1" value="" class="form-control text-right" id="weight">
         </div>
         
        </div>
        <div class="col">
        <div class="form-group">
        <label for="" class="control-label ">&nbsp;</label>
						<button class="btn btn-primary mt-1"  style="width: 100%"type="button" id="add_to_list"><i class="fa fa-plus"></i> Add</button>
         </div>
         
        </div>
      </div>
<hr>
      <div class="row">
       <div class="col">
        <div class="table table-responsive">
        <table class="table table-bordered" id="table_list">
                <colgroup>	
						<col width="25%">
						<col width="15%">
						<col width="15%">
						<col width="15%">
                        <col width="15%">
						<col width="5%">
					</colgroup>	
            <thead>
                <tr>
                <th class="text-center">Category</th>
                <th class="text-center">Weight(kg)</th>
                <th class="text-center">Price</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Points</th>
                <th class="text-center"></th>
                </tr>
            </thead>

            <tbody>
              
            </tbody>
        
            </table>
        </div>
      </div>
      </div>
      <hr>
      <div class="row" id="payment">
				<div class="col-md-6">
					<div class="form-group">	
						<label for="" class="control-label">Cash</label>
						<input type="number" step="any" min="0" value="<?php echo isset($amount_tendered) ? $amount_tendered : "" ?>" class="form-control text-right" name="tendered" required/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">	
						<label for="" class="control-label">Total Amount</label>
						<input type="number" step="any" min="1" value="<?php echo isset($total_amount) ? $total_amount : 0 ?>" class="form-control text-right" name="tamount" readonly="" disabled>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">	
						<label for="" class="control-label">Change</label>
						<input type="number" step="any" min="1" value="<?php echo isset($amount_change) ? $amount_change : 0 ?>" class="form-control text-right" name="change" readonly="" disabled>
					</div>
				</div>
                <div class="col-md-6">
					<div class="form-group">	
						<label for="" class="control-label">Accumulated Points</label>
						<input type="number" step="any" min="1" value="<?php echo isset($total_points) ? $total_points : 0 ?>" class="form-control text-right" name="tpoints" readonly="" disabled>
					</div>
				</div>
                <div class="col-md-6">
					<div class="form-group">	
                    <label id="tbTableValues"></label>
					</div>
				</div>
			</div>
    </div>

        <div class="modal-footer">
            <button class="btn btn-primary" type="submit" onclick="convertArrayToJSON()">Complete</button>
        </div>
    </div>
  </div>
            </div>
         </form>

<!-- Modal -->
<div class="modal fade" id="reschedule_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Re-schedule</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

								<!-- Schedule Content -->
								<div class="schedule-cont">
									<div class="row">
										<div class="col-md-7">
										<div id="myCalendarWrapper1"></div>	
										</div>
										<div class="col-md-5 my-sm-2">
										<h3>Pick a date to get started</h3>
											<br>
                      <form id="reschedule_form" method="POST">
                      <input id="resched_schedule_id" name="resched_schedule_id" type="hidden" class="form-control">
                      <input id="resched_user_id" name="resched_user_id" type="hidden" class="form-control">
											<div id="show_reschedule">
                     
											</div>
                      </form>
										</div>
							<!-- /Submit Section -->
									</div>
								</div>
								<!-- /Schedule Content -->
					
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Budz Laundry</span></strong>. All Rights Reserved
        </div>

    </footer>
    <!-- End Footer -->
                          
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>    
    <script src="assets/js/jquery.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/datatables/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="assets/datatables/datatables.min.js" crossorigin="anonymous"></script>
    <script src="assets/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/fontawesome.all.js" crossorigin="anonymous"></script>
    <script src="../assets/js/CalendarPicker.js"></script>

    <script>
const nextYear1 = new Date().getFullYear() + 1;
const myCalender1 = new CalendarPicker('#myCalendarWrapper1', {
    min: new Date(),
    max: new Date(nextYear1, 10), 
    locale: 'en-US', 
    showShortWeekdays: true 
});
myCalender1.onValueChange((currentValue) => {
if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("show_reschedule").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "resched-schedule.php?user=<?php echo $admin_id; ?>&week=" + (myCalender1.value.getDay() + 1) + "&date=" + (myCalender1.value.getFullYear() + '-' + (myCalender1.value.getMonth() + 1) + '-' + myCalender1.value.getDate()), true);
xmlhttp.send();
});

      function Disable(){
				document.getElementById("btn_resched_submit").disabled = false;
			};

            function showReschedule(schedule_id, user_id)
        {
            $('#reschedule_modal').modal("show");
            $('#resched_schedule_id').val(schedule_id);
            $('#resched_user_id').val(user_id);
        }
        $('#reschedule_form').submit(function(e)
      {
        e.preventDefault();
        type = 4;

        user_id = $('#resched_user_id').val();
        schedule_id = $('#resched_schedule_id').val();
        date = $("input[name='resched_date']").val();
        schedule = $("input[name='resched_schedule']:checked").val()
        resched_remark = $('#resched_remark').val();
        
        $.ajax({
          url: "code/code-admin.php",
          type: "POST",
          data: 
          {
            user_id: user_id,
            schedule_id: schedule_id,
            date: date,
            schedule: schedule,
            resched_remark: resched_remark,
            type: type,

          },
          success: function (data) 
          {  
            if (data[1] == 1) {
	            		Swal.fire("Error!", "Already scheduled", "error");
	            	} else {
	            		Swal.fire("Successful!", "Re-scheduled successfully", "success");
	                	$("#show_reschedule").load("resched-schedule.php");  
                    console.log(schedule_id, date, schedule, resched_remark, type);
                        
	            	}
          }
        });
      });

</script>


    <script type="text/javascript">
        
        $('[name="tendered"],[name="tamount"],[name="tpoints"]').on('keypup keydown keypress change input',function(){
            
		var tend = $('[name="tendered"]').val();
		var amount = $('[name="tamount"]').val();
        
		var change = parseFloat(tend) - parseFloat(amount)

        var points = $('[name="tpoints"]').val();
   
        
        var change2 = change.toFixed(2);

        
		$('[name="change"]').val(change2)
	})

    $('#add_to_list').click(function()
    {
        var cat = $('#category_id').val(),
        _weight =$('#weight').val();
        if(cat == '' || _weight == '')
        {
            alert_toast('Fill the category and weight fields first.','warning');
            return false;
        }
        if($('#table_list tr[data-id="'+cat+'"]').length > 0)
        {
            alert_toast('Category already exist.','warning')
			return false;
        }
        var price = $('#category_id option[value="'+cat+'"]').attr('data-price');
		var cname = $('#category_id option[value="'+cat+'"]').html();
		var amount = parseFloat(price) * parseFloat(_weight);
        var points = $('#category_id option[value="'+cat+'"]').attr('data-points');


		var tr = $('<tr></tr>'); 

        tr.attr('data-id',cat)
		tr.append('<td class=""><input type="hidden" name="category_id[]" id="category_id[]" value="'+cat+'">'+cname+'</td>')

		tr.append('<td class="text-center"><input type="number" class="text-center" name="weight[]" id="weight[]" min="0" value="'+_weight+'"></td>')

		tr.append('<td class="text-center"><input type="hidden" name="unit_price[]" id="unit_price[]" value="'+price+'">₱ '+(parseFloat(price).toFixed(2))+'</td>')

		tr.append('<td class="text-center"><input type="hidden" name="amount[]" id="amount[]" value="'+amount+'"><p>'+(parseFloat(amount).toFixed(2))+'</p></td>')

        tr.append('<td class="text-center"><input type="hidden" name="points[]" id="points[]" value="'+points+'"><a>'+points+'</a></td>')

		tr.append('<td><button class="btn btn-sm btn-danger" type="button" onclick="rem_list($(this))"><i class="fa fa-times"></i></button></td>')
		$('#table_list tbody').append(tr)

		calc()
		$('[name="weight[]"]').on('keyup keydown keypress change',function(){
			calc();
		})
			$('[name="tendered"]').trigger('keypress')
		
		$('#categry_id').val('')
		$('#weight').val('')

    })	



    function rem_list(_this)
    {
		_this.closest('tr').remove()
		calc()
			$('[name="tendered"]').trigger('keypress')
	}
    function calc(){
		var total = 0;
        var ptotal = 0;[]
		$('#table_list tbody tr').each(function(){
			var _this = $(this)
			var weight = _this.find('[name="weight[]"]').val()
			var unit_price = _this.find('[name="unit_price[]"]').val()
			var amount = parseFloat(weight) * parseFloat(unit_price)
			_this.find('[name="amount[]"]').val(amount)
			_this.find('[name="amount[]"]').siblings('p').html(amount.toFixed(2))
			total+= amount;

            var points = _this.find('[name="points[]"]').val()
            var total_points = parseFloat(weight) * parseFloat(points)
            _this.find('[name="points[]"]').val(points)
			_this.find('[name="points[]"]').siblings('a').html(points)
            ptotal += total_points;

		})
			$('[name="tamount"]').val(total)
			$('#tamount').html(parseFloat(total).toFixed(2));

            $('[name="tpoints"]').val(ptotal)
            $('#tpoints').html(ptotal);
	}


/*
function storeTblValues()
        {
            var TableData = new Array();

            $('#table_list tr ').each(function (row, tr) {
                TableData[row] = {
                    "category_id": $(tr).find('input[name="category_id[]"]').val()
                    , "weight": $(tr).find('input[name="weight[]"]').val()
                    , "unit_price": $(tr).find('input[name="unit_price[]"]').val()
                    , "amount": $(tr).find('input[name="amount[]"]').val()
                    , "points": $(tr).find('input[name="points[]"]').val()
                }
            });
             TableData.shift(); 
            return TableData;  
        }
        function convertArrayToJSON()
        {
            var TableData;
            TableData = JSON.stringify(storeTblValues());
    
            console.log(TableData);

            $.ajax({
                type: "POST",
                url: "code/sample.php",
                data: "pTableData=" + TableData,

                success:function()
                {
                    console.log("success");
                },
                error: function()
                {
                    cosnole.log("ERRROR");
                }
            });

        };
        */

    $('#payment_form').submit(function(e)
    {
        type = 3;
        e.preventDefault();
        schedule_id = $("#trans_schedule_id").val();
        user_id = $("#trans_user_id").val();
        category_id = $("input[name='category_id[]'").val();
        weight = $("input[name='weight[]']").val();
        unit_price = $("input[name='unit_price[]']").val();
        total_amount = $("input[name='tamount']").val();
        total_change = $("input[name='change']").val();
        total_cash = $("input[name='tendered']").val();
        total_points = $("input[name='tpoints']").val();

        $.ajax({
            url: "code/code-admin.php",
            type: "POST",
            data:
            {
                schedule_id: schedule_id,
                user_id: user_id,
                category_id: category_id,
                weight: weight,
                unit_price: unit_price,
                total_amount: total_amount,
                total_change: total_change,
                total_cash: total_cash,
                total_points: total_points,
                type: type,
            },
            success: function()
            {
                Swal.fire("Payment Complete", "", "success");   
                $('#complete_modal').modal("hide");
                setTimeout(() => {
                document.location.reload();
                }, 1000);

            },
            error: function()
            {
                Swal.fire("Something went wrong ", "", "error"); 
                setTimeout(() => {
                document.location.reload();
                }, 1000);  
            }
        });

    });

   
</script>

<script>  

    $(document).ready( function () {
    $('#datatable_complete').DataTable();
} );
$(document).ready( function () {
    $('#datatable_cancel').DataTable();
} );
$(document).ready( function () {
    $('#datatable_accept').DataTable();
} );
$(document).ready( function () {
    $('#datatable_reschedule').DataTable();
} );
</script>
    <script type="text/javascript">

    function transaction_complete(name, sched_id, user_id)
{
    $('#complete_modal').modal("show");
    $('#trans_schedule_id').val(sched_id);
    $('#trans_user_id').val(user_id);
    $('#customer_name').text(name);
};
  
    function cancel_schedule(id)
    {
      action = 3;
      schedule_id = id;
      admin_id = <?php echo $admin_id ?>;
      $.ajax({
        url: "function/action-code.php",
        type: "POST",
        data:
        {
          schedule_id: schedule_id,
          admin_id: admin_id,
          action: action,
        },
        success: function()
        {
          console.log("The schedule has been canceled!");
          Swal.fire("The schedule has been canceled", "", "success");   
          setTimeout(() => {
                document.location.reload();
                }, 1000);
        },
        error: function()
        {
          console.log("Something went wrong!");
          Swal.fire("Something went wrong!", "", "error");   
          setTimeout(() => {
                document.location.reload();
                }, 1000);
        }
      });
    };

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
  
  