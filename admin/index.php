<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
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
            //Sql Query
            $sql = "SELECT * FROM loai_san_pham";
            //Execute Query
            $res = mysqli_query($conn, $sql);
            //Count rows
            $count = mysqli_num_rows($res);
            ?>

            <h1><?php echo $count; ?></h1>
            <br>
            LOẠI SẢN PHẨM
        </div>

        <div class="col-4 text-center">

            <?php
            //Sql Query
            $sql2 = "SELECT * FROM san_pham";
            //Execute Query
            $res2 = mysqli_query($conn, $sql2);
            //Count rows
            $count2 = mysqli_num_rows($res2);
            ?>

            <h1><?php echo $count2; ?></h1>
            <br>
            SẢN PHẨM
        </div>

        <div class="col-4 text-center">

            <?php
            //Sql Query
            $sql3 = "SELECT * FROM don_hang";
            //Execute Query
            $res3 = mysqli_query($conn, $sql3);
            //Count rows
            $count3 = mysqli_num_rows($res3);
            ?>

            <h1><?php echo $count3; ?></h1>
            <br>
            TỔNG ĐƠN HÀNG
        </div>

        <div class="col-4 text-center">

            <?php
            //Create SQL Query to Get total Revenue Generated
            //Aggregate Function in SQL
            $sql4 = "SELECT SUM(tong_tien) AS tong_tien FROM don_hang WHERE trang_thai = 'Đã giao hàng'";

            //Execute the Query
            $res4 = mysqli_query($conn, $sql4);

            //Get the value
            $row4 = mysqli_fetch_assoc($res4);

            //Get the total Revenue
            $doanh_thu = $row4['tong_tien'];

            ?>

            <h1><?php echo $doanh_thu; ?> VND</h1>
            <br>
            DOANH THU
        </div>

        <div class="clearfix">
        </div>

    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>