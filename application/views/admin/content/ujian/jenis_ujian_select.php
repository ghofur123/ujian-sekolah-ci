<script type="text/javascript">
	$(document).ready(function(){
		$(".select-jenis-ujian-form").on("change", function(){
			var id = $(this).val();
			//alert(id);
			$.ajax({
				type : "POST",
				url : "ujian/load?act=load&jenisUjianId=" + id,
				data : $(this).serialize(),
				beforeSend: function() {
					 $(".class-loading-cube").show();
				 },
				success : function(data){
					$("#displaydata").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
	});
</script>
<?php
echo "<select class='form-control select-jenis-ujian-form' name='jenis_ujian_id' style='width:60%;'>"; 
echo "<option value=''>Pilih jenis ujian</option>";
foreach($tampilData as $item){
	echo "
		<option value='"; echo $item["id_jenis_ujian"]; echo "'>"; echo $item["nama_jenis_ujian"]; echo "</option>
	"; 
}
echo "</select>";
?>