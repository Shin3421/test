<?php 

include('../../connection.php');

$action = $_GET['action'];

switch($action)
{
    case 'admin':
?>


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
                                            echo '<h4 class="mb-0"><i class="fa fa-users fa-fw"></i> ' .
                                                $user_total .
                                                ' </h4>';
                                        } else {
                                            echo '<h4 class="mb-0"><i class="fa fa-users fa-fw"></i> No data </h4>';
                                        }
                                        ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="registered.users.php">View Details</a>
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
                                        $total_profit = $db->query(
                                            "SELECT SUM(receipt_total) as amount FROM receipt_table where date(receipt_date_created)= '" .
                                                date('Y-m-d') .
                                                "'"
                                        );

                                        if ($total_profit->num_rows > 0) {
                                            while (
                                                $row = mysqli_fetch_array(
                                                    $total_profit
                                                )
                                            ) {
                                                $total_amount = number_format(
                                                    $row['amount'],
                                                    2
                                                );

                                                echo '<h4 class="mb-0"><i class="fa fa-peso-sign fa-fw"></i> ' .
                                                    $total_amount .
                                                    ' </h4>';
                                            }
                                        } else {
                                            echo '<h4 class="mb-0"><i class="fa fa-peso-sign fa-fw"></i> No data </h4>';
                                        }
                                        ?>                      
                                    </div>      
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="transactions.php">View Details</a>
                                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            
                            <!-- total profits -->
                            <div class="col-xl-3 col-md-6">
                                    <div class="card bg-success text-white mb-4">
                                        <div class="card-body mt-2">
                                                Customer Today
                                            <?php
                                            $select_customer = $db->query(
                                                "SELECT count(receipt_id) as `count` FROM receipt_table where date(receipt_date_created)= '" .
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

                                                    echo '<h4 class="mb-0"><i class="fa fa-user"></i> ' .
                                                        $total_customer .
                                                        ' </h4>';
                                                }
                                            } else {
                                                echo '<h4 class="mb-0"><i class="fa fa-user"></i> No data </h4>';
                                            }
                                            ?>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-black stretched-link" href="transaction.php">View Details</a>
                                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                    </div>
                                </div>

                                <!-- total user -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body mt-2">
                                        Bookings
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
                                    <div class="card-body ">
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
                                        <a class="small text-black stretched-link" href="booking-schedules.php">View Details</a>
                                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                        </div>
                        </div>
                        <?php
                        break;
}

                        ?>