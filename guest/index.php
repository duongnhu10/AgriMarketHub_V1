<?php include('partials/menu.php'); ?>

<!-- Bắt đầu Session tìm kiếm sản phẩm -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL ?>guest/agricultural-search.php" method="POST">
            <input type="search" name="search" placeholder="Tìm kiếm sản phẩm.." required>
            <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- Kết thúc Session tìm kiếm sản phẩm -->

<?php
// Kiểm tra có tồn tại Session 'delete' không 
if (isset($_SESSION['delete'])) {
    //Hiển thị thông tin Session
    echo $_SESSION['delete'];
    //Hủy bỏ Session
    unset($_SESSION['delete']);
}
?>

<!-- Bắt đầu Session loại sản phẩm -->
<section class="categories">
    <div class="container">

        <h2 class="text-center">LOẠI SẢN PHẨM</h2>

        <?php
        //SQL lấy loại sản phẩm ở trạng thái 'Còn hàng'
        $sql = "SELECT * FROM loai_san_pham WHERE trang_thai = 'Còn hàng' LIMIT 3";

        //Chạy SQL
        $res = mysqli_query($conn, $sql);

        //Đếm số loại sản phẩm
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //Tồn tại loại sản phẩm
            while ($row = mysqli_fetch_assoc($res)) {
                //Lấy các giá trị
                $id = $row['id'];
                $ten_loai = $row['ten_loai'];
                $anh = $row['anh'];
        ?>
                <!-- Chuyển hướng đến trang sản phẩm theo loại -->
                <a href="<?php echo SITEURL; ?>guest/category-agricultural.php?loai_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //Kiểm tra hình ảnh
                        if ($anh == "") {
                            //Không có hình ảnh
                            echo "<div class='error'>Hình ảnh không tìm thấy.</div>";
                        } else {
                            //Có hình ảnh
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

<!-- Bắt đầu Session sản phẩm -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">SẢN PHẨM</h2>

        <?php
        //SQL lấy sản phẩm từ Database ở trạng thái còn hàng
        $sql2 = "SELECT * FROM san_pham WHERE trang_thai = 'Còn hàng' LIMIT 6";

        //Chạy SQL
        $res2 = mysqli_query($conn, $sql2);

        //Đếm số dòng
        $count2 = mysqli_num_rows($res2);

        //Kiểm tra có tồn tại sản phấm không
        if ($count2 > 0) {
            //Tồn tại sản phẩm
            while ($row = mysqli_fetch_assoc($res2)) {
                //Lấy các giá trị
                $id = $row['id'];
                $ten_san_pham = $row['ten_san_pham'];
                $gia = $row['gia'];
                $gia_khuyen_mai = $row['gia_khuyen_mai'];
                $mo_ta = $row['mo_ta'];
                $anh = $row['anh'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //Kiểm tra hình ảnh
                        if ($anh == "") {
                            //Không có hình ảnh
                            echo "<div class='error'>Không có hình ảnh.</div>";
                        } else {
                            //Tồn tại hình ảnh
                        ?>
                            <img height="130px" src="<?php echo SITEURL; ?>images/agricultural/<?php echo $anh; ?>" alt="" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <!-- Hiển thị tên sản phẩm -->
                        <h4><?php echo $ten_san_pham; ?></h4>
                        <p class="food-price">
                            <?php
                            //SQL lấy giá khuyến mãi
                            $sql_km = "SELECT * FROM khuyen_mai WHERE sanpham_id = $id ORDER BY ngay_batdau DESC LIMIT 1";
                            //Chạy SQL
                            $res_km = mysqli_query($conn, $sql_km);

                            //Kiểm tra kết nối
                            if ($res_km) {
                                if (mysqli_num_rows($res_km) > 0) {
                                    $row_km = mysqli_fetch_assoc($res_km);
                                    //Lấy các giá trị
                                    $ngay_bat_dau = $row_km['ngay_batdau'];
                                    $ngay_ket_thuc = $row_km['ngay_ketthuc'];
                                } else {
                                    //Không có dữ liệu từ truy vấn
                                    $ngay_bat_dau = "0000-00-00";
                                    $ngay_ket_thuc = "0000-00-00";
                                }
                            } else {
                                //Lỗi khi thực hiện truy vấn
                                $ngay_bat_dau = "0000-00-00";
                                $ngay_ket_thuc = "0000-00-00";
                            }

                            //Kiểm tra giá khuyến mãi có tồn tại hay không
                            if ($gia_khuyen_mai != 0) {
                                //Hiển thị giá khuyến mãi và giá gốc
                                echo "<i style='text-decoration-line: line-through;'>" . str_replace(',', ' ', number_format($gia)) . " VND/Kg <br></i>";
                                $gia_km = $gia - $gia_khuyen_mai * 0.01 * $gia;
                                echo "<i class='red'>" . str_replace(',', ' ', number_format($gia_km)) . " VND/Kg<br></i>";
                                echo "<i><b> Từ ngày: " . $ngay_bat_dau . " đến " . $ngay_ket_thuc . "</b></i>";
                            } else {
                                //Hiển thị giá gốc
                                echo "<i>" . str_replace(',', ' ', number_format($gia)) . " VND/Kg <br></i>";
                            }
                            ?>
                        </p>

                        <!-- Hiển thị mô tả sản phẩm -->
                        <p class="food-detail">
                            <?php echo $mo_ta; ?>
                        </p>
                        <br>

                        <!-- Nút đặt hàng chuyển hướng đến trang đăng ký tài khoản -->
                        <a href="<?php echo SITEURL; ?>guest/sign-up.php?>" class="btn btn-primary">Đặt hàng</a>

                        <!-- Nút thêm vào giỏ hàng chuyển đến trang đăng ký tài khoản -->
                        <a href="<?php echo SITEURL; ?>guest/sign-up.php?>" class="btn btn-primary">Thêm vào giỏ hàng</a>
                    </div>
                </div>
        <?php
            }
        } else {
            //Không có sản phẩm
            echo "<div class='error'>Không có sản phẩm.</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>

    <!-- Chuyển hướng xem tất cả sản phẩm -->
    <p class="text-center">
        <a href="<?php echo SITEURL; ?>guest/agricultural.php">Xem thêm sản phẩm.</a>
    </p>
</section>
<!-- Kết thúc Session sản phẩm-->

<?php include('partials/footer.php'); ?>