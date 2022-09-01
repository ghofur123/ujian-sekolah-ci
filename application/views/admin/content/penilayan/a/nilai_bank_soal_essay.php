<script>
	
	dataSelectKelas();
	alr();
	selectUjian();
	var altt;
	$(document).ready(function(){
		$(".select-kelas-form").on("change", function(){
			var id = $(this).val();
			localStorage.setItem("id_kelas", id);
			$.ajax({
				type : "POST",
				url : "penilayan/ujian?pg=1&kelas_id=" + id,
				data : $(this).serialize(),
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					//alert("ok");
					$("#data-ujian").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
		
		
	});
	function dataSelectKelas(){
		$.ajax({
			type : "POST",
			url : "penilayan/kelas",
			data : $(this).serialize(),
			beforeSend: function() {
					$(".class-loading-cube").show();
				},
			success : function(data){
				$("#data-kelas").html(data);
			}
		}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
	}

	function alr(){
		alert("ok");
	}

</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Niali Essay
			<small>Penilayan siswa dari soal essay</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<div id='data-kelas'></div>
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
				<div class='view-data-jawaban-essay'>load data siswa....</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
					
					