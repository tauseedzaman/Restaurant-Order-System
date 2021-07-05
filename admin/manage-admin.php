<?php include("../admin/partials/menu.php"); ?>

<!-- Main Content Section-->
<div class="main-content footer_bottom"  style=""  >
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <br>

        <?php
        $sl = 1;
        $message = isset($_SESSION['add']) ?  $_SESSION['add'] : '';
        echo $message;  

        /**
         * Remove Session
         */
        unset($_SESSION['add']);

        $delete = isset($_SESSION['delete']) ? $_SESSION['delete'] : '';
        echo $delete;

        /**
         * Remove Session
         */
        unset($_SESSION['delete']);

        $update = isset($_SESSION['update']) ? $_SESSION['update'] : '';
        echo $update;

        /**
         * Remove Session
         */
        unset($_SESSION['update']);

        $user_found_or_not = isset($_SESSION['user-not-found']) ?  $_SESSION['user-not-found'] : '';
        echo $user_found_or_not;

        /**
         * Remove Session
         */
        unset($_SESSION['user-not-found']);

        $password_not_match = isset($_SESSION['pwd-not-match']) ?  $_SESSION['pwd-not-match'] : '';
        echo $password_not_match;

        /**
         * Remove Session
         */
        unset($_SESSION['pwd-not-match']);

        $update_password = isset($_SESSION['update-password']) ? $_SESSION['update-password'] : '';
        echo $update_password;

        /**
         * Remove Session
         */
        unset($_SESSION['update-password']);

        ?>
        <br>
        <br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /><br /><br />

        <table class="tbl-full" >
            <thead>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </thead>

            <?php
            $sql = "SELECT * FROM `resto_admin`";
            $res = mysqli_query($conn, $sql);
            if ($res) {

                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['ID'];
                    $fullname = $rows['full_name'];
                    $username = $rows['user_name'];

            ?>
                    <tr >
                        <td><?php echo $id; ?></td>
                        <td><?php echo $fullname; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                            <a href="<?php echo 'update-password.php?id=' . $id; ?>" class="" style="margin: 10px;" title="edit password">
                                <svg aria-hidden="true" style="width: 3%;color:blue;margin-left:1px;margin-right:1px" focusable="false" data-prefix="fas" data-icon="key" class="svg-inline--fa fa-key fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M512 176.001C512 273.203 433.202 352 336 352c-11.22 0-22.19-1.062-32.827-3.069l-24.012 27.014A23.999 23.999 0 0 1 261.223 384H224v40c0 13.255-10.745 24-24 24h-40v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-78.059c0-6.365 2.529-12.47 7.029-16.971l161.802-161.802C163.108 213.814 160 195.271 160 176 160 78.798 238.797.001 335.999 0 433.488-.001 512 78.511 512 176.001zM336 128c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z"></path>
                                </svg></a>
                            <a href="<?php echo 'update-admin.php?id=' . $id; ?>" style="margin:10px" class="" title="edit this">

                                <svg style="width: 4%;color:orange;margin-left:1px;margin:2px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-edit" class="svg-inline--fa fa-user-edit fa-w-20" role="img" xmlns="" viewBox="0 0 640 512">
                                    <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h274.9c-2.4-6.8-3.4-14-2.6-21.3l6.8-60.9 1.2-11.1 7.9-7.9 77.3-77.3c-24.5-27.7-60-45.5-99.9-45.5zm45.3 145.3l-6.8 61c-1.1 10.2 7.5 18.8 17.6 17.6l60.9-6.8 137.9-137.9-71.7-71.7-137.9 137.8zM633 268.9L595.1 231c-9.3-9.3-24.5-9.3-33.8 0l-37.8 37.8-4.1 4.1 71.8 71.7 41.8-41.8c9.3-9.4 9.3-24.5 0-33.9z"></path>
                                </svg></a>
                            <a href="<?php echo 'delete-admin.php?id=' . $id; ?>" style="margin:10px" class=""  title="delete this">
                                <svg aria-hidden="true" style="width: 3%;color:red;margin-left:1px;margin-right:1px" focusable="false" data-prefix="fas" data-icon="trash-alt" class="svg-inline--fa fa-trash-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
                                </svg>
                                </a>
                            <td/>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section-->

<?php include("../admin/partials/footer.php"); ?>