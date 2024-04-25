<?php

include('../config/constants.php');

if (isset($_GET['id']) and isset($_GET['anh'])) {
    //Quá trình xóa
    // echo "Process to Delete";

    //1. Lấy id và ảnh
    $id = $_GET['id'];
    $anh = $_GET['anh'];

    //2. Xóa ảnh nếu tồn tại
    //Kiểm tra ảnh và xóa
    if ($anh != "") {
        //Có hình ảnh và xóa khỏi thư mục hình
        //Lấy đường dẫn nơi lưu ảnh
        $path = "../images/agricultural/" . $anh;

        //Xóa tệp hình ảnh từ thư mục
        $remove = unlink($path);

        //Kiểm tra hình ảnh đã được xóa hay chưa
        if ($remove == false) {
            //Xóa thất bại
            $_SESSION['upload']  = "<div class='error'>Xóa hình ảnh thất bại.</div>";
            //Chuyển hướng đến trang quản lý sản phẩm
            header('location:' . SITEURL . 'admin/manager-agricultural.php');
            //Dừng quá trình
            die();
        }
    }

    //3. Xóa sản phẩm từ database
    $sql = "DELETE FROM san_pham WHERE id = $id";
    //Chạy SQL
    $res = mysqli_query($conn, $sql);

    //Kiểm tra câu lệnh và đặt phiên
    //4. Chuyển hướng trang quản lý sản phẩm và thông báo
    if ($res == true) {
        //Xóa thành công
        $_SESSION['delete'] = "<div class='success'>Xóa sản phẩm thành công.</div>";
        header('location:' . SITEURL . 'admin/manager-agricultural.php');
    } else {
        //Xóa thất bại
        $_SESSION['delete'] = "<div class='error'>Xóa sản phẩm thất bại.</div>";
        header('location:' . SITEURL . 'admin/manager-agricultural.php');
    }
} else {
    //Chuyển hướng đến trang quản lý sản phẩm
    // echo "Redicrect";
    $_SESSION['unauthorize'] = "<div class='error'>Không có quyền truy cập.</div>";
    header('location:' . SITEURL . 'admin/manager-agricultural.php');
}
