<?php

include('config/constants.php');

//1. Lấy id sản phẩm của giỏ hàng đê xóa
$gio_hang_id = $_GET['gio_hang_id'];

//2. SQL xóa sản phẩm khỏi giỏ hàng
$sql = "DELETE FROM gio_hang WHERE id=$gio_hang_id";

//Chạy SQL
$res = mysqli_query($conn, $sql);

//3. Kiểm tra 
if ($res == true) {
    //Xóa thành công và chuyển hướng trang giỏ hàng
    $_SESSION['delete'] = "<div class='success'>Xóa sản phẩm thành công.</div>";
    header('location:' . SITEURL . 'cart.php?session_user=' . $_SESSION['user']);
} else {
    //Xóa thất bại và chuyển hướng trang giỏ hàng
    $_SESSION['delete'] = "<div class='error'>Xóa sản phẩm thất bại.</div>";
    header('location:' . SITEURL . 'cart.php?session_user=' . $_SESSION['user']);
}
