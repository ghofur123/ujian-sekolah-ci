<script>
	$(document).ready(function(){
		$(".view-class-koreksi").on("click", function(){
			// console.log("nisn=" + $(this).attr("id") + "&nik=" + $(this).attr("value") + "&id_ujian=" + $(this).attr("data"));
			// alert("okkk");
			$.ajax({
				type : "POST",
				url : "penilayan/view_jawaban_essay?pg=1&nisn=" + $(this).attr("id") + "&nik=" + $(this).attr("value") + "&id_ujian=" + $(this).attr("data"),
				data : $(this).serialize(),
				beforeSend: function() {
					$(".class-loading-cube").show();
				},
				success : function(data){
					$(".data-jawaban-essay").html(data);
				}
			}).done(function(){
				$(".class-loading-cube").hide("5000");
			});
		});
	});
</script>
<table class="table">
	<thead>
		<tr>
			<th>No</th><th>nama_siswa</th><th>nisn</th><th>nik</th>
			<th>action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=0;
		foreach($tampilData as $item){ 
		$no++;
		?>
		<tr>
			<td><?php echo $no; ?></td>
			<td>
				<?php echo "$item[nama_siswa]"; ?>
			</td>
			<td>
				<?php echo "$item[nisn]"; ?>
			</td>
			<td>
				<?php echo "$item[nik]"; ?>
			</td>
			<td>
				<button type="button" class="btn btn-success view-class-koreksi" id="<?php echo "$item[nisn]"; ?>" value='<?php echo "$item[nik]"; ?>' data='<?php echo "$item[id_ujian]"; ?>' data-toggle="modal" data-target="#myModal">Koreksi</button>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<div class="modal fade" id="myModal" role="dialog" style="overflow:scroll;">
	<div class="modal-dialog" style='width:80%;'>
	
		<div class="modal-content">
			<div class="modal-body">
				<div class='data-jawaban-essay'></div>
			</div>
		</div>
	</div>
</div>