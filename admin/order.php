<?php 
include('top.php');
$orderids = $_GET['orderid'];
$liatcust = mysqli_query($conn,"select * from login l, cart c where orderid='$orderids' and l.userid=c.userid");
$checkdb = mysqli_fetch_array($liatcust);
date_default_timezone_set("Asia/Bangkok");

if(isset($_POST['kirim']))
	{
		$updatestatus = mysqli_query($conn,"update cart set status='Pengiriman' where orderid='$orderids'");
		$del =  mysqli_query($conn,"delete from konfirmasi where orderid='$orderids'");
		
		if($updatestatus&&$del){
			echo " <div class='alert alert-success'>
			<center>Pesanan dikirim.</center>
		  </div>
		<meta http-equiv='refresh' content='1; url= manageorder.php'/>  ";
		} else {
			echo "<div class='alert alert-warning'>
			Gagal Submit, silakan coba lagi
		  </div>
		 <meta http-equiv='refresh' content='1; url= manageorder.php'/> ";
		}
		
	};

if(isset($_POST['selesai']))
	{
		$updatestatus = mysqli_query($conn,"update cart set status='Selesai' where orderid='$orderids'");
		
		if($updatestatus){
			echo " <div class='alert alert-success'>
			<center>Transaksi diselesaikan.</center>
		  </div>
		<meta http-equiv='refresh' content='1; url= manageorder.php'/>  ";
		} else {
			echo "<div class='alert alert-warning'>
			Gagal Submit, silakan coba lagi
		  </div>
		 <meta http-equiv='refresh' content='1; url= manageorder.php'/> ";
		}
		
	};

	if(isset($_POST['Cancel']))
	{
		$updatestatus = mysqli_query($conn,"update cart set status='Dibatalkan' where orderid='$orderids'");
		
		if($updatestatus){
			echo " <div class='alert alert-success'>
			<center>Transaksi dicancel.</center>
		  </div>
		<meta http-equiv='refresh' content='1; url= manageorder.php'/>  ";
		} else {
			echo "<div class='alert alert-warning'>
			Gagal Cancel, silakan coba lagi
		  </div>
		 <meta http-equiv='refresh' content='1; url= manageorder.php'/> ";
		}
	};

?>

		  
		  
    
        <div class="content-wrapper">
  		<div class="card">
            <div class="card-body">
              <h1 class="grid_title">Order id : #<?php echo $orderids ?></h1>
			  <div class="row grid_box">
			 <div class="spasi">
			  <p><?php echo $checkdb['namalengkap']; ?> (<?php echo $checkdb['alamat']; ?>)</p>
								<p>Waktu order : <?php echo $checkdb['tglorder']; ?></p></div>
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
						<th>No</th>
						<th>Produk</th>
						<th>Jumlah</th>
						<th>Harga</th>
						<th>Total</th>
												
						</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from detailorder d, produk p where orderid='$orderids' and d.idproduk=p.idproduk order by d.idproduk ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
												$total = $p['qty']*$p['hargaafter'];
												
												$result = mysqli_query($conn,"SELECT SUM(d.qty*p.hargaafter) AS count FROM detailorder d, produk p where orderid='$orderids' and d.idproduk=p.idproduk order by d.idproduk ASC");
												$row = mysqli_fetch_assoc($result);
												$cekrow = mysqli_num_rows($result);
												$count = $row['count'];
												
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['namaproduk'] ?></td>
													<td><?php echo $p['qty'] ?></td>
													<td>Rp<?php echo number_format($p['hargaafter']) ?></td>
													<td>Rp<?php echo number_format($total) ?></td>
													
												</tr>
												
												
												<?php 
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="4" style="text-align:right">Total:</th>
												<th>Rp<?php 
												
												$result1 = mysqli_query($conn,"SELECT SUM(d.qty*p.hargaafter) AS count FROM detailorder d, produk p where orderid='$orderids' and d.idproduk=p.idproduk order by d.idproduk ASC");
												$cekrow = mysqli_num_rows($result1);
												$row1 = mysqli_fetch_assoc($result1);
												$count = $row1['count'];
												if($cekrow > 0){
													echo number_format($count);
													} else {
														echo 'No data';
													}?></th>
											</tr>
										</tfoot>
										</table>
									</div>
									<?php
									
									if($checkdb['status']=='Confirmed'){
										$ambilinfo = mysqli_query($conn,"select * from konfirmasi where orderid='$orderids'");
										while($tarik=mysqli_fetch_array($ambilinfo)){	
										$no=1;	
										$met = $tarik['payment'];
										$namarek = $tarik['namarekening'];
										$tglb = $tarik['tglbayar'];
										echo '
										<h3 class="grid_title">Informasi Pembayaran</h3>
                  						<div class="table-responsive">
                   						<table id="order-listing" class="table">
                      					<thead>
											<tr>
												<th>No</th>
												<th>Metode</th>
												<th>Pemilik Rekening</th>
												<th>Tanggal Pembayaran</th>
												
											</tr></thead><tbody>
											<tr>
											<td>'.$no++.'</td>
											<td>'.$met.'</td>
											<td>'.$namarek.'</td>
											<td>'.$tglb.'</td>
											</tr>
											</tbody>
										</table>
									</div>
									<br><br>
									<form method="post">
									<input type="submit" name="kirim" class="form-control btn btn-success" style="margin-top:10px;" value="Kirim" \>
									</form>
									';
									}
									;
									} else {
										echo '
									<form method="post">
									<input type="submit" name="selesai" class="form-control btn btn-success" value="Selesaikan" \>
									</form>
									<form method="post">
									<input type="submit" name="Cancel" class="form-control btn btn-success"" 
									style="margin-top:10px;
									color: #fff;
									background-color: #dc3545;
									border-color: #dc3545;
									cursor: pointer;" value="Cancel" \>
									</form>
									';
									}
									?>
									<br>
								</div>
							</div>
						</div>
					 </div>
		  <!-- modal input -->
	
	
	<script type="text/javascript">
	$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
	} );
	$(document).ready(function() {
    $('#dataTable2').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
	} );
	</script>
	
        
<?php include('footer.php');?>