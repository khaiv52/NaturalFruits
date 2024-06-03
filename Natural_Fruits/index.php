<!-- header -->
<?php
session_start();
?>
<?php 
    if(!empty($_SESSION['user_id'])){
        require('header.php');
    } else{
        require('header_no_login.php');
    }
?>

<!-- home section -->
<?php require_once('home_section.php') ?>

<!-- feature section -->
<?php require_once('feature_section.php') ?>

<!-- products section  -->
<?php require_once('products_section.php') ?>

<!-- categories section  -->
<?php require_once('categories_section.php') ?>        

<!-- review section -->
<?php require_once('review_section.php') ?> 

<!-- blogs section  -->
<?php require_once('blog_section.php') ?> 

<!-- footer section -->
<?php include_once("footer.php"); ?>
    