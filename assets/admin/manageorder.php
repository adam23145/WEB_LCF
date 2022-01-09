<?php 
include('top.php');

?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title"><?php echo $page_title?></h1>
			  <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
						<th>No</th>
												<th>ID Pesanan</th>
												<th>alamat</th>
												<th>Nama Customer</th>
												<th>Tanggal Order</th>
												<th>Total</th>
												<th>Status</th>
												<th>Actions</th>
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from cart c, login l where c.userid=l.userid and status!='Cart' and status!='Selesai' and status!='Dibatalkan' order by idcart ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
											$orderids = $p['orderid'];
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><strong><a href="order.php?orderid=<?php echo $p['orderid'] ?>">#<?php echo $p['orderid'] ?></a></strong></td>
													<td><?php echo $p['alamat'] ?></td>
													<td><?php echo $p['namalengkap'] ?></td>
													<td><?php echo $p['tglorder'] ?></td>
													<td>Rp<?php 
												
												$result1 = mysqli_query($conn,"SELECT SUM(d.qty*p.hargaafter) AS count FROM detailorder d, produk p where orderid='$orderids' and p.idproduk=d.idproduk order by d.idproduk ASC");
												$cekrow = mysqli_num_rows($result1);
												$row1 = mysqli_fetch_assoc($result1);
												$count = $row1['count'];
												if($cekrow > 0){
													echo number_format($count);
													} else {
														echo 'No data';
													}?></td>
													<td><?php 
													
													//echo $p['status'] 
													$orders = $p['orderid'];
													$cekkonfirmasipembayaran = mysqli_query($conn,"select * from konfirmasi where orderid='$orders'");
													$cekroww = mysqli_num_rows($cekkonfirmasipembayaran);
													
													if($cekroww > 0){
														echo 'Confirmed';
													} else {
														if($p['status']!='Pengiriman'){
															echo "Menunggu Konfirmasi";
														} else {
															echo "Pengiriman";
														};
													}
													
													?></td>
													<td>
													<a href="order.php?orderid=<?php echo $p['orderid'] ?>"><label class="badge badge-danger delete_white hand_cursor">Confirm Order</label></a>
													</td>
												</tr>		
												<?php 
											}
											?>
										</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					 </div>
		  <!-- modal input -->
			<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Masukkan stok manual</h4>
						</div>
						<div class="modal-body">
							<form action="tmb_brg_act.php" method="post">
								<div class="form-group">
									<label>Nama</label>
									<input name="nama" type="text" class="form-control" placeholder="Nama Barang" required>
								</div>
								<div class="form-group">
									<label>Jenis</label>
									<input name="jenis" type="text" class="form-control" placeholder="Jenis / Kategori Barang">
								</div>
								<div class="form-group">
									<label>Stock</label>
									<input name="stock" type="number" min="0" class="form-control" placeholder="Qty">
								</div>
								<div class="form-group">
									<label>Harga</label>
									<input name="harga" type="number" min="0" class="form-control" placeholder="Harga">
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" class="btn btn-primary" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
	
	<script>	
	$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
	} );
	</script>
        
<?php include('footer.php');?>