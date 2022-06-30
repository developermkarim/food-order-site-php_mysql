 
   <?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Catagory Food For you</h2>

            <?php 
            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            if($count > 0){
                
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
              
            ?>
            <a href="<?php echo SITEURL; ?>category-foods.php?id=<?php echo $id; ?>">
             <div class="box-3 float-container">
                <?php 
                if ($image_name != "") {
                   
                
                ?>
                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                     
                <?php 
                }
                else{
                    echo "Image No Found";
                }
                ?>
                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>

           
            
            <?php 
                }
                
            }else{
                echo "No category found";
            }
            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>