<?php
include 'header.php';
$idproduk = $_GET['idproduk'];

if(isset($_POST['addprod'])){
	if(!isset($_SESSION['log']))
		{	
			echo "<meta http-equiv='refresh' content='0,url=".BASE_URL."login.php'/>";
		} else {
				$ui = $_SESSION['id'];
				$cek = mysqli_query($conn,"select * from cart where userid='$ui' and status='Cart'");
				$liat = mysqli_num_rows($cek);
				$f = mysqli_fetch_array($cek);
				$orid = $f['orderid'];
				
				//kalo ternyata udeh ada order id nya
				if($liat>0){
							
							//cek barang serupa
							$cekbrg = mysqli_query($conn,"select * from detailorder where idproduk='$idproduk' and orderid='$orid'");
							$liatlg = mysqli_num_rows($cekbrg);
							$brpbanyak = mysqli_fetch_array($cekbrg);
							$jmlh = $brpbanyak['qty'];
							
							//kalo ternyata barangnya ud ada
							if($liatlg>0){
								$i=1;
								$baru = $jmlh + $i;
								
								$updateaja = mysqli_query($conn,"update detailorder set qty='$baru' where orderid='$orid' and idproduk='$idproduk'");
								
								if($updateaja){
									echo " <div class='alert alert-success'>
								Barang sudah pernah dimasukkan ke keranjang, jumlah akan ditambahkan
							  </div>
							  <meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/>";
								} else {
									echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							  <meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/>";
								}
								
							} else {
							
							$tambahdata = mysqli_query($conn,"insert into detailorder (orderid,idproduk,qty) values('$orid','$idproduk','1')");
							if ($tambahdata){
							echo " <div class='alert alert-success'>
								Berhasil menambahkan ke keranjang
							  </div>
							<meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/>  ";
							} else { echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							 <meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/> ";
							}
							};
				} else {
					
					//kalo belom ada order id nya
						$oi = crypt(rand(22,999),time());
						
						$bikincart = mysqli_query($conn,"insert into cart (orderid, userid) values('$oi','$ui')");
						
						if($bikincart){
							$tambahuser = mysqli_query($conn,"insert into detailorder (orderid,idproduk,qty) values('$oi','$idproduk','1')");
							if ($tambahuser){
							echo " <div class='alert alert-success'>
								Berhasil menambahkan ke keranjang
							  </div>
							<meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/>  ";
							} else { echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							 <meta http-equiv='refresh' content='1; url= product.php?idproduk=".$idproduk."'/> ";
							}
						} else {
							echo "gagal bikin cart";
						}
				}
		}
};
?>
<?php 
$p = mysqli_fetch_array(mysqli_query($conn,"Select * from produk where idproduk='$idproduk'"));

?>
<div class="products">
<div class="container">
<div class="agileinfo_single">

<div class="col-md-5">
<img id="example" src="<?php echo $p['gambar']?>" alt=" " class="img">
</div>
<br>
<div class="col-md-6" >
<h2><?php echo $p['namaproduk'] ?></h2>
<div class="rating1">
	<span class="starRating">
		<?php
			$bintang = '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
			$rate = $p['rate'];
			
			for($n=1;$n<=$rate;$n++){
			echo '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
			};
			?>
	</span>
</div>
<div class="w3agile_description">
	<h4>Deskripsi :</h4>
	<p><?php echo $p['deskripsi'] ?></p>
</div>
<div class="snipcart-item block">
	<div class="snipcart-thumb agileinfo_single_right_snipcart">
		<h4 class="m-sing">Rp<?php echo number_format($p['hargaafter']) ?> <span>Rp<?php echo number_format($p['hargabefore']) ?></span></h4>
	</div>
	<div class="snipcart-details agileinfo_single_right_details">
		<form action="#" method="post">
			<fieldset>
				<input type="hidden" name="idprod" value="<?php echo $idproduk ?>">
				<input type="submit" name="addprod" value="Add to cart" class="button btn-red">
			</fieldset>
		</form>
	</div>
</div>
</div>
<div class="clearfix"> </div>
</div>
</div>
</div>
<?php
include 'footer.php';
?>