<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php 

        // check whether the id is set
        if(isset($_GET['id']))
        {
            // get the id and all other details
            $id = $_GET['id'];

            // create sql query to get details
            $sql2 = "SELECT * FROM tbl_category WHERE id=$id";

            // execute the query
            $res2 = mysqli_query($conn, $sql2);

            // count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res2);

            if($count == 1)
            {
                // get data
                $row = mysqli_fetch_assoc($res2);

                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                // redirect to manage category with session message
                $_SESSION['no-category-found'] = "<div class='fail'>Category not found.</div>";
                header("location:".SITEURL."admin/manage-category.php");
            }
        }
        else
        {
            // redirect to manage category page
            header("location:".SITEURL."admin/manage-category.php");
        }
        ?>
    <form action="" method ="POST" enctype ="multipart/form-data">
        <table class="tbl-30">

        <tr>
            <td>
                Title:
            </td>
            <td>
                <input type="text" name="title" value="<?php echo $title;?>">
        </tr>

        <tr>
            <td>
                Current Image:
            </td>
            <td>
                <?php
                    if($current_image != "")
                    {
                        // display the image
                        ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="95px">
                        <?php
                    }
                    else
                    {
                        // display the message
                        echo "<div class='fail'>Image not added</div>";
                    }
                ?>
            </td>
        </tr>

        <tr>
            <td>
                New Image:
            </td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>
                Featured:
            </td>
            <td>
                <input <?php if($featured == "yes"){echo "checked";}?> type="radio" name="featured" value="yes"> yes
                <input <?php if($featured == "no"){echo "checked";}?> type="radio" name="featured" value="no"> no
            </td>
        </tr>

        <tr>
            <td>
                Active:
            </td>
            <td>
                <input <?php if($active == "yes"){echo "checked";}?> type="radio" name="active" value="yes"> yes
                <input <?php if($active == "no"){echo "checked";}?> type="radio" name="active" value="no"> no
            </td>
        </tr>  
        
        <tr>
            <input type="hidden" name="current_image" value = "<?php echo $current_image;?>">
            <input type="hidden" name="id" value = "<?php echo $id;?>">
            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
        </tr>
        </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {

                // get form values 
                $id = $_POST['id'];
                $current_image = $_POST['current_image'];
                $title = $_POST['title'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // update the image when slected 
                // check whether the image is selected
                if(isset($_FILES['image']['name']))
                {
                    // get the image info
                    $image_name = $_FILES['image']['name'];

                    // check whether the image is available
                    if($image_name != "")
                    {
                        // image available
                        // upload the image

                        // auto rename the image
                        // get the extension of the image
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        // upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // check whether the image is uploaded
                        if($upload == false)
                        {
                            // failed to upload
                            $_SESSION['upload'] = "<div class='fail'>Failed to upload image.</div>";
                            header("location:".SITEURL."admin/manage-category.php");
                            die();
                        }

                        if($current_image != ""){

                            
                            // remove the image
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink("../images/category/".$current_image);

                            // check if image removed 
                            if($remove == false)
                            {
                                // failed to remove image
                                $_SESSION['failed-remove'] = "<div class='fail'>Failed to remove current image.</div>";
                                header("location:".SITEURL."admin/manage-category.php");
                                die();
                            }
                        }
                    }
                    else
                    {
                        // image is not available
                        $image_name = $current_image;
                    }

                }
                else
                {
                    // don't update the image
                    $image_name = $current_image;
                }

                // update db
                $sql3 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                    ";

                // run query 
                $res3 = mysqli_query($conn, $sql3);

                // redirect and display message
                if($res3 == true)
                {
                    $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }
                else
                {
                    $_SESSION['update'] = "<div class='fail'>Failed to update category.</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }
            }

        ?>

    </div>
</div>

<?php include("partials/footer.php");?>