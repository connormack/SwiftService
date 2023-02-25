<?php
    //include constants.php
    include('../config/constants.php');

    // exit session 
    session_destroy(); // unsets $_SESSION['user]


    // redirect to login 
    header('location:'.SITEURL.'admin/login.php');

?>