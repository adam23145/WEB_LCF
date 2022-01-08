<?php include('top.php');?>
<?php 		
	$itungcust = mysqli_query($conn,"select count(userid) as jumlahcust from login where role='Member'");
	$itungcust2 = mysqli_fetch_assoc($itungcust);
	$itungcust3 = $itungcust2['jumlahcust'];
	
	$itungorder = mysqli_query($conn,"select count(idcart) as jumlahorder from cart where status not like 'Selesai' and status not like 'Canceled'");
	$itungorder2 = mysqli_fetch_assoc($itungorder);
	$itungorder3 = $itungorder2['jumlahorder'];
	
	$itungtrans = mysqli_query($conn,"select count(orderid) as jumlahtrans from konfirmasi");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];
	
?>
 <div class="main-content-inner">
			
                
            <div class="sales-report-area mt-5 mb-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="button-19">
                            <div class="">
                                <div class="icon"><i class="fa fa-user"></i></div>
                                <div class="">
                                    <h4 class="">Pelanggan</h4>
                                </div>
                                <div class="">
                                    <h1><?php echo $itungcust3 ?></h1>
                                </div>
                                </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="button-19">
                            <div class="">
                                <div class="icon"><i class="fa fa-book"></i></div>
                                <div class="">
                                    <h4 class="">Pesanan</h4>
                                </div>
                                <div class="">
                                    <h1><?php echo $itungorder3 ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="button-19">
                            <div class="">
                                <div class="icon"><i class="fa fa-link"></i></div>
                                <div class="">
                                    <h4 class="">Konfirmasi Pembayaran </h4>
                                </div>
                                <div class="">
                                    <h1><?php echo $itungtrans3 ?></h1>
                                </div>
                                <!--
                                <button type="button" class="<?php 
                                if($itungtrans3==0){
                                    echo 'btn btn-secondary btn-block';
                                } else {
                                    echo 'btn btn-primary btn-block';
                                }
                                ?>
                                ">Lihat Transaksi</button>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Daftar Pesanan Masuk</h1>
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
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from cart c, login l where c.userid=l.userid and status!='Cart' and status!='Selesai' order by idcart ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
											$orderids = $p['orderid'];
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><strong><?php echo $p['orderid'] ?></a></strong></td>
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
<?php include('footer.php');?>