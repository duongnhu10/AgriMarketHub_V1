<?php

include('../config/constants.php');

if (isset($_GET['id_lienhe'])) {
    //Lấy id
    $id = $_GET['id_lienhe'];

    //SQL để xóa
    $sql = "DELETE FROM lien_he WHERE id=$id";

    //Chạy SQL
    $res = mysqli_query($conn, $sql);

    //Kiêm tra kết nối
    if ($res == true) {
        $_SESSION['xoa_lienhe'] = "<div class='success'>Xóa thành công.</div>";
        header('location:' . SITEURL . 'admin/contact.php');
    } else {
        $_SESSION['xoa_lienhe'] = "<div class='error'>Xóa liên hệ thất bại.</div>";
        header('location:' . SITEURL . 'admin/contact.php');
    }
}
