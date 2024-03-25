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
                        <input type="text" name="ten_loai" value="">
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh hiện tại: </td>
                    <td>
                        Image will be displayed here
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
                        <input type="radio" name="trang_thai" value="Còn hàng"> Còn hàng
                        <input type="radio" name="trang_thai" value="Hết hàng"> Hết hàng
                    </td>
                </tr>

                <tr>
                    <td>
                        <input class="btn-secondary" type="submit" name="submit" value="Cập nhật">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>