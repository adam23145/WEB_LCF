<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
        <script type="text/javascript">
	    jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	    });
        </script>
        <meta charset="utf-8">
        <link rel="icon" href="Low_Calori-removebg-preview.png" type="png">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo FRONT_SITE_NAME?></title> <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/chosen.min.css">
        <link rel="stylesheet" href="assets/css/ionicons.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/simple-line-icons.css">
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        <link rel="stylesheet" href="assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/style1.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!-- header start -->
        <header class="header-area">
            <div class="header-top black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12 col-sm-4">
                            <div class="welcome-area">
                                
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-12 col-sm-8">
                            <div class="account-curr-lang-wrap f-right">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12 col-sm-4">
                            <div class="logo">
                                <a href="index.php">
                                    <img alt="" src="Low_Calori.png" class="img-responsive" width="50" heigth="60">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12 col-sm-8">
                            <div class="header-middle-right f-right">
                                
                                <div class="header-wishlist">
                                   &nbsp;
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom transparent-bar black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                    <li><a href="index.php">Home</a></li>
                                        <li><a href="about-us.php">about</a></li>
                                        <li><a href="contact-us.php">contact us</a></li>
                                        <?php
                                        if(!isset($_SESSION['log'])){
                                            echo '
                                            <li><a href="registered.php"> Daftar</a></li>
                                            <li><a href="login.php">Masuk</a></li>
                                            ';
                                        } else {
                                            
                                            if($_SESSION['role']=='Member'){
                                            echo '
                                            
                                            <li><a href="cart.php">Keranjang Saya</a></li>
                                            <li><a href="daftarorder.php">Daftar Order</a></li>
                                            <li><a href="">Halo,'.$_SESSION["name"].'</a></li>
                                            <li><a href="logout.php">Keluar?</a></li>
                                            ';
                                            } else {
                                                $_SESSION['admin'] = true;
                                            echo '
                                            <li><a href="">Halo,'.$_SESSION["name"].'</a></li>
                                            <li><a href="admin">Admin Panel</a></li>
                                            <li><a href="logout.php">Keluar?</a></li>
                                            ';
                                            };
                                            
                                        }
                                        ?>
					
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile-menu-area-start -->
			<div class="mobile-menu-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="mobile-menu">
								<nav id="mobile-menu-active">
									<ul class="menu-overflow" id="nav">
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="about-us.php">About Us</a></li>
										<li><a href="contact-us.php">Contact Us</a></li>
                                        <?php
                                        if(!isset($_SESSION['log'])){
                                            echo '
                                            <li><a href="registered.php"> Daftar</a></li>
                                            <li><a href="login.php">Masuk</a></li>
                                            ';
                                        } else {
                                            
                                            if($_SESSION['role']=='Member'){
                                            echo '
                                            
                                            <li><a href="cart.php">Keranjang Saya</a></li>
                                            <li><a href="daftarorder.php">Daftar Order</a></li>
                                            <li><a href="">Halo,'.$_SESSION["name"].'</a></li>
                                            <li><a href="logout.php">Keluar?</a></li>
                                            ';
                                            } else {
                                                $_SESSION['admin'] = true;
                                            echo '
                                            <li><a href="">Halo,'.$_SESSION["name"].'</a></li>
                                            <li><a href="admin">Admin Panel</a></li>
                                            <li><a href="logout.php">Keluar?</a></li>
                                            ';
                                            };
                                            
                                        }
                                        ?>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
  </div>
 </div>
        </header>
  