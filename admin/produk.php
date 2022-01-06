<?php 
include('top.php');

if(isset($_POST["addproduct"])) {
	$namaproduk=$_POST['namaproduk'];
	$idkategori=$_POST['idkategori'];
	$deskripsi=$_POST['deskripsi'];
	$rate=$_POST['rate'];
	$hargabefore=$_POST['hargabefore'];
	$hargaafter=$_POST['hargaafter'];
	
	$nama_file = $_FILES['uploadgambar']['name'];
	$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
	$random = crypt($nama_file, time());
	$ukuran_file = $_FILES['uploadgambar']['size'];
	$tipe_file = $_FILES['uploadgambar']['type'];
	$tmp_file = $_FILES['uploadgambar']['tmp_name'];
	$path = "../produk/".$random.'.'.$ext;
	$pathdb = "produk/".$random.'.'.$ext;


	if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
	  if($ukuran_file <= 5000000){ 
		if(move_uploaded_file($tmp_file, $path)){ 
		
		  $query = "insert into produk (idkategori, namaproduk, gambar, deskripsi, rate, hargabefore, hargaafter)
		  values('$idkategori','$namaproduk','$pathdb','$deskripsi','$rate','$hargabefore','$hargaafter')";
		  $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
		  
		  if($sql){ 
			
			echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
				
		  }else{
			// Jika Gagal, Lakukan :
			echo "Sorry, there's a problem while submitting.";
			echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
		  }
		}else{
		  // Jika gambar gagal diupload, Lakukan :
		  echo "Sorry, there's a problem while uploading the file.";
		  echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
		}
	  }else{
		// Jika ukuran file lebih dari 1MB, lakukan :
		echo "Sorry, the file size is not allowed to more than 1mb";
		echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
	  }
	}else{
	  // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
	  echo "Sorry, the image format should be JPG/PNG.";
	  echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
	}

};
if(isset($_POST["updateproduct"])) {
    $id = $_POST['idproduk2'];
    $namaproduk = $_POST['namaproduk2'];
    $deskripsi = $_POST['deskripsi2'];
	$idkategori=$_POST['idkategori2'];
    $rate = $_POST['rate2'];
    $hargabefore = $_POST['hargabefore2'];
    $hargaafter = $_POST['hargaafter2'];
    //query update
    $query = "UPDATE produk SET namaproduk='$namaproduk' , idkategori='$idkategori' ,deskripsi='$deskripsi',rate='$rate',hargabefore='$hargabefore',hargaafter='$hargaafter' WHERE idproduk='$id' ";
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-warning'>Berhasil</div>
		    <meta http-equiv='refresh' content='1; url= produk.php'/>";   
    }
    else{
        echo "<div class='alert alert-warning'>Gagal Update</div>
		    <meta http-equiv='refresh' content='1; url= produk.php'/>";
    }
};


