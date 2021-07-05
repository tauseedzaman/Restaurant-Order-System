<?php include( "./partials-front/menu.php" ) ?>; 

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center ">
        <div class="container">
            
            <form action="<?php echo SITE_URL.'food-search.php'?>" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <?php
        $order = isset( $_SESSION['contact_status'] ) ?  $_SESSION['contact_status'] : '';
        echo $order;
        unset( $_SESSION['contact_status'] );
    ?>
    <!-- FOOD SEARCH Section Ends Here -->
    <br>
        <h1 style="text-align: center;color:darkgreen;">Contact Us</h1>
        <?php
        $message = isset($_SESSION['add']) ? $_SESSION['add'] : '';
        echo $message;
        unset($message);
        ?>
    <div class="login" style="width: 50%;margin-top:2%;background:lightgray">
        <form action="" method="POST"  >
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" name="full_name" placeholder="Enter Full Name" class="form-input"><br><br>

            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" placeholder="Enter Email Address" class="form-input"><br><br>


            <label for="Message" class="form-label">Message</label>
            <textarea name="message" class="form-input" id="message" cols="30" rows="10" >Enter Your Message</textarea>
<br>
<br>

            <input type="submit" name="submit" value="Submit" class="btn-submit" style="width:100%">
        </form><br><br>
    </div>
</div>
<?php
            if( isset( $_POST['submit'] ) ) {
                // if ($_POST['full_name'] == '' or  $_POST['email'] ='' or $_POST['message'] ='') {
                    // $_SESSION['contact_status'] = '<br><div class="success" style="color:red;text-align:center">Please Fill all fields!</div>';
                    // header("location:".SITE_URL."contact.php");
                    // return false;
                // }
                $full_name  = isset($_POST['full_name']) ? $_POST['full_name']: '';
                $email      =isset( $_POST['email']) ? $_POST['email'] : '';
                $message    = isset($_POST['message']) ? $_POST['message'] : '';
                $sql = "INSERT into resto_contact (full_name, email, message) VALUES ( '$full_name','$email','$message')";
                $result = mysqli_query( $conn, $sql );

                if( $result ) {
                    $_SESSION['contact_status'] = '<br><div class="success" style="color:green;text-align:center">Submited Successfully!</div>';
                    header("location:".SITE_URL."contact.php");
                } else {
                    $_SESSION['contact_status'] = '<br><div class="success" style="color:red;text-align:center">Failed To Submit!</div>';
                    header("location:".SITE_URL."contact.php");
                }
            }
        ?>

<?php include( "./partials-front/footer.php" ) ?>; 
