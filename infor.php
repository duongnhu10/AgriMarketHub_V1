<?php
include('partials-font/menu.php');
ob_start();

$session_user = ""; // Khởi tạo biến session_user

if (isset($_GET['session_user'])) {
    $session_user = $_GET['session_user']; // Lấy giá trị session_user từ URL nếu tồn tại
}
?>

<!-- Bắt đầu thông tin người dùng -->
<div class="food-menu">

    <div class="container">

        <h1>THÔNG TIN NGƯỜI DÙNG</h1>
        <br><br><br>

        <!-- Kiểm tra, hiển thị, hủy bỏ các phiên -->
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

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }

        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        ?>
        <br>

        <table class="tbl-full">
            <tr>
                <th>Ảnh đại diện</th>
                <th>Họ và tên</th>
                <th>Tên người dùng</th>
                <th>Doanh nghiệp</th>
                <th>Tên doanh nghiệp</th>
                <th>Mã số thuế</th>
                <th>Giới tính</th>
                <th>Hành động</th>
            </tr>

            <?php
            //SQL để lấy tìm người dùng đăng nhập
            $sql = "SELECT * FROM khach_hang WHERE ten_nguoi_dung = '$session_user'";

            //Chạy SQL
            $res = mysqli_query($conn, $sql);

            //Đếm số dòng
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //Có người dùng và lấy thông tin
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $ho_va_ten = $row['ho_va_ten'];
                    $ten_nguoi_dung = $row['ten_nguoi_dung'];
                    $gioi_tinh = $row['gioi_tinh'];
                    $doanh_nghiep = $row['doanh_nghiep'];
                    $ten_doanh_nghiep = $row['ten_doanh_nghiep'];
                    $ma_so_thue = $row['ma_so_thue'];
                    $anh = $row['anh'];
            ?>
                    <tr>
                        <td>
                            <?php
                            //Kiểm tra ảnh đại diện
                            if ($anh == "") {
                                //Không có ảnh hiển thị thông báo
                                echo "<div class='error'>Hình ảnh không được thêm.</div>";
                            } else {
                                //Có hình ảnh, hiển thị ảnh
                            ?>
                                <img src="<?php echo SITEURL; ?>images/avatar/<?php echo $anh; ?>" width="150px;">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $ho_va_ten; ?></td>
                        <td><?php echo $ten_nguoi_dung; ?></td>

                        <td><?php if ($doanh_nghiep == 1)
                                echo "Có";
                            else echo "Không";  ?>
                        </td>

                        <td><?php echo $ten_doanh_nghiep; ?></td>
                        <td><?php echo $ma_so_thue; ?></td>

                        <td><?php
                            if ($gioi_tinh == 1)
                                echo "Nữ";
                            else echo "Nam"; ?>
                        </td>

                        <td>
                            <a href="<?php echo SITEURL; ?>update-infor.php?session_user=<?php echo $_SESSION['user']; ?>" class="btn-secondary">Cập nhật thông tin</a>
                            <a href="<?php echo SITEURL; ?>delete-acc.php?session_user=<?php echo $_SESSION['user']; ?>" class="btn-primary">Xóa tài khoản</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                //Không có người dùng
                echo "<tr><td colspan='7' class='error'>Người dùng không tồn tại.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<!-- Kết thúc thông tin cá nhân -->

<?php
include('partials-font/footer.php');
ob_end_flush();
?>