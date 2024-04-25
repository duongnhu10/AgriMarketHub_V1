<?php include('partials/menu.php') ?>

<!-- Bắt đầu nội dung chính -->
<div class="main-content">

    <div class="wrapper">

        <h1>BẢNG ĐIỀU KHIỂN</h1>
        <br><br>

        <?php
        if (isset($_SESSION['Login'])) {
            echo $_SESSION['Login'];
            unset($_SESSION['Login']);
        }
        ?>

        <br><br>

        <div class="col-4 text-center">

            <?php
            //SQL để lấy thông tin bảng loại sản phẩm
            $sql = "SELECT * FROM loai_san_pham";
            //Chạy SQL
            $res = mysqli_query($conn, $sql);
            //Đếm số dòng
            $count = mysqli_num_rows($res);
            ?>

            <h1><?php echo $count; ?></h1>

            <br>
            LOẠI SẢN PHẨM
        </div>

        <div class="col-4 text-center">

            <?php
            //SQL
            $sql2 = "SELECT * FROM san_pham";
            //Chạy SQL
            $res2 = mysqli_query($conn, $sql2);
            //Đếm số dòng
            $count2 = mysqli_num_rows($res2);
            ?>

            <h1><?php echo $count2; ?></h1>
            <br>

            SẢN PHẨM
        </div>

        <div class="col-4 text-center">

            <?php
            //SQL
            $sql3 = "SELECT * FROM don_hang";
            //Chạy SQL
            $res3 = mysqli_query($conn, $sql3);
            //Đếm số dòng
            $count3 = mysqli_num_rows($res3);
            ?>

            <h1><?php echo $count3; ?></h1>
            <br>

            TỔNG ĐƠN HÀNG
        </div>

        <div class="col-4 text-center">

            <?php
            //SQL để thống kê tổng doanh thu
            $sql4 = "SELECT SUM(tong_tien) AS tong_tien FROM don_hang WHERE trang_thai = 'Đã giao hàng'";

            //Chạy SQL
            $res4 = mysqli_query($conn, $sql4);

            //Lấy giá trị
            $row4 = mysqli_fetch_assoc($res4);

            //Lấy tổng tiền
            $doanh_thu =  str_replace(',', ' ', number_format($row4['tong_tien']));

            ?>

            <h1><?php echo $doanh_thu; ?> VND</h1>
            <br>

            DOANH THU
        </div>

        <div class="clearfix">
        </div>

    </div>
</div>
<!-- Kết thúc nội dung chính -->

<?php include('partials/footer.php') ?>