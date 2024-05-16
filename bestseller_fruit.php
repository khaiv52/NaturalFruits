<?php 
@include('connection.php');
// Kiểm tra người dùng đã đăng nhập chưa
$user_id = $_SESSION['user_id'] ?? null;

// Kiểm tra sản phẩm đã có trong giỏ hàng hay chưa - nếu có thì thông báo đã có và ngược lại
if(isset($_POST['add_to_cart']) && $user_id) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
    $product_quantity = 1;
    
    $select = "SELECT * FROM `cart` WHERE ProductName = '$product_name' AND user_id = '$user_id'";
    $select_cart = mysqli_query($conn,$select);
    if(mysqli_num_rows($select_cart) > 0){
        $message[] = 'Sản phẩm đã tồn tại trong giỏ hàng';
    }else{
        $insert = "INSERT INTO `cart` (`ProductName`,`Price`,`ProductImage`,`Quantity`, `user_id`) VALUES ('$product_name','$product_price','$product_image','$product_quantity', '$user_id')";
        $insert_query = mysqli_query($conn, $insert);
        if($insert_query) {
            $message[] = 'Sản phẩm đã được thêm vào giỏ hàng thành công';
        } else {
            $message[] = 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng';
        };
    };
}
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
    <link rel="stylesheet" href="./CSS/user.css">

    <!-- scrollbar -->
    <link rel="stylesheet" href="./CSS/scrollbar.css">
    <!-- Message sticky -->
    <link rel="stylesheet" href="./CSS/message_stick.css">
    <style>
        body{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<!-- products section starts  -->
    <?php 
        if(isset($message)){
            foreach($message as $message){
                echo '<div class="message_sticky"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
            };
        };
        ?>
<section class="products" id="products">
    <h1 class="heading"><span>Sản phẩm</span>bán chạy</h1>
    <div class="swiper product-slider">
            <div class="swiper-wrapper" style="height: 55%;">
            <!--  -->
            <?php
                        $sql = "SELECT * FROM `products` WHERE ProductType = 'bestseller_fruit'";
                        $select_products = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($select_products) > 0) {
                            while($row = mysqli_fetch_assoc($select_products)){
                                ?>
                            <div class="swiper-slide box">
                                <form action="" onsubmit="addToCart(event, this)" method="POST" enctype="multipart/form-data">
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
                            </form>
                            </div>
                        <?php
                            }
                        }
                        ?>
                </div>
            </div>
    </section>

<!-- products section ends -->
</body>
</html>