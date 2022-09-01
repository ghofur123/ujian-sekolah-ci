<script>
$(function () {
	CKEDITOR.replace('soalaa', {filebrowserBrowseUrl: roxyFileman,
		filebrowserImageBrowseUrl: roxyFileman + '?type=image',
		removeDialogTabs: 'link:upload;image:upload', height: 50});
		
});
</script>
<?php
	foreach($tampilData as $item){
		echo "
			<input type='hidden' name='id' id='id' class='form-control' style='width:100%;' value='"; echo $item["id_bank_soal_essay"]; echo "' hidden>
			soal
			<textarea name='soal' id='soalaa' class='form-control' style='width:100%;'>"; echo $item["soal"]; echo "'</textarea>
			";
		echo "<select name='id_ujian' id='id_ujian' class='form-control'>";
		foreach($tampilDataUjian as $ujian){
			if($item["ujian_id"] == $ujian["id_ujian"]){
				echo "
					<option selected value='$ujian[id_ujian]' >$ujian[nama_ujian]</option>
				"; 
			} else {
				echo "
					<option value='$ujian[id_ujian]' >$ujian[nama_ujian]</option>
				"; 
			}
		}
		echo "</select>";
	}
	echo "</table>";
?>