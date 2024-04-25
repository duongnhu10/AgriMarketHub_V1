<?php

include('../config/constants.php');
// echo "XÓA LOẠI SẢN PHẨM";
//Kiểm tra có nhận được id và ảnh không
if (isset($_GET['id']) and isset($_GET['anh'])) {
    //Lấy giá trị và xóa
    // echo "Get value and Delete";
    $id = $_GET['id'];
    $anh = $_GET['anh'];

    //Gỡ file ảnh nếu tồn tại
    if ($anh != "") {
        //Tồn tại hình ảnh
        $path = "../images/category/" . $anh;
        //Xóa ảnh
        $remove = unlink($path);

        //Nếu xóa thất bại thì thông báo lỗi và dừng
        if ($remove == false) {
            //Đặt phiên thông báo
            $_SESSION['remove'] = "<div class='error'>Xóa hình ảnh loại sản phẩm thất bại</div>";

            //Chuyển hướng đến trang quản lý loại sản phẩm
            header('location:' . SITEURL . 'admin/manager-category.php');

            //Dừng quá trình
            die();
        }
    }

    //Xóa dữ liệu từ database
    //SQL để xóa
    $sql = "DELETE FROM loai_san_pham 
            WHERE id = '$id'";

    //Chạy SQL
    $res = mysqli_query($conn, $sql);

    //Kiểm tra dữ liệu đã được xóa hay chưa
    if ($res == true) {
        //Đặt phiên thành công
        $_SESSION['delete'] = "<div class='success'>Xóa loại sản phẩm thành công.</div>";
        //Chuyển hướng đến trang quản lý loại sản phẩm
        header('location:' . SITEURL . 'admin/manager-category.php');
    } else {
        //Thông báo thất bại và chuyển hướng
        $_SESSION['delete'] = "<div class='error'>Xóa loại sản phẩm thất bại.</div>";
        //Chuyển hướng đến trang quản lý loại sản phẩm
        header('location:' . SITEURL . 'admin/manager-category.php');
    }
} else {
    //Chuyển hướng đến trang quản lý loại sản phẩm
    header('location:' . SITEURL . 'admin/manager-category');
}
