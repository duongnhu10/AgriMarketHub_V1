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
            <h1>5</h1>
            <br>
            SẢN PHẨM
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            SẢN PHẨM
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            SẢN PHẨM
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            SẢN PHẨM
        </div>

        <div class="clearfix">
        </div>

    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>