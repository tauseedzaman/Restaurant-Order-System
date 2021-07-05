<?php include("../admin/partials/menu.php" ); ?>

<div class="main-content footer_bottom"  style="">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br /><br /><br />
        <?php 
            $updated_order = isset(  $_SESSION['update-order'] ) ?  $_SESSION['update-order'] : '';
            echo $updated_order;
            unset( $_SESSION['update-order'] );
        ?>
        <table class="tbl-full">
            <thead>
            <tr>
                <th>S.N</th>
                <th>Food Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
</thead>

            <?php 
                $sl = 1;
                $sql    = "SELECT * FROM resto_order ORDER BY id DESC";
                $result = mysqli_query( $conn, $sql );
                $rows   = mysqli_num_rows($result);
                if( $rows ) {
                    while( $row = mysqli_fetch_assoc( $result ) ) {
                        $id               = $row['id'];
                        $food_title       = isset( $row['food'] ) ?  $row['food'] : '';
                        $price            = isset( $row['price'] ) ? $row['price'] : '';
                        $qty              = isset( $row['qty'] ) ? $row['qty'] : '';
                        $total            = isset( $row['total'] ) ? $row['total'] : '';
                        $order_date       = isset( $row['order_date'] ) ? $row['order_date'] : '';
                        $status           = isset( $row['status'] ) ? $row['status'] : '' ;
                        $cutsomer_name    = isset( $row['customer_name'] ) ? $row['customer_name'] : ''; 
                        $cutsomer_contact = isset( $row['customer_contact'] ) ? $row['customer_contact'] : '';
                        $customer_email   = isset( $row['customer_email'] ) ? $row['customer_email'] : '';
                        $customer_address = isset( $row['customer_address'] ) ? $row['customer_address'] : '';

                        ?>

                       
                            <tr style="<?php if ($status == "Delivered") { echo 'background:green'; } if($status == "Cancelled"){ echo 'background:red';} ?>">
                                <td style="background:lightgreen"><?php echo $sl++; ?></td>
                                <td><?php echo $food_title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $total;?></td>
                                <td><?php echo $order_date; ?></td>
                                <td ><?php echo $status; ?></td>
                                <td><?php echo $cutsomer_name; ?></td>
                                <td><?php echo $cutsomer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td  style="background:lightgreen">
                                    <a href="<?php echo SITE_URL.'admin/update-order.php?order_id='.$id; ?>" style="margin:10px" class="" title="edit this"><svg style="width: 25%;color:orange;margin-left:1px;margin:2px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-edit" class="svg-inline--fa fa-user-edit fa-w-20" role="img" xmlns="" viewBox="0 0 640 512">
                                    <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h274.9c-2.4-6.8-3.4-14-2.6-21.3l6.8-60.9 1.2-11.1 7.9-7.9 77.3-77.3c-24.5-27.7-60-45.5-99.9-45.5zm45.3 145.3l-6.8 61c-1.1 10.2 7.5 18.8 17.6 17.6l60.9-6.8 137.9-137.9-71.7-71.7-137.9 137.8zM633 268.9L595.1 231c-9.3-9.3-24.5-9.3-33.8 0l-37.8 37.8-4.1 4.1 71.8 71.7 41.8-41.8c9.3-9.4 9.3-24.5 0-33.9z"></path>
                                </svg></a>
                                </td>
                            </tr>

                        <?php
                    }
                } else {
                    echo '<tr><td colspan = "12" class="error">No Orders Found</td></tr>';
                }
            ?>
        </table>
    </div>
</div>

<?php include("../admin/partials/footer.php"); ?>