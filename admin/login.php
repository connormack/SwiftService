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
        if(isset( $_SESSION['no-login-message']))
        {
            echo  $_SESSION['no-login-message'];
            unset( $_SESSION['no-login-message']);
        }

        ?>
        <br>

        <!-- login form -->

        <form action="" method="POST">
            Username:
            <br>
            <input class="username" type="text" name="username" placeholder="Enter Username">
            <br>
            <br>
            Password:
            <br>
            <input class="password" type="password" name="password" placeholder="Enter Password">
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
    // escape string prevent sql injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    // sql query checks user name and password exist in db 
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' and password='$password'";

    // run query 
    $res = mysqli_query($conn, $sql);

    // count rows to check is user exists 
    $count = mysqli_num_rows($res);

    if($count==1){
        //user found and logged in 
        $_SESSION['login'] = "<div class= 'success'>Login Success.</div>";
        $_SESSION['user'] = $username; // check is user is loogin in and logout unsets it 


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