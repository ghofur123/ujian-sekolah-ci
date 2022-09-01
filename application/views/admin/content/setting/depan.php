<style>
	.form-control {width:15%;float:left;}
</style>
<script>
	$(document).ready(function(){
		$(".select-class").on("change",function(){
			var value = $(this).val();
			var id = $(this).attr("id");
			if(value == "VARCHAR"){
				$("#length-" + id).css("display", "block");
			} else {
				$("#length-" + id).css("display", "none");
			}
			
		});
		$(".type-form-class").on("change",function(){
			var value = $(this).val();
			var id = $(this).attr("id");
			if(value == "select"){
				$("#select-type-action-class-" + id).css("display", "block");
				$("#file-folder-" + id).css("display", "none");
			} 
			else if(value == "file"){
				$("#file-folder-" + id).css("display", "block");
				$("#select-type-action-class-" + id).css("display", "none");
			}
			else {
				$("#select-type-action-class-" + id).css("display", "none");
			}
		});
		$(".select-type-action-class").on("change",function(){
			var value = $(this).val();
			var id = $(this).attr("id");
		});
	});
</script>
  <div class="content-wrapper"> 
 <!-- Main content -->
    <section class="content">
	<div class="panel panel-default">
		<div class="panel-body">
			<form action='setting/set?pR=1' method='POST'>
			<input type="text" name='for' class="form-control" id="" style='float:none;' placeholder='Jumlah field'>
			<button type='submit' class="btn btn-success">submit</button>
			</form>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">	
			<form role="form" action='../setting/set?pR=2' method='POST'>
				<div class="form-group">
					<input type='text' name='dbName' class="form-control" value='' placeholder='Nama Database' required>nanti pada pengambilan id akan di beri nama id_namadatabase yang di input<br />
					<input type='hidden' name='jumlah' value='<?php echo $postAction; ?>' hidden>
				</div>
				<?php for($i = 0; $i < $postAction; $i++){
				echo "
				<div class='form-group'>
					<input type='text' class='form-control select-class' name='$i' placeholder='name field in database' required>
					<select class='form-control select-class' name='type-$i' id='$i' required>
						<option value=''>type in database</option>
						<option value='INT'>INT</option>
						<option value='VARCHAR'>VARCHAR</option>
						<option value='TEXT'>TEXT</option>
						<option value='LONGTEXT'>LONGTEXT</option>
						<option value='TIMESTAMP'>TIMESTAMP</option>
						<option value='DATE'>DATE</option>
					</select>
					<input type='text' class='form-control length-class' id='length-$i' name='length-$i' placeholder='length / panjang field' style='display:none;'>
					<select class='form-control type-form-class' name='type-form-$i' id='$i' required>
						<option value=''>type form</option>
						<option value='text'>text</option>
						<option value='textarea'>textarea</option>
						<option value='file'>file</option>
						<option value='select'>select</option>
						<option value='radio'>radio</option>
						<option value='checkbox'>checkbox</option>
						<option value='hidden'>hidden</option>
						<option value='readonly'>readonly</option>
					</select>
					<input type='text' class='form-control file-folder-class' id='file-folder-$i' name='file-folder-$i' placeholder='nama folder menyimpan file/foto/video/dll' style='display:none;'>
					<select class='form-control select-type-action-class' name='type-action-$i' id='select-type-action-class-$i'  style='display:none;'>
						<option value=''>type action</option>
						<option value='db-table'>select table in database</option>
						<option value='manualy'>input manualy</option>
					</select>
				</div>
				<div style='clear:both;'></div>
				";} ?>
				<button type="submit" class="btn btn-primary">submit<?php echo $jumlah; ?></button>
			</form>
		</div>
	</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->