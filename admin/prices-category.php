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
    <link href="assets/datatables/datatables.min.css"/>
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet" />
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
                        Categories
                    <a  onclick="add_category()" class="btn text-light float-end" style="background-color: #00c5ce;"><i class="fa fa-add fa-fw" ></i>
                         Add Prices Category
                    </a>
                    </h4>
                </div>
                <!-- content -->
                <div class="card-body mt-4" id="machine_slot" style="overflow-y: auto; height: 600px;">
                <?php
                    $machine_table =$db->query("SELECT * FROM price_category_table ORDER BY category_id ASC");
                    if($machine_table->num_rows > 0)
                    {
                        while($rows = mysqli_fetch_array($machine_table))
                        {
                ?>  
                    <div class="schedules">
                        <div class="schedule-info">
                            <h4 style="font-weight:  bold;"><?php echo $rows['category_name']; ?></h4>
                            <h6><i class="fa fa-list"></i> Description: <?php echo $rows['category_description']; ?></h6>
                            <h6> Price: <i class="fa fa-peso-sign"></i> <?php echo number_format($rows['category_price'],2); ?></h6>
                            <h6><i class="fa fa-coins"></i> Points: <?php echo $rows['category_points']; ?></h6>
        
                        </div>
                        <div class="schedule-choices">
                            <a class="btn btn-success" onclick="edit_category('<?php echo $rows['category_id'] ?>','<?php echo $rows['category_name'] ?>','<?php echo $rows['category_description'] ?>','<?php echo $rows['category_price'] ?>','<?php echo $rows['category_points'] ?>')"> <i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger" onclick="delete_alert('<?php echo $rows['category_id'] ?>')"><i class="fas fa-trash-can"></i></a>
                        </div>
                    </div>
                    <script type="text/javascript">
                        function delete_alert(cat_id)
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
                                delete_category(cat_id);
                            }
                        });
                        }
                    </script>
                <?php
                        }
                    }
                ?>
                </div>
            </div>
        </section>
    </main>
    <!-- /body content -->
    <!-- add modal -->
<div class="modal fade" id="add_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="code/code.php" method="POST" id="add_category_form">
        
        <div class="form-group mt-2" >
        <label>Name</label>
        <input id="add_category_name" name="add_category_name" class="form-control" value="" required/>
        </div>
        <div class="form-group mt-2">
        <label>Description</label>
        <input id="add_category_description" name="add_category_description" class="form-control" value=""/>
        </div>
        <div class="form-group mt-2">
        <label>Price</label>
        <input id="add_category_price" name="add_category_price" class="form-control" value="0" type="number" min="0"/>
      
        </div>
        <div class="form-group mt-2">
        <label>Points</label>
        <input id="add_category_points" name="add_category_points" class="form-control" value="0" type="number" min="0"/>
      
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="add_category_btn">Add Category</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- edit modal -->
<div class="modal fade" id="edit_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="edit_category_form">
        <input id="category_id" name="category_id" class="form-control" required type="hidden" value=""/>
        <div class="form-group mt-2" >
        <label>Name</label>
        <input  id="category_name" name="category_name" class=" form-control" value="" required/>
        </div>
        <div class="form-group mt-2">
        <label>Description</label>
        <input id="category_description" name="category_description" class="form-control" value=""/>
        </div>
        <div class="form-group mt-2">
        <label>Price</label>
        <input type="number" id="category_price" name="category_price" class="form-control" value="" min="0"/>
        </div>
        <div class="form-group mt-2">
        <label>Points</label>
        <input type="number" id="category_points" name="category_points" class="form-control" value="" min="0"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>
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
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="assets/js/jquery.min.js" crossorigin="anonymous"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>    
    <script src="assets/js/scripts.js"></script>
    <script src="assets/datatables/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/fontawesome.all.js" crossorigin="anonymous"></script>
    <script type="text/javascript">

        function edit_category(category, cat_name, cat_description, cat_price, cat_points)
        {
            $('#edit_category').modal("show");
            $('#category_id').val(category);
            $('#category_name').val(cat_name);
            $('#category_description').val(cat_description);
            $('#category_price').val(cat_price);
            $('#category_points').val(cat_points);
        };

            $('#edit_category_form').submit(function(event)
            {
                type = 1;
                event.preventDefault();
                category_id =  $('#category_id').val();
                category_name =  $('#category_name').val();
                category_description =  $('#category_description').val();
                category_price =  $('#category_price').val();
                category_points =  $('#category_points').val();
                $.ajax({
                    url: "code/code-admin.php",
                    type: "POST",
                    data:
                    {
                        category_id: category_id,
                        category_name: category_name,
                        category_description: category_description,
                        category_price: category_price,
                        category_points: category_points,
                        type: type,
                    },
                    success: function()
                    {
                        Swal.fire("Updated successfully!", "","success");
                        console.log("Success");
                        setTimeout(() => {
                document.location.reload();
                }, 1000);
                    },
                    error: function()
                    {
                        Swal.fire("Something went wrong!", "error","error");
                        console.log("error");
                        setTimeout(() => {
                document.location.reload();
                }, 1000);
                    }
                });
            });
            function delete_category(cat_id)
        {
            type = 2;
            category_id = cat_id;
            $.ajax({
                url: "code/code-admin.php",
                type: "POST",
                data:
                {
                    category_id: category_id,
                    type: type,
                },
                success: function()
                {
                    console.log("success");
                    Swal.fire("Deleted Successfully!", "", "success");
                    setTimeout(() => {
                document.location.reload();
                }, 1000);
                },
                error: function()
                    {
                        Swal.fire("Something went wrong!", "","error");
                        console.log("error");
                        setTimeout(() => {
                document.location.reload();
                }, 1000);
                    }
            });
        };
        function add_category()
        {
            $('#add_category_modal').modal("show");
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
  