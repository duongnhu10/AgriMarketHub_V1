<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="main-content">

    <div class="wrapper">

        <h1>DANH MỤC NGƯỜI DÙNG</h1>
        <br><br>

        <?php

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];  //Displaying session message
            unset($_SESSION['delete']); //Removing session message
        }

        ?>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Tên người dùng</th>
                <th>Doanh nghiệp</th>
                <th>Giới tính</th>
                <th>Hành động</th>
            </tr>

            <?php
            //Query to Get all Admin
            $sql = "SELECT * FROM khach_hang";
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
                        $gioi_tinh = $rows['gioi_tinh'];
                        $doanh_nghiep = $rows['doanh_nghiep'];
                        // $password = $rows['password'];

                        //Display the values in our Table
            ?>
                        <tr>
                            <td><?php echo  $sn++; ?></td>
                            <td><?php echo  $ho_va_ten; ?></td>
                            <td><?php echo  $ten_nguoi_dung; ?></td>
                            <td><?php if ($doanh_nghiep == 1)
                                    echo "Có";
                                else echo "Không";  ?></td>

                            <td><?php
                                if ($gioi_tinh == 1)
                                    echo "Nữ";
                                else echo "Nam"; ?></td>

                            <td>
                                <a href="<?php echo SITEURL; ?>admin/delete-user.php?id=<?php echo $id; ?>" class="btn-danger">Xóa người dùng</a>
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