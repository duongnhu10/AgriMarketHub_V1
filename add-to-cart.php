<?php include('config/constants.php') ?>
<?php
//Check whether food id is set or not
if (isset($_GET['spham_id'])) {

    //Get the Food id and details of the selected food
    $spham_id = $_GET['spham_id'];

    //Get the details of the selected food
    $sql = "SELECT * FROM san_pham WHERE id=$spham_id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);
    //Count the rows
    $count = mysqli_num_rows($res);
    //Check whether the data is available or not
    if ($count == 1) {
        //We have data
        $row = mysqli_fetch_assoc($res);
        $ten_san_pham = $row['ten_san_pham'];
        $gia = $row['gia'];
        $gia_khuyen_mai = $row['gia_khuyen_mai'];
        $anh = $row['anh'];

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $sql_check = "SELECT * FROM gio_hang WHERE ten_san_pham = '$ten_san_pham'";
        $res_check = mysqli_query($conn, $sql_check);
        $count_check = mysqli_num_rows($res_check);

        if ($count_check > 0) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng của nó
            $sql_update = "UPDATE gio_hang SET so_luong = so_luong + 1 WHERE ten_san_pham = '$ten_san_pham'";
            $res_update = mysqli_query($conn, $sql_update);
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm nó vào
            $sql_insert = "INSERT INTO gio_hang SET 
                        ten_san_pham = '$ten_san_pham',
                        gia = $gia,
                        gia_khuyen_mai = $gia_khuyen_mai,
                        anh = '$anh',
                        so_luong = 1,
                        san_pham_id = '$spham_id'";
            $res_insert = mysqli_query($conn, $sql_insert);
        }
    } else {
        //Food not available
        //Redirect to Home page
        header('location:' . SITEURL);
    }
} else {
    //Redirect to homepage
    header('location:' . SITEURL);
}
