<?php include('partials/menu.php') ?>
    <!-- This is the main section -->
    <div class="main-content">
    <div class ="wrapper">
            <h1>Manage admin</h1>

            <br>

            <?php 
            if(isset($_SESSION['add'])){

                echo $_SESSION['add']; // display session message 
                unset($_SESSION['add']); // removes session message 
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>
            <br>
            <br>
            <!-- button for adding admin -->
            <a href="add-admin.php" class="btn-primary"> Add user </a>
            <br>
            <br>
            <table class="tbl-full">
                <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
                </tr>

                <?php
                // gets all admin 
                $sql = "SELECT * FROM tbl_admin";
                // run query 
                $res = mysqli_query($conn, $sql);

                //check if query workes
                if($res==TRUE)
                {
                    // count rows to check if full data their 
                    $count = mysqli_num_rows($res); // get all rows in DB

                    $sn=1; // create var and assign the value 

                    // check num of rows 
                    if($count > 0)
                        {
                        // data is in DB 
                        while($rows=mysqli_fetch_assoc($res))
                        {
                        // loops through rows to get data from DB 
                        $id = $rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

                        // display values in table 

                        ?>
                        
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $full_name; ?></td>
                    <td><?php echo $username; ?></td>
                    <td>
                    <a href="" class ="btn-primary">Change Password</a>
                    <a href="<?php echo SITEURL;  ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>
                
                        <?php

                        }
                    }else{
                        // no data in DB 
                    }
                    
                }
                ?>
            </table>
        </div>
</div>

    <?php include('partials/footer.php') ?>