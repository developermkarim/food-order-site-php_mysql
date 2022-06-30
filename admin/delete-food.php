<?php
 //Include Constants File
 include('../config/constants.php');

 //echo "Delete Page";
 //Check whether the id and image_name value is set or not
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    
    $id = $_GET['id'];
    $image = $_GET['image_name'];
 
    if ($image != "") {
        
        $remove  = unlink('../images/foods/'.$image);
        if ($remove == false) {
            //Set the SEssion Message
            $_SESSION['remove-food-img'] = "<div class='error'>Failed to Remove food Image.</div>";
            //REdirect to Manage Category page
            header('location:'.SITEURL.'admin/manage-food.php');
            //Stop the Process
            die();
        }
    }

    $sql = "delete from tbl_food where id = $id";
    $query = mysqli_query($conn, $sql);
    if ($query == true) {
        
         //Set the SEssion Message
         $_SESSION['remove-food-id'] = "<div class='error'>Successfully deleted the food row.</div>";
         //REdirect to Manage Category page
         header('location:'.SITEURL.'admin/manage-food.php');
         //Stop the Process
         die();
    }
}
?>