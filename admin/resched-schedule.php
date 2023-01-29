<?php
include('../connection.php');
?>
 <h5>Prefered Time</h5>
<div class="time-slot">
<?php 
if (isset($_GET['user']) && isset($_GET['week']) && isset($_GET['date']))
{
  $user_id = $_GET['user'];
  $week = $_GET['week'];
  $date = $_GET['date'];

$select_admin = "SELECT * FROM user_table WHERE role_as = 1";

$select_admin_result = mysqli_query($db, $select_admin);

if($select_admin_result->num_rows > 0)
{
  while($row = mysqli_fetch_array($select_admin_result))
  {
    $admin_id = $row['user_id'];

$select_all =$db->query("SELECT * FROM schedule_time_table WHERE admin_id = '$admin_id' AND week_id = '$week' ORDER BY starting_time ASC");

  if ($select_all->num_rows > 0) 
  {
    while($row = mysqli_fetch_array($select_all))
    {
      $select_machine =$db->query("SELECT COUNT(*) AS machine_count FROM machine_table WHERE machine_status = '0'");

      while($cout = mysqli_fetch_array($select_machine))
      {
        $machine_avail = $cout['machine_count'];
        $schedule_time_id = $row['schedule_time_id'];
      	$start = date_create($row['starting_time']);
      	$end = date_create($row['end_time']);

        $TimeZone = new DateTime();
        $TimeZone->setTimezone(new DateTimeZone('Asia/Manila'));
        $AsiaTime = $TimeZone->format('H:i:s');
        $AsiaDate = $TimeZone->format('Y-m-j');
        ?>
        <input type="hidden" name="resched_date" name="resched_date" value="<?php echo $date ?>" class=''/>
        <?php
        $sql =$db->query("SELECT SUM(machine_used) AS slot_count FROM customer_schedule_table WHERE schedule_time_id = '$schedule_time_id' AND date ='$date'");

        while($rows = mysqli_fetch_array($sql))
        {
          $slot_count = ($machine_avail - $rows['slot_count']);
          if(($sql->num_rows > $slot_count) || ($date ==  $AsiaDate && $row['end_time'] < $AsiaTime))
        {
?>
        <input type="radio" name="resched_schedule" id="<?php echo $row['schedule_time_id']; ?>" value="<?php echo $row['schedule_time_id']; ?>" disabled/>
        <label class="not mt-2" for="<?php echo $row['schedule_time_id']; ?>"><?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A'). ' <span class="ml-2">(' . $slot_count . ' Machine slots.) </span>'; ?></label>
        <?php
    }else{
      ?>
        <input type="radio" name="resched_schedule" id="<?php echo $row['schedule_time_id']; ?>" value="<?php echo $row['schedule_time_id']; ?>" require_once/>
        <label class="available mt-2" for="<?php echo $row['schedule_time_id']; ?>" onclick="Disable()" ><?php echo date_format($start, 'g:i A').' - '.date_format($end, 'g:i A'). ' <span class="text-success ml-2">(' . $slot_count . ' Machine slots.) </span>'; ?></label>
        <?php
    }
  }
}
}
}else {
  ?>
  <p> No schedule today...
</p>
  <?php
}
}
}
}
?>
     <!-- required fields -->
     <div class="row mt-2">
      <div class="col">
      <a >Reason to re-schedule<a style="color: grey;">(optional)</a></a>
      <textarea class=" form-control" id="resched_remark" name="resched_remark" >

      </textarea>
      </div>
     </div>
<div class="form-group mt-2">
            <div class="form-group mt-2">
                  <button  class="btn btn-primary" style="width: 100%" type="submit" class="btn btn-info" id="btn_resched_submit" name="btn_resched_submit" disabled>Re-schedule</button>
                  </div>
          </div>
</div>

              