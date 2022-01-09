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

	if(isset($_POST["updatekategori"])) {
		$id = $_POST['idkategori'];
		$namakategori2 = $_POST['namakategori'];
		//query update
		$query = "UPDATE kategori SET namakategori='$namakategori2' WHERE idkategori='$id' ";
		if (mysqli_query($conn, $query)) {
			echo "<div class='alert alert-warning'>Berhasil</div>
				<meta http-equiv='refresh' content='1; url= category.php'/>";   
		}
		else{
			echo "<div class='alert alert-warning'>Gagal Update</div>
				<meta http-equiv='refresh' content='1; url= category.php'/>";
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
													<td><a href="hapuscategory.php?id_category=<?php echo $p['idkategori']; ?>"onClick="return confirm('Hapus Inputan?')"><label class="badge badge-danger delete_red hand_cursor">Delete</label></a>
													<a href="#" type="button" data-toggle="modal" data-target="#myModal2<?php echo $p['idkategori']; ?>"><label style="margin-top: 10px;" class="badge badge-danger delete_white hand_cursor">Edit</a>
												</td>
													
												</tr>
												<div id="myModal2<?php echo $p['idkategori']; ?>" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Update Produk</h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                            <form action="category.php" method="post" enctype="multipart/form-data" >
                                                            <?php
                                                                $id = $p['idkategori']; 
                                                                $query_edit = mysqli_query($conn, "SELECT * FROM kategori WHERE idkategori='$id'");
                                                                while ($row = mysqli_fetch_array($query_edit)) {  
                                                                ?>
                                                                    <input type="hidden" name="idkategori" value="<?php echo $row['idkategori']; ?>">
                                                                    <div class="form-group">
                                                                        <label>Nama Produk</label>
                                                                        <input name="namakategori" value="<?php echo $row['namakategori']; ?>" type="text" class="form-control" required autofocus>
                                                                    </div>
                                                                   
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                    <input name="updatekategori" type="submit" class="btn btn-primary" value="Update">
                                                                </div>
                                                                <?php 
                                                                    }
                                                                    ?>   
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>		
												
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