<?php 
include('top.php');

	if(isset($_POST['addcategory']))
	{
		$ceknama =mysqli_num_rows(mysqli_query($conn,"SELECT namakategori FROM kategori WHERE namakategori='$_POST[namakategori]'"));

		if($ceknama >0){
			 echo '<script type ="text/JavaScript">';  
     		 echo 'alert("Data Sama")';  
       		 echo '</script>'; 
		}else{
		$namakategori = $_POST['namakategori'];
			  
		$tambahkat = mysqli_query($conn,"insert into kategori (namakategori) values ('$namakategori')");
		if ($tambahkat){
		echo "
		<meta http-equiv='refresh' content='1; url= category.php'/>  ";
		} else { echo "
		 <meta http-equiv='refresh' content='1; url= category.php'/> ";
		}
	}
		
	};
	?>


  <div class="card">
            <div class="card-body">
              <h1 class="grid_title"><?php echo $page_title?></h1>
			  <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-danger ">Tambah Kategori</button>
              <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
					  <tr>
												<th>No.</th>
												<th>Nama Kategori</th>
												<th>Jumlah Produk</th>
												<th>Tanggal Dibuat</th>
												<th>Actions</th>
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from kategori order by idkategori ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
												$id = $p['idkategori'];

												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['namakategori'] ?></td>
													<td><?php 
												
														$result1 = mysqli_query($conn,"SELECT Count(idproduk) AS count FROM produk p, kategori k where p.idkategori=k.idkategori and k.idkategori='$id' order by idproduk ASC");
														$cekrow = mysqli_num_rows($result1);
														$row1 = mysqli_fetch_assoc($result1);
														$count = $row1['count'];
														if($cekrow > 0){
														echo number_format($count);
														} else {
															echo 'No data';
														}
													?></td>
													<td><?php echo $p['tgldibuat'] ?></td>
													<td><a href="hapuscategory.php?id_category=<?php echo $p['idkategori']; ?>"onClick="return confirm('Hapus Inputan?')"><label class="badge badge-danger delete_red hand_cursor">Delete</label></a></td>
													
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
							<h4 class="modal-title">Tambah Kategori</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Nama Kategori</label>
									<input name="namakategori" type="text" class="form-control" size="20" onkeypress="return event.charCode < 48 || event.charCode  >57" required autofocus>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="addcategory" type="submit" class="btn btn-primary" value="Tambah">
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