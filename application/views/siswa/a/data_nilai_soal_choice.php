
<?php
$no=0;
	echo "<table class='table'>";
	echo "
		<th>Nilai Pilihan</th>
		<th>Nilai Keseluruhan</th>
		";
	foreach($nilai_array as $item){
		$no++;

		echo "<tr>
				<td>";
				if($item["jumlah_soal_ujian"] == $item["jumlah_jawab"]){
					if($item["persentase"] == "100"){
						?>
						<script>
							$(document).ready(function(){
								$(".box-number-soal-pilihan-ganda").hide();
								$(".soal-pilihan-class").hide();
							});
						</script>
						<?php
						echo $item["nilai_asli"];
					} else {
						foreach($jumlah_jawab_essay as $item2){
							if($item2["jumlah_jawab"] == $item2["jumlah_soal"]){
								echo $item["nilai_persen"];
								?>
								<script>
									$(document).ready(function(){
										$(".box-number-soal-pilihan-ganda").hide();
										$(".soal-pilihan-class").hide();
									});
								</script>
								<?php
							} else {
								echo "soal essay untuk di selesaikan terlebih dahulu";
							}
						}
					}
					
				} else { ?>
					<script>
						$(document).ready(function(){
							$(".box-number-soal-pilihan-ganda").show();
							$(".soal-pilihan-class").show();
						});
					</script>
				<?php 
					echo "Anda Belum menyelesaikan Ujian";
				}
				echo "</td>
				<td></td>
			</tr>
			</table>";
	}
?>
