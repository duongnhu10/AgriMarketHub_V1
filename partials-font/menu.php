<?php
include('config/constants.php');
include('login-check.php');
$session_user = ""; // Khởi tạo biến session_user

if (isset($_GET['session_user'])) {
    $session_user = $_GET['session_user']; // Lấy giá trị session_user từ URL nếu tồn tại
}

//Lấy thông tin khách hàng hiện đang đăng nhập hệ thống
$sql_s = "SELECT * FROM khach_hang WHERE ten_nguoi_dung='$session_user'";
$res_s = mysqli_query($conn, $sql_s);
$row_s = mysqli_fetch_assoc($res_s);
$count_s = mysqli_num_rows($res_s);
if ($count_s == 1) {
    //Có người dùng
    //Lấy id của người dùng đăng nhập
    $id_us = $row_s['id'];
} else {
    //Không có
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
//Lấy thông tin giỏ hàng của người dùng đang đăng nhập
$sql = "SELECT * FROM gio_hang WHERE user_id=$id_us";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nông sản</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Bắt đầu menu -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <!-- Chuyển hướng trang chủ đồng thời gửi session_user -->
                <a href="<?php echo SITEURL; ?>index.php?session_user=<?php echo $_SESSION['user']; ?>" title="Logo">
                    <img height="60px" width="20px" src="images/index/logo1.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <!-- Chuyển hướng trang chủ đồng thời gửi session_user -->
                        <a href="<?php echo SITEURL; ?>index.php?session_user=<?php echo $_SESSION['user']; ?>">TRANG CHỦ</a>
                    </li>
                    <li>
                        <!-- Chuyển hướng trang loại sản phẩm đồng thời gửi session_user -->
                        <a href="<?php echo SITEURL; ?>categories.php?session_user=<?php echo $_SESSION['user']; ?>">LOẠI SẢN PHẨM</a>
                    </li>
                    <li>
                        <!-- Chuyển hướng trang sản phẩm đồng thời gửi session_user -->
                        <a href="<?php echo SITEURL; ?>agricultural.php?session_user=<?php echo $_SESSION['user']; ?>">SẢN PHẨM</a>
                    </li>
                    <li>
                        <!-- Chuyển hướng trang đơn hàng đồng thời gửi session_user -->
                        <a href="<?php echo SITEURL; ?>tracking-order.php?session_user=<?php echo $_SESSION['user']; ?>">ĐƠN HÀNG</a>
                    </li>

                    <li>
                        <!-- Chuyển hướng trang giỏ hàng đồng thời gửi session_user -->
                        <a href="<?php echo SITEURL; ?>cart.php?session_user=<?php echo $_SESSION['user']; ?>" class="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <!-- Hiển thị số lượng -->
                            <span class="cart-quantity"><?php echo $count; ?></span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown">
                            <a href="#" class="dropbtn">
                                <?php
                                //Lấy thông tin người dùng đang đăng nhập
                                $sql = "SELECT * FROM khach_hang WHERE ten_nguoi_dung='" . $_SESSION['user'] . "'";
                                $res = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($res);
                                //Lấy ảnh đại diện
                                $anh = $row['anh'];
                                $doanh_nghiep = $row['doanh_nghiep'];
                                //Cập nhật ảnh đại diện đối với doanh nghiệp và cá nhân
                                if ($anh != "") {
                                    if ($doanh_nghiep == 1) {
                                        //Hiển thị ảnh doanh nghiệp
                                        echo "<img src='" . SITEURL . "images/avatar/$anh' style='max-width: 50px; max-height: 50px; border-radius: 50%; border: 10px solid yellow;'>";
                                    } else {
                                        //Hiển thị ảnh cá nhân
                                        echo "<img src='" . SITEURL . "images/avatar/$anh' style='max-width: 50px; max-height: 50px; border-radius: 50%;'>";
                                    }
                                } else {
                                    //Nếu không có ảnh đại diện hiển thị icon user
                                    echo "<i class='fas fa-user fa-lg'></i>";
                                }
                                ?>
                            </a>

                            <div id="myDropdown" class="dropdown-content">
                                <!-- Hiển thị thông tin đồng thời gửi session user -->
                                <a href="<?php echo SITEURL; ?>infor.php?session_user=<?php echo $_SESSION['user']; ?>">THÔNG TIN <i class="fas fa-question-circle fa-sm"></i></a>
                                <!-- Đổi mật khẩu đồng thời gủi session_user đi -->
                                <a href="<?php echo SITEURL; ?>update-password.php?session_user=<?php echo $_SESSION['user']; ?>">ĐỔI MẬT KHẨU</a>
                                <!-- Đăng xuất đồng thời gửi session_user -->
                                <a href="<?php echo SITEURL; ?>logout.php">ĐĂNG XUẤT <i class="fas fa-sign-out-alt"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>

        </div>
    </section>
    <!-- Kết thúc menu -->