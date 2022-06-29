<?php include('partials/menu.php'); ?>

<?php 
if (isset($_GET['id'])) {
    
    $id = $_GET['id'];

    $select_sql = "SELECT * FROM tbl_catagory WHERE id=$id";
    $selectquery = mysqli_query($conn,$select_sql);
    if($selectquery == true){
        while ($result = mysqli_fetch_array($selectquery)){
           
            $title = $result[1];
            $image = $result[2];
            $feature = $result[3];
            $active = $result[4];
            
        }
    }
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>


        <br><br>

        <!-- Add CAtegory Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;  ?>" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="<?php echo $feature;  ?>" value="Yes"> Yes 
                        <input type="radio" name="featured" value="<?php echo $active;  ?>" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>
<?php include("partials/footer.php");

 if (isset($_POST['submit'])) {
    
    $catagoryName = $_POST['title'];

    // Radio Button get this value
     if (isset($_POST['featured'])) {
        $feature = $_POST['featured'];
      }else{
        $feature = "NO";
      }
      // active Radio Button
       if (isset($_POST['active'])) {
          $active = $_POST['active'];
        }
        else{
            $active = "NO";
        }

        if (isset($_FILES['image']['name'])){
            
            $imageName = $_FILES['image']['name'];
            $fileType = $_FILES['image']['type'];
            $file_size = $_FILES['image']['size'];
            $temp_path = $_FILES['image']['tmp_name'];

            //another way to get path $filePath = end(explode(',',$imageName));
            $filePath = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
            $validExtension = array('jpg','png','webp','jpeg');
            $imageName = "catagory_".rand(000,999).".".$filePath;
            $destinationPath = "../images/catagory/".$imageName;
            if(in_array($filePath,$validExtension)){
               if ($file_size < 5000000) {
                move_uploaded_file($temp_path,$destinationPath);
               }
               else{
                $_SESSION['upload'] = "<div class='error'>file is too large</div>";
               }
            }
            else{
                $_SESSION['upload'] = "<div class='error'>only jgp, png, jpeg are supported</div>";
                exit;
            }
        }else{
            $imageName = "";
        }

       // Image Regular expression close here

         if ($catagoryName == "" or !isset($_POST['active']) or $feature == ""){
           $_SESSION['no-add-catagory'] = "<div class='error'>Plz, Insert the catagory products </div>";
        }
        else{

            $sql = "insert into tbl_catagory set 
            title='$catagoryName',image_name='$imageName', featured='$feature',active='$active'
            ";
            $res = mysqli_query($conn,$sql);
            if ($res == true) {
               $_SESSION['add'] = "<div class='success'>all data inserted </div>";
               header('location:'.SITEURL.'admin/manage-category.php');
            }else{
                $_SESSION['no-data-catagory'] = "<div class='error'>all data inserted </div>";
                header('location:'.SITEURL.'admin/add-catagory.php');
            }
        }

  }
?>