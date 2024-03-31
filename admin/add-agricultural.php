<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>THÊM SẢN PHẨM</h1>

        <br><br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

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
                    <td>Giá gốc:</td>
                    <td>
                        <input type="number" name="gia_goc">
                    </td>
                </tr>

                <tr>
                    <td>Giá hiện tại:</td>
                    <td>
                        <input type="number" name="gia">
                    </td>
                </tr>

                <tr>
                    <td>Giá khuyến mãi:</td>
                    <td>
                        <input type="number" name="gia_khuyen_mai">
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
                                    $id = $row['id'];
                                    $ten_loai = $row['ten_loai'];

                            ?>

                                    <option value="<?php echo $id ?>"><?php echo $ten_loai ?></option>

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
                        <input type="radio" name="trang_thai" value="Hết hàng">Hết hàng
                        <input type="radio" name="trang_thai" value="Còn hàng">Còn hàng
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
        //Check whether the button is clicked or not
        if (isset($_POST['submit'])) {
            //Add products
            // echo "Clicked";

            //1. Get the Data from Form
            $ten_san_pham = $_POST['ten_san_pham'];
            $mo_ta = $_POST['mo_ta'];
            $gia_goc = $_POST['gia_goc']; //Giá nhập
            $gia = $_POST['gia']; //Giá hiện tại
            $gia_khuyen_mai = $_POST['gia_khuyen_mai']; //Phần trăm khuyến mãi
            $loai_san_pham = $_POST['loai_san_pham'];

            //Check whether radio button for active is checked or not
            if (isset($_POST['trang_thai'])) {
                $trang_thai = $_POST['trang_thai'];
            } else {
                $trang_thai = "Hết hàng"; //Setting the default value
            }

            //2. Upload the Image if selected
            //Check whether the select image is clicked or not
            if (isset($_FILES['anh']['name'])) {
                //Get the details of the selected image 
                $ten_anh = $_FILES['anh']['name'];

                //Check whether the Image is Selected or not and upload the Image only if selected 
                if ($ten_anh != "") {
                    //Image is selected 
                    //A. Rename the Image
                    //Get the extension of selected image (jpn, png...)
                    $ext = end(explode('.', $ten_anh));

                    //Create New Image for Image
                    $ten_anh = "Nong_San_" . rand(0000, 9999) . "." . $ext;

                    //B. Upload the Image
                    //Get the src path and destination path

                    //Sourse path is the current location of the image
                    $src = $_FILES['anh']['tmp_name'];

                    //Destination path for the image to be uploaded
                    $dst = "../images/agricultural/" . $ten_anh;

                    //Finally upload the food image
                    $upload = move_uploaded_file($src, $dst);

                    //Check whether image uplaoded or not
                    if ($upload == false) {
                        //Failed to upload the image
                        //Redirect to Add Food Page with Error Message
                        $_SESSION['upload'] = "<div class='error'>Tải hình ảnh thất bại.</div>";
                        header('location:' . SITEURL . 'admin/add-agricultural.php');
                        //Stop the process
                        die();
                    }
                }
            } else {
                $ten_anh = ""; //Setting default value as blank 
            }

            //3. Insert Into Database

            //Create a SQL Query to Save or Add food
            //For Numberrical we do not need to pass value inside quotes ''. String value add ''
            $sql2 = "INSERT INTO san_pham SET
                ten_san_pham = '$ten_san_pham',
                mo_ta = '$mo_ta',
                gia_goc = $gia_goc,
                gia = $gia,
                gia_khuyen_mai = $gia_khuyen_mai,
                anh = '$ten_anh',
                loai_id = $loai_san_pham,
                trang_thai = '$trang_thai'
            ";

            //Execute the Query 
            $res2 = mysqli_query($conn, $sql2);

            //Check whether add inserted or not 
            //4. Redirect with Message to Manager Food page
            if ($res2 == true) {
                //Query inserted Successfully
                $_SESSION['add'] = "<div class='success'>Thêm sản phẩm thành công.</div>";
                header('location: ' . SITEURL . 'admin/manager-agricultural.php');
            } else {
                //Fail to Add agricultural
                $_SESSION['add'] = "<div class='error'>Thêm sản phẩm thất bại.</div>";
                header('location: ' . SITEURL . 'admin/add-agricultural.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>