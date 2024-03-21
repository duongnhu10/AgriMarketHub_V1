<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>THÊM QUẢN TRỊ VIÊN</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) { //Checking whether the session is Set or Not
            echo $_SESSION['add']; //Displaying session Message
            unset($_SESSION['add']); //Removing session Message
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">

                <tr>
                    <td>Họ và tên: </td>
                    <td>
                        <input type="text" name="ho_va_ten" placeholder="Nhập vào họ và tên của bạn.">
                    <td>
                </tr>

                <tr>
                    <td>Tên người dùng: </td>
                    <td>
                        <input type="text" name="ten_nguoi_dung" placeholder="Nhập vào tên người dùng của bạn.">
                    <td>
                </tr>

                <tr>
                    <td>Mật khẩu: </td>
                    <td>
                        <input type="password" name="mat_khau" placeholder="Mật khẩu của bạn.">
                    <td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" class="btn-secondary" value="Thêm">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php include('partials/footer.php') ?>

<?php
//Process the value from Form and Save it Database
//Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Button Clicked
    // echo "Button Clicked";

    //1. Get the data from Form
    $ho_va_ten = $_POST['ho_va_ten'];
    $ten_nguoi_dung = $_POST['ten_nguoi_dung'];
    $mat_khau = md5($_POST['mat_khau']); //Password Encryption with MD5

    //2. SQL Query to Save the data into database
    $sql = "INSERT INTO admin SET 
            ho_va_ten = '$ho_va_ten',
            ten_nguoi_dung = '$ten_nguoi_dung',
            mat_khau = '$mat_khau'
    ";

    //3. Executting Query and Save Data in Database
    $res = mysqli_query($conn, $sql);

    //4. Check whether the (Query is Excuted) data is inserted
    if ($res == TRUE) {
        //Data Inserted
        //echo "Data Inserted";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='success'>Thêm quản trị viên thành công.</div>";
        //Redirect Page to Manager Admin
        header("location:" . SITEURL . "admin/manager-admin.php");
    } else {
        //Failed to Insert
        // echo "Faile to Insert Data";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='error'>Thêm quản trị viên thất bại.</div>";
        //Redirect Page to Add Admin
        header("location:" . SITEURL . "admin/add-admin.php");
    }
}
?>