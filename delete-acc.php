<?php

include('config/constants.php');

$session_user = ""; // Khởi tạo biến session_user

if (isset($_GET['session_user'])) {
    $session_user = $_GET['session_user']; // Lấy giá trị session_user từ URL nếu tồn tại
}

//Xóa khách hàng đang đăng nhập
$sql = "DELETE FROM khach_hang WHERE ten_nguoi_dung='$session_user'";

//Chạy SQL
$res = mysqli_query($conn, $sql);

//Kiểm tra kết nối
if ($res == true) {
    //Thông báo xóa thành công
    $_SESSION['delete'] = "<div class='success'>Xóa tài khoản thành công.</div>";
?>
    <script>
        alert('Xóa tài khoản thành công.');
        // Sau khi hiển thị cảnh báo, bạn có thể chuyển hướng người dùng đến một trang khác
        //Chuyển hướng đến trang đăng xuất để hủy bỏ phiên
        window.location.href = '<?php echo SITEURL; ?>logout.php?session_user=<?php echo $_SESSION['user']; ?>';
    </script>
<?php
} else {
    //Xóa tài khoản thất bại và chuyển hướng trang thông tin khách hàng
    $_SESSION['delete'] = "<div class='error'>Xóa tài khoản thất bại.</div>";
    header('Location: ' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
}
