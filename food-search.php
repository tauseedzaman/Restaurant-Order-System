<?php include( "./partials-front/menu.php" ) ?> 

    <?php  $search = isset( $_POST['search'] ) ? $_POST['search'] : '';?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php
                /**
                 * Get The Foods Based On Search
                 */
                $sql    = "SELECT * FROM resto_food WHERE title LIKE '%{$search}%'";
                $result = mysqli_query( $conn, $sql );
                $rows   = mysqli_num_rows( $result );
                if( $rows ) {
                    while( $row = mysqli_fetch_assoc( $result ) ) {
                        $title       = isset( $row['title'] ) ? $row['title'] : '' ;
                        $description = isset( $row['description'] ) ? $row['description'] : '' ;
                        $price       = isset( $row['price'] ) ? $row['price'] : '';
                        $image_name  = isset( $row['image_name'] ) ? $row['image_name'] : '';
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if( !empty( $image_name ) ) {
                                            ?>  
                                                <img src="<?php echo SITE_URL.'images/food/'.$image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        } else {
                                            echo '<div class="error">Image Not Available</div>';
                                        }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $title; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                } else {
                    echo '<div class="success"><h1>Food Not Available</h1></div>';
                }
            ?>
            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include( "./partials-front/footer.php" ) ?>; 