<?php include('partials/menu.php'); ?>

<!-- Bắt đầu Section tìm kiếm sản phẩm -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL ?>guest/agricultural-search.php" method="POST">
            <input type="search" name="search" placeholder="Tìm kiếm sản phẩm.." required>
            <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- Kết thúc Section tìm kiếm sản phẩm -->

<!-- Bắt đầu Session sản phẩm -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">SẢN PHẨM</h2>

        <?php
        //Lấy các sản phẩm ở Database ở trạng thái "Còn hàng"
        //SQL
        $sql2 = "SELECT * FROM san_pham WHERE trang_thai = 'Còn hàng'";

        //Chạy SQL
        $res2 = mysqli_query($conn, $sql2);

        //Đếm số dòng
        $count2 = mysqli_num_rows($res2);

        //Kiểm tra sản phẩm có tồn tại hay không
        if ($count2 > 0) {
            //Có sản phẩm
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
                        //Kiểm tra hình ảnh có tồn tại không
                        if ($anh == "") {
                            //Không tồn tại
                            echo "<div class='error'>Không có hình ảnh.</div>";
                        } else {
                            //Có hình ảnh
                        ?>
                            <img height="130px" src="<?php echo SITEURL; ?>images/agricultural/<?php echo $anh; ?>" alt="" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $ten_san_pham; ?></h4>
                        <p class="food-price">
                            <?php
                            //Lấy giá khuyến mãi
                            $sql_km = "SELECT * FROM khuyen_mai WHERE sanpham_id = $id ORDER BY ngay_batdau DESC LIMIT 1";

                            //Kết nối
                            $res_km = mysqli_query($conn, $sql_km);

                            if ($res_km) { //Kiểm tra kết nối
                                //Đếm số dòng
                                if (mysqli_num_rows($res_km) > 0) {
                                    //Lấy các giá trị
                                    $row_km = mysqli_fetch_assoc($res_km);
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

                            //Hiên thị giá khuyến mãi
                            if ($gia_khuyen_mai != 0) {
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

                        <!-- Hiển thị mô tả -->
                        <p class="food-detail">
                            <?php echo $mo_ta; ?>
                        </p>
                        <br>

                        <!-- Nút đặt hàng -->
                        <a href="<?php echo SITEURL; ?>guest/sign-up.php?>" class="btn btn-primary">Đặt hàng</a>

                        <!-- Nút thêm vào giỏ hàng -->
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
</section>
<!-- Kết thúc Session sản phẩm -->

<?php include('partials/footer.php'); ?>