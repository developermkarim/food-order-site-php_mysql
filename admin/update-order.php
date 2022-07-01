<?php include('partials/menu.php'); ?>

<?php
 if (isset($_GET['id'])) {
    $get_id = $_GET['id'];
    $get_sql= "SELECT * FROM tbl_order where id=$get_id";
    $get_query = mysqli_query($conn, $get_sql);
    $getCount = mysqli_num_rows($get_query);
    if ($getCount > 0) {
       $Getrow = mysqli_fetch_array($get_query);
       $id = $Getrow['id'];
       $food = $Getrow['food'];
       $price = $Getrow['price'];
       $qty = $Getrow['qty'];
       $total = $Getrow['total'];
       $order_date = $Getrow['order_date'];
       $status = $Getrow['status'];
       $customer_name = $Getrow['customer_name'];
       $customer_contact = $Getrow['customer_contact'];
       $customer_email = $Getrow['customer_email'];
       $customer_address = $Getrow['customer_address'];
       }
    }
       
  
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
         
            <h2 class="text-center text-white">Update order.</h2>

            <table>

            <form action="" class="order" method="POST">

                <tr>
                    <td>Food Name</td>
                    <td><?php echo $food; ?></td>
                </tr>
                <tr>
                    <td>Food Price</td>
                <td>$<input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Food Quantity</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>Total Price</td>
                    <td>$<?php echo $total; ?></td>
                </tr>

                <tr>
           <td>Update the Status</td> 
           <td><select name="status" id="">
               <option value="Delivered" <?php if($status=="Delivered"){ echo "selected";}?> >Delivered</option> 
               <option value="Ordered" <?php if($status=="Ordered")echo "selected"; ?> >Ordered</option>
               <option value="On Delivery" <?php if($status=="On Delivery")echo "selected"; ?>>ON Delivery</option>
               <option value="Cancelled" <?php if($status=="Cancelled")echo "selected" ?>>Cancelled</option>
            </select>
            </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="hidden_id" value="<?php echo $id;?>">
                        <input type="hidden" name="hidden_price" value="<?php echo $price;?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
                
          
               

            </form>

            </table>
    <?php
     if (isset($_POST['submit'])) {
        // $food = $_POST['food'];
        $quantity = $_POST['qty'];
        $update_id = $_POST['hidden_id'];
        $update_price = $_POST['hidden_price'];
        $totalPrice = $quantity *  $update_price;
        $order_date = date("Y-m-d h:i:sa"); //Order DAte date("Y-m-d h:i:sa");
        $status = $_POST['status'];  // Ordered, On Delivery, Delivered, Cancelled
        $customer_name = $_POST['customer_name'];
        $customer_contact = $_POST['customer_contact'];
        $customer_email = $_POST['customer_email'];
        $customer_address = $_POST['customer_address'];


        //Save the Order in Databaase
        //Create SQL to save the data
            $sql =  "UPDATE tbl_order SET 
            qty = $qty,
            total = $total,
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
            WHERE id=$id
        ";
                    $query = mysqli_query($conn, $sql);
                    if ($query == true) {
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }else{
                          //Failed to Save Order
                          $_SESSION['no-order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                          header('location:'.SITEURL.'admin/manage-order.php');
                    }
      }
    ?>



</div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <?php include('partials/footer.php'); ?>