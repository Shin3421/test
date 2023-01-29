

<?php 

session_start();

include('connection.php');



//feedback



if(isset($_POST['sched_btn']))

{



    $b_user_id= $_POST['b_user_id'];

    $b_date= $_POST['b_date'] ;

    $b_time = $_POST['b_time'];

    $b_fullname= $_POST['b_fullname'];

    $b_number= $_POST['b_number'];

    $b_email= $_POST['b_email'];

    $b_message= $_POST['b_message'];

    $b_service = $_POST['b_service'];

    

    $query = "INSERT INTO booking_table (b_user_id, b_date,b_time,b_fullname,b_number,b_email,b_service,b_message) VALUES ('$b_user_id','$b_date','$b_time','$b_fullname','$b_number','$b_email','$b_service','$b_message')";

    $query_run = mysqli_query($db, $query);

    

    if($query_run)

    {

        $_SESSION['message'] = "Booking Success";

        header("Location: schedule_of_book.php");

        exit(0);

    }

    else

    {

        $_SESSION['message'] = "Something Went Wrong!";

        header("Location: schedule_of_book.php");

        exit(0);

    }

}

?>