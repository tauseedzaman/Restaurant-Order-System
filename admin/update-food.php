<?php include("../admin/partials/menu.php" ); ?> 

<div class="main-content">
    <div class="wrapper">
    <h1>Update Food</h1>
        <?php

            /**
             * Fetch The Data From Database Using Food ID
             */
            $id                 = $_GET['id'];
            $sql                = "SELECT * FROM resto_food WHERE id = '{$id}'";
            $result             = mysqli_query( $conn, $sql ); 
            $rows               = mysqli_fetch_assoc($result);
            $title              = isset( $rows['title'] ) ? $rows['title'] : '';
            $description        = isset( $rows['description'] ) ? $rows['description'] : '';
            $price              = isset( $rows['price'] ) ? $rows['price'] : '';
            $current_image_name = isset( $rows['image_name'] ) ? $rows['image_name'] : '';
            $category_id        = isset( $rows['category_id'] ) ? $rows['category_id'] : '';
            $featured           = isset( $rows['featured'] ) ?  $rows['featured'] : '';
            $active             = isset( $rows['active'] ) ? $rows['active'] : '' ; 

        ?>
    <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php echo !empty( $current_image_name ) ? '<img src='.SITE_URL.'images/food/'.$current_image_name.' width="150px"></img>':'<div class="error">Image Not Available</div>';?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image</td>
                    <td>
                        <input type="file" name="new_image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                        <?php
                           /**
                             * Fetch The Active Categories
                             */
                            $sql2 = "SELECT * FROM resto_category WHERE active = 'yes'";
                            $result2 = mysqli_query( $conn, $sql2 );
                            $rows2 = mysqli_num_rows( $result2 );
                            if( $rows2 ) {
                                while( $row = mysqli_fetch_assoc( $result2 ) ) {
                                    if( $row['ID'] == $category_id ) {
                                        $selected = 'selected';
                                    }
                                    ?>
                                        <option value="<?php echo $row['ID'];?>"<?php echo $selected; ?>><?php echo $row['title']; ?></option>
                                    <?php
                                    $selected = '';
                                }
                            } else {
                                echo '<option value="0">Category Not Available</option>';
                            }
                        ?>
                           
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes" <?php if( $featured === 'yes'){echo 'checked'; } ?>>Yes
                        <input type="radio" name="featured" value="no" <?php if( $featured === 'no' ){echo 'checked'; } ?>>No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes" <?php if( $active === 'yes'){ echo 'checked'; } ?>>Yes
                        <input type="radio" name="active" value="no"<?php if( $active === 'no') {echo 'checked'; } ?>>No
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image_name; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if( isset( $_POST['submit'] ) ) {
                $id                  = $_GET['id'];
                $title               = isset( $_POST['title'] ) ? $_POST['title'] : '';
                $description         = isset( $_POST['description'] ) ? $_POST['description'] : '';
                $price               = isset( $_POST['price'] ) ? $_POST['price'] : '';
                $existing_image_name = isset( $_POST['current_image']  ) ? $_POST['current_image']  : '' ;
                $category_id         = isset( $_POST['category'] ) ? $_POST['category'] : '';
                $featured            = isset( $_POST['featured'] ) ?  $_POST['featured'] : '';
                $active              = isset( $_POST['active'] ) ? $_POST['active'] : '' ;
                
                $new_updated_image = isset( $_FILES['new_image'] ) ? $_FILES['new_image'] : '';

                /**
                 * If New Image File Exists Then Update The Existing Image Name
                 */
                if( !empty( $new_updated_image['name'] ) ) {

                    $new_updated_image_name        = $new_updated_image['name'];
                    $new_updated_image_first       = explode( '.' ,$new_updated_image_name )[0];
                    $new_updated_image_ext         = explode( '.', $new_updated_image_name)[1];
                    $rename_new_updated_image_name = $new_updated_image_first."_".rand(000, 999).".".$new_updated_image_ext;
                    $image_file_location           = $new_updated_image['tmp_name'];
                    $store_image_destination       ='../images/food/'.$rename_new_updated_image_name;
                    
                    /**
                     * First Remove The Existing Image File Prior To Replacing It With New One
                     */
                    $remove = unlink('../images/food/'.$existing_image_name );

                    if( $remove ) {
                        $upload = move_uploaded_file( $image_file_location, $store_image_destination );
                        if( !$upload ) {
                            $_SESSION['update-food-image-failed'] = '<div class="error">Failed To Update New Image</div>';
                            header("location:".SITE_URL."admin/manage-food.php");
                            die();
                        }
                        $existing_image_name = $rename_new_updated_image_name;
                    }

                }

                $sql2 = "UPDATE resto_food SET title = '{$title}', description = '{$description}', price = '{$price}', image_name = '{$existing_image_name}', category_id = '{$category_id}', featured = '{$featured}', active = '{$active}' WHERE id = '{$id}' ";
                $result = mysqli_query( $conn, $sql2 );

                if( $result ) {
                    $_SESSION['food-updated'] = '<div class="success">Food Updated Successfully!</>';
                } else {
                    $_SESSION['food-updated'] = '<div class="error">Unable To Update Food!</>';
                }

                header("location:".SITE_URL."admin/manage-food.php");
            }
        ?>

    </div>
</div>

<?php include("../admin/partials/footer.php"); ?>

