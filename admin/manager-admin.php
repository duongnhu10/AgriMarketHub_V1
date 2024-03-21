<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="main-content">

    <div class="wrapper">

        <h1>QUẢN LÝ QUẢN TRỊ VIÊN</h1>
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

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //Displaying session message
            unset($_SESSION['update']); //Removing session message
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //Displaying session message
            unset($_SESSION['update']); //Removing session message
        }

        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; //Displaying session message
            unset($_SESSION['user-not-found']); //Removing session message
        }

        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match']; //Displaying session message
            unset($_SESSION['pwd-not-match']); //Removing session message
        }

        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd']; //Displaying session message
            unset($_SESSION['change-pwd']); //Removing session message
        }

        ?>

        <br><br>

        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">Thêm quản trị viên</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Họ và tên</th>
                <th>Tên người dùng</th>
                <th>Trạng thái</th>
            </tr>

            <?php
            //Query to Get all Admin
            $sql = "SELECT * FROM admin";
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
                        $ho_va_ten = $rows['ho_va_ten'];
                        $ten_nguoi_dung = $rows['ten_nguoi_dung'];
                        // $password = $rows['password'];

                        //Display the values in our Table
            ?>
                        <tr>
                            <td><?php echo  $sn++; ?></td>
                            <td><?php echo  $ho_va_ten; ?></td>
                            <td><?php echo  $ten_nguoi_dung; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Đổi mật khẩu</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Xóa</a>
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