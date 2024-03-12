<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE ADMIN</h1>

        <br><br>

        <?php
        //1. Get the ID of Selected Admin
        $id = $_GET['id'];

        //2. Create SQL Query to Get the Details
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query is executed or not
        if ($res == true) {
            //Check whether the data is a avaiable or not
            $count = mysqli_num_rows($res);
            //Check whether we have admin data or not
            if ($count == 1) {
                //Get the Details
                //echo "Admin Available";
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                //Redirect to Manager Admin Page
                header('location:' . SITEURL . 'amin/manager-admin');
            }
        }

        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your fullname." value='<?php echo $full_name ?>'>
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name='username' placeholder="Enter your username." value='<?php echo $username ?>'>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php
//Check whether The Submit Button is clicked ot not 
if (isset($_POST['submit'])) {
    //echo "Button clicked.";
    //Get all values from Form Update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //Create a SQL query to Update Admin
    $sql = "UPDATE tbl_admin SET 
    username = '$username', full_name = '$full_name' 
    WHERE id = '$id'";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the Query executed successfully or not
    if ($res == true) {
        //Query Executed and Admin Updated
        $_SESSION['update'] = '<div class="success">Admin Updated successfully<div>';
        //Redirect to Manager Admin Page
        header('location:' . SITEURL . 'admin/manager-admin.php');
    } else {
        //Failed to Update Admin
        $_SESSION['update'] = '<div class="error">Failed to Update Admin<div>';

        header('location:' . SITEURL . 'admin/manager-admin.php');
    }
}
?>

<?php include('partials/footer.php') ?>