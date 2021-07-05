<?php include("../admin/partials/menu.php" ); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br>
        <br>
        <?php
            /**
             * Get All Order Details From Database
             */
            $order_id = isset( $_GET['order_id'] ) ?  $_GET['order_id'] : header('location:'.SITE_URL.'admin/manage-order.php');
            $sql      = "SELECT * FROM resto_order WHERE id = {$order_id}";
            $result   = mysqli_query( $conn, $sql );
            $rows      = mysqli_num_rows($result);
            if( $rows ) {
                $row              = mysqli_fetch_assoc( $result );
                $id               = isset( $row['id'] ) ? $row['id'] : '';
                $food_name        = isset( $row['food'] ) ? $row['food'] : '';
                $price            = isset( $row['price'] ) ? $row['price'] : '';
                $quantity         = isset( $row['qty'] ) ? $row['qty'] : '';
                $order_total      = isset( $row['total'] ) ? $row['total'] : '';
                $order_date       = isset( $row['order_date'] ) ? $row['order_date'] : '';
                $order_status     = isset( $row['status'] ) ? $row['status'] : '';
                $customer_name    = isset( $row['customer_name'] ) ? $row['customer_name'] : '';
                $customer_contact = isset( $row['customer_contact'] ) ?  $row['customer_contact'] : '';
                $customer_email   = isset( $row['customer_email'] ) ?  $row['customer_email'] : '';
                $customer_address = isset( $row['customer_address'] ) ? $row['customer_address'] : '';
            } else {
                header('location:'.SITE_URL.'admin/manage-order.php');
            }
        ?>
        <div class="login" style="width: 50%;margin-top:2%">
        <form action="" method="POST"  >
        <label for="foodname" class="form-label">Food Name</label>
            <input type="text" name="order_title" value="<?php echo $food_name; ?>" class="form-input"><br><br>
           
            <label for="Price" class="form-label">Price</label>
            <input type="number" name="Price" value="<?php echo $price; ?>" class="form-input"><br><br>

            <label for="order_qty" class="form-label">Qty</label>
            <input type="number" name="order_qty" value="<?php echo $quantity; ?>" class="form-input"><br><br>

            <label for="order_total" class="form-label">Total</label>
            <input type="number" name="order_total" value="<?php echo $order_total; ?>" class="form-input"><br><br>

            <label for="order_date" class="form-label">Order Date</label>
            <input type="datetime" name="order_date" value="<?php echo $order_date; ?>" class="form-input"><br><br>

            <label for="Status" class="form-label">Status</label> <br>
            <select name="order_status" class="form-input">
                <option value="Ordered" <?php if( $order_status === 'Ordered ' ){ echo 'selected'; }?>>Ordered</option>
                <option value="On Delivery" <?php if( $order_status === 'On Delivery' ){ echo 'selected'; }?>>On Delivery</option>
                <option value="Delivered"<?php if( $order_status === 'Delivered' ){ echo 'selected'; }?>>Delivered</option>
                <option value="Cancelled"<?php if( $order_status === 'Cancelled' ){ echo 'selected'; }?>>Cancelled</option>
            </select><br><br>

             <label for="Contact" class="form-label">Contact</label>
            <input type="text" name="Contact" value="<?php echo $customer_contact; ?>" class="form-input"><br><br>

            <label for="order_customer_name" class="form-label">Customer Name</label>
            <input type="text" name="order_customer_name" value="<?php echo $customer_name; ?>" class="form-input"><br><br>

            <label for="email  " class="form-label">Customer Email</label>
            <input type="text" name="order_customer_email" value="<?php echo $customer_email; ?>" class="form-input"><br><br>

            <label for="Address" class="form-label">Address</label>
            <input type="text" name="order_customer_address" value="<?php echo $customer_address; ?>" class="form-input"><br><br>
            <input type="hidden" name="order_id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Order" class="btn-submit">
        </form><br><br>
    </div>
        <?php
        if( isset( $_POST['submit'] ) ) {
            $order_id_updated       = isset( $_POST['order_id'] ) ? $_POST['order_id'] : '';
            $order_name             = isset( $_POST['order_title'] ) ? $_POST['order_title'] : '';
            $order_price            = isset( $_POST['order_price'] ) ? $_POST['order_price'] : '';
            $order_qty              = isset( $_POST['order_qty'] ) ? $_POST['order_qty'] : '';
            $order_total            = isset( $_POST['order_total'] ) ? $_POST['order_total'] : '';
            $order_date             = isset( $_POST['order_date'] ) ? $_POST['order_date'] : '';
            $order_status           = isset( $_POST['order_status'] ) ? $_POST['order_status'] : '';
            $order_customer_name    = isset( $_POST['order_customer_name'] ) ? $_POST['order_customer_name'] : '';
            $order_customer_contact = isset( $_POST['order_customer_contact'] ) ? $_POST['order_customer_contact'] : '';
            $order_customer_email   = isset( $_POST['order_customer_email'] ) ? $_POST['order_customer_email'] : '';
            $order_customer_address = isset( $_POST['order_customer_address'] ) ? $_POST['order_customer_address'] : '';

            $sql2   = "UPDATE resto_order SET food = '{$order_name}', price = '{$order_price}', qty = '{$order_qty}', total = '{$order_total}', order_date = '{$order_date}', status = '{$order_status}', customer_name = '{$order_customer_name}', customer_email = '{$order_customer_email}', customer_address = '{$order_customer_address}' WHERE id = '{$order_id_updated}' ";
            $result2 = mysqli_query( $conn, $sql2 ); 
            if( $result2 ) {
                $_SESSION['update-order'] = '<div class="success">Order Update Successfully!</div>';
            } else {
                $_SESSION['update-order'] = '<div class="error">Failed To Update Order!</div>';

            }
            header('location:'.SITE_URL.'admin/manage-order.php');
        }
        ?>

    </div>
</div>

<?php include("../admin/partials/footer.php"); ?>

