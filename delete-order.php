<?php

include('config/constants.php');

//1. Lấy id của đơn hàng khách hàng muốn hủy đơn
$id_huy = $_GET['order-id'];

//Lấy thông tin đơn hàng hủy
$sql = "SELECT * FROM don_hang WHERE id=$id_huy";

//Kết nối SQL
$res = mysqli_query($conn, $sql);

//Đi qua từng dòng
$row = mysqli_fetch_assoc($res);

//Lấy các giá trị
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
$user_id = $row['user_id'];

//Cập nhật số lượng tồn kho sau khi khách hàng hủy đơn
$sql_update_tk = "SELECT * FROM san_pham";
$res_update_tk = mysqli_query($conn, $sql_update_tk);
$row_update_tk = mysqli_fetch_assoc($res_update_tk);
$ton_kho = $row_update_tk['ton_kho'];

$sql_tk1 = "UPDATE san_pham SET ton_kho = $ton_kho + $so_luong WHERE ten_san_pham='$san_pham'";
$res_tk1 = mysqli_query($conn, $sql_tk1);

//Chèn thông tin đơn hàng hủy
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
        khach_diachi = '$khach_diachi',
        user_id = $user_id
        ";

//Chạy SQL chèn
$res1 = mysqli_query($conn, $sql1);

// Xóa đơn hàng hủy khỏi danh sách đơn hàng của khách hàng
$sql2 = "DELETE FROM don_hang WHERE id=$id_huy";

$res2 = mysqli_query($conn, $sql2);

//3. Kiểm tra 
if ($res2 == true) {
    //Hủy thành công và chuyển hướng
    $_SESSION['delete'] = "<div class='success'>Hủy đơn hàng thành công.</div>";
    //Chuyển hướng trang theo dõi đơn hàng
    header("location:" . SITEURL . "tracking-order.php?session_user=" . $_SESSION['user']);
} else {
    //Hủy thất bại và chuyển hướng
    $_SESSION['delete'] = "<div class='error'>Hủy đơn hàng thất bại.</div>";
    //Chuyển hướng trang theo dõi đơn hàng
    header("location:" . SITEURL . "tracking-order.php?session_user=" . $_SESSION['user']);
}
