<?php
include("../config/constants.php");

// Check whether the id and image_name value is set
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    // Get the value and delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // remove the physical image file if available
    if($image_name != ""){
        // image found
        $path = "../images/category/".$image_name;
        // remove the image
        $remove = unlink($path); // returns true or false

        // if failed to remove image then add an error message and quit 
        if($remove == false)
        {
            // set the session message
            $_SESSION['remove'] = "<div class='fail'>Failed to remove category image</div>";
            // redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
            // stop the process
            die();
        }
    }

    // delete the data from db
    // sql query to delete data from db
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    // run query 
    $res = mysqli_query($conn, $sql);

    // check if data is deleted from db
    if($res == true)
    {
        // data deleted
        // set the session message
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
        // redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        // failed to delete data
        // set the session message
        $_SESSION['delete'] = "<div class='fail'>Failed to delete category</div>";
        // redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }

    // redirect to manage category and display message
}
else
{
    // Redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');

}


?>