<?php include('config/constants.php');
include('login-check.php') ?>

<!DOCTYPE html>
<html lang="en">


<?php
$sql = "SELECT * FROM gio_hang";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
?>

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nông sản</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>index.php" title="Logo">
                    <img height="60px" width="20px" src="images/index/logo1.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>index.php">TRANG CHỦ</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">LOẠI SẢN PHẨM</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>agricultural.php">SẢN PHẨM</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>tracking-order.php">ĐƠN HÀNG</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">LIÊN HỆ</a>
                    </li>


                    <li>
                        <a href="<?php echo SITEURL; ?>cart.php" class="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-quantity"><?php echo $count; ?></span>
                        </a>
                    </li>


                    <span class="dropdown">
                        <li><a class="dropbtn"><i class="fas fa-user fa-lg"></i></a></li>

                        <div id="myDropdown" class="dropdown-content">

                            <li><a href="<?php echo SITEURL; ?>infor.php?session_user=<?php echo $_SESSION['user']; ?>">THÔNG TIN</a></li>

                            <li> <a href=" <?php echo SITEURL; ?>logout.php">
                                    ĐĂNG XUẤT
                                </a></li>

                        </div>
                    </span>

                </ul>
            </div>

            <div class=" clearfix">
            </div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->