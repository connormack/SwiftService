<?php include('partials/menu.php'); ?>

<div class="main-content">  
    <div class ="wrapper">
        <h1>Add Category</h1>
        <br>
        <br>

        <?php

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION["add"]);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION["upload"]);
        }

        ?>

        <br>
        <br>


        <!-- Add category start-->
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="Category Title">
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
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
                <td>Active</td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
            </tr>
            <tr>
                <td colspan ="2">
                    <input type="submit" name ="submit" value = "Add Category" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>


        <!-- Add category ends-->

        <?php

        //check submit button 
        if(isset($_POST['submit'])){
            // echo "clicked";

            // get form value 
            $title = $_POST['title'];

            // check the radio value 
            if(isset($_POST['featured'])){
                // get choice value 
                 // set default value
                 $featured = $_POST['featured'];
            }
            else
            {
                // set default value
                $featured = 'No';
            }

            if(isset($_POST['active'])){
                // get choice value 
                 // set default value
                 $active = $_POST['active'];
            }
            else
            {
                // set default value
                $active = 'No';
            }

            // check if a caterogy image is set and set image name 
            // print_r($_FILES['image']);

            // // exit the code 
            // die();

            if(isset($_FILES['image']['name'])){
                // upload the image using image name, source path and destination path 
                $image_name = $_FILES['image']['name'];

                // only upload image if image is selected
                if($image_name != ""){

                    // renaming the image
                    // get the extension of image
                    // end takes the last part of the picture path eg .jpeg
                    $ext = end(explode('.', $image_name)); 

                    // rename the image
                    $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // eg Food_Category_333.jpeg


                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/".$image_name;

                    // upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // check if image is uploaded
                    // if image not uploaded stop and redirect and display eorror
                    if($upload==false)
                {
                    // set message 
                    $_SESSION['upload'] = "<div class='fail'> Failed to upload image. </div>";
                    // redirect to add category page
                    header("location:".SITEURL."admin/add-category.php");
                    // stop
                    die();
                }

                }
                
            }
            else
            {
                // image is not uploaded and image name is set to blank 
                $image_name = "";
            }

            // create sql Query to insert category
            $sql = "INSERT INTO tbl_category SET
            title ='$title',
            image_name = '$image_name',
            featured = '$featured',
            active= '$active'
            ";

            // run query and save in DB
            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                // succcess and added to db
                $_SESSION['add'] = "<div class='success'> Category added successfully. </div>";
                header("location:".SITEURL."admin/manage-category.php");
            }
            else
            {
                // query failed 
                $_SESSION['add'] = "<div class='fail'> Category not added. </div>";
                header("location:".SITEURL."admin/add-category.php");
            }
            
        }

        ?>
    </div>

</div>


<?php include('partials/footer.php'); ?>