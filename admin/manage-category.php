<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
    <h3>Manage Catagory</h3>
    <br> <br>

    <a class="btn-primary" href="add-catagory.php">Add Catagory</a>
<br><br>
<table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Catagory Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php 
                $sql = "select * from tbl_catagory";
                $query = mysqli_query($conn,$sql);
                if ($query == true) {
                   
                    $SLNO = 1;

                    $count = mysqli_num_rows($query);
                    if ($count > 0) {
                        
                        while($row = mysqli_fetch_array($query)){
                  
                ?>
                <tr>
                    <td><?php echo $SLNO++ ?></td>
                    <td><?php echo $row[1] ?></td>
                    <td>
                        <?php 
                        if ($row[2] != "") {
                        ?>
                        <img src="<?php echo SITEURL ?>images/catagory/<?php echo $row[2] ?>" width="50px" height="40px" alt="">
                        <?php }else echo "<div class='error'>Image not Added.</div>"; ?>
                    </td>

                    <td><?php echo $row[3] ?></td>
                    <td><?php echo $row[4] ?></td>
                
                    <td>
                        <a href="<?php echo SITEURL ?>update-catagory.php?id=<?php echo $row[0] ?>" class="btn-secondary"> Update Admin</a>
                        <a href="<?php echo SITEURL ?>delete-catagory.php?id=<?php echo $row[0] ?>&<?php $row[2]; ?>" class="btn-danger"> Delete Admin</a>
                    </td>
                </tr>
                <?php 
                          
                        }
                    }
                }
                ?>
            </table>
    </div>
</div>

<?php include("partials/footer.php"); ?>