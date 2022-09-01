<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
		$this->load->model("Function_model_manually");
	}
	public function index(){
	}
	public function load(){
		if($_GET["pg"] == "1"){
			$arrayData = array ( 
				"query1" => $this->Function_model_manually->readDataManuallyController("
					
					SELECT
					  a.`id_bank_soal`,
					  a.`soal`,
					  a.`a`,
					  a.`b`,
					  a.`c`,
					  a.`d`,
					  a.`e`,
					  b.*,
					  c.`id_jawaban_siswa` IS NOT NULL AS status_soal,
					  c.`jawaban`,
					  CASE
						WHEN (
						  b.`jumlah_ujian` <= SUM(c.`id_jawaban_siswa`)
						)
						THEN 1
						ELSE 0
					  END AS sinck_jumlah_ujian,
					  b.`jumlah_ujian`
					FROM
					  bank_soal AS a
					  JOIN ujian AS b
						ON a.`ujian_id` = b.`id_ujian`
						AND b.`token` = '456523423'
					  LEFT JOIN jawaban_siswa AS c
						ON a.`id_bank_soal` = c.`no_soal`
						AND c.`nisn` = '390436450'
						AND c.`nik` = '335850226'
					WHERE c.`id_jawaban_siswa` IS NULL
					GROUP BY a.`soal`
					ORDER BY RAND()
					LIMIT 1
					
				"),
				"log" => $this->crud_function_model->login("jawaban_siswa", "nisn = '390436450'
  AND nik = '335850226'
  AND token = '456523423'")
			);
			
			foreach($arrayData["query1"] as $item){
				echo $arrayData["log"];
				echo$item["jumlah_ujian"];
	if($item["jumlah_ujian"] <= $arrayData["log"]){
		echo "
			<input type='hidden' class='mode-form-soal' value='1' hidden>
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
		echo$item["jumlah_ujian"];
	}

}
		}
	}
}