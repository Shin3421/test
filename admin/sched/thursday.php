<?php

   include('../../connection.php');

   session_start();

   $admin_id = $_SESSION['user_id'];

   ?>

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