<?php include('../config/constants.php');?>
<html>
    <head>
        <title>Login - Food order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>
        <br>

        <?php 

        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        ?>
        <br>

        <!-- login form -->

        <form action="" method="POST">
            Username:
            <br>
            <input type="text" name="username" placeholder="Enter Username">
            <br>
            <br>
            Password:
            <br>
            <input type="password" name="password" placeholder="Enter Password">
            <br>
            <br>
            <input type="submit" name="submit" value ="login" class="btn-primary">

        </form>

        <!-- login form finshes -->
        <br>
        <p class="text-center">Created by: Connor Mackintosh</p>
    </div>
    <body>
        
    </body>
</html>

<?php

//check submit button 
if(isset($_POST['submit']))
{
    // action log in 
    // get log in data from form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // sql query checks user name and password exist in db 
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' and password='$password'";

    // run query 
    $res = mysqli_query($conn, $sql);

    // count rows to check is user exists 
    $count = mysqli_num_rows($res);

    if($count==1){
        //user found and logged in 
        $_SESSION['login'] = "<div class= 'success'> Login Success. </div>";
        // redirect to home page 
        header('location:' . SITEURL . 'admin/');
    }
    else{
        
        //user not found and not logged in 
        $_SESSION['login'] = "<div class= 'fail text-center'> Username and Password did not match </div>";
        // redirect to home page 
        header('location:' . SITEURL . 'admin/login.php');

    }
}


?>