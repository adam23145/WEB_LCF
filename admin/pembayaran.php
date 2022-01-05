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
													
													
													<td><a href="hapuspembayaran.php?id_pembayaran=<?php echo $p['no']; ?>"onClick="return confirm('Hapus Inputan?')"><label class="badge badge-danger delete_red hand_cursor">Delete</label></a></td>
													
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