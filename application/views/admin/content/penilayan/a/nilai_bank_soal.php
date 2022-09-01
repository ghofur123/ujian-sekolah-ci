<script>
	dataSelectUjian();
	alertdt();
	$(document).ready(function(){
		$(".select-ujian-form").on("change", function(){
			var id = $(this).val();
			localStorage.setItem("ujian_id_print", id);
			$("#id_ujian").val(id);
			//alert(localStorage.getItem("ujian_id_print"));
			$.ajax({
				type : "POST",
				url : "penilayan/nilai_multiple?pg=1&id_ujian=" + id,
				data : $(this).serialize(),
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					$(".view-data-siswa").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
			
		});
		$("#formSave").submit(function(){
			//alert($("#status_ori").val());
			$.ajax({
				type : "POST",
				url : "save_nilai/load?act=insert",
				data : $(this).serialize(),
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					$(".message-errors-save").html(data);
					$("#keterangan").val("");
					loadAutoMatic();
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
			return false;
		});
	});
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
	function alertdt(){
		alert("click");
	}
	function loadAutoMatic(){
		$.ajax({
			type : "POST",
			url : "penilayan/nilai_multiple?pg=1&id_ujian=" + localStorage.getItem("ujian_id_print"),
			data : $(this).serialize(),
			beforeSend: function() {
				$(".class-loading-cube").show();
			},
			success : function(data){
				$(".view-data-siswa").html(data);
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
			Penilayan
			<small>Penilayan siswa dari soal multiple coice</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<!--<div class="callout callout-info">
			<h4>Keterangan</h4>

			<p>1. nama_siswa</p>
			<p>2. nisn</p>
			<p>3. nik</p>
			<p>4. jumlah_ujian adalah jumlah soal yang di ujikan ke siswa</p>
			<p>5. jumlah_jawab adalah jumlah siswa telah menjawab</p>
			<p>6. salah adalah jawaban siswa yang salah</p>
			<p>7. benar adalah jumlah jawaban benar siswa</p>
			<p>8. nilai_murni adalah nilai yang belum di persentasekan contoh benar 10 maka = 10 X 100 / 100</p>
			<p>8. nilai_persentase adalah nilai yang belum di persentasekan contoh persentase pilihan ganda 60 dan essay 40 maka nilai murni X 60 / 100</p>
		</div>
		-->
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<div id='data-ujian'>Proses load data ujian....</div>
				<button class='btn btn-succes class-print' title='print' type='button' onclick="printJS('id-nilai-siswa-all', 'html')">print</button>
				<button class='btn btn-danger ' type='button' data-toggle="modal" data-target="#myModal">Save</button>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="box-body" id='id-nilai-siswa-all'>
				<div class='view-data-siswa'></div>
			</div>
			<div class="modal fade" id="myModal" role="dialog" style="overflow:scroll;">
					<div class="modal-dialog">
					
						<div class="modal-content">
							<form  method="POST" action="#" id="formSave" name="form1" >
								<div class="message-errors-save"></div>
								<div class="modal-body">
									jika belum muncul anda harus pilih ujian terlebih dahulu
									<input type='hidden' name='id_ujian' class='form-control' id='id_ujian' >
									<input type='text' name='' class='form-control' id='id_ujian' readonly>
									<select class="form-control" name="keterangan">
										<option value=''>--pilih keterangan--</option>
										<option value='1'>Tengah Semester Ganjil</option>
										<option value='2'>------Remedi (Tengah Semester Ganjil)------</option>
										<option value='3'>Semester Ganjil</option>
										<option value='4'>------Remedi (Semester Ganjil)------</option>
										<option value='5'>Tengah Semester Genap</option>
										<option value='6'>------Remedi (Tengah Semester Genap)------</option>
										<option value='7'>Semester Genap</option>
										<option value='8'>------Remedi (Semester Genap)-------</option>
										<option value='9'>UAS</option>
										<option value='10'>-----Remedi (UAS)----</option>
									</select>
									<input type='checkbox' checked name='status_ori' id='status_ori' value='1'>Hapus Original
									<span style='color:red'>perhatian! jika tidak ingin menghapus jawaban siswa original maka hilangkan cekbox nya</span>
								</div>
								
								<div class="modal-footer" style="background:#99bbff; margin-top:20px; border-radius:0px 0px 5px 5px;">
									<button type="submit" class="btn btn-primary btn-submit-class" >save</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			<!-- /.box-body -->
			<div class="box-footer">
				
			</div>
			<!-- /.box-footer-->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
					
					