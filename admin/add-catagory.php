<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
         if (isset($_SESSION['no-add-catagory'])) {
            echO $_SESSION['no-add-catagory'];
            unset($_SESSION['no-add-catagory']);
         }
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Add CAtegory Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>
<?php include("partials/footer.php");

 if (isset($_POST['submit'])) {
    
    $catagoryName = $_POST['title'];

    // Radio Button get this value
     if (isset($_POST['featured'])) {
        $feature = $_POST['featured'];
      }else{
        $feature = "NO";
      }
      // active Radio Button
       if (isset($_POST['active'])) {
          $active = $_POST['active'];
        }
        else{
            $active = "NO";
        }

        if ($catagoryName == "" or !isset($_POST['active']) or $feature == ""){
           $_SESSION['no-add-catagory'] = "<div class='error'>Plz, Insert the catagory products </div>";
        }
        else{

            $sql = "INSERT INTO tbl_catagory SET
            title='$catagoryName', featured='$feature', 
            active='$active'
            ";
            $query = mysqli_query($conn, $sql);
            if ($query == true) {
                
               $_SESSION['add'] = "<div class='success'>Catagory added into table. </div>";
            }
        }
  }
?>