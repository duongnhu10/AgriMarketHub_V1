<?php include('partials-font/menu.php');
ob_start();

$session_user = ""; // Khởi tạo biến session_user

$id_us = "";

if (isset($_GET['session_user'])) {
    $session_user = $_GET['session_user']; // Lấy giá trị session_user từ URL nếu tồn tại
}

//Lấy thông tin người dùng
$sql_s = "SELECT * FROM khach_hang WHERE ten_nguoi_dung='$session_user'";
$res_s = mysqli_query($conn, $sql_s);
if ($res_s == true) {
    $row_s = mysqli_fetch_assoc($res_s);
    $count_s = mysqli_num_rows($res_s);
    if ($count_s == 1) {
        //Có
        $id_us = $row_s['id'];
    } else {
        //Không
    }
}
?>

<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL ?>agricultural-search.php?session_user=<?php echo $_SESSION['user']; ?>" method="POST">
            <input type="search" name="search" placeholder="Tìm kiếm sản phẩm.." required>
            <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary">
        </form>

    </div>
</section>

<!-- Kiểm tra, hiển thị, hủy bỏ phiên -->
<?php
if (isset($_SESSION['Login'])) {
    echo $_SESSION['Login'];
    unset($_SESSION['Login']);
}

if (isset($_SESSION['dat_hang'])) {
    echo $_SESSION['dat_hang'];
    unset($_SESSION['dat_hang']);
}
?>

