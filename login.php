<?php 
session_start();
include("connection.php");
include("./function/user_function.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    if(!empty($name) && !empty($password) && !is_numeric($name)) {
        // Define the query based on user type
        if ($user_type == 'user') {
            $query = "SELECT * FROM `users` WHERE `UserName` = '$name' AND `Password` = '$password'";
        } else if ($user_type == 'admin') {
            $query = "SELECT * FROM `admin` WHERE `name` = '$name' AND `password` = '$password'";
        } else {
            $message[] = "Loại người dùng không hợp lệ";
        }

        if (isset($query)) {
            $result = mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);

                    // Check for user or admin and set session accordingly
                    if ($user_type == 'user' && $user_data['Password'] === $password && $user_data['UserName'] === $name) {
                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location: index.php");
                        die;
                    } else if ($user_type == 'admin' && $user_data['password'] === $password && $user_data['name'] === $name) {
                        $_SESSION['admin_id'] = $user_data['admin_id'];
                        header("Location: admin.php");
                        die;
                    } else {
                        $message[] = "Nhập sai tên tài khoản hay mật khẩu";
                    }
                } else {
                    $message[] = "Nhập sai tên tài khoản hay mật khẩu";
                }
            } else {
                $message[] = "Database query failed: " . mysqli_error($conn);
            }
        }
    } else {
        $message[] = "Vui lòng nhập đầy đủ thông tin";
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
    <!-- link font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;1,600&display=swap" rel="stylesheet">
    <!-- link css -->
    <link rel="stylesheet" href="./CSS/register.css">
    <link rel="stylesheet" href="./CSS/scrollbar.css">
    <style>
        body {
        background: -webkit-linear-gradient(left,  #a445b2, #fa4299)!important;
        }
        .form-inner form button,
        .form-inner form .field input[type="submit"] {
        color: #fff;
        font-size: 20px;
        font-weight: 500;
        padding-left: 0px;
        border: none;
        cursor: pointer;
        background: -webkit-linear-gradient(left,  #a445b2, #fa4299);
    }
        .form-inner form .field button,
        .form-inner form .field input {
            width: 100%;
            height: 100%;
            outline: none;
            padding-left: 15px;
            font-size: 17px;
            border-radius: 5px;
            border: 1px solid lightgrey;
            border-bottom-width: 2px;
            transition: all 0.4s ease;
        }
        .form-inner form .field select {
            width: 100%;
            height: 100%;
            outline: none;
            padding-left: 15px;
            font-size: 17px;
            border-radius: 5px;
            border: 1px solid lightgrey;
            border-bottom-width: 2px;
            transition: all 0.4s ease;
        }
        .form-inner form .field button.form-submit {
            padding-left: 0;
        }
        .signup-link{
            font-size: 16px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <?= require("header_no_login.php") ?>   

    <div class="wrapper">
        <h3 class="title-text" style="text-align :center;">Đăng nhập</h3>
        <div class="form-container">
            <div class="form-inner">
                <form action="" method="POST" class="signup" id="form-signup" enctype="multipart/form-data">
                <?php
                if(isset($message)){
                    foreach($message as $msg){
                        echo '<div class="message">'.$msg.'</div>';
                    }
                }
                ?>
                    <div class="field">
                        <input type="text" id="fullname" name="name" placeholder="Tên đầy đủ" class="form-control">
                        <span class="form-message"></span>
                    </div>
                    <div class="field">
                        <input type="password" id="password" name="password" placeholder="Mật khẩu" class="form-control">
                        <span class="form-message"></span>
                    </div>
                    <div class="field">
                        <button name="submit" class="form-submit">Đăng nhập</button>
                    </div>
                    <div class="field">
                        <select name="user_type" id="">
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    <div class="signup-link">Không phải thành viên? <a href="register.php">Đăng ký</a></div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="./JS/validator.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Validator({
            form: '#form-signup',
            formGroupSelector: '.field',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#fullname', 'Vui lòng nhập tên đầy đủ của bạn'),
                Validator.isEmail('#email'),
                Validator.minLength('#password', 6),
                Validator.isRequired('#password_confirmation'),
                Validator.isConfirmed('#password_confirmation', function () {
                return document.querySelector('#form-signup #password').value;
                }, 'Mật khẩu nhập lại không chính xác')
            ],
            });

            Validator({
            form: '#form-login',
            formGroupSelector: '.field',
            errorSelector: '.form-message',
            rules: [
                Validator.isEmail('#email'),
                Validator.minLength('#password', 6),
            ],
            });
        });

        </script>
        <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

        <!-- custom js file link  -->
        <script src="js/script.js"></script>
        <!-- CART JS -->
        <script src="js/cart.js"></script>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
