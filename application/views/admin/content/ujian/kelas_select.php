<script type="text/javascript">
	$(document).ready(function(){
		$(".select-kelas-form").on("change", function(){
			var id = $(this).val();
			//alert(id);
			$.ajax({
				type : "POST",
				url : "ujian/load?act=load&kelasId=" + id,
				data : $(this).serialize(),
				beforeSend: function() {
					 $(".class-loading-cube").show();
				 },
				success : function(data){
					$("#displaydata").html(data);
					dataSelectMateri();
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
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