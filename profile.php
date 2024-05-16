<?php 
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];
if(isset($_POST['update_profile']))
{
    $select = "SELECT * FROM `users`";
    // Loại bỏ ký tự đặc biệt 
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
    $update_phone = mysqli_real_escape_string($conn, $_POST['update_phone']);
    $update_ap_number = mysqli_real_escape_string($conn, $_POST['update_ap_number']);
    $update_street = mysqli_real_escape_string($conn, $_POST['update_street']);
    $update_sub_address = mysqli_real_escape_string($conn, $_POST['update_sub_address']);
    $update_country = mysqli_real_escape_string($conn, $_POST['update_country']);
    $update_city = mysqli_real_escape_string($conn, $_POST['update_city']);
    // Truy vấn database 
    $query = "UPDATE `users` SET `UserName` = '$update_name', `Email` = '$update_email', `UserPhone`= '$update_phone', `Ap_number` = '$update_ap_number', `Street` = '$update_street', `Sub_address` = '$update_sub_address', `Country` = '$update_country', `City` = '$update_city' WHERE `user_id` = '$user_id' ";
    mysqli_query($conn, $query) or die('query failed');
    
    $old_pass = mysqli_real_escape_string($conn, $_POST['old_pass']);
    $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
    $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

    // Only proceed with password update if fields are not empty
    if(!empty($update_pass) && !empty($new_pass) && !empty($confirm_pass)){
        if($update_pass !== $old_pass) {
            $message[] = 'Mật khẩu cũ không chính xác hoặc bị trống';
        }
        elseif ($new_pass == $update_pass){
            $message[] = 'Mật khẩu mới trùng mật khẩu cũ';
        }
        elseif ($confirm_pass !== $new_pass){
            $message[] = 'Mật khẩu nhập lại không chính xác';
        }
        else{
            $query = "UPDATE `users` SET `Password` = '$confirm_pass' WHERE `user_id` = '$user_id'";
            mysqli_query($conn, $query) or die('query failed');
            $message[] = "Mật khẩu đã được cập nhật thành công!";
        }
    }

    // Lấy tên và đường dẫn mặc định gửi từ server
    $update_image = mysqli_real_escape_string($conn, $_FILES['update_image']['name']);
    $update_image_size = mysqli_real_escape_string($conn, $_FILES['update_image']['size']);
    $update_image_tmp_name = mysqli_real_escape_string($conn, $_FILES['update_image']['tmp_name']);
    $update_image_folder = "./Images/Users/Info/".$update_image;

    // Cập nhật hình ảnh
    // Không rỗng và tồn tại
    if(!empty($update_image)){
        if($update_image_size > 2000000) {
            $message[] = "Hình có kích cỡ quá lớn";
        }else{
            $query = "UPDATE `users` SET `UserImage` = '$update_image' WHERE `user_id` = '$user_id'";
            $update_image_query = mysqli_query($conn, $query) or die('query failed');
            if($update_image_query){
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
                $message[] = "Cập nhật hình thành công";
            }
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
    <title>Document</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="CSS/message_stick.css">
    <style>
        :root{
        --blue:#3498db;
        --dark-blue:#2980b9;
        --red:#e74c3c;
        --dark-red:#c0392b;
        --black:#333;
        --white:#fff;
        --light-bg:#eee;
        --box-shadow:0 5px 10px rgba(0,0,0,.1);
        }
        *{
            text-transform: none !important;
        }
        body,html {
            font-size: 62.5%;
        }
        .update_profile{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .update_profile img {
            width: 15rem;
            height: 15rem;
            border-radius: 50%;
            display: block;
            margin: .5rem auto;
            object-fit: cover;
        }
        .update_profile .content {
            width: 700px;
            text-align: center;
            margin: 20rem;
            border-radius: 5px;
            background-color: var(--white);
            padding: 20px;
            box-shadow: var(--box-shadow);
        }
        .update_profile form {
            padding: 20px;
            text-align: center;
        }
        .update_profile form .flex{
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-bottom: 20px;
            grid-gap: 15px;
        }
        .update_profile form .flex .inputBox {
            width: 100%;
        }
        .update_profile form .flex .inputBox span {
            text-align: left;
            display: block;
            margin-top: 1.5rem;
            margin-bottom: 1.7px;
            color: var(--black);
            font-size: 1.7rem;
        }
        .update_profile form .flex .inputBox .box {
            background-color: var(--light-bg);
            width: 100%;
            padding: 1.2rem 1.4rem; 
            border-radius: .5rem;
            color: var(--black);
            margin-top: 1rem;
            font-size: 1.6rem;
        }
        @media screen and (max-width: 1023px){
            .update_profile form .flex {
                grid-gap: 0;
                grid-template-columns: 100%;
            }
            .update_profile .content {
                max-width: 80%;
            }
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
    <?php require_once('header.php') ?>
    <!-- Profile taskbar -->
    <div class="update_profile">
        <div class="content">
            <!-- $row import từ header.php - line 97 -->
        <?php 
            if($row['UserImage'] == ''){
                echo '<img src="HINH/user-avatar/user.jpg" alt="">';
            }else{
            echo '<img src="Images/Users/Info/'.$row['UserImage'].'">';
            };
        ?>  
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="flex">
                    <div class="inputBox">
                        <span>Tên người dùng: </span>
                        <input type="text" name="update_name" value="<?php echo $row['UserName'] ?>" class="box">
                        <span>Email: </span>
                        <input type="email" name="update_email" value="<?php echo $row['Email'] ?>" class="box">
                        <span>Thay ảnh người dùng: </span>
                        <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
                        <span>Địa chỉ dòng 1: </span>
                        <input type="text" name="update_ap_number" value="<?php echo $row['Ap_number'] ?>" class="box" placeholder="Nhập số nhà">
                        <span>Địa chỉ dòng 2: </span>
                        <input type="text" name="update_street" value="<?php echo $row['Street'] ?>" class="box" placeholder="Nhập tên đường">
                        <span>Quốc gia: </span>
                        <input type="text" name="update_country" value="<?php echo $row['Country'] ?>" class="box" placeholder="Nhập tên quốc gia">
                    </div>
                    <div class="inputBox">
                        <input type="hidden" name="old_pass" value="<?php echo $row['Password'] ?>">
                        <span>Mật khẩu cũ: </span>
                        <input type="password" name="update_pass" placeholder="Nhập mật khẩu cũ" class="box">
                        <span>Mật khẩu mới: </span>
                        <input type="password" name="new_pass" placeholder="Nhập mật khẩu mới" class="box">  
                        <span>Xác nhận mật khẩu: </span>
                        <input type="password" name="confirm_pass" placeholder="Nhập xác nhận mật khẩu" class="box">
                        <span>Phone: </span>
                        <input type="text" name="update_phone" value="<?php echo $row['UserPhone'] ?>" class="box" placeholder="Nhập số điện thoại">
                        <span>Nhập Quận/Huyện/Tỉnh/Thị xã: </span>
                        <input type="text" name="update_sub_address" value="<?php echo $row['Sub_address'] ?>" class="box" placeholder="Nhập Quận/Huyện/Tỉnh/Thị xã">
                        <span>Thành phố: </span>
                        <input type="text" name="update_city" value="<?php echo $row['City'] ?>" class="box" placeholder="Nhập thành phố">
                    </div>
                </div>
                <input type="submit" value="Cập nhật thông tin" name="update_profile" class="option-btn">
            </form>
        </div>
    </div>
    <?php require_once('footer.php') ?>
</body>
</html>