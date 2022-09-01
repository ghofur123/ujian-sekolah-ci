
<style>
	.nomer-soal-pilihan-ganda, .nomer-soal-essay {
		border-radius: 50%;
		width:50px;
		height:50px;
	}
	.span-button {
		color:#000;
	}
</style>
<nav aria-label='Page navigation example'>
    <ul class='pagination'>
		<?php

		$no=0;
		foreach($query as $item){
			$no++;
			if($item["status_jawaban"] == "1"){
				echo "
				<li class='page-item nomer-soal-pilihan-ganda' value='$item[id_bank_soal]'><a class='page-link' href='#'  >$no</a></li>
				";
			} else {
				echo "
				<li class='page-item active nomer-soal-pilihan-ganda' value='$item[id_bank_soal]'><a class='page-link' href='#'  >$no<span class='span-button'>$item[jawaban]</span></a></li>
				";
			}
		}
		?>
    </ul>
</nav>
