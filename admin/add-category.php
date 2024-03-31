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

        <!-- Add Category Form Starts -->
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
        <!-- Add Category Form Ends -->

        <?php
        //Check whether the Submit Button is Clicked or Not
        if (isset($_POST['submit'])) {
            // echo "Clicked";

            //1. Get the value form category Form
            $ten_loai = $_POST['ten_loai'];

            //For Radio input, we need to check whether the buuton is selected
            if (isset($_POST['trang_thai'])) {
                //Get the value from form
                $trang_thai = $_POST['trang_thai'];
            } else {
                //Set default value
                $trang_thai = 'Hết hàng';
            }

            //Check whether the image is selected or not and set the value for image name accordingly
            //print_r($_FILES['anh']);

            //die(); //Break the code here

            if (isset($_FILES['anh']['name'])) {
                //Upload the image
                //To upload image we need image image name, source path and destination path
                $ten_anh = $_FILES['anh']['name'];

                //Upload the image only if image is selected
                if ($ten_anh != "") {
                    //Auto rename our image
                    //Get the Extension of our image (png, jpg) EX: haisamabc678.jpg
                    $ext = end(explode('.', $ten_anh));

                    //Rename the image Ex: Loai_NongSan_192.jpg
                    $ten_anh = "Loai_NongSan_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['anh']['tmp_name'];

                    $destination_path = "../images/category/" . $ten_anh;

                    //Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Check whether the image is uploaded or not
                    //And if the image is not upload then we will stop the process and redirect with error message
                    if ($upload == false) {
                        //Set message
                        $_SESSION['upload'] = "<div class='error'>Tải hình ảnh thất bại.</div>";
                        //Redirect to Add category page
                        header('location:' . SITEURL . 'admin/add-category.php');
                        //Stop the Process
                        die();
                    }
                }
            } else {
                //Don't upload image and set the image_name value as blank
                $ten_anh = "";
            }

            //2. Create SQL Query to Insert category into Database
            $sql = "INSERT INTO loai_san_pham SET
            ten_loai='$ten_loai', 
            anh = '$ten_anh',
            trang_thai='$trang_thai'
            ";

            //3. Execute the Query and Save in Database
            $res = mysqli_query($conn, $sql);

            //4. Check whether the query executed or not and Data addes or not
            if ($res == true) {
                //Query Executed and Category Added
                $_SESSION['add'] = "<div class='success'>Thêm loại sản phẩm thành công.</div>";
                //Redirect to Manage Category page
                header('location: ' . SITEURL . 'admin/manager-category.php');
            } else {
                //Fail to Add Category
                $_SESSION['add'] = "<div class='error'>Thêm loại sản phẩm thất bại.</div>";
                //Redirect to Manage Category page
                header('location: ' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>