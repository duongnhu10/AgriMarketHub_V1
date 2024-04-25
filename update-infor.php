<?php
include('partials-font/menu.php');
ob_start();

$session_user = ""; // Khởi tạo biến session_user
?>

<!-- Bắt đầu cập nhật thông tin -->
<section class="main-content">
    <div class="container">

        <h2 class="text-center " style="color: black;">CẬP NHẬT THÔNG TIN</h2>

        <?php

        //Kiểm tra session_user
        if (isset($_GET['session_user'])) {
            //Lấy thông tin session_user
            $session_user = $_GET['session_user'];

            //Lấy thông tin người dùng đang đăng nhập
            $sql = "SELECT * FROM khach_hang  WHERE ten_nguoi_dung = '$session_user'";

            //Chạy SQL
            $res = mysqli_query($conn, $sql);

            //Đếm số dòng
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //Có người dùng
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $current_image = $row['anh'];
                $ho_va_ten = $row['ho_va_ten'];
                $ten_nguoi_dung = $row['ten_nguoi_dung'];
                $gioi_tinh = $row['gioi_tinh'];
                $doanh_nghiep = $row['doanh_nghiep'];
                $ten_doanh_nghiep = $row['ten_doanh_nghiep'];
                $ma_so_thue = $row['ma_so_thue'];
            } else {
                //Hiển thị thông báo và chuyển hướng
                $_SESSION['no-user-found'] = "<div class='error'>Không tìm thấy người dùng.</div>";
                header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
            }
        } else {
            //Chuyển hướng đến trang thông tin khách hàng
            header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Họ và tên:</td>
                    <td>
                        <input type="text" name="ho_va_ten" placeholder="Họ và tên" value="<?php echo $ho_va_ten; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Tên người dùng:</td>
                    <td>
                        <input type="text" name="ten_nguoi_dung" placeholder="Tên người dùng" value="<?php echo $ten_nguoi_dung; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Giới tính:</td>
                    <td>
                        <input <?php if ($gioi_tinh == 1) {
                                    echo "checked";
                                } ?> type="radio" name="gioi_tinh" value="1">Nữ
                        <input <?php if ($gioi_tinh == 0) {
                                    echo "checked";
                                } ?> type="radio" name="gioi_tinh" value="0">Nam
                    </td>
                </tr>

                <tr>
                    <td>Doanh nghiệp:</td>
                    <td>
                        <input <?php if ($doanh_nghiep == 1) {
                                    echo "checked";
                                } ?> type="radio" name="doanh_nghiep" value="1">Có
                        <input <?php if ($doanh_nghiep == 0) {
                                    echo "checked";
                                } ?> type="radio" name="doanh_nghiep" value="0">Không
                    </td>
                </tr>

                <tr>
                    <td>Tên doanh nghiệp:</td>
                    <td>
                        <input type="text" name="ten_doanh_nghiep" placeholder="Tên doanh nghiệp" value="<?php echo $ten_doanh_nghiep; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Mã số thuế:</td>
                    <td>
                        <input type="text" name="ma_so_thue" placeholder="Mã số thuế" value="<?php echo $ma_so_thue; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh hiện tại:</td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            //Không có
                            echo "<div class='error'>Không có hình ảnh.</div>";
                        } else {
                            //Có hình ảnh
                        ?>
                            <img width="150px" src="<?php echo SITEURL; ?>images/avatar/<?php echo $current_image; ?>">
                        <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh mới:</td>
                    <td>
                        <input type="file" name="anh">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input class="btn-secondary" type="submit" name="submit" value="Cập nhật">
                    </td>
                </tr>

            </table>

        </form>


        <?php
        if (isset($_POST['submit'])) {
            //1. Lấy dữ liệu từ form
            $id = $_POST['id'];
            $ho_va_ten = $_POST['ho_va_ten'];
            $ten_nguoi_dung = $_POST['ten_nguoi_dung'];
            $doanh_nghiep = $_POST['doanh_nghiep'];
            $ten_doanh_nghiep = $_POST['ten_doanh_nghiep'];
            $ma_so_thue = $_POST['ma_so_thue'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $current_image = $_POST['current_image'];

            //2. Tải hình ảnh được chọn
            if (isset($_FILES['anh']['name'])) {
                //Lấy tên ảnh
                $ten_anh = $_FILES['anh']['name'];
                if ($ten_anh != "") {
                    $ten_anh_parts = explode('.', $ten_anh);
                    //Lấy phần mở rộng ảnh
                    $ext = end($ten_anh_parts);
                    //Đổi tên ảnh tự động
                    $ten_anh = "Avatar" . rand(0000, 9999) . "." . $ext;
                    //Lấy đường dẫn nguồn
                    $src_path = $_FILES['anh']['tmp_name'];
                    //Đường dẫn đích
                    $dest_path = "images/avatar/" . $ten_anh;
                    //Tải ảnh lên
                    $upload = move_uploaded_file($src_path, $dest_path);
                    if ($upload == false) {
                        //Tải thất bại
                        $_SESSION['upload'] = "<div class='error'>Tải hình ảnh thất bại.</div>";
                        header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
                        die();
                    }

                    if ($current_image != "") {
                        //Gở bỏ ảnh cũ nếu có
                        $remove_path = "images/avatar/" . $current_image;
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            //Gỡ thất bại
                            $_SESSION['remove-failed'] = "<div class='error'>Xóa hình ảnh hiện tại thất bại.</div>";
                            header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
                            die();
                        }
                    }
                } else {
                    //Chọn ảnh rỗng
                    $ten_anh = $current_image;
                }
            } else {
                //Không chọn ảnh
                $ten_anh = $current_image;
            }

            //3. Cập nhật
            $sql3 = "UPDATE khach_hang SET
            ho_va_ten = '$ho_va_ten',
            ten_nguoi_dung = '$ten_nguoi_dung',
            doanh_nghiep = $doanh_nghiep,
            gioi_tinh = $gioi_tinh,
            ten_doanh_nghiep = '$ten_doanh_nghiep',
            ma_so_thue = '$ma_so_thue',
            anh = '$ten_anh'
            WHERE id=$id
        ";
            $res3 = mysqli_query($conn, $sql3);
            $_SESSION['user'] = $ten_nguoi_dung;
            if ($res3 == true) {
                //Cập nhật thành công
                $_SESSION['update'] = "<div class='success'>Cập nhật thông tin thành công.</div>";
                header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
            } else {
                //Cập nhật thất bại
                $_SESSION['update'] = "<div class='error'>Cập nhật thông tin thất bại.</div>";
                header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
            }
        }
        ?>

    </div>
</section>
<!-- Kết thúc cập nhật thông tin -->

<?php
include('partials-font/footer.php');
ob_end_flush();
?>