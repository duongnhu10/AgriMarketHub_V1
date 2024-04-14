<?php include('partials-font/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <?php
        //Get the Search Keyword
        //$search = $_POST['search'];
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        ?>

        <h2>CÁC SẢN PHẨM CHO TỪ KHÓA <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">SẢN PHẨM</h2>

        <?php

        //SQL Query to Get foods based on search keyword
        //$search = burger'; DROP database name;
        //"SELECT * FROM san_pham WHERE ten_san_pham LIKE '%$burger'%' OR mo_ta LIKE '%$burger%'";
        $sql = "SELECT * FROM san_pham WHERE ten_san_pham LIKE '%$search%'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Count Rows
        $count = mysqli_num_rows($res);

        //Check whether food available or not
        if ($count > 0) {
            //Food Available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the details
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
            echo "<div class='error'>Không tìm thấy sản phẩm.</div>";
        }

        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-font/footer.php'); ?>