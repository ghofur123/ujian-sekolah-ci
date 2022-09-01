<style>
	.form-control {
		margin-bottom:5px;
	}
</style>
<script type="text/javascript">
	dataSelectUjianForm();
	dataSelectKelas();
	$(document).ready(function(){
		$(".new-data-class").click(function(){
			$("#form").show();
			$(".view-class-modal").hide();
		});
		
		$("#form").submit(function(){
			var frm = this;
			//var soal = CKEDITOR.instances.soal.getData();
			alert("click");
			for(instance in CKEDITOR.instances){
				CKEDITOR.instances[instance].updateElement();
			}
			$.ajax({
				type : "POST",
				url : "bank_soal/load?act=insert",
				data : $(this).serialize(),
				contentType: "application/x-www-form-urlencoded; charset=utf-8",
				success : function(data){
					loadDataAgain();
					$(".message-errors").html(data);
					CKEDITOR.instances.soal.setData("");
					CKEDITOR.instances.a.setData("");
					CKEDITOR.instances.b.setData("");
					CKEDITOR.instances.c.setData("");
					CKEDITOR.instances.d.setData("");
					CKEDITOR.instances.e.setData("");
					//$("#ujian_id").val("");
					$("#jawaban_soal").val("");
				}
			})
			return false;
		});
		
		$("#form2").submit(function(){
			for(instance in CKEDITOR.instances){
				CKEDITOR.instances[instance].updateElement();
			}
			$.ajax({
				type : "POST",
				url : "bank_soal/load?act=update",
				data : $(this).serialize(),
				success : function(data){
					loadDataAgain();
					$(".message-errors2").html(data);
					$("#soal").val("");$("#a").val("");$("#b").val("");$("#c").val("");$("#d").val("");$("#e").val("");$("#ujian_id").val("");$("#jawaban_soal").val("");
				}
			})
			return false;
		});
		$("#formExel").submit(function(){
			var formData = new FormData();
			var inputFile4 = $("input[name=soal_exel]");
			var fileToUpload = inputFile4[0].files[0];
			formData.append("upload_soal", fileToUpload);
			$.ajax({
				type : "POST",
				url : "bank_soal/upload_soal_exel",
				data : formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					loadDataAgain();
					$(".message-post").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
			return false;
		});
		$("#formExel2").submit(function(){
			var formData = new FormData();
			var inputFile4 = $("input[name=soal_exel2]");
			var ujian_id = $(".select-ujian-form2").val();
			
			formData.append("ujian_id", ujian_id);
			
			var fileToUpload = inputFile4[0].files[0];
			formData.append("upload_soal", fileToUpload);
			//console.log(localStorage.getItem("ujian_id"));
			$.ajax({
				type : "POST",
				url : "bank_soal/upload_soal_exel2?pg=1&ujian_id=" + localStorage.getItem("ujian_id"),
				data : formData,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					loadDataAgain();
					$(".message-post-2").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
			return false;
		});
		$(".class-reloaded").click(function(){
			//if(confirm("load data lagi / fungsi ini seperti refres")){
				loadDataAgain();
			//}
		});
		$("#search").keyup(function(){
			var id = $(this).val();
			$.ajax({
				type : "POST",
				url : "bank_soal/load?act=search&id=" + id + "&ujian_id=" + localStorage.getItem("ujian_id"),
				data : $(this).serialize(),
				success : function(data){
					$("#displaydata").html(data);
				}
			})
		});
		$(".select-kelas-form").on("change", function(){
			alert("okkk");
		});
		
		
	});
	function datang(){
		alert("Selamat Datang....");
	}
	function dataSelectKelas(){
		$.ajax({
			type : "POST",
			url : "bank_soal/load?act=view_kelas",
			data : $(this).serialize(),
			success : function(data){
				$("#data-kelas-select").html(data);
			}
		})
	}
	
	function dataSelectUjianForm(){
		$.ajax({
			type : "POST",
			url : "Data_public/ujian_form",
			data : $(this).serialize(),
			success : function(data){
				$(".data-ujian-form").html(data);
				$(".data-ujian-form2").html(data);
			}
		})
	}
	function loadDataAgain(){
		$.ajax({
			type : "POST",
			url : "bank_soal/load?&act=load&idUjian=" + localStorage.getItem("ujian_id"),
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
            removeDialogTabs: 'link:upload;image:upload', height: 50});
			
    });
	$(function () {
        CKEDITOR.replace('a', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload', height: 50});
    });
	$(function () {
        CKEDITOR.replace('b', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload', height: 50});
    });
	$(function () {
        CKEDITOR.replace('c', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload', height: 50});
    });
	$(function () {
        CKEDITOR.replace('d', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload', height: 50});
    });
	$(function () {
        CKEDITOR.replace('e', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload', height: 50});
			
    });
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Bank Soal
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="callout callout-info">
			<h4>Tip!</h4>

			<p>halaman untuk tambah,edit,delete data soal</p>
		</div>
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<div id='data-kelas-select'>load kelas.....</div>
				<div id='data-ujian'></div>

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
				<button type="button" class="btn btn-primary class-upload-to-exel" data-toggle="modal" data-target="#myModal2">View Upload to exel</button>
				<button type="button" class="btn btn-primary class-upload-to-exel" data-toggle="modal" data-target="#myModal3">Upload Exel</button>
				<hr />
				<input type="text" class="form-control" id="search" style="float:none; width:100%;" placeholder="Cari......">
				<hr />
				<div class="modal fade" id="myModal" role="dialog" style="overflow:scroll;" style="width: 70%; margin-top:10px;">
					<div class="modal-dialog" style='width:80%; margin-top:10px;'>
					
						<div class="modal-content">
							
							<form  method="POST" action="#" id="form" name="form1" >
								<div class="message-errors"></div>
								<div class="modal-body">
									SOAL<textarea name="soal" id="soal"></textarea>
									A<textarea name="a" id="a"></textarea>
									B<textarea name="b" id="b"></textarea>
									C<textarea name="c" id="c"></textarea>
									D<textarea name="d" id="d"></textarea>
									E<textarea name="e" id="e"></textarea>
									<div class='data-ujian-form'>load ujian id</div>
									<select class="form-control" name="jawaban_soal" id="jawaban_soal" style='width:45%; float:right; margin-top:-40px;'>
										<option value=''> Pilih Jawaban Yang Benar</option>
										<option value='a'>A</option>
										<option value='b'>B</option>
										<option value='c'>C</option>
										<option value='d'>D</option>
										<option value='e'>E</option>
										
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
				<div class="modal fade" id="myModal2" role="dialog" style="overflow:scroll;" style="width: 70%; margin-top:10px;">
					<div class="modal-dialog" style='width:100%; margin-top:10px;'>
					
						<div class="modal-content">
							<div class='modal-body'>
								<div class='message-post'></div>
							</div>
							<?php echo form_open_multipart("#", "id='formExel'");?>
								<div class="modal-body">
									
									<input type='file' name='soal_exel' id='soal_exel'>
								</div>
								<div class="modal-footer " style="background:#99bbff; border-radius:0px 0px 5px 5px;">
									<button type="submit" class="btn btn-primary" >Extract</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal fade" id="myModal3" role="dialog" style="overflow:scroll;" style="width: 70%; margin-top:10px;">
					<div class="modal-dialog" style='width:100%; margin-top:10px;'>
					
						<div class="modal-content">
							<div class='modal-header'>
							Pastikan data yang akan di input sudah di cek
							</div>
							<div class='modal-body'>
								<div class='message-post-2'></div>
							</div>
							<?php echo form_open_multipart("#", "id='formExel2'");?>
								<div class="modal-body">
									<input type='file' name='soal_exel2' id='soal_exel2'>
								</div>
								<div class="modal-footer " style="background:#99bbff; border-radius:0px 0px 5px 5px;">
									<button type="submit" class="btn btn-primary" >Upload</button>
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
			<!-- /.box-footer-->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
					
					
					
					