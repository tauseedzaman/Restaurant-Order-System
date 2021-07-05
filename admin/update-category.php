<?php include("../admin/partials/menu.php" ); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
        <?php
            $id = isset( $_GET['id'] ) ? $_GET['id'] : '';

            if( $id ) {
                $sql = "SELECT * FROM resto_category WHERE ID = '{$id}'";
                $result = mysqli_query( $conn, $sql ); 
                $count = mysqli_num_rows($result);
                if( $count ) {
                    $rows       = mysqli_fetch_assoc($result);
                    $title      = isset( $rows['title'] ) ? $rows['title'] : '';
                    $image_name = isset( $rows['image_name'] ) ?  $rows['image_name'] : '';
                    $featured   = isset( $rows['featured'] ) ? $rows['featured'] : '';
                    $active     = isset( $rows['active'] ) ? $rows['active'] : '';
                } else {
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                    header('location:'.SITE_URL.'admin/manage-category.php');
                }
            } else {
                header('location:'.SITE_URL.'admin/manage-category.php');
            }
        ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if( !empty( $image_name ) ) {
                                echo '<img src='.SITE_URL.'/images/category/'.$image_name.' width=150px >';
                            } else {
                                echo '<div class="error">Image Not Added</div>';
                            }
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="new_image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes" <?php if( $featured === 'yes'){ echo "checked"; } ?>>Yes
                        <input type="radio" name="featured" value="no" <?php if( $featured === 'no'){ echo "checked"; } ?>>No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes" <?php if( $active === 'yes'){ echo "checked"; } ?>>Yes
                        <input type="radio" name="active" value="no" <?php if(  $active === 'no'){ echo "checked"; } ?>>No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $image_name; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit"  name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if( isset( $_POST['submit'] ) ) {

                $id         = isset( $_POST['id'] ) ? $_POST['id'] : '';
                $title      = isset( $_POST['title'] ) ? $_POST['title'] : '';
                $image_name = isset( $_POST['current_image'] ) ?  $_POST['current_image'] : '';
                $featured   = isset( $_POST['featured'] ) ? $_POST['featured'] : '';
                $active     = isset( $_POST['active'] ) ? $_POST['active'] : '';
                
                /**
                 * Check If The New Image Name Is Not Empty
                 */
                if( !empty( $_FILES['new_image']['name'] ) ) {

                    /**
                     * If Current Image File Is Readable
                     */
                    if( !empty( $image_name ) ) {
                        $remove_path = is_readable("/images/category/".$image_name ) ?"/images/category/".$image_name : '';
                    }

                    /**
                     * If Current Image File Exists/Readable Them Delete The Current File
                     */
                    if( $remove_path ) {

                        $remove_current_image = unlink($remove_path);

                        if( !$remove_current_image ) {
                            $_SESSION['remove-failed'] = '<div class="error">Failed To Remove Current Image From The Root Folder</div>';
                            header("location:".SITE_URL."admin/manage-category.php");
                            die();
                        }
                    }

                    /**
                     * If Current Image Is Deleted Then Add The Details Of The New Image File
                     */
                    if( $remove_current_image ) {
                        $image_name        = $_FILES['new_image']['name'];
                        $first_value       = explode( '.', $image_name )[0];
                        $ext               = end ( explode ( '.',$image_name ) );
                        $image_name        = $first_value."_".rand(000, 999).".".$ext;
                        $image_source_path = isset( $_FILES['new_image']['tmp_name'] ) ? $_FILES['new_image']['tmp_name'] : '';
                        $destination_path  ="/images/category/".$image_name;
                        $upload            = ( isset( $image_name ) && isset( $image_source_path ) && isset( $destination_path ) ) ? move_uploaded_file( $image_source_path, $destination_path ) : '';
                        
                        if( !$upload ) {
                            $_SESSION['upload'] = '<div class="error">Failed To Upload Image</div>';
                            header("location:".SITE_URL."admin/manage-category.php");
                            die();
                        }
                    } else {
                        $image_name        = isset( $_FILES['new_image']['name'] ) ? $_FILES['new_image']['name'] : '';
                        $first_value       = explode( '.', $image_name )[0];
                        $ext               = end ( explode ( '.',$image_name ) );
                        $image_name        = $first_value."_".rand(000, 999).".".$ext;
                        $image_source_path = isset( $_FILES['new_image']['tmp_name'] ) ? $_FILES['new_image']['tmp_name'] : '';
                        $destination_path  ="/images/category/".$image_name;
                        $upload            = ( isset( $image_name ) && isset( $image_source_path ) && isset( $destination_path ) ) ? move_uploaded_file( $image_source_path, $destination_path ) : '';
                        
                        if( !$upload ) {
                            $_SESSION['upload'] = '<div class="error">Failed To Upload Image</div>';
                            header("location:".SITE_URL."admin/manage-category.php");
                            die();
                        }
                    }
                }



                $sql = "UPDATE resto_category SET title = '{$title}', image_name = '{$image_name}', featured = '{$featured}', active = '{$active}' WHERE ID = {$id}";
                $result = mysqli_query( $conn, $sql );
            
                if( $result ) {
                    $_SESSION['update'] = '<div class="success">Category Updated Successfully</div>';
                } else {
                    $_SESSION['update'] = '<div class="error">Failed To Update Category</div>';
                }

                header("location:".SITE_URL."admin/manage-category.php");
            }
        ?>

    </div>
</div>
<?php  include("../admin/partials/footer.php"); ?>