?>
  		<div class="card">
            <div class="card-body">
              <h1 class="grid_title"><?php echo $page_title?></h1>
			  <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-danger">Tambah Produk</button>
			  <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
						<th>No.</th>
												<th>Gambar</th>
												<th>Nama Produk</th>
												<th>Kategori</th>
												<th>Harga Diskon</th>
												<th>Deskripsi</th>
												<th>Rate</th>
												<th>Harga Awal</th>
												<th>Tanggal</th>
												<th>Actions</th>
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from kategori k, produk p where k.idkategori=p.idkategori order by idproduk ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){

												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><img src="../<?php echo $p['gambar'] ?>" width="50%"\></td>
													<td><?php echo $p['namaproduk'] ?></td>
													<td><?php echo $p['namakategori'] ?></td>
													<td><?php echo $p['hargaafter'] ?></td>
													<td><?php echo $p['deskripsi'] ?></td>
													<td><?php echo $p['rate'] ?></td>
													<td><?php echo $p['hargabefore'] ?></td>
													<td><?php echo $p['tgldibuat'] ?></td>
													<td>
														<a href="hapusproduk.php?id_produk=<?php echo $p['idproduk']; ?>"onClick="return confirm('Hapus Inputan?')"><label class="badge badge-danger delete_red hand_cursor">Delete</label></a>
														<a href="#" type="button" data-toggle="modal" data-target="#myModal2<?php echo $p['idproduk']; ?>"><label style="margin-top: 10px;" class="badge badge-danger delete_white hand_cursor">Edit</a>
													</td>
													
												</tr>		
												<div id="myModal2<?php echo $p['idproduk']; ?>" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Update Produk</h4>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                            <form action="produk.php" method="post" enctype="multipart/form-data" >
                                                            <?php
                                                                $id = $p['idproduk']; 
                                                                $query_edit = mysqli_query($conn, "SELECT * FROM produk WHERE idproduk='$id'");
                                                                while ($row = mysqli_fetch_array($query_edit)) {  
                                                                ?>
                                                                    <input type="hidden" name="idproduk2" value="<?php echo $row['idproduk']; ?>">
                                                                    <div class="form-group">
                                                                        <label>Nama Produk</label>
                                                                        <input name="namaproduk2" value="<?php echo $row['namaproduk']; ?>" type="text" class="form-control" required autofocus>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Nama Kategori</label>
                                                                        <select name="idkategori2" class="form-control">
                                                                        <option selected>Pilih Kategori</option>

                                                                        <?php
                                                                        $det=mysqli_query($conn,"select * from kategori order by namakategori ASC")or die(mysqli_error($conn));
                                                                        while($d=mysqli_fetch_array($det)){
                                                                        ?>
                                                                            
                                                                            <option value="<?php echo $d['idkategori'] ?>"><?php echo $d['namakategori'] ?></option>
                                                                            <?php
                                                                    }
                                                                    ?>		
                                                                        </select>
                                                                        
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Deskripsi</label>
                                                                        <input name="deskripsi2" value="<?php echo $row['deskripsi']; ?>" type="text" class="form-control" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Rating (1-5)</label>
                                                                        <input name="rate2" value="<?php echo $row['rate']; ?>"  type="number" class="form-control"  min="1" max="5" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Harga Sebelum Diskon</label>
                                                                        <input name="hargabefore2" value="<?php echo $row['hargabefore']; ?>"  type="number" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Harga Setelah Diskon</label>
                                                                        <input name="hargaafter2" value="<?php echo $row['hargaafter']; ?>"  type="number" class="form-control">
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                    <input name="updateproduct" type="submit" class="btn btn-primary" value="Update">
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
							<h4 class="modal-title">Tambah Produk</h4>
						</div>
						
						<div class="modal-body">
						<form action="produk.php" method="post" enctype="multipart/form-data" >
								<div class="form-group">
									<label>Nama Produk</label>
									<input name="namaproduk" type="text" class="form-control" required autofocus>
								</div>
								<div class="form-group">
									<label>Nama Kategori</label>
									<select name="idkategori" class="form-control">
									<option selected>Pilih Kategori</option>
									<?php
									$det=mysqli_query($conn,"select * from kategori order by namakategori ASC")or die(mysqli_error($conn));
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['idkategori'] ?>"><?php echo $d['namakategori'] ?></option>
										<?php
								}
								?>		
									</select>
									
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<input name="deskripsi" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Rating (1-5)</label>
									<input name="rate" type="number" class="form-control"  min="1" max="5" required>
								</div>
								<div class="form-group">
									<label>Harga Sebelum Diskon</label>
									<input name="hargabefore" type="number" class="form-control">
								</div>
								<div class="form-group">
									<label>Harga Setelah Diskon</label>
									<input name="hargaafter" type="number" class="form-control">
								</div>
								<div class="form-group">
									<label>Gambar</label>
									<input name="uploadgambar" type="file" class="form-control">
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="addproduct" type="submit" class="btn btn-primary" value="Tambah">
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