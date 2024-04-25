<?php include('partials/menu.php'); ?>

<!-- Bắt đầu Section tìm kiếm sản phẩm -->
<section class="food-search text-center">
    <div class="container">

        <?php
        //Lấy từ khóa tìm kiếm
        //$search = $_POST['search'];
        $search = mysqli_real_escape_string($conn, $_POST['search']); //Loại trừ sql injection
        ?>

        <h2>CÁC SẢN PHẨM CHO TỪ KHÓA <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- Kết thúc Section tìm kiếm sản phẩm -->

<!-- Bắt đầu session sản phẩm -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">SẢN PHẨM</h2>

        <?php
        //SQL để lấy các sản phẩm dựa trên từ khóa tìm kiếm
        $sql = "SELECT * FROM san_pham WHERE ten_san_pham LIKE '%$search%'";

        //Chạy SQL
        $res = mysqli_query($conn, $sql);

        //Đếm số dòng
        $count = mysqli_num_rows($res);

        //Kiểm tra sản phẩm có tồn tại hay không
        if ($count > 0) {
            //Sản phẩm tồn tại
            while ($row = mysqli_fetch_assoc($res)) {
                //Lấy chi tiết sản phẩm
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
                        //Kiểm tra xem hình ảnh có tồn tại không
                        if ($anh == "") {
                            //Không có hình ảnh
                            echo "<div class='error'>Không có hình ảnh.</div>";
                        } else {
                            //Hình ảnh tồn tại
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
                            //SQL lấy giá khuyến mãi
                            $sql_km = "SELECT * FROM khuyen_mai WHERE sanpham_id = $id ORDER BY ngay_batdau DESC LIMIT 1";

                            //Chạy SQL
                            $res_km = mysqli_query($conn, $sql_km);

                            //Kiểm tra kết nối
                            if ($res_km) {
                                //Kiểm tra có tồn tại hay không
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

                            if ($gia_khuyen_mai != 0) {
                                //Hiển thị giá khuyến mãi
                                echo "<i style='text-decoration-line: line-through;'>" . str_replace(',', ' ', number_format($gia)) . " VND/Kg <br></i>";
                                //Tính giá khuyến mãi
                                $gia_km = $gia - $gia_khuyen_mai * 0.01 * $gia;
                                echo "<i class='red'>" . str_replace(',', ' ', number_format($gia_km)) . " VND/Kg<br></i>";
                                echo "<i><b> Từ ngày: " . $ngay_bat_dau . " đến " . $ngay_ket_thuc . "</b></i>";
                            } else {
                                echo "<i>" . str_replace(',', ' ', number_format($gia)) . " VND/Kg <br></i>";
                            }
                            ?>
                        </p>

                        <!-- Hiển thị mô tả sản phẩm -->
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
            echo "<div class='error'>Không tìm thấy sản phẩm.</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- Kết thúc Section sản phẩm -->

<?php include('partials/footer.php'); ?>