<?php
	echo "<select class='form-control select-kelas-form' style='width:60%;' name='kelas_id'>"; 
	echo "<option value=''>Pilih Kelas</option>";
	foreach($tampilData as $item){
		echo "
			<option value='"; echo $item["id_kelas"]; echo "'>"; echo $item["nama_kelas"]; echo "</option>
		"; 
	}
	echo "</select>";

?>
