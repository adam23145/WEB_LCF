<?php 
include('top.php');
$id = $_GET['id_pelanggan'];
mysqli_query($conn,"DELETE FROM login WHERE userid='$id'");
echo "
<meta http-equiv='refresh' content='1; url= customer.php'/> ";

?>