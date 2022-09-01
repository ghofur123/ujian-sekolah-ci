<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman_soal_siswa_b extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("Crud_function_model");
		$this->load->model("Function_model_manually");
		$this->load->library('session', 'url');
	}
	public function index(){
	}
	public function load_soal(){
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
					  END AS sinck_jumlah_ujian
					FROM
					  bank_soal AS a
					  JOIN ujian AS b
						ON a.`ujian_id` = b.`id_ujian`
						AND b.`token` = '$_SESSION[token]'
					  LEFT JOIN jawaban_siswa AS c
						ON a.`id_bank_soal` = c.`no_soal`
						AND c.`nisn` = '$_SESSION[nisn]'
						AND c.`nik` = '$_SESSION[nik]'
					WHERE c.`id_jawaban_siswa` IS NULL
					GROUP BY a.`soal`
					ORDER BY RAND()
					LIMIT 1
					
				")
			);
			$this->load->view("siswa/b/view_soal_multiple_coice", $arrayData);
		}
	}
	public function insert_jawaban(){
		if($_GET["pg"] == "1"){
			if(empty($this->input->post("nisn")) and empty($this->input->post("nik")) and empty($this->input->post("token")) and empty($this->input->post("no_soal")) and empty($this->input->post("jawaban"))){
				echo "empty";
			}else {
				$whereJawaban = array(
					"nisn" => $this->input->post("nisn"),
					"nik" => $this->input->post("nik"),
					"token" => $this->input->post("token"),
					"no_soal" => $this->input->post("no_soal"),
					"jawaban" => $this->input->post("jawaban"),
				);
				$whereJawabanBB = array(
					"nisn" => $this->input->post("nisn"),
					"nik" => $this->input->post("nik"),
					"token" => $this->input->post("token"),
					"no_soal" => $this->input->post("no_soal"),
					
				);
				//echo "nisn =".$this->input->post("nisn")."&nik=".$this->input->post("nik")."&token=".$this->input->post("token")."&no_soal=".$this->input->post("no_soal")."&jawaban=".$this->input->post("jawaban");
				$check = $this->Crud_function_model->login("jawaban_siswa", $whereJawabanBB);
				if ($check == 0) {
					$this->Crud_function_model->insertData("jawaban_siswa", $whereJawaban);
					//echo "okkkk";
				} else {
					//echo "not found";
				}
			}
		}
	}
	function nilai_siswa_b(){
		if($_GET["pg"] == "1"){
			$arrayData = $this->Function_model_manually->readDataManuallyController("
			
				SELECT
				  COUNT(*) AS jumlah_jawab,
				  c.`jumlah_ujian` AS jumlah_soal_ujian,
				  FLOOR(
					SUM((b.`jawaban_soal` = a.`jawaban`) = 1) * (100 / c.`jumlah_ujian`)
				  ) AS nilai_asli,
				  (
					FLOOR(
					  SUM((b.`jawaban_soal` = a.`jawaban`) = 1) * (100 / c.`jumlah_ujian`)
					) * c.`persen_multiple_coice`
				  ) / 100 AS nilai_persen,
				  c.`persen_multiple_coice` AS persentase,
				  c.`nama_ujian`
				FROM
				  `jawaban_siswa` AS a
				  JOIN `bank_soal` AS b
				  JOIN `ujian` AS c
					ON a.`no_soal` = b.`id_bank_soal`
					AND a.`token` = c.`token`
					AND b.`ujian_id` = c.`id_ujian`
				WHERE a.`nisn` = '$_SESSION[nisn]'
				  AND a.`nik` = '$_SESSION[nik]'
				  AND a.`token` = '$_SESSION[token]'
			
			
			");
			foreach($arrayData as $item){
				if($item["jumlah_jawab"] >= $item["jumlah_soal_ujian"]){
					echo $item["nilai_asli"];
				}else {
					echo $item["nama_ujian"];
				}
				
			}
		}
	}
}