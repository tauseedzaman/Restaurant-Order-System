<?php include( "../admin/partials/menu.php" ); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1 style="text-align:center;color:darkgreen">Add New Category</h1>
            <br><br>
            <style>
                .form-radio{
                    margin: 2 10px;
                }
            </style>
            <?php
                $add_category = isset( $_SESSION['add'] ) ? $_SESSION['add'] : '';
                echo $add_category;
                unset( $_SESSION['add'] );

                $failed_upload = isset( $_SESSION['upload'] ) ? $_SESSION['upload'] : '';
                echo $failed_upload;
                unset($_SESSION['upload']);
            ?>
            <!-- Add Category Form -->
            <div class="login" style="width: 50%;margin-top:2%">
            <form action="" method="POST" enctype="multipart/form-data">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" placeholder="Enter Category Title" class="form-input"><br><br>

            <label for="Image" class="form-label">Choose Image</label>
            <input type="file" style="background-color: white;"  name="image"  class="form-input"><br><br>


            <label for="featured" class="form-label">Featured</label><br>
            <input type="radio" name="featured" value="yes" class="form-radio">Yes</input>
            <input type="radio" name="featured" value="no" class="form-radio">No</input><br><br>

            <label for="active" class="form-label">Active</label><br>
            <input type="radio" name="active" value="yes" class="form-radio">Yes</input>
            <input type="radio" name="active" value="no" class="form-radio">No</input><br><br>

            <input type="submit" name="submit" value="Add Category" class="btn-submit">
        </form><br><br>
    </div>

    <?php
            if( isset( $_POST['submit'] ) ) {
                $title       = isset( $_POST['title'] ) ? $_POST['title'] : '';
                $image       = isset( $_FILES['image'] ) ? $_FILES['image'] : '';
                $active      = isset( $_POST['active'] ) ? $_POST['active'] : 'no';
                $featured      = isset( $_POST['featured'] ) ? $_POST['featured'] : 'no';

                if( $image ) {

                    $image_name = $image['name'];

                    /**
                     * If Image Or Image Name Is Selected By The Admin
                     */
                    if( !empty( $image_name ) ) {
                        $name_and_extension      =  explode('.',$image_name);
                        $name                    = $name_and_extension[0];
                        $extension               = $name_and_extension[1];
                        $new_image_name          = $name.'_'.rand(000, 999).'.'.$extension;
                        $image_file_location     = $image['tmp_name'];
                        $store_image_destination = '../images/category/'.$new_image_name;
                        $upload                  = move_uploaded_file( $image_file_location, $store_image_destination ); 
                        
                        if( !$upload ) {
                            $_SESSION['upload-food-image'] = "<div class='error'>Failed To Upload Image!</div>";
                            header("location:".SITE_URL."admin/add-category.php");
                        }
                    }
                }

                $sql = "INSERT into resto_category (title,image_name, featured, active) VALUES ( '$title','$new_image_name','$featured','$active' )";
                
                $result = mysqli_query( $conn, $sql );


                if( $result ) {
                    $_SESSION['add_category'] = '<div class="success">Category Added Successfully!</div>';
                    header("location:".SITE_URL."admin/manage-category.php");
                } else {
                    $_SESSION['add_category'] = '<div class="error">Failed To Add Category!</div>';
                    header("location:".SITE_URL."admin/manage-category.php");
                }
            }
        ?>

        </div>
    </div>
<?php include( "../admin/partials/footer.php"); ?>
