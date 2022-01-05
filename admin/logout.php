<?php
session_start();
include('../function.inc.php');
unset($_SESSION['admin']);
redirect('../index.php');
?>