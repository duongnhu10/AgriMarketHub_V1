<?php
include('config/constants.php');
$session_user = ""; // Khởi tạo biến session_user

if (isset($_GET['session_user'])) {
    $session_user = $_GET['session_user']; // Lấy giá trị session_user từ URL nếu tồn tại
}

//Lấy thông tin người đăng nhập hiện tại
$sql_s = "SELECT * FROM khach_hang WHERE ten_nguoi_dung='$session_user'";
$res_s = mysqli_query($conn, $sql_s);
$row_s = mysqli_fetch_assoc($res_s);
$count_s = mysqli_num_rows($res_s);
if ($count_s == 1) {
    //Có dữ liệu
    $id_us = $row_s['id'];
} else {
    //Không có dữ liệu
}
?>

<?php
//Kiểm tra id sản phẩm có tồn tại hay không
if (isset($_GET['spham_id'])) {

    //Lấy id sản phẩm được chọn
    $spham_id = $_GET['spham_id'];

    //Lấy chi tiết sản phẩm được chọn
    $sql = "SELECT * FROM san_pham WHERE id=$spham_id";
    //Chạy SQL
    $res = mysqli_query($conn, $sql);
    //Đếm số dòng
    $count = mysqli_num_rows($res);
    //Kiểm tra dữ liệu có tồn tại hay không
    if ($count == 1) {
        //Có dữ liệu
        $row = mysqli_fetch_assoc($res);
        $ten_san_pham = $row['ten_san_pham'];
        $gia = $row['gia'];
        $gia_dn = $row['gia_dn'];
        $gia_khuyen_mai = $row['gia_khuyen_mai'];
        $anh = $row['anh'];

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $sql_check = "SELECT * FROM gio_hang WHERE ten_san_pham = '$ten_san_pham' AND user_id=$id_us";
        $res_check = mysqli_query($conn, $sql_check);
        $count_check = mysqli_num_rows($res_check);

        if ($count_check > 0) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng của nó
            $sql_update = "UPDATE gio_hang SET so_luong = so_luong + 1 WHERE ten_san_pham = '$ten_san_pham'";
            $res_update = mysqli_query($conn, $sql_update);
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm nó vào
            $sql_insert = "INSERT INTO gio_hang SET 
                        ten_san_pham = '$ten_san_pham',
                        gia = $gia,
                        gia_dn = $gia_dn,
                        gia_khuyen_mai = $gia_khuyen_mai,
                        anh = '$anh',
                        so_luong = 1,
                        san_pham_id = '$spham_id',
                        user_id = $id_us";
            $res_insert = mysqli_query($conn, $sql_insert);
        }
    } else {
        //Không tồn tại sản phẩm
        //Chuyển hướng đến trang chủ
        header('location:' . SITEURL . "?session_user=" . $_SESSION['user']);
    }
} else {
    //Chuyển hướng đến trang chủ
    header('location:' . SITEURL . "?session_user=" . $_SESSION['user']);
}
?>
