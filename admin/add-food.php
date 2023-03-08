<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        <br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                                // Display categories from db
                                // query to get active categories from db
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                // run query
                                $res = mysqli_query($conn, $sql);
                                // count rows
                                $count = mysqli_num_rows($res);
                                // if > 0 categories available
                                if($count>0)
                                {
                                    // We have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // Get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    // no categories found
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                                ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            // check if button clicked
            if(isset($_POST['submit']))
            {

                // add food in db
                // echo "Button Clicked";
                // get from data
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                
                // check radio button for featured and active
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

                // uplaod image slected
                // check if image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    // image selected
                    // upload the image
                    // to upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];
                    // upload the image only if image is selected
                    if($image_name!="")
                    {
                        // // get image info 
                        // $image_name = $_FILES['image']['name'];
                        // auto rename our image
                        // get the extension of our image 
                        $ext = end(explode('.', $image_name));
                        // rename the image
                        $image_name = "Food_Name_".rand(000, 999).'.'.$ext; // e.g. Food_Name_834.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/food/".$image_name;
                        

                        // finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // check if image is uploaded or not
                        // and if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            // set message
                            $_SESSION['upload'] = "<div class='fail'>Failed to upload image.</div>";
                            // redirect to add food page
                            header('location:'.SITEURL.'admin/add-food.php');
                            // stop the process
                            die();
                        }
                    }
                }
                else
                {
                    // image not selected
                    $image_name = "";
                }

                // insert into db

                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                    ";

                    // run query
                    $res2 = mysqli_query($conn, $sql2);
                    
                    // check if query executed or not
                    if($res2==true)
                    {
                        // query executed and food added
                        $_SESSION['add'] = "<div class='success'>Menu Item Added Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        // failed to add food
                        $_SESSION['add'] = "<div class='fail'>Failed to add menu item.</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                    }

                //redirect to manage food and show message 

            }
        ?>

    </div>


<?php include('partials/footer.php');?>