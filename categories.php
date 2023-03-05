<?php include('partials-front/menu.php');?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

            // sql query to disyplay categories
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

            //run query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            // check if categories found
            if($count>0)
            {
                // caterogies found
                while($row=mysqli_fetch_assoc($res))
                {
                    // get values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id ?>">
                    <div class="box-3 float-container">
                        <?php
                        // check if image is found
                        if($image_name=="")
                        {
                            // image not available
                            echo "<div class='fail'>Image not available.</div>";
                        }
                        else
                        {
                            // image available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" alt="Pizza" class="img-responsive img-curve img-size">
                            <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title;?></h3>
                    </div>
                    </a>

                    <?php
                }
            }
            else
            {
                // categories not found
                echo "<div class='fail'>Category not found.</div>";
            }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php');?>