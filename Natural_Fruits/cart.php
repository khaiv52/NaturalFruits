<?php 
@include 'connection.php';
session_start();

// Kiểm tra user_id
if(empty($_SESSION['user_id'])){
    $admin= $_SESSION['admin_id'];
}else{
    $user_id = $_SESSION['user_id'];
}

if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_quantity = $_POST['update_quantity_id'];
    $sql = "UPDATE `cart` SET `Quantity` = '$update_value' WHERE `id` = '$update_quantity' AND `user_id` = '$user_id'";
    $update_quantity_query = mysqli_query($conn,$sql);
    if($update_quantity){
        header("location: cart.php");
    }
}
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn,"DELETE FROM `cart` WHERE `id` = '$remove_id' AND `user_id` = '$user_id'");
    header("location: cart.php");
}
if(isset($_GET['delete_all'])){
    mysqli_query($conn,"DELETE FROM `cart` WHERE `user_id` = '$user_id'");
    header("location: cart.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- scrollbar -->
    <link rel="stylesheet" href="./CSS/scrollbar.css">
    <!-- cart -->
    <link rel="stylesheet" href="CSS/cart.css">
    <!-- user -->
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
    <!-- Header -->
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
        <section class="shopping-cart">
        <h1 class="heading">GIỎ HÀNG</h1>
        <table>
            <thead>
                <th>Hình</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Hành động</th>
            </thead>
            <tbody>
                <?php 
                $select = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
                $grand_total = 0;
                $select_cart = mysqli_query($conn,$select);
                if(mysqli_num_rows($select_cart) > 0){
                    while($row = mysqli_fetch_assoc($select_cart)){
                ?>
                <tr>
                    <td><img src="Images/Admin/<?php echo $row['ProductImage']; ?>" height = "100" style="margin: 0 auto; border-radius: 4px" alt=""></td>
                    <td><?php echo $row['ProductName']; ?></td>
                    <td>$<?php echo number_format($row['Price']); ?>/-</td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="update_quantity_id" value="<?php echo $row['id']; ?>">
                            <input type="number" min = "1" name="update_quantity" value="<?php echo $row['Quantity']; ?>">
                            <input type="submit" value="update" name="update_update_btn">
                        </form>
                    </td>
                    <td>$<?php echo $sub_total = number_format($row['Price'] * $row['Quantity']); ?>/-</td>
                    <td><a href="cart.php?remove=<?php echo $row['id']; ?>" onclick="return confirm('Bạn muốn xóa sản phẩm này khỏi giỏ hàng?')" class="delete-btn"><i class="fas fa-trash"></i>Remove</a></td>
                </tr>
                <?php 
                $grand_total += $sub_total ;
                    };
                };
                ?>
                <tr class="table-bottom">
                    <td><a href="./product_main.php" class="option-btn" style="margin-top: 0;">Tiếp tục mua sắm</a></td>
                    <td colspan="3"> Tổng cộng </td>
                    <td>$<?php echo $grand_total ?>/-</td>
                    <td><a href="cart.php?delete_all" onclick="return confirm('Bạn có chắc muốn xóa toàn bộ?');" class="delete-btn"><i class="fas fa-trash"></i>Delete All</a></td>
                </tr>
            </tbody>
        </table>
            <div class="checkout-btn">
            <a href="checkout.php" class="option-btn <?= ($grand_total > 1)?'':'disabled'; ?>">Mua hàng</a>
            </div>
        </section>
    </div>
    <?php require('footer.php') ?>
</body>
</html>