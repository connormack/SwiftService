<?php
include('partials-front/menu.php');
?>

    <!-- food serach Section Starts Here -->
    <section class="food-search text-center">
      <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
          <input
            type="search"
            name="search"
            placeholder="Search menu..."
            required
          />
          <input
            type="submit"
            name="submit"
            value="Search"
            class="btn btn-primary"
          />
        </form>
      </div>
    </section>
    <!-- food serach Section Ends Here -->

    <?php

    if(isset($_SESSION['order']))
    {
      echo $_SESSION['order'];
      // remove session message
      unset($_SESSION['order']);
    }

  ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
      <div class="container">
        <h1 class="fail text-center">Welcome to the UWE Arms</h1>
        <br>
        <h2 class="text-center">Explore Menu</h2>

        <?php 

        // sql query to disyplay categories
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 4";
        //run query
        $res = mysqli_query($conn, $sql);

        //count rows
        $count = mysqli_num_rows($res);

        if($count>0)
        {
          // catergoies found 
          while($row=mysqli_fetch_assoc($res)){
            // get id, title and image values
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
                    // image not found
                    echo "<div class='fail'>Image not available.</div>";
                  }
                  else
                  {
                    // image found 
                    ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza"  class="img-responsive img-curve img-size"/>
                    <?php
                  }
                  ?>
                      
                        <h3 class="float-text text-white"><?php echo $title ?></h3>
                      </div>
                    </a>

            <?php
          }
        }
        else
        {
          // catergoies not found 
          echo "<div class='fail'>Category not found.</div>";
        }


        ?>


        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Categories Section Ends Here -->

    

    <!-- food menu Section Starts Here -->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Popular Choices</h2>

        <?php 

        // get foods from database that are active and featured
        // sql query
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

        // run query
        $res2 = mysqli_query($conn, $sql2);

        // count rows
        $count2 = mysqli_num_rows($res2);

        // check if foods are available
        if($count2 >0)
        {
          // food found
          while($row=mysqli_fetch_assoc($res2))
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
                  <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" height="135" width="125" class="img-responsive img-curve">
                  <?php
                }
                
                ?>
                </div>

                <div class="food-menu-desc">
                  <h4><?php echo $title; ?></h4>
                  <p class="food-price"><?php echo "£" . $price; ?></p>
                  <p class="food-detail">
                  <?php echo $description; ?>
                  </p>
                  <br />

                  <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
              </div>

            <?php
          }
        }
        else
        {
          // food not found
          echo "<div class='fail'>Food not found.</div>";
        }
        ?>


        <div class="clearfix"></div>
      </div>

      <p class="text-center">
        <a href="<?php echo SITEURL;?>foods.php">See Full Menu</a>
      </p>
    </section>
    <!-- food menu Section Ends Here -->

  <?php include('partials-front/footer.php');?>

