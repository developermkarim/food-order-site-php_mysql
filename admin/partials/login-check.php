<?php 

 //AUthorization - Access COntrol
    //CHeck whether the user is logged in or not

if (!isset($_SESSION['user']) or $_SESSION['user'] == "") { //IF user session is not set

       // User is not logged in
        //REdirect to login page with message 
    $_SESSION['not-login-message'] ="<div class='error text-center'>Please login to access Admin Panel.</div>";
    // Redirect to login page

    header('location:'.SITEURL.'admin/login.php');
}
?>

     