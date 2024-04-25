<?php
include('partials-font/menu.php');
ob_start();
$session_user = ""; // Khởi tạo biến session_user

$id_us = ""; //Khởi tại biến user id

if (isset($_GET['session_user'])) {
    $session_user = $_GET['session_user']; // Lấy giá trị session_user từ URL nếu tồn tại
}

//Lấy thông tin đăng nhập
$sql_s = "SELECT * FROM khach_hang WHERE ten_nguoi_dung='$session_user'";
$res_s = mysqli_query($conn, $sql_s);
$row_s = mysqli_fetch_assoc($res_s);
$count_s = mysqli_num_rows($res_s);
if ($count_s == 1) {
    //Có
    $id_us = $row_s['id'];
} else {
    //Không
}
?>

<!-- Kiểm tra, hiển thị, hủy bỏ các thông báo phiên -->
<?php
if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}

if (isset($_SESSION['res_update'])) {
    echo $_SESSION['res_update'];
    unset($_SESSION['res_update']);
}

if (isset($_SESSION['gio_hang'])) {
    echo $_SESSION['gio_hang'];
    unset($_SESSION['gio_hang']);
}

if (isset($_SESSION['het_hang'])) {
    echo $_SESSION['het_hang'];
    unset($_SESSION['het_hang']);
}
?>

