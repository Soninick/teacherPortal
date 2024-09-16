<?php
$servername = "localhost"; 
$username = "root";
$password = ""; 
$db_name = "teacherportal";

$connection = mysqli_connect($servername, $username, $password, $db_name);


if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>
