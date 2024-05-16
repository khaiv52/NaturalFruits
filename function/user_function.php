<?php
function check_login($conn){
    if($_SESSION['user_id'])
    {
        $id_user = $_SESSION['user_id'];
        $query = "SELECT * FROM `users` WHERE `user_id` = '$id_user' limit 1 ";
        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //Chuyển hướng đến trang đăng nhập
    header("Location: login.php");
    die;
}

function check_login_admin($conn){
    if($_SESSION['admin_id'])
    {
        $id_amin = $_SESSION['admin_id'];
        $query = "SELECT * FROM `admin` WHERE `admin_id` = '$id_amin' limit 1 ";
        $result_admin = mysqli_query($conn, $query);
        if($result_admin && mysqli_num_rows($result_admin) > 0) {
            $admin_data = mysqli_fetch_assoc($result_admin);
            return $admin_data;
        }
    }
    //Chuyển hướng đến trang đăng nhập
    header("Location: login.php");
    die;
}
// // Hàm random id user 
// function random_num($length)
// {

// 	$text = "";
// 	if($length < 5)
// 	{
// 		$length = 5;
// 	}

// 	$len = rand(4,$length);

// 	for ($i=0; $i < $len; $i++) { 
// 		# code...

// 		$text .= rand(0,9);
// 	}

// 	return $text;
// }