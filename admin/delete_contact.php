<?php
include( "../config/constants.php" );
/**
 * Get The ID Of The row For Deletion
 */
$id = $_REQUEST['id'];

/**
 * SQL Query For Deletion Of The contact message
 */
$sql = "DELETE FROM resto_contact WHERE id = {$id}";
$res = mysqli_query($conn, $sql);

if( $res ) {
    $_SESSION['delete'] = "<div class='success'>Row Deleted Successfully</div>";
} else {
    $_SESSION['delete'] = "<div class='error'>Failed To Delete, Please Try Again Later</div>";
}

/**
 * Redirect To Manage contact Page After Deletion(Show Success Message/Error Message)
 */
header('location:'.SITE_URL.    'admin/manage-contact.php');