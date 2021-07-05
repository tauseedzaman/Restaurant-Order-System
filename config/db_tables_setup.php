<?php 
include('constants.php');
$sql = "CREATE TABLE IF NOT EXISTS `resto_admin` (
    `ID` int(10) UNSIGNED NOT NULL,
    `full_name` varchar(100) NOT NULL,
    `user_name` varchar(128) NOT NULL,
    `password` varchar(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
  mysqli_query($conn, $sql);

  
  $sql ="CREATE TABLE  IF NOT EXISTS  `resto_category` (
    `ID` int(10) UNSIGNED NOT NULL,
    `title` varchar(100) NOT NULL,
    `image_name` varchar(255) NOT NULL,
    `featured` varchar(10) NOT NULL,
    `active` varchar(10) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
  mysqli_query($conn, $sql);

  $sql =" CREATE TABLE  IF NOT EXISTS  `resto_food` (
    `id` int(10) UNSIGNED NOT NULL,
    `title` varchar(100) NOT NULL,
    `description` text NOT NULL,
    `price` decimal(10,2) NOT NULL,
    `image_name` varchar(255) NOT NULL,
    `category_id` varchar(255) NOT NULL,
    `featured` varchar(10) NOT NULL,
    `active` varchar(10) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
  mysqli_query($conn, $sql);
  

  
  $sql ="CREATE TABLE  IF NOT EXISTS `resto_order` (
    `id` int(10) UNSIGNED NOT NULL,
    `food` varchar(150) NOT NULL,
    `price` decimal(10,2) NOT NULL,
    `qty` int(11) NOT NULL,
    `total` decimal(10,2) NOT NULL,
    `order_date` datetime NOT NULL,
    `status` varchar(50) NOT NULL,
    `customer_name` varchar(150) NOT NULL,
    `customer_resto_contact` varchar(20) NOT NULL,
    `customer_email` varchar(150) NOT NULL,
    `customer_address` varchar(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
  mysqli_query($conn, $sql);
  
  
    $sql ="CREATE TABLE  IF NOT EXISTS  `resto_contact` (
      `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      `full_name` varchar(150) NOT NULL,
      `email` varchar(150) NOT NULL,
      `message` varchar(550) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
  mysqli_query($conn, $sql);

  $sql ="ALTER TABLE  IF EXISTS `resto_admin`
    ADD PRIMARY KEY (`ID`)";
  mysqli_query($conn, $sql);

  $sql ="ALTER TABLE  IF EXISTS `resto_category`
    ADD PRIMARY KEY (`ID`)";
    mysqli_query($conn, $sql);

  $sql ="ALTER TABLE IF EXISTS `resto_food` ADD PRIMARY KEY (`id`)"; 
  mysqli_query($conn, $sql);

  $sql ="ALTER TABLE IF EXISTS `resto_order` ADD PRIMARY KEY (`id`)"; 
  mysqli_query($conn, $sql);

  $sql ="ALTER TABLE IF EXISTS `resto_admin`
    MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6";
    mysqli_query($conn, $sql);

    $sql ="ALTER TABLE IF EXISTS `resto_food`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT";
    mysqli_query($conn, $sql);

    $sql ="ALTER TABLE IF EXISTS `resto_category`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT";
    mysqli_query($conn, $sql);

  $sql ="ALTER TABLE IF EXISTS `resto_order`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT";
    mysqli_query($conn, $sql);

    // default admin account
    $sql = "INSERT INTO `resto_admin`(`full_name`, `user_name`, `password`) VALUES ('tauseedzaman','tauseedzaman','598d1f9ba9864de1b0f6b6671ef0276f')"; 
    // password is tauseed zaman
    mysqli_query($conn, $sql);

?>
