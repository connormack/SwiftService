<?php
include("../config/constants.php");


// get admin ID 
$id = $_GET['id'];


// SQL query to delete admin 
$sql = "DELETE FROM tbl_admin WHERE id=$id";

// run query
$res = mysqli_query($conn, $sql);

// check query 

if($res == true)
{
//echo "Admin deleted";
// session var to display message 
$_SESSION['delete'] = "<div class='success'>Admin successfully deleted</div>";
//redirect
header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
// echo "Error admin was not deleted";
$_SESSION['delete'] = "<div class='fail'>Admin failed to deleted</div>";
//redirect
header('location:'.SITEURL.'admin/manage-admin.php');
}
// redirect user to manage admin page 

?>