<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
    <h3>Manage Catagory</h3>
    <br> <br>

    <a class="btn-primary" href="add-catagory.php">Add Catagory</a>
<br><br>
<?php 
if(isset($_SESSION['remove'])){
    echo $_SESSION['remove'];
    unset($_SESSION['remove']);
}
if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
?>
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
                            $image_name = $row[2];
                ?>
                <tr>
                    <td><?php echo $SLNO++ ?></td>
                    <td><?php echo $row[1] ?></td>
                    <td>
                        <?php 
                        if ($image_name != "") {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/catagory/<?php echo $image_name ?>" width="50px" height="40px" alt="">
                        <?php }else echo "<div class='error'>Image not Added.</div>"; ?>
                    </td>

                    <td><?php echo $row[3] ?></td>
                    <td><?php echo $row[4] ?></td>
                
                    <td>
                        <a href="<?php echo SITEURL; ?>admin/update-catagory.php?id=<?php echo $row[0] ?>" class="btn-secondary"> Update Admin</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-catagory.php?id=<?php echo $row[0];?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete Admin</a>
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