<?php
//Include constans file
include('../config/constants.php');
// echo "XÓA LOẠI SẢN PHẨM";
//Check whether the id and anh value is set or not
if (isset($_GET['id']) and isset($_GET['anh'])) {
    //Get the value and Delete 
    // echo "Get value and Delete";
    $id = $_GET['id'];
    $anh = $_GET['anh'];

    //Remove the physical image file is available
    if ($anh != "") {
        //Image is Available
        $path = "../images/category/" . $anh;
        //Remove the Image
        $remove = unlink($path);

        //if failed to remove image then add an error message and stop the process
        if ($remove == false) {
            //Set the Session Message
            $_SESSION['remove'] = "<div class='error'>Xóa hình ảnh loại sản phẩm thất bại</div>";

            //Redirect to Manage Category page
            header('location:' . SITEURL . 'admin/manager-category.php');

            //Stop the Process
            die();
        }
    }

    //Delete data form Database
    //SQL Query to Delete Data from Database 
    $sql = "DELETE FROM loai_san_pham 
            WHERE id = '$id'";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the data is delete from database or not
    if ($res == true) {
        //Set success Message and Redirect
        $_SESSION['delete'] = "<div class='success'>Xóa loại sản phẩm thành công.</div>";
        //Redirect to Manager Category Page
        header('location:' . SITEURL . 'admin/manager-category.php');
    } else {
        //Set fail message and Redirect
        $_SESSION['delete'] = "<div class='error'>Xóa loại sản phẩm thất bại.</div>";
        //Redirect to Manager Category Page
        header('location:' . SITEURL . 'admin/manager-category.php');
    }
} else {
    //Redirect to Manager Category Page
    header('location:' . SITEURL . 'admin/manager-category');
}
