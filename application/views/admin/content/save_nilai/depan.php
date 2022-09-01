<style>
	.form-control {
		margin-bottom:5px;
	}
</style>
<script type="text/javascript">
	ajaxload();
	$(document).ready(function(){
	});
	function ajaxload(){
		//jangan lupa url nya di ganti sesuai dengan link nya
		$.ajax({
			type : "POST",
			url : "save_nilai/load?&act=load",
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
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="callout callout-info">
			<h4>Tip!</h4>
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
				<div class="table-responsive">          
					<div id="displaydata"></div>
				</div>

			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->