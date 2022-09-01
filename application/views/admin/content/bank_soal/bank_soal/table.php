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
				url : "bank_soal/load?act=delete&id=" + id,
				data : $(this).serialize(),
				success : function(data){
					loadDataAgain();
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
				url : "bank_soal/load?act=view&id=" + id,
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
				url : "bank_soal/load?act=viewEdit&id=" + id,
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
			<th>soal</th><th>a</th><th>b</th><th>c</th><th>d</th><th>e</th>
			<th>action</th>
		  </tr>
		</thead>
		<tbody>
			<?php foreach($tampilData as $item){ ?>
			<tr>
				<td>
				<?php echo "$item[soal]"; ?>
				</td>
				<td>
				<?php echo "$item[a]"; ?>
				</td>
				<td>
				<?php echo "$item[b]"; ?>
				</td>
				<td>
				<?php echo "$item[c]"; ?>
				</td>
				<td>
				<?php echo "$item[d]"; ?>
				</td>
				<td>
				<?php echo "$item[e]"; ?>
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
		