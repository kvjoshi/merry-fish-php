<?php
session_start();
 require 'connect.php';


session_destroy();
header("location:index.php");
?>
