<?php 
include('top.php');
$id = $_GET['id_category'];
mysqli_query($conn,"DELETE FROM kategori WHERE idkategori='$id'");
echo "
<meta http-equiv='refresh' content='1; url= category.php'/> ";

?>