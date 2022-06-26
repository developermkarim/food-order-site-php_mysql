<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <?php if(isset($_SESSION['add'])){echo $_SESSION['add']; unset($_SESSION['add']);} ?>
        <br><br>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
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
        $password = trim(md5($_POST['password'])); //Password Encryption with MD5

        if (!isset($full_name) or $full_name == "" or !isset($username) or $username == "" or !isset($password) or $password == "") {
           
            $_SESSION['emptyImput'] = "All fields must be inserted";
            // header('location:'.SITEURL.'admin/add-admin.php');
        }else{

            $selectQuery = "select username , password from tbl_admin where username = '$username' and password = '$password'";
            $query =  mysqli_query($conn, $selectQuery);
            $rowResult = mysqli_fetch_assoc($query);
               
            if ($username == $rowResult['username'] or $password == md5($rowResult['password'])) {
               
                $_SESSION['add'] = "Username or Password is already exists";
            }else{

                   //2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_admin SET full_name ='$full_name',
        username='$username',
        password='$password'
    ";
    $db_insert = mysqli_query($conn,$sql) or die(mysqli_errno($conn));
    if ($db_insert == TRUE) {

        $_SESSION['add'] = "successfully admin added";
        header('location:manage-admin.php');
    }else{
      
        $_SESSION['add'] = "sorry add admin is failed";
        header('location:add-admin.php');
    }
         }
            }
          
       
}

?>