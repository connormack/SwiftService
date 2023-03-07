<?php include('partials/menu.php')?>

<div class="main-content">
<div class="wrapper">
<h1>Manage Order</h1>
            <br>
            <br>

            <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>
            <br>
            <br>

            <table class="tbl-full">
                <tr>
                <th>S.N</th>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer Email</th>
                <th>Table Number</th>
                <th>Actions</th>
                </tr>

                <?php
                // get orders from db
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                // run query
                $res = mysqli_query($conn, $sql);
                // count rows
                $count = mysqli_num_rows($res);
                // create serial number
                $sn=1;
                // check if orders found
                if($count>0)
                {
                    // orders found
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // get the values
                        $id = $row['id'];
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
                        ?>

                        <tr>
                            <!-- possibly change ID to SN  -->
                            <td><?php echo $id; ?></td> 
                            <td><?php echo $food; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td>
                                <?php
                                // check if order is delivered
                                if($status=="Ordered")
                                {
                                    // order delivered
                                    echo "<label>$status</label>";
                                }
                                elseif($status=="Preparing Order")
                                {
                                    echo "<label style='color: orange;'>$status</label>";
                                }
                                elseif($status=="Completed")
                                {
                                    echo "<label style='color: green;'>$status</label>";
                                }
                                elseif($status=="Cancelled")
                                {
                                    echo "<label style='color: red;'>$status</label>";
                                }
                                else
                                {
                                    echo "<label style='color: black;'>$status</label>";
                                }
                                ?>
                            </td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $table_number; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    // orders not available
                    echo "<tr><td colspan='12' class='fail'>Order is not available.</td></tr>";
                }
                

                ?>

            </table>
</div>
</div>


<?php include('partials/footer.php')?>

<!-- Refresh the page every 7 seconds to display new orders -->
<meta http-equiv="refresh" content="7">