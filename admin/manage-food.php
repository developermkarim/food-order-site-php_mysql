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
                                $title = $row['title'];
                                $price = $row['price'];
                                $image = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                            }
                        }
                    }
                    ?>
                    <tr>
                        <td><?php echo $SLNo++; ?></td>
                        <td><?php echO $title; ?></td>

                        <td>
                            <?php 
                            if ($image != "") {
                                
                            
                            ?>
                            <img src="<?php echO SITEURL; ?>images/foods/<?php echO $image; ?>" alt="Image From Database">
                            <?php 
                            }
                            else{
                                $_SESSION['not-found'] = "<div class='success'>Images not found</div>";
                            }
                            ?>
                        </td>

                        <td><?php echO $featured; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                <tr>
                    <td>1</td>
                    <td>Mahmodul Karim</td>
                    <td>DeveloperMkarim</td>
                    <td>
                        <a href="#" class="btn-secondary"> Update Admin</a>
                        <a href="#" class="btn-danger"> Delete Admin</a>
                    </td>
                </tr>
            </table>
    </div>
</div>

<?php include("partials/footer.php"); ?>