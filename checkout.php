<?php
include ("header.php");
if(!isset($_SESSION['log'])){
	header('location:login.php');
} else {
	
};
	$uid = $_SESSION['id'];
	$caricart = mysqli_query($conn,"select * from cart where userid='$uid' and status='Cart'");
	$fetc = mysqli_fetch_array($caricart);
	$orderidd = $fetc['orderid'];
	$itungtrans = mysqli_query($conn,"select count(detailid) as jumlahtrans from detailorder where orderid='$orderidd'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];

if(isset($_POST["checkout"])){
	if($totalharga = 0){
		echo "Gagal Check Out
		<meta http-equiv='refresh' content='1; url= index.php'/>";
	}else{
	$q3 = mysqli_query($conn, "update cart set status='Payment' where orderid='$orderidd'");
	if($q3){
		echo "Berhasil Check Out
		<meta http-equiv='refresh' content='1; url= index.php'/>";
	} else {
		echo "Gagal Check Out
		<meta http-equiv='refresh' content='1; url= index.php'/>";
	}
}
} else {
	
}
?>
<div class="checkout">
		<div class="container">
			<h1>Terima kasih, <?=$_SESSION['name']?> telah membeli <?php echo $itungtrans3 ?> barang di Low Calory Food</span></h1>
			<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>No.</th>	
							<th>Produk</th>
							<th>Nama Produk</th>
							<th>Jumlah</th>
							<th>Sub Total</th>
							
						</tr>
					</thead>
					
					<?php 
						$brg=mysqli_query($conn,"SELECT * from detailorder d, produk p where orderid='$orderidd' and d.idproduk=p.idproduk order by d.idproduk ASC");
						$no=1;
						while($b=mysqli_fetch_array($brg)){

					?>
					<tr class="rem1"><form method="post">
						<td class="invert"><?php echo $no++ ?></td>
						<td class="invert"><a href="product.php?idproduk=<?php echo $b['idproduk'] ?>"><img src="<?php echo $b['gambar'] ?>" width="100px" height="100px" /></a></td>
						<td class="invert"><?php echo $b['namaproduk'] ?></td>
						<td class="invert">
							 <div class="quantity"> 
								<div class="quantity-select">                     
									<h4><?php echo $b['qty'] ?></h4>
								</div>
							</div>
						</td>
						
						<td class="invert">Rp<?php echo number_format($b['hargaafter']*$b['qty']) ?></td>
						<td class="invert">
							<div class="rem">
								<input type="hidden" name="idproduknya" value="<?php echo $b['idproduk'] ?>" \>
							</form>
							</div>
							<script>$(document).ready(function(c) {
								$('.close1').on('click', function(c){
									$('.rem1').fadeOut('slow', function(c){
										$('.rem1').remove();
									});
									});	  
								});
						   </script>
						</td>
					</tr>
					<?php
						}
					?>
					
								<!--quantity-->
									<script>
									$('.value-plus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
										divUpd.text(newVal);
									});

									$('.value-minus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
										if(newVal>=1) divUpd.text(newVal);
									});
									</script>
								<!--quantity-->
				</table>
			</div>
			<div class="checkout-left">	
				<div class="checkout-left-basket">
					<h4>Total Harga yang harus dibayar saat ini</h4>
					<ul>
						<?php 
						$brg=mysqli_query($conn,"SELECT * from detailorder d, produk p where orderid='$orderidd' and d.idproduk=p.idproduk order by d.idproduk ASC");
						$no=1;
						$subtotal = 10000;
						while($b=mysqli_fetch_array($brg)){
						$hrg = $b['hargaafter'];
						$qtyy = $b['qty'];
						$totalharga = $hrg * $qtyy;
						$subtotal += $totalharga;
						}
						?>
						
						<h1><input type="text" value="Rp<?php echo number_format($subtotal) ?>" disabled \></h1>
					</ul>
				</div>
				<br>
				<div class="checkout-left-basket" style="width:80%;margin-top:60px;">
					<div class="checkout-left-basket">
					<h4>Kode Order Anda</h4>
					<h1><input type="text" value="<?php echo $orderidd ?>" disabled \></h1>
				</div>
				</div>
				
				<div class="clearfix"> </div>
			</div>
			
			
			<br>
			<hr>
			<br><center>
			<h2>Total harga yang tertera di atas sudah termasuk ongkos kirim sebesar Rp10.000</h2>
			<h2>Bila telah melakukan pembayaran, harap konfirmasikan pembayaran Anda.</h2>
			<br>
			
			
			<?php 
			$metode = mysqli_query($conn,"select * from pembayaran");
			
			while($p=mysqli_fetch_array($metode)){
				
			?>
			
			<img src="<?php echo $p['logo'] ?>" width="300px" height="200px"><br>
        <h4><?php echo $p['metode'] ?> - <?php echo $p['norek'] ?><br>
        a/n. <?php echo $p['an'] ?></h4><br>
        <br>
		 <hr>
			
			<?php
			}
		?>
		
		<br>
        <br>
        <p>Orderan anda Akan Segera kami proses 1x24 Jam Setelah Anda Melakukan Pembayaran ke ATM kami dan menyertakan informasi pribadi yang melakukan pembayaran seperti Nama Pemilik Rekening / Sumber Dana, Tanggal Pembayaran, Metode Pembayaran dan Jumlah Bayar.</p>
      
		<br>
		<form method="post">
		<input type="submit" class="form-control btn btn-success" name="checkout" value="I Agree and Check Out" \>
		</form>
	  
	  </center>
		</div>
	</div>

<?php
include("footer.php");
?>