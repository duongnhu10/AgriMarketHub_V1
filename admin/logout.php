<?php

include('../config/constants.php');

//1. Hủy phiên đăng nhập
session_destroy(); //Unset $_SESSION['user']

//2. Chuyển hướng đến trang đăng nhập
header('location:' . SITEURL . 'guest/index.php');
