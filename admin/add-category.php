<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>THÊM LOẠI SẢN PHẨM</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>

        <!-- Bắt đầu form thêm sản phẩm -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Tên loại:</td>
                    <td>
                        <input type="text" name="ten_loai" placeholder="Tên loại sản phẩm">
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh:</td>
                    <td>
                        <input type="file" name="anh">
                    </td>
                </tr>

                <tr>
                    <td>Trạng thái:</td>
                    <td>
                        <input type="radio" name="trang_thai" value="Hết hàng">Hết hàng
                        <input type="radio" name="trang_thai" value="Còn hàng">Còn hàng
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input class="btn-secondary" type="submit" name="submit" value="Thêm">
                    </td>
                </tr>
            </table>

        </form>
        <!-- Kết thúc form thêm sản phẩm -->

        <?php
        //Kiểm tra nút submit được nhấn hay không
        if (isset($_POST['submit'])) {
            // echo "Clicked";

            //1. Lấy giá trị tên loại từ form
            $ten_loai = $_POST['ten_loai'];

            //Kiểm tra radio button có được click hay không
            if (isset($_POST['trang_thai'])) {
                //Lấy giá trị từ form
                $trang_thai = $_POST['trang_thai'];
            } else {
                //Đặt giá trị mặc định
                $trang_thai = 'Hết hàng';
            }

            if (isset($_FILES['anh']['name'])) {
                //Tải ảnh lên
                //Cần tên ảnh, đường dẫn nguồn, đường dẫn đích
                $ten_anh = $_FILES['anh']['name'];

                //Tải ảnh nếu ảnh được chọn
                if ($ten_anh != "") {
                    //Đổi tên ảnh tự dộng
                    //Lấy phần mở rộng ảnh (png, jpg) EX: haisamabc678.jpg
                    $ext = end(explode('.', $ten_anh));

                    //Đổi tên ảnh Ex: Loai_NongSan_192.jpg
                    $ten_anh = "Loai_NongSan_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['anh']['tmp_name'];

                    $destination_path = "../images/category/" . $ten_anh;

                    //Tải ảnh lên
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Kiểm tra ảnh đã được tải lên hay chưa
                    //Nếu ảnh chưa được tải lên sẽ dừng và thông báo lỗi
                    if ($upload == false) {
                        //Đặt thông báo
                        $_SESSION['upload'] = "<div class='error'>Tải hình ảnh thất bại.</div>";
                        //Chuyển hướng đến trang thêm sản phẩm
                        header('location:' . SITEURL . 'admin/add-category.php');
                        //Dừng
                        die();
                    }
                }
            } else {
                //Nếu không tải ảnh lên, đặt tên ảnh rỗng
                $ten_anh = "";
            }

            //2. SQL chèn vào database
            $sql = "INSERT INTO loai_san_pham SET
            ten_loai='$ten_loai', 
            anh = '$ten_anh',
            trang_thai='$trang_thai'
            ";

            //3. Chạy SQL
            $res = mysqli_query($conn, $sql);

            //4. Kiểm tra đã thêm thành công hay chưa
            if ($res == true) {
                //Thông báo thành công
                $_SESSION['add'] = "<div class='success'>Thêm loại sản phẩm thành công.</div>";
                //Chuyển hướng đến trang thêm loại sản phẩm
                header('location: ' . SITEURL . 'admin/manager-category.php');
            } else {
                //Thêm thất bại
                $_SESSION['add'] = "<div class='error'>Thêm loại sản phẩm thất bại.</div>";
                //Chuyển hướng đến trang thêm loại sản phẩm
                header('location: ' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>