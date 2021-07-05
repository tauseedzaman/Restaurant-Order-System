<?php
include( "../config/constants.php" );
/**
 * Get The ID Of The Admin For Deletion
 */
$id = $_REQUEST['id'];

/**
 * SQL Query For Deletion Of The Admin
 */
$sql = "DELETE FROM resto_admin WHERE ID = {$id}";
$res = mysqli_query($conn, $sql);

if( $res ) {
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
} else {
    $_SESSION['delete'] = "<div class='error'>Failed To Delete, Please Try Again Later</div>";
}

/**
 * Redirect To Manage Admin Page After Deletion(Show Success Message/Error Message)
 */
header('location:'.SITE_URL.    'admin/manage-admin.php');