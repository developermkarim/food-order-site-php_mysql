<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                          <?php
                         
                                //Create PHP Code to display categories from Database
                                //1. CReate SQL to get all active categories from database
                             // Food includes in many catagories. To show the active food this query
                             $select_yes_query = "SELECT * FROM tbl_category WHERE active='Yes'";
                             $result = mysqli_query($conn, $select_yes_query);
                       
                                $count = mysqli_num_rows($result);
                                if ($count > 0) {
                                    
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id = $row['id'];
                                        $catagory = $row['title'];
    
                                    }
                                    ?>
                                    
                                    <option value="<?php echo $id; ?>"><?php echo $catagory; ?></option>

                                    <?php
                                }
                            else{
                               
                           ?>
                           <option value="0">No Cataory available</option>
                         <?php
                            }
                         ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
         //CHeck whether the button is clicked or not
         if(isset($_POST['submit']))
         {
             //Add the Food in Database
             //echo "Clicked";
             
             //1. Get the DAta from Form
             $title = $_POST['title'];
             $description = $_POST['description'];
             $price = $_POST['price'];
             $category = $_POST['category'];

             //Check whether radion button for featured and active are checked or not
              if (isset($_POST['featured'])) {
                 $featured = $_POST['featured'];
               }else{
                $featured = "No";
               }
                if (isset($_POST['active'])) {
                   $active = $_POST['active'];
                 }else{
                    $active = "No";
                 }

                 if (isset($_FILES['image'])) {
                    
                    $image_name = $_FILES['image']['name'];
                    if ($image_name != "") {
                       
                        $path = "../images/foods".$image_name;
                        $extension = end(explode(',',$image_name));
                        $image_name = "Food-Image-".rand(000,999).".".$extension;
                        $tempName = $_FILES['image']['tmp_name'];
                        $upload = move_uploaded_file($tempName,$path);
                        if ($upload == false) {
                            
                            $_SESSION['upload'] = "<div class='error'>Sorry, Food Image not uploaded</div>";
                        }else{
                            
                        }
                    }
                    else{
                        $_SESSION['image-mo-found'] = "<div class='success'>Sorry, Image not found</div>";
                    }
                 }else{
                    $image_name = "";
                 }

                 //3. Insert Into Database

                //Create a SQL Query to Save or Add food
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
             /*    $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                "; */

                 
                 $food_sql = "INSERT INTO tbl_food SET 
                title = '$title',
                description = '$description',
                price = '$price', image_name = '$image_name',
                category_id = $category,
                 featured = '$featured',
                 active = '$active'
                 ";
                 $query = mysqli_query($conn,$food_sql);
                 if ($query == true) {
                   $_SESSION['upload'] = "<div class='success'>Data Successfullly uploaded</div>";
                 }else{
                    $_SESSION['error'] = "<div class='success'>Data Successfullly uploaded</div>";
                 }
         }
        ?>
        
         
<!-- 
            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Food in Database
                //echo "Clicked";
                
                //1. Get the DAta from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether radion button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //SEtting the Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting Default Value
                }

                //2. Upload the Image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check Whether the Image is Selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        // Image is SElected
                        //A. REnamge the Image
                        //Get the extension of selected image (jpg, png, gif, etc.) "vijay-thapa.jpg" vijay-thapa jpg
                        $ext = end(explode('.', $image_name));

                        // Create New Name for Image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; //New Image Name May Be "Food-Name-657.jpg"

                        //B. Upload the Image
                        //Get the Src Path and DEstinaton path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        //Finally Uppload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded of not
                        if($upload==false)
                        {
                            //Failed to Upload the image
                            //REdirect to Add Food Page with Error Message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //STop the process
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; //SEtting DEfault Value as blank
                }

                //3. Insert Into Database

                //Create a SQL Query to Save or Add food
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage Food page
                if($res2 == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //FAiled to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            } -->

    


    </div>
</div>

<?php include('partials/footer.php'); ?>