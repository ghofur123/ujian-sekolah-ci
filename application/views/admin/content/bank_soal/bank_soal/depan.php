<style>
	.form-control {
		margin-bottom:5px;
	}
</style>
<script type="text/javascript">
	dataSelectUjian();
	selectUjian();
	dataSelectUjianForm();
	$(document).ready(function(){
		$(".new-data-class").click(function(){
			$("#form").show();
			$(".view-class-modal").hide();
		});
		
		$("#form").submit(function(){
			var frm = this;
			var soal = CKEDITOR.instances.soal.getData();
			var a = CKEDITOR.instances.a.getData();
			var b = CKEDITOR.instances.b.getData();
			var c = CKEDITOR.instances.c.getData();
			var d = CKEDITOR.instances.d.getData();
			var e = CKEDITOR.instances.e.getData();
			var ujian_id = $("#ujian_id").val();
			var jawaban_soal = $("#jawaban_soal").val();
			alert(soal);
			//jangan lupa url nya di ganti sesuai dengan link nya
			$.ajax({
				type : "POST",
				url : "bank_soal/load?act=insert",
				data : "soal=" + soal + "&a=" + a + "&b=" + b + "&c=" + c + "&d=" + d + "&e=" + e + "&ujian_id=" + ujian_id + "&jawaban_soal=" + jawaban_soal,
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
			//jangan lupa url nya di ganti sesuai dengan link nya
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
		$(".class-reloaded").click(function(){
			if(confirm("load data lagi / fungsi ini seperti refres")){
				loadDataAgain();
			}
		});
		$(".class-upload-to-exel").click(function(){
			alert("warning !!! untuk mengupload data menggunakan exel harus sesuai tabel di bawah");
		});
		$("#search").keyup(function(){
			var id = $(this).val();
			alert(localStorage.getItem("ujian_id"));
			//jangan lupa url nya di ganti sesuai dengan link nya
			$.ajax({
				type : "POST",
				url : "bank_soal/load?act=search&id=" + id + "&ujian_id=" + localStorage.getItem("ujian_id"),
				data : $(this).serialize(),
				success : function(data){
					$("#displaydata").html(data);
				}
			})
		});
		
		$(".select-ujian-form").on("change", function(){
			var id = $(this).val();
			alert("click");
			$.ajax({
				type : "POST",
				url : "bank_soal/load?&act=load&idUjian=" + id,
				data : $(this).serialize(),
				success : function(data){
					$("#displaydata").html(data);
					localStorage.setItem("ujian_id", id);
				}
			})
		});
	});
	function selectUjian(){
		alert("Selamat Datang....");
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
	function loadDataAgain(){
		$.ajax({
			type : "POST",
			url : "bank_soal/load?&act=load&idUjian=" + localStorage.getItem("ujian_id"),
			data : $(this).serialize(),
			success : function(data){
				$("#displaydata").html(data);
			}
		})
	}
  var roxyFileman = 'assets/admin/bower_components/ckeditor/plugins/fileman/index.html';
    $(function () {
        CKEDITOR.replace('soal', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload'});
    });
	$(function () {
        CKEDITOR.replace('a', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload'});
    });
	$(function () {
        CKEDITOR.replace('b', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload'});
    });
	$(function () {
        CKEDITOR.replace('c', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload'});
    });
	$(function () {
        CKEDITOR.replace('d', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload'});
    });
	$(function () {
        CKEDITOR.replace('e', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload'});
    });
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Bank Soal
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
					<div class="modal-dialog" style="width: 70%; margin: auto;">
					
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
									<div id='data-ujian-form'>load ujian id</div>
									<select class="form-control" name="jawaban_soal" id="jawaban_soal">
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
					
					
					
					