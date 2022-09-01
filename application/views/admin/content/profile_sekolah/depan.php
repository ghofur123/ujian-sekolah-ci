<style>
	.form-control {
		margin-bottom:5px;
	}
</style>
<script type="text/javascript">
	ajaxload();
	$(document).ready(function(){
		$(".new-data-class").click(function(){
			$("#form").show();
			$(".view-class-modal").hide();
		});
		
			$("#form").submit(function(){
			//jangan lupa url nya di ganti sesuai dengan link nya
			$.ajax({
				type : "POST",
				url : "profile_sekolah/load?act=insert",
				data : $(this).serialize(),
				success : function(data){
					ajaxload();
					$(".message-errors").html(data);
					$("#nama").val("");$("#kode").val("");$("#alamat").val("");$("#kepsek").val("");$("#no_tlp").val("");
				}
			})
			return false;
		});
		
		$("#form2").submit(function(){
			//jangan lupa url nya di ganti sesuai dengan link nya
			$.ajax({
				type : "POST",
				url : "profile_sekolah/load?act=update",
				data : $(this).serialize(),
				success : function(data){
					ajaxload();
					$(".message-errors2").html(data);
					$("#nama").val("");$("#kode").val("");$("#alamat").val("");$("#kepsek").val("");$("#no_tlp").val("");
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
				url : "profile_sekolah/load?act=search&id=" + id,
				data : $(this).serialize(),
				success : function(data){
					$("#displaydata").html(data);
				}
			})
		});
	});
	function ajaxload(){
		//jangan lupa url nya di ganti sesuai dengan link nya
		$.ajax({
			type : "POST",
			url : "profile_sekolah/load?&act=load",
			data : $(this).serialize(),
			success : function(data){
				$("#displaydata").html(data);
			}
		})
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
				<hr />
				<input type="text" class="form-control" id="search" style="float:none; width:100%;" placeholder="Cari......">
				<hr />
				<div class="modal fade" id="myModal" role="dialog" style="overflow:scroll;">
					<div class="modal-dialog">
					
						<div class="modal-content">
							<form  method="POST" action="#" id="form" name="form1" >
								<div class="message-errors"></div>
								<div class="modal-body">
									<input type="text" class="form-control" name="nama" id="nama" placeholder="nama" ><input type="text" class="form-control" name="kode" id="kode" placeholder="kode" ><input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat" ><input type="text" class="form-control" name="kepsek" id="kepsek" placeholder="kepsek" ><input type="text" class="form-control" name="no_tlp" id="no_tlp" placeholder="no_tlp" >				
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
					
					