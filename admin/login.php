<?php include('../config/constants.php') ?>
<html>

<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">ĐĂNG NHẬP</h1>
        <br><br>

        <?php
        if (isset($_SESSION['Login'])) {
            echo $_SESSION['Login'];
            unset($_SESSION['Login']);
        }
        ?>

        <br><br>

        <!-- Login form starts here -->
        <form action="" method="POST" class="text-center">
            <div class="text-login">TÊN NGƯỜI DÙNG</div>
            <br>
            <input class="text" type="text" name="username" placeholder="Nhập tên người dùng của bạn.">
            <br><br>
            <div class="text-login">MẬT KHẨU</div>
            <br>
            <input class="password" type="password" name="password" placeholder="Nhập mật khẩu của bạn.">
            <br><br>

            <input type="submit" name="submit" value="Đăng nhập" class="btn-primary submit">
            <br><br>
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
    $ten_nguoi_dung = $_POST["ten_nguoi_dung"];
    $mat_khau = md5($_POST["mat_khau"]);

    //2. SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM admin WHERE ten_nguoi_dung='$ten_nguoi_dung' AND mat_khau='$mat_khau'";

    //3.Execute the query
    $res = mysqli_query($conn, $sql);

    //4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //User available and login successfully
        $_SESSION['Login'] = "<div class='success'>Đăng nhập thành công.<div/>";
        //Redirect to home page

        header('location: ' . SITEURL . 'admin/');

        exit;
    } else {
        //User not available and login fail
        $_SESSION['Login']  =  "<div class='error text-center'>Tên người dùng hoặc mật khẩu không đúng.<div/>";
        header('location' . SITEURL . 'admin/login.php');
    }
}

?>