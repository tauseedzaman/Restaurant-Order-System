<?php
/**
 * Session Start
 */
session_start();

define('SITE_URL', 'http://localhost/ros/Restaurant-Order-System/');
define('HOST', "localhost");
define('USER', "root");
define('PASSWORD', "");
define('DB_NAME', "food-resto");

$conn = new mysqli(HOST, USER, PASSWORD, DB_NAME);


function dd($var)
{
    var_export($var);
    var_dump($var);
}

