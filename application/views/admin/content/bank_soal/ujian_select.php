<script type="text/javascript">
	$(document).ready(function(){
		$(".select-ujian-form").on("change", function(){
			var id = $(this).val();
			//alert("click");
			localStorage.getItem("ujian_id", id);
			$.ajax({
				type : "POST",
				url : "bank_soal/load?&act=load&idUjian=" + id,
				data : $(this).serialize(),
				beforeSend: function() {
					 $(".class-loading-cube").show();
				 },
				success : function(data){
					$("#displaydata").html(data);
					localStorage.setItem("ujian_id", id);
				},
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
	});
</script>
<?php
echo "<select class='form-control select-ujian-form' name='kelas_id' style='width:60%;'>"; 
echo "<option value=''>Pilih ujian</option>";
foreach($tampilData as $item){
	echo "
		<option value='"; echo $item["id_ujian"]; echo "'>"; echo $item["nama_ujian"]; echo "</option>
	"; 
}
echo "</select>";
?>