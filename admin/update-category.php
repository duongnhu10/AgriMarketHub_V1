<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>CẬP NHẬT LOẠI SẢN PHẨM</h1>

        <br><br>

        <?php
        //Kiểm tra có nhận được id loại sản phẩm hay không
        if (isset($_GET['id'])) {
            //Lấy id và các thông tin liên quan
            // echo "Getting the data";
            $id = $_GET['id'];
            //SQL lấy tất cả thông tin của loại sản phẩm 
            $sql = "SELECT * FROM loai_san_pham WHERE id=$id";

            //Chạy SQL
            $res = mysqli_query($conn, $sql);

            //Đếm số dòng để xem có dữ liệu không
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //Lấy các giá trị
                $row = mysqli_fetch_assoc($res);
                $ten_loai = $row['ten_loai'];
                $current_image = $row['anh'];
                $trang_thai = $row['trang_thai'];
            } else {
                //Chuyển hướng đến trang quản lý loại sản phẩm và hiển thị thông báo
                $_SESSION['no-category-found'] = "<div class='error'>Không tìm thấy loại sản phẩm.</div>";
                header('location:' . SITEURL . 'admin/manager-category.php');
            }
        } else {
            //Chuyển hướng đến trang quản lý loại sản phẩm 
            header('location:' . SITEURL . 'admin/manager-category.php');
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Tên loại: </td>
                    <td>
                        <input type="text" name="ten_loai" value="<?php echo $ten_loai ?>">
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh hiện tại: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //Hiển thị hình ảnh
                        ?>
                            <img width="150px" src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>">
                        <?php
                        } else {
                            //Hiển thị thông báo
                            echo "<div class='error'>Hình ảnh không được thêm.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh mới: </td>
                    <td>
                        <input type="file" name="anh">
                    </td>
                </tr>

                <tr>
                    <td>Trạng thái: </td>
                    <td>
                        <input <?php if ($trang_thai == "Còn hàng") echo "checked"; ?> type="radio" name="trang_thai" value="Còn hàng"> Còn hàng
                        <input <?php if ($trang_thai == "Hết hàng") echo "checked"; ?> type="radio" name="trang_thai" value="Hết hàng"> Hết hàng
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input class="btn-secondary" type="submit" name="submit" value="Cập nhật">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // echo "Clicked";
            //1. Lấy các giá trị từ form
            $id = $_POST['id'];
            $ten_loai = $_POST['ten_loai'];
            $current_image = $_POST['current_image'];
            $trang_thai = $_POST['trang_thai'];

            //2. Cập nhật hình ảnh nếu được chọn ảnh mới
            //Kiểm tra hình ảnh có được chọn hay không
            if (isset($_FILES['anh']['name'])) {
                //Lấy chi tiết ảnh
                $anh = $_FILES['anh']['name'];

                //Kiểm tra hình ảnh có tồn tại hay không
                if ($anh != "") {
                    //Hình ảnh tồn tại

                    //A. Tải ảnh mới lên
                    //Tự động đổi tên ảnh
                    //Lấy phần mở rộng của ảnh (png, jpg) EX: haisamabc678.jpg
                    $ext = end(explode('.', $anh));

                    //Đổi tên ảnh Ex: Loai_NongSan_192.jpg
                    $anh = "Loai_NongSan_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['anh']['tmp_name'];

                    $destination_path = "../images/category/" . $anh;

                    //Tải ảnh mới lên
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Kiểm tra hình ảnh có được tải lên hay không
                    //Nếu không tải lên thì chuyển hướng và thông báo
                    if ($upload == false) {
                        //Đặt thông báo
                        $_SESSION['upload'] = "<div class='error'>Tải hình ảnh thất bại.</div>";
                        //Chuyển hướng đến trang quản lý loại sản phẩm
                        header('location:' . SITEURL . 'admin/manager-category.php');
                        //Dừng quá trình lại
                        die();
                    }

                    //B. Xóa ảnh cũ nếu tồn tại
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;

                        $remove = unlink($remove_path);

                        //Kiểm tra ảnh cũ đã được xóa hay chưa
                        //Nếu chưa xóa thì hiện thông báo và dừng lại
                        if ($remove == false) {
                            //Xóa ảnh thất bại
                            $_SESSION['failed-remove'] = "<div class='error'>Xóa hình ảnh hiện tại thất bại.</div>";
                            header('location:' . SITEURL . 'admin/manager-category.php');
                            die(); //Dừng
                        }
                    }
                } else {
                    $anh = $current_image;
                }
            } else {
                $anh = $current_image;
            }

            //3. Cập nhật dữ liệu
            $sql2 = "UPDATE loai_san_pham SET 
                    ten_loai='$ten_loai', 
                    anh = '$anh',
                    trang_thai = '$trang_thai'
                    WHERE id=$id
            ";

            //Chạy SQL
            $res2 = mysqli_query($conn, $sql2);

            //4. Chuyển hướng trang quản lý loại sản phẩm và thông báo
            //Kiểm tra câu lệnh được chạy hay không
            if ($res2 == true) {
                //Cập nhật loại sản phẩm
                $_SESSION['update'] = "<div class='success'>Cập nhật loại sản phẩm thành công.</div>";
                header('location:' . SITEURL . 'admin/manager-category.php');
            } else {
                //Cập nhật thất bại
                $_SESSION['update'] = "<div class='error'>Cập nhật loại sản phẩm thất bại.</div>";
                header('location:' . SITEURL . 'admin/manager-category.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>