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
				url : "ujian/load?act=insert",
				data : $(this).serialize(),
				success : function(data){
					ajaxload();
					$(".message-errors").html(data);
					$("#nama_ujian").val("");$("#kelas_id").val("");$("#token").val("");$("#guru_id").val("");$("#materi_id").val("");$("#jumlah_ujian").val("");
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
					$("#nama_ujian").val("");$("#kelas_id").val("");$("#token").val("");$("#guru_id").val("");$("#materi_id").val("");$("#jumlah_ujian").val("");
				}
			})
			return false;
		});
		$(".class-reloaded").click(function(){
			if(confirm("load data lagi / fungsi ini seperti refres")){
				//ajaxload();
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
		
		$(".select-kelas-form").on("change", function(){
			var id = $(this).val();
			$.ajax({
				type : "POST",
				url : "ujian/load?&act=load&kelasId=" + id,
				data : $(this).serialize(),
				success : function(data){
					$("#displaydata").html(data);
				}
			})
		});
	});
	function dataSelectKelas(){
		$.ajax({
			type : "POST",
			url : "data_siswa/load?act=view_kelas",
			data : $(this).serialize(),
			success : function(data){
				$("#data-kelas").html(data);
			}
		})
	}
	function selectKelas(){
		alert("click....");
	}
</script>			
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Sidebar Collapsed
			<small>Layout with collapsed sidebar on load</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Layout</a></li>
			<li class="active">Collapsed Sidebar</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="callout callout-info">
			<h4>Tip!</h4>

			<p>Add the sidebar-collapse class to the body tag to get this layout. You should combine this option with a
			fixed layout if you have a long sidebar. Doing that will prevent your page content from getting stretched
			vertically.</p>
		</div>
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<div id='data-kelas'>Proses load data kelas....</div>

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
				<hr />
				<input type="text" class="form-control" id="search" style="float:none; width:100%;" placeholder="Cari......">
				<hr />
				<div class="modal fade" id="myModal" role="dialog" style="overflow:scroll;">
					<div class="modal-dialog">
					
						<div class="modal-content">
							<form  method="POST" action="#" id="form" name="form1" >
								<div class="message-errors"></div>
								<div class="modal-body">
									<input type="text" class="form-control" name="nama_ujian" id="nama_ujian" placeholder="nama_ujian" ><input type="text" class="form-control" name="kelas_id" id="kelas_id" placeholder="kelas_id" ><input type="text" class="form-control" name="token" id="token" placeholder="token" ><input type="text" class="form-control" name="guru_id" id="guru_id" placeholder="guru_id" ><input type="text" class="form-control" name="materi_id" id="materi_id" placeholder="materi_id" ><input type="text" class="form-control" name="jumlah_ujian" id="jumlah_ujian" placeholder="jumlah_ujian" >				
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
					
									