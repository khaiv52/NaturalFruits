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
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <style>
        .heading{
            margin-top: 6rem;
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
    require('review_section.php');
    require('footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>
</html> 