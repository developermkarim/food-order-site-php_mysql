<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
    <h3>Manage Food</h3>
    <br> <br>

    <a class="btn-primary" href="add-food.php">Add Food</a>
<br><br>
<?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['fail-remove']))
            {
                echo $_SESSION['fail-remove'];
                unset($_SESSION['fail-remove']);
            }
            if(isset($_SESSION['no-upload']))
            {
                echo $_SESSION['no-upload'];
                unset($_SESSION['no-upload']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['remove-food-id']))
            {
                echo $_SESSION['remove-food-id'];
                unset($_SESSION['remove-food-id']);
            }
            if(isset($_SESSION['remove-food-img']))
            {
                echo $_SESSION['remove-food-img'];
                unset($_SESSION['remove-food-img']);
            }
        ?>
            <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    
                    <?php 
                    $select_sql = "SELECT * FROM tbl_food";
                    $query = mysqli_query($conn,$select_sql);
                    if ($query == true) {
                        $SLNo = 1;
                       $count = mysqli_num_rows($query);
                        if ($count > 0) {
                            
                            while($row = mysqli_fetch_assoc($query)){
                                $id =  $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                     
                    ?>
                    <tr>
                        <td><?php echo $SLNo++; ?></td>
                        <td><?php echO $title; ?></td>
                        <td><?php echO $price; ?></td>

                        <td>
                            <?php 
                            if ($image != "") {
                                
                            
                            ?>
                            <img src="<?php echO SITEURL; ?>images/foods/<?php echO $image; ?>" alt="unseen Image" width="60" height="50">
                            <?php 
                            }
                            else{
                                echo "<div class='success'>Images not found</div>";
                            }
                            ?>
                        </td>

                        <td><?php echO $featured; ?></td>
                        <td><?php ecHO $active; ?></td>
                        <td>
                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Admin</a>
                        <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id ?>&image_name=<?php echo $image; ?>" class="btn-danger"> Delete Admin</a>
                        </td>
                  
                </tr>
                <?php
                       }
                    }
                }
                ?>

            </table>
    </div>
</div>

<?php include("partials/footer.php"); ?>