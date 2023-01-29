<?php

include("../../connection.php");

?>
   <div class="card">
                        <div class="card-header">
                    <h4>
                        Completed Scheudle
                    </h4>
                        
                </div>
                <div class="table table-responsive table-hover p-5">
                    <table id="datatable_complete" class="table">
                        <thead style="text-align: center;">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Schedule</th>
                                <th>Service Type</th>
                                <th>Budz Code</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
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
                        <tbody style="text-align: center;">
                            <tr>
                                <td><?php echo $row['schedule_id']?></td>
                                <td><?php echo $row['fname'].' '.$row['lname']?></td>
                                <td><?php echo $date->format("M d, Y").' / '. date_format($start, 'g:i A').' - '.date_format($end, 'g:i A') ?></td>
                                <td><span class="badge text-bg-info"><?php if($row['service_type'] == '1')
                                {
                                    echo 'Self-Service';
                                }
                                elseif($row['service_type'] == '2')
                                {
                                    echo 'Full Service';
                                }
                                ?>
                                </span></td>
                                <td><?php echo $row['booking_code'] ?></td>
                                <td><span class="badge text-bg-success"><?php if($row['status'] == '4'){echo 'Completed';}?></span></td>
                                <td><?php echo date_format($date_created, 'M d, Y g:i A') ?></td>

                            </tr>
                        </tbody>
                        <?php 
                            }
                        }
                        ?>
                    </table>
                </div>
                        </div>
                       