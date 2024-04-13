<?php include('partials/menu.php'); ?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">LOẠI SẢN PHẨM</h2>

        <?php
        //Create SQL Query to Display Categories from Database
        $sql = "SELECT * FROM loai_san_pham WHERE trang_thai = 'Còn hàng'";
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        //Count rows to check whether the category is available or not 
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //Categories Available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the value like id, title, image_name
                $id = $row['id'];
                $ten_loai = $row['ten_loai'];
                $anh = $row['anh'];
        ?>
                <a href="<?php echo SITEURL; ?>guest/category-agricultural.php?loai_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //Check whether Image is available or not
                        if ($anh == "") {
                            //Display Message
                            echo "<div class='error'>Hình ảnh không tìm thấy.</div>";
                        } else {
                            //Image Available
                        ?>
                            <img height="450px" src="<?php echo SITEURL; ?>images/category/<?php echo $anh; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $ten_loai; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            //Categories not Available
            echo "<div class='error'>Loại sản phẩm trống.</div>";
        }

        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('partials/footer.php'); ?>