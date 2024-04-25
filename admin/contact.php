<?php include('partials/menu.php') ?>

<!-- Bắt đầu nội dung chính -->
<div class="main-content">

    <div class="wrapper">

        <h1>DANH MỤC PHẢN HỒI</h1>

        <br><br>

        <?php
        if (isset($_SESSION['xoa_lienhe'])) {
            echo $_SESSION['xoa_lienhe'];
            unset($_SESSION['xoa_lienhe']);
        }
        ?>

        <br><br>

        <table class="tbl-full">
            <tr>
                <th>STT</th>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>SDT</th>
                <th>Ngày liên hệ</th>
                <th>Nội dung</th>
                <th>Hành động</th>
            </tr>

            <?php
            //Lấy tất cả phản hồi từ database
            $sql = "SELECT * FROM lien_he ORDER BY id DESC"; //Hiển thị phản hồi gần nhât
            //Chạy SQL
            $res = mysqli_query($conn, $sql);
            //Đếm số dòng
            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                //Tồn tại các phản hồi
                while ($row = mysqli_fetch_assoc($res)) {
                    //Lấy chi tiết phản hồi
                    $id = $row['id'];
                    $noi_dung = $row['noi_dung'];
                    $ngay = $row['ngay'];
                    $khach_ten = $row['khach_ten'];
                    $khach_sdt = $row['khach_sdt'];
                    $khach_email = $row['khach_email'];
                    $khach_diachi = $row['khach_diachi'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $khach_ten; ?></td>
                        <td><?php echo $khach_sdt; ?></td>
                        <td><?php echo $khach_email; ?></td>
                        <td><?php echo $khach_diachi; ?></td>
                        <td><?php echo $ngay; ?></td>
                        <td><?php echo $noi_dung; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/delete-contact.php?id_lienhe=<?php echo $id; ?>" class="btn-danger">Xóa phản hồi</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                //Không có phản hồi
                echo "<tr><td colspan='12' class='error'>Không có phản hồi.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php') ?>