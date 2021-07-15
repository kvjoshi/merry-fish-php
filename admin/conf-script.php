<?php
session_start();
require 'connect.php';
require 'session_check.php';
$uid=$_SESSION['u_id'];
if(isset($_POST['confirm_s'])){
$cart_order=$_POST['cart_order'];  // Order ID
$cart_id=$_POST['cart_id'];  //cart id for ref
$o_price=$_POST['o_price'];  //order price

$confirm="UPDATE `cart` SET `cart_status` = 2 , `cart_order` = '$cart_order' , `o_price` = '$o_price' WHERE `cart_id` = ".$cart_id;
$update_query = mysqli_query($con,$confirm) or die('Upload query failed');
if ($update_query) {
    $success=1;
    header( "location:past_ord.php" );
}
}
else{
    header( "location:conf_ord.php" );
}