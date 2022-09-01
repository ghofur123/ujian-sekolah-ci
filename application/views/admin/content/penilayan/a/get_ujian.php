<script>
	$(document).ready(function(){
		selectUjian();
	});
	function selectUjian(){
		$(".select-ujian-form-1").change(function(){
			var id_ujian = $(this).val();
			$.ajax({
				type : "POST",
				url : "penilayan/data_siswa_nilai?pg=1&id_ujian=" + id_ujian,
				data : $(this).serialize(),
				beforeSend: function() {
						$(".class-loading-cube").show();
					},
				success : function(data){
					$(".view-data-jawaban-essay").html(data);
				}
			}).done(function(){
					$(".class-loading-cube").hide("5000");
			});
		});
	}
</script>
<?php

	echo "<select class='form-control select-ujian-form-1'  style='width:60%;'>"; 
	echo "<option value=''>Pilih ujian</option>";
	foreach($tampilData as $item){
		echo "
			<option value='"; echo $item["id_ujian"]; echo "' title='"; echo $item["nama_ujian"]; echo "'>"; echo $item["nama_ujian"]; echo "</option>
		"; 
	}
	echo "</select>";

?>