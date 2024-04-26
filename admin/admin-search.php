<?php include('partials/menu.php');
$search = mysqli_real_escape_string($conn, $_POST['search']); //Loại trừ sql injection
?>

<!-- Bắt đầu nội dung chính -->
<div class="main-content">

    <div class="wrapper">

        <h1>DANH MỤC QUẢN TRỊ VIÊN</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }

        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        ?>

        <br><br>

        <!-- Nút thêm admin -->
        <a href="add-admin.php" class="btn-primary">Thêm quản trị viên</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Tên người dùng</th>
                <th>Hành động</th>
            </tr>

            <?php
            //Lấy thông tin admin
            $sql = "SELECT * FROM admin WHERE ho_va_ten LIKE '%$search%'";
            //Chạy SQL
            $res = mysqli_query($conn, $sql);

            //Kiểm tra câu lệnh được chạy hay không
            if ($res == TRUE) {
                //Đếm số dòng
                $count = mysqli_num_rows($res);

                $sn = 1;

                //Kiểm tra số dòng
                if ($count > 0) {
                    //Có dữ liệu trong database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //Sử dụng vòng lặp để lấy tất cả dữ liệu từ database

                        //Lấy dữ liệu
                        $id = $rows['id'];
                        $ho_va_ten = $rows['ho_va_ten'];
                        $ten_nguoi_dung = $rows['ten_nguoi_dung'];

                        //Hiển thị giá trị trong bảng
            ?>
                        <tr>
                            <td><?php echo  $sn++; ?></td>
                            <td><?php echo  $ho_va_ten; ?></td>
                            <td><?php echo  $ten_nguoi_dung; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Đổi mật khẩu</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Xóa</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    //Không có dữ liệu trong database
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- Kết thúc nội dung chính -->

<?php include('partials/footer.php') ?>