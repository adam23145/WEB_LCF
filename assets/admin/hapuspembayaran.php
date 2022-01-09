<?php 
include('top.php');
$id = $_GET['id_pembayaran'];
mysqli_query($conn,"DELETE FROM pembayaran WHERE no='$id'");
echo "
<meta http-equiv='refresh' content='1; url= pembayaran.php'/> ";

?>