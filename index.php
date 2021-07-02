<?php

// any ini_set() for session configuration goes here when not using .user.ini

session_start();
$_SESSION['count']=3;
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 2;
}


echo "Hello #" . $_SESSION['count'];
