<?php include('../config/constants.php') ?>

<html>

<head>
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center" style="font-size: 26px; margin: 5px;">ĐĂNG KÝ</h1>
        <br>

        <?php
        if (isset($_SESSION['trung_username'])) {
            echo ($_SESSION['trung_username']);
            unset($_SESSION['trung_username']);
        }
        ?>

        <br><br>

        <!-- Sign up form starts here -->
        <form action="" method="POST" class="text-center">
            <div class="text-login">HỌ VÀ TÊN</div>
            <input class="text" type="text" name="ho_va_ten" placeholder="Nhập họ tên của bạn.">

            <br>
            <div class="text-login">TÊN NGƯỜI DÙNG</div>

            <input class="text" type="text" name="ten_nguoi_dung" placeholder="Nhập tên người dùng của bạn.">
            <br><br>

            <div class="text-login">GIỚI TÍNH</div>
            <select name="gioi_tinh" class="text" required>
                <option value="0">Nam</option>
                <option value="1">Nữ</option>
            </select>

            <div class="text-login">DOANH NGHIỆP</div>
            <select name="doanh_nghiep" class="text" required>
                <option value="0">Không</option>
                <option value="1">Có</option>
            </select>

            <div class="text-login">TÊN DOANH NGHIỆP</div>
            <input class="text" type="text" name="ten_doanh_nghiep" placeholder="Bỏ trống nếu không phải doanh nghiệp.">
            <br><br>

            <div class="text-login">MÃ SỐ THUẾ</div>
            <input class="text" type="text" name="ma_so_thue" placeholder="Bỏ trống nếu không phải doanh nghiệp.">
            <br><br>

            <div class="text-login">MẬT KHẨU
            </div>
            <input class="password" type="password" name="mat_khau" placeholder="Nhập mật khẩu của bạn.">
            <br><br>

            <input type="submit" name="submit" value="Đăng ký" class="btn-primary submit">
            <br><br>
            <p type="text" name="dang_nhap">Nếu bạn đã có tài khoản <a href="<?php echo SITEURL . 'guest/login.php' ?>">Đăng nhập</a></p>
            <br>
        </form>
        <!--  Sign up  form ends here -->

        <p class="text-center create-by">Tạo bởi CT299-06</p>
    </div>
</body>

</html>

<?php
//Check whether the submit button is clicked or not
if (isset($_POST["submit"])) {
    //Process for Login
    //1. Get the Data form Login form
    //$ten_nguoi_dung = $_POST['ten_nguoi_dung'];
    //$mat_khau = md5($_POST['mat_khau']);
    $ho_va_ten = mysqli_real_escape_string($conn, $_POST['ho_va_ten']); //SQL injecttion
    $ten_nguoi_dung = mysqli_real_escape_string($conn, $_POST['ten_nguoi_dung']); //SQL injecttion

    // Kiểm tra xem tên người dùng đã tồn tại chưa
    $sql_check = "SELECT * FROM khach_hang WHERE ten_nguoi_dung = '$ten_nguoi_dung'";
    $res_check = mysqli_query($conn, $sql_check);
    $row = mysqli_fetch_assoc($res_check);
    if ($row) {
        $_SESSION['trung_username'] = "<div class='error text-center'>Tên người dùng đã được sử dụng.</div>";
        header('location:' . SITEURL . 'guest/sign-up.php');
    }

    $doanh_nghiep = $_POST['doanh_nghiep'];
    $ten_doanh_nghiep = $_POST['ten_doanh_nghiep'];
    $ma_so_thue = $_POST['ma_so_thue'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $raw_mat_khau = md5($_POST['mat_khau']);
    $mat_khau = mysqli_real_escape_string($conn, $raw_mat_khau);  //SQL injecttion

    //2. SQL 
    $sql_insert = "INSERT INTO khach_hang SET
            ho_va_ten = '$ho_va_ten',
            ten_nguoi_dung = '$ten_nguoi_dung',
            doanh_nghiep = $doanh_nghiep,
            ten_doanh_nghiep = '$ten_doanh_nghiep',
            ma_so_thue = '$ma_so_thue',
            gioi_tinh = $gioi_tinh,
            mat_khau = '$mat_khau'";

    //3.Execute the query
    $res_insert = mysqli_query($conn, $sql_insert);

    if ($res_insert == true) {
        // Đăng ký thành công
        echo "<script>alert('Đăng ký thành công'); window.location.href = '" . $SITEURL . "login.php';</script>";
    } else {
        // Đăng ký không thành công
        echo "<script>alert('Đăng ký không thành công'); window.location.href = '" . $SITEURL . "sign-up.php';</script>";
    }
}
?>