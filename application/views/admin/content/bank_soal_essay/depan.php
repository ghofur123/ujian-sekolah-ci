<style>
	.form-control {
		margin-bottom:5px;
	}
</style>
<script type="text/javascript">
	ajaxload();
	dataSelectUjianForm();
	dataSelectUjian();
	alertCheck();
	$(document).ready(function(){
		$(".new-data-class").click(function(){
			$("#form").show();
			$(".view-class-modal").hide();
		});
		
		$("#form").submit(function(){
			var soal = CKEDITOR.instances.soal.getData();
			for(instance in CKEDITOR.instances){
				CKEDITOR.instances[instance].updateElement();
			}
			//"soal=" + soal + "&ujian_id=" + $("#ujian_id").val()
			$.ajax({
				type : "POST",
				url : "bank_soal_essay/load?act=insert",
				data : $(this).serialize(),
				success : function(data){
					ajaxload();
					$(".message-errors").html(data);
					CKEDITOR.instances.soal.setData("");
				}
			})
			return false;
		});
		
		$("#form2").submit(function(){
			console.log($("#id").val());
			//jangan lupa url nya di ganti sesuai dengan link nya
			for(instance in CKEDITOR.instances){
				CKEDITOR.instances[instance].updateElement();
			}
			$.ajax({
				type : "POST",
				url : "bank_soal_essay/load?act=update",
				data : $(this).serialize(),
				success : function(data){
					ajaxload();
					$(".message-errors2").html(data);
					
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
				url : "bank_soal_essay/load?act=search&id=" + id + "&ujian_id=" + localStorage.get("ujian_id"),
				data : $(this).serialize(),
				success : function(data){
					$("#displaydata").html(data);
				}
			})
		});
		$(".select-ujian-form").on("change", function(){
			var id = $(this).val();
			$.ajax({
				type : "POST",
				url : "bank_soal_essay/load?&act=load&ujian_id=" + id,
				data : $(this).serialize(),
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					$("#displaydata").html(data);
					localStorage.setItem("ujian_id", id);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
		
	});
	function ajaxload(){
		//jangan lupa url nya di ganti sesuai dengan link nya
		$.ajax({
			type : "POST",
			url : "bank_soal_essay/load?&act=load&ujian_id=" + localStorage.getItem("ujian_id"),
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
	var roxyFileman = 'assets/admin/bower_components/ckeditor/plugins/fileman/index.html';
    $(function () {
        CKEDITOR.replace('soal', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload'});
    });
	function dataSelectUjianForm(){
		$.ajax({
			type : "POST",
			url : "Data_public/ujian_form",
			data : $(this).serialize(),
			success : function(data){
				$("#data-ujian-form").html(data);
			}
		})
	}
	function dataSelectUjian(){
		$.ajax({
			type : "POST",
			url : "Data_public/ujian",
			data : $(this).serialize(),
			success : function(data){
				$("#data-ujian").html(data);
			}
		})
	}
	function alertCheck(){
		alert("click");
	}
</script>			
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Bank Soal Essay
			<small>Layout with collapsed sidebar on load</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="callout callout-info">
			<h4>Tip!</h4>

			<p>untuk input, edit, delete bank soal essay</p>
		</div>
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<div id='data-ujian'>Proses load data ujian....</div>

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
					<div class="modal-dialog" style='width: 60%;'>
					
						<div class="modal-content">
							<form  method="POST" action="#" id="form" name="form1" >
								<div class="message-errors"></div>
								<div class="modal-body">
									<textarea name="soal" id="soal"></textarea>
									<div id='data-ujian-form'>load ujian id</div>				
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