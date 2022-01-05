<?php 
include('top.php');
$id = $_GET['id_staff'];
mysqli_query($conn,"DELETE FROM login WHERE userid='$id'");
echo "
<meta http-equiv='refresh' content='1; url= user.php'/> ";

?>