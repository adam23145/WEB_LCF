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
												<th>Nama Pelanggan</th>
												<th>No. Telepon</th>
												<th>Alamat</th>
												<th>Email</th>
												<th>Actions</th>
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from login where role='Member' order by userid ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['namalengkap'] ?></td>
													<td><?php echo $p['notelp'] ?></td>
													<td><?php echo $p['alamat'] ?></td>
													<td><?php echo $p['email'] ?></td>
													<td><a href="hapuspelanggan.php?id_pelanggan=<?php echo $p['userid']; ?>"onClick="return confirm('Hapus Inputan?')"><label class="badge badge-danger delete_red hand_cursor">Delete</label></a></td>
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