<?php
	session_start();
	require "koneksi.php";
	
    if(empty($_SESSION['username'])){
        header("location:login.php");
    }
    mysqli_report (MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    
?>	

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SAVE IN</title>
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
            <img src="img/Asset.png" class="img-circle" width="30" alt="User"/>
            </div>
            <div class="sidebar-brand-text mx-2">SAVE IN</div>
        </a>
	    <!-- Divider -->
        <hr class="sidebar-divider my-0">
  
        <?php
        $user = $_COOKIE['user'];
        $username = mysqli_real_escape_string($koneksi, $user);
        $check_user = "SELECT * FROM users WHERE username = '$username'";
		$res = mysqli_query($koneksi, $check_user);
        $fetch = mysqli_fetch_assoc($res);
        ?> 

        <!--sidebar start-->

        <li class="d-flex align-items-center justify-content-center">
            <a class="nav-link">
            <img src="img/user.png" class="img-circle" width="80" alt="User"/></a>
            <li class="d-flex align-items-center justify-content-left"></li>
        </li>
		<li class="nav-item ">
            <a class="nav-link">
                <div class="d-flex align-items-center justify-content-center" class="name"> <?php echo  $fetch['username'];?></div>
                <div class="d-flex align-items-center justify-content-center" class="email"> <?php echo  $fetch['fullname'];?></div>
            </a>
        </li>
    
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Pilih Menu
        </div>
	 
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item active">
            <a class="nav-link" href="?page=akun">
            <i class="fas fa-fw fa-user"></i>
            <span>Edit Akun</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="?page=gudang">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Lihat Gudang</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="?page=barangmasuk">
            <i class="fas fa-fw fa-box-open"></i>
            <span>Setor Barang</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="?page=barangkeluar">
            <i class="fas fa-fw fa-shipping-fast"></i>
            <span>Kirim Barang</span></a>
        </li>
	  
        <!-- Heading -->
        
	  
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        
        <!-- Main Content -->
        <div id="content">

		    <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>        

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <div class="top-menu">
                            <ul class="nav pull-right top-menu">
                                <li><a onclick="return confirm('Apakah anda yakin akan logout?')" class="btn btn-danger" class="logout" href="logout.php">Keluar</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                
            <section class="content">
                <?php
                         
                if ($_GET['page'] == "akun") {
                    if ($_GET['aksi'] == "") {
                        include "page/user/datauser/edituser.php";
                    }
                }
                if ($_GET['page'] == "gudang") {
                    if ($_GET['aksi'] == "") {
                        include "page/user/gudang/gudang.php";
                    }
                    if ($_GET['aksi'] == "tambahgudang") {
                        include "page/user/gudang/tambahgudang.php";
                    }
                    if ($_GET['aksi'] == "ubahgudang") {
                        include "page/user/gudang/ubahgudang.php";
                    }
                }
                if ($_GET['page'] == "barangmasuk"){
                    if ($_GET['aksi'] == "") {
                        include "page/user/barangmasuk/barangmasuk.php";
                    }          
                    if ($_GET['aksi'] == "hapusbarangmasuk") {
                        include "page/user/barangmasuk/hapusbarangmasuk.php";
                    }
                    if ($_GET['aksi'] == "tambahbarangmasuk") {
                        include "page/user/barangmasuk/tambahbarangmasuk.php";
                    }
                }
                if ($_GET['page'] == "barangkeluar"){
                    if ($_GET['aksi'] == "") {
                        include "page/user/barangkeluar/barangkeluar.php";
                    }          
                    if ($_GET['aksi'] == "hapusbarangkeluar") {
                        include "page/user/barangkeluar/hapusbarangkeluar.php";
                    }
                    if ($_GET['aksi'] == "tambahbarangkeluar") {
                        include "page/user/barangkeluar/tambahbarangkeluar.php";
                    }
                }
                if ($_GET['page'] == "") {
                    include "home.php";
                }
                ?>
                </section>
                
            </div>
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; 2022 . Sistem Informasi Inventaris Gudang</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
  
<!--script for this page-->
<script>
    jQuery(document).ready(function($) {
        $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
            var tamp = $(this).val(); // Ciptakan variabel provinsi
            $.ajax({
                type: 'POST', // Metode pengiriman data menggunakan POST
                url: 'page/barangmasuk/get_barang.php', // File yang akan memproses data
                data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
                success: function(data) { // Jika berhasil
                    $('.tampung').html(data); // Berikan hasil ke id kota
                }
            });
        });
    });
</script>			

<script>
    jQuery(document).ready(function($) {
        $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
            var tamp = $(this).val(); // Ciptakan variabel provinsi
            $.ajax({
                type: 'POST', // Metode pengiriman data menggunakan POST
                url: 'page/barangmasuk/get_satuan.php', // File yang akan memproses data
                data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
                success: function(data) { // Jika berhasil
                    $('.tampung1').html(data); // Berikan hasil ke id kota
                }
            });
        });
    });
</script> 

<script type="text/javascript">
    jQuery(document).ready(function($){
        $(function(){
            $('#Myform1').submit(function() {
                $.ajax({
                type: 'POST',
                url: 'page/laporan/export_laporan_barangmasuk_excel.php',
                data: $(this).serialize(),
                    success: function(data) {
                        $(".tampung1").html(data);
                        $('.table').DataTable();
                    }
                });
                return false;
                e.preventDefault();
            });
        });
    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $(function(){
            $('#Myform2').submit(function() {
                $.ajax({
                type: 'POST',
                url: 'page/laporan/export_laporan_barangkeluar_excel.php',
                data: $(this).serialize(),
                    success: function(data) {
                        $(".tampung2").html(data);
                        $('.table').DataTable();
                    }
                });
                return false;
                e.preventDefault();
            });
        });
    });
</script>
</body>
</html>