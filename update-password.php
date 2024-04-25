<?php
include("partials-font/menu.php");
ob_start();
$session_user = ""; // Khởi tạo biến session_user

$id_us = "";

if (isset($_GET['session_user'])) {
    $session_user = $_GET['session_user']; // Lấy giá trị session_user từ URL nếu tồn tại
}

// Lấy thông tin
$sql_s = "SELECT * FROM khach_hang WHERE ten_nguoi_dung='$session_user'";
$res_s = mysqli_query($conn, $sql_s);
$row_s = mysqli_fetch_assoc($res_s);
$count_s = mysqli_num_rows($res_s);
if ($count_s == 1) {
    //Có
    $id_us = $row_s['id'];
} else {
    //Không
}
?>

<div class="food-menu">
    <div class="container">
        <h1>ĐỔI MẬT KHẨU</h1>
        <br><br>

        <!-- Tạo form đổi mật khẩu -->
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Mật khẩu hiện tại:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Mật khẩu hiện tại">
                    </td>
                </tr>

                <tr>
                    <td>Mật khẩu mới:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="Mật khẩu mới">
                    </td>
                </tr>

                <tr>
                    <td>Xác nhận mật khẩu mới:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Thay đổi mật khẩu" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php
//Kiểm tra nút đổi mật khẩu
if (isset($_POST['submit'])) {
    //echo "Clicked"

    //1. Lấy dữ liệu
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. Kiểm tra mật khẩu hiện tại
    $sql = "SELECT * FROM khach_hang WHERE id=$id_us AND mat_khau = '$current_password'";

    //Chạy SQL
    $res = mysqli_query($conn, $sql);

    if ($res == true) {

        //Kiểm tra số dòng
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //Người dùng tồn tại có thể đổi mật khẩu
            //echo "User found";

            //Xác nhận mật khẩu mới lần 2
            if ($new_password == $confirm_password) {
                //Cập nhật mật khẩu
                //echo "Password Match";
                $sql2 = "UPDATE khach_hang SET 
                        mat_khau = '$new_password'
                        WHERE id=$id_us";

                //Chạy SQL
                $res2 = mysqli_query($conn, $sql2);

                //Kiểm tra kết nối
                if ($res2 == true) {
                    //Hiển thị thông báo và chuyển hướng
                    $_SESSION['change-pwd'] = "<div class='success'>Mật khẩu thay đổi thành công.</div>";
                    header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
                } else {
                    //Hiển thị thông báo và chuyển hướng
                    $_SESSION['change-pwd'] = "<div class='error'>Thay đổi mật khẩu thất bại.</div>";
                    header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
                }
            } else {
                //Hiển thị thông báo và chuyển hướng
                $_SESSION['pwd-not-match'] = "<div class='error'>Mật khẩu mới không trùng khớp.</div>";
                header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
            }
        } else {
            //Hiển thị thông báo và chuyển hướng
            $_SESSION['user-not-found'] = "<div class='error'>Mật khẩu hiện tại không đúng.</div>";
            header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
        }
    }
}
?>

<?php
include("partials-font/footer.php");
ob_end_flush();
?>