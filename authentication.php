<?php

if(! $_SESSION)
{
    session_start();
}

include('connection.php');


if(!isset($_SESSION['auth_role']))
{
    
    header("Location: index.php");
    exit(0);
}




?>