<?php include('partials-font/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL ?>agricultural-search.php?session_user=<?php echo $_SESSION['user']; ?>" method="POST">
            <input type="search" name="search" placeholder="Tìm kiếm sản phẩm.." required>
            <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">SẢN PHẨM</h2>


        <?php

        //Getting Foods from Database that are active 
        //SQL Query
        $sql2 = "SELECT * FROM san_pham WHERE trang_thai = 'Còn hàng'";

        //Execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //COunt Rows
        $count2 = mysqli_num_rows($res2);

        //Check whether food available or not
        if ($count2 > 0) {
            //Food available
            while ($row = mysqli_fetch_assoc($res2)) {
                //Get all the values
                $id = $row['id'];
                $ten_san_pham = $row['ten_san_pham'];
                $gia = $row['gia'];
                $gia_khuyen_mai = $row['gia_khuyen_mai'];
                $mo_ta = $row['mo_ta'];
                $anh = $row['anh'];
        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //Check whether image available or not
                        if ($anh == "") {
                            //Image not Available
                            echo "<div class='error'>Không có hình ảnh.</div>";
                        } else {
                            //Image Available
                        ?>
                            <img height="130px" src="<?php echo SITEURL; ?>images/agricultural/<?php echo $anh; ?>" alt="" class="img-responsive img-curve">
                        <?php
                        }
                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $ten_san_pham; ?></h4>
                        <p class="food-price">
                            <?php

                            if ($gia_khuyen_mai != 0) {
                                echo "<i style='text-decoration-line: line-through;'>" . str_replace(',', ' ', number_format($gia)) . " VND/Kg <br></i>";
                                $gia_km = $gia - $gia_khuyen_mai * 0.01 * $gia;
                                echo "<i class='red'>" . str_replace(',', ' ', number_format($gia_km)) . " VND/Kg</i>";
                            } else {
                                echo "<i>" . str_replace(',', ' ', number_format($gia)) . " VND/Kg <br></i>";
                            }

                            ?>
                        </p>
                        <p class="food-detail">
                            <?php echo $mo_ta; ?>
                        </p>
                        <br>

                        <?php
                        $so = 1;
                        ?>

                        <a href="<?php echo SITEURL; ?>order.php?spham_id=<?php echo $id; ?>&so=<?php echo $so; ?>&session_user=<?php echo $_SESSION['user']; ?>" class="btn btn-primary">Đặt hàng</a>
                        <a href="#" onclick="addToCart(<?php echo $id; ?>)" class="btn btn-primary">Thêm vào giỏ hàng</a>

                        <script>
                            function addToCart(productId) {
                                // Tạo một yêu cầu XMLHttpRequest
                                var xhttp = new XMLHttpRequest();

                                // Thiết lập hàm xử lý sự kiện khi yêu cầu hoàn thành
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        // Xử lý phản hồi từ máy chủ (nếu cần)
                                        alert("Đã thêm sản phẩm vào giỏ hàng!");
                                    }
                                };

                                // Tạo một yêu cầu GET đến trang add-to-cart.php với id sản phẩm và session user
                                xhttp.open("GET", "<?php echo SITEURL; ?>add-to-cart.php?spham_id=" + productId + "&session_user=<?php echo $_SESSION['user']; ?>", true);
                                xhttp.send();

                                // Ngăn chặn hành động mặc định của thẻ <a>
                                return false;
                            }
                        </script>

                    </div>
                </div>

        <?php
            }
        } else {
            //Food not available
            echo "<div class='error'>Không có sản phẩm.</div>";
        }

        ?>

        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-font/footer.php'); ?>