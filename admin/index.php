<?php include './partials/menu.php'; ?>

        <!-- Main Content Section-->
        <div class ="main-content" style="padding-bottom:30%">
            <div class="wrapper">
                <h1>DASHBOARD</h1>
                <br><br>
                <?php 
                    $show_logged_message = isset( $_SESSION['login'] ) ?  $_SESSION['login'] : '';
                    echo $show_logged_message;
                    unset( $_SESSION['login'] );
                ?>
                <br><br>
                <div class="col-4 text-center">

                    <?php 
                        $sql    = "SELECT * FROM resto_category";
                        $result = mysqli_query($conn, $sql);
                        $rows   = mysqli_num_rows($result);
                    ?>

                    <h1><?php echo $rows; ?></h1>
                    <br/>
                    Categories
                </div>

                <div class="col-4 text-center">
                    <?php 
                        $sql2    = "SELECT * FROM resto_food";
                        $result2 = mysqli_query( $conn, $sql2 );
                        $rows2    = mysqli_num_rows($result2); 
                    ?>
                    <h1><?php echo $rows2;?></h1>
                    <br/>
                    Foods
                </div>

                <div class="col-4 text-center">
                <?php
                     $sql3    = "SELECT * FROM resto_order";
                     $result3 = mysqli_query( $conn, $sql3 );
                     $rows3   = mysqli_num_rows( $result3 ); 
                ?>
                    <h1><?php echo $rows3; ?></h1>
                    <br/>
                    Total Orders
                </div>

                <div class="col-4 text-center">
                <?php 
                    $sql4                = "SELECT SUM(price) as total from resto_order WHERE status = 'Delivered' ";
                    $result4             = mysqli_query( $conn, $sql4 );
                    $total_from_database = mysqli_fetch_assoc($result4);
                ?>
                    <h1><?php echo !empty( $total_from_database['total'] ) ? '$'.$total_from_database['total'] : 0; ?></h1>
                    <br/>
                    Revenue Generated
                </div>

                <div class="clearfix">
                </div>
            </div>
        </div>
        <!-- Main Content Section-->
        
<?php include 'partials/footer.php'; ?>       