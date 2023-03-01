<?php include('partials/menu.php')?>

<?php

    // check if id is set
    if(isset($_GET['id']))
    {
        // get the id and all other details
        $id = $_GET['id'];

        // create sql query to get the details
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        // execute the query
        $res2 = mysqli_query($conn, $sql2);

        // get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        // get individual values of selected food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id']; 
        $current_featured = $row2['featured'];
        $current_active = $row2['active'];

        // // count rows
        // $count2 = mysqli_num_rows($res2);

    }
    else
    {
        // redirect to manage food
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br>
        <br>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    
                    <input type="text" name="title" placeholder="Food title" value="<?php echo $title;?>">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price;?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php
                    if($current_image != "")
                    {
                        // display image
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                        <?php
                    }
                    else
                    {
                        // display message
                        echo "<div class='fail'>Image not added.</div>";
                    }
                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                        <?php
                        // query to get active categories
                        $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";

                        // run query
                        $res2 = mysqli_query($conn, $sql2);

                        // count rows
                        $count2 = mysqli_num_rows($res2);

                        // check whether we have categories or not
                        if($count2>0)
                        {
                            // we have categories
                            while($row2=mysqli_fetch_assoc($res2))
                            {
                                // get the details of categories
                                $category_title = $row2['title'];
                                $category_id = $row2['id'];

                                // echo "<option value='$category_id'>$category_title</option>";
                                ?>

                                <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                <?php

                            }
                        }
                        ?>

                    </select>
                </td>   
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($current_featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($current_featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    Active:
                </td>
                <td>
                    <input <?php if($current_active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($current_active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>
                        
        </table>

        </form>

        <?php

        // if submit button is clicked
        if(isset($_POST['submit']))
        {
            // echo "clicked";

            // get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // for radio input, we need to check whether the button is selected or not
            if(isset($_POST['featured']))
            {
                // get the value from form
                $featured = $_POST['featured'];
            }
            else
            {
                // set the default value
                $featured = "No";
            }

            if(isset($_POST['active']))
            {
                // get the value from form
                $active = $_POST['active'];
            }
            else
            {
                // set the default value
                $active = "No";
            }

            // check whether the image is selected or not and set the value for image name accordingly
            // print_r($_FILES['image']);

            // die(); // break the code here

            if(isset($_FILES['image']['name']))
            {
                // upload the image
                // to upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];

                // check whether the image is available or not
                if($image_name!="")
                {
                    // image is available
                    // upload the new image

                    // auto rename our image
                    // get the extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                    $ext = end(explode('.', $image_name));

                    // rename the image
                    $image_name = "Food-Name-".rand(000, 999).'.'.$ext; // e.g. Food-Name-834.jpg

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/food/".$image_name;

                    // finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // check whether the image is uploaded or not
                    // and if the image is not uploaded then we will stop the process and redirect with error message
                    if($upload==false)
                    {
                        // set message
                        $_SESSION['upload'] = "<div class='fail'>Failed to upload image.</div>";
                        // redirect to add category page
                        header('location:'.SITEURL.'admin/manage-food.php');
                        // stop the process
                        die();
                    }

                    // remove the current image if available
                    if($current_image !="")
                    {
                        // found current image 
                        // remove it
                        $remove_path = "../images/food/".$current_image;

                        $remove = unlink($remove_path);
                    
                        // check if image removed
                        if($remove==false)
                        {
                            // failed to remove image
                            $_SESSION['failed-remove'] = "<div class='fail'>Failed to remove current image.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die(); // stop the process
                        }
                    }
                }
            else
            {
                $image_name = $current_image; // default image name when image is not selected
            }
        }
            else
            {
                $image_name = $current_image; // default image name when image is not selected
            }

            // create sql query to update food
            $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                WHERE id=$id
            ";

            // run query 
            $res3 = mysqli_query($conn, $sql3);

            // check whether the query executed or not and set the session message
            if($res3==true)
            {
                // query executed and food updated
                $_SESSION['update'] = "<div class='success'>Food updated successfully.</div>";
                // redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
            {
                // failed to update food
                $_SESSION['update'] = "<div class='fail'>Failed to update food.</div>";
                // redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>


<?php include('partials/footer.php')?>