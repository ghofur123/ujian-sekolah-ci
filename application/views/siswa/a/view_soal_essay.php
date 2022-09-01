<script>
	var roxyFileman = 'assets/admin/bower_components/ckeditor/plugins/fileman/index.html';
    $(function () {
        CKEDITOR.replace('jawaban', {filebrowserBrowseUrl: roxyFileman,
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload'});
    });
</script>
<?php
foreach($tampil as $item){
	echo "
		<input type='hidden' class='mode-form-soal' value='2' hidden>
		<input type='hidden' name='nisn' id='nisn' value='$_SESSION[nisn]' hidden>
		<input type='hidden' name='nik' id='nik' value='$_SESSION[nik]' hidden>
		<input type='hidden' name='token' id='token' value='$_SESSION[token]' hidden>
		<input type='hidden' name='no_soal' id='no_soal' class='no_soal' value='$item[id_bank_soal_essay]' hidden>
		$item[soal] <hr />
		<textarea name='jawaban' id='jawaban'>$item[jawaban]</textarea>
		<button type='submit' class='btn btn-primary btn-submit'>simpan</button>
	";
}
?>