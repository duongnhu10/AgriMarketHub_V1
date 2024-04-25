<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>CẬP NHẬT QUẢN TRỊ VIÊN</h1>

        <br><br>

        <?php
        //1. Lấy id của admin được chọn
        $id = $_GET['id'];

        //2. SQL lấy chi tiết admin
        $sql = "SELECT * FROM admin WHERE id=$id";

        //Chạy SQL
        $res = mysqli_query($conn, $sql);

        //Kiểm tra câu lệnh thành công hay không
        if ($res == true) {
            //Kiểm tra dữ liệu có tồn tại hay không
            $count = mysqli_num_rows($res);
            //Kiểm tra xem có admin trong database hay không
            if ($count == 1) {
                //Lấy chi tiết
                //echo "Admin Available";
                $row = mysqli_fetch_assoc($res);

                $ho_va_ten = $row['ho_va_ten'];
                $ten_nguoi_dung = $row['ten_nguoi_dung'];
            } else {
                //Chuyển hướng đến trang quản lý admin
                header('location:' . SITEURL . 'admin/manager-admin');
            }
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Họ và tên: </td>
                    <td>
                        <input type="text" name='ho_va_ten' placeholder="Nhập họ và tên của bạn." value='<?php echo $ho_va_ten ?>'>
                    </td>
                </tr>

                <tr>
                    <td>Tên người dùng: </td>
                    <td>
                        <input type="text" name='ten_nguoi_dung' placeholder="Nhập tên người dùng của bạn." value='<?php echo $ten_nguoi_dung ?>'>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Cập nhật" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
//Kiêm tra nút có được nhấn hay không
if (isset($_POST['submit'])) {
    //echo "Button clicked.";
    //Lấy giá trị để cập nhật
    $id = $_POST['id'];
    $ho_va_ten = $_POST['ho_va_ten'];
    $ten_nguoi_dung = $_POST['ten_nguoi_dung'];

    //SQL cập nhật admin
    $sql = "UPDATE admin SET 
    ho_va_ten = '$ho_va_ten', ten_nguoi_dung = '$ten_nguoi_dung' 
    WHERE id = '$id'";

    //Chạy SQL
    $res = mysqli_query($conn, $sql);

    //Kiểm tra câu lệnh chạy thành công hay thất bại
    if ($res == true) {
        //Cập nhật thành công
        $_SESSION['update'] = "<div class='success'>Cập nhật thành công.<div>";
        //Chuyển hướng đến trang quản lý admin
        header('location:' . SITEURL . 'admin/manager-admin.php');
    } else {
        //Cập nhật thất bại
        $_SESSION['update'] = "<div class='error'>Cập nhật thất bại.<div>";
        //Chuyển hướng đến trang quản lý admin
        header('location:' . SITEURL . 'admin/manager-admin.php');
    }
}
?>

<?php include('partials/footer.php') ?>