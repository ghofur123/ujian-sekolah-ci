<script type="text/javascript">
$(document).ready(function(){
	$(".view-data-class").click(function(){
		var id = $(this).val();
		//alert(id);
		//jangan lupa url nya di ganti sesuai dengan link nya
		$.ajax({
			type : "POST",
			url : "save_nilai/load?act=viewDataNilai&id=" + id,
			data : $(this).serialize(),
			success : function(data){
				$("#displaydata123").html(data);
			}
		})
	});
});
</script>
	<table class="table">
		<thead>
		  <tr>
			<th>No</th>
			<th>Nama Ujian</th>
			<th>Materi</th>
			<th>Kelas</th>
			<th>Guru</th>
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
				<td>
				<?php echo $no; ?>
				</td>
				<td>
				<?php echo "$item[nama_ujian]"; ?>
				</td>
				<td>
				<?php echo "$item[nama_materi]"; ?>
				</td>
				<td>
				<?php echo "$item[nama_kelas]"; ?>
				</td>
				<td>
				<?php echo "$item[nama_guru]"; ?>
				</td>
				<td>
					<button type="button" class="btn btn-info view-data-class" id="view-data-id" data-toggle="modal" data-target="#myModal" value="<?php echo "$item[uniq]"; ?>">View</button>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	  </table>
<div class="modal fade" id="myModal" role="dialog" style="overflow:scroll;">
	<div class="modal-dialog">
	
		<div class="modal-content">
			<div id="displaydata123"></div>
		</div>

	</div>
</div>
		