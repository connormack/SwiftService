<?php include('partials/menu.php')?>

<div class="main-content">
<div class="wrapper">
<h1>Manage Menu Items</h1>
<br>
            <br>
            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['unauthorised']))
            {
                echo $_SESSION['unauthorised'];
                unset($_SESSION['unauthorised']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }


            ?>

            <br>

            <!-- button for adding category -->
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary"> Add Item </a>
            <br>
            <br>
            <table class="tbl-full">
                <tr>
                <th>S.N</th>
                <th>Title </th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                </tr>

                <?php
                // query to get all food
                $sql = "SELECT * FROM tbl_food";

                // run the query
                $res = mysqli_query($conn, $sql);

                // count rows in DB
                $count = mysqli_num_rows($res);

                // create serial number variable
                $sn = 1;
                
                if($count>0){
                    // food available
                    // get food from DB and display
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // get the values from colum 
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>

                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $title;?></td>
                        <td><?php echo $price;?></td>
                        <td><?php 
                            // check whether image is available
                            if($image_name!=""){
                                // display image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                <?php
                            }
                            else{
                                // display message
                                echo "<div class='fail'>Image not added</div>";
                            }
                        ?></td>
                        <td><?php echo $featured;?></td>
                        <td><?php echo $active;?></td>
                        <td>
                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Item</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>"class="btn-danger">Delete Item</a>
                        </td>
                    </tr>
                        <?php
                    }

                }
                else{
                    // no food in DB
                    echo "<tr><td colspan='6' class='fail'>Food not added yet</td></tr>";
                }
                ?>

            </table>
</div>
</div>


<?php include('partials/footer.php')?>