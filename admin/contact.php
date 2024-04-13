<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="main-content">

    <div class="wrapper">

        <h1>DANH MỤC PHẢN HỒI</h1>

        <br><br>

        <?php

        if (isset($_SESSION['xoa_lienhe'])) {
            echo $_SESSION['xoa_lienhe'];  //Displaying session message
            unset($_SESSION['xoa_lienhe']); //Removing session message
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

            //Get all the orders from database
            $sql = "SELECT * FROM lien_he ORDER BY id DESC"; //DIsplay the lastest Order at First
            //Execute Query
            $res = mysqli_query($conn, $sql);
            //Count the rows
            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                //Order Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get all the order details
                    $id = $row['id'];
                    $noi_dung = $row['noi_dung'];
                    $ngay = $row['ngay'];
                    // $trang_thai = $row['trang_thai'];
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
                //Order not available
                echo "<tr><td colspan='12' class='error'>Không có phản hồi.</td></tr>
                ";
            }
            ?>
        </table>

    </div>
</div>

<?php include('partials/footer.php') ?>