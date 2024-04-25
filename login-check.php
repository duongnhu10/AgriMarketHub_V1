<?php
//Kiểm tra người dùng đã đăng nhập chưa

if (!isset($_SESSION['user'])) {
    //Người dùng chưa đăng nhập chuyển hướng đến trang đăng nhập và thông báo
    $_SESSION['no-login-message'] = "<div class='error text-center'>Vui lòng đăng nhập.</div>";
    //Chuyển hướng
    header('location:' . SITEURL . 'guest/login.php');
}
