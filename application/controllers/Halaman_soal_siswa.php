<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman_soal_siswa extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
		$this->load->model("Function_model_manually");
		$this->load->library('session', 'url');
	}
	public function index(){
	}
	public function load_number_soal(){
		if($_GET["pg"] == "1"){
			$query = array(
				"query" => $this->Function_model_manually->readDataManuallyController("
					SELECT
					  a.`id_bank_soal`,
					  c.`jawaban`,
					  CASE
						WHEN (c.`jawaban` IS NULL)
						THEN 1
						ELSE 2
					  END AS status_jawaban,
					  c.`jawaban`
					FROM
					  bank_soal AS a
					  JOIN ujian AS b
						ON a.`ujian_id` = b.`id_ujian`
						AND b.`token` = '$_SESSION[token]'
					  LEFT JOIN jawaban_siswa AS c
						ON a.`id_bank_soal` = c.`no_soal`
						AND c.`nisn` = '$_SESSION[nisn]'
						AND c.`nik` = '$_SESSION[nik]'
					GROUP BY a.`soal`
					ORDER BY a.`id_bank_soal` ASC
					LIMIT $_SESSION[jumlah_ujian]
				"),
				"query2" => $this->Function_model_manually->readDataManuallyController("
					SELECT
					  *
					FROM
					  ujian AS a
					  LEFT JOIN bank_soal_essay AS b
						ON a.`id_ujian` = b.`ujian_id`
					WHERE a.`token` = '$_SESSION[token]'
					ORDER BY b.`id_bank_soal_essay` ASC
				")
			);
			$this->load->view("siswa/a/view_number_soal", $query);
		}
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
					  c.`jawaban`
					FROM
					  bank_soal AS a
					  JOIN ujian AS b
						ON a.`ujian_id` = b.`id_ujian`
						AND b.`token` = '$_SESSION[token]'
					  LEFT JOIN jawaban_siswa AS c
						ON a.`id_bank_soal` = c.`no_soal`
						AND c.`nisn` = '$_SESSION[nisn]'
						AND c.`nik` = '$_SESSION[nik]'
					WHERE a.`id_bank_soal` = '$_GET[id_bank_soal]'
					GROUP BY a.`soal`
					LIMIT 1
					
				")
			);
			$this->load->view("siswa/a/view_soal_multiple_coice", $arrayData);
		}
		else if($_GET["pg"] == "2"){
			$array = array(
				"tampil" => $query13 = $this->Function_model_manually->readDataManuallyController("
					
					SELECT
					  *
					FROM
					  bank_soal_essay AS a
					  JOIN ujian AS b
						ON a.`ujian_id` = b.`id_ujian`
						AND b.`token` = '$_SESSION[token]'
					  LEFT JOIN jawaban_siswa_essay AS c
						ON a.`id_bank_soal_essay` = c.`no_soal`
						AND c.`nisn` = '$_SESSION[nisn]'
						AND c.`nik` = '$_SESSION[nik]'
					WHERE a.`id_bank_soal_essay` = '$_GET[id_bank_soal_essay]'
					LIMIT 1
					
				")
			);
			$this->load->view("siswa/a/view_soal_essay", $array);
		}
	}
	public function jawaban_siswa(){
		
		$response = array();
		if(empty($this->input->post("nisn")) && empty($this->input->post("nik")) && empty($this->input->post("token")) && empty($this->input->post("no_soal")) && empty($this->input->post("jawaban"))){
		} else {
			$whereJawaban = array(
				"nisn" => $this->input->post("nisn"),
				"nik" => $this->input->post("nik"),
				"token" => $this->input->post("token"),
				"no_soal" => $this->input->post("no_soal"),
				"jawaban" => $this->input->post("jawaban")
			);
			array_push(
				$response, $whereJawaban
			);
			$whereNoJawaban = array(
					"nisn" => $this->input->post("nisn"),
					"nik" => $this->input->post("nik"),
					"token" => $this->input->post("token"),
					"no_soal" => $this->input->post("no_soal")
				);
			if ($this->crud_function_model->login("jawaban_siswa", $whereNoJawaban) == 0) {
				$this->crud_function_model->insertData("jawaban_siswa", $whereJawaban);
				array_push(
					$response, "insert"
				);
			} else {
				array_push(
					$response, "update"
				);
				$set = array(
					"jawaban" => $this->input->post("jawaban")
				);
				$this->crud_function_model->updateData("jawaban_siswa",$set, $whereNoJawaban);
			}
			
		}
		echo json_encode($response);
	}
	public function jawaban_siswa_essay(){
		if(empty($this->input->post("nisn")) 
			|| empty($this->input->post("nik")) 
			|| empty($this->input->post("token")) 
			|| empty($this->input->post("no_soal")) 
			|| empty($this->input->post("jawaban"))){
				
		}else {
			$whereJawaban = array(
				"nisn" => $this->input->post("nisn"),
				"nik" => $this->input->post("nik"),
				"token" => $this->input->post("token"),
				"no_soal" => $this->input->post("no_soal"),
				"jawaban" => $this->input->post("jawaban")
			);
			$whereNoJawaban = array(
					"nisn" => $this->input->post("nisn"),
					"nik" => $this->input->post("nik"),
					"token" => $this->input->post("token"),
					"no_soal" => $this->input->post("no_soal")
				);
			if ($this->crud_function_model->login("jawaban_siswa_essay", $whereNoJawaban) == 0) {
				$this->crud_function_model->insertData("jawaban_siswa_essay", $whereJawaban);
				$message =  array(
					"message" => "data berhasil di simpan....."
					);
			} else {
				
				$set = array(
					"jawaban" => $this->input->post("jawaban")
				);
				$this->crud_function_model->updateData("jawaban_siswa_essay",$set, $whereNoJawaban);
				$message =  array(
					"message" => "data berhasil di ubah......"
					);
			}
			$this->load->view("admin/valids/validationmessage", $message);
		}
	}
	public function nilai_compile(){
		if($_GET["pg"] == "1"){
			$query13 = array(
				"nilai_array" => $this->Function_model_manually->readDataManuallyController("
					SELECT
					  COUNT(*) AS jumlah_jawab,
					  c.`jumlah_ujian` AS jumlah_soal_ujian,
					  FLOOR(
						SUM((b.`jawaban_soal` = a.`jawaban`) = 1) * (100 / c.`jumlah_ujian`)
					  ) AS nilai_asli,
					  (FLOOR(
						SUM((b.`jawaban_soal` = a.`jawaban`) = 1) * (100 / c.`jumlah_ujian`)
					  ) * c.`persen_multiple_coice`) / 100 AS nilai_persen,
					  c.`persen_multiple_coice` AS persentase
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
				"),
				"jumlah_jawab_essay" => $this->Function_model_manually->readDataManuallyController("
				
				SELECT
				  SUM(
					CASE
					  WHEN (c.`jawaban` IS NULL)
					  THEN 0
					  ELSE 1
					END
				  ) AS jumlah_jawab,
				  COUNT(*) AS jumlah_soal,
				  b.`persen_essay`
				FROM
				  bank_soal_essay AS a
				  JOIN ujian AS b
					ON a.`ujian_id` = b.`id_ujian`
					AND b.`token` = '$_SESSION[token]'
				  LEFT JOIN jawaban_siswa_essay AS c
					ON a.`id_bank_soal_essay` = c.`no_soal`
					AND c.`nisn` = '$_SESSION[nisn]'
					AND c.`nik` = '$_SESSION[nik]'
				
				
				")
			);
			$this->load->view("siswa/a/data_nilai_soal_choice", $query13);
		}
		
	}
	public function nilai_keseluruhan(){
		if($this->input->get("pg") == "1"){
			$nilai_all = $this->Function_model_manually->readDataManuallyController("
				
				SELECT
				  a.`nama_ujian`,
				  a.`jumlah_ujian`,
				  a.`token`,
				  SUM(b.`jawaban_soal` = c.`jawaban`) + SUM(b.`jawaban_soal` != c.`jawaban`) AS jumlah_jawab,
				  SUM(b.`jawaban_soal` = c.`jawaban`) AS benar,
				  SUM(b.`jawaban_soal` != c.`jawaban`) AS salah,
				  FLOOR(
					SUM(
					  (100 / a.`jumlah_ujian`) *
					  CASE
						WHEN (c.`jawaban` = b.`jawaban_soal`)
						THEN 1
						ELSE 0
					  END
					)
				  ) AS nilai_murni
				FROM
				  ujian AS a
				  LEFT JOIN bank_soal AS b
					ON a.`id_ujian` = b.`ujian_id`
				  LEFT JOIN jawaban_siswa AS c
					ON a.`token` = c.`token`
					AND b.`id_bank_soal` = c.`no_soal`
				WHERE a.`kelas_id` = '$_SESSION[kelas_id_siswa]'
				  AND c.`nisn` = '$_SESSION[nisn]'
				  AND c.`nik` = '$_SESSION[nik]'
				GROUP BY a.`id_ujian`
			
			");
			echo "<table class='table'>
					<tr>
						<td>Nama Ujian</td>
						<td>Jumlah Soal</td>
						<td>Jumlah Jawab</td>
						<td>Benar</td>
						<td>Salah</td>
						<td>Nilai Murni</td>
					</tr>
			";
			
			foreach($nilai_all as $item){
				if($item["token"] == $_SESSION["token"]){
					if($item["jumlah_jawab"] == $item["jumlah_ujian"]){
						echo "
							<tr>
								<td>$item[nama_ujian]</td>
								<td>$item[jumlah_ujian]</td>
								<td>$item[jumlah_jawab]</td>
								<td>$item[benar]</td>
								<td>$item[salah]</td>
								<td>$item[nilai_murni]</td>
							</tr>
						";
					} else {
						echo "
							<tr>
								<td>$item[nama_ujian]</td>
								<td>$item[jumlah_ujian]</td>
								<td>$item[jumlah_jawab]</td>
								<td></td>
								<td></td>
								<td>Selesaikan terlebih dahulu</td>
							</tr>
						";
					}
				} else {
					echo "
						<tr>
							<td>$item[nama_ujian]</td>
							<td>$item[jumlah_ujian]</td>
							<td>$item[jumlah_jawab]</td>
							<td>$item[benar]</td>
							<td>$item[salah]</td>
							<td>$item[nilai_murni]</td>
						</tr>
					";
				}
				
			}
			echo "</table>";
		} else {}
	}
	//api android
	public function api_load_number_soal(){
		if(!empty($_GET["pg"])){
			if($_GET["pg"] == "1"){
				$response = array();
					$queryNumber = $this->Function_model_manually->readDataManuallyController("
						SELECT
						  a.`id_bank_soal`,
						  c.`jawaban`,
						  CASE
							WHEN (c.`jawaban` IS NULL)
							THEN 1
							ELSE 2
						  END AS status_jawaban,
						  c.`jawaban`
						FROM
						  bank_soal AS a
						  JOIN ujian AS b
							ON a.`ujian_id` = b.`id_ujian`
							AND b.`token` = '$_POST[token]'
						  LEFT JOIN jawaban_siswa AS c
							ON a.`id_bank_soal` = c.`no_soal`
							AND c.`nisn` = '$_POST[nisn]'
							AND c.`nik` = '$_POST[nik]'
						GROUP BY a.`soal`
						ORDER BY a.`id_bank_soal` ASC
						LIMIT $_POST[jumlah_ujian]
					");
				
				// $this->load->view("siswa/a/view_number_soal", $query);
				foreach($queryNumber as $item){
					$nomer = array(
						"id_bank_soal" => $item["id_bank_soal"],
						"jawaban" => $item["jawaban"],
						"status_jawaban" => $item["status_jawaban"],
					);
					array_push($response, $nomer);
				}
				echo json_encode($response);
			} else {
				
			}
		}else {
			
		}
	}
	public function api_load_soal_siswa(){
		if($_GET["pg"] == "1"){
				$response = array();
				$querySoal = $this->Function_model_manually->readDataManuallyController("
					
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
					  c.`jawaban`
					FROM
					  bank_soal AS a
					  JOIN ujian AS b
						ON a.`ujian_id` = b.`id_ujian`
						AND b.`token` = '$_POST[token]'
					  LEFT JOIN jawaban_siswa AS c
						ON a.`id_bank_soal` = c.`no_soal`
						AND c.`nisn` = '$_POST[nisn]'
						AND c.`nik` = '$_POST[nik]'
					WHERE a.`id_bank_soal` = '$_POST[id_bank_soal]'
					GROUP BY a.`soal`
					LIMIT 1
					
				");
				foreach($querySoal as $soalA){
					$soal = array(
						"id_bank_soal" => $soalA["id_bank_soal"],
						"soal" => $soalA["soal"],
						"a" => $soalA["a"],
						"b" => $soalA["b"],
						"c" => $soalA["c"],
						"d" => $soalA["d"],
						"e" => $soalA["e"],
						"status_soal" => $soalA["status_soal"],
						"jawaban" => $soalA["jawaban"],
					);
					array_push($response, $soal);
				}
				echo json_encode($response);
			
		}
	}
}