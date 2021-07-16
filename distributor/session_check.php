<?php
$cpage = basename($_SERVER['PHP_SELF']);
if(!isset($_SESSION['u_id']))
{
	header('location:index.php');
}
if(!isset($_SESSION['u_tier'])){
	header('location:index.php');
}
?>
