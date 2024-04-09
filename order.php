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

        <form action="" method="POST" class="order">
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
                    <input type="hidden" name="san_pham" value="<?php echo $ten_san_pham; ?>">

                    <p class="food-price">
                        <?php
                        if ($gia_khuyen_mai != 0) {
                            echo "<span class='red'>Khuyến mãi: </span>";
                            $gia = $gia - $gia_khuyen_mai * 0.01 * $gia;
                            echo $gia;
                        } else {
                            echo $gia;
                        }
                        ?>VND
                    </p>
                    <input type="hidden" name="gia" value="<?php echo $gia; ?>">

                    <div class="order-label">Số lượng</div>
                    <input type="number" name="so_luong" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>THÔNG TIN GIAO HÀNG</legend>
                <div class="order-label">Họ và tên</div>
                <input type="text" name="khach_ten" placeholder="VD. Nguyễn Văn A" class="input-responsive" required>

                <div class="order-label">Số điện thoại</div>
                <input type="tel" name="khach_sdt" placeholder="VD. 0385673xxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="khach_email" placeholder="VD. vana@gmail.com" class="input-responsive" required>

                <div class="order-label">Địa chỉ</div>
                <textarea name="khach_diachi" rows="10" placeholder="VD. Trần Văn Khéo, Cái Khế, Ninh Kiều, Cần Thơ" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Đặt hàng" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
        //Check whether submit button is clicked or not
        if (isset($_POST['submit'])) {
            //Get all the details from the form

            $san_pham = $_POST['san_pham'];
            $gia = $_POST['gia'];
            $so_luong = $_POST['so_luong'];

            $tong_tien = $gia * $so_luong; //total = price x qty

            $ngay_dat = date("Y-m-d h:i:sa"); //Order Date

            $trang_thai = "Chờ xác nhận"; //Ordered, On delivery, Delivered, ...

            $khach_ten = $_POST['khach_ten'];
            $khach_sdt = $_POST['khach_sdt'];
            $khach_email = $_POST['khach_email'];
            $khach_diachi = $_POST['khach_diachi'];

            //Save the Order in Database
            //Create SQL to Save the data
            $sql2 = "INSERT INTO don_hang SET
                san_pham = '$san_pham',
                gia = $gia,
                so_luong = $so_luong,
                tong_tien = $tong_tien,
                ngay_dat = '$ngay_dat',
                trang_thai = '$trang_thai',
                khach_ten = '$khach_ten',
                khach_sdt = '$khach_sdt',
                khach_email = '$khach_email',
                khach_diachi = '$khach_diachi'
            ";

            // echo $sql2; die();

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Check whether query executed successfully or not
            if ($res2 == true) {
                //Query Executed and Order Saved
                $_SESSION['dat_hang'] = "<div class='success text-center'>Đặt hàng thành công.</div>";
                header('location:' . SITEURL);
            } else {
                //Failed to Save Order
                $_SESSION['dat_hang'] = "<div class='error  text-center'>Đặt hàng thất bại.</div>";
                header('location:' . SITEURL);
            }
        }
        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-font/footer.php'); ?>