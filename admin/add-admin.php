<?php include("../admin/partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 style="text-align: center;color:darkgreen;">Add New Admin</h1>
        <br>
        <br>
        <?php
        $message = isset($_SESSION['add']) ? $_SESSION['add'] : '';
        echo $message;
        unset($message);
        ?>
    <div class="login" style="width: 50%;margin-top:2%">
        <form action="" method="POST"  >
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" name="full_name" placeholder="Enter Full Name" class="form-input"><br><br>

            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" placeholder="Enter Username" class="form-input"><br><br>


            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" placeholder="Enter Password" class="form-input"><br><br>
            <input type="submit" name="submit" value="Add Admin" class="btn-submit">
        </form><br><br>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<?php
/**
 * Process the form values and save inside the database
 */
if (isset($_POST['submit'])) {
    $fullname = isset($_POST['full_name']) ?  $_POST['full_name'] : '';
    $username = isset($_POST['username']) ?  $_POST['username'] : '';
    $password = isset($_POST['password']) ? md5($_POST['password']) : '';

    $sql = "INSERT INTO `resto_admin` (full_name, user_name, password) VALUES ('$fullname', '$username', '$password')";

    /**
     * Execute Query And Save In Databse
     */
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['add'] = "Added Successfully";
        header("location:" . SITE_URL . "admin/manage-admin.php");
    } else {
        $_SESSION['add'] = "Failed To Add Admin";
        header("location:" . SITE_URL . "admin/add-admin.php");
    }
}
?>