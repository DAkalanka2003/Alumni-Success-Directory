<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "alumni_directory";

$conn = mysqli_connect($host, $user, $password, $database);

if(!$conn){
    die("Connection failed");
}

?>