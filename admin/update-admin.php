<?php include("partials/menu.php"); ?>

<div class ="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php

                    //1. Get the ID of Selected Admin
            $id=$_GET['id'];
            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";
            //Execute the Query
            $res=mysqli_query($conn, $sql);
            //Check whether the query is executed or not
            if($res==true)
            {
            // Check whether the data is available or not
            $count = mysqli_num_rows($res);
            //Check whether we have admin data or not
            if ($count==1)
            {
            // Get the Details.
            // echo "Admin Available";
            $row =mysqli_fetch_assoc($res);

            $full_name =$row['full_name'];
            $username = $row['username'];


            }
            else
            {
            //Redirect to Manage Admin Page
            header('location: '.SITEURL. 'admin/manage-admin.php');
            }
            }

        ?>

        <form action="" method="POST">

        <table class="tbl-30">
        <tr>
            <td>Full Name:</td>
            <td>        
            <input type="text"  name ="full_name" value ="<?php echo $full_name; ?>">
            </td> 
        </tr>

        <tr>
            <td>username: </td>
            <td>
                <input type="text" name="username" value="<?php echo $username; ?>">
            </td>
        </tr>

        <tr>
            <td colspan ="2">
                <input type="hidden" name="id" value="<?php echo $id ?>" >
            <input type="submit" name="submit" value ="Update Admin" class="btn-secondary">
            </td>
        </tr>

        </table>

        </form>

    </div>
</div>

<!-- COMPAIR FROM HERE DOWN  -->

<?php

// check the submit button is clicked 
if (isset($_POST['submit']))
{
    // echo "BUTTON";
    //get values from form
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //sql query
    $sql = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username = '$username'
    WHERE id = '$id'
    ";

    // run query
    $res = mysqli_query($conn, $sql);

    // check query 
    if($res == true)
    {
        //query ran and admin updated 
        $_SESSION['update'] = "<div class='success'> Admin successfully updated</div>";
        // redirect to amdin manage 
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        // failed to update admin 
        $_SESSION['update'] = "<div class='fail'> Admin failed to updated</div>";
        // redirect to amdin manage 
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

}

?>

<?php include("partials/footer.php");?>