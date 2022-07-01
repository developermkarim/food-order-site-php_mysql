<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
    <h3>Manage Order</h3>
    <br> <br>
<br><br>
<table class="" border="1" cellpadding='3' cellspacing='40'  style="border-collapse: collapse; border: 3px solid purple;width:100%;">
                <tr>
                <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </tr>

                <tr>
                   <?php
                    $sql = "SELECT * FROM tbl_order";
                    $quey = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($quey);
                    $SLNO = 1;
                    if ($count > 0) {
                       while($row = mysqli_fetch_assoc($quey)){
                        //Get all the order details
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                      
                   ?>
                   <td><?php echo $SLNO++ ; ?></td>
                   <td><?php echo $food ; ?></td>
                   <td><?php echo $price ; ?></td>
                   <td><?php echo $qty ; ?></td>
                   <td><?php echo $total ; ?></td>
                   <td><?php echo $order_date ; ?></td>
                   <td><?php
                   if ($status == "Ordered") {
                    echo "<label class=''>$status</label>" ;
                   }elseif ($status == "On Delivery") {
                    echo "<label style='color: orange;'>$status</label>" ;
                   }elseif($status = "Delivered"){
                    echo "<label style='color: green;'>$status</label>" ;
                   }elseif($status == "Calcelled"){
                    echo "<label style='color: red;'>$status</label>" ;
                   }
                     ?></td>
                   <td><?php echo $customer_name ; ?></td>
                   <td><?php echo $customer_contact ; ?></td>
                   <td><?php echo $customer_email ; ?></td>
                   <td><?php echo ($customer_address)  ; ?></td>
                  
                        <td> <a href="updade-order.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Admin</a></td>
                       
                   
                </tr>
                <?php
                       }
                    }else{
                        echo "<tr><td>No Data Found From Order</td></tr>";
                    }
                ?>
            </table>
    </div>
</div>

<?php include("partials/footer.php"); ?>