<?php
include('header.php');
if(!isset($_SESSION['log'])){
	
} else {
	echo "<meta http-equiv='refresh' content='0,url=".BASE_URL."index.php'/>";
};

date_default_timezone_set("Asia/Bangkok");
$timenow = date("j-F-Y-h:i:s A");

	if(isset($_POST['login']))
	{
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$pass = mysqli_real_escape_string($conn,$_POST['pass']);
	$queryuser = mysqli_query($conn,"SELECT * FROM login WHERE email='$email'");
	$cariuser = mysqli_fetch_assoc($queryuser);
		
		if( password_verify($pass, $cariuser['password']) ) {
			$_SESSION['id'] = $cariuser['userid'];
			$_SESSION['role'] = $cariuser['role'];
			$_SESSION['notelp'] = $cariuser['notelp'];
			$_SESSION['name'] = $cariuser['namalengkap'];
            $_SESSION['admin'] = true;
			$_SESSION['log'] = "Logged";
			echo "<div class='alert alert-warning'>Berhasil</div>
		    <meta http-equiv='refresh' content='1; url= login.php'/>";
		} else {
			echo "<div class='alert alert-warning'>Email atau Password salah</div>
		    <meta http-equiv='refresh' content='1; url= login.php'/>";
		}		
	}

?>
<div class="login-register-area pt-95 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="" href="login.php">
                                    <h4> login </h4>
                                </a>
                                <a data-toggle="" href="registered.php">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                        <div class="">
				                        <form method="post">
				            	        <input type="text" name="email" placeholder="Email" required>
				            	        <input type="password" name="pass" placeholder="Password" required>
				            	        <input type="submit" name="login" value="Masuk" class ="btn btn-large btn-block btn-danger"  style="cursor:pointer">
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
                            
