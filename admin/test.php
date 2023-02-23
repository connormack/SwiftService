<?php include("partials/menu.php"); ?>

<div class ="main content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php

        // get admin id 
        $id=$_GET['id'];

        // SQL query to get details
        $sql = "SELECT * FROM tbl_admin";

        // call query 
        $res=sqli_query($conn, $sql);

        // check query
        if($res==true)
        {
            // check data is there 
            $count = mysqli_num_rows($res);
            // check if admin data there 
            if($count==1)
            {
                //get detials
                echo "ADMIN AVAIBL";
            }
            else
            {
                // redirect to admin 
                echo "hey";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        ?>

        <form action="" method="POST">

        <table class="tbl-30">
        <tr>
            <td>Full Name:</td>
            <td>        
            <input type="text"  name ="full_name" value ="">
            </td> 
        </tr>

        <tr>
            <td>username: </td>
            <td>
                <input type="text" name="username" value="">
            </td>
        </tr>

        <tr>
            <td colspan ="2">
            <input type="submit" name ="submit" value ="update Admin" class="btn-secondary">
            </td>
        </tr>

        </table>

        </form>

    </div>
</div>

<?php include("partials/footer.php");?>