<?php

include("../../connection.php");

?>
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
?>