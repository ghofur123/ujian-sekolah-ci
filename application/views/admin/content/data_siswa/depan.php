<style>
	.form-control {
		margin-bottom:5px;
	}
</style>
<script type="text/javascript">
	dataSelectKelas();
	selectKelas();
	randomNumber();
	$(document).ready(function(){
		$(".new-data-class").click(function(){
			$("#form").show();
			$(".view-class-modal").hide();
			randomNumber();
		});
		
		$("#form").submit(function(){
			//jangan lupa url nya di ganti sesuai dengan link nya
			$.ajax({
				type : "POST",
				url : "data_siswa/load?act=insert",
				data : $(this).serialize(),
				success : function(data){
					load_siswa_storage();
					$(".message-errors").html(data);
					$("#nama_siswa").val("");$("#nisn").val("");$("#nik").val("");$("#kelas_id").val("");
					randomNumber();
				}
			})
			return false;
		});
		
		$("#form2").submit(function(){
			//jangan lupa url nya di ganti sesuai dengan link nya
			$.ajax({
				type : "POST",
				url : "data_siswa/load?act=update",
				data : $(this).serialize(),
				success : function(data){
					load_siswa_storage();
					$(".message-errors2").html(data);
					$("#nama_siswa").val("");$("#nisn").val("");$("#nik").val("");$("#kelas_id").val("");
					randomNumber();
				}
			})
			return false;
		});
		$(".class-reloaded").click(function(){
			if(confirm("load data lagi / fungsi ini seperti refres")){
				ajaxload();
			}
		});
		$(".class-upload-to-exel").click(function(){
			alert("warning !!! untuk mengupload data menggunakan exel harus sesuai tabel di bawah");
		});
		$("#search").keyup(function(){
			var id = $(this).val();
			//jangan lupa url nya di ganti sesuai dengan link nya
			$.ajax({
				type : "POST",
				url : "data_siswa/load?act=search&id=" + id,
				data : $(this).serialize(),
				beforeSend: function() {
					 $(".class-loading-cube").show();
				 },
				success : function(data){
					$(".displaydata").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
		$(".select-kelas-form").on("change", function(){
			var id = $(this).val();
			localStorage.setItem("id_kelas", id);
			$.ajax({
				type : "POST",
				url : "data_siswa/load?&act=load&kelasId=" + id,
				data : $(this).serialize(),
				beforeSend: function() {
					 $(".class-loading-cube").show();
				 },
				success : function(data){
					$(".displaydata").html(data);
					dataSelectJurusan();
					localStorage.setItem("jurusan_id", "clear");
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
		
		$(".class-daftar-hadir").click(function(){
			$.ajax({
				type : "POST",
				url : "data_siswa/load?&act=load2&kelasId=" + localStorage.getItem("id_kelas") + "&jurusan_id=" + localStorage.getItem("jurusan_id"),
				data : $(this).serialize(),
				beforeSend: function() {
					 $(".class-loading-cube").show();
				 },
				success : function(data){
					$(".displaydata2").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
		$(".class-kartu-ujian").click(function(){
			$.ajax({
				type : "POST",
				url : "data_siswa/load?&act=load3&kelasId=" + localStorage.getItem("id_kelas") + "&jurusan_id=" + localStorage.getItem("jurusan_id"),
				data : $(this).serialize(),
				beforeSend: function() {
					 $(".class-loading-cube").show();
				 },
				success : function(data){
					$(".displaydata3").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
		$(".class-kartu-qrcode").click(function(){
			var dataValue = "";
			$.ajax({
				type : "POST",
				url : "data_siswa/load?&act=load4&kelasId=" + localStorage.getItem("id_kelas") + "&jurusan_id=" + localStorage.getItem("jurusan_id"),
				contentType: "application/x-www-form-urlencoded; charset=utf-8",
				dataType    : "json",
				data : $(this).serialize(),
				beforeSend: function() {
					 $(".class-loading-cube").show();
				 },
				success : function(datayyy){
					for(var i = 0; i < datayyy.length; i++){
						$('.class-qrcode').qrcode({width: 200,height: 200,text: ""+datayyy[i]["nisn"]+""});
						$('.class-qrcode').css(["border"]);
						
					}
					// var nn = "okkk";
					// $('.class-qrcode').html(dataValue);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
		$(".class-kartu-siswa").click(function(){
			$.ajax({
				type : "POST",
				url : "data_siswa/load?&act=load5&kelasId=" + localStorage.getItem("id_kelas") + "&jurusan_id=" + localStorage.getItem("jurusan_id"),
				data : $(this).serialize(),
				beforeSend: function() {
					 $(".class-loading-cube").show();
				 },
				success : function(data){
					$(".class-kartu-siswa-view").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
	});
	function randomNumber(){
		var randomOne = Math.floor((Math.random() * 1000000000) + 5);
		var randomTwo = Math.floor((Math.random() * 1000000000) + 5);
		$("#nisn").val(randomOne);
		$("#nik").val(randomTwo);
	}
	function dataSelectKelas(){
		$.ajax({
			type : "POST",
			url : "data_siswa/load?act=view_kelas",
			data : $(this).serialize(),
			success : function(data){
				$("#data-kelas").html(data);
				$("#data-kelas-form").html(data);
			}
		})
	}
	function dataSelectJurusan(){
		$.ajax({
			type : "POST",
			url : "data_siswa/load?act=view_jurusan",
			data : $(this).serialize(),
			success : function(data){
				$("#data-jurusan").html(data);
				$("#data-jurusan-form").html(data);
			}
		})
	}
	function selectKelas(){
		
		alert("click....");
	}
	function load_siswa_storage(){
		$.ajax({
			type : "POST",
			url : "data_siswa/load?&act=load&kelasId=" + localStorage.getItem("id_kelas"),
			data : $(this).serialize(),
			beforeSend: function() {
				$(".class-loading-cube").show();
			},
			success : function(data){
				$(".displaydata").html(data);
			}
		}).done(function(){
			$(".class-loading-cube").hide("5000");
		});
	}
	function qrcodeMake(){
		
			
	}
</script>				
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Data Siswa
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<div id='data-kelas'></div>
				<div id='data-jurusan'></div>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<button type="button" class="btn btn-info new-data-class" data-toggle="modal" data-target="#myModal">New Data</button>
				<button type="button" class="btn btn-success class-reloaded">Reloaded</button>
				<button type="button" class="btn btn-primary class-upload-to-exel">Upload to exel</button>
				<button type="button" class="btn btn-info class-daftar-hadir" data-toggle="modal" data-target="#myModal2">Daftar Hadir</button>
				<button type="button" class="btn btn-info class-kartu-ujian" data-toggle="modal" data-target="#myModal3">Kartu Ujian</button>
				<!-- <button type="button" class="btn btn-info class-kartu-qrcode" data-toggle="modal" data-target="#myModal4">QRCode</button> -->
				<!-- <button type="button" class="btn btn-info class-kartu-siswa" data-toggle="modal" data-target="#myModal5">Kartu Siswa</button> -->
				<hr />
				<input type="text" class="form-control" id="search" style="float:none; width:100%;" placeholder="Cari......">
				<hr />
				<div class="modal fade" id="myModal" role="dialog" style="overflow:scroll;">
					<div class="modal-dialog">
					
						<div class="modal-content">
							<form  method="POST" action="#" id="form" name="form1" >
								<div class="message-errors"></div>
								<div class="modal-body">
									<input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="nama_siswa" >
									<input type="text" class="form-control" name="nisn" id="nisn" readonly>
									<input type="text" class="form-control" name="nik" id="nik" readonly>
									<div class='class-form-kelas' id='data-kelas-form'></div>		
									<div class='class-form-jurusan' id='data-jurusan-form'>jurusan</div>		
								</div>
								<div class="modal-footer" style="background:#99bbff; margin-top:20px; border-radius:0px 0px 5px 5px;">
									<button type="submit" class="btn btn-primary btn-submit-class" >Simpan</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								</div>
							</form>
							<div class="view-class-modal">
							<form  method="POST" action="#" id="form2" name="form1" >
							<div class="message-errors2"></div>
								<div class="modal-body">
									<div class="table-view-class"></div>
								</div>
								<div class="modal-footer " style="background:#99bbff; border-radius:0px 0px 5px 5px;">
									<button type="submit" class="btn btn-primary btn-view-edit" >Edit</button>
									<button type="button" class="btn btn-default btn-view-edit" data-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-danger btn-view-close" data-dismiss="modal">Close</button>
								</div>
							</div>
							</form>
						</div>

					</div>
				</div>
				<div class="modal fade" id="myModal2" role="dialog" style="overflow:scroll;">
					<div class="modal-dialog" style='width:80%;'>
						
						<div class="modal-content print-area-daftar-hadir-class">
							<div class='modal-header'>
								<button id='daftar-hadir-print-id' type='button' onclick="printJS('print-area-daftar-hadir-id', 'html')">print</button>
							</div>
							<form id='print-area-daftar-hadir-id'>
								<div class="displaydata2"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal fade" id="myModal3" role="dialog" style="overflow:scroll;">
					<div class="modal-dialog" style='width:80%;'>
						
						<div class="modal-content print-area-daftar-hadir-class">
							<div class='modal-header'>
								<button id='daftar-hadir-print-id' type='button' onclick="printJS('print-area-kartu-ujian', 'html')">print</button>
							</div>
							<form id='print-area-kartu-ujian'>
								<div class="displaydata3"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal fade" id="myModal4" role="dialog" style="overflow:scroll;">
					<div class="modal-dialog" style='width:80%;'>
						
						<div class="modal-content print-area-daftar-hadir-class">
							<div class='modal-header'>
								<button id='daftar-hadir-print-id' type='button' onclick="printJS('print-area-kartu-qrcode1', 'html')">print</button>
							</div>
							<div id='print-area-kartu-qrcode'>
								<div id='print-area-kartu-qrcode1' class="class-qrcode" style="border: 2px solid red;"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="myModal5" role="dialog" style="overflow:scroll;">
					<div class="modal-dialog" style='width:80%;'>
						
						<div class="modal-content print-area-daftar-hadir-class">
							<div class='modal-header'>
								<button id='daftar-hadir-print-id' type='button' onclick="printJS('print-area-kartu-siswa', 'html')">print</button>
							</div>
							<div id='print-area-kartu-siswa'>
								<div id='print-area-kartu-siswa' class="class-kartu-siswa-view" style="border: 2px solid red;"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">          
					<div class="displaydata"></div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				Footer
			</div>
			<!-- /.box-footer-->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
					
									