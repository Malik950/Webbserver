<?php
header("Content-type:text/html; charset=utf-8");
session_start();
$_SESSION=array();
session_destroy();
header("Location:login.php");
?>