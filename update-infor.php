<?php
include('partials-font/menu.php');
ob_start();

$session_user = ""; // Khởi tạo biến session_user
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="main-content">
    <div class="container">

        <h2 class="text-center " style="color: black;">CẬP NHẬT THÔNG TIN</h2>

        <?php

        //Check whether id is set or not
        if (isset($_GET['session_user'])) {
            //Get all the details
            $session_user = $_GET['session_user'];

            //Query to Get all categories from Database
            $sql = "SELECT * FROM khach_hang  WHERE ten_nguoi_dung = '$session_user'";

            //Execute Query
            $res = mysqli_query($conn, $sql);


            //Count the Rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
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
                //Redirect to manager category page with session message
                $_SESSION['no-user-found'] = "<div class='error'>Không tìm thấy người dùng.</div>";
                header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
            }
        } else {
            //Redirect to Manager Category
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
                            //Image not Available
                            echo "<div class='error'>Không có hình ảnh.</div>";
                        } else {
                            //Image Available
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
            //1. Get the Data from Form
            $id = $_POST['id'];
            $ho_va_ten = $_POST['ho_va_ten'];
            $ten_nguoi_dung = $_POST['ten_nguoi_dung'];
            $doanh_nghiep = $_POST['doanh_nghiep'];
            $ten_doanh_nghiep = $_POST['ten_doanh_nghiep'];
            $ma_so_thue = $_POST['ma_so_thue'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $current_image = $_POST['current_image'];

            //2. Upload the Image if selected
            if (isset($_FILES['anh']['name'])) {
                $ten_anh = $_FILES['anh']['name'];
                if ($ten_anh != "") {
                    $ten_anh_parts = explode('.', $ten_anh);
                    $ext = end($ten_anh_parts);
                    $ten_anh = "Avatar" . rand(0000, 9999) . "." . $ext;
                    $src_path = $_FILES['anh']['tmp_name'];
                    $dest_path = "images/avatar/" . $ten_anh;
                    $upload = move_uploaded_file($src_path, $dest_path);
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Tải hình ảnh thất bại.</div>";
                        header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
                        die();
                    }
                    if ($current_image != "") {
                        $remove_path = "images/avatar/" . $current_image;
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            $_SESSION['remove-failed'] = "<div class='error'>Xóa hình ảnh hiện tại thất bại.</div>";
                            header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
                            die();
                        }
                    }
                } else {
                    $ten_anh = $current_image;
                }
            } else {
                $ten_anh = $current_image;
            }

            //3. Update the User in Database
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
                $_SESSION['update'] = "<div class='success'>Cập nhật thông tin thành công.</div>";
                header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
            } else {
                $_SESSION['update'] = "<div class='error'>Cập nhật thông tin thất bại.</div>";
                header('location:' . SITEURL . 'infor.php?session_user=' . $_SESSION['user']);
            }
        }
        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->


<?php include('partials-font/footer.php');
ob_end_flush(); ?>