<!-- Bắt đầu loại sản phẩm -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">LOẠI SẢN PHẨM</h2>

        <?php
        //SQL lấy loại sản phẩm còn hàng giới hạn 3
        $sql = "SELECT * FROM loai_san_pham WHERE trang_thai = 'Còn hàng' LIMIT 3";
        //Chạy SQL
        $res = mysqli_query($conn, $sql);
        //Đếm số dòng
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //Có loại
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
                            //Không có
                            echo "<div class='error'>Hình ảnh không tìm thấy.</div>";
                        } else {
                            //Có ảnh
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
            //Không có loại
            echo "<div class='error'>Loại sản phẩm trống.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Kết thúc loại sản phẩm -->

<!-- Bắt đầu danh sách sản phẩm -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">SẢN PHẨM</h2>

        <?php
        //SQL lấy sản phấm
        $sql2 = "SELECT * FROM san_pham WHERE trang_thai = 'Còn hàng' LIMIT 6";

        //Chạy SQL
        $res2 = mysqli_query($conn, $sql2);

        //Đếm số dòng
        $count2 = mysqli_num_rows($res2);

        //Kiểm tra sản phẩm
        if ($count2 > 0) {
            //Có
            while ($row = mysqli_fetch_assoc($res2)) {
                //Lấy các giá trị
                $id = $row['id'];
                $ten_san_pham = $row['ten_san_pham'];
                $gia = $row['gia'];
                $gia_dn = $row['gia_dn'];
                $gia_khuyen_mai = $row['gia_khuyen_mai'];
                $mo_ta = $row['mo_ta'];
                $anh = $row['anh'];
                $ton_kho = $row['ton_kho'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //Kiểm tra hình ảnh
                        if ($anh == "") {
                            //Không có
                            echo "<div class='error'>Không có hình ảnh.</div>";
                        } else {
                            //Có ảnh
                        ?>
                            <img height="130px" src="<?php echo SITEURL; ?>images/agricultural/<?php echo $anh; ?>" alt="" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $ten_san_pham; ?></h4>
                        <!-- Hiển thị giá -->
                        <p class="food-price">
                            <?php
                            $sql_km = "SELECT * FROM khuyen_mai WHERE sanpham_id = $id ORDER BY ngay_batdau DESC LIMIT 1";
                            $res_km = mysqli_query($conn, $sql_km);

                            if ($res_km) {
                                if (mysqli_num_rows($res_km) > 0) {
                                    $row_km = mysqli_fetch_assoc($res_km);
                                    $ngay_bat_dau = $row_km['ngay_batdau'];
                                    $ngay_ket_thuc = $row_km['ngay_ketthuc'];
                                } else {
                                    // Không có dữ liệu từ truy vấn
                                    $ngay_bat_dau = "0000-00-00";
                                    $ngay_ket_thuc = "0000-00-00";
                                }
                            } else {
                                // Lỗi khi thực hiện truy vấn
                                $ngay_bat_dau = "0000-00-00";
                                $ngay_ket_thuc = "0000-00-00";
                            }

                            $sql_dn = "SELECT * FROM khach_hang WHERE id=$id_us";
                            $res_dn = mysqli_query($conn, $sql_dn);
                            if ($res_dn == true) {
                                //Thành công
                                $row_dn = mysqli_fetch_assoc($res_dn);
                                $doanh_nghiep = $row_dn['doanh_nghiep'];
                            } else {
                                //Kết nối thất bại
                            }

                            if ($doanh_nghiep == 1) {
                                //Hiển thị giá doanh nghiệp
                                echo "<i class='fas fa-fire blinking-icon'></i>";
                                echo "<i> " . str_replace(',', ' ', number_format($gia_dn)) . " VND/Kg <br></i>";
                            } else {
                                //Hiển thị giá người dùng không phải doanh nghiệp
                                if ($gia_khuyen_mai != 0) {
                                    echo "<i style='text-decoration-line: line-through;'>" . str_replace(',', ' ', number_format($gia)) . " VND/Kg <br></i>";
                                    $gia_km = $gia - $gia_khuyen_mai * 0.01 * $gia;
                                    echo "<i class='red'>" . str_replace(',', ' ', number_format($gia_km)) . " VND/Kg<br></i>";
                                    echo "<i><b> Từ ngày: " . $ngay_bat_dau . " đến " . $ngay_ket_thuc . "</b></i>";
                                } else {
                                    echo "<i>" . str_replace(',', ' ', number_format($gia)) . " VND/Kg <br></i>";
                                }
                            }
                            ?>
                        </p>
                        <br>

                        <!-- Hiển thị tồn kho -->
                        <p class="food-price">
                            <?php
                            if ($ton_kho == 0) {
                                echo "<i class='red'>HẾT HÀNG</i>";
                            } else {
                                echo "<i> <b>Tồn kho: </b>" . $ton_kho . " Kg <br></i>";
                            }
                            ?>
                        </p>

                        <!-- Hiển thị mô tả -->
                        <p class="food-detail">
                            <?php echo $mo_ta; ?>
                        </p>
                        <br>

                        <!-- Số chọn trong giỏ hàng -->
                        <?php
                        $so = 1;
                        ?>

                        <a href="<?php echo SITEURL; ?>order.php?spham_id=<?php echo $id; ?>&so=<?php echo $so; ?>&session_user=<?php echo $_SESSION['user']; ?>" class="btn btn-primary">Đặt hàng</a>

                        <a href="#" onclick="addToCart(<?php echo $id; ?>)" class="btn btn-primary">Thêm vào giỏ hàng</a>

                        <script>
                            function addToCart(productId) {
                                // Tạo một yêu cầu XMLHttpRequest
                                var xhttp = new XMLHttpRequest();

                                // Thiết lập hàm xử lý sự kiện khi yêu cầu hoàn thành
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        // Xử lý phản hồi từ máy chủ (nếu cần)
                                        alert("Đã thêm sản phẩm vào giỏ hàng!");
                                    }
                                };
                                // Tạo một yêu cầu GET đến trang add-to-cart.php với id sản phẩm và session user
                                xhttp.open("GET", "<?php echo SITEURL; ?>add-to-cart.php?spham_id=" + productId + "&session_user=<?php echo $_SESSION['user']; ?>", true);
                                xhttp.send();

                                // Ngăn chặn hành động mặc định của thẻ <a>
                                return false;
                            }
                        </script>

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

    <p class="text-center">
        <a href="<?php echo SITEURL; ?>agricultural.php?session_user=<?php echo $_SESSION['user']; ?>">Xem thêm sản phẩm.</a>
    </p>
</section>
<!-- Kết thúc danh sách sản phẩm -->

<?php
include('partials-font/footer.php');
ob_end_flush();
?>