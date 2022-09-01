<style type='text/css'>
.jawaban-class {border:1px solid #000; width:20px;height:20px;}
</style>
<?php
foreach($query1 as $item){
	if($item["sinck_jumlah_ujian"] == "0"){
		echo "
			<input type='hidden' class='mode-form-soal' value='1' hidden>
			<input type='hidden' name='nisn' value='$_SESSION[nisn]' hidden>
			<input type='hidden' name='nik' value='$_SESSION[nik]' hidden>
			<input type='hidden' name='token' value='$_SESSION[token]' hidden>
			<input type='hidden' name='no_soal' class='no_soal' value='$item[id_bank_soal]' hidden>
			$item[soal] <hr />
			<input type='radio' name='jawaban' class='jawaban-class' id='jawaban' value='a' required> $item[a] <hr />
			<div></div>
			<input type='radio' name='jawaban' class='jawaban-class' id='jawaban' value='b' required> $item[b] <hr />
			<div></div>
			<input type='radio' name='jawaban' class='jawaban-class' id='jawaban' value='c' required> $item[c] <hr />
			<div></div>
			<input type='radio' name='jawaban' class='jawaban-class' id='jawaban' value='d' required> $item[d] <hr />
			<div></div>
			<input type='radio' name='jawaban' class='jawaban-class' id='jawaban' value='e' required> $item[e] <hr />
			<button type='submit' class='btn btn-primary btn-submit'>simpan</button>
		";
	} else {
		echo "Selesai";
	}

}
?>