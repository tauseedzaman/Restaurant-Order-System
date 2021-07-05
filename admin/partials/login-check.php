<?php

if( !isset( $_SESSION['user'] ) ) {
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login To Access Admin Panel</div>";
    header("location:".SITE_URL."admin/login.php");
}