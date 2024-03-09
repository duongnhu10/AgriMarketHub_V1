<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>ADD ADMIN</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) { //Checking whether the session is Set or Not
            echo $_SESSION['add']; //Displaying session Message
            unset($_SESSION['add']); //Removing session Message
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">

                <tr>
                    <td>Full name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    <td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your username">
                    <td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your password">
                    <td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" class="btn-secondary" value="Add admin">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php include('partials/footer.php') ?>

<?php
//Process the value from Form and Save it Database
//Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Button Clicked
    // echo "Button Clicked";

    //1. Get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Encryption with MD5

    //2. SQL Query to Save the data into database
    $sql = "INSERT INTO tbl_admin SET 
            full_name = '$full_name',
            username = '$username',
            password = '$password'
    ";

    //3. Executting Query and Save Data in Database
    $res = mysqli_query($conn, $sql);

    //4. Check whether the (Query is Excuted) data is inserted
    if ($res == TRUE) {
        //Data Inserted
        //echo "Data Inserted";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "Admin Added Successfully";
        //Redirect Page to Manager Admin
        header("location:" . SITEURL . "admin/manager-admin.php");
    } else {
        //Failed to Insert
        // echo "Faile to Insert Data";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "Failed to Add Admin";
        //Redirect Page to Add Admin
        header("location:" . SITEURL . "admin/add-admin.php");
    }
}
?>