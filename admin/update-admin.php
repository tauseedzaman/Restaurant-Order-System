<?php include("../admin/partials/menu.php" ); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php 
               $id  = $_REQUEST['id'];
               $sql = "SELECT * FROM resto_admin Where ID = {$id}";
               $result = mysqli_query($conn, $sql);
               if( $result ) {
                   $count = mysqli_num_rows($result);
                   if( $count ) {
                       $row = mysqli_fetch_assoc($result);
                       $fullname = $row['full_name'];
                       $username = $row['user_name'];
                   } else {
                        header('location:'.SITE_URL.'admin/manage-admin.php');
                   }
               }  
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $fullname; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="update" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    if( isset( $_POST['update'] ) ) {
        $id = $_POST['id'];
        $fullname = $_POST['full_name'];
        $username = $_POST['username'];
        
        $sql = "UPDATE resto_admin SET `full_name` = '{$fullname}', `user_name` = '{$username}' WHERE id = {$id}";

        $res = mysqli_query($conn, $sql);

        if( $res ) {
            $_SESSION['update'] = '<div class = "success">Admin Updated Successfully</div>';
        } else {
            $_SESSION['update'] = '<div class = "error">Failed To Update Admin</div>';
        }
       
        header('location:'.SITE_URL.'admin/manage-admin.php');
    }
?>

<?php include("../admin/partials/footer.php"); ?>