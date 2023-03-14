<?php include('partials-front/menu.php');?>
<?php
// check if food id set
if(isset($_GET['food_id']))
{
  // get the food id and details
  $food_id = $_GET['food_id'];

  // get the details of the selected food
  $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

  // run query
  $res = mysqli_query($conn, $sql);

  // count rows
  $count = mysqli_num_rows($res);

  // check if food is found 
  if($count==1)
  {
    // food found
    // get the details
    $row = mysqli_fetch_assoc($res);

    $title = $row['title'];
    $price = $row['price'];
    $description = $row['description'];
    $image_name = $row['image_name'];
  }
  else
  {
    // food not found
    // redirect to home page
    header('location:'.SITEURL);
  }
}
else
{
  // redirect to home page
  header('location:'.SITEURL);
}
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
      <div class="container">
        <h2 class="text-center text-white">
          Complete this form to confirm your order.
        </h2>
        <form action="" method="POST" class="order">
          <fieldset>
            <legend>Selected Item</legend>
            <div class="food-menu-img">
              <?php 
              // check if image is found
              if($image_name=="")
              {
                // image not found
                echo "<div class='fail'>Image is not available.</div>";
              }
              else
              {
                // image found
                ?>
                <img
                  src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>"
                  alt="<?php echo $title;?>"
                  class="img-responsive img-curve"
                />
                <?php
              }
              
              ?>
            </div>
            <div class="food-menu-desc">
              <h3><?php echo $title;?></h3>
              <input type="hidden" name="food" value="<?php echo $title;?>">

              <p class="food-price"><?php echo "£" . $price;?></p>
              <input type="hidden" name="price" value="<?php echo $price;?>">

              <div class="order-label">Quantity</div>
              <input
                type="number"
                name="qty"
                class="input-responsive"
                value="1"
                required
              />
            </div>
          </fieldset>

          <fieldset>
            <legend>Order Details</legend>
            <div class="order-label">Full Name</div>
            <input
              type="text"
              name="customer_name"
              class="input-responsive full-name"
              required
            />

            <div class="order-label">Phone Number</div>
            <input
              type="tel"
              name="customer_contact"
              class="input-responsive phone"
              required
            />

            <div class="order-label">Email</div>
            <input
              type="email"
              name="customer_email"
              class="input-responsive email"
              required
            />

            <div class="order-label">Table Number</div>
            <input
              type="number"
              name="table_number"
              class="input-responsive table-number"
              required
            ></input>

            <div class="order-label">Card Number</div>
            <input
              type="text"
              name="tab"
              placeholder="xxxx xxxx xxxx xxxx"
              class="input-responsive card-number"
              required
            ></input>

            <div class="order-label">Expiry Date</div>
            <input
              type="text"
              name="tab"
              placeholder="MM/YY"
              class="input-responsive card-expiry"
              required
            ></input>

            <div class="order-label">Security Code</div>
            <input
              type="text"
              placeholder="xxx"
              class="input-responsive security-code"
              required
            ></input>

            <input
              type="submit"
              name="submit"
              value="Confirm Order"
              class="btn btn-primary"
            />            
          </fieldset>
        </form>
         <?php
         ob_start();
        // check if submit button is clicked
        if(isset($_POST['submit']))
        {
          // get the data from form
          $food = $_POST['food'];
          $price = $_POST['price'];
          $qty = $_POST['qty'];
          $total = $price * $qty;
          $order_date = date("Y-m-d h:i:sa");
          $status = "Ordered";
          $customer_name = $_POST['customer_name'];
          $customer_contact = $_POST['customer_contact'];
          $customer_email = $_POST['customer_email'];
          $table_number = $_POST['table_number'];
          // $customer_address = $_POST['customer_address'];

          // save the order to database
          // create sql query to save order
          $sql2 = "INSERT INTO tbl_order SET
            food = '$food',
            price = $price,
            qty = $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            table_number = '$table_number'
          ";

          // run query
          $res2 = mysqli_query($conn, $sql2);

          // check if query executed successfully
          if($res2==true)
          {
            // query executed and order saved
            $_SESSION['order'] = "<div class='success text-center'>Order Has Been Successful.</div>";
            header('location:'.SITEURL);
            // fix "Warning: Cannot modify header information - headers already sent by " error found here : https://www.youtube.com/watch?v=No7XfRi3yi8
            echo '<script> window.location.href = "http://localhost/SDP/"; </script>';
          }
          else
          {
            // failed to save order
            $_SESSION['order'] = "<div class='fail text-center'>Order Has Failed</div>";
            header('location:'.SITEURL);
          }
        }
        ?>


      </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    
    <?php include('partials-front/footer.php');?>
