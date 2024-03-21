<?php
//Start Session
session_start();

//Create Constants to Store Non Repeting values
define('SITEURL', 'http://localhost:3000/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ns_v2');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD); //Database Connection

if ($conn->connect_error) { // Check connection
    die("Connection failed: " . $conn->connect_error);
}

$db_select = mysqli_select_db($conn, DB_NAME); //Selecting Database

if (!$db_select) { // Check connection
    die("Database selection failed: " . mysqli_error($conn));
}
