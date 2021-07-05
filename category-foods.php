<?php include( "./partials-front/menu.php" ) ?> 

<?php 

    $category_id = $_GET['category_id'] ? $_GET['category_id'] : header( 'location:'.SITE_URL ); 

    /**
     * Get Category Title Based On Category ID
     */
    $sql    = "SELECT title from resto_category WHERE ID = '{$category_id}'";
    $result = mysqli_query( $conn, $sql );
    $row    = mysqli_fetch_assoc( $result );
    $category_title = $row['title'];
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <h2>Food On <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>
        </div>
    </section>
    <!-- FOOD SEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql2    = "SELECT * FROM resto_food WHERE category_id = '{$category_id}'";
                $result2 = mysqli_query( $conn, $sql2 );
                $rows    = mysqli_num_rows($result2);
                if( $rows ) {
                    while( $row2 = mysqli_fetch_assoc( $result2 ) ) {
                        $id          = isset( $row2['id'] ) ? $row2['id'] : ''; 
                        $title       = isset( $row2['title'] ) ? $row2['title'] : '';
                        $description = isset( $row2['description'] ) ? $row2['description'] : '';
                        $price       = isset( $row2['price'] ) ? $row2['price'] : '';
                        $image_name  = isset( $row2['image_name'] ) ? $row2['image_name'] : '';
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                <?php
                                    if( !empty( $image_name ) ) {
                                        ?>
                                            <img src="<?php echo SITE_URL.'images/food/'.$image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    } else {
                                        echo '<div class="error">Image Not Available</div>';
                                    }
                                ?>    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITE_URL.'order.php?food_id='.$id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                } else {
                    echo '<div class="error">Food Not Available</div>';
                }
            ?>
            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include( "./partials-front/footer.php" ) ?>; 