<?php
$title ="Tambah Barang";
require "includes/header.php";

if(isset($_POST['insert'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];
    $gambar = $_FILES['gambar']['name'];
    $file = $_FILES['gambar']['tmp_name'];
    $kategori = $_POST['kategori'];
    $path = "../assets/barang/";
    if(move_uploaded_file($file, $path.$gambar)){
        $query = mysqli_query($con, "INSERT INTO barang (nama_barang,harga_barang,stok_barang,satuan_barang,id_kategori,gambar_barang) 
                                                        value ('$nama','$harga','$stok','$satuan','$kategori', '$gambar')");
        if($query){
            echo "<meta http-equiv='refresh' content='0,url=".BASE_URL."admin/barang.php'";
        }
    }    
}

?>

            <div class="container-fluid">

                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>

                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i> Data Table Example</div>
                    <div class="card-body" >
                        <form method="post" action=""  enctype="multipart/form-data">
                            <div class="row" >
                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label>Nama Barang</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama Barang" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Barang</label>
                                        <input type="number" name="harga" class="form-control" placeholder="Harga Barang" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Stok Barang</label>
                                        <input type="number" name="stok" class="form-control" placeholder="Stok Barang" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Satuan Barang</label>
                                        <input type="text" name="satuan" class="form-control" placeholder="Satuan Barang" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar Barang</label>
                                        <input type="file" name="gambar" class="form-control"  required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori Barang</label>
                                        <select name="kategori" class="form-control" required>
                                            <option>-- Pilih Kategori</option>
                                            <?php
                                                    $qkategori = mysqli_query($con,"SELECT * FROM kategori");
                                                    $kategori = mysqli_fetch_assoc($qkategori);
                                                    do{

                                                    
                                            ?>
                                                <option value="<?=$kategori['id_kategori'];?>"><?=$kategori['nama_kategori'];?></option>
                                            <?php
                                                    }while($kategori = mysqli_fetch_assoc($qkategori));
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="insert" value="Tambah" class="btn btn-sm btn-info">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="<?=BASE_URL?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=BASE_URL?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=BASE_URL?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?=BASE_URL?>assets/js/sb-admin.min.js"></script>
    

</body>

</html>