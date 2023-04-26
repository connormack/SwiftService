<?php include('partials/menu.php') ?>
    <!-- This is the main section -->
    <div class="main-content">
    <div class ="wrapper">
            <h1>Change Password</h1>
            <br>
            <br>

            <?php

            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }

            ?>

            <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name ="id" value="<?php echo $id ?>">
                        <input type="submit" name ="submit" value="Change Password" class ="btn-secondary" >
                    </td>
                </tr>
            </table>

            </form>

    </div>
    </div>

    <?php

            // check submit buttin is clicked
            if(isset($_POST['submit']))
            {

                // get data from form
                $id = $_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);

                // check user and id and current password exist 
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                //run query 
                $res = mysqli_query($conn, $sql);

                if($res == true)
                {
                    // check if data is avablble 
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        // user exists and password changed 
                        // echo "User found";

                        if($new_password==$confirm_password)
                        {
                            // update pasword
                             $sql2 = "UPDATE tbl_admin SET 
                             password='$new_password' 
                             WHERE id=$id
                         ";

                         //Execute the Query
                         $res2 = mysqli_query($conn, $sql2);

                         // check query 

                         if($res2 == true){
                            //success message
                            $_SESSION['change-pwd'] = "<div class ='success'>Password successfully changed</div>";
                            // redirect 
                            header('location:'.SITEURL.'admin/manage-admin.php');

                         }
                         else
                         {
                            // error message 
                             //success message
                            $_SESSION['change-pwd'] = "<div class ='fail'>Password failed to changed</div>";
                            // redirect 
                            header('location:'.SITEURL.'admin/manage-admin.php');
                         }

                            
                        }
                        else
                        {
                            $_SESSION['pwd-not-match'] = "<div class ='fail'>Password did not match</div>";
                            // redirect 
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }

                        
                        
                    }
                    else
                    {
                        $_SESSION['user-not-found'] = "<div class ='fail'>User not found </div>";
                        // redirect 
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

                // check if new password matches with old 

                // update password if correct 
            }
            else
            {

            }

    ?>

    
<?php include('partials/footer.php') ?>