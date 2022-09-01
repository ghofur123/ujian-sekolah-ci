<script type="text/javascript">
	$(document).ready(function(){
		loadSoal();
		sentJawaban();
		loadNilai();
	});
	function loadSoal(){
		$.ajax({
			type : "POST",
			url : "halaman_soal_siswa_b/load_soal?pg=1",
			data : $(this).serialize(),
			success : function(data){
				$(".view-soal").html(data);
				loadNilai();
			}
		})
	}
	function loadNilai(){
		$.ajax({
			type : "POST",
			url : "halaman_soal_siswa_b/nilai_siswa_b?pg=1",
			data : $(this).serialize(),
			success : function(data){
				$(".nilai").html(data);
			}
		})
	}
	function sentJawaban(){
		$("#formSendJawaban").submit(function(){
			//alert($(this).serialize());
			$.ajax({
				type : "POST",
				url : "halaman_soal_siswa_b/insert_jawaban?pg=1",
				data : $(this).serialize(),
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					loadSoal();
					//alert(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
			return false;
		});
	}
	function clearLocalStorage(){
		window.localStorage.clear();
	}
	if(localStorage.getItem("saveWaktu") == null || localStorage.getItem("saveWaktu") == 1){
		var time = <?php echo $_SESSION["waktu"] * 60;?>
	} else {
		var time = localStorage.getItem("saveWaktu");
	}
		
	function waktuUjian(){
		if(time > 0){
			time--;
			menit = time / 60;
			var waktu = time + 1;
			
			localStorage.setItem("saveWaktu", waktu);
			var lo = localStorage.getItem("saveWaktu");
			$("#waktu-ujian").html("Sisa Waktu Ujian " + menit.toFixed(0) + " Menit ");
			setTimeout("waktuUjian()", 1000);
		}else {
			$("#waktu-ujian").html("Waktu Habis");
			$(".view-soal").hide();
			$(".waktu-habis").html("Anda Sudah Melewati Batas Waktu");
		}
	}
	waktuUjian();
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
		margin-top: 25%;
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
	.content-wrapper {
		margin-top: 100px;
	}
</style>
<div class="content-wrapper" style="min-height: 561px;">
	<section class="content">
		<div class="box">
			<div class="box-body">
				<div id="nilai-keseluruhan">
					<table class="table">
						<tbody>
						<tr>
							<th>Nilai</th>
							<th>Waktu</th>
						</tr>
						<tr>
							<td>
								<div class="nilai">Belum Mengerjakan</div>
							</td>
							<td><div id='waktu-ujian'></div></td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.box-body -->
			<!-- /.box-footer-->
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
				<form action="#" method="POST" name="form123" id="formSendJawaban">
					<div class="view-soal">silahkan klik nomer di sebelah kanan</div>
					<div class="waktu-habis"></div>
				</form>
              </div>
		</div>
	</section>
</div>