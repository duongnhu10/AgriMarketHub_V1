<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="main-content">

    <div class="wrapper">

        <h1>QUẢN LÝ LOẠI SẢN PHẨM</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        ?>

        <br><br>

        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Thêm loại sản phẩm</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>STT</th>
                <th>Tên loại</th>
                <th>Hình ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>

            <?php

            //Query to Get all catefories from Database
            $sql = "SELECT * FROM loai_san_pham";

            //Execute Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Create Serial Number Variable and assign value as 1
            $sn = 1;

            //Chcek whether we have data in databaase or not
            if ($count > 0) {
                //We have data in database
                //Get the data and display
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $ten_loai = $row['ten_loai'];
                    $anh = $row['anh'];
                    $trang_thai = $row['trang_thai'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $ten_loai; ?></td>

                        <td>

                            <?php
                            //Check whether image name is available or not
                            if ($anh != "") {
                                //Display the image
                            ?>

                                <img width="150px" src="<?php echo SITEURL; ?>images/category/<?php echo $anh ?>">

                            <?php
                            } else {
                                //Display the Message
                                echo "<div class='error'>Hình ảnh không được thêm.</div>";
                            }
                            ?>

                        </td>

                        <td><?php echo $trang_thai; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật loại sản phẩm</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&anh=<?php echo $anh ?>" class="btn-danger">Xóa loại sản phẩm</a>
                        </td>
                    </tr>

                <?php
                }
            } else {
                //We don't have data
                //We'll display the message inside table
                ?>

                <tr>
                    <td colspan="6">
                        <div class="error">Loại sản phẩm trống.</div>
                    </td>
                </tr>

            <?php
            }

            ?>

        </table>

    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>