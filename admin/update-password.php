<?php include("./partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>CHANGE PASSWORD</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <!-- Create form  -->
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">
                    </td>
                </tr>

                <tr>
                    <td>New password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>

                <tr>
                    <td>Comfirm password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php
//Check whether the Submit Button is clicked or Not
if (isset($_POST['submit'])) {
    //echo "Clicked"

    //1. Get the data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. Check whether the user with current ID and Current Password Exists or Not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_password'";

    //Execute the query
    $res = mysqli_query($conn, $sql);


    if ($res == true) {

        //Check whether data is avaiable
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //User exist and password can change
            //echo "User found";

            //Check whether the new password and confirm match ot not
            if ($new_password == $confirm_password) {
                //Update the password
                //echo "Password Match";
                $sql2 = "UPDATE tbl_admin SET 
                        password = '$new_password'
                        WHERE id=$id";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether the Query executed or not
                if ($res2 == true) {
                    //Display successfully message
                    //Redirect to the manager-admin page with success message
                    $_SESSION['change-pwd'] = "<div class='success'>Password Change Successfully</div>";
                    //Redirect the User
                    header("location:" . SITEURL . "/admin/manager-admin.php");
                } else {
                    //Display error message with error message
                    //Redirect to the manager-admin page with error message
                    $_SESSION['change-pwd'] = "<div class='error'>Fail to change password</div>";
                    //Redirect the User
                    header("location:" . SITEURL . "/admin/manager-admin.php");
                }
            } else {
                //Redirect to the manager-admin page with error message
                $_SESSION['pwd-not-match'] = "<div class='error'>Password Dis Not Match</div>";
                //Redirect the User
                header("location:" . SITEURL . "/admin/manager-admin.php");
            }
        } else {
            //User does not exist set message and redirect 
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
            //Redirect the User
            header("location:" . SITEURL . "/admin/manager-admin.php");
        }
    }
}

?>

<?php include("./partials/footer.php") ?>