<?php

//Include constants Page
include('../config/constants.php');

// echo "Xoa san pham";

if (isset($_GET['id']) and isset($_GET['anh'])) //Either use '&&' or 'AND'
{
    //Process to Delete
    // echo "Process to Delete";

    //1. Get ID and Image name
    $id = $_GET['id'];
    $anh = $_GET['anh'];

    //2. Remove the Image if Available
    //Chcek whether the image is available or not and Delete only if available
    if ($anh != "") {
        //It has image and need to remove from folder
        //Get the Image path
        $path = "../images/agricultural/" . $anh;

        //Remove Image File from Folder
        $remove = unlink($path);

        //Check whether the image is removed or not
        if ($remove == false) {
            //Failed to Remove Image
            $_SESSION['upload']  = "<div class='error'>Xóa hình ảnh thất bại.</div>";
            //Redirect to Manage Food 
            header('location:' . SITEURL . 'admin/manager-agricultural.php');
            //Stop the Process of Deleting Food
            die();
        }
    }

    //3. Delete food form Database
    $sql = "DELETE FROM san_pham WHERE id = $id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed or not and set the session message respectively
    //4. Redirect to Manager Food with Session Message
    if ($res == true) {
        //Food deleted
        $_SESSION['delete'] = "<div class='success'>Xóa sản phẩm thành công.</div>";
        header('location:' . SITEURL . 'admin/manager-agricultural.php');
    } else {
        //Failed to delete food
        $_SESSION['delete'] = "<div class='error'>Xóa sản phẩm thất bại.</div>";
        header('location:' . SITEURL . 'admin/manager-agricultural.php');
    }
} else {
    //Redirect to Manage Food Page
    // echo "Redicrect";
    $_SESSION['unauthorize'] = "<div class='error'>Không có quyền truy cập.</div>";
    header('location:' . SITEURL . 'admin/manager-agricultural.php');
}
