<?php
include('partials/menu.php');
$search = mysqli_real_escape_string($conn, $_POST['search']); //Loại trừ sql injection
?>

<!-- Bắt đầu nội dung chính -->
<div class="main-content">

    <div class="wrapper">

        <h1>DANH MỤC LOẠI SẢN PHẨM</h1>
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

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }

        ?>

        <br><br>
        <!-- Nút thêm loại sản phẩm -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Thêm loại sản phẩm</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>STT</th>
                <th>Tên loại</th>
                <th>Hình ảnh</th>
                <th>Trạng thái</th>
                <th>Số sản phẩm</th>
                <th>Hành động</th>
            </tr>

            <?php

            //SQL lấy dữ liệu từ bảng loại sản phẩm
            $sql = "SELECT * FROM loai_san_pham WHERE ten_loai LIKE '%$search%'";

            //Chạy SQL
            $res = mysqli_query($conn, $sql);

            //Đếm số dòng
            $count = mysqli_num_rows($res);

            //Tạo biến STT
            $sn = 1;

            //Kiểm tra có dữ liệu trong database hay không
            if ($count > 0) {
                //Có dữ liệu
                //Lấy dữ liệu và hiển thị
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $ten_loai = $row['ten_loai'];
                    $anh = $row['anh'];
                    $trang_thai = $row['trang_thai'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>

                        <td><?php echo $ten_loai; ?></td>

                        <td>
                            <?php
                            //Kiểm tra ảnh có tồn tại hay không
                            if ($anh != "") {
                                //Hiển thị hình ảnh
                            ?>
                                <img width="150px" src="<?php echo SITEURL; ?>images/category/<?php echo $anh ?>">
                            <?php
                            } else {
                                //Hiển thị thông báo
                                echo "<div class='error'>Hình ảnh không được thêm.</div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $trang_thai; ?></td>

                        <td>
                            <?php
                            $sql_dem = "SELECT * FROM san_pham WHERE loai_id = $id";
                            $res_dem = mysqli_query($conn, $sql_dem);
                            $row_dem = mysqli_num_rows($res_dem);
                            echo $row_dem;
                            ?>
                        </td>

                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật loại sản phẩm</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&anh=<?php echo $anh ?>" class="btn-danger">Xóa loại sản phẩm</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                //Không có dữ liệu
                //Hiển thị thông báo trong bảng
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
<!-- Kết thúc nội dung chính -->

<?php include('partials/footer.php') ?>