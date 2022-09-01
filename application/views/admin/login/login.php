<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login guru</title>
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
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php base_url();?>assets/admin/plugins/iCheck/square/blue.css">
	<script src="<?php base_url();?>assets/bootstrap/1.12.0_jquery.min.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script>
		$(document).ready(function(){
			$("#form").submit(function(){
				//jangan lupa url nya di ganti sesuai dengan link nya
				$.ajax({
					type : "POST",
					url : "login_siswa/validation",
					data : $(this).serialize(),
					success : function(data){
						$(".message-errors").html(data);
					}
				})
				return false;
			});
		});
	</script>
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style type="text/css">
		@keyframes lds-cube {
			0% {
				-webkit-transform: scale(1.5);
				transform: scale(1.5);
			}
			100% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}
		}
		@-webkit-keyframes lds-cube {
		  0% {
			-webkit-transform: scale(1.5);
			transform: scale(1.5);
		  }
		  100% {
			-webkit-transform: scale(1);
			transform: scale(1);
		  }
		}
		.lds-cube {
		  position: fixed;
		  margin-left:40%;
		  z-index: 1;
		  
		}
		.lds-cube div {
		  position: absolute;
		  width: 80px;
		  height: 80px;
		  top: 10px;
		  left: 10px;
		  background: #ff727d;
		  -webkit-animation: lds-cube 1s cubic-bezier(0, 0.5, 0.5, 1) infinite;
		  animation: lds-cube 1s cubic-bezier(0, 0.5, 0.5, 1) infinite;
		  -webkit-animation-delay: -0.3s;
		  animation-delay: -0.3s;
		}
		.lds-cube div:nth-child(2) {
		  top: 10px;
		  left: 110px;
		  background: #ffd391;
		  -webkit-animation-delay: -0.2s;
		  animation-delay: -0.2s;
		}
		.lds-cube div:nth-child(3) {
		  top: 110px;
		  left: 110px;
		  background: #90ffb5;
		  -webkit-animation-delay: 0s;
		  animation-delay: 0s;
		}
		.lds-cube div:nth-child(4) {
		  top: 110px;
		  left: 10px;
		  background: #fffbd0;
		  -webkit-animation-delay: -0.1s;
		  animation-delay: -0.1s;
		}
		.lds-cube {
		  width: 200px !important;
		  height: 200px !important;
		  -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
		  transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
		}
	</style>
</head>
<body class="hold-transition login-page">
	<div class="lds-css ng-scope class-loading-cube">
		<div style="width:100%;height:100%" class="lds-cube">
			<div>
			</div>
			<div>
			</div>
			<div>
			</div>
			<div>
			</div>
		</div>
	</div>
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><b>USBN</b>BK</a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Assalamulaikum silahkan login untuk memasuki ruang guru</p>
			<div class='message-errors'></div>
			<form action="#" method="post" name='form' id='form'>
				<div class="form-group has-feedback">
					<input type="text" class="form-control" placeholder="NISN" name='nisn' id=''>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="text" class="form-control" placeholder="NIK" name='nik' id=''>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="text" class="form-control" placeholder="Token" name='token' id=''>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-8"></div>
					<!-- /.col -->
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 3 -->
	<script src="<?php base_url();?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php base_url();?>assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="<?php base_url();?>assets/admin/plugins/iCheck/icheck.min.js"></script>
	<script>
	$(function () {
	$('input').iCheck({
	checkboxClass: 'icheckbox_square-blue',
	radioClass: 'iradio_square-blue',
	increaseArea: '20%' /* optional */
	});
	});
	</script>
</body>
</html>
