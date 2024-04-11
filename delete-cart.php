<?php

//Include constants.php here
include('config/constants.php'); //Out of admin

//1. get the ID of Admin to be deleted
$gio_hang_id = $_GET['gio_hang_id'];

//2. Create SQL Query to Delete Admin 
$sql = "DELETE FROM gio_hang WHERE id=$gio_hang_id";

//Execute the query
$res = mysqli_query($conn, $sql);

//3. Redirect to Mange Admin page with message (success/error)
//Check whether the query executed successfully or not
if ($res == true) {
    //Query Executed Successfully and Admin Deleted
    // echo "Admin Deleted";
    //Create a Session Variable to Display Message
    $_SESSION['delete'] = "<div class='success'>Xóa sản phẩm thành công.</div>";
    header('location:' . SITEURL . 'cart.php');
} else {
    //Failed to Delete Admin
    // echo "Failed to Delete Admin";
    //Create a Session Variable to Display Message
    $_SESSION['delete'] = "<div class='error'>Xóa sản phẩm thất bại.</div>";
    header('location:' . SITEURL . 'cart.php');
}
