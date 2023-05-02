<?php include("partials/menu.php"); ?>

<div class ="main content">
    <div class="wrapper">
        <h1>Add User</h1>

        <br>
        <br>

        <?php 
            if(isset($_SESSION['add']))// checling is session is set 
            {

                echo $_SESSION['add']; // display session message 
                unset($_SESSION['add']); // removes session message 
            }
            ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter full name"></td>
            </tr>

            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="Enter username"></td>
            </tr>

            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="Enter password"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type ="submit" name ="submit" value = "Add Admin" class="btn-secondary">
                </td>
            </tr>

        </table>
        </form>

    </div>
</div>

<?php include("partials/footer.php");?>

<?php 

// processing value from the form and save in DB
//check submit button is clicked

if(isset($_POST['submit']))
{

    // get data for form 
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password is encrypted in MD5

    // SQL to save info in DB 
    $sql = "INSERT INTO tbl_admin SET 
        full_name = '$full_name',
        username = '$username',
        password = '$password'
        ";

    // DB query and saves data 
    $conn = mysqli_connect('localhost', 'root', '') or (mysqli_error()); // DB connection 
    $db_select = mysqli_select_db($conn, 'food-order') or (mysqli_error()); // DB selection


    //check to see if data is inserted 
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    if ($res == TRUE){
        // // instered 
        // echo"data inserted";
        // session vairbales to display message
        $_SESSION['add'] = "<div class='success'> Admin successfully added</div>";
        // redirect page
        header("location:".SITEURL."admin/manage-admin.php");
    } else {
        //Failed to insert 
        // session vairbales to display message
        $_SESSION['add'] = "Failed to add admin";
        // redirect page to add admin
        header("location:".SITEURL."admin/add-admin.php");
    }
}

?>