<?php
session_start();
session_destroy();
header("location:index.php");
unset($_SESSION['admin']);
?>