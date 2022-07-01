<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
            $search = mysqli_real_escape_string($conn,$_POST['search']);

            ?>

            <h2>Foods on Your Search <a href="foods.php" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql = "SELECT * FROM tbl_food WHERE title like '%$search%' or description like '%$search%'";
            $query  = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($query);
            if ($count > 0) {
                while($row = mysqli_fetch_array($query)) {
                                $food_id =  $row['id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $image = $row['image_name'];
                                $featured = $row['featured'];
             
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
                       <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>/order.php?id=<?php echo $food_id ?>" class="btn btn-primary">Order Now</a>
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

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>