<?php include( "../admin/partials/menu.php" ); ?>

<div class="main-content" style="width:100%;" >
    <div class="wrapper" style="width:70%;" class="login" >
    <h1 style="text-align:center;color:darkgreen">Add New Food</h1>
            <br>
        <br>
        <?php
            $upload_image_message = isset(  $_SESSION['upload-food-image'] ) ?  $_SESSION['upload-food-image'] : '';
            echo $upload_image_message;
            unset( $_SESSION['upload-food-image'] );
        ?>
         <!-- Add Category Form -->
         <div class="login" style="width: 50%;margin-top:2%">
            <form action="" method="POST" enctype="multipart/form-data">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" placeholder="Title of the food" class="form-input"><br><br>

            <label for="description" class="form-label">Description</label>
            <textarea type="text" name="description" placeholder="Description of the food" class="form-input"></textarea><br><br>

            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" placeholder="Price of the food" class="form-input"><br><br>

            <label for="image" class="form-label">Food Image</label>
            <input type="file" style="background-color: white;"  name="image"  class="form-input"><br><br>

            <label for="category" class="form-label">Food category</label>
            <select name="category"  class="form-input">
                            <?php 
                                /**
                                 * Get And Display Categories From The Database
                                 */
                                $sql    = "SELECT ID, title FROM resto_category WHERE active = 'yes'";
                                $result = mysqli_query($conn, $sql);
                                $rows = mysqli_num_rows($result); 
                                if( $rows ) {
                                    while( $data = mysqli_fetch_assoc($result) ) {
                                        $id = $data['ID'];
                                        $title = $data['title'];
                                        ?>
                                            <option value=<?php echo $id; ?>><?php echo $title; ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                        <option value = 0 > No Category </option>
                                    <?php
                                }
                            ?>
                        </select>
                        <br><br>
            <label for="featured" class="form-label">Featured</label><br>
            <input type="radio" name="featured" value="yes" class="form-radio">Yes</input>
            <input type="radio" name="featured" value="no" class="form-radio">No</input><br><br>
                                <br>
            <label for="active" class="form-label">Active</label><br>
            <input type="radio" name="active" value="yes" class="form-radio">Yes</input>
            <input type="radio" name="active" value="no" class="form-radio">No</input><br><br>

            <input type="submit" name="submit" value="Add Food" class="btn-submit">
        </form><br><br>
    </div>

        <?php
            if( isset( $_POST['submit'] ) ) {
                $title       = isset( $_POST['title'] ) ? $_POST['title'] : '';
                $description = isset( $_POST['description'] ) ? $_POST['description'] : '';
                $price       = isset( $_POST['price'] ) ? $_POST['price'] : '';
                $image       = isset( $_FILES['image'] ) ? $_FILES['image'] : '';
                $category    = isset( $_POST['category'] ) ? $_POST['category'] : '';
                $featured    = isset( $_POST['featured'] ) ? $_POST['featured'] : 'no';
                $active      = isset( $_POST['active'] ) ? $_POST['active'] : 'no';

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
                        $store_image_destination = '../images/food/'.$new_image_name;
                        $upload                  = move_uploaded_file( $image_file_location, $store_image_destination ); 
                        
                        if( !$upload ) {
                            $_SESSION['upload-food-image'] = "<div class='error'>Failed To Upload Image!ss</div>";
                            header("location:".SITE_URL."admin/add-food.php");
                        }
                    }
                }

                $sql = "INSERT into resto_food (title, description, price, image_name, category_id, featured, active) VALUES ( '$title','$description','$price','$new_image_name', '$category', '$featured','$active' )";
                $result = mysqli_query( $conn, $sql );

                if( $result ) {
                    $_SESSION['food-add'] = '<div class="success">Food Added Successfully!</div>';
                    header("location:".SITE_URL."admin/manage-food.php");
                } else {
                    $_SESSION['food-add'] = '<div class="error">Failed To Add Food!</div>';
                    header("location:".SITE_URL."admin/manage-food.php");
                }
            }
        ?>

    </div>
</div>
<?php  include( "../admin/partials/footer.php"); ?>