<?php
//Include constant.php for SITEURL
include('config/constants.php');
//1. Destroy the Session
session_destroy(); //Unset $_SESSION['user']

//2. Redirect the Login page
header('location:' . SITEURL . 'guest/index.php');
