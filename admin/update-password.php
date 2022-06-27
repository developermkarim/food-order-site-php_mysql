<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $update_id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php ecHO $update_id ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php
 if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);

                $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'";
                $result = mysqli_query($conn,$sql);
                if ($result == TRUE) {
                   
                    $COUNT = mysqli_num_rows($result);
                    if ($COUNT == 1) {
                        
                        if ($new_password == $confirm_password) {
                            
                            $update_sql = "UPDATE tbl_admin set password='$new_password' where id=$id";
                            $updateQuery = mysqli_query($conn, $update_sql);
                            if ($updateQuery == true) {
                               //Display Succes Message
                                //REdirect to Manage Admin Page with Success Message
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                //Redirect the User
                                header('location:manage-admin.php');
                            }else{
                                    //Display Error Message
                                //REdirect to Manage Admin Page with Error Message
                                $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                                //Redirect the User
                                header('location: manage-admin.php');
                            }
                        }
                        else{

                             //REdirect to Manage Admin Page with Error Message
                             $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Patch. </div>";
                             //Redirect the User
                             header('location:manage-admin.php');

                        }
                    }
                    else{
                        //User Does not Exist Set Message and REdirect
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                        //Redirect the User
                        header('location: manage-admin.php');
                    }
                }
  }
?>


<?php include('partials/footer.php'); ?>