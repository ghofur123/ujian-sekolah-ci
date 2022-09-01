<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title class='title-class'>uasbn bk</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php base_url();?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php base_url();?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php base_url();?>assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php base_url();?>assets/admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php base_url();?>assets/admin/dist/css/skins/_all-skins.min.css">
  
	<!-- jquery--->
	<script src="<?php base_url();?>assets/jquery/jquery-3.4.1.js"></script>
	
	
	<!--print js-->
	<script src="<?php base_url();?>assets/jquery-print/print.js"></script>
	
	
	<!---coundown-->
	<script src="<?php base_url();?>assets/jquery.countdown-2.2.0/jquery.countdown.js"></script>
	<script src="<?php base_url();?>assets/qrcode/jquery.qrcode.min.js"></script>
	
	
	<!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php base_url();?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
  <script>
	$(document).ready(function(){
		$(".class-message-div").hide();
		$(".class-loading-cube").hide();
		<?php 
		//jika guru maka yang di load di sini
			if($_SESSION["status_user"] == "guru"){
				?>
				$(".body-load-all").load("link?dashboard=bank_soal");
		<?php 
			} else {
		?> 
				$(".body-load-all").load("link?dashboard=halaman_siswa");
		<?php 
			}
		?>
		$("#bank_soal").click(function(){
			$(".body-load-all").load("link?dashboard=bank_soal");
		});
		$("#data_siswa").click(function(){
			$(".body-load-all").load("link?dashboard=data_siswa");
		});
		$("#guru").click(function(){
			$(".body-load-all").load("link?dashboard=guru");
		});
		$("#kelas").click(function(){
			$(".body-load-all").load("link?dashboard=kelas");
		});
		$("#materi").click(function(){
			$(".body-load-all").load("link?dashboard=materi");
		});
		$("#ujian").click(function(){
			$(".body-load-all").load("link?dashboard=ujian");
		});
		$("#bank_soal_essay").click(function(){
			$(".body-load-all").load("link?dashboard=bank_soal_essay");
		});
		$("#halaman_siswa").click(function(){
			$(".body-load-all").load("link?dashboard=halaman_siswa");
		});
		$("#soal_essay").click(function(){
			$(".body-load-all").load("link?dashboard=soal_essay");
		});
		$("#progress_nilai").click(function(){
			$(".body-load-all").load("link?dashboard=progres_nilai");
		});
		$("#nilai_bank_soal").click(function(){
			$(".body-load-all").load("link?dashboard=nilai_bank_soal");
		});
		$("#nilai_bank_soal_essay").click(function(){
			$(".body-load-all").load("link?dashboard=nilai_bank_soal_essay");
		});
		$("#profile_sekolah").click(function(){
			$(".body-load-all").load("link?dashboard=profile_sekolah");
		});
		$("#jurusan").click(function(){
			$(".body-load-all").load("link?dashboard=jurusan");
		});
		$("#save_nilai").click(function(){
			$(".body-load-all").load("link?dashboard=save_nilai");
		});
		$("#jurusan").click(function(){
			$(".body-load-all").load("link?dashboard=jurusan");
		});
		$("#absensi").click(function(){
			$(".body-load-all").load("link?dashboard=absensi");
		});
		$("#jenis_ujian").click(function(){
			$(".body-load-all").load("link?dashboard=jenis_ujian");
		});
		$("#absen_struktur").click(function(){
			$(".body-load-all").load("link?dashboard=absen_struktur");
		});
		$("#absen_input_guru").click(function(){
			$(".body-load-all").load("link?dashboard=absen_input_guru");
		});
	});
	</script>
	<style>
		.main-header {
			position: fixed;
			width: 100%;
		}
		
	</style>
</head>
<!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>USBN</b>-BK</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>USBN</b> -BK</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php base_url();?>assets/admin/dist/img/profile.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION["nama"]; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php base_url();?>assets/admin/dist/img/profile.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo "status : "; echo $_SESSION["status_user"]; echo " aktif"; ?>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="logout/log" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
	<div class="callout callout-danger class-message-div" style='position:fixed; width:50%; margin:100px 0px 0px 100px; z-index:1;'>
		<h4>Perhatian!</h4>

		<p class='message-errors'></p>
	</div>
  <!-- ========================end header======================= -->
