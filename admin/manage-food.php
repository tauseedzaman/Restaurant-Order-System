<?php include("../admin/partials/menu.php" ); ?>

<div class="main-content footer_bottom">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <br>
            <a href="<?php echo SITE_URL.'admin/add-food.php'; ?>" class="btn-primary">Add Food

            </a>
        <br /><br /><br />

        <?php 
            $sl = 1;
            $add_food = isset( $_SESSION['food-add'] ) ? $_SESSION['food-add'] : '';
            echo $add_food;
            unset( $_SESSION['food-add'] ); 

            $delete_food = isset( $_SESSION['delete-food'] ) ?  $_SESSION['delete-food'] : '';
            echo $delete_food;
            unset( $_SESSION['delete-food'] );

            $image_remove_failed = isset( $_SESSION['image-remove-failed'] ) ? $_SESSION['image-remove-failed'] : '';
            echo $image_remove_failed;
            unset( $_SESSION['image-remove-failed'] );

            $food_delete = isset( $_SESSION['food-deleted'] ) ?  $_SESSION['food-deleted'] : '';
            echo $food_delete;
            unset( $_SESSION['food-deleted'] );

            $update_image_failed = isset( $_SESSION['update-food-image-failed'] ) ?  $_SESSION['update-food-image-failed'] : '';
            echo $update_image_failed;
            unset( $_SESSION['update-food-image-failed'] );

            $update_food = isset( $_SESSION['food-updated'] ) ?  $_SESSION['food-updated'] : '';
            echo $update_food;
            unset( $_SESSION['food-updated'] );
        ?>
        <table class="tbl-full" >
            <thead>
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
<?php
                $sql    = "SELECT * FROM resto_food";
                $result = mysqli_query( $conn, $sql );
                $rows = mysqli_num_rows($result);
                if( $rows ) {
                    while( $row = mysqli_fetch_assoc( $result ) ) {
                        $id          = isset( $row['id'] ) ? $row['id'] : '';
                        $title       = isset( $row['title'] ) ? $row['title'] : '';
                        $description = isset( $row['description'] ) ? $row['description'] : '';
                        $price       = isset( $row['price'] ) ? $row['price'] : '';
                        $image_name  = empty( $row['image_name'] ) ? ( '<div class="error">Image Not Added!</div>' ) : ( '<img src='.SITE_URL.'images/food/'.$row['image_name'].' width = 100px >' );
                        $featured    = isset( $row['featured'] ) ? $row['featured'] : '';
                        $active      = isset( $row['active'] ) ? $row['active'] : '';
                        ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $image_name; ?></td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href=<?php echo SITE_URL.'admin/update-food.php?id='.$id; ?> class="btn" style="margin:10px" class="" title="edit this">

                                        <svg style="width: 4%;color:orange;margin-left:1px;margin:2px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-edit" class="svg-inline--fa fa-user-edit fa-w-20" role="img" xmlns="" viewBox="0 0 640 512">
                                            <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h274.9c-2.4-6.8-3.4-14-2.6-21.3l6.8-60.9 1.2-11.1 7.9-7.9 77.3-77.3c-24.5-27.7-60-45.5-99.9-45.5zm45.3 145.3l-6.8 61c-1.1 10.2 7.5 18.8 17.6 17.6l60.9-6.8 137.9-137.9-71.7-71.7-137.9 137.8zM633 268.9L595.1 231c-9.3-9.3-24.5-9.3-33.8 0l-37.8 37.8-4.1 4.1 71.8 71.7 41.8-41.8c9.3-9.4 9.3-24.5 0-33.9z"></path>
                                        </svg></a>
                                    <a href=<?php echo SITE_URL.'admin/delete-food.php?id='.$id."&image_name=".$row['image_name']; ?> class=""  style="margin:10px" class=""  title="delete this">
                                        <svg aria-hidden="true" style="width: 3%;color:red;margin-left:1px;margin-right:1px" focusable="false" data-prefix="fas" data-icon="trash-alt" class="svg-inline--fa fa-trash-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
                                        </svg>
                                        </a>
                                </td>
                            </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class = 'error'>Food Not Added Yet!</td></tr>";
                }
            ?>
            </tbody>

        </table>    
    </div>
</div>

<?php  include("../admin/partials/footer.php"); ?>