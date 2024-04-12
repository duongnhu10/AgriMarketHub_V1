<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>CẬP NHẬT QUẢN TRỊ VIÊN</h1>

        <br><br>

        <?php
        //1. Get the ID of Selected Admin
        $id = $_GET['id'];

        //2. Create SQL Query to Get the Details
        $sql = "SELECT * FROM admin WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query is executed or not
        if ($res == true) {
            //Check whether the data is a avaiable or not
            $count = mysqli_num_rows($res);
            //Check whether we have admin data or not
            if ($count == 1) {
                //Get the Details
                //echo "Admin Available";
                $row = mysqli_fetch_assoc($res);

                $ho_va_ten = $row['ho_va_ten'];
                $ten_nguoi_dung = $row['ten_nguoi_dung'];
            } else {
                //Redirect to Manager Admin Page
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
//Check whether The Submit Button is clicked ot not 
if (isset($_POST['submit'])) {
    //echo "Button clicked.";
    //Get all values from Form Update
    $id = $_POST['id'];
    $ho_va_ten = $_POST['ho_va_ten'];
    $ten_nguoi_dung = $_POST['ten_nguoi_dung'];

    //Create a SQL query to Update Admin
    $sql = "UPDATE admin SET 
    ho_va_ten = '$ho_va_ten', ten_nguoi_dung = '$ten_nguoi_dung' 
    WHERE id = '$id'";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the Query executed successfully or not
    if ($res == true) {
        //Query Executed and Admin Updated
        $_SESSION['update'] = "<div class='success'>Cập nhật thành công.<div>";
        //Redirect to Manager Admin Page
        header('location:' . SITEURL . 'admin/manager-admin.php');
    } else {
        //Failed to Update Admin
        $_SESSION['update'] = "<div class='error'>Cập nhật thất bại.<div>";

        header('location:' . SITEURL . 'admin/manager-admin.php');
    }
}
?>

<?php include('partials/footer.php') ?>