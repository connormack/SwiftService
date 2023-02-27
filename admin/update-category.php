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
                <input <?php if($featured == "yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                <input <?php if($featured == "no"){echo "checked";}?> type="radio" name="featured" value="No"> No
            </td>
        </tr>

        <tr>
            <td>
                Active:
            </td>
            <td>
                <input <?php if($active == "yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                <input <?php if($active == "no"){echo "checked";}?> type="radio" name="active" value="No"> No
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

                // echo "button clicked";
                // get form values 
                $id = $_POST['id'];
                $current_image = $_POST['current_image'];
                $title = $_POST['title'];
            }

        ?>

    </div>
</div>

<?php include("partials/footer.php");?>