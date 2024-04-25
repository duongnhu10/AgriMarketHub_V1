<?php include('partials/menu.php') ?>

<!-- Bắt đầu nội dung chính -->
<div class="main-content">

    <div class="wrapper">

        <h1>DANH MỤC NGƯỜI DÙNG</h1>
        <br><br>

        <?php
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        ?>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Tên người dùng</th>
                <th>Doanh nghiệp</th>
                <th>Giới tính</th>
                <th>Hành động</th>
            </tr>

            <?php
            //Lấy thông tin tất cả người dùng
            $sql = "SELECT * FROM khach_hang";
            //Chạy SQL
            $res = mysqli_query($conn, $sql);

            //Kiểm tra câu lệnh chạy thành công hay không
            if ($res == TRUE) {
                //Đếm dòng xem có dữ liệu không
                $count = mysqli_num_rows($res);

                $sn = 1; //Tạo STT

                //Kiểm tra số dòng
                if ($count > 0) {
                    //Có dữ liệu
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //Dùng vòng lặp để lấy dữ liệu

                        //Lấy dữ liệu
                        $id = $rows['id'];
                        $ho_va_ten = $rows['ho_va_ten'];
                        $ten_nguoi_dung = $rows['ten_nguoi_dung'];
                        $gioi_tinh = $rows['gioi_tinh'];
                        $doanh_nghiep = $rows['doanh_nghiep'];

                        //Hiển thị giá trị trong bảng
            ?>
                        <tr>
                            <td><?php echo  $sn++; ?></td>
                            <td><?php echo  $ho_va_ten; ?></td>
                            <td><?php echo  $ten_nguoi_dung; ?></td>

                            <td>
                                <?php
                                if ($doanh_nghiep == 1)
                                    echo "Có";
                                else
                                    echo "Không"; ?>
                            </td>

                            <td>
                                <?php
                                if ($gioi_tinh == 1)
                                    echo "Nữ";
                                else echo "Nam";
                                ?>
                            </td>

                            <td>
                                <a href="<?php echo SITEURL; ?>admin/delete-user.php?id=<?php echo $id; ?>" class="btn-danger">Xóa người dùng</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    //Không có dữ liệu
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- Kết thúc nội dung chính -->

<?php include('partials/footer.php') ?>