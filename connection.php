<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

if(!$conn = mysqli_connect($servername,$username,$password,$dbname)){
    die("failed to connect");
}
?>