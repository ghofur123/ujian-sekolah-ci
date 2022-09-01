<script type="text/javascript">
$(document).ready(function(){
	$(".delete-class").click(function(){
		var element = $(this);
		var id = element.attr("id");
		if(confirm("Yakin Mau Di Hapus")){
			//ajax proses delete
			//jangan lupa url nya di ganti sesuai dengan link nya
			$.ajax({
				type : "POST",
				url : "data_siswa/load?act=delete&id=" + id,
				data : $(this).serialize(),
				success : function(data){
					load_siswa_storage();
				}
			})
		}
	});
	$(".view-class").click(function(){
		var element = $(this);
		var id = element.attr("id");
		//jangan lupa url nya di ganti sesuai dengan link nya
		$.ajax({
				type : "POST",
				url : "data_siswa/load?act=view&id=" + id,
				data : $(this).serialize(),
				success : function(data){
					$("#form").hide();
					$(".view-class-modal").show();
					$(".btn-view-close").show();
					$(".btn-view-edit").hide();
					$(".message-errors2").hide();
					$(".table-view-class").html(data);
				}
			})
	});
	$(".edit-class").click(function(){
		var element = $(this);
		var id = element.attr("id");
		//jangan lupa url nya di ganti sesuai dengan link nya
		$.ajax({
				type : "POST",
				url : "data_siswa/load?act=viewEdit&id=" + id,
				data : $(this).serialize(),
				success : function(data){
					$("#form").hide();
					$(".view-class-modal").show();
					$(".btn-view-close").hide();
					$(".btn-view-edit").show();
					$(".message-errors2").show();
					$(".table-view-class").html(data);
				}
			})
	});
});
</script>
	<table class="table">
		<thead>
		  <tr>
			<th>No</th><th>nama_siswa</th><th>nisn</th><th>nik</th><th>kelas_id</th>
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
				<?php echo "$item[nama_kelas]"; ?>
				</td>
				<td>
					<button type="button" class="btn btn-success view-class" id="<?php echo $item["$idDb"]; ?>" data-toggle="modal" data-target="#myModal">View</button>
					<button type="button" class="btn btn-primary edit-class" id="<?php echo $item["$idDb"]; ?>" data-toggle="modal" data-target="#myModal">Edit</button>
					<button type="button" class="btn btn-danger delete-class" id="<?php echo $item["$idDb"]; ?>">Delete</button>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	  </table>
		