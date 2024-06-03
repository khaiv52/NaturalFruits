<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1.heading {
            margin-top: 10rem;
        }
    </style>
</head>
<body>
    <?php 
    if(!empty($_SESSION['user_id'])){
        require('header.php');
    }else if(!empty($_SESSION['admin_id'])){
        require('header_admin.php');
    }else{
        require('header_no_login.php');
    }
    require('categories_section.php');
    require('footer.php');
    ?>
</body>
</html>