<?php
// Lấy thông tin giỏ hàng của người dùng đăng nhập
$sql = "SELECT * FROM gio_hang WHERE user_id=$id_us";
$res = mysqli_query($conn, $sql);
if ($res == true) {
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        // Bắt đầu phần fieldset chung
        echo '<section class="food-menu">
            <div class="container">
                <h2 class="text-center style="color: black;"">THÔNG TIN GIỎ HÀNG</h2>
                <form action="" method="POST" class="order">
                    <fieldset style="border: 1px solid black;">
                        <legend>SẢN PHẨM ĐÃ THÊM VÀO GIỎ HÀNG</legend>';

        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $ten_san_pham = $row['ten_san_pham'];
            $gia = $row['gia'];
            $gia_dn = $row['gia_dn'];
            $gia_khuyen_mai = $row['gia_khuyen_mai'];
            $anh = $row['anh'];
            $so_luong = $row['so_luong'];
            $spham_id = $row['san_pham_id'];
?>
            <div class="food-menu-img">
                <?php
                //Kiểm tra hình ảnh
                if ($anh == "") {
                    //Không có
                    echo "<div class='error'>Không có hình ảnh.</div>";
                } else {
                    //Tồn tại ảnh
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
                    $sql_km = "SELECT * FROM khuyen_mai WHERE sanpham_id = $spham_id ORDER BY ngay_batdau DESC LIMIT 1";
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
                    $sql_tk = "SELECT * FROM san_pham WHERE id=$spham_id";
                    $res_tk = mysqli_query($conn, $sql_tk);
                    $row_tk = mysqli_fetch_assoc($res_tk);
                    $ton_kho = $row_tk['ton_kho'];

                    if ($ton_kho == 0) {
                        echo "<i class='red'>HẾT HÀNG</i>";
                    } else {
                        echo "<i> <b>Tồn kho: </b>" . $ton_kho . " Kg <br></i>";
                    }
                    ?>
                </p>

                <p style="display: flex; align-items: center; ">
                    <!-- Nút giảm số lượng -->
                    <button type="button" onclick="giamSoLuong(<?php echo $spham_id; ?>)" style="margin-right: 10px;  border: none; font-size: 25px;"><b>-</b></button>

                    <!-- Input hiển thị số lượng -->
                    <input type="text" id="so_luong_<?php echo $spham_id; ?>" readonly value="<?php echo $so_luong; ?>" style=" width: 50px;">

                    <!-- Nút tăng số lượng -->
                    <button type="button" onclick="tangSoLuong(<?php echo $spham_id; ?>)" style="margin-left: 10px; border: none; font-size: 25px;"><b>+</b></button>
                </p>
                <br><br>

                <!-- javascript xử lý tăng, giảm số lượng trong giỏ hàng -->
                <script>
                    function tangSoLuong(idSanPham) {
                        var inputSoLuong = document.getElementById("so_luong_" + idSanPham);
                        var soLuongHienTai = parseInt(inputSoLuong.value); //Số lượng hiện tại
                        var soLuongMoi = soLuongHienTai + 1; //Số lượng mới

                        inputSoLuong.value = soLuongMoi; //Gán số lượng hiện tại = số lượng mới

                        updateSoLuong(null, idSanPham); // Gọi hàm cập nhật số lượng sau khi tăng
                    }

                    function giamSoLuong(idSanPham) {
                        var inputSoLuong = document.getElementById("so_luong_" + idSanPham);
                        var soLuongHienTai = parseInt(inputSoLuong.value); //Số lượng hiện tại
                        var soLuongMoi = Math.max(soLuongHienTai - 1, 0); // Đảm bảo số lượng không âm

                        inputSoLuong.value = soLuongMoi;

                        updateSoLuong(null, idSanPham); // Gọi hàm cập nhật số lượng sau khi giảm
                    }

                    function updateSoLuong(event, idSanPham) {
                        if (event) {
                            event.preventDefault(); // Ngăn chặn hành động mặc định của form
                        }

                        var inputSoLuong = document.getElementById("so_luong_" + idSanPham);
                        var soLuongMoi = parseInt(inputSoLuong.value); //Số lượng mới

                        // Gửi yêu cầu AJAX để cập nhật số lượng trên máy chủ
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "<?php echo SITEURL; ?>update-cart.php", true); //Gửi yêu cầu đến file updata-cart.php
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                // Xử lý phản hồi từ máy chủ (nếu cần)
                            }
                        };
                        // Các thông tin gửi đi
                        xhr.send("sanpham_id=" + idSanPham + "&so_luong=" + soLuongMoi + "&session_user=<?php echo urlencode($session_user); ?>");
                    }
                </script>

                <!-- Nút đặt hàng -->
                <a href="<?php echo SITEURL; ?>order.php?spham_id=<?php echo $spham_id; ?>&so=<?php echo $so_luong; ?>&session_user=<?php echo $_SESSION['user']; ?>" class="btn btn-primary">Đặt hàng</a>
                <!-- Nút xóa khỏi giỏ hàng -->
                <a href="<?php echo SITEURL; ?>delete-cart.php?gio_hang_id=<?php echo $id; ?>&session_user=<?php echo $_SESSION['user']; ?>" class="btn btn-primary">Xóa khỏi giỏ hàng</a>
                <br><br><br>
            </div>
<?php
        }
        // Kết thúc phần fieldset chung
        echo '</fieldset>
        </form>
        </div>
        </section>';
    } else {
        echo '<section class="food-menu">
    <div class="container">
        <h2 class="text-center style="color: black;"">THÔNG TIN GIỎ HÀNG</h2>
        <form action="" method="POST" class="order">
            <fieldset style="border: 1px solid black;">
                <legend>SẢN PHẨM ĐÃ THÊM VÀO GIỎ HÀNG</legend>
                <h3 class="red text-center">GIỎ HÀNG TRỐNG.</h3>
            </fieldset>

        </form>
        </div>
        </section>';
    }
} else {
    echo '<section class="food-menu">
    <div class="container">
        <h2 class="text-center style="color: black;"">THÔNG TIN GIỎ HÀNG</h2>
        <form action="" method="POST" class="order">
            <fieldset style="border: 1px solid black;">
                <legend>SẢN PHẨM ĐÃ THÊM VÀO GIỎ HÀNG</legend>
                <h3 class="red text-center">GIỎ HÀNG TRỐNG.</h3>
            </fieldset>
            
        </form>
        </div>
        </section>';
}
?>

<?php
include('partials-font/footer.php');
ob_end_flush();
?>