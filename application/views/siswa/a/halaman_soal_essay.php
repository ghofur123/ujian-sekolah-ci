<script type="text/javascript">
	ajaxloadNumberSoalEssay();
	alertMess();
	$(document).ready(function(){
		$(".nomer-soal-essay").on("click", function(){
			var id = $(this).attr("value");
			var locid = localStorage.setItem("id_soal", id);
			$.ajax({
				type : "POST",
				url : "halaman_soal_siswa/load_soal_essay?pg=1&nisn=" + <?php echo $_SESSION['nisn'];?> + "&nik=" + <?php echo $_SESSION['nik']; ?> +"&token=" + <?php echo $_SESSION["token"]; ?> + "&id_bank_soal_essay=" + id,
				data : $(this).serialize(),
				success : function(data){
					$(".view-soal-essay").html(data);
				}
			})
		});
		$("#formsoalessay").submit(function(){
			var jawaban = CKEDITOR.instances.jawaban.getData();
			for(instance in CKEDITOR.instances){
				CKEDITOR.instances[instance].updateElement();
			}
			console.log($(this).serialize());
			$.ajax({
				type : "POST",
				url : "halaman_soal_siswa/jawaban_siswa_essay",
				data : $(this).serialize(),
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					loadSoalStorageEssay();
					$(".message-errors").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
			return false;
		});
	});
	function ajaxloadNumberSoalEssay(){
		//jangan lupa url nya di ganti sesuai dengan link nya
		$.ajax({
			type : "POST",
			url : "halaman_soal_siswa/load_number_soal_essay?pg=1&token=" + <?php echo $_SESSION["token"]; ?> + "&jumlah_ujian=" + <?php echo $_SESSION["jumlah_ujian"]; ?>,
			data : $(this).serialize(),
			success : function(data){
				$(".load-number-soal-essay").html(data);
			}
		})
	}
	function alertMess(){
		alert("click");
	}
	function loadSoalStorageEssay(){
		$.ajax({
			type : "POST",
			url : "halaman_soal_siswa/load_soal_essay?pg=1&nisn=" + <?php echo $_SESSION['nisn'];?> + "&nik=" + <?php echo $_SESSION['nik']; ?> +"&token=" + <?php echo $_SESSION["token"]; ?> + "&id_bank_soal_essay=" + localStorage.getItem("id_soal"),
			data : $(this).serialize(),
			success : function(data){
				$(".view-soal-essay").html(data);
			}
		})
	}
</script>
<div class="content-wrapper">
	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-body">
				<div class="btn-group">
					<div class='load-number-soal-essay'></div>
				</div>
			</div>
		</div>
		<div class="box soal-essay-class">
			<div class="box-body">
				<div class='message-errors'></div>
				<form action='#' method='POST' name='formsoalessay' id='formsoalessay'>
					<div class='view-soal-essay'>silahkan klik nomer soal di atas</div>
					
				</form>
			</div>
		</div>
	</section>
</div>
					
					


