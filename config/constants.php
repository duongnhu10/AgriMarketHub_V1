<?php
//Bắt đầu phiên
session_start();

//Tạo các hằng
define('SITEURL', 'http://localhost:3000/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ns_v2');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD); //Kết nối database

if ($conn->connect_error) { //Kiểm tra kết nối
    die("Connection failed: " . $conn->connect_error);
}

$db_select = mysqli_select_db($conn, DB_NAME); //Chọn database

if (!$db_select) { //Kiểm tra kết nối
    die("Database selection failed: " . mysqli_error($conn));
}
