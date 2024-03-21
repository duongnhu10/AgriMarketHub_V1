<?php include('../config/constants.php') ?>
<html>

<head>
    <title>Login Agricultural - System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">LOGIN</h1>
        <br><br>
        <!-- Login form starts here -->
        <form action="" method="POST" class="text-center">
            <div class="text-login">USERNAME</div>
            <br>
            <input type="text" name="username" placeholder="Enter your username.">
            <br><br>
            <div class="text-login">PASSWORD</div>
            <br>
            <input type="password" name="password" placeholder="Enter your password.">
            <br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
        <!-- Login form ends here -->

        <p class="text-center create-by">Create By Nhu</p>
    </div>
</body>

</html>

<?php
//Check whether the submit button is clicked or not
if (isset($_POST["submit"])) {
    //Process for Login
    //1. Get the Data form Login form
    $username = $_POST["username"];
    $password = $_POST["password"];

    //2. SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3.Execute the query
    $res = mysqli_query($conn, $sql);

    //4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //User available and login successfully
        $_SESSION['Login'] = "<div class='success'>Login Successfully.<div/>";
        //Redirest to home page
        header('location' . SITEURL . 'admin/index.php');
    } else {
        //User not available and login fail
        $_SESSION['Login']  =  "<div class='error'>User or password did not match.<div/>";
        header('location' . SITEURL . 'admin/login.php');
    }
}

?>