<!-- REFRENCE - I used a tutorial to help me with the project. acknowledgement must be given to: Vijay Thapa
The link to the tutorial and his YouTube profile can be found here: https://www.youtube.com/watch?v=ZBgTzx46B8s&list=PLBLPjjQlnVXXBheMQrkv3UROskC0K1ctW   -->

<?php include('partials/menu.php') ?>

    <!-- This is the main section -->
    <div class="main-content">
    <div class ="wrapper">
            <h1>Dashboard</h1>
            <br>
            <?php 

            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            ?>
            <br>

            <div class = "col-4 text-center" >

            <?php 
                    // create sql query to get all the categories
                    $sql2 = "SELECT * FROM tbl_category";

                    // run query
                    $res2 = mysqli_query($conn, $sql2);

                    // count the rows
                    $count2 = mysqli_num_rows($res2);

            ?>

                <h1><?php echo $count2 ?></h1>
                <br>
                Menu Items
            </div>

            <div class = "col-4 text-center" >

                <?php 
                    // create sql query to get all the food
                    $sql = "SELECT * FROM tbl_food";

                    // run query
                    $res = mysqli_query($conn, $sql);

                    // count the rows
                    $count = mysqli_num_rows($res);

                    ?>

                <h1><?php echo $count; ?></h1>
                <br>
                Categories
            </div>

            <div class = "col-4 text-center" >

            
            <?php 
                    // create sql query to get all the total orders
                    $sql3 = "SELECT * FROM tbl_order";

                    // run query
                    $res3 = mysqli_query($conn, $sql3);

                    // count the rows
                    $count3 = mysqli_num_rows($res3);

            ?>
                <h1><?php echo $count3 ?></h1>
                <br>
                Total orders
            </div>

            <div class = "col-4 text-center" >
                
            <?php 
                    // create sql query to get all the total revenue
                    // aggregate sql sum function 
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Completed'";

                    // run query
                    $res4 = mysqli_query($conn, $sql4);

                    // get the value
                    $row4 = mysqli_fetch_assoc($res4);

                    // get total revenue
                    $total_revenue = $row4['Total'];


                    ?>
                <h1><?php echo "£" . $total_revenue ?></h1>
                <br>
                Total Revenue
            </div>

            <div class="clearfix"></div>

            
        </div>
    <div>
<?php include_once('partials/footer.php') ?>