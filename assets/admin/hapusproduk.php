<?php 
include('top.php');
$id = $_GET['id_produk'];
mysqli_query($conn,"DELETE FROM produk WHERE idproduk='$id'");
echo "
<meta http-equiv='refresh' content='1; url= user.php'/> ";

?>