<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="main-content">

    <div class="wrapper">

        <h1>MANAGER ADMIN</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  //Displaying session message
            unset($_SESSION['add']); //Removing session message
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];  //Displaying session message
            unset($_SESSION['delete']); //Removing session message
        }
        ?>
        <br><br>

        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">Add admin</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Full name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <?php
            //Query to Get all Admin
            $sql = "SELECT * FROM tbl_admin";
            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check whether the Query is Executed or Not
            if ($res == TRUE) {
                //Count Rows to Check whether we have data in database or not
                $count = mysqli_num_rows($res); //Function to get all the rows in database

                $sn = 1; //Create a Variable and Assign the value

                //check the num of rows
                if ($count > 0) {
                    //We have data in database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //Using while loop to get all the data form database
                        //And while loop will run as long as we have data in database

                        //Get individual Data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
                        // $password = $rows['password'];

                        //Display the values in our Table
            ?>
                        <tr>
                            <td><?php echo  $sn++; ?></td>
                            <td><?php echo  $full_name; ?></td>
                            <td><?php echo  $username; ?></td>
                            <td>
                                <a href="#" class="btn-secondary">Update admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete admin</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    //We do not have data in database
                }
            }
            ?>

        </table>

    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>