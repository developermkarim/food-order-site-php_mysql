<?php include('partials/menu.php');
$update_id = $_GET['id'];
if (isset($update_id)) {
    $sql = "select * from tbl_admin where id ='$update_id'";
    $sqlQUery = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($sqlQUery)){
        $fullName = $row[1];
        $userName = $row[2];
        
    }
}
?>



<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name" value="<?php echo $fullName ?>" >
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username" value="<?php echo $userName ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>
<?php if (isset($_SESSION['emptyImput'])) {
    echo $_SESSION['emptyImput'];
 } ?>
<?php include('partials/footer.php') ?>

<?php 
  // Process the Value from Form and Save it in Database

    // Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $full_name = trim($_POST['full_name']);
        $username = trim($_POST['username']);
      //Password Encryption with MD5

        if (!isset($full_name) or $full_name == "" or !isset($username) or $username == "") {
           
            $_SESSION['update'] = "All fields must be inserted";
            // header('location:'.SITEURL.'admin/add-admin.php');
        }
          else{
            $update_sql = "UPDATE tbl_admin SET full_name='$full_name', username='$username' where id='$update_id'";
            $update_query = mysqli_query($conn,$update_sql);
             if ($update_query == TRUE){
                $_SESSION['update'] = "<div class='success'>successfully Updated Data</div>";
                header('location:manage-admin.php');
              }else{
                $_SESSION['update'] = "<div class='error'>Sorry, Updated Data</div>";
                header('location:manage-admin.php');
              }
          }
}

?>