<?php 

if(isset($_SESSION['error_alert']))
{
   
    ?>
    <script src="assets/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.min.css">
    
    <script type="text/javascript">
    Swal.fire({
  icon: 'error',
  title: '<?= $_SESSION['error_alert']; ?> ',
  timer: 1500,
})
    </script>

    <?php

    unset($_SESSION['error_alert']);
    
}

if(isset($_SESSION['success_alert']))
{
    ?>
    <script src="assets/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.min.css">
    
    <script type="text/javascript">
        Swal.fire({
  icon: 'success',
  title: '<?= $_SESSION['success_alert']; ?> ',
  timer: 1500,
})
    </script>

    <?php

    unset($_SESSION['success_alert']);
    
}
?>