<?php
// authorization - access control 
// check if user is logged in 

if(!isset($_SESSION['user'])) // if user is not set 
{
    // user is not logged in and will redirect
    $_SESSION['no-login-message'] = "<div class = 'fail'> Login to access Admin Panel. </div> "; 
    // redirect to login page 
    header('location:'. SITEURL . 'admin/login.php');
}

?>