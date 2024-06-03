<?php 
require('connection.php');


if(isset($_POST['add_product'])){
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_image_size = $_FILES['p_image']['size'];
    $p_image = $_FILES['p_image']['name'];
    $p_type = $_POST['p_type'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = "Images/Admin/".$p_image;
    

    if(!empty($p_name)){
        if ($p_image_size > 2000000)
        {
            $message[] = "Hình có kích cỡ quá lớn";
        }else{
            $insert = "INSERT INTO `products`(`ProductName`,`Price`,`ProductImage`,`ProductType`) VALUES ('$p_name','$p_price','$p_image','$p_type')" or die('query failed');
            $insert_query = mysqli_query($conn,$insert);
            if($insert_query){
                move_uploaded_file($p_image_tmp_name,$p_image_folder);
                $message[] = "Sản phẩm đã được thêm vào hệ thống";
            }else{
                $message[] = 'Không thêm được sản phẩm vào hệ thống';
            }
        }
    }
}

// delete all sản phẩm
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $sql = "DELETE FROM `products` WHERE `id` = '$delete_id'";
    $delete_query = mysqli_query($conn,$sql) or die('query failed');
    if($delete_query){
        $message[] = "Đã xóa sản phẩm";
    }else {
        $message[] = "Không xóa được sản phẩm";
    };
};

// Update product
if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_type = $_POST['update_p_type'];
    $update_p_image = $_FILES['update_p_image']['name'];
    $update_p_image_size = $_FILES['update_p_image']['size'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = 'Images/Admin/'.$update_p_image;

    $sql = "UPDATE `products` SET ProductName = '$update_p_name', Price = '$update_p_price', ProductImage = '$update_p_image', ProductType = '$update_p_type' WHERE id = '$update_p_id'";
    $update_query = mysqli_query($conn,$sql);

    if($update_query) {
        if ($update_p_image_size > 2000000) {
            $message[] = ["Hình có kích quá lớn"];
        }else {
            move_uploaded_file($update_p_image_tmp_name,$update_p_image_folder);
            $message = ["Sản phẩm đã được cập nhật thành công"];
            header("location: admin.php");
        }
    }else {
        $message[] = "Sản phẩm chưa được cập nhật";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/message_stick.css">
    <link rel="stylesheet" href="./CSS/admin.css">
    <style>
        .message_sticky span{
        width: 100%;
        text-align: center;
        }
        @media screen and (max-width: 767.98px) {
        .edit-form-container form {
            width: 80%;
        }
        }
        @media screen and (max-width: 375px) {
            html {
                font-size: 40%;
            }
            .edit-form-container form {
                width: 80%;
            }
        }
        .product-table td {
            text-transform: none;
        }
    </style>
</head>
<body>
    <?php include("header_admin.php") ?> 

<?php 
if(isset($message)){
    foreach($message as $message){
        echo '<div class="message_sticky"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
};
?>
    
    <div class="container">
        <div class="content">
        <!-- form thêm sản phảm -->
        <form action="" method="POST" id="form_product" enctype="multipart/form-data">
            <h3>Thêm một sản phẩm mới: </h3>
            <input type="text" name="p_name" placeholder="Nhập tên sản phẩm" class="box" required>
            <input type="number" name="p_price" min = "0" placeholder="Nhập vào giá sản phẩm" class="box" required>
            <input type="file" name="p_image" class="box" required>
            <select name="p_type" id="" class="box">
                <option value="gift_fruit">Giỏ quà trái cây</option>
                <option value="imported_fruit">Trái cây nhập khẩu</option>
                <option value="holiday_gift">Quà tặng lễ hội</option>
                <option value="fresh_fruit">Trái cây tươi</option>
                <option value="feature_fruit">Sản phẩm nổi bật</option>
                <option value="bestseller_fruit">Sản phẩm bán chạy</option>
            </select>
            <input type="submit" value="Thêm sản phẩm" name="add_product" class="option-btn btn-add-cart">
        </form>
        </div>
        <!-- form hiển thị sản phẩm -->
        <div class="display-product-table">
            <table class="product-table">
                <thead>
                    <th>product image</th>
                    <th>product name</th>
                    <th>product type</th>
                    <th>product price</th>
                    <th>action</th>
                </thead>

                <tbody>
                    <?php 
                        $sql = "SELECT * FROM `products`";
                        $select_products = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($select_products) > 0){
                            while($row = mysqli_fetch_assoc($select_products)){
                    ?>
                    <tr>
                        <td><img style="margin: 0 auto;" src="./Images/Admin/<?= $row['ProductImage']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['ProductName']; ?></td>
                        <td><?php echo $row['ProductType']; ?></td>
                        <td>$<?php echo $row['Price']; ?>/-</td>
                        <td>
                            <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Bạn muốn xóa sản phẩm này?');"><i class="fas fa-trash"></i> Delete</a>
                            <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> Update </a>
                        </td>
                    </tr>
                    <?php 
                        };
                    }else{
                        echo "<div class = 'empty'> Không có sản phẩm được thêm </div>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="edit-form-container">
            <?php 
            // Nếu tồn tại thì thực thi lệnh dưới và block form này lên màn hình  
            if(isset($_GET['edit']));
                $edit_id = $_GET['edit'];
                $sql = "SELECT * FROM `products` WHERE `id` = '$edit_id'" ;
                $edit_query = mysqli_query($conn,$sql);
                if(mysqli_num_rows($edit_query) > 0) {
                    while($row = mysqli_fetch_assoc($edit_query)){
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <img src="Images/Admin/<?php echo $row['ProductImage'] ?>" height="200" style="margin:0 auto;" alt="">
                <!-- lấy id của database products -->
                <input type="hidden" name="update_p_id" value="<?php echo $row['id'] ?>">
                <input type="text" class="box" name="update_p_name" value="<?php echo $row['ProductName'] ?>" required>
                <input type="number" class="box" min = "0" name="update_p_price" value="<?php echo $row['Price'] ?>" required>
                <input type="file" class="box" name="update_p_image">
                <select name="update_p_type" id="" class="box">
                    <option value="gift_fruit">Giỏ quà trái cây</option>
                    <option value="imported_fruit">Trái cây nhập khẩu</option>
                    <option value="holiday_gift">Quà tặng lễ hội</option>
                    <option value="fresh_fruit">Trái cây tươi</option>
                    <option value="bestseller ">Sản phẩm bán chạy</option>
                </select>
                <input type="submit" name="update_product" value="update the product" class="delete-btn">
                <input type="reset" value="cancel" id="close-edit" class="option-btn">
            </form>
            <?php 
                };
                echo "<script> document.querySelector('.edit-form-container').style.display = 'block'; </script>";
            };
            ?>
        </div>
    </div>
    <?php require('footer.php') ?>
    <script src="./JS/admin.js"></script>
</body>
</html>
