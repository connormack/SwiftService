<?php include('partials-front/menu.php');?>

<?php
    // check if id passed
    if(isset($_GET['category_id']))
    {
        // get id
        $category_id = $_GET['category_id'];
        // get category title
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        // run query
        $res = mysqli_query($conn, $sql);
        // get value from db
        $row = mysqli_fetch_assoc($res);
        // get title
        $category_title = $row['title'];

    }
    else
    {
        // redirect to home
        header('location:'.SITEURL);
    }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Results for  <a href="#" class="text-white"><?php echo "'" . $category_title . "'" ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>

            <?php

            // get the foods based on category
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

            // run query
            $res2 = mysqli_query($conn, $sql2);

            // count rows
            $count2 = mysqli_num_rows($res2);

            // check whether foods are available or not
            if($count2 > 0)
            {

                // food is found
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>

                    
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php

                            // check whether image found
                            if($image_name=="")
                            {
                                // image not found
                                echo "<div class='fail'>Image not available.</div>";
                            }
                            else
                            {
                                // image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" height="135" width="125" class="img-responsive img-curve">
                                <?php
                            }

                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title ?></h4>
                            <p class="food-price"><?php echo "£" . $price ?></p>
                            <p class="food-detail">
                            <?php echo $description ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                            
                    <?php
                }

            }
            else
            {
                // foods not found
                echo "<div class='fail'>Food not available.</div>";
            }


            ?>

            <div class="clearfix"></div> 

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>