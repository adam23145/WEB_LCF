<?php 
include('top.php');

if(isset($_POST['addmethod']))
	{
		$metode = $_POST['metode'];
		$norek = $_POST['norek'];
		$an = $_POST['an'];
		$logo = $_POST['logo'];
			  
		$tambahmet = mysqli_query($conn,"insert into pembayaran (metode,norek,an,logo) values ('$metode','$norek','$an','$logo')");
		if ($tambahmet){
		echo "
		<meta http-equiv='refresh' content='1; url= pembayaran.php'/>  ";
		} else { echo "
		 <meta http-equiv='refresh' content='1; url= pembayaran.php'/> ";
		}
		
	};
	if(isset($_POST["updatemetode"])) {
		$id = $_POST['idrek'];
		$metode = $_POST['metode'];
		$norek = $_POST['norek'];
		$atasnama = $_POST['an'];
		$logo = $_POST['logo'];
		//query update
		$query = "UPDATE pembayaran SET metode='$metode', norek ='$norek', an ='$atasnama', logo ='$logo' WHERE no='$id' ";
		if (mysqli_query($conn, $query)) {
			echo "<div class='alert alert-warning'>Berhasil</div>
				<meta http-equiv='refresh' content='1; url= pembayaran.php'/>";   
		}
		else{
			echo "<div class='alert alert-warning'>Gagal Update</div>
				<meta http-equiv='refresh' content='1; url= pembayaran.php'/>";
		}
	};
	
	
	?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title"><?php echo $page_title?></h1>
			  <div class="row grid_box">
			  <button style="margin-bottom:20px; margin-left:10px;" data-toggle="modal" data-target="#myModal" class="btn btn-danger">Tambah Metode</button>
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
						<th>No.</th>
												<th>Nama Metode</th>
												<th>No.Rek</th>
												<th>Atas Nama</th>
												
												<th>Actions</th>
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from pembayaran order by no ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
												$id = $p['no'];

												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['metode'] ?></td>
													<td><?php echo $p['norek'] ?></td>
													<td><?php echo $p['an'] ?></td>
													
													
													<td><a href="hapuspembayaran.php?id_pembayaran=<?php echo $p['no']; ?>"onClick="return confirm('Hapus Inputan?')"><label class="badge badge-danger delete_red hand_cursor">Delete</label></a>
													<a href="#" type="button" data-toggle="modal" data-target="#myModal2<?php echo $p['no']; ?>"><label style="margin-top: 10px;" class="badge badge-danger delete_white hand_cursor">Edit</a>
												</td>
													
												</tr>		
												<div id="myModal2<?php echo $p['no']; ?>" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Update Produk</h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                            <form action="pembayaran.php" method="post" enctype="multipart/form-data" >
                                                            <?php
                                                                $id = $p['no']; 
                                                                $query_edit = mysqli_query($conn, "SELECT * FROM pembayaran WHERE no='$id'");
                                                                while ($row = mysqli_fetch_array($query_edit)) {  
                                                                ?>
                                                                    <input type="hidden" name="idrek" value="<?php echo $row['no']; ?>">
                                                                    <div class="form-group">
																		<label>Nama Metode</label>
																		<input name="metode" type="text" value="<?php echo $row['metode']; ?>" class="form-control" required autofocus>
																	</div>
																	<div class="form-group">
																		<label>No. Rekening</label>
																		<input name="norek" type="text" value="<?php echo $row['norek']; ?>" class="form-control" required>
																	</div>
																	<div class="form-group">
																		<label>Atas Nama</label>
																		<input name="an" type="text" value="<?php echo $row['an']; ?>" class="form-control" required>
																	</div>
																	<div class="form-group">
																		<label>URL Logo</label>
																		<input name="logo" type="text" value="<?php echo $row['logo']; ?>" class="form-control" required>
																	</div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                    <input name="updatemetode" type="submit" class="btn btn-primary" value="Update">
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
		  <div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Tambah Metode</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Nama Metode</label>
									<input name="metode" type="text" class="form-control" required autofocus>
								</div>
								<div class="form-group">
									<label>No. Rekening</label>
									<input name="norek" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Atas Nama</label>
									<input name="an" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>URL Logo</label>
									<input name="logo" type="text" class="form-control" required>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="addmethod" type="submit" class="btn btn-primary" value="Tambah">
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