<?php 
session_start();

// user
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
}
session_destroy();
unset($_SESSION['user_id']);
header("Location: index.php");

if(!isset($_SESSION['admin_id'])){
    header("Location: index.php");
}
session_destroy();
unset($_SESSION['admin_id']);
header("Location: index.php");
die;
?>