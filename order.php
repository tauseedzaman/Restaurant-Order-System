<?php include( "./partials-front/menu.php" ); ?> 
    <?php 
        $food_id = isset( $_GET['food_id'] )? $_GET['food_id'] : header('location:'.SITE_URL);
        $sql     = "SELECT * FROM resto_food WHERE id = '{$food_id}'";
        $result  = mysqli_query( $conn, $sql );
        $rows    = mysqli_num_rows($result);
        if( $rows ) {
            $row         = mysqli_fetch_assoc($result);
            $title       = $row['title'];
            $description = $row['description'];
            $price       = $row['price'];
            $image_name  = $row['image_name'];
        } else{
            header( 'location:'.SITE_URL );
        }
    ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                            if( !empty( $image_name ) ) {
                                ?>
                                    <img src="<?php echo SITE_URL.'images/food/'.$image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            } else {
                                echo '<div class="error">Image Not Available!</div>';
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food_title" value="<?php echo $title; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <p class="food-price"><?php echo $price; ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Cupid Chakma" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@greendaycu20@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                if( isset( $_POST['submit'] ) ) {
                    $food_title  = isset( $_POST['food_title'] ) ? $_POST['food_title'] : '';
                    $price       = isset( $_POST['price'] ) ? $_POST['price'] : '';
                    $qty         = isset( $_POST['qty'] ) ? $_POST['qty'] : '';
                    $total_price = $price * $qty;
                    $order_date  = date( "Y-m-d h:i:s" );
                    $status      = "Ordered";

                    $cusomer_full_name = isset( $_POST['full-name'] ) ? $_POST['full-name'] : '';
                    $customer_contact  = isset( $_POST['contact'] ) ? $_POST['contact'] : '';
                    $customer_email    = isset( $_POST['email'] ) ? $_POST['email'] : '';
                    $customer_address  = isset( $_POST['address'] ) ? $_POST['address']  : '';

                    $sql2   = "INSERT INTO resto_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) VALUES ('$food_title', '$price', '$qty', '$total_price', '$order_date', '$status', '$cusomer_full_name', '$customer_contact', '$customer_email', '$customer_address')";
                    $result = mysqli_query( $conn, $sql2 );

                    if( $result ) {
                        $_SESSION['order-saved-in-database'] = '<div class="success text-center">Order Placed Successfully!</div>';
                        header( 'location:'.SITE_URL );
                    } else {
                        $_SESSION['order-saved-in-database'] = '<div class="error text-center">Failed To Place Order!</div>';
                        header( 'location:'.SITE_URL );
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include( "./partials-front/footer.php" ) ?>; 