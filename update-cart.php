<?php
include('config/constants.php');

// Kiểm tra xem yêu cầu POST có tồn tại không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ yêu cầu POST
    $sanpham_id = $_POST['sanpham_id'];
    $so_luong_moi = $_POST['so_luong'];
    $session_user = $_POST['session_user'];


    $sql_tk = "SELECT * FROM san_pham WHERE id=$sanpham_id";
    $res_tk = mysqli_query($conn, $sql_tk);
    $row_tk = mysqli_fetch_assoc($res_tk);
    $ton_kho = $row_tk['ton_kho'];
    // Kiểm tra xem số lượng đặt hàng có vượt quá số lượng tồn kho hay không
    if ($so_luong_moi > $ton_kho) {
        // Nếu vượt quá, hiển thị cảnh báo và chuyển hướng trở lại trang đặt hàng
        $_SESSION['gio_hang'] = "<div class='error text-center'>Số lượng đặt hàng vượt quá số lượng tồn kho.</div>";
        header('location:' . SITEURL . 'cart.php');
        exit; // Dừng việc thực hiện tiếp các lệnh sau khi chuyển hướng
    } else {
        //hợp lệ
    }

    $sql_s = "SELECT * FROM khach_hang WHERE ten_nguoi_dung='$session_user'";
    $res_s = mysqli_query($conn, $sql_s);
    $row_s = mysqli_fetch_assoc($res_s);
    $count_s = mysqli_num_rows($res_s);
    if ($count_s == 1) {
        //Have data
        $id_us = $row_s['id'];
    } else {
        //No data
    }

    // Thực hiện câu lệnh SQL UPDATE để cập nhật số lượng
    $sql_update = "UPDATE gio_hang SET so_luong = $so_luong_moi WHERE san_pham_id = $sanpham_id AND user_id = $id_us";
    $res_update = mysqli_query($conn, $sql_update);

    // Kiểm tra kết quả và gửi phản hồi về máy khách nếu cần
    if ($res_update) {
        echo "Cập nhật số lượng thành công.";
    } else {
        echo "Cập nhật số lượng không thành công.";
    }
}
