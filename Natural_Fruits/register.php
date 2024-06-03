<?php 
session_start();

	include("connection.php");
	include("./function/user_function.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
        $user_type =  mysqli_real_escape_string($conn,$_POST['user_type']);

        // User
        if($_POST['user_type'] == 'user'){
            $sql = "SELECT * FROM `users` WHERE `Email` = '$email' AND `Password` = '$password' ";
            $select = mysqli_query($conn, $sql) or die('query Failed');
            if(!empty($name) && !empty($password) && !empty($email) && !is_numeric($name) )
            {   
                if (mysqli_num_rows($select)>0){
                    $message[] = "tài khoản đã tồn tại";
                }
                else{
                    // Insert to save database 
                    $query = "INSERT INTO users (`user_id`, `UserName`, `Email`, `Password`) VALUES (UUID(), '$name', '$email', '$password')";
                    if($query){
                        mysqli_query($conn, $query);
                        $message[] = "Đăng ký thành công - chuyển đến trang chủ";
                        header("Location: login.php");
                        die;
                    }
                }
            }else{
                $message[] = "Bạn chưa nhập hoặc lỗi máy chủ";
            }
        }
        

        // Admin
        if($_POST['user_type'] == 'admin'){
            $sql = "SELECT * FROM `admin` WHERE `email` = '$email' AND `password` = '$password' ";
            $select = mysqli_query($conn, $sql) or die('query Failed');
            if(!empty($name) && !empty($password) &&! empty($email) && !is_numeric($name) )
            {   
                if (mysqli_num_rows($select)>0){
                    $message[] = "tài khoản đã tồn tại";
                }
                else{
                    // Insert to save database 
                    $query = "INSERT INTO admin (`admin_id`, `name`, `email`, `password`) VALUES (UUID(), '$name', '$email', '$password')";
                    if($query){
                        mysqli_query($conn, $query);
                        $message[] = "Đăng ký thành công - chuyển đến trang chủ";
                        header("Location: login.php");
                        die;
                    }
                }
            }else{
                $message[] = "Bạn chưa nhập hoặc lỗi máy chủ";
            }
        }
        // Kiểm tra tài khoản đã tồn tại chưa
        
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
    <link rel="stylesheet" href="CSS/register.css">
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
        .form-inner form .field select,
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
        .form-inner form .field select{
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
        .login-link{
            font-size: 16px;
            font-weight: 500;
        }
        .wrapper{
            margin-top: 100px;
        }
        @media screen and (max-width: 678px){
            .wrapper{
                width: 300px;
            }
            .wrapper{
                font-size: 50%;
            }
        }
        @media screen and (min-width: 679px) and (max-width: 1023px){
            .wrapper{
                width: 500px;
            }
            .wrapper{
                font-size: 50%;
            }
        }

        @media screen and (min-width: 1024px) and (max-width: 1279px) {
            .wrapper{
                width: 390px;
                height: 400px;
            }
            .form-container .form-inner form .field {
                margin-top: 5px;
            }
            .form-container .form-inner form .login-link{
                margin-top: 2px;
            }
        }
        @media screen and (max-width: 376px) {
            .wrapper{
                width: 300px;
            }
            .form-container .form-inner form .field {
                margin-top: 2px;
            }
            .form-container .form-inner form .login-link{
                margin-top: 2px;
            }
        }
        
    </style>
</head>
<body>
    <?= require("header_no_login.php") ?>

    <section>
    <div class="wrapper">
        <h3 class="title-text" style="text-align :center;">Đăng ký</h3>
        <div class="form-container">
            <div class="form-inner">
                <form action="" method="POST"class="signup" id="form-signup" enctype="multipart/form-data">
                <?php
                    if(isset($message)){
                        foreach($message as $message){
                            echo '<div class="message">'.$message.'</div>';
                        }
                    }
                    ?>
                    <div class="field">
                        <input type="text" id="fullname" name="name" placeholder="Tên đầy đủ" class="form-control">
                        <span class="form-message"></span>
                    </div>
                    <div class="field">
                        <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                        <span class="form-message"></span>
                    </div>
                    <div class="field">
                        <input type="password" id="password" name="password" placeholder="Mật khẩu" class="form-control">
                        <span class="form-message"></span>
                    </div>
                    <div class="field">
                        <input type="password" id="password_confirmation" name="cpassword" placeholder="Nhập lại mật khẩu" class="form-control">
                        <span class="form-message"></span>
                    </div>
                    <div class="field">
                        <button name="submit" class="form-submit">Đăng ký</button>
                    </div>
                    <div class="field">
                        <select name="user_type" id="">
                            <option value="user">user</option>
                            <option value="admin">amin</option>
                        </select>
                    </div>
                    <div class="login-link">Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></div>
                </form>
            </div>
        </div>
    </div>
    </section>
    
    <script src="./JS/validator.js"></script>
    <script src="./JS/cart.js"></script>
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
            // onSubmit: function (data) {
            //     // Call API
            //     console.log(data);
            // }
            });


            Validator({
            form: '#form-login',
            formGroupSelector: '.field',
            errorSelector: '.form-message',
            rules: [
                Validator.isEmail('#email'),
                Validator.minLength('#password', 6),
            ],
            // onSubmit: function (data) {
            //     // Call API
            //     console.log(data);
            // }
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
    
    