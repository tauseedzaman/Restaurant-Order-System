<?php include("../admin/partials/menu.php" );?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php 
            $id = isset( $_POST['id'] ) ? $_POST['id'] : '';


        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>
                        <td>Current Password: </td>
                        <td>
                            <input type="password" name="old_password" value="">
                        </td>
                    </td>
                </tr>

                <tr>
                    <td>
                        <td>New Password: </td>
                        <td>
                            <input type="password" name="new_password" value="">
                        </td>
                    </td>
                </tr>

                <tr>
                    <td>
                        <td>Confirm Password: </td>
                        <td>
                            <input type="password" name="con_password" value="">
                        </td>
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
    /**
     * Check Whether The Submit Button Is Clicked Or Not
     */
    if( isset($_POST['submit']) ) {

        /**
         * Get Password From Database
         */
        $id = $_GET['id'];
        $current_password = isset( $_POST['old_password'] ) ? md5( $_POST['old_password']  ): '';
        $new_password = isset( $_POST['new_password'] ) ? md5( $_POST['new_password']  ): '';
        $confirm_password =  isset( $_POST['con_password'] ) ? md5( $_POST['con_password']  ): '';


        $sql = "SELECT PASSWORD FROM resto_admin WHERE ID = {$id} AND PASSWORD = '{$current_password}'";
        $result = mysqli_query($conn, $sql);

        if( $result ) {

            $count = mysqli_num_rows($result);

            if( $count ) {

                /**
                 * If Confirm And New Passwords Match
                 */
                if( $new_password === $confirm_password ) {
                    $sql2 = "UPDATE resto_admin SET `password` = '$new_password' WHERE ID = {$id}";
                    $result_2 = mysqli_query( $conn, $sql2 ); 
                    if( $result_2 ) {
                        $_SESSION['update-password'] = '<div class="success">Password Updated Successfully</div>';
                    } else{
                        $_SESSION['update-password'] = '<div class="error">Failed To Change Password</div>';
                    }

                } else {

                    /**
                     * Redirect If Condition Fail
                     */
                    $_SESSION['pwd-not-match'] = '<div class="error">Password Does Not Match</div>';
                }

            } else {
                $_SESSION['user-not-found'] = '<div class="error">User Not Found</div>';
            }

            header("location:".SITE_URL."admin/manage-admin.php");
        }
    }
?>

<?php include("../admin/partials/footer.php");?>
