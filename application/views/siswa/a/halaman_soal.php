<script type="text/javascript">
	alertMess();
	ajaxloadNilai();
	
	$(document).ready(function(){
		loadNumberSoal();
		// $(".btn-class-load-number").on("click", function(){
		// 	$.ajax({
		// 		type : "POST",
		// 		url : "halaman_soal_siswa/load_number_soal?pg=1",
		// 		data : $(this).serialize(),
		// 		beforeSend: function() {
		// 			$(".class-loading-cube").show();
		// 		},
		// 		success : function(data){
		// 			$(".load-number-soal-pilihan-ganda").html(data);
		// 		}
		// 	}).done(function(){
		// 		$(".class-loading-cube").hide("5000");
		// 	});
		// });
		$(".btn-class-load-nilai").on("click", function(){
			$.ajax({
				type : "POST",
				url : "halaman_soal_siswa/nilai_keseluruhan?pg=1",
				data : $(this).serialize(),
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					$(".load-nilai-all").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
		$("#form123").submit(function(){
			$.ajax({
				type : "POST",
				url : "halaman_soal_siswa/jawaban_siswa",
				data : $(this).serialize(),
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					loadSoalStorageMultipelCoice();
					ajaxloadNilai();
					loadNumberSoal();
					// console.log(data11);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
			return false;
			
		});
		

	});
	$(document).on("click", ".nomer-soal-pilihan-ganda", function(){
		
		var id = $(this).attr("value");
		console.log(id);
		var locid = localStorage.setItem("id_soal_pilihan", id);
		$.ajax({
			type : "POST",
			url : "halaman_soal_siswa/load_soal?pg=1&id_bank_soal=" + id,
			data : $(this).serialize(),
			beforeSend: function() {
				$(".class-loading-cube").show();
			},
			success : function(data){
				$(".view-soal").html(data);
			}
		}).done(function(){
			$(".class-loading-cube").hide("5000");
		});
	});
	function loadNumberSoal(){
		$.ajax({
			type : "POST",
			url : "halaman_soal_siswa/load_number_soal?pg=1",
			data : $(this).serialize(),
			beforeSend: function() {
				$(".class-loading-cube").show();
			},
			success : function(data){
				$(".load-number-soal-pilihan-ganda").html(data);
			}
		}).done(function(){
			$(".class-loading-cube").hide("5000");
		});
	}
	function alertMess(){
		alert("ok");
	}
	function loadSoalStorageMultipelCoice(){
		$.ajax({
			type : "POST",
			url : "halaman_soal_siswa/load_soal?pg=1&id_bank_soal=" + localStorage.getItem("id_soal_pilihan"),
			data : $(this).serialize(),
			success : function(data){
				$(".view-soal").html(data);
			}
		})
	}
	function ajaxloadNilai(){
		$.ajax({
			type : "POST",
			url : "halaman_soal_siswa/nilai_compile?pg=1",
			data : $(this).serialize(),
			success : function(data){
				$("#nilai-keseluruhan").html(data);
			}
		})
	}
	
</script>
<style>
	.btn-class-load-number {
		width : 60px;
		height: 60px;
		position: fixed;
		right:10px;
		margin-top: 20%;
		z-index: 1;
		border-radius:50%;
	}
	.btn-class-load-nilai {
		width : 60px;
		height: 60px;
		position: fixed;
		right:10px;
		margin-top: 35%;
		z-index: 1;
		border-radius:50%;
	}
	.btn-waktu {
		width : 100px;
		height: 100px;
		position: fixed;
		right:10px;
		margin-top: 30%;
		z-index: 1;
		border-radius:50%;
	}
</style>
<br><br><br>
<div class="content-wrapper" style="min-height: 561px; overflow: scroll;">
	<section class="content">
		<!-- <button type="button" class="btn btn-info new-data-class btn-class-load-number" data-toggle="modal" data-target="#myModal">Nomer</button> -->
		<button type="button" class="btn btn-info new-data-class btn-class-load-nilai" data-toggle="modal" data-target="#myModal2">Nilai</button>
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Nilai</h3>
				
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
				<div class="load-number-soal-pilihan-ganda"></div>
				<div id="nilai-keseluruhan">
					
			</div>
			<div id="waktu-ujian"></div>
			<!-- /.box-body -->
			<!-- /.box-footer-->
		</div>
		
		<div class="modal fade" id="myModal" role="dialog" style="overflow:scroll;">
			<div class="modal-dialog">
			
				<div class="modal-content">
					<div class="modal-body">

						<div class="load-number-soal-pilihan-ganda"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="myModal2" role="dialog" style="overflow:scroll;">
			<div class="modal-dialog">
			
				<div class="modal-content">
					<div class="modal-body">
						<div class="load-nilai-all"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="box soal-pilihan-class">
			<div class="box-body">
				<form action="#" method="POST" name="form123" id="form123">
					<div class="view-soal"></div>
					
				</form>
              </div>
		</div>
	</section>
</div>