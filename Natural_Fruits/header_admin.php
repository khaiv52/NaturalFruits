<?php 
include("connection.php");
include('./function/user_function.php');
session_start();
    if ($_SESSION['admin_id'] == ''){
        header("Location: login.php");
    }else {
        $admin_data = check_login_admin($conn);
        $admin_id = $_SESSION['admin_id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="CSS/style.css">
    <!-- scrollbar -->
    <link rel="stylesheet" href="./CSS/scrollbar.css">
    <!-- user -->
    <link rel="stylesheet" href="./CSS/user.css">
    <!-- menu -->
    <link rel="stylesheet" href="CSS/menu.css">
    <style>
        .user-btn{
            margin-top: .5rem;
        }
        .flex-btn{
            width: calc(100% - 1.5rem);
        }
        .option-btn {
            margin: .6rem;
        }
        @media screen and (max-width: 1023px){
            .header .search-form {
                width: 50%!important;
            }
        }
        .header .shopping-cart .cart-box img {
            height: 10rem; 
            margin: 0 2rem;
            width: 10rem;
        }
        .header .shopping-cart {
            position: absolute;
            top: 110%; right: -110%;
            padding: 1rem;
            border-radius: .5rem;
            box-shadow: var(--box-shadow);
            width: 35rem;
            background: #fff;
            height: 47rem;
        }
        .header .shopping-cart .btn-check {
            text-align: center;
            padding: 0.8rem 3rem;
            font-size: 1.7rem;
            border-radius: 0.5rem;
            border: 0.2rem solid var(--black);
            cursor: pointer;
            display: inline-block;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            margin-top: 3rem;
        }
        .header .shopping-cart .btn-check:hover {
            background: var(--orange);
        }
        .header .shopping-cart .btn-check a{
            color: var(--light-color);
        }
        .header .shopping-cart .btn-check a:hover {
            color: #fff;
        }
        .header .shopping-cart .content h3 {
            padding: 0;
            margin: 1px;
        }
    </style>
</head>
<body>
    
    <!-- header section starts -->
    <header class="header">
        <a href="admin_main.php" class="header-logo">
            <img class="logo" src="HINH/logo/logo.png" alt="">
            <span>Natural Fruits</span>
        </a>
        </div>

        <nav class="navbar">
            <ul id="main-menu">
                <li><a href="./admin.php">Admin</a></li>
                <li><a href="./categories.php">Categories</a>
                    <ul class="sub-menu">
                        <li><a href="./imported_fruit.php">Trái Cây Nhập Khẩu</a></li>
                        <li><a href="./fresh_fruit.php">Trái Cây Tươi</a></li>
                        <li><a href="./gift_fruit.php">Giỏ Quà Trái Cây</a></li>
                        <li><a href="./holiday_gift.php">Quà Tặng Lễ Hội</a></li>
                    </ul>
                </li>
                <li><a href="./review.php">Review</a></li>
                <li><a href="blogs.php">Blogs</a></li>                
            </ul>
        </nav>

        <div class="icons">
            <a class="fas fa-bars" id="menu-btn"></a>
            <a class="fas fa-search" id="search-btn"></a>
            <a class="fas fa-user" id="admin-btn"></a>

        </div>

        <form action="" class="search-form">
            <input type="search" name="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </form>

        <!-- Profile taskbar -->
        <!-- Trích xuất database admin để lấy thông tin vào form đăng nhập (icon hình ảnh và tên trên thanh header) -->
        <div class="profile profile_admin">
        <?php 
            $query = "SELECT * FROM `admin` WHERE `admin_id` = '$admin_id'";
            $select  = mysqli_query($conn, $query) or die('query failed'); 
            if(mysqli_num_rows($select) > 0) {
                $row = mysqli_fetch_assoc($select);
            }        
        ?>  
            <img src="./HINH/user-avatar/admin.png" alt="">
            <h3><?php echo $row['name']?></h3>
            <span>admin</span>
            <div class="flex-btn">
                <a href="logout.php" class="option-btn">Đăng xuất</a>
            </div>
        </div>

        

    </header>
    <!-- header section ends -->
