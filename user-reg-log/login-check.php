<?php
session_start();
 if (!isset($_SESSION['user-name']) or empty($_SESSION['user-id']) == "") {
    $_SESSION['login-check'] = "<div class='error text-center'>Please login to access order confirm.</div>";
 
 // Redirect to login page
 header('location:user-reg-log/login.php');

 }

?>