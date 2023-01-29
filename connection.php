<?php 
$server = "localhost";
$user = "root";
$pass = "";
$database = "budzlaundry_database";
$db = mysqli_connect($server, $user, $pass, $database);
if (!$db) {
    die("<script>alert('Connection Failed.')</script>");
}
$connect = new PDO("mysql:host=localhost; dbname=budzlaundry_database", "root", "");
class Connection{     
    public static function Connect() {        
        define('server', 'localhost');
        define('name', 'budzlaundry_database');
        define('user', 'root');
        define('password', '');                         
        $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');          
        try{
            $connection = new PDO("mysql:host=".server."; dbname=".name, user, password, $option);          
            return $connection;
        }catch (Exception $e){
            die("Error Message: ". $e->getMessage());
        }
    }
}
?>