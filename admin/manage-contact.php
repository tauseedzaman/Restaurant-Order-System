<?php include("../admin/partials/menu.php" ); ?>


<div class="main-content"  style="padding-bottom:30%">
    <div class="wrapper">
        <h1>Manage Contact</h1>
        <br>
        <?php
            $remove_contact = isset( $_SESSION['delete_contact'] ) ?  $_SESSION['delete_contact'] : '';
            echo $remove_contact;
            unset( $_SESSION['delete_contact'] );

            $no_catgeory = isset( $_SESSION['no-category-found'] ) ?  $_SESSION['no-category-found'] : '';
            echo $no_catgeory;
            unset( $_SESSION['no-category-found'] );
        ?>
        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>

            <?php
                /**
                 * Fetch All Records From The Database
                 */
                $sql = "SELECT * FROM resto_contact ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
                if( $count ) {
                    while( $rows = mysqli_fetch_assoc($result) ) {
                        $id          = $rows['id'];
                        $full_name       = isset( $rows['full_name'] ) ? $rows['full_name'] : '';
                        $email    = isset( $rows['email'] ) ? $rows['email'] : '';
                        $message      = isset( $rows['message'] ) ?  $rows['message'] : '';
                        ?>  
                            <tr style="">
                                <td><?php echo $id; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $message; ?></td>
                                <td>
                                    <a href="<?php echo 'delete_contact.php?id='.$id.'&image_name=' ?>" class=""> <svg aria-hidden="true" style="width: 3%;color:red;margin-left:1px;margin-right:1px" focusable="false" data-prefix="fas" data-icon="trash-alt" class="svg-inline--fa fa-trash-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
                                </svg></a>
                                </td>
                            </tr>
                        <?php   
                    }
                } else {
                    ?>
                        <tr>
                            <td colspan="6"><div class="error">No Contact Found!</div></td>
                        </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</div>

<?php  include("../admin/partials/footer.php"); ?>