<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "ecommerce";

if(!$conn = mysqli_connect($servername,$username,$password,$dbname)){
    die("failed to connect");
}
?>