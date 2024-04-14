<?php

//Include constants.php here
include('config/constants.php'); //Out of admin

//1. get the ID of Admin to be deleted
$id_huy = $_GET['order-id'];

$sql = "SELECT * FROM don_hang WHERE id=$id_huy";

$res = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($res);

$san_pham = $row['san_pham'];
$gia = $row['gia'];
$so_luong = $row['so_luong'];
$tong_tien = $row['tong_tien'];
$ngay_dat = $row['ngay_dat'];
$trang_thai = $row['trang_thai'];
$khach_ten = $row['khach_ten'];
$khach_sdt = $row['khach_sdt'];
$khach_email = $row['khach_email'];
$khach_diachi = $row['khach_diachi'];

$sql1 = "INSERT INTO don_huy 
        SET 
        san_pham = '$san_pham',
        gia = $gia,
        so_luong = $so_luong,
        tong_tien = $tong_tien,
        ngay_dat = '$ngay_dat',
        trang_thai = '$trang_thai',
        khach_ten = '$khach_ten',
        khach_sdt = '$khach_sdt',
        khach_email = '$khach_email',
        khach_diachi = '$khach_diachi'
        ";


//Execute the query
$res1 = mysqli_query($conn, $sql1);

$sql2 = "DELETE FROM don_hang WHERE id=$id_huy";

$res2 = mysqli_query($conn, $sql2);

//3. Redirect to Mange Admin page with message (success/error)
//Check whether the query executed successfully or not
if ($res2 == true) {
    //Query Executed Successfully and Admin Deleted
    // echo "Admin Deleted";
    //Create a Session Variable to Display Message
    $_SESSION['delete'] = "<div class='success'>Hủy đơn hàng thành công.</div>";
    //Redirect Page to Manager Admin
    header("location:" . SITEURL . "tracking-order.php?session_user=" . $_SESSION['user']);
} else {
    //Failed to Delete Admin
    // echo "Failed to Delete Admin";
    //Create a Session Variable to Display Message
    $_SESSION['delete'] = "<div class='error'>Hủy đơn hàng thất bại.</div>";
    //Redirect Page to Manager Admin
    header("location:" . SITEURL . "tracking-order.php?session_user=" . $_SESSION['user']);
}
