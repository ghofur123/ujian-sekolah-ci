<style>
	.form-control {
		margin-bottom:5px;
	}
</style>
<script type="text/javascript">
	//ajaxload();
	dataSelectKelasForm();
	dataSelectGuru();
	dataSelectMateriForm();
	dataSelectKelas();
	dataSelectJenisUjianForm();
	$(document).ready(function(){
		$(".new-data-class").click(function(){
			$("#form").show();
			$(".view-class-modal").hide();
		});
		
		$("#form").submit(function(){
			//jangan lupa url nya di ganti sesuai dengan link nya
			$.ajax({
				type : "POST",
				url : "ujian/load?act=insert",
				data : $(this).serialize(),
				success : function(data){
					ajaxload();
					$(".message-errors").html(data);
					$("#nama_ujian").val("");
					$("#kelas_id").val("");
					$("#token").val("");
					$("#guru_id").val("");
					$("#materi_id").val("");
					$("#jumlah_ujian").val("");
					$("#persen_multiple_coice").val("");
					$("#persen_essay").val("");
					randToken();
				}
			})
			return false;
		});
		
		$("#form2").submit(function(){
			//jangan lupa url nya di ganti sesuai dengan link nya
			$.ajax({
				type : "POST",
				url : "ujian/load?act=update",
				data : $(this).serialize(),
				success : function(data){
					ajaxload();
					$(".message-errors2").html(data);
					$("#nama_ujian").val("");
					$("#kelas_id").val("");
					$("#token").val("");
					$("#guru_id").val("");
					$("#materi_id").val("");
					$("#jumlah_ujian").val("");
					$("#persen_multiple_coice").val("");
					$("#persen_essay").val("");
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
				url : "ujian/load?act=search&id=" + id,
				data : $(this).serialize(),
				success : function(data){
					$("#displaydata").html(data);
				}
			})
		});
		$("#persen_multiple_coice").on("change", function(){
			var nilai = $(this).val();
			var nl = 100 - nilai;
			$("#persen_essay").val(nl);
		});
		$(".new-data-class").on("click", function(){
			randToken();
		});
		
	});
	function ajaxload(){
		//jangan lupa url nya di ganti sesuai dengan link nya
		$.ajax({
			type : "POST",
			url : "ujian/load?&act=load",
			data : $(this).serialize(),
			beforeSend: function() {
					$(".class-loading-cube").show();
				},
			success : function(data){
				$("#displaydata").html(data);
			}
		}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
	}
	function dataSelectKelasForm(){
		$.ajax({
			type : "POST",
			url : "data_public/kelas",
			data : $(this).serialize(),
			success : function(data){
				$("#data-kelas-form").html(data);
			}
		})
	}
	function dataSelectGuru(){
		$.ajax({
			type : "POST",
			url : "data_public/guru",
			data : $(this).serialize(),
			success : function(data){
				$("#data-guru").html(data);
			}
		})
	}
	function dataSelectMateriForm(){
		$.ajax({
			type : "POST",
			url : "data_public/materi",
			data : $(this).serialize(),
			success : function(data){
				$("#data-materi-form").html(data);
			}
		})
	}
	function randToken(){
		var randomOne = Math.floor((Math.random() * 1000000000) + 5);
		$("#token").val(randomOne);
	}
	function dataSelectKelas(){
		$.ajax({
			type : "POST",
			url : "ujian/load?act=view_kelas",
			data : $(this).serialize(),
			success : function(data){
				$("#data-kelas").html(data);
			}
		})
	}
	function dataSelectMateri(){
		$.ajax({
			type : "POST",
			url : "ujian/load?act=view_materi",
			data : $(this).serialize(),
			success : function(data){
				$("#data-materi").html(data);
			}
		})
	}
	function dataSelectJenisUjian(){
		$.ajax({
			type : "POST",
			url : "ujian/load?act=view_jenis_ujian",
			data : $(this).serialize(),
			success : function(data){
				$("#data-jenis-ujian").html(data);
			}
		})
	}
	function dataSelectJenisUjianForm(){
		$.ajax({
			type : "POST",
			url : "ujian/load?act=view_jenis_ujian",
			data : $(this).serialize(),
			success : function(data){
				$("#data-jenis-ujian-form").html(data);
			}
		})
	}
</script>
	
					
					
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Ujian
			<small>Data ujian dan token</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Title</h3>

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
					<div id="data-kelas"></div>
					<div id="data-materi"></div>
					<div id="data-jenis-ujian"></div>
					<hr />
					<input type="text" class="form-control" id="search" style="float:none; width:100%;" placeholder="Cari......">
					<hr />
					<div class="modal fade" id="myModal" role="dialog" style="overflow:scroll;">
						<div class="modal-dialog">
						
							<div class="modal-content">
								<form  method="POST" action="#" id="form" name="form1" >
									<div class="message-errors"></div>
									<div class="modal-body">
										<input type="text" class="form-control" name="nama_ujian" id="nama_ujian" placeholder="nama_ujian" >
										<div id='data-kelas-form'>load kelas</div>
										<input type="text" class="form-control" name="token" id="token" placeholder="token" readonly value=''>
										<div id='data-guru'>load guru</div>
										<div id='data-materi-form'>load materi</div>
										<div id='data-jenis-ujian-form'>load materi</div>
										<input type="text" class="form-control" name="jumlah_ujian" id="jumlah_ujian" placeholder="jumlah ujian multiple coice" >
										<select class="form-control" name="persen_multiple_coice" id="persen_multiple_coice" >
											<option value=''>Pilih Persentase nilai multiple coice</option>
											<?php
												for($i = 0; $i < 100; $i++){
													if($i%10 == 0){
														echo "
														<option value='$i'>$i</option>
														";
													}
												}
											?>
											<option value='100'>100</option>
										</select>
										Persentase Nilai essay
										<input type="text" class="form-control" name="persen_essay" id="persen_essay" placeholder="persen_essay" readonly>	
										Waktu
										<select class="form-control" name="waktu" required>
											<option value=''>Pilih Waktu Ujian</option>
											<option value='10'>10 Menit</option>
											<option value='15'>15 Menit</option>
											<option value='20'>20 Menit</option>
											<option value='25'>25 Menit</option>
											<option value='30'>30 Menit</option>
											<option value='35'>35 Menit</option>
											<option value='40'>40 Menit</option>
											<option value='45'>45 Menit</option>
											<option value='50'>50 Menit</option>
											<option value='55'>55 Menit</option>
											<option value='60'>60 Menit</option>
											<option value='65'>65 Menit</option>
											<option value='70'>70 Menit</option>
											<option value='75'>75 Menit</option>
											<option value='80'>80 Menit</option>
											<option value='85'>85 Menit</option>
											<option value='90'>90 Menit</option>
											
										</select>
										<select class="form-control" name="metode" required>
											<option value=''>Pilih Metode Ujian</option>
											<option value='1'>Nampil Semua Sesuai No Urut</option>
											<option value='2'>Nampil Semua Acak Nomer</option>
											<option value='3'>Nampil 1 Acak</option>
										</select>
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
										<button type="submit" class="btn btn-primary btn-view-edit" >Simpan</button>
										<button type="button" class="btn btn-default btn-view-edit" data-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-danger btn-view-close" data-dismiss="modal">Close</button>
									</div>
								</div>
								</form>
							</div>

						</div>
					</div>

					<div class="table-responsive">          
						<div id="displaydata"></div>
					</div>
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
					
					