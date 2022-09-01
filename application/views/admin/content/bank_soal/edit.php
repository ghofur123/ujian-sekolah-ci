<script>
var roxyFileman = 'assets/admin/bower_components/ckeditor/plugins/fileman/index.html';
    $(function () {
        CKEDITOR.replace('soala', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload', height: 50});
    });
	$(function () {
        CKEDITOR.replace('aa', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload', height: 50});
    });
	$(function () {
        CKEDITOR.replace('ba', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload', height: 50});
    });
	$(function () {
        CKEDITOR.replace('ca', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload', height: 50});
    });
	$(function () {
        CKEDITOR.replace('da', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload', height: 50});
    });
	$(function () {
        CKEDITOR.replace('ea', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload', height: 50});
    });
</script>
<?php 
	echo "<table class='table'>"; 
	foreach($tampilData as $item){
		echo "
			<tr>
				<input type='hidden' name='id' id='id' class='form-control' style='width:100%;' value='"; echo $item["id_bank_soal"]; echo "' hidden>
			
				<td>soal</td>
				<td>
				
						<textarea name='soal' id='soala' value='' >"; echo $item["soal"]; echo "</textarea>
					
				</td>
			</tr>
			
				<td>a</td>
				<td>
				
						<textarea name='a' id='aa' value='' >"; echo $item["a"]; echo "</textarea>
					
				</td>
			</tr>
			
				<td>b</td>
				<td>
				
						<textarea name='b' id='ba' value='' >"; echo $item["b"]; echo "</textarea>
					
				</td>
			</tr>
			
				<td>c</td>
				<td>
				
						<textarea name='c' id='ca' value='' >"; echo $item["c"]; echo "</textarea>
					
				</td>
			</tr>
			
				<td>d</td>
				<td>
				
						<textarea name='d' id='da' value='' >"; echo $item["d"]; echo "</textarea>
					
				</td>
			</tr>
			
				<td>e</td>
				<td>
				
						<textarea name='e' id='ea'  value='' >"; echo $item["e"]; echo "</textarea>
					
				</td>
			</tr>
			
				<td>ujian_id</td>
				<td>
				"; 
				$ujian = $this->crud_function_model->readData("ujian", "", "", "nama_ujian ASC");
				echo "
					<select name='ujian_id' id='ujian_id' class='form-control ujian_id' style='width:100%;'>
					";
					foreach($ujian as $itemUjian){
						if($itemUjian["id_ujian"] == $item["ujian_id"]){
							echo "<option selected value='"; echo $itemUjian["id_ujian"]; echo "'>"; echo $itemUjian["nama_ujian"]; echo "</option>";
						} else {
							echo "<option value='"; echo $itemUjian["id_ujian"]; echo "'>"; echo $itemUjian["nama_ujian"]; echo "</option>";
						}
					}
					echo "
					</select>
				 ";
				echo "
				</td>
			</tr>
			
				<td>jawaban_soal</td>
				<td>
				";
				echo "
						<select name='jawaban_soal' id='jawaban_soal' class='form-control jawaban_soal' style='width:100%;'>
							";
							if($item["jawaban_soal"] == "a"){
								echo "<option selected value='a'>A</option>";
							} else {
								echo "<option value='a'>A</option>";
							}
							if($item["jawaban_soal"] == "b"){
								echo "<option selected value='b'>B</option>";
							} else {
								echo "<option value='b'>B</option>";
							}
							if($item["jawaban_soal"] == "c"){
								echo "<option selected value='c'>C</option>";
							} else {
								echo "<option value='c'>C</option>";
							}
							if($item["jawaban_soal"] == "D"){
								echo "<option selected value='d'>D</option>";
							} else {
								echo "<option value='d'>D</option>";
							}
							if($item["jawaban_soal"] == "e"){
								echo "<option selected value='e'>E</option>";
							} else {
								echo "<option value='e'>E</option>";
							}
							echo "
						</select>
					";
					echo "
				</td>
			</tr>
			
		"; 
	}
	echo "</table>";
?>