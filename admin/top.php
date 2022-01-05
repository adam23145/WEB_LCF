<?php

include('../database.inc.php');
include('../function.inc.php');
include('../constant.inc.php');
session_start();
$curStr=$_SERVER['REQUEST_URI'];
$curArr=explode('/',$curStr);
$cur_path=$curArr[count($curArr)-1];

if(!$_SESSION['admin']){
  header('location:../index.php');
}

$page_title='';
if($cur_path=='' || $cur_path=='index.php'){
	$page_title=' - Dashboard'; 
}elseif($cur_path=='https://ws-tif.com/lcfp/food_ordering/'){
	$page_title=' - Kembali';
}elseif($cur_path=='category.php'){
	$page_title=' - Manage Category';
}elseif($cur_path=='manageorder.php' || $cur_path=='order.php'){
	$page_title=' - Manage Order';
}elseif($cur_path=='produk.php' ){
	$page_title=' - Produk';
}elseif($cur_path=='pembayaran.php' ){
	$page_title=' - Metode Pembayaran';
}elseif($cur_path=='customer.php'){
	$page_title=' - Kelola Pelanggan';
}elseif($cur_path=='user.php'){
	$page_title=' - Daftar Staff';
}
//$lama = 1;
//$status2 = "Payment";
//$query2 = "DELETE FROM cart WHERE DATEDIFF(CURDATE(), tglorder) > $lama and status = '$status2'";
//$hasil = mysqli_query($conn,$query2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <link rel="icon" href="../Low_Calori.png" type="png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Low Calory Food  <?php echo $page_title?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="sidebar-light">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
        <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
          <li class="nav-item nav-toggler-item">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
          
        </ul>
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.php"><img src="../Low_Calori.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="../Low_Calori.png" alt="logo"/></a>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          
          <!--<li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name">Admin <?//php echo $_SESSION['ADMIN_USER']?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../logout.php">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>-->
          
          <li class="nav-item nav-toggler-item-right d-lg-none">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="mdi mdi-view-quilt menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://ws-tif.com/lcfp/food_ordering/">
            <i class="mdi mdi-chevron-left menu-icon"></i>
              <span class="menu-title">Kembali</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="category.php">
            <i class="mdi mdi-chart-bar menu-icon"></i>
              <span class="menu-title">Category</span>
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="manageorder.php">
              <i class="mdi mdi-folder-account menu-icon "></i>
              <span class="menu-title">Kelola Pesanan</span>
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="produk.php">
              <i class="mdi mdi-cart menu-icon"></i>
              <span class="menu-title">Produk </span>
            </a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="pembayaran.php">
              <i class="mdi mdi-sync menu-icon"></i>
              <span class="menu-title">Metode Pembayaran</span>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a class="nav-link" href="customer.php">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Pelanggan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user.php">
              <i class="mdi mdi-account-key menu-icon"></i>
              <span class="menu-title">Kelola Staff</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php" onClick="return confirm('Apakah anda ingin logout?')">
              <i class="mdi mdi-exit-to-app menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
		  
		  
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">