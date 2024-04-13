<?php
include('partials-font/menu.php');
ob_start();

$session_user = ""; // Khởi tạo biến session_user

if (isset($_GET['session_user'])) {
    $session_user = $_GET['session_user']; // Lấy giá trị session_user từ URL nếu tồn tại
}
?>


<!-- Main Content Section Starts -->
<div class="food-menu">

    <div class="container">

        <h1>THÔNG TIN NGƯỜI DÙNG</h1>
        <br><br><br>
        <?php if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['remove-failed'])) {
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
        }

        if (isset($_SESSION['no-user-found'])) {
            echo $_SESSION['no-user-found'];
            unset($_SESSION['no-user-found']);
        }

        ?>
        <br>
        <table class="tbl-full">
            <tr>
                <th>Ảnh đại diện</th>
                <th>Họ và tên</th>
                <th>Tên người dùng</th>
                <th>Doanh nghiệp</th>
                <th>Giới tính</th>
                <th>Hành động</th>
            </tr>

            <?php
            //Create a SQL Query to Get all the products
            $sql = "SELECT * FROM khach_hang WHERE ten_nguoi_dung = '$session_user'";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Count Rows to check whether we have products or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //We have user in Database
                //Get the products from Database and display
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $ho_va_ten = $row['ho_va_ten'];
                    $ten_nguoi_dung = $row['ten_nguoi_dung'];
                    $gioi_tinh = $row['gioi_tinh'];
                    $doanh_nghiep = $row['doanh_nghiep'];
                    $anh = $row['anh'];
            ?>

                    <tr>
                        <td>
                            <?php
                            //Check whether we have image or not
                            if ($anh == "") {
                                //We don not have image, Display Error Message
                                echo "<div class='error'>Hình ảnh không được thêm.</div>";
                            } else {
                                //We have Image, Display Image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/avatar/<?php echo $anh; ?>" width="150px;">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $ho_va_ten; ?></td>
                        <td><?php echo $ten_nguoi_dung; ?></td>

                        <td><?php if ($gioi_tinh == 1)
                                echo "Có";
                            else echo "Không";  ?></td>

                        <td><?php
                            if ($gioi_tinh == 1)
                                echo "Nữ";
                            else echo "Nam"; ?></td>

                        <td>
                            <a href="<?php echo SITEURL; ?>update-infor.php?session_user=<?php echo $_SESSION['user']; ?>" class="btn-secondary">Cập nhật thông tin</a>
                            <a href="" class="btn-primary">Xóa tài khoản</a>
                        </td>
                    </tr>

            <?php
                }
            } else {
                //User not in Database
                echo "<tr><td colspan='7' class='error'>Người dùng không tồn tại.</td></tr>";
            }

            ?>

        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials-font/footer.php');
ob_end_flush(); ?>