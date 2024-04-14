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

        <!-- Login form starts here -->
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
        <!-- Login form ends here -->

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
    $ten_nguoi_dung = mysqli_real_escape_string($conn, $_POST['ten_nguoi_dung']); //SQL injecttion

    $raw_mat_khau = md5($_POST['mat_khau']);
    $mat_khau = mysqli_real_escape_string($conn, $raw_mat_khau);  //SQL injecttion

    //2. SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM khach_hang WHERE ten_nguoi_dung='$ten_nguoi_dung' AND mat_khau='$mat_khau'";

    //3.Execute the query
    $res = mysqli_query($conn, $sql);

    //4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    $loggedIn = false; // Khởi tạo biến kiểm tra đăng nhập

    if ($count == 1) {
        //User available and login successfully
        $_SESSION['Login'] = "<div class='success'>Đăng nhập thành công.</div>";

        $_SESSION['user'] = $ten_nguoi_dung; //To check whether the user is logged or not and logout will unset it
        $loggedIn = true; // Đặt biến đăng nhập thành true

        //Redirect to home page
        header('Location: ' . SITEURL . '?session_user=' . $_SESSION['user']);
    } else {
        //User not available and login fail
        $_SESSION['Login']  =  "<div class='error text-center'>Tên người dùng hoặc mật khẩu không đúng.</div>";
        header('location:' . SITEURL . 'guest/login.php');
    }

    if (!$loggedIn) {


        //2. SQL to check whether the user with username and password exists or not
        $sql1 = "SELECT * FROM admin WHERE ten_nguoi_dung='$ten_nguoi_dung' AND mat_khau='$mat_khau'";

        //3.Execute the query
        $res1 = mysqli_query($conn, $sql1);

        //4. Count rows to check whether the user exists or not
        $count1 = mysqli_num_rows($res1);

        if ($count1 == 1) {
            //User available and login successfully
            $_SESSION['Login'] = "<div class='success'>Đăng nhập thành công.</div>";

            $_SESSION['user'] = $ten_nguoi_dung; //To check whether the user is logged or not and logout will unset it

            //Redirect to home page
            header('location: ' . SITEURL . 'admin/');
        } else {
            //User not available and login fail
            $_SESSION['Login']  =  "<div class='error text-center'>Tên người dùng hoặc mật khẩu không đúng.</div>";
            header('location:' . SITEURL . 'guest/login.php');
        }
    }
}

?>