<?php
include('partials-font/menu.php');
ob_start();

if (isset($_GET['donhang_id'])) {
    $donhang_id = $_GET['donhang_id']; // Lấy giá trị session_user từ URL nếu tồn tại
}
?>

<?php
if (isset($_SESSION['lien_he'])) {
    echo $_SESSION['lien_he'];
    unset($_SESSION['lien_he']);
}
?>

<!-- Bắt đầu phản hồi -->
<section class="food-menu">
    <div class="container">

        <h2 class="text-center " style="color: black;">PHẢN HỒI</h2>

        <form action="" method="POST" class="order">

            <fieldset style="border: 1px solid black;">
                <legend style="color: black;">THÔNG TIN PHẢN HỒI</legend>
                <div class="order-label">Họ và tên</div>
                <input type="text" name="khach_ten" placeholder="VD. Nguyễn Văn A" class="input-responsive" required>

                <div class="order-label">Số điện thoại</div>
                <input type="tel" name="khach_sdt" placeholder="VD. 0385673xxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="khach_email" placeholder="VD. vana@gmail.com" class="input-responsive" required>

                <div class="order-label">Địa chỉ</div>
                <textarea name="khach_diachi" rows="10" placeholder="VD. Trần Văn Khéo, Cái Khế, Ninh Kiều, Cần Thơ" class="input-responsive" required></textarea>

                <div class="order-label">Nội dung phản hồi</div>
                <textarea name="noi_dung" rows="10" placeholder="VD. Chất lượng sản phẩm rất tốt" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Gửi" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
        //Kiểm tra nút Gửi
        if (isset($_POST['submit'])) {

            $ngay_lien_he = date("Y-m-d h:i:sa");

            $khach_ten = $_POST['khach_ten'];
            $khach_sdt = $_POST['khach_sdt'];
            $khach_email = $_POST['khach_email'];
            $khach_diachi = $_POST['khach_diachi'];
            $noi_dung = $_POST['noi_dung'];

            //Lưu dữ liệu
            $sql2 = "INSERT INTO lien_he SET
                ngay = '$ngay_lien_he',
                noi_dung = '$noi_dung',
                khach_ten = '$khach_ten',
                khach_sdt = '$khach_sdt',
                khach_email = '$khach_email',
                khach_diachi = '$khach_diachi',
                donhang_id = $donhang_id
            ";

            //Chạy SQL
            $res2 = mysqli_query($conn, $sql2);

            //Kiểm tra kết nối
            if ($res2 == true) {
                //Hiển thị thông báo
                $_SESSION['lien_he'] = "<div class='success'>Đã gửi thông tin phản hồi thành công.</div>";
                header('location:' . SITEURL . 'tracking-order.php?session_user=' . $_SESSION['user']);
            } else {
                //Phản hồi thất bại
                $_SESSION['lien_he'] = "<div class='error'>Vui lòng thử lại sau.</div>";
                header('location:' . SITEURL . 'contact.php?session_user=' . $_SESSION['user']);
            }
        }
        ?>
    </div>
</section>
<!-- Kết thúc phản hồi -->

<?php
include('partials-font/footer.php');
ob_end_flush();
?>