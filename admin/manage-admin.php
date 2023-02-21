<?php include('partials/menu.php') ?>
    <!-- This is the main section -->
    <div class="main-content">
    <div class ="wrapper">
            <h1>Manage admin</h1>
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

                <tr>
                    <td>1</td>
                    <td>CM</td>
                    <td>CM1</td>
                    <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>CM</td>
                    <td>CM1</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>CM</td>
                    <td>CM1</td>
                    <td>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>
            </table>
        </div>
</div>

    <?php include('partials/footer.php') ?>