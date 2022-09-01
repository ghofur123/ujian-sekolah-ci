<script type="text/javascript">
	$(document).ready(function(){
	});
	
</script>
<?php
	$dataexcel = Array();
	echo "<table class='table'>";
	echo "<tr>";
	echo "<td>no</td>";
	echo "<td>soal</td>";
	echo "<td>a</td>";
	echo "<td>b</td>";
	echo "<td>c</td>";
	echo "<td>d</td>";
	echo "<td>e</td>";
	echo "<td>jawaban</td>";
	echo "</tr>";
	$no=-1;
	for ($i = 1; $i <= $data['numRows']; $i++) {
		$no++;
		if($data['cells'][$i][1] == "soal" || $data['cells'][$i][1] == "SOAL" || $data['cells'][$i][1] == "Soal"){}
		else {
			echo "
			
				<tr>
					<td>"; echo $no; echo "</td>
					<td id='soal-".$i."'>"; echo $data['cells'][$i][1]; echo "</td>
					<td id='a-".$i."'>"; echo $data['cells'][$i][2]; echo "</td>
					<td id='b-".$i."'>"; echo $data['cells'][$i][3]; echo "</td>
					<td id='c-".$i."'>"; echo $data['cells'][$i][4]; echo "</td>
					<td id='d-".$i."'>"; echo $data['cells'][$i][5]; echo "</td>
					<td id='e-".$i."'>"; echo $data['cells'][$i][6]; echo "</td>
					<td id='jawaban_soal-".$i."'>"; echo $data['cells'][$i][7]; echo "</td>
				</tr>						
			"; 
		}
	}
	echo "</table>";
	//load model
	//$this->load->model('Data_model');
	//$this->Data_model->convert_soal($dataexcel);
	unlink($file);
	//echo "<script>window.location = '../../dashboard';</script>";
?>
