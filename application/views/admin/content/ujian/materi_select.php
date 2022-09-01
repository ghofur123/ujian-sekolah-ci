<script type="text/javascript">
	$(document).ready(function(){
		$(".select-materi-form").on("change", function(){
			var id = $(this).val();
			//alert(id);
			$.ajax({
				type : "POST",
				url : "ujian/load?act=load&materiId=" + id,
				data : $(this).serialize(),
				beforeSend: function() {
					 $(".class-loading-cube").show();
				 },
				success : function(data){
					$("#displaydata").html(data);
					dataSelectJenisUjian();
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
	});
</script>
<?php
echo "<select class='form-control select-materi-form' name='kelas_id' style='width:60%;'>"; 
echo "<option value=''>Pilih Materi</option>";
foreach($tampilData as $item){
	echo "
		<option value='"; echo $item["id_materi"]; echo "'>"; echo $item["nama_materi"]; echo "</option>
	"; 
}
echo "</select>";
?>