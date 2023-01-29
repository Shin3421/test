<?php
include("../../connection.php");

?>
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
?>