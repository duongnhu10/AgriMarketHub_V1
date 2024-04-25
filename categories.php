<?php include('partials-font/menu.php'); ?>

<!-- Bắt đầu loại sản phẩm-->
<section class="categories">
    <div class="container">
        <h2 class="text-center">LOẠI SẢN PHẨM</h2>

        <?php
        //SQL lấy thông tin loại sản phẩm
        $sql = "SELECT * FROM loai_san_pham WHERE trang_thai = 'Còn hàng'";
        //Chạy SQL
        $res = mysqli_query($conn, $sql);
        //Đếm số dòng
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //Tồn tại loại
            while ($row = mysqli_fetch_assoc($res)) {
                //Lấy thông tin
                $id = $row['id'];
                $ten_loai = $row['ten_loai'];
                $anh = $row['anh'];
        ?>
                <a href="<?php echo SITEURL; ?>category-agricultural.php?loai_id=<?php echo $id; ?>&session_user=<?php echo $_SESSION['user']; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //Kiểm tra hình ảnh
                        if ($anh == "") {
                            //Không có ảnh
                            echo "<div class='error'>Hình ảnh không tìm thấy.</div>";
                        } else {
                            //Tồn tại ảnh
                        ?>
                            <img height="450px" src="<?php echo SITEURL; ?>images/category/<?php echo $anh; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>

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
<!-- Kết thúc loại sản phẩm -->

<?php include('partials-font/footer.php'); ?>