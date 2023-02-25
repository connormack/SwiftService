<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
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
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="100px">
                        <?php
                    }
                    else
                    {
                        // display the message
                        echo "<div class='error'>Image not added</div>";
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
                <input <?php if($featured == "Yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                <input <?php if($featured == "No"){echo "checked";}?> type="radio" name="featured" value="No"> No
            </td>
        </tr>

        <tr>
            <td>
                Active:
            </td>
            <td>
                <input <?php if($active == "Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                <input <?php if($active == "No"){echo "checked";}?> type="radio" name="active" value="No"> No
            </td>
        </tr>  
        
        <tr>
            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
        </tr>
        </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php");?>