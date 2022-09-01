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
				url : "ujian/load?act=delete&id=" + id,
				data : $(this).serialize(),
				success : function(data){
					ajaxload();
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
				url : "ujian/load?act=view&id=" + id,
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
				url : "ujian/load?act=viewEdit&id=" + id,
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
			<th>nama_ujian</th><th>kelas_id</th><th>token</th><th>guru_id</th><th>materi_id</th><th>jumlah_ujian</th>
			<th>action</th>
		  </tr>
		</thead>
		<tbody>
			<?php foreach($tampilData as $item){ ?>
			<tr>
				<td>
				<?php echo "$item[nama_ujian]"; ?>
				</td>
				<td>
				<?php echo "$item[kelas_id]"; ?>
				</td>
				<td>
				<?php echo "$item[token]"; ?>
				</td>
				<td>
				<?php echo "$item[guru_id]"; ?>
				</td>
				<td>
				<?php echo "$item[materi_id]"; ?>
				</td>
				<td>
				<?php echo "$item[jumlah_ujian]"; ?>
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
		