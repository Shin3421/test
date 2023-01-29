
<?php 
session_start();
include('connection.php');

//feedback

if(isset($_POST['feedback_btn']))
{

    $f_fname= $_POST['f_fname'];
    $f_lname= $_POST['f_lname'];
    $f_number= $_POST['f_number'];
    $f_email= $_POST['f_email'];
    $f_feedback= $_POST['f_feedback'];
    
    $query = "INSERT INTO feedbacks_table (f_fname, f_lname,f_number,f_email,f_feedback) VALUES ('$f_fname','$f_lname','$f_number','$f_email','$f_feedback')";
    $query_run = mysqli_query($db, $query);
    
    if($query_run)
    {
        $_SESSION['success_alert'] = "Feedback Success";
        header("Location: contacts.php");
        exit(0);
    }
    else
    {
        $_SESSION['error_alert'] = "Something Went Wrong!";
        header("Location: contacts.php");
        exit(0);
    }
}
?>