<?php 
session_start();
define('SITEURL','http://localhost/FOOD-ORDER-WEBSITE/');
define('DB_HOST','localhost');
define('DB_NAME','food_order_website');
define('DB_PASSWORD','');
define('DB_USER','root');

$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die(mysqli_errno($conn));
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_errno($conn));

?>