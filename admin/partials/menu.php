<?php
include('../config/constants.php');
include('login-check.php');
?>

<html>

<head>
    <title>Nông sản - Admin</title>
    <link rel="stylesheet" href="/css/admin.css">
    <!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Bắt đầu menu -->
    <div class="menu">
        <div class="wrapper">
            <ul class="text-center">
                <li><a href="index.php">TRANG CHỦ</a></li>

                <span class="dropdown">
                    <li><a class="dropbtn">QUẢN LÝ DANH MỤC <i class="fas fa-folder-plus"></i></a></li>

                    <div id="myDropdown" class="dropdown-content">

                        <li><a href="manager-admin.php">QUẢN TRỊ VIÊN</a></li>
                        <li><a href="manager-user.php">NGƯỜI DÙNG</a></li>
                        <li><a href="manager-category.php">LOẠI SẢN PHẨM</a></li>
                        <li><a href="manager-agricultural.php">SẢN PHẨM</a></li>
                        <li><a href="manager-order.php">ĐƠN HÀNG</a></li>

                        <li><a href="contact.php">PHẢN HỒI</a></li>

                    </div>
                </span>

                <li><a href="logout.php">ĐĂNG XUẤT</a></li>
            </ul>
        </div>
    </div>
    <!-- Kết thúc menu -->