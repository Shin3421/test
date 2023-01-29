<?php 

include('connection.php');
if(isset($_GET['vkey'])){
    
    $vkey = $_GET['vkey'];
    $resultSet = "SELECT verified, vkey FROM user_table WHERE verified = 0 AND vkey='$vkey' LIMIT 1";

    $validation =  mysqli_query($db, $resultSet);
    if($validation->num_rows == 1){
            $update = ("UPDATE user_table SET verified = 1 WHERE vkey='$vkey' LIMIT 1");
            $getUpdate = mysqli_query($db, $update);
                if($getUpdate){
                    header("Location: http://budzlaundry.com/login.php");
                    exit(0);
                    }
                else{
                        echo mysqli_error($db);
                    }
        }
    else{
            echo "Already verified!";
            header("Location: login.php");
        }

}
else{
    die("Something went wrong");
}

?>