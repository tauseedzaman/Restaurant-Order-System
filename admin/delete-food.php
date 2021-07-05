<?php
include( "../config/constants.php" ); 

if( isset( $_GET['id'] ) && isset( $_GET['image_name'])) {
    $id         = isset( $_GET['id'] ) ? $_GET['id'] : '';
    $image_name = isset( $_GET['image_name'] )  ? $_GET['image_name'] : '';

    if( $image_name ) {
        $image_path ='../images/food/'.$image_name; 
        if(file_exists($image_path)){
        $remove_from_folder = unlink($image_path);
        if( !$remove_from_folder ) {
            $_SESSION['image-remove-failed'] = '<div class="error">Failed To Remove Image File</div>';
            header("location:".SITE_URL."admin/manage-food.php");
            die();
        }
    }
    }

    $sql = "DELETE FROM resto_food WHERE id = {$id}";
    $result = mysqli_query( $conn, $sql );
    
    if( $result ) {
        $_SESSION['food-deleted'] = '<div class="success">Food Deleted Successfully!</div>';
    } else {
        $_SESSION['food-deleted'] = '<div class="error">Failed To Delete Food From Database!</div>';
    }

    header("location:".SITE_URL."admin/manage-food.php");

} else {
    $_SESSION['delete-food'] = '<div class="error">Unauthorized Access</div>';
    header("location:".SITE_URL."admin/manage-food.php");
}