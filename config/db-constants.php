<?php 
define('SITEURL','http://localhost/PORJECTS-FOR-JOB/FOOD-ORDER-WEBSITE/');
define('DB_HOST','localhost');
define('DB_NAME','food_order_website');
define('DB_PASSWORD','');
define('DB_USER','root');

$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(mysqli_errno($conn));
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_errno($conn));

?>