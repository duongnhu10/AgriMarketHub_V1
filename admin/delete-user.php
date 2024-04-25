<?php

include('../config/constants.php');

//1. Lấy id người dùng để xóa
$id = $_GET['id'];

//2. SQL để xóa người dùng
$sql = "DELETE FROM khach_hang WHERE id=$id";

//Chạy SQL
$res = mysqli_query($conn, $sql);

//3. Chuyển hướng và thông báo ở trang quản lý người dùng
//Kiểm tra câu lệnh chạy thành công hay thất bại
if ($res == true) {
    //Thành công và khách hàng đã bị xóa
    //Tạo biến phiên để thông báo
    $_SESSION['delete'] = "<div class='success'>Xóa người dùng thành công.</div>";
    //Chuyển hướng đến trang quản lý người dùng
    header("location:" . SITEURL . "admin/manager-user.php");
} else {
    //Xóa người dùng thất bại
    //Tạo biến phiên và thông báo
    $_SESSION['delete'] = "<div class='error'>Xóa người dùng viên thất bại. Vui lòng thử lại sao.</div>";
    //Chuyển hướng đến trang quản lý người dùng
    header("location:" . SITEURL . "admin/manager-user.php");
}
