<?php include('partials/menu.php') ?>

<!-- Bắt đầu nội dung chính -->
<div class="main-content">

    <div class="wrapper">

        <h1>DANH MỤC ĐƠN HÀNG</h1>
        <br><br>

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <br><br>

        <table class="tbl-full">
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Giá/Kg</th>
                <th>Số lượng/Kg</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Tên khách hàng</th>
                <th>SDT</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Hành động</th>
            </tr>

            <?php
            //Lấy tất cả các đơn hàng từ database
            $sql = "SELECT * FROM don_hang ORDER BY id DESC"; //Hiển thị đơn hàng gần nhất
            //Chạy SQL
            $res = mysqli_query($conn, $sql);
            //Đếm số dòng
            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                //Tồn tại đơn hàng
                while ($row = mysqli_fetch_assoc($res)) {
                    //Lấy thông tin chi tiết đơn hàng
                    $id = $row['id'];
                    $san_pham = $row['san_pham'];
                    $gia = $row['gia'];
                    $so_luong = $row['so_luong'];
                    $tong_tien = $row['tong_tien'];
                    $ngay_dat = $row['ngay_dat'];
                    $trang_thai = $row['trang_thai'];
                    $khach_ten = $row['khach_ten'];
                    $khach_sdt = $row['khach_sdt'];
                    $khach_email = $row['khach_email'];
                    $khach_diachi = $row['khach_diachi'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $san_pham; ?></td>
                        <td><?php echo str_replace(',', ' ', number_format($gia)); ?> VND</td>
                        <td><?php echo $so_luong; ?></td>
                        <td><?php echo str_replace(',', ' ', number_format($tong_tien)); ?> VND</td>
                        <td><?php echo $ngay_dat; ?></td>

                        <td>
                            <?php
                            if ($trang_thai == "Chờ xác nhận") {
                                echo "<lable>$trang_thai</lable>";
                            } else if ($trang_thai == "Đang giao hàng") {
                                echo "<lable style='color:orange;'>$trang_thai</lable>";
                            } else if ($trang_thai == "Đã giao hàng") {
                                echo "<lable style='color:green;'>$trang_thai</lable>";
                            } else if ($trang_thai == "Đã hủy") {
                                echo "<lable style='color:red;'>$trang_thai</lable>";
                            }
                            ?>
                        </td>

                        <td><?php echo $khach_ten; ?></td>
                        <td><?php echo $khach_sdt; ?></td>
                        <td><?php echo $khach_email; ?></td>
                        <td><?php echo $khach_diachi; ?></td>

                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật đơn hàng</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                //Không có đơn hàng
                echo "<tr><td colspan='12' class='error'>Không có đơn hàng.</td></tr>
                ";
            }
            ?>
        </table>
    </div>

    <br><br>

    <div class="wrapper">

        <h1>DANH MỤC ĐƠN HÀNG KHÁCH HÀNG HỦY</h1>
        <br><br>

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <br><br>

        <table class="tbl-full">
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Giá/Kg</th>
                <th>Số lượng/kg</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt</th>
                <th>Tên khách hàng</th>
                <th>SDT</th>
                <th>Email</th>
                <th>Địa chỉ</th>
            </tr>

            <?php
            //Lấy đơn hàng hủy từ bảng đơn hủy
            $sql = "SELECT * FROM don_huy ORDER BY id DESC"; //Hiển thị đơn hàng hủy gần nhất
            //Chạy SQL
            $res = mysqli_query($conn, $sql);
            //Đếm số dòng
            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                //Tồn tại đơn hàng hủy
                while ($row = mysqli_fetch_assoc($res)) {
                    //Lấy thông tin chi tiết
                    $id = $row['id'];
                    $san_pham = $row['san_pham'];
                    $gia = $row['gia'];
                    $so_luong = $row['so_luong'];
                    $tong_tien = $row['tong_tien'];
                    $ngay_dat = $row['ngay_dat'];
                    $khach_ten = $row['khach_ten'];
                    $khach_sdt = $row['khach_sdt'];
                    $khach_email = $row['khach_email'];
                    $khach_diachi = $row['khach_diachi'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $san_pham; ?></td>
                        <td><?php echo str_replace(',', ' ', number_format($gia)); ?> VND</td>
                        <td><?php echo $so_luong; ?></td>
                        <td><?php echo str_replace(',', ' ', number_format($tong_tien)); ?> VND</td>
                        <td><?php echo $ngay_dat; ?></td>
                        <td><?php echo $khach_ten; ?></td>
                        <td><?php echo $khach_sdt; ?></td>
                        <td><?php echo $khach_email; ?></td>
                        <td><?php echo $khach_diachi; ?></td>
                    </tr>
            <?php
                }
            } else {
                //Không có đơn hàng hủy
                echo "<tr><td colspan='12' class='error'>Không có đơn hàng hủy.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<!-- Kết thúc nội dung chính -->

<?php include('partials/footer.php') ?>