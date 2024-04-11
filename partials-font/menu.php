<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

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
                        <a href="#">LIÊN HỆ</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>cart.php"><i class="fas fa-shopping-cart"></i></a>

                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->