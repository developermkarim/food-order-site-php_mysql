<?php include('partials-front/menu.php');?>


<!-- This is for status starting  -->
<!-- This is for status End  -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>/food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
             if (isset($_SESSION['order'])) {
                echo $_SESSION['order'];
                unset($_SESSION['order']);
              }
            ?>
            <?php
            $sql = "SELECT * FROM tbl_category where active='Yes' and featured=-'Yes' limit 6";
            $query = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($query);
            if ($count > 0) {
                while ($row = mysqli_fetch_array($query)) {
                   $image = $row[2];
                   $id  = $row[0];
                   $title = $row[1];
               
            ?>
            <a href="category-foods.php?id=<?php echo $id; ?>">
            <div class="box-3 float-container">
                <?php
                if ($image != "") {
                   
               
                ?>
                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image; ?>" alt="Pizza" class="img-responsive img-curve" width="200" height="200">
                    <?php
                }else{
                    echo "No Image FOund";
                }
                    ?>
                <h3 class="float-text" style="color: black;"><?php echo $title; ?></h3>
            </div>
            </a>
                <?php
                }
            }
                ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php
             $food_sql = "SELECT * FROM tbl_food WHERE active='Yes' and featured='Yes' limit 6";
             $food_query = mysqli_query($conn, $food_sql);
             $count = mysqli_num_rows($food_query);
             if ($count > 0) {
                while($row = mysqli_fetch_array($food_query)){
                    $id =  $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
           
           <?php
$status_query = mysqli_query($conn, "SELECT * from tbl_order where food = '$title'");
if (mysqli_num_rows($status_query) > 0) {
$statusRow = mysqli_fetch_assoc($status_query);
$_SESSION['status'] = $statusRow['status'];
$_SESSION['qty'] = $statusRow['qty'];

}
?>
           <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    if ($image != "") {
                      
                    ?>
                    <img src="<?php echo SITEURL; ?>/images/foods/<?php echo $image ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php
                    }else{
                        echo "No Image Found Here";
                    }
                    ?>
                </div>
                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price">$ <?php echo $price; ?></p>
                    <p class="food-detail">
                       <?php echo $description; 
                       ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>/order.php?id=<?php echo $id ?>" class="btn btn-primary">Order Now</a> <span style="background-color:green;color:white;font-weight:600;padding: 1% 2%;border: none;font-size: 1rem;border-radius: 5px;">
                        <?php echo $_SESSION['status'];?></span> <span style="background-color:red;color:white;font-weight:600; padding:1% 2%;border: none;font-size: 1rem;border-radius: 5px;"> <?php echo $_SESSION['qty']; ?> </span>
                </div>
                </div>
                <?php
                   }
                        }else{
                            echo "No Food Found";
                        }
            ?>

           
            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>