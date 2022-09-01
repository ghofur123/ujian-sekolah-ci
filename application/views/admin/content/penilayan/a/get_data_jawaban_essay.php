<script>
	$(document).ready(function(){
		$(".class-select-nilai").on("change", function(){
			var nilai = $(this).val();
			<?php
				foreach($tampilData as $item3);
			?>
			var nnt = "<?php echo "&nisn=".$item3["nisn"]."&nik=".$item3["nik"]."&token=".$item3["token"]."&no_soal=".$item3["no_soal"]."&nilai="; ?>" + nilai;
			console.log(nnt);
			$.ajax({
				type : "POST",
				url : "penilayan/save_nilai_siswa_essay?pg=1" + nnt,
				data : $(this).serialize(),
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					$(".message-errors").html(data);
					$(".class-message-div").show("3000");
				},
				complete : setTimeout(function(){
					$(".class-message-div").hide("3000")
				},3000)
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
	});
</script>
<table class="table">
	<thead>
		<tr>
			<th>No</th> 
			<th>soal & jawaban</th>
			<th>nilai tersimpan</th>
			<th>nilai</th>
		</tr>
	</thead>
	<tbody>
		<form action='#' method='POST' name='form22' id='form22'>
			<?php 
			$no=0;
			foreach($tampilData as $item){ 
			$no++;
			?>
			<tr>
				
				<td><?php echo $no; ?></td>
				<td>
					<?php echo "$item[soal]"; ?>
					<span style='color:blue;'><?php echo "$item[jawaban]"; ?></span>
				</td>
				<td>
					<?php
						if($item["status_nilai"] == 1){
							echo "
								<span style='color:red;'>$item[nilai]</span>
							";
						}else {
							echo "
								<span style='color:red;'>Belum Dinilai</span>
							";
						}
					?>
					
				</td>
				<td>
					<select name='nilai' class='form-control class-select-nilai'>
					<?php
					foreach($tampilData2 as $item2){
						for($jum=0; $jum <= $item2["nilai_persoal"]; $jum++){
							echo "<option value='$jum'>$jum</option>";
						}
					}
					?>
					</select>
				</td>				
			</tr>
			<?php } ?>
		</form>
	</tbody>
</table>
