<?php

include('../config/constants.php');

//1. Lấy id admin để xóa
$id = $_GET['id'];

//2. Tạo SQL để xóa admin
$sql = "DELETE FROM admin WHERE id=$id";

//Chạy SQL
$res = mysqli_query($conn, $sql);

//3. Chuyển hướng và thông báo ở trang quản lý admin
//Kiểm tra câu lệnh thành công hay thất bại
if ($res == true) {
    //Câu lệnh thực thi và xóa thành công
    // echo "Admin Deleted";
    //Tạo biến phiên để thông báo
    $_SESSION['delete'] = "<div class='success'>Xóa quản trị viên thành công.</div>";
    //Chuyển hướng đến trang chủ admin
    header("location:" . SITEURL . "admin/manager-admin.php");
} else {
    //Xóa thất bại
    // echo "Failed to Delete Admin";
    //Tạo biến phiên để thông báo
    $_SESSION['delete'] = "<div class='error'>Xóa quản trị viên thất bại. Vui lòng thử lại sao.</div>";
    //Chuyển hướng đến trang quản lý admin
    header("location:" . SITEURL . "admin/manager-admin.php");
}
