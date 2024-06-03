<?php 
include("connection.php");
include("./function/user_function.php");
// kiểm tra session nếu rổng thì là người dùng chưa đăng nhập
    if ($_SESSION['user_id'] == ''){
        header("Location: index.php");
    }else {
        $user_data = check_login($conn);
        $user_id = $_SESSION['user_id'];
    }

    // Xử lý giỏ hàng trang chính
    if(!isset($_SESSION['cart'])) $_SESSION['cart']=[];
    // lấy dữ liệu từ form products_section vào giỏ (cart.php)
    if(isset($_POST['add_cart']) && ($_POST['add_cart'])){
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];
        $products = array($product_name,$product_price,$product_image,$product_quantity);
        $_SESSION['cart'][] = $products;

        //  kiểm tra sản phầm đã được thêm vào giỏ hàng hay chưa 
        $select = "SELECT * FROM `cart` WHERE ProductName = '$product_name'";
        $select_query = mysqli_query($conn, $select);
        if (mysqli_num_rows($select_query) > 0){
            $message[] = "Sản phầm đã tồn tại trong giỏ hàng";
        }else{
            $insert_cart = mysqli_query($conn,"INSERT INTO `cart`(ProductName, Price, ProductImage, Quantity) VALUES('$product_name','$product_price','$product_image','$product_quantity')");
            if($insert_cart){
                $message[] = 'Sản phẩm đã dược thêm vào giỏ hàng';
            }else{
                $message[] = 'Không thêm được sản phẩm vào giỏ hàng';
            }
        }
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
    <link rel="stylesheet" href="./CSS/style.css">
    <!-- scrollbar -->
    <link rel="stylesheet" href="./CSS/scrollbar.css">
    <!-- user -->
    <link rel="stylesheet" href="./CSS/user.css">
    <!-- message sticky -->
    <link rel="stylesheet" href="CSS/message_stick.css">
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
    <?php 
        if(isset($message)){
            foreach($message as $message){
                echo '<div class="message_sticky"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
            };
        };
    ?>
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
        
        <!-- Đếm số lượng sản phẩm khi được thêm vào giỏ hàng -->
        <?php 
        $sql = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
        $select_rows = mysqli_query($conn, $sql) or die('query failed');
        $row_counts = mysqli_num_rows($select_rows);
        ?>
        <div class="icons">
            <a class="fas fa-bars" id="menu-btn"></a>
            <a class="fas fa-search" id="search-btn"></a>
            <a class="fas fa-user" id="user-btn"></a>
            <a class="fas fa-shopping-cart" id="cart-btn"><span><?php echo $row_counts ?></span></a>
        </div>

        <form action="" class="search-form">
            <input type="search" name="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </form>

        <!-- class shopping-cart Nằm ngoài đoạn php để thực hiện chức năng của script (toggle) -->
        <div class="shopping-cart">
            <div class="cart-content">
            <!-- Hiển thị lên rõ hàng mini trên thanh header từ database cart.php -->
            <?php 
            $sql = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
            $select_cart = mysqli_query($conn, $sql) or die('query failed');
            if(isset($select_cart)){
                while ($row = mysqli_fetch_assoc($select_cart)){
                    ?>
                <!-- Content -->
                    <div class="cart-box">
                        <img src="./Images/Admin/<?php echo $row['ProductImage'] ?>" alt="">
                        <div class="content">
                            <h3 class="cart-product-title"><?php echo $row['ProductName'] ?></h3>
                            <p class="price">$<?php echo $row['Price'] ?></p>
                        </div>
                    </div>
                    <?php 
                }
            }
            ?>
            </div>
            <button class="btn-check"><a href="cart.php">Xem giỏ hàng</a></button>
        </div>

        <!-- Profile taskbar -->
        <!-- Trích xuất database users để lấy thông tin vào form đăng nhập (icon hình ảnh và tên trên thanh header) -->
        <div class="profile">
        <?php 
            $query = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
            $select  = mysqli_query($conn, $query) or die('query failed'); 
            if(mysqli_num_rows($select) > 0) {
                $row = mysqli_fetch_assoc($select);
            }        
            if($row['UserImage'] == ''){
                echo '<img src="./HINH/user-avatar/user.jpg" alt="">';
            }else{
            echo '<img src="Images/Users/Info/'.$row['UserImage'].'">';
            }
        ?>  
            <h3><?php echo $row['UserName']?></h3>
            <span>User</span>
            <a href="profile.php" class="user-btn">view profile</a>
            <div class="flex-btn">
                <a href="logout.php" class="option-btn">Đăng xuất</a>
            </div>
        </div>

    </header>
            
    <!-- header section ends -->

