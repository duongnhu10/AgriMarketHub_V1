<?php include("./partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>ĐỔI MẬT KHẨU</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <!-- Form đổi mật khẩu  -->
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
//Kiểm tra nút thay đổi sản phẩm có được nhấn hay không
if (isset($_POST['submit'])) {
    //echo "Clicked"

    //1. Lấy dữ liệu từ form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. Kiểm tra admin có tồn tại với mật khẩu và id hiện tại không
    $sql = "SELECT * FROM admin WHERE id=$id AND mat_khau = '$current_password'";

    //Chạy SQL
    $res = mysqli_query($conn, $sql);


    if ($res == true) {
        //Nếu mật khẩu hiện tại đúng
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //Người dùng tồn tại và có thể đổi mật khẩu
            //echo "User found";

            //Kiểm tra nhập lại mật khẩu mới lần 2 có đúng lần 1 hay không
            if ($new_password == $confirm_password) {
                //Cập nhật mật khẩu
                //echo "Password Match";
                $sql2 = "UPDATE admin SET 
                        mat_khau = '$new_password'
                        WHERE id=$id";

                //Chạy SQL
                $res2 = mysqli_query($conn, $sql2);

                //Kiểm tra câu lệnh có được chạy hay không
                if ($res2 == true) {
                    //Thông báo thành công
                    //Chuyển hướng trang quản lí admin và thông báo
                    $_SESSION['change-pwd'] = "<div class='success'>Mật khẩu thay đổi thành công.</div>";
                    header("location:" . SITEURL . "/admin/manager-admin.php");
                } else {
                    //Hiển thị thông báo lỗi
                    $_SESSION['change-pwd'] = "<div class='error'>Thay đổi mật khẩu thất bại.</div>";
                    //Chuyển hướng trang quản lí admin
                    header("location:" . SITEURL . "/admin/manager-admin.php");
                }
            } else {
                //Chuyển hướng và thông báo lỗi
                $_SESSION['pwd-not-match'] = "<div class='error'>Mật khẩu mới không trùng khớp.</div>";
                header("location:" . SITEURL . "/admin/manager-admin.php");
            }
        } else {
            //Không tồn tại người dùng và đặt thông báo
            $_SESSION['user-not-found'] = "<div class='error'>Mật khẩu hiện tại không đúng.</div>";
            //Chuyển hướng
            header("location:" . SITEURL . "/admin/manager-admin.php");
        }
    }
}
?>

<?php include("./partials/footer.php") ?>