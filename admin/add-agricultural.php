<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>THÊM SẢN PHẨM</h1>

        <br><br><br>

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
            $ten_san_pham = $_POST['$ten_san_pham'];
            $mo_ta = $_POST['mo_ta'];
            $gia = $_POST['gia'];

            //2. Upload the Image if selected

            //3. Insert Into Database

            //4. Redirect with Message to Manager Agricultural Page

        }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>