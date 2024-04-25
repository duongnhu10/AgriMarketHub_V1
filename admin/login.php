<?php include('../config/constants.php') ?>
<html>

<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center" style="font-size: 26px; margin: 5px;">ĐĂNG NHẬP QUẢN TRỊ</h1>
        <br><br>

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
        </form>
        <!-- Kết thúc form đăng nhập -->

        <p class="text-center create-by">Tạo bởi CT299-06</p>
    </div>
</body>

</html>

<?php
//Kiểm tra có nhấn nút đăng nhập hay không
if (isset($_POST["submit"])) {
    //Quá trình đăng nhập
    //1. Lấy dữ liệu từ form
    //$ten_nguoi_dung = $_POST['ten_nguoi_dung'];
    //$mat_khau = md5($_POST['mat_khau']);
    $ten_nguoi_dung = mysqli_real_escape_string($conn, $_POST['ten_nguoi_dung']); //SQL injecttion

    $raw_mat_khau = md5($_POST['mat_khau']);
    $mat_khau = mysqli_real_escape_string($conn, $raw_mat_khau);  //SQL injecttion

    //2. SQL kiểm tra tên người dùng và mật khẩu đúng không
    $sql = "SELECT * FROM admin WHERE ten_nguoi_dung='$ten_nguoi_dung' AND mat_khau='$mat_khau'";

    //3. Chạy câu lệnh
    $res = mysqli_query($conn, $sql);

    //4. Đếm số dòng để kiểm tra người dùng có tồn tại hay không
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //Người dùng tồn tại và đăng nhập thành công
        $_SESSION['Login'] = "<div class='success'>Đăng nhập thành công.</div>";

        $_SESSION['user'] = $ten_nguoi_dung; //Thiết lập phiên xác nhận đã đăng nhập

        //Chuyển hướng đến trang chủ admin
        header('location: ' . SITEURL . 'admin/');
    } else {
        //Không tồn tại người dùng và đăng nhập thất bại
        $_SESSION['Login']  =  "<div class='error text-center'>Tên người dùng hoặc mật khẩu không đúng.</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>