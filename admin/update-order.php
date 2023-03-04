<?php include('partials/menu.php')?>

<div class="main-class">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php

        // check if id is set
        if(isset($_GET['id']))
        {
            // get id and details
            $id = $_GET['id'];

            // create sql query to get details
            $sql = "SELECT * FROM tbl_order WHERE id=$id";

            // run query
            $res = mysqli_query($conn, $sql);

            // count rows
            $count = mysqli_num_rows($res);

            // check if id is valid
            if($count==1)
            {
                // get all details
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $table_number = $row['table_number'];
            }
            else
            {
                // redirect to manage order
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }
        else
        {
            // redirect to manage order
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        ?>
        
        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Food Name: </td>
                <td>
                    <b><?php echo $food; ?></b>
                </td>
            </tr>

            <tr>
                <td>Quantity: </td>
                <td>
                    <input type="number" name="qty" value="<?php echo $qty; ?>">
                </td>
            </tr>

            <tr>
                <td>Total: </td>
                <td>
                    <input type="text" name="total" value="<?php echo "£" .  $total; ?>">
                </td>

            <tr>
                <td>Status: </td>
                <td>
                    <select name="status">
                        <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                        <option <?php if($status=="Preparing Order"){echo "selected";} ?> value="Preparing Order">Preparing Order</option>
                        <option <?php if($status=="Completed"){echo "selected";} ?> value="Completed">Completed</option>
                        <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Customer Name: </td>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Contact: </td>
                <td>
                    <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Email: </td>
                <td>
                    <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                </td>
            </tr>

            <tr>
                <td>Table Number: </td>
                <td>
                    <input name="table_number" type ="text" value="<?php echo $table_number;?>">
                </td>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>

        <?php

        // check if submit button is clicked
        if(isset($_POST['submit']))
        {
            // get from data
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $table_number = $_POST['table_number'];

            // create sql query to update order
            $sql2 = "UPDATE tbl_order SET
                qty = $qty,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                table_number = '$table_number'
                WHERE id=$id
            ";

            // run query
            $res2 = mysqli_query($conn, $sql2);

            // check if query ran
            if($res2==true)
            {
                // query run and order updated
                $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                // redirect to manage order
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            else
            {
                // failed to update order
                $_SESSION['update'] = "<div class='fail'>Failed to Update Order.</div>";
                // redirect to manage order
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }

        ?>


    </div
></div>



<?php include('partials/footer.php')?>