<script type="text/javascript">
	$(document).ready(function(){
		$(".select-kelas-form").on("change", function(){
			var id = $(this).val();
			localStorage.setItem("kelas_id", id);
			$.ajax({
				type : "POST",
				url : "bank_soal/load?&act=view_ujian&kelasId=" + id,
				data : $(this).serialize(),
				success : function(data){
					$("#data-ujian").html(data);
				}
			})
		});
	});
</script>
<?php
echo "<select class='form-control select-kelas-form' name='kelas_id' style='width:60%;'>"; 
echo "<option value=''>Pilih Kelas</option>";
foreach($tampilData as $item){
	echo "
		<option value='"; echo $item["id_kelas"]; echo "'>"; echo $item["nama_kelas"]; echo "</option>
	"; 
}
echo "</select>";
?>