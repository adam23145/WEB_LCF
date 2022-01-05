<?php 
include('top.php');
if(isset($_POST['adduser']))
	{
		$nama = $_POST['nama'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];
		$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); 
			  
		$tambahuser = mysqli_query($conn,"insert into login (namalengkap, email, password, notelp, alamat, role) 
		values('$nama','$email','$pass','$telp','$alamat','Admin')");
		if ($tambahuser){
		echo " <div class='alert alert-success'>
			Berhasil mendaftar, silakan masuk.
		  </div>
		<meta http-equiv='refresh' content='1; url= user.php'/>  ";
		} else { echo "<div class='alert alert-warning'>
			Gagal mendaftar, silakan coba lagi.
		  </div>
		 <meta http-equiv='refresh' content='1; url= user.php'/> ";
		}
		
	};
	?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title"><?php echo $page_title?></h1>
			  <div class="row grid_box">
			  <button style="margin-bottom:20px; margin-left:10px;" data-toggle="modal" data-target="#myModal" class="btn btn-danger">Tambah Staff</button>
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
						<th>No.</th>
												<th>Nama</th>
												<th>Email</th>
												<th>Telepon</th>
												<th>Alamat</th>
												<th>Actions</th>
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from login where role='Admin' order by userid ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){

												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['namalengkap'] ?></td>
													<td><?php echo $p['email'] ?></td>
													<td><?php echo $p['notelp'] ?></td>
													<td><?php echo $p['alamat'] ?></td>
													<td><a href="hapusstaff.php?id_staff=<?php echo $p['userid']; ?>"onClick="return confirm('Hapus Inputan?')"><label class="badge badge-danger delete_red hand_cursor">Delete</label></a></td>
													
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
									<label>Nama Lengkap</label>
									<input name="nama" type="text" class="form-control" required autofocus>
								</div>
								<div class="form-group">
									<label>Nomor Telepon</label>
									<input name="telp" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Alamat Lengkap</label>
									<input name="alamat" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input name="email" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input name="password" type="text" class="form-control" required>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="adduser" type="submit" class="btn btn-primary" value="Tambah">
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