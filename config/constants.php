<?php
ob_start();
session_start();
define('SITEURL','http://localhost/food-order/');

define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

    $con=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); //database connection
    $db_select=mysqli_select_db($con,DB_NAME) or die(mysqli_error()); //selecting database

?>