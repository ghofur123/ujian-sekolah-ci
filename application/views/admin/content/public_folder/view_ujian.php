<script type="text/javascript">
$(document).ready(function(){
	$("#select-ujian-form").on("change", function(){
		alert("okff");
	});
});
</script>
<?php 
echo "<select class='form-control select-ujian-form' id='select-ujian-form' style='width:60%;'>"; 
echo "<option value=''>Pilih ujian</option>";
foreach($tampilData as $item){
	echo "
		<option value='"; echo $item["id_ujian"]; echo "'>"; echo $item["nama_ujian"]; echo "</option>
	"; 
}
echo "</select>";
?>