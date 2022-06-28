<?php include("../config/constants.php");

// get id and image from manage catagory
if (isset($_GET['id']) AND isset($_GET['image_name'])) {
    
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != ""){
       
    $path = "../images/catagory/".$image_name;
    $remove = unlink($path);
    if($remove == false) {
       
        $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
        die();
    }
}
    
    $sql = "DELETE FROM tbl_catagory WHERE id =$id";
    $query = mysqli_query($conn, $sql);
    if ($query == true) {
       
         //SEt Success MEssage and REdirect
        $_SESSION['delete'] = "<div class='success'> Deleted Category .</div>";
        header('location:'.SITEURL.'admin/manage-category.php');

    }else{

         //SEt Fail MEssage and Redirecs
         $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
         //Redirect to Manage Category
         header('location:'.SITEURL.'admin/manage-category.php');
    }
}
else{
        //redirect to Manage Category Page
        header('location:'.SITEURL.'admin/manage-category.php');
}

?>

