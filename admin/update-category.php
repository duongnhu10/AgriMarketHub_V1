<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>CẬP NHẬT LOẠI SẢN PHẨM</h1>

        <br><br>

        <?php
        //Check whether the id is set or not
        if (isset($_GET['id'])) {
            //Get the ID and all other details
            // echo "Getting the data";
            $id = $_GET['id'];
            //Create SQL QUery to get all other details
            $sql = "SELECT * FROM loai_san_pham WHERE id=$id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count the Rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //Get all the data
                $row = mysqli_fetch_assoc($res);
                $ten_loai = $row['ten_loai'];
                $current_image = $row['anh'];
                $trang_thai = $row['trang_thai'];
            } else {
                //Redirect to manager category page with session message
                $_SESSION['no-category-found'] = "<div class='error'>Không tìm thấy loại sản phẩm.</div>";
                header('location:' . SITEURL . 'admin/manager-category.php');
            }
        } else {
            //Redirect to Manager Category
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
                            //Display the image
                        ?>
                            <img width="150px" src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>">
                        <?php
                        } else {
                            //Display Message
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
                    <td>
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
            //1. Get all the values from our form
            $id = $_POST['id'];
            $ten_loai = $_POST['ten_loai'];
            $current_image = $_POST['current_image'];
            $trang_thai = $_POST['trang_thai'];

            //2. Updating new image if selected
            //Check whether the image is selected or not
            if (isset($_FILES['anh']['name'])) {
                //Get the Image Details
                $anh = $_FILES['anh']['name'];

                //Check whether the image is available or not
                if ($anh != "") {
                    //Image Available 

                    //A. Upload the new image
                    //Auto rename our image
                    //Get the Extension of our image (png, jpg) EX: haisamabc678.jpg
                    $ext = end(explode('.', $anh));

                    //Rename the image Ex: Loai_NongSan_192.jpg
                    $anh = "Loai_NongSan_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['anh']['tmp_name'];

                    $destination_path = "../images/category/" . $anh;

                    //Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Check whether the image is uploaded or not
                    //And if the image is not upload then we will stop the process and redirect with error message
                    if ($upload == false) {
                        //Set message
                        $_SESSION['upload'] = "<div class='error'>Tải hình ảnh thất bại.</div>";
                        //Redirect to Manager category page
                        header('location:' . SITEURL . 'admin/manager-category.php');
                        //Stop the Process
                        die();
                    }

                    //B. Remove the curent Image if available
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;

                        $remove = unlink($remove_path);

                        //Check whether the image is removed or not
                        //If failed to remove then display message and stop the process
                        if ($remove == false) {
                            //Failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Xóa hình ảnh hiện tại thất bại.</div>";
                            header('location:' . SITEURL . 'admin/manager-category.php');
                            die(); //Stop the Process
                        }
                    }
                } else {
                    $anh = $current_image;
                }
            } else {
                $anh = $current_image;
            }

            //3. Update the Database
            $sql2 = "UPDATE loai_san_pham SET 
                    ten_loai='$ten_loai', 
                    anh = '$anh',
                    trang_thai = '$trang_thai'
                    WHERE id=$id
            ";

            //Execiute the Query
            $res2 = mysqli_query($conn, $sql2);

            //4. Redirect to Manage Category with Message
            //Check whether executed or not
            if ($res2 == true) {
                //Category Updated
                $_SESSION['update'] = "<div class='success'>Cập nhật loại sản phẩm thành công.</div>";
                header('location:' . SITEURL . 'admin/manager-category.php');
            } else {
                //Failed to update category
                $_SESSION['update'] = "<div class='error'>Cập nhật loại sản phẩm thất bại.</div>";
                header('location:' . SITEURL . 'admin/manager-category.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>