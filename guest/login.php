<?php include('../config/constants.php') ?>

<html>

<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center" style="font-size: 26px; margin: 5px;">ĐĂNG NHẬP</h1>
        <br><br>

        <!-- Kiểm tra sự tồn tại của các phiên, hiển thị và hủy bỏ phiên -->
        <?php
        if (isset($_SESSION['Login'])) {
            echo $_SESSION['Login'];
            unset($_SESSION['Login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br><br>

        <!-- Bắt đầu form đăng nhập -->
        <form action="" method="POST" class="text-center">
            <div class="text-login">TÊN NGƯỜI DÙNG</div>
            <br>
            <input class="text" type="text" name="ten_nguoi_dung" placeholder="Nhập tên người dùng của bạn.">
            <br><br>

            <div class="text-login">MẬT KHẨU</div>
            <br>
            <input class="password" type="password" name="mat_khau" placeholder="Nhập mật khẩu của bạn.">
            <br><br>

            <input type="submit" name="submit" value="Đăng nhập" class="btn-primary submit">
            <br><br>

            <p type="text" name="dang_ky">Nếu bạn chưa có tài khoản <a href="<?php echo SITEURL . 'guest/sign-up.php' ?>">Đăng Ký</a></p>
            <br>
        </form>
        <!-- Kết thúc form đăng ký -->

        <p class="text-center create-by">Tạo bởi CT299-06</p>
    </div>
</body>

</html>

<?php
//Kiểm tra xem nút Submit có được nhấn hay không
if (isset($_POST["submit"])) {
    //Quá trình đăng nhập
    //1. Lấy dữ liệu từ form
    //$ten_nguoi_dung = $_POST['ten_nguoi_dung'];
    //$mat_khau = md5($_POST['mat_khau']);
    $ten_nguoi_dung = mysqli_real_escape_string($conn, $_POST['ten_nguoi_dung']); //SQL injecttion

    $raw_mat_khau = md5($_POST['mat_khau']);
    $mat_khau = mysqli_real_escape_string($conn, $raw_mat_khau);  //SQL injecttion

    //2. SQL kiểm tra xem tên người dùng của khách hàng và mật khẩu có hợp lệ hay không
    $sql = "SELECT * FROM khach_hang WHERE ten_nguoi_dung='$ten_nguoi_dung' AND mat_khau='$mat_khau'";

    //3.Chạy SQL
    $res = mysqli_query($conn, $sql);

    //4. Đếm số dòng để kiểm tra user có tồn tại hay không
    $count = mysqli_num_rows($res);

    $loggedIn = false; // Khởi tạo biến kiểm tra đăng nhập

    if ($count == 1) {
        //Tồn tại người dùng và đăng nhập thành công
        $_SESSION['Login'] = "<div class='success'>Đăng nhập thành công.</div>";

        $_SESSION['user'] = $ten_nguoi_dung; //Thiết lập để xác nhận người dùng đã đăng nhập
        $loggedIn = true; // Đặt biến đăng nhập thành true

        //Chuyển hướng đến trang chủ người tiêu dùng
        header('Location: ' . SITEURL . '?session_user=' . $_SESSION['user']);
    } else {
        //Không tồn tại người dùng và đăng nhập thất bại
        $_SESSION['Login']  =  "<div class='error text-center'>Tên người dùng hoặc mật khẩu không đúng.</div>";
        header('location:' . SITEURL . 'guest/login.php');
    }

    //Kiểm tra đăng nhập của Admin
    if (!$loggedIn) {
        //1. SQL kiểm tra tên người dùng và mật khẩu của Admin có tồn tại hay không
        $sql1 = "SELECT * FROM admin WHERE ten_nguoi_dung='$ten_nguoi_dung' AND mat_khau='$mat_khau'";

        //2. Chạy SQL
        $res1 = mysqli_query($conn, $sql1);

        //4. Đếm số dòng để kiểm tra user có tồn tại hay không
        $count1 = mysqli_num_rows($res1);

        if ($count1 == 1) {
            //Tồn tại tài khoản và đăng nhập thành công
            $_SESSION['Login'] = "<div class='success'>Đăng nhập thành công.</div>";

            $_SESSION['user'] = $ten_nguoi_dung; //Thiết lập để xác nhận đăng nhập thành công

            //Chuyển hướng đến trang chủ Admin
            header('location: ' . SITEURL . 'admin/');
        } else {
            //Không tồn tại người dùng và thông báo đăng nhập thất bại
            $_SESSION['Login']  =  "<div class='error text-center'>Tên người dùng hoặc mật khẩu không đúng.</div>";
            header('location:' . SITEURL . 'guest/login.php');
        }
    }
}
?>