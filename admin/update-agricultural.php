<?php include('partials/menu.php');
ob_start();


?>

<?php
//Check whether id is set or not
if (isset($_GET['id'])) {
    //Get all the details
    $id = $_GET['id'];

    //SQL Query to Get the Selected Food
    $sql2 = "SELECT * FROM san_pham WHERE id=$id;";
    //Execute the Query
    $res2 = mysqli_query($conn, $sql2);

    //Get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);

    //Ge the Individual values of Selected Food
    $ten_san_pham = $row2['ten_san_pham'];
    $mo_ta = $row2['mo_ta'];
    $gia_goc = $row2['gia_goc'];
    $gia = $row2['gia'];
    $gia_dn = $row2['gia_dn'];
    $gia_khuyen_mai = $row2['gia_khuyen_mai'];
    $ton_kho = $row2['ton_kho'];

    $sql_km = "SELECT * FROM khuyen_mai WHERE sanpham_id=$id";
    $res_km = mysqli_query($conn, $sql_km);

    if ($res_km) {
        $row_km = mysqli_fetch_assoc($res_km);
        if ($row_km) {
            // Dữ liệu được trả về từ truy vấn
            $ngay_batdau = isset($row_km['ngay_batdau']) ? $row_km['ngay_batdau'] : "0000-00-00";
            $ngay_ketthuc = isset($row_km['ngay_ketthuc']) ? $row_km['ngay_ketthuc'] : "0000-00-00";
        } else {
            // Không có dữ liệu từ truy vấn
            $ngay_batdau = "0000-00-00";
            $ngay_ketthuc = "0000-00-00";
        }
    } else {
        // Lỗi khi thực hiện truy vấn
        $ngay_batdau = "0000-00-00";
        $ngay_ketthuc = "0000-00-00";
    }



    $current_image = $row2['anh'];
    $loai_san_pham = $row2['loai_id'];
    $trang_thai = $row2['trang_thai'];
    $ton_kho = $row2['ton_kho'];
} else {
    //Redirect to Manage Food
    header('location:' . SITEURL . 'admin/manager-agricultural.php');
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>CẬP NHẬT SẢN PHẨM</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Tên sản phẩm:</td>
                    <td>
                        <input type="text" name="ten_san_pham" placeholder="Tên sản phẩm" value="<?php echo $ten_san_pham; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Mô tả:</td>
                    <td>
                        <textarea cols="30" rows="5" name="mo_ta" placeholder="Mô tả sản phẩm"><?php echo $mo_ta; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Giá gốc/Kg:</td>
                    <td>
                        <input type="number" name="gia_goc" value="<?php echo $gia_goc; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Giá hiện tại/Kg:</td>
                    <td>
                        <input type="number" name="gia" value="<?php echo $gia; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Giá doanh nghiệp/Kg:</td>
                    <td>
                        <input type="number" name="gia_dn" value="<?php echo $gia_dn; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Khuyến mãi (%):</td>
                    <td>
                        <input type="number" name="gia_khuyen_mai" value="<?php echo $gia_khuyen_mai; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Ngày bắt đầu:</td>
                    <td>
                        <input type="text" name="ngay_bat_dau" placeholder="yyyy-mm-dd" value="<?php echo $ngay_batdau; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Ngày kết thúc:</td>
                    <td>
                        <input type="text" name="ngay_ket_thuc" placeholder="yyyy-mm-dd" value="<?php echo $ngay_ketthuc; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh hiện tại:</td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            //Image not Avialable
                            echo "<div class='error'>Không có hình ảnh.</div>";
                        } else {
                            //Image Available
                        ?>
                            <img width="150px" src="<?php echo SITEURL; ?>images/agricultural/<?php echo $current_image; ?>">
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
                    <td>Loại sản phẩm:</td>
                    <td>
                        <select name="loai_san_pham">
                            <?php
                            //Create PHP code to display categories from Database 
                            //1. Create SQL to get all categories form database
                            $sql = "SELECT * FROM loai_san_pham WHERE trang_thai = 'Còn hàng'";

                            //Executing query
                            $res = mysqli_query($conn, $sql);

                            //Count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            //IF count is greater than zero, we have categories else we do not have categories
                            if ($count > 0) {
                                //We have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //Get the details of categories
                                    $id1 = $row['id'];
                                    $ten_loai = $row['ten_loai'];

                            ?>

                                    <option <?php if ($loai_san_pham == $id1) {
                                                echo "selected";
                                            } ?> value="<?php echo $id1 ?>"><?php echo $ten_loai ?></option>
                                    <!-- echo "<option value='$id1'>$ten_loai</option>; -->

                                <?php
                                }
                            } else {
                                //We do not have category
                                ?>

                                <option value="0">Không có loại sản phẩm</option>

                            <?php
                            }

                            //2. Display on Dropdown
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Trạng thái:</td>
                    <td>
                        <input <?php if ($trang_thai == "Hết hàng") {
                                    echo "checked";
                                } ?> type="radio" name="trang_thai" value="Hết hàng">Hết hàng
                        <input <?php if ($trang_thai == "Còn hàng") {
                                    echo "checked";
                                } ?> type="radio" name="trang_thai" value="Còn hàng">Còn hàng
                    </td>
                </tr>


                <tr>
                    <td>Tồn kho/kg:</td>
                    <td>
                        <input type="number" name="ton_kho" value="<?php echo $ton_kho; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input class="btn-secondary" type="submit" name="submit" value="Cập nhật sản phẩm">
                    </td>
                </tr>

            </table>

        </form>

        <?php

        if (isset($_POST['submit'])) {
            // echo "Clicked";

            //1. Get the Data from Form
            // $id = $_POST['id'];
            $ten_san_pham = $_POST['ten_san_pham'];
            $mo_ta = $_POST['mo_ta'];
            $gia_goc = $_POST['gia_goc']; //Giá nhập
            $gia = $_POST['gia']; //Giá hiện tại
            $gia_dn = $_POST['gia_dn']; //Giá bán cho doanh nghiệp
            $gia_khuyen_mai = $_POST['gia_khuyen_mai']; //Phần trăm khuyến mãi


            $ngay_bat_dau = date('Y-m-d', strtotime($_POST['ngay_bat_dau']));
            $ngay_ket_thuc = date('Y-m-d', strtotime($_POST['ngay_ket_thuc']));

            $current_image = $_POST['current_image'];
            $loai_san_pham = $_POST['loai_san_pham'];

            $trang_thai = $_POST['trang_thai'];
            $ton_kho = $_POST['ton_kho'];

            //2. Upload the Image if selected
            //Check whether the select image is clicked or not
            if (isset($_FILES['anh']['name'])) {
                //Get the details of the selected image 
                $ten_anh = $_FILES['anh']['name'];

                //Check whether the Image is Selected or not and upload the Image only if selected 
                if ($ten_anh != "") {
                    //Image is Available
                    //A. Upload new image
                    //Get the extension of selected image (jpn, png...)
                    // $ext = end(explode('.', $ten_anh));
                    $ten_anh_parts = explode('.', $ten_anh);
                    $ext = end($ten_anh_parts);


                    //Create New Image for Image
                    $ten_anh = "Nong_San_" . rand(0000, 9999) . "." . $ext;

                    //Get the src path and destination path

                    //Sourse path is the current location of the image
                    $src_path = $_FILES['anh']['tmp_name']; //Source Path

                    //Destination path for the image to be uploaded
                    $dest_path = "../images/agricultural/" . $ten_anh;

                    //Finally upload the food image
                    $upload = move_uploaded_file($src_path, $dest_path);
                    // sleep(1);

                    //Check whether image uplaoded or not
                    if ($upload == false) {
                        //Failed to upload the image
                        //Redirect to Add Food Page with Error Message
                        $_SESSION['upload'] = "<div class='error'>Tải hình ảnh thất bại.</div>";
                        header('location:' . SITEURL . 'admin/manager-agricultural.php');
                        //Stop the process
                        die();
                    }

                    //3. Remove the image if new image is uploaded and current image exists
                    //B. Remove current Image if Available
                    if ($current_image != "") {
                        //Current Image is Available
                        //REmove the image
                        $remove_path = "../images/agricultural/" . $current_image;

                        $remove = unlink($remove_path);

                        //Check whether the image is removed or not
                        if ($remove == false) {
                            //Failed to remove current image
                            $_SESSION['remove-failed'] = "<div class='error'>Xóa hình ảnh hiện tại thất bại.</div>";
                            //Redirect to Manager food
                            header('location:' . SITEURL . 'admin/manager-agricultural.php');
                            //Stop the Process
                            die();
                        }
                    }
                } else {
                    $ten_anh = $current_image; //Default Image when image is not selected
                }
            } else {
                $ten_anh = $current_image; //Default image when button is not clicked
            }

            //4. Update the Food in Database
            $sql3 = "UPDATE san_pham SET
            ten_san_pham = '$ten_san_pham',
            mo_ta = '$mo_ta',
            gia_goc = $gia_goc,
            gia = $gia,
            gia_dn = $gia_dn,
            gia_khuyen_mai = $gia_khuyen_mai,
            
            anh = '$ten_anh',
            loai_id = '$loai_san_pham',
            trang_thai = '$trang_thai',
            ton_kho = $ton_kho
            WHERE id=$id
        ";


            //Execute the SQL Query
            $res3 = mysqli_query($conn, $sql3);

            $sql_km = "INSERT INTO khuyen_mai SET 
            ngay_batdau = '$ngay_bat_dau',
            ngay_ketthuc = '$ngay_ket_thuc',
            sanpham_id = $id";
            $res_km = mysqli_query($conn, $sql_km);


            //Check whether the query is executed or not
            if ($res3 == true) {
                //Query Executed and Food updated
                $_SESSION['update'] = "<div class='success'>Cập nhật sản phẩm thành công.</div>";
                header('location:' . SITEURL . 'admin/manager-agricultural.php');
            } else {
                //Failed to Upadte Food
                $_SESSION['update'] = "<div class='error'>Cập nhật sản phẩm thất bại.</div>";
                header('location:' . SITEURL . 'admin/manager-agricultural.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php');
ob_end_flush(); ?>