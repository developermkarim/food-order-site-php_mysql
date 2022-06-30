
 <?php include('partials-front/menu.php'); ?>
 
<?php 
if (isset($_GET['id'])) {
    
    $category_id = $_GET['id'];

    $sql1 = "SELECT title from tbl_category where id=$category_id";
    $query1 = mysqli_query($conn,$sql1);
    if (mysqli_num_rows($query1)) {
        
        $rowres = mysqli_fetch_assoc($query1);
        $title = $rowres['title'];
    }
}

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="foods.php" class="text-white"><?php echo $title; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            $sql = "SELECT * FROM tbl_food WHERE category_id =$category_id";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) > 0) {
               
                while ($row = mysqli_fetch_array($query)) {
                    
                    $id = $row[0];
                    $title = $row[1];
                    $description = $row[2];
                    $price = $row[3];
                    $image = $row[4];
                    $category_id = $row[5];
                    $featured = $row[6];
                    $active = $row[7];

             
            ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                   <?php 
                   if ($image != "") {
                    
                   ?>
                    <img src="<?php echo SITEURL; ?>/images/foods/<?php echo $image; ?>" alt="Pizza" class="img-responsive img-curve">
                    <?php 
                   }else{
                    echo "No food image found";
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

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <?php 
                }
            }
            ?>

           
            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>