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
<?php include('footer.php');?>