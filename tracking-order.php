<?php include('partials-font/menu.php'); ?>


<section class="food-menu">
    <div class="container">

        <h2 class="text-center">THÔNG TIN ĐƠN HÀNG</h2>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Tên khách hàng</th>
                    <th>SDT</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                </tr>
            </thead>
            <tbody>
                <!-- Đoạn mã PHP để hiển thị dữ liệu từ cơ sở dữ liệu vào bảng -->
                <?php
                $sn = 1;
                $sql = "SELECT * FROM don_hang ORDER BY id DESC";  //Lấy thông tin
                $res = mysqli_query($conn, $sql); //Kết nối
                $count = mysqli_num_rows($res); //Đếm số dòng
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        echo "<td>" . $sn++ . "</td>";
                        echo "<td>" . $row['san_pham'] . "</td>";
                        echo "<td>" . $row['gia'] . "</td>";
                        echo "<td>" . $row['so_luong'] . "</td>";
                        echo "<td>" . $row['tong_tien'] . "</td>";
                        echo "<td>" . $row['ngay_dat'] . "</td>";
                        if ($row['trang_thai']  == "Chờ xác nhận") {
                            echo "<td>" . $row['trang_thai'] . "</td>";
                        } else if ($row['trang_thai']  == "Đang giao hàng") {
                            echo "<td style='color:orange;'>" . $row['trang_thai'] . "</td>";
                        } else if ($row['trang_thai'] == "Đã giao hàng") {
                            echo "<td style='color:green;'>" . $row['trang_thai'] . "</td>";
                        } else if ($row['trang_thai'] == "Đã hủy") {
                            echo "<td style='color:red;'>" . $row['trang_thai'] . "</td>";
                        }
                        echo "<td>" . $row['khach_ten'] . "</td>";
                        echo "<td>" . $row['khach_sdt'] . "</td>";
                        echo "<td>" . $row['khach_email'] . "</td>";
                        echo "<td>" . $row['khach_diachi'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<div class='error'>Không có đơn hàng.</div>";
                }

                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include('partials-font/footer.php'); ?>