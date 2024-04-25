<?php
//Kiểm tra người dùng đã đăng nhập hay chưa

if (!isset($_SESSION['user'])) { //Nếu phiên không được đặt
    //Người dùng chưa đăng nhập
    //Chuyển hướng trang đăng nhập và thông báo
    $_SESSION['no-login-message'] = "<div class='error text-center'>Vui lòng đăng nhập.</div>";
    header('location:' . SITEURL . 'guest/login.php');
}
