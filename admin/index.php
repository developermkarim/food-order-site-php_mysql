<?php
include("partials/menu.php");
?>

  <!-- Main Content Section Starts -->
  <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>
              
                <br><br>

                <div class="col-4 text-center">

                <?php
                $query = mysqli_query($conn, "SELECT * FROM `tbl_category`");
                $count = mysqli_num_rows($query);
                ?>
                  

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Categories
                </div>

                <div class="col-4 text-center">

                    <h1><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tbl_food`")); ?></h1>
                    <br />
                    Foods
                </div>

                <div class="col-4 text-center">
                    
                   

                    <h1><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_order")) ?></h1>
                    <br />
                    Total Orders
                </div>

                <div class="col-4 text-center">
                    
                  <?php
                   $sql = "SELECT sum(total) as TOTAL FROM tbl_order WHERE status ='delivered'";
                   $query2 = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($query2);
                    $total = $row['TOTAL'];
                  ?>


                    <h1><?php echo $total; ?></h1>
                    <br />
                    Revenue Generated
                </div>

                <div class="clearfix">
                    
                </div>

            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php
include("partials/footer.php");
?>