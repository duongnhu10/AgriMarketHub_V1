<?php include('partials/menu.php'); ?>

<?php
//Kiểm tra có nhận được id loại sản phẩm hay không
if (isset($_GET['loai_id'])) {
    //id loại sản phẩm được thiết lập và nhận được
    $loai_id = $_GET['loai_id'];

    //Lấy tên loại sản phẩm dựa vào id loại sản phẩm
    $sql = "SELECT ten_loai FROM loai_san_pham WHERE id=$loai_id";

    //Chạy SQL
    $res = mysqli_query($conn, $sql);

    //Lấy giá trị
    $row = mysqli_fetch_assoc($res);

    //Lấy tên loại
    $ten_loai = $row['ten_loai'];
} else {
    //Không nhận được id
    //Chuyển hướng đến trang chủ
    header('location:' . SITEURL);
}
?>

<!-- Bắt đầu Session hiển thị loại sản phẩm tìm kiếm -->
<section class="food-search text-center">
    <div class="container">

        <!-- Hiển thị theo tên loại sản phẩm -->
        <h2>Danh mục <a href="#" class="text-white">"<?php echo $ten_loai; ?>"</a></h2>

    </div>
</section>
<!-- Kết thúc Session hiển thị loại sản phẩm tìm kiếm -->

<!-- Bắt đầu hiển thị sản phẩm theo từ khóa -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">SẢN PHẨM</h2>

        <?php
        //SQL lấy sản phẩm theo loại
        $sql2 = "SELECT * FROM san_pham WHERE loai_id = $loai_id";

        //Chạy SQL
        $res2 = mysqli_query($conn, $sql2);

        //Đếm số dòng
        $count2 = mysqli_num_rows($res2);

        //Kiểm tra sản phẩm
        if ($count2 > 0) {
            //Tồn tại
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $ten_san_pham = $row2['ten_san_pham'];
                $gia = $row2['gia'];
                $gia_khuyen_mai = $row2['gia_khuyen_mai'];
                $mo_ta = $row2['mo_ta'];
                $anh = $row2['anh'];
        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //Kiểm tra hình ảnh
                        if ($anh == "") {
                            //Tồn tại
                            echo "<div class='error'>Không có hình ảnh.</div>";
                        } else {
                            //Không có tồn tại
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
                            //Lấy giá khuyến mãi của sản phẩm
                            $sql_km = "SELECT * FROM khuyen_mai WHERE sanpham_id = $id ORDER BY ngay_batdau DESC LIMIT 1";

                            //Chạy SQL
                            $res_km = mysqli_query($conn, $sql_km);

                            // Kiểm tra kết nôi
                            if ($res_km) {
                                if (mysqli_num_rows($res_km) > 0) {
                                    //Có giá khuyến mãi
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

                            //Hiển thị giá khuyến mãi
                            if ($gia_khuyen_mai != 0) {
                                //Tồn tại khuyến mãi
                                echo "<i style='text-decoration-line: line-through;'>" . str_replace(',', ' ', number_format($gia)) . " VND/Kg <br></i>";
                                $gia_km = $gia - $gia_khuyen_mai * 0.01 * $gia;
                                echo "<i class='red'>" . str_replace(',', ' ', number_format($gia_km)) . " VND/Kg<br></i>";
                                echo "<i><b> Từ ngày: " . $ngay_bat_dau . " đến " . $ngay_ket_thuc . "</b></i>";
                            } else {
                                //Không có khuyến mãi
                                echo "<i>" . str_replace(',', ' ', number_format($gia)) . " VND/Kg <br></i>";
                            }
                            ?>
                        </p>

                        <!-- Mô tả sản phẩm -->
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
            //Không tìm thấy sản phẩm
            echo "<div class='error'>Không có sản phẩm.</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- Kết thúc Session hiển thị sản phẩm theo từ khóa -->

<?php include('partials/footer.php'); ?>