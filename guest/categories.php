<?php include('partials/menu.php'); ?>

<!-- Bắt đầu Session loại sản phẩm -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">LOẠI SẢN PHẨM</h2>

        <?php
        //Câu lệnh lấy các loại sản phẩm từ Database ở trạng thái còn hàng
        $sql = "SELECT * FROM loai_san_pham WHERE trang_thai = 'Còn hàng'";

        //Chạy SQL
        $res = mysqli_query($conn, $sql);

        //Đếm số dòng
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //Tồn tại loại sản phẩm
            while ($row = mysqli_fetch_assoc($res)) {
                //Lấy các giá trị
                $id = $row['id'];
                $ten_loai = $row['ten_loai'];
                $anh = $row['anh'];
        ?>
                <!-- Chuyển hướng đến trang sản phẩm theo loại, gửi kèm id loại sản phẩm đó -->
                <a href="<?php echo SITEURL; ?>guest/category-agricultural.php?loai_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //Kiểm tra hình ảnh tồn tại không
                        if ($anh == "") {
                            //Không có hình ảnh
                            echo "<div class='error'>Hình ảnh không tìm thấy.</div>";
                        } else {
                            //Hình ảnh tồn tại
                        ?>
                            <img height="450px" src="<?php echo SITEURL; ?>images/category/<?php echo $anh; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>

                        <!-- Hiển thị tên loại -->
                        <h3 class="float-text text-white"><?php echo $ten_loai; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            //Không có loại sản phẩm
            echo "<div class='error'>Loại sản phẩm trống.</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>
</section>
<!-- Kết thúc Session loại sản phẩm -->

<?php include('partials/footer.php'); ?>