<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            
                <?php
                $sql = "SELECT * FROM tbl_food where active = 'Yes'";
                $query = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($query);
                if ($count > 0) {
                    while($row = mysqli_fetch_array($query)){
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
                    <img src="<?php echo SITEURL; ?>/images/foods/<?php echo $image ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title ?></h4>
                    <p class="food-price">$ <?php echo $price ?></p>
                    <p class="food-detail">
                       <?php echo $description ?>
                    </p>
                    <br>

                    <?php
$status_query = mysqli_query($conn, "SELECT * from tbl_order where food = '$title'");
if (mysqli_num_rows($status_query) > 0) {
$statusRow = mysqli_fetch_assoc($status_query);
$_SESSION['status'] = $statusRow['status'];
$_SESSION['qty'] = $statusRow['qty'];

}
?>

                    <a href="<?php echo SITEURL; ?>/order.php?id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                    <span style="background-color:green;color:white;font-weight:600;padding: 1% 2%;border: none;font-size: 1rem;border-radius: 5px;">
                        <?php echo $_SESSION['status'];?></span> <span style="background-color:red;color:white;font-weight:600; padding:1% 2%;border: none;font-size: 1rem;border-radius: 5px;"> <?php echo $_SESSION['qty']; ?> </span>
                   
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