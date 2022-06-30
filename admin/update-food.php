<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <?php 
           if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $select_sql = "SELECT * FROM tbl_food WHERE id=$id";
            $query = mysqli_query($conn,$select_sql);
            if ($query == true) {
                
                    $row = mysqli_fetch_assoc($query);
                                $food_id =  $row['id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $image = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                }
                
            }
           
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="23" rows="2" placeholder="Description of the Food."><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: &nbsp; &nbsp; $</td>
                    <td>
                     <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <?php
                        if ($image != "") {
                            
                        
                        ?>
                        <img src="<?php echo SITEURL; ?>/images/foods/<?php  echo $image; ?>" alt="" alt="unseen Image" width="60" height="50">
                        <?php
                        }else{
                            echo "No image Found";
                        }
                        ?>
                    </td>
                    
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            $catagory_sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $catagory_query = mysqli_query($conn, $catagory_sql);
                            $catagory_count = mysqli_num_rows($catagory_query);
                            if ($catagory_count > 0) {
                               while ($cataogry_result = mysqli_fetch_assoc($catagory_query)) {
                               $catagory_id = $cataogry_result['id'];
                               $catagory_name = $cataogry_result['title'];
                              
                            ?>
                        <option  value="<?php echo $catagory_id; ?>"><?php echo $catagory_name ?> </option>
                         <?php
                          }
                        }
                         ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" <?php if($featured=="Yes"){echo "checked";} ?> name="featured" value="Yes"> Yes 
                        <input type="radio" <?php if($featured=="No"){echo "checked";} ?> name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" <?php if($active=="Yes"){echo "checked";} ?> name="active" value="Yes"> Yes 
                        <input type="radio" <?php if($active="No"){echo "checked";} ?> name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $image; ?>">
                        <input type="hidden" name="hidden_id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        if(isset($_POST['submit']))
         {
            // Add the Food in Database
             
             //1. Get the DAta from Form
            $current_image = $_POST['current_image'];
             $update_id = $_POST['hidden_id'];
             $update_title = $_POST['title'];
             $Update_description = $_POST['description'];
             $update_price = $_POST['price'];
             $update_category = $_POST['category'];
             $update_featured = $_POST['featured'];
             $update_active = $_POST['active'];

             if (isset($_FILES['image'])) {
                
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    
                    // $extension = end(explode('.',$image_name));
                    // $image_name = 'food-'.rand(0000,9999).'.'.$extension;
                    // $destination = $_FILES['image']['tmp_name'];
                    // $folder_path = "../images/foods/".$image_name;
                    // $upload = move_uploaded_file($destination,$folder_path);
                     //IMage is Available
                        //A. Uploading New Image

                        //REname the Image
                        // $ext = end(explode('.', $image_name)); //Gets the extension of the image
                        $ext = explode('.',$image_name);
                        $image_name = "update-food-".rand(0000, 9999).'.'.end($ext); //THis will be renamed image

                        //Get the Source Path and DEstination PAth
                        $src_path = $_FILES['image']['tmp_name']; //Source Path
                        $dest_path = "../images/foods/".$image_name; //DEstination Path

                        //Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);
                    if ($upload == false) {
                        $_SESSION['no-upload'] = "<div class='error'>Sorry, Food Image not uploaded in folder</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();
                    }
             
                // Current Image to remove from folder.
                if ($current_image != "") {
            
                $path = "../images/foods/".$current_image;
                $remove = unlink($path);
                if ($remove == false) {
                    
                    $_SESSION['fail-remove'] = "<div class='error'>Sorry, Food Image not deleted</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    die();

                }
            }
                
            }else{
                $image_name = $current_image;
            } 
             }
             else{
                $image_name = $current_image;
             }
             // Update sql here
             $update_sql = "UPDATE tbl_food SET 
             title='$update_title',description='$Update_description',
             price='$update_price',image_name='$image_name',
             category_id=$update_category,featured='$update_featured',
             active='$update_active' WHERE id=$update_id
             ";
             $update_query = mysqli_query($conn,$update_sql);
             if ($update_query == true) {
                $_SESSION['update'] = "<div class='success'> all Data successfully Updated</div>";
                die();
             }
         }
        
        ?>
        
    </div>
</div>

<?php include('partials/footer.php'); ?>