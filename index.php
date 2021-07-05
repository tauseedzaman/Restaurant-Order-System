<?php include( "./partials-front/menu.php" ) ?>; 

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITE_URL.'food-search.php'?>" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- FOOD SEARCH Section Ends Here -->
    <?php
        $order = isset( $_SESSION['order-saved-in-database'] ) ?  $_SESSION['order-saved-in-database'] : '';
        echo $order;
        unset( $_SESSION['order-saved-in-database'] );
    ?>
    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                $sql    = "SELECT * FROM resto_category WHERE featured = 'yes' AND active = 'yes' LIMIT 3";
                $result = mysqli_query( $conn, $sql );
                $rows   = mysqli_num_rows($result);
                if( $rows ) {
                    while( $row = mysqli_fetch_assoc( $result ) ) {
                        $id         = $row['ID'];
                        $title      = $row['title'];
                        $image_name = isset( $row['image_name'] ) ? $row['image_name'] : '';
                        $featured   = $row['featured'];
                        $active     = $row['active']; 
                        ?>
                            <a href="<?php echo SITE_URL.'category-foods.php?category_id='.$id; ?>">
                                <div class="box-3 float-container box-3-text  zoom-in">
                                    <?php 
                                        if( !empty( $image_name ) ) {
                                            ?>
                                                <img src="<?php echo SITE_URL.'images/category/'.$image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                            <?php
                                        } else {

                                            echo '<div class="error">Image Not Available</div>';
                                            
                                        }
                                    ?>
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                } else {
                    echo '<div class="error"> Category Not Added! </div>';
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
                <?php
                    $sql2    = "SELECT  * FROM resto_food WHERE featured = 'yes' AND active = 'yes'";
                    $result2 = mysqli_query( $conn, $sql2 );
                    $rows2   = mysqli_num_rows($result2);
                    if( $rows2 ) {
                        while( $row = mysqli_fetch_assoc( $result2 ) ) {
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
                                                    <img src="<?php echo SITE_URL.'images/food/'.$image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                                <?php
                                            } else{
                                                echo '<div class="error">Image Not Available</div>';
                                            }
                                        ?>
                                    </div>
                                    <div class="food-menu-desc">
                                        <h4><?php echo $title; ?></h4>
                                        <p class="food-price"><?php echo $price; ?></p>
                                        <php class="food-detail">
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

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
    
<?php include( "./partials-front/footer.php" ) ?>; 
  