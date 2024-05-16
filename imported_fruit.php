<?php 
@include('connection.php');
session_start();
// Kiểm tra sản phẩm đã có trong giỏ hàng hay chưa - nếu có thì thông báo đã có và ngược lại
if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    
    $select = "SELECT * FROM `cart` WHERE ProductName = '$product_name'";
    $select_cart = mysqli_query($conn,$select);
    if(mysqli_num_rows($select_cart) > 0){
        $message[] = 'Sản phẩm đã tồn tại trong giỏ hàng';
    }else{
        $insert = "INSERT INTO `cart` (`ProductName`,`Price`,`ProductImage`,`Quantity`) VALUES ('$product_name','$product_price','$product_image','$product_quantity')";
        $insert_query = mysqli_query($conn,$insert);
        $message[] = 'Sản phẩm đã được thêm vào giỏ hàng thành công';  
    };
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="CSS/user.css">

    <!-- scrollbar -->
    <link rel="stylesheet" href="./CSS/scrollbar.css">
    <!-- Message sticky -->
    <link rel="stylesheet" href="./CSS/message_stick.css">
    <style>
        :root {
        --orange: #ff7800;
        --black: #130f40;
        --light-color: #666;
        --box-shadow: 0 1.5rem 1rem rgba(0,0,0,.1);
        --border: .2rem solid rgba(0,0,0,.1);
        --outline: .1rem solid rgba(0,0,0,.1);
        --outline-hover: .2rem solid var(--black);
        --light-bg: #eee;
        --red: #e74c3c;
        --main-color: #8e44ad;
    }
        .heading {
            margin-top: 10rem;
        }
        .products {
            padding-bottom: 4rem;
        }
        .container {
            padding-top: 1rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(35rem, 1fr));
            gap: 1.5rem;    
        }
        .container .product {
            border-radius: 1.2rem;
        }
        .product .box{
            padding: 3rem 2rem;
            background-color: #fff;
            outline: var(--outline);
            outline-offset: -1rem;
            box-shadow: var(--box-shadow);
            text-align: center;
        }
        .product .box:hover {
            outline: var(--outline-hover);
            outline-offset: 0rem;

        }
        .product .box .product-img {
            width: 20rem;
            height: 20rem;
            margin: 0 auto;
            object-fit: cover;
        }
        .product .box .product-title {
            font-size: 2.5rem;
            color: var(--black);
        }
        .product .box .price {
            font-size: 2rem;
            color: var(--light-color);
            padding: 0.5rem 0;
        }
        .product .box .stars i {
            font-size: 1.7rem;
            color: var(--orange);
            padding: 0.5rem 0;
        }

        /* Tương thích grid mọi thiết bị */
        @media screen and (max-width: 450px){
            .container{
                grid-template-columns: 1fr;
                gap:1.5rem
            }
        }
    </style>
</head>
<body>
    <?php 
    if($_SESSION['user_id']){
        require('header.php');
    }else if($_SESSION['admin_id']){
        require('header_admin.php');
    }else{
        require('header_no_login.php');
    }
    ?>
<!-- products section starts  -->
    <?php 
        if(isset($message)){
            foreach($message as $message){
                echo '<div class="message_sticky"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
            };
        };
        ?>
<section class="products" id="products">
    <div class="content">
        
        <h1 class="heading"><span>Sản phẩm</span>mới nhất</h1>
        <div class="container">
            <!--  -->
                    <?php
                        $sql = "SELECT * FROM `products` WHERE ProductType = 'imported_fruit' ";
                        $select_products = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($select_products) > 0) {
                            while($row = mysqli_fetch_assoc($select_products)){
                                ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="product">
                                <div class="box">
                                    <!-- Lấy từ bảng products khi admin thêm vào -->
                                    <img src="./Images/Admin/<?php echo $row['ProductImage'] ?>" alt="" class="product-img">
                                    <h3 class="product-title"><?php echo $row['ProductName'] ?></h3>
                                    <div class="price">$<?php echo $row['Price'] ?></div>
                                    <!-- Tạo input hidden để chèn vào cart -->
                                    <input type="hidden" name="product_name" value="<?php echo $row['ProductName'] ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $row['Price'] ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $row['ProductImage'] ?>">
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <button href="#" name="add_to_cart" class="btn add-cart">Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </form>
                        <?php
                            }
                        }
                        ?>
                </div>
    </div>
    </section>

<!-- products section ends -->
<?php require('footer.php') ?>
</body>
</html>