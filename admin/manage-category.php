<?php include('partials/menu.php')?>

<div class="main-content">
<div class="wrapper">
<h1>Manage Category</h1>
            <br>
            <br>
            <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION["add"]);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION["remove"]);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION["delete"]);
            }

            ?>
            <br><br>
  <!-- button for adding category -->
            <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary"> Add Category </a>
            <br>
            <br>
            <table class="tbl-full">
                <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
                </tr>

                <?php
                //create sql query to get all the categories from database
                $sql = "SELECT * FROM tbl_category";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows to check whether we have categories or not
                $count = mysqli_num_rows($res);
                //create serial number variable and set default value as 1
                $sn=1;
                //check if data in db 
                if ($count >0)
                {
                    // data found
                    // get the data and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                        
                    <tr>
                        <td><?php echo $sn ++;?></td>
                        <td><?php echo $title ;?></td>

                        <td>
                            <?php
                            //check whether image is available
                            if($image_name != "")
                            {
                                //display the image
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px">
                                <?php
                            }
                            else
                            {
                                //display message
                                echo "<div class='fail'>Image not added</div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $featured ;?></td>
                        <td><?php echo $active ;?></td>
                        <td>
                        <a href="#" class="btn-secondary">Update Category</a>
                        <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>

                        <?php
                    }
                }
                else
                {
                    // data not found
                    // display message in table
                    ?>

                    <tr>
                        <td colspan="6"><div class ="fail"> No category added</div></td>
                    </tr> 


                    <?php

                }

                ?>
            </table>
</div>
</div>


<?php include('partials/footer.php')?>