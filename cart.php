<?php include('partials-font/menu.php');
ob_start();
$session_user = ""; // Khởi tạo biến session_user

$id_us = "";

if (isset($_GET['session_user'])) {
    $session_user = $_GET['session_user']; // Lấy giá trị session_user từ URL nếu tồn tại
}
$sql_s = "SELECT * FROM khach_hang WHERE ten_nguoi_dung='$session_user'";
$res_s = mysqli_query($conn, $sql_s);
$row_s = mysqli_fetch_assoc($res_s);
$count_s = mysqli_num_rows($res_s);
if ($count_s == 1) {
    //Have data
    $id_us = $row_s['id'];
} else {
    //No data
}

?>

<?php
if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
?>

<?php
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
                //Check whether image available or not
                if ($anh == "") {
                    //Image not Available
                    echo "<div class='error'>Không có hình ảnh.</div>";
                } else {
                    //Image Available
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
                    // $doanh_nghiep = 0;

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
                            echo "<i class='red'>" . str_replace(',', ' ', number_format($gia_km)) . " VND/Kg</i>";
                        } else {
                            echo "<i>" . str_replace(',', ' ', number_format($gia)) . " VND/Kg <br></i>";
                        }
                    }

                    ?>

                </p>
                <span class="order-label">Số lượng: </span>
                <input type="number" value="<?php echo $so_luong; ?>">
                <br>
                <br>

                <a href="<?php echo SITEURL; ?>order.php?spham_id=<?php echo $spham_id; ?>&so=<?php echo $so_luong; ?>&session_user=<?php echo $_SESSION['user']; ?>" class="btn btn-primary">Đặt hàng</a>
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

<?php include('partials-font/footer.php');
ob_end_flush(); ?>