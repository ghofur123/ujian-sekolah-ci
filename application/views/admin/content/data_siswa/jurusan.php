<script>
	$(document).ready(function(){
		$(".select-jurusan-form").on("change", function(){
			var idJurusan = $(this).val();
			$.ajax({
				type : "POST",
				url : "data_siswa/load?&act=load&kelasId=" + localStorage.getItem("id_kelas") + "&jurusanId=" + idJurusan,
				data : $(this).serialize(),
				beforeSend: function() {
					 $(".class-loading-cube").show();
				 },
				success : function(data){
					$(".displaydata").html(data);
					localStorage.setItem("jurusan_id", idJurusan);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
	});
</script>
<?php 
	echo "<select class='form-control select-jurusan-form' name='jurusan_id' style='width:60%;'>"; 
		echo "<option value=''>Pilih Jurusan</option>";
		foreach($tampilData as $item){
			echo "
				<option value='"; echo $item["id_jurusan"]; echo "'>"; echo $item["nama_jurusan"]; echo "</option>
			"; 
		}
	echo "</select>";
?>