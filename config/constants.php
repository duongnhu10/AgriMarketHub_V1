<?php
//3. Execute Query and Save Data in Database
//Create Constants to Store Non Repeting values
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'agrimarkethub');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD); //Database Connection

if ($conn->connect_error) { // Check connection
    die("Connection failed: " . $conn->connect_error);
}

$db_select = mysqli_select_db($conn, DB_NAME); //Selecting Database

if (!$db_select) { // Check connection
    die("Database selection failed: " . mysqli_error($conn));
}
