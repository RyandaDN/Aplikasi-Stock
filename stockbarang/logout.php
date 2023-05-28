<?php
session_start();
session_destroy();
//Kembali ke login.php (logout)
header('location:login.php');
?>