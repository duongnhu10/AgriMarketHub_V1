<?php

//Include constants.php here
include('../config/constants.php'); //Out of admin

//1. get the ID of Admin to be deleted
$id = $_GET['id'];

//2. Create SQL Query to Delete Admin 
$sql = "DELETE FROM admin WHERE id=$id";

//Execute the query
$res = mysqli_query($conn, $sql);

//3. Redirect to Mange Admin page with message (success/error)
//Check whether the query executed successfully or not
if ($res == true) {
    //Query Executed Successfully and Admin Deleted
    // echo "Admin Deleted";
    //Create a Session Variable to Display Message
    $_SESSION['delete'] = "<div class='success'>Xóa quản trị viên thành công.</div>";
    //Redirect Page to Manager Admin
    header("location:" . SITEURL . "admin/manager-admin.php");
} else {
    //Failed to Delete Admin
    // echo "Failed to Delete Admin";
    //Create a Session Variable to Display Message
    $_SESSION['delete'] = "<div class='error'>Xóa quản trị viên thất bại. Vui lòng thử lại sao.</div>";
    //Redirect Page to Manager Admin
    header("location:" . SITEURL . "admin/manager-admin.php");
}
