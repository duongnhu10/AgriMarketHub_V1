<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>CẬP NHẬT ĐƠN HÀNG</h1>
        <br><br>

        <?php
        //Kiểm tra xem có tồn tại id được gửi đi hay không
        if (isset($_GET['id'])) {
            //Lấy chi tiết đơn hàng
            $id = $_GET['id'];

            //Lấy thông tin khác dựa vào id
            //SQL để lấy chi tiết đơn hàng
            $sql = "SELECT * FROM don_hang WHERE id=$id";
            //Chạy SQL
            $res = mysqli_query($conn, $sql);
            //Đếm số dòng
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //Có dữ liệu
                $row = mysqli_fetch_assoc($res);

                $san_pham = $row['san_pham'];
                $gia = $row['gia'];
                $so_luong = $row['so_luong'];
                $trang_thai = $row['trang_thai'];
                $khach_ten = $row['khach_ten'];
                $khach_sdt = $row['khach_sdt'];
                $khach_email = $row['khach_email'];
                $khach_diachi = $row['khach_diachi'];
            } else {
            }
        } else {
            //Chuyển hướng đến trang quản lí đơn hàng
            header('location:' . SITEURL . 'admin/manager-order.php');
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Tên sản phẩm</td>
                    <td><b><?php echo $san_pham; ?></b></td>
                </tr>

                <tr>
                    <td>Giá</td>
                    <td><b><?php echo $gia; ?>VND</b></td>
                </tr>

                <tr>
                    <td>Số lượng</td>
                    <td>
                        <input type="number" name="so_luong" value="<?php echo $so_luong; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Trạng thái</td>
                    <td>
                        <select name="trang_thai">
                            <option <?php if ($trang_thai == "Chờ xác nhận") {
                                        echo "selected";
                                    } ?> value="Chờ xác nhận">Chờ xác nhận</option>
                            <option <?php if ($trang_thai == "Đang giao hàng") {
                                        echo "selected";
                                    } ?> value="Đang giao hàng">Đang giao hàng</option>
                            <option <?php if ($trang_thai == "Đã giao hàng") {
                                        echo "selected";
                                    } ?> value="Đã giao hàng">Đã giao hàng</option>
                            <option <?php if ($trang_thai == "Đã hủy") {
                                        echo "selected";
                                    } ?> value="Đã hủy">Đã hủy</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Tên khách hàng: </td>
                    <td>
                        <input type="text" name="khach_ten" value="<?php echo $khach_ten; ?>">
                    </td>
                </tr>

                <tr>
                    <td>SDT khách hàng: </td>
                    <td>
                        <input type="text" name="khach_sdt" value="<?php echo $khach_sdt; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email khách hàng: </td>
                    <td>
                        <input type="text" name="khach_email" value="<?php echo $khach_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Địa chỉ khách hàng: </td>
                    <td>
                        <textarea type="text" name="khach_diachi" cols="30" rows="5"><?php echo $khach_diachi; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="gia" value="<?php echo $gia; ?>">

                        <input type="submit" name="submit" value="Cập nhật" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php
        //Kiểm tra nút có được nhấn hay không
        if (isset($_POST['submit'])) {
            //echo "Clicked";
            //Lấy các giá trị từ form
            $id = $_POST['id'];
            $gia = $_POST['gia'];
            $so_luong = $_POST['so_luong'];
            $tong_tien = $so_luong * $gia;
            $trang_thai = $_POST['trang_thai'];
            $khach_ten = $_POST['khach_ten'];
            $khach_sdt = $_POST['khach_sdt'];
            $khach_email = $_POST['khach_email'];
            $khach_diachi = $_POST['khach_diachi'];

            //Cập nhật giá trị
            $sql2 = "UPDATE don_hang SET
                so_luong = $so_luong,
                tong_tien = $tong_tien,
                trang_thai = '$trang_thai',
                khach_ten = '$khach_ten',
                khach_sdt = '$khach_sdt',
                khach_email = '$khach_email',
                khach_diachi = '$khach_diachi'
                WHERE id=$id;
            ";

            //Chạy SQL
            $res2 = mysqli_query($conn, $sql2);

            //Kiểm tra có được cập nhật hay không
            //Chuyển hướng đến trang quản lí đơn hàng và thông báo
            //Kiểm tra câu lệnh có chạy hay không
            if ($res2 == true) {
                //Cập nhật thành công
                $_SESSION['update'] = "<div class='success'>Cập nhật đơn hàng thành công.</div>";
                header('location:' . SITEURL . 'admin/manager-order.php');
            } else {
                //Cập nhật thất bại
                $_SESSION['update'] = "<div class='error'>Cập nhật đơn hàng thất bại.</div>";
                header('location:' . SITEURL . 'admin/manager-order.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>