<?php
session_start();
if(empty($_SESSION['user_id'])){
    $admin_id = $_SESSION['admin_id'];
}else{
    $user_id = $_SESSION['user_id'];
}

@include 'connection.php';
if(isset($_POST['order_btn'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $ap_number = $_POST['ap_number'];
    $street = $_POST['street'];
    $sub_address = $_POST['sub_address'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $pin_code = $_POST['pin_code'];
    
    
    // Tạo mảng và lưu biến từ cart 
    $sql = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
    $cart_query = mysqli_query($conn,$sql);
    $price_total = 0;
    if(mysqli_num_rows($cart_query) > 0){
        while($product_item = mysqli_fetch_assoc($cart_query)){
            $product_name[] = $product_item['ProductName'].'('.$product_item['Quantity'].')';
            $product_price = number_format($product_item['Price'] * $product_item['Quantity']);
            $price_total += $product_price;
        };
    };
    $total_products = implode(', ', $product_name);
    // $address = implode(', ', $ap_number, $street, $province, $city, $country);

    // Xử lý message 
    if((isset($_POST['city']) && $_POST['city'] == '') 
    && (isset($_POST['sub_address']) && $_POST['sub_address'] == '')){
        $message[]= "Điền 1 trong 2 trường còn thiếu nếu muốn tiếp tục";
    }else {
        // Chèn vào bảng order
        $detail_query = mysqli_query($conn, "INSERT INTO `order` (name, email, method, phone, ap_number, street, sub_address, city, country, zip_code, total_products, total_price, user_id) VALUES ('$name','$email','$method','$phone','$ap_number', '$street', '$sub_address', '$city','$country','$pin_code','$total_products','$price_total', '$user_id')") or die('query failed');

        if($cart_query && $detail_query){
            echo "
            <div class='order-message-container'>
            <div class='message-container'>
                <h3>Cảm ơn đã mua hàng shop chúng tôi. Rất mong được gặp lại quý khách</h3>
                <div class='order-detail'>
                    <span class = 'total'> ".$total_products." </span>
                    <span class= 'total'> Tổng cộng: $".$price_total." </span>
                </div>
                <div class='customer-detail'>
                    <p>Tên của bạn: <span> ".$name."</span> </p>
                    <p>Số điện thoại:<span> ".$phone."</span> </p>
                    <p>Địa chỉ: <span>".$ap_number.", ".$street.", ".$sub_address.", ".$city.", ".$country." - ".$pin_code." </span></p>
                    <p>Phương thức thanh toán: <span>".$method."</span></p>
                    <p>(*thanh toán khi hàng đến*)</p>
                </div>
                <a href='product_main.php' class='option-btn'>Tiếp tục mua sắm</a>
            </div>
        </div>
            ";

            // Xóa toàn bộ cart sau khi thanh toán
            $clear_cart_query = mysqli_query($conn,"DELETE FROM `cart` WHERE `user_id` = '$user_id'");
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
    <title>checkout</title>
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="CSS/checkout.css">
    <link rel="stylesheet" href="CSS/message_stick.css">
    <style>
        .order-message-container .message-container {
            width: 50rem;
            background-color: var(--white);
            border-radius: .5rem;
            padding: 2rem;
            text-align: center;
            height: 70rem;
            overflow-y: scroll;
        }
        .order-message-container ::-webkit-scrollbar {
            width: 10px;
        }
        .order-message-container ::-webkit-scrollbar-thumb{
            background: #666;
            border-radius: 100rem;
        }
        .order-message-container ::-webkit-scrollbar-track {
            background-color: #ccc;
            border-radius: 100rem;  
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
    <?php 
    if($_SESSION['user_id']){
        require('header.php');
    }else if($_SESSION['admin_id']){
        require('header_admin.php');
    }else{
        require('header_no_login.php');
    }
    ?>
    <div class="container">
        <section>
            <div class="checkout-form">
                <h1 class="heading">Thanh toán</h1>
                <div class="display-order">
                    <!-- Truy xuất để tính tổng và lấy tên product từ bảng cart -->
                    <?php 
                    $query = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
                    $select_cart = mysqli_query($conn, $query);
                    $grand_total = 0;
                    if(mysqli_num_rows($select_cart) > 0){
                        while($row = mysqli_fetch_assoc($select_cart)){
                            $total_price = number_format($row['Price'] * $row['Quantity']);
                            $grand_total += $total_price;
                            ?>
                    <span><?php echo $row['ProductName'] ?>(<?php echo $row['Quantity'] ?>)</span>
                    <?php 
                        }
                    } else {
                        echo "<div class = 'display-order'><span>Giỏ hàng của bạn đang trống</span> </div>";
                    }
                    ?>
                    
                    <!-- Truy xuất thông tin từ user -->
                    
                    <?php 
                        $select_query = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$user_id'");
                        if(mysqli_num_rows($select_query) > 0) {
                            $row = mysqli_fetch_assoc($select_query);
                        }       
                    ?>
                    <span class="grand-total">Tổng tiền: $<?= $grand_total ?>/-</span>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="flex">
                        <div class="inputBox">
                            <span>họ và tên</span>
                            <input type="text" name="name" value="<?php echo $row['UserName'] ?>" placeholder="Nhập tên">
                        </div>
                        <div class="inputBox">
                        <span>email</span>
                            <input type="text" name="email" value="<?php echo $row['Email'] ?>" placeholder="Nhập email">
                        </div>
                        <div class="inputBox">
                            <span>Số điện thoại</span>
                            <input type="text" name="phone" value="<?php echo $row['UserPhone'] ?>" placeholder="nhập số điện thoại" required>
                        </div>
                        <div class="inputBox">
                            <span>Chọn phương thức thanh toán</span>
                            <select name="method">
                                <option value="thanh toán tiền mặt" selected>thanh toán tiền mặt</option>
                                <option value="thẻ tín dụng">thẻ tín dụng</option>
                                <option value="paypal">paypal</option>
                            </select>
                        </div>
                        <div class="inputBox">
                            <span>Địa chỉ dòng 1</span>
                            <input type="text" name="ap_number" value="<?php echo $row['Ap_number'] ?>" placeholder="nhập số nhà" required>
                        </div>
                        <div class="inputBox">
                            <span>Địa chỉ dòng 2</span>
                            <input type="text" name="street" value="<?php echo $row['Street'] ?>" placeholder="nhập tên đường" required>
                        </div>
                        <div class="inputBox">
                            <span>Quận/Huyện/Tỉnh/Thị xã </span>
                            <input type="text" name="sub_address" value="<?php echo $row['Sub_address'] ?>"  placeholder="nhập Quận/Huyện/Tỉnh/Thị xã ">
                        </div>
                        <div class="inputBox">
                            <span>Thành phố </span>
                            <input type="text" name="city" value="<?php echo $row['City'] ?>" placeholder="nhập thành phố">
                        </div>
                        <div class="inputBox">
                            <span>Đất nước </span>
                            <input type="text" name="country" value="<?php echo $row['Country'] ?>" placeholder="nhập đất nước" required>
                        </div>
                        <div class="inputBox">
                            <span>Zip code</span>
                            <input type="text" name="pin_code" placeholder="123456" required>
                        </div>
                    </div>
                    <input type="submit" value="Thanh toán" onclick="return confirm('Bấm xác nhận để thanh toán')" name="order_btn" class="option-btn" style="font-weight: 500; font-size: 18px;">
                </form>
            </div>
        </section>
    </div>
    <?php require('footer.php') ?>
</body>
</html>