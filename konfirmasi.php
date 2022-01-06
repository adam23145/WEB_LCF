<?php
include ("header.php");
if(!isset($_SESSION['log'])){
	header('location:login.php');
} else {
	
};

$idorder = $_GET['id'];

if(isset($_POST['confirm']))
	{
		
		$userid = $_SESSION['id'];
		$veriforderid = mysqli_query($conn,"select * from cart where orderid='$idorder'");
		$fetch = mysqli_fetch_array($veriforderid);
		$liat = mysqli_num_rows($veriforderid);
		
		if($fetch>0){
		$nama = $_POST['nama'];
		$metode = $_POST['metode'];
		$tanggal = $_POST['tanggal'];
			  
		$kon = mysqli_query($conn,"insert into konfirmasi (orderid, userid, payment, namarekening, tglbayar) 
		values('$idorder','$userid','$metode','$nama','$tanggal')");
		if ($kon){
		
		$up = mysqli_query($conn,"update cart set status='Confirmed' where orderid='$idorder'");
		
		echo " <div class='alert alert-success'>
			Terima kasih telah melakukan konfirmasi, team kami akan melakukan verifikasi.
			Informasi selanjutnya akan dikirim via Email
		  </div>
		<meta http-equiv='refresh' content='7; url= index.php'/>  ";
		} else { echo "<div class='alert alert-warning'>
			Gagal Submit, silakan ulangi lagi.
		  </div>
		 <meta http-equiv='refresh' content='3; url= konfirmasi.php'/> ";
		}
		} else {
			echo "<div class='alert alert-danger'>
			Kode Order tidak ditemukan, harap masukkan kembali dengan benar
		  </div>
		 <meta http-equiv='refresh' content='4; url= konfirmasi.php'/> ";
		}
		
		
	};

?>
<div class="register">
		<div class="container">
			<h2>Konfirmasi</h2>
			<div class="login-form-grids">
				<h3>Kode Order</h3>
				<form method="post">
				<strong>
					<input type="text" name="orderid" value="<?php echo $idorder ?>" disabled>
				</strong>
				<h6>Informasi Pembayaran</h6>
					
					<input type="text" name="nama" placeholder="Nama Pemilik Rekening / Sumber Dana" required>
					<br>
					<h6>Rekening Tujuan</h6>
					<select name="metode" class="form-control">
						
						<?php
						$metode = mysqli_query($conn,"select * from pembayaran");
						
						while($a=mysqli_fetch_array($metode)){
						?>
							<option value="<?php echo $a['metode'] ?>"><?php echo $a['metode'] ?> | <?php echo $a['norek'] ?></option>
							<?php
						};
						?>
						
					</select>
					<br>
					<h6>Tanggal Bayar</h6>
					<input type="date" class="form-control" name="tanggal">
					<input type="submit" name="confirm" value="Kirim">
				</form>
			</div>
			<div class="register-home">
				<a href="index.php">Batal</a>
			</div>
		</div>
	</div>

<?php
include("footer.php");
?>