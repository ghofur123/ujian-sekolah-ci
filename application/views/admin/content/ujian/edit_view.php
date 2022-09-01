<script type="text/javascript">
	$(document).ready(function(){
		
	}
</script>
<?php
echo "<table class='table'>"; 
	foreach($tampilData as $item){
		echo "
			<tr>
				<input type='hidden' name='id' class='form-control' style='width:100%;' value='"; echo $item["id_ujian"]; echo "' hidden>
			
				<td>nama ujian</td>
				<td>
				
						<input type='text' name='nama_ujian' class='form-control' style='width:100%;' value='"; echo $item["nama_ujian"]; echo "' >
					
				</td>
			</tr>
			
				<td>kelas</td>
				<td>
				
						<input type='text' name='kelas_id' class='form-control' style='width:100%;' value='"; echo $item["kelas_id"]; echo "' >
					
				</td>
			</tr>
			
				<td>token</td>
				<td>
				
						<input type='text' name='token' class='form-control' style='width:100%;' value='"; echo $item["token"]; echo "' >
					
				</td>
			</tr>
			
				<td>guru_id</td>
				<td>
				
						<input type='text' name='guru_id' class='form-control' style='width:100%;' value='"; echo $item["guru_id"]; echo "' >
					
				</td>
			</tr>
			
				<td>materi_id</td>
				<td>
				
						<input type='text' name='materi_id' class='form-control' style='width:100%;' value='"; echo $item["materi_id"]; echo "' >
					
				</td>
			</tr>
			
				<td>jumlah_ujian</td>
				<td>
				
						<input type='text' name='jumlah_ujian' class='form-control' style='width:100%;' value='"; echo $item["jumlah_ujian"]; echo "' >
					
				</td>
			</tr>
			
				<td>persen_multiple_coice</td>
				<td>
				
						<input type='text' name='persen_multiple_coice' class='form-control' style='width:100%;' value='"; echo $item["persen_multiple_coice"]; echo "' >
					
				</td>
			</tr>
			
				<td>persen_essay</td>
				<td>
				
						<input type='text' name='persen_essay' class='form-control' style='width:100%;' value='"; echo $item["persen_essay"]; echo "' >
					
				</td>
			</tr>
			
		"; 
	}
	echo "</table>";