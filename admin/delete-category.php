<?php

include( "../config/constants.php" ); 

if( isset( $_GET['image_name'] ) && isset( $_GET['id'] ) ) {

    $id         = $_GET['id'];
    $image_name = $_GET['image_name'];

    /**
     * Remove The Physical Image File
     */
    if( !empty( $image_name ) ) {
        $path = "../images/category/".$image_name;
        if(file_exists($path)){
        
        $remove = unlink($path);

        /**
         * If Delete Has Not Occured Then Throw An Error Message
         */
        if( !$remove ) {    
            $_SESSION['remove'] = '<div class="error">Failed To Remove Category</div>';
            header('location:'.SITE_URL.'admin/manage-category.php');
            die();
        }
    }
}

    /**
     * SQL Query To Delete Image Name From The Database
     */
    $sql = "DELETE FROM resto_category WHERE id = '$id'";
    $result = mysqli_query( $conn, $sql );

    if( $result ) {
        $_SESSION['delete-category'] = '<div class="success">Category Deleted Successfully!</div>';
    } else {
        $_SESSION['delete-category'] = '<div class="error">Failed To Delete Category!</div>';
    }

    header('location:'.SITE_URL.'admin/manage-category.php');

} else {
    header('location:'.SITE_URL.'admin/manage-category.php');
}