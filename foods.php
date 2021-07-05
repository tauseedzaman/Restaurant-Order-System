<?php include( "./partials-front/menu.php" ) ?> 

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITE_URL.'food-search.php'; ?>" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql    = "SELECT * FROM resto_food WHERE active = 'yes'";
                $result = mysqli_query( $conn, $sql );
                $rows   = mysqli_num_rows( $result );
                if( $rows ) {
                    while( $row = mysqli_fetch_assoc( $result ) ) {
                        $id          = $row['id'];
                        $title       = $row['title'];
                        $description = $row['description'];
                        $price       = $row['price'];
                        $image_name  = $row['image_name']; 
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if( !empty( $image_name ) ) {
                                            ?>
                                                <img src="<?php echo SITE_URL.'images/food/'.$image_name; ?>" alt="<?php echo $image_name; ?>" class="img-responsive img-curve">
                                            <?php
                                        } else {
                                            echo '<div class="error">Image Not Available</div>';
                                        }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <php class="food-price"><?php echo $price; ?></p>
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
                    echo '<div>No Food Found!</div>';
                }
            ?>
            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


<?php include( "./partials-front/footer.php" ) ?>; 