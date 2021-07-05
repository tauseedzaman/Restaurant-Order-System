<?php include( "./partials-front/menu.php" ) ?>; 

    <!-- CAtegories Section Starts Here -->
    <section class  ="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                $sql    = "SELECT * FROM resto_category WHERE active = 'yes'";
                $result = mysqli_query( $conn, $sql );
                $rows   = mysqli_num_rows($result);
                if( $rows ) {
                    while( $row = mysqli_fetch_assoc( $result ) ) {
                        $id         = isset( $row['ID'] ) ? $row['ID'] : '';
                        $title      = isset( $row['title'] ) ? $row['title']: '';
                        $image_name = isset( $row['image_name'] ) ? $row['image_name'] : '';
                        $featured   = isset( $row['featured'] ) ? $row['featured'] : '';
                        $active     = isset( $row['active'] ) ? $row['active'] : ''; 
                        ?>
                            <a href="<?php echo SITE_URL.'category-foods.php?category_id='.$id; ?>">
                                <div class="box-3 float-container box-3-text  zoom-in">
                                    <?php
                                        if( !empty( $image_name ) ) {
                                            ?>
                                                <img src="<?php echo SITE_URL.'images/category/'.$image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                            <?php
                                        } else {
                                            echo '<div class="error">Image Not Found</div>';
                                        }
                                    ?>
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php

                    }
                } else {
                    echo '<div class="error">Category Not Found</div>';
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
    
<?php include( "./partials-front/footer.php" ) ?>; 