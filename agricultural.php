<?php
include('partials-font/menu.php');
ob_start();
$session_user = ""; // Khởi tạo biến session_user

$id_us = ""; //Khởi tạo user_id

if (isset($_GET['session_user'])) {
    $session_user = $_GET['session_user']; // Lấy giá trị session_user từ URL nếu tồn tại
}

//Lấy thông tin đăng nhập
$sql_s = "SELECT * FROM khach_hang WHERE ten_nguoi_dung='$session_user'";
$res_s = mysqli_query($conn, $sql_s);
$row_s = mysqli_fetch_assoc($res_s);
$count_s = mysqli_num_rows($res_s);
if ($count_s == 1) {
    //Có dữ liệu
    $id_us = $row_s['id'];
} else {
    //Không có dữ liệu
} ?>

<section class="food-search text-center">
    <div class="container">
        <!-- Tìm kiếm sản phẩm gửi session_user đi -->
        <form action="<?php echo SITEURL ?>agricultural-search.php?session_user=<?php echo $_SESSION['user']; ?>" method="POST">
            <input type="search" name="search" placeholder="Tìm kiếm sản phẩm.." required>
            <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary">
        </form>
    </div>
</section>

<!-- Bắt đầu danh sách sản phẩm -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">SẢN PHẨM</h2>

        <?php
        //Lấy sản phẩm từ database có trạng thái còn hàng
        //SQL 
        $sql2 = "SELECT * FROM san_pham WHERE trang_thai = 'Còn hàng'";

        //Chạy SQL
        $res2 = mysqli_query($conn, $sql2);

        //Đếm số dòng
        $count2 = mysqli_num_rows($res2);

        //Kiểm tra sản phẩm có tốn tại hay không
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
                            //Tồn tại
                        ?>
                            <img height="130px" src="<?php echo SITEURL; ?>images/agricultural/<?php echo $anh; ?>" alt="" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <!-- Hiển thị tên sản phẩm -->
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
            //Không có
            echo "<div class='error'>Không có sản phẩm.</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- Kết thúc danh sách sản phẩm -->

<?php
include('partials-font/footer.php');
ob_end_flush();
?>