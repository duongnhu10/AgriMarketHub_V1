<?php include('partials-font/menu.php');
ob_start();
$session_user = ""; // Khởi tạo biến session_user

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
} ?>

<?php
//Check whether food id is set or not
if (isset($_GET['spham_id']) && isset($_GET['so'])) {
    //Get the Food id and details of the selected food
    $spham_id = $_GET['spham_id'];
    $so = $_GET['so'];

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
        $gia_dn = $row['gia_dn'];
        $gia_khuyen_mai = $row['gia_khuyen_mai'];
        $anh = $row['anh'];
    } else {
        //Food not available
        //Redirect to Home page
        header('location:' . SITEURL . "?session_user=" . $_SESSION['user']);
    }
} else {
    //Redirect to homepage
    header('location:' . SITEURL . "?session_user=" . $_SESSION['user']);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-menu">
    <div class="container">

        <h2 class="text-center " style="color: black;">ĐIỀN THÔNG TIN ĐỂ ĐẶT HÀNG</h2>

        <form action="" method="POST" class="order">
            <fieldset style="border: 1px solid black;">
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
                    <input type="hidden" name="gia" value="<?php
                                                            if ($doanh_nghiep == 1) {
                                                                echo $gia_dn;
                                                            } else
                                                            if ($gia_khuyen_mai != 0) {
                                                                echo $gia_km;
                                                            } else {
                                                                echo $gia;
                                                            } ?>">

                    <div class="order-label">

                    </div>
                    <?php
                    if ($so > 1) {
                        echo '<input type="number" name="so_luong" class="input-responsive" value="' . $so . '" required>';
                    } else {
                        echo '<input type="number" name="so_luong" class="input-responsive" value="1" required>';
                    }
                    ?>


                </div>

            </fieldset>

            <fieldset style="border: 1px solid black;">
                <legend style="color: black;">THÔNG TIN GIAO HÀNG</legend>
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
                khach_diachi = '$khach_diachi',
                user_id = $id_us
            ";

            // echo $sql2; die();

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Check whether query executed successfully or not
            if ($res2 == true) {
                //Query Executed and Order Saved
                $_SESSION['dat_hang'] = "<div class='success text-center'>Đặt hàng thành công.</div>";
                header('location:' . SITEURL . '?session_user=' . $_SESSION['user']);
            } else {
                //Failed to Save Order
                $_SESSION['dat_hang'] = "<div class='error  text-center'>Đặt hàng thất bại.</div>";
                header('location:' . SITEURL . '?session_user=' . $_SESSION['user']);
            }
        }
        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-font/footer.php');

ob_end_flush(); ?>