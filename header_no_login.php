<?php 
include("connection.php");
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
    <link rel="stylesheet" href="CSS/user.css">
    <!-- menu -->
    <link rel="stylesheet" href="CSS/menu.css">
    <style>
        .user-btn{
            margin-top: .5rem;
        }
        .option-btn {
            margin: .6rem;
        }
        .flex-btn{
            gap: 0!important;
            margin: 0!important;
        }
        .header .icons {
            display: flex;
        }
        .header .icons .cart-flip .cart-btn {
            width: auto;
            padding-left: .7rem;
        }
        .header .icons .cart-flip a {
            display: block;
            box-shadow: 0 10px 10px rgba(0,0,0,0.1);
        }
        .cart-btn {
            position: relative;
        }
        .header .icons .cart-flip {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
            transition: all 0.4s cubic-bezier(0.68,-0.55,0.265,1.55) ;
        }
        .header .icons .cart-flip .tooltip {
            color: #fff;
            background: #fff;
            position: absolute;
            top: 0px;
            box-shadow: 0 10px 10px rgba(0,0,0,0.1);
            text-align: center;
            font-size: 20px;
            padding: 5px 18px;
            border-radius: 25px;
            box-shadow: 0 -10px 10px rgba(0,0,0,0.1);
            opacity: 0;
            pointer-events: none;
            transition: all 0.4s cubic-bezier(0.68,-0.55,0.265,1.55) ;
        }
        .header .icons .cart-flip:hover .tooltip {
            top: 7rem;
            opacity: 1;
            pointer-events: auto;
        }
        .header .icons .cart-flip .tooltip:before {
            position: absolute;
            content: "";
            width: 15px;
            height: 15px;
            background: #ff7800;
            bottom: 21.5rem;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
        }
        .header .icons .cart-flip:hover #cart-btn,
        .header .icons .cart-flip:hover .tooltip{
            text-shadow: 0px -1px, 0px rgba(0,0,0,0.4);
        }
        .header .icons .cart-flip:hover #cart-btn,
        .header .icons .cart-flip:hover .tooltip,
        .header .icons .cart-flip:hover .tooltip:before {
            background: #ff7800;
        }
        .header .icons .cart-flip .tooltip .message-img {
            padding: 1rem 0;
            border-radius: 2rem;
        }
        .message_cart {
            font-weight: 600;
        }
        @media screen and (max-width: 1023px){
            .header .icons .cart-flip .tooltip .message-img{
                display: none;
            }
            .header .icons .cart-flip .tooltip:before {
                bottom: 12.5rem;
            }
            .header .search-form {
                width: 50%!important;
            }
        }
    </style>
</head>
<body>
    <!-- header section starts -->
    <header class="header">
        <a href="index.php" class="header-logo">
            <img class="logo" src="HINH/logo/logo.png" alt="">
            <span>Natural Fruits</span>
        </a>
        </div>

        <nav class="navbar">
            <ul id="main-menu">
                <li><a href="./feature.php">Features</a></li>
                <li><a href="./product_main.php">Products</a></li>
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
            <a class="fas fa-user" id="user-btn"></a>
            <div class="cart-flip">
                <a href="./login.php" class="fas fa-shopping-cart" id="cart-btn"><span>0</span></a>
                <div class="tooltip">
                    <img class="message-img" src="./HINH/message_cart/no-cart.png" alt="">
                    <div class="message_cart">Chưa có sản phẩm</div>
                </div>
            </div>
        </div>

        <form action="" class="search-form">
            <input type="search" name="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </form>



        <!-- Profile taskbar -->
        <div class="profile">
            <img src="HINH/user-avatar/user.jpg" alt="">
            <h3>No name</h3>
            <span>User</span>
            <a href="login.php" class="user-btn">view profile</a>
            <div class="flex-btn">
                <a href="login.php" class="option-btn">Đăng nhập</a>
                <a href="register.php" class="option-btn">Đăng kí</a>
            </div>
        </div>

    </header>
    <!-- header section ends -->
