<?php
include('../config/constants.php');


if(isset($_GET['id']) && isset($_GET['image_name']))
{
    // get the value and delete

    // get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // remove image is there is one 
    // check image and delete if available
    if($image_name != "")
    {
        //image found so remove it
        $path = "../images/food/".$image_name;
        // remove image
        $remove = unlink($path);

        // check if image is removed
        if($remove==false)
        {
            // failed to remove image
            $_SESSION['remove'] = "<div class='fail'>Failed to remove image.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }
    }
    // delete food from DB
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    // run the query
    $res = mysqli_query($conn, $sql);

    // check if query has run and set message 
    if($res==true)
    {
        // query run and food deleted
        $_SESSION['delete'] = "<div class='success'>Menu item deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else{
        // failed to delete food
        $_SESSION['delete'] = "<div class='fail'>Failed to delete Menu item.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }


    // redirect to manage food with session message
}
else{
    // redirect to manage food
    $_SESSION['unauthorised'] = "<div class='fail'>Unauthorized access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');

}

?>