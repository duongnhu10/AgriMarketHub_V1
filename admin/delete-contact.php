<?php

//Include constants Page
include('../config/constants.php');

if (isset($_GET['id_lienhe'])) {
    //Get id
    $id = $_GET['id_lienhe'];

    //Create SQL to delete
    $sql = "DELETE FROM lien_he WHERE id=$id";

    //Execute sql
    $res = mysqli_query($conn, $sql);

    //Check sql connect
    if ($res == true) {
        $_SESSION['xoa_lienhe'] = "<div class='success'>Xóa thành công.</div>";
        header('location:' . SITEURL . 'admin/contact.php');
    } else {
        $_SESSION['xoa_lienhe'] = "<div class='error'>Xóa liên hệ thất bại.</div>";
        header('location:' . SITEURL . 'admin/contact.php');
    }
}
