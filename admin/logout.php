<?php

include("../config/constants.php" );

/**
 * Destroy The Login Session (SESSION USERNAME AS WELL)
 */
session_destroy(); 

 /**
  * Redirect To Login Page
  */
header("location:".SITE_URL."admin/login.php");