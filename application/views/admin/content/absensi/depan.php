<style>
	.form-control {
		margin-bottom:5px;
	}
</style>
<script type="text/javascript">
	dataSelectKelas();
	selectKelas();
	$(document).ready(function(){
		$(".new-data-class").click(function(){
			$("#form").show();
			$(".view-class-modal").hide();
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
	});
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
				<div id='data-kelas'>Proses load data kelas....</div>
				<div id='data-jurusan'>Proses load data jurusan....</div>
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
				<hr />
				<input type="text" class="form-control" id="search" style="float:none; width:100%;" placeholder="Cari......">
				<hr />
				<div class="modal fade" id="myModal" role="dialog" style="overflow:scroll;">
					<div class="modal-dialog">
					
						<div class="modal-content">
							<div class="message-errors"></div>
							<div class="modal-body">
							
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
					
									