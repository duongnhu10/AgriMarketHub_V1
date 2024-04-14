<?php

//Include constants.php here
include('config/constants.php'); //Out of admin

$session_user = ""; // Khởi tạo biến session_user

if (isset($_GET['session_user'])) {
    $session_user = $_GET['session_user']; // Lấy giá trị session_user từ URL nếu tồn tại
}

//1. get the session 
// $session_user = $_GET['session_user'];

//2. Create SQL Query to Delete User
$sql = "DELETE FROM khach_hang WHERE ten_nguoi_dung='$session_user'";

//Execute the query
$res = mysqli_query($conn, $sql);

//3. Redirect to Mange User page with message (success/error)
//Check whether the query executed successfully or not
if ($res == true) {
    //Query Executed Successfully and User Deleted
    //Create a Session Variable to Display Message
    $_SESSION['delete'] = "<div class='success'>Xóa tài khoản thành công.</div>";
?>
    <script>
        alert('Xóa tài khoản thành công.');
        // Sau khi hiển thị cảnh báo, bạn có thể chuyển hướng người dùng đến một trang khác
        window.location.href = '<?php echo SITEURL; ?>logout.php?session_user=<?php echo $_SESSION['user']; ?>';
    </script>

<?php
} else {
    //Failed to Delete Admin
    // echo "Failed to Delete Admin";
    //Create a Session Variable to Display Message
    $_SESSION['delete'] = "<div class='error'>Xóa tài khoản thất bại.</div>";

    header('Location: ' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
}
