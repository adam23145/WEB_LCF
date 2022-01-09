
<?php
include('header.php');
if(!isset($_SESSION['log'])){
	
} else {
	echo "<meta http-equiv='refresh' content='0,url=".BASE_URL."index.php'/>";
};

if(isset($_POST['adduser']))
	{
		$nama = $_POST['nama'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];
		$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); 
			  
		$tambahuser = mysqli_query($conn,"insert into login (namalengkap, email, password, notelp, alamat) 
		values('$nama','$email','$pass','$telp','$alamat')");
		if ($tambahuser){
		echo " <div class='alert alert-success'>
			Berhasil mendaftar, silakan masuk.
		  </div>
		<meta http-equiv='refresh' content='1; url= login.php'/>  ";
		} else { echo "<div class='alert alert-warning'>
			Gagal mendaftar, silakan coba lagi.
		  </div>
		 <meta http-equiv='refresh' content='1; url= registered.php'/> ";
		}
		
	};

?>
<div class="login-register-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="">
                            <div class="login-register-tab-list nav">
                                <a  data-toggle="" href="login.php">
                                    <h4> login </h4>
                                </a>
                                <a class="active" data-toggle="" href="registered.php">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                        <div style="text-align: center;">
                                        <h5>Data Pribadi</h5>
                                        </div>
                                        <br>
                                        <form method="post">
                                            <input type="text" name="nama" placeholder="Nama Lengkap" required>
                                            <input type="text" name="telp" placeholder="Nomor Telepon" required maxlength="13">
                                            <input type="text" name="alamat" placeholder="Alamat Lengkap" required>
                                        <div style="text-align: center;">
                                        <h6>Data Login</h6>
                                        </div>
                                        <br>

                                            
                                            <input type="email" name="email" placeholder="Email" required="@">
                                            <input type="password" name="pass" placeholder="Password" required>
                                            <input type="submit" name="adduser" value="Daftar" class ="btn btn-large btn-block btn-danger" style="cursor:pointer">
                                            <a href="index.php"><button class="btn btn-large btn-block btn-danger" style="cursor:pointer" type="button">Batal</button></a>
                                            
                                        </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

<?php
  include 'footer.php';
 ?>
                            
