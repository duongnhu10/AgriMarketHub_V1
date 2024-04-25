<?php
include('partials/menu.php');
ob_start();
?>

<div class="main-content">
    <div class="wrapper">
        <h1>THÊM SẢN PHẨM</h1>

        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Tên sản phẩm:</td>
                    <td>
                        <input type="text" name="ten_san_pham" placeholder="Tên sản phẩm">
                    </td>
                </tr>

                <tr>
                    <td>Mô tả:</td>
                    <td>
                        <textarea cols="30" rows="5" name="mo_ta" placeholder="Mô tả sản phẩm"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Giá nhập/Kg:</td>
                    <td>
                        <input type="number" name="gia_goc">
                    </td>
                </tr>

                <tr>
                    <td>Giá bán/kg:</td>
                    <td>
                        <input type="number" name="gia">
                    </td>
                </tr>

                <tr>
                    <td>Giá doanh nghiệp/kg:</td>
                    <td>
                        <input type="number" name="gia_dn">
                    </td>
                </tr>

                <tr>
                    <td>Khuyến mãi (%):</td>
                    <td>
                        <input type="number" name="gia_khuyen_mai">
                    </td>
                </tr>

                <tr>
                    <td>Ngày bắt đầu:</td>
                    <td>
                        <input type="text" name="ngay_bat_dau" placeholder="yyyy-mm-dd">
                    </td>
                </tr>

                <tr>
                    <td>Ngày kết thúc:</td>
                    <td>
                        <input type="text" name="ngay_ket_thuc" placeholder="yyyy-mm-dd">
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh:</td>
                    <td>
                        <input type="file" name="anh">
                    </td>
                </tr>

                <tr>
                    <td>Loại sản phẩm:</td>
                    <td>
                        <select name="loai_san_pham">
                            <?php
                            //Hiển thị loại sản phẩm từ database
                            //1. SQL lấy tất cả loại từ database
                            $sql = "SELECT * FROM loai_san_pham WHERE trang_thai = 'Còn hàng'";

                            //Chạy SQL
                            $res = mysqli_query($conn, $sql);

                            //Đếm số dòng
                            $count = mysqli_num_rows($res);

                            //Kiểm tra có tồn tại loại hay không
                            if ($count > 0) {
                                //Có loại sản phẩm
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //Lấy chi tiết loại
                                    $id = $row['id'];
                                    $ten_loai = $row['ten_loai'];

                            ?>

                                    <option value="<?php echo $id ?>"><?php echo $ten_loai ?></option>

                                <?php
                                }
                            } else {
                                //Không có loại sản phẩm
                                ?>

                                <option value="0">Không có loại sản phẩm</option>

                            <?php
                            }
                            ?>

                        </select>
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
                    <td>Tồn kho/kg:</td>
                    <td>
                        <input type="number" name="ton_kho">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input class="btn-secondary" type="submit" name="submit" value="Thêm sản phẩm">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        //Kiểm tra nút thêm sản phẩm có được nhấn hay không
        if (isset($_POST['submit'])) {
            //Thêm sản phẩm
            // echo "Clicked";

            //1. Lấy dữ liệu từ form
            $ten_san_pham = $_POST['ten_san_pham'];
            $mo_ta = $_POST['mo_ta'];
            $gia_goc = $_POST['gia_goc']; //Giá nhập
            $gia = $_POST['gia']; //Giá hiện tại
            $gia_dn = $_POST['gia_dn'];
            $gia_khuyen_mai = $_POST['gia_khuyen_mai']; //Phần trăm khuyến mãi

            $ngay_bat_dau = date('Y-m-d', strtotime($_POST['ngay_bat_dau']));
            $ngay_ket_thuc = date('Y-m-d', strtotime($_POST['ngay_ket_thuc']));

            $loai_san_pham = $_POST['loai_san_pham'];
            $ton_kho = $_POST['ton_kho'];

            //Kiểm tra trang_thai có được chọn hay không
            if (isset($_POST['trang_thai'])) {
                $trang_thai = $_POST['trang_thai'];
            } else {
                $trang_thai = "Hết hàng"; //Đặt giá trị mặc định
            }

            //2. Tải hình ảnh nếu được chọn
            //Kiểm tra hình ảnh có được chọn hay không
            if (isset($_FILES['anh']['name'])) {
                //Lấy chi tiết hình ảnh
                $ten_anh = $_FILES['anh']['name'];

                //Kiểm tra hình ảnh có được chọn hay không và tải hình ảnh được chọn
                if ($ten_anh != "") {
                    //Hình ảnh được chọn
                    //A. Đổi tên ảnh
                    //Lấy phần mở rộng của ảnh (jpn, png...)
                    $ext = end(explode('.', $ten_anh));

                    //Tạo hình ảnh mới
                    $ten_anh = "Nong_San_" . rand(0000, 9999) . "." . $ext;

                    //B. Tải hình ảnh lên
                    //Lấy đường dẫn nguồn và đích
                    //Đường dẫn nguồn của hình ảnh
                    $src = $_FILES['anh']['tmp_name'];

                    //Đường dẫn đích của hình ảnh
                    $dst = "../images/agricultural/" . $ten_anh;

                    //Tải hình ảnh lên
                    $upload = move_uploaded_file($src, $dst);

                    //Kiểm tra hình ảnh được tải lên hay không
                    if ($upload == false) {
                        //Tải hình ảnh thất bại
                        //Chuyển hướng trang thêm sản phẩm và thông báo lỗi
                        $_SESSION['upload'] = "<div class='error'>Tải hình ảnh thất bại.</div>";
                        header('location:' . SITEURL . 'admin/add-agricultural.php');
                        //Dừng quá trình
                        die();
                    }
                }
            } else {
                $ten_anh = ""; //Đặt giá trị mặc định là rỗng
            }


            //3. Chèn vào database

            //Thêm sản phẩm
            //Số không cần ''. Chuỗi thì cần ''
            $sql2 = "INSERT INTO san_pham SET
                ten_san_pham = '$ten_san_pham',
                mo_ta = '$mo_ta',
                gia_goc = $gia_goc,
                gia = $gia,
                gia_dn = $gia_dn,
                gia_khuyen_mai = $gia_khuyen_mai,
                anh = '$ten_anh',
                loai_id = $loai_san_pham,
                trang_thai = '$trang_thai',
                ton_kho = $ton_kho
            ";

            //Chạy SQL
            $res2 = mysqli_query($conn, $sql2);

            $sql_id = "SELECT * FROM san_pham WHERE ten_san_pham = '$ten_san_pham'";
            $res_id = mysqli_query($conn, $sql_id);
            $row_id = mysqli_fetch_assoc($res_id);
            $id_sp = $row_id['id'];

            $sql_km = "INSERT INTO khuyen_mai SET 
                        ngay_batdau = '$ngay_bat_dau',
                        ngay_ketthuc = '$ngay_ket_thuc',
                        sanpham_id = $id_sp";
            $res_km = mysqli_query($conn, $sql_km);


            //Kiểm tra có được thêm hay không
            //4. Chuyển hướng và thông báo
            if ($res2 == true) {
                //Chèn thành công
                $_SESSION['add'] = "<div class='success'>Thêm sản phẩm thành công.</div>";
                header('location: ' . SITEURL . 'admin/manager-agricultural.php');
            } else {
                //Chèn thất bại
                $_SESSION['add'] = "<div class='error'>Thêm sản phẩm thất bại.</div>";
                header('location: ' . SITEURL . 'admin/add-agricultural.php');
            }
        }
        ?>
    </div>
</div>

<?php
include('partials/footer.php');
ob_end_flush();
?>