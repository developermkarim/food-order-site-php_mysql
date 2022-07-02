<?php include('partials-front/menu.php');
include('user-reg-log/login-check.php');
?>

<?php
 if (isset($_GET['id'])) {
    $get_id = $_GET['id'];
    $get_sql= "SELECT * FROM tbl_food where id=$get_id";
    $get_query = mysqli_query($conn, $get_sql);
    $getCount = mysqli_num_rows($get_query);
    if ($getCount > 0) {
       $Getrow = mysqli_fetch_array($get_query);
        $id =  $Getrow['id'];
        $title = $Getrow['title'];
        $description = $Getrow['description'];
        $price = $Getrow['price'];
        $image = $Getrow['image_name'];
       }
       else{
        header('location:'.SITEURL);
       }
    }else{
        header('location:'.SITEURL);
    }
  
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            <?php
            if(isset($_SESSION['no-order'])){
                echo $_SESSION['no-order'];
                unset($_SESSION['no-order']);
            }
            
            ?>

            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>


            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="<?php echo SITEURL; ?>/images/foods/<?php echo $image; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" value="<?php echo $title; ?>" name="food">
                        <p class="food-price">$ <?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price ?>">
                        <div class="order-label">Quantity</div>
                      
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

    <?php
     if (isset($_POST['submit'])) {
        $food = $_POST['food'];
        $quantity = $_POST['qty'];
        $insertprice = $_POST['price'];
        $totalPrice = $quantity * $insertprice;
        $order_date = date("Y-m-d h:i:sa"); //Order DAte date("Y-m-d h:i:sa");
        $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

        $customer_name = $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];


        //Save the Order in Databaase
        //Create SQL to save the data
             $sql = "INSERT INTO tbl_order SET 
                       food = '$food',
                        price = $insertprice,
                        qty = $quantity,
                        total = $totalPrice,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";
                //    echo $sql , die(); it is check for data insert check.
                    $query = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($query);
                    if ($query == true) {

                        $_SESSION['order'] = "<div class='success text-center'>$customer_name Ordered the food Successfully.</div>";
                       
                        header('location:'.SITEURL);
                    }else{
                          //Failed to Save Order
                          $_SESSION['no-order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                          header('location:'.SITEURL);
                    }
      }
    ?>


</div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>