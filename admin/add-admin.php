<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>THÊM QUẢN TRỊ VIÊN</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) { //Kiểm tra phiên được đặt hay không
            echo $_SESSION['add']; //Hiển thị thông báo
            unset($_SESSION['add']); //Hủy bỏ phiên
        }
        ?>

        <br><br>

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
//Lấy dữ liệu từ form và lưu vào database
//Kiểm tra nút submit được nhấn hay không
if (isset($_POST['submit'])) {
    // Nút được nhấn
    // echo "Button Clicked";

    //1. Lấy dữ liệu từ form
    $ho_va_ten = $_POST['ho_va_ten'];
    $ten_nguoi_dung = $_POST['ten_nguoi_dung'];
    $mat_khau = md5($_POST['mat_khau']); //Mật khẩu sang mã md5

    //2. SQL để lưu vào database
    $sql = "INSERT INTO admin SET 
            ho_va_ten = '$ho_va_ten',
            ten_nguoi_dung = '$ten_nguoi_dung',
            mat_khau = '$mat_khau'
    ";

    //3. Chạy SQL
    $res = mysqli_query($conn, $sql);

    //4. Kiểm tra chạy thành công hay không
    if ($res == TRUE) {
        //Chèn dữ liệu
        //echo "Data Inserted";
        //Tạo biến phiên để thông báo
        $_SESSION['add'] = "<div class='success'>Thêm quản trị viên thành công.</div>";
        //Chuyển hướng đến trang quản trị viên
        header("location:" . SITEURL . "admin/manager-admin.php");
    } else {
        //Chèn thất bại
        // echo "Faile to Insert Data";
        //Tạo biến phiên và hiển thị thông báo
        $_SESSION['add'] = "<div class='error'>Thêm quản trị viên thất bại.</div>";
        //Chuyển hướng đến trang thêm admin
        header("location:" . SITEURL . "admin/add-admin.php");
    }
}
?>