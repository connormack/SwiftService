<?php include('partials-front/menu.php');?>

    <!-- food serach Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search Menu.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- food serach Section Ends Here -->



    <!-- food menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>

            <?php

            //displaying active and fetured foods

            // sql query to display foods
            $sql = "SELECT * FROM tbl_food WHERE active='Yes' LIMIT 12";

            //run query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);


                // check if food found
                if($count>0)
                {
                    // foods found
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // get values 
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                            <div class="food-menu-box">
                            <div class="food-menu-img">

                            <?php
                                // check if image is available
                                if($image_name=="")
                                {
                                    // image not available
                                    echo "<div class='fail'>Image not available.</div>";
                                }
                                else
                                {
                                    // image available
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Momo" height="135" width="125" class="img-responsive img-curve">
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?> </h4>
                                <p class="food-price"><?php echo "£" . $price;?></p>
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
                    echo "<div class='fail'>Food not found.</div>";
                }

            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    
    <?php include('partials-front/footer.php');?>