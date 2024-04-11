<?php include('partials-font/menu.php'); ?>

<?php
if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
?>

<?php
$sql = "SELECT * FROM gio_hang";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
if ($count > 0) {
    // Bắt đầu phần fieldset chung
    echo '<section class="food-search">
            <div class="container">
                <h2 class="text-center text-white">THÔNG TIN GIỎ HÀNG</h2>
                <form action="" method="POST" class="order">
                    <fieldset>
                        <legend>SẢN PHẨM ĐÃ THÊM VÀO GIỎ HÀNG</legend>';

    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $ten_san_pham = $row['ten_san_pham'];
        $gia = $row['gia'];
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

                echo $gia;

                ?>VND
            </p>

            <span class="order-label">Số lượng: </span>
            <?php echo $so_luong; ?>
            <br>
            <br>

            <a href="<?php echo SITEURL; ?>order.php?spham_id=<?php echo $spham_id; ?>&so=<?php echo $so_luong; ?>" class="btn btn-primary">Đặt hàng</a>
            <a href="<?php echo SITEURL; ?>delete-cart.php?gio_hang_id=<?php echo $id; ?>" class="btn btn-primary">Xóa khỏi giỏ hàng</a>

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
    echo '<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">THÔNG TIN GIỎ HÀNG</h2>
        <form action="" method="POST" class="order">
            <fieldset>
                <legend>SẢN PHẨM ĐÃ THÊM VÀO GIỎ HÀNG</legend>
                <h3 class="red text-center">GIỎ HÀNG TRỐNG.</h3>
            </fieldset>
            
        </form>
        </div>
        </section>';
}
?>

<?php include('partials-font/footer.php'); ?>