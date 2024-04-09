<?php include('partials-font/menu.php'); ?>

<?php
//Check whether food id is set or not
if (isset($_GET['spham_id'])) {
    //Get the Food id and details of the selected food
    $spham_id = $_GET['spham_id'];

    //Get the details of the selected food
    $sql = "SELECT * FROM san_pham WHERE id=$spham_id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);
    //Count the rows
    $count = mysqli_num_rows($res);
    //Check whether the data is available or not
    if ($count == 1) {
        //We have data
        $row = mysqli_fetch_assoc($res);
        $ten_san_pham = $row['ten_san_pham'];
        $gia = $row['gia'];
        $gia_khuyen_mai = $row['gia_khuyen_mai'];
        $anh = $row['anh'];
    } else {
        //Food not available
        //Redirect to Home page
        header('location:' . SITEURL);
    }
} else {
    //Redirect to homepage
    header('location:' . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">ĐIỀN THÔNG TIN ĐỂ ĐẶT HÀNG</h2>

        <form action="#" class="order">
            <fieldset>
                <legend>SẢN PHẨM ĐÃ CHỌN</legend>

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
                    <h3><?php echo $ten_san_pham; ?></h3>
                    <p class="food-price">
                        <?php
                        if ($gia_khuyen_mai != 0) {
                            echo "<span class='error'>Khuyến mãi: </span>";
                            echo ($gia - $gia_khuyen_mai * 0.01 * $gia);
                        } else {
                            echo $gia;
                        }
                        ?>VND
                    </p>

                    <div class="order-label">Số lượng</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>THÔNG TIN GIAO HÀNG</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Đặt hàng" class="btn btn-primary">
            </fieldset>

        </form>

        <?php

        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-font/footer.php'); ?>