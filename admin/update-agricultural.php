<?php include('partials/menu.php'); ?>

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
    $gia_khuyen_mai = $row2['gia_khuyen_mai'];
    $current_image = $row2['anh'];
    $loai_san_pham = $row2['loai_id'];
    $trang_thai = $row2['trang_thai'];
} else {
    //Redirect to Mnage Food
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
                    <td>Giá gốc:</td>
                    <td>
                        <input type="number" name="gia_goc" value="<?php echo $gia_goc; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Giá hiện tại:</td>
                    <td>
                        <input type="number" name="gia" value="<?php echo $gia; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Giá khuyến mãi:</td>
                    <td>
                        <input type="number" name="gia_khuyen_mai" value="<?php echo $gia_khuyen_mai; ?>">
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
                        <input type="file" name="anh">;
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

                                    <option <?php if ($loai_san_pham == $id) {
                                                echo "selected";
                                            } ?> value="<?php echo $id ?>"><?php echo $ten_loai ?></option>
                                    <!-- echo "<option value='$id'>$ten_loai</option>; -->

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
                    <td colspan="2">
                        <input class="btn-secondary" type="submit" name="submit" value="Cập nhật sản phẩm">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>