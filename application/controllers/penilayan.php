<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilayan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
		$this->load->model("Function_model_manually");
		/*if(empty($_SESSION['username'])){
			redirect('login');
		} else {	
		}*/
	}
	public function index(){
			
	}
	public function nilai_multiple(){
		if($_GET["pg"] == "1"){
			echo "<table class='table'>";
				echo "<th>No</th>
				<th>Nama Siswa</th>
				<th>Jumlah Ujian</th>
				<th>Jumlah Jawab</th>
				<th>Salah</th>
				<th>Benar</th>
				<th>Nilai Murni</th>
				<th>Nilai Persentase</th>
				";
					$nomer=0;
					$queryNilai = $this->Function_model_manually->readDataManuallyController("
					
						SELECT
						  a.`nama_siswa`,
						  c.`nama_ujian`,
						  c.`jumlah_ujian`,
						  a.`nisn`,
						  a.`nik`,
						  SUM(b.`jawaban` = d.`jawaban_soal`) AS benar,
						  SUM(b.`jawaban` != d.`jawaban_soal`) AS salah,
						  c.`persen_multiple_coice`,
						  c.`persen_essay`,
						  SUM(b.`jawaban` = d.`jawaban_soal`) + SUM(b.`jawaban` != d.`jawaban_soal`) AS jumlah_jawab,
						  FLOOR(
							(
							  SUM(
								(100 / c.`jumlah_ujian`) *
								CASE
								  WHEN (b.`jawaban` = d.`jawaban_soal`)
								  THEN 1
								  ELSE 0
								END
							  ) * c.`persen_multiple_coice`
							) / 100
						  ) AS nilai_persentase,
						  FLOOR(
							SUM(
							  (100 / c.`jumlah_ujian`) *
							  CASE
								WHEN (b.`jawaban` = d.`jawaban_soal`)
								THEN 1
								ELSE 0
							  END
							)
						  ) AS nilai_murni
						FROM
						  data_siswa AS a
						  JOIN jawaban_siswa AS b
						  JOIN ujian AS c
						  JOIN bank_soal AS d
							ON a.`nisn` = b.`nisn`
							AND a.`nik` = b.`nik`
							AND b.`token` = c.`token`
							AND b.`no_soal` = d.`id_bank_soal`
					WHERE c.`id_ujian` = '$_GET[id_ujian]'
					GROUP BY a.`nama_siswa`
					
					");
					foreach($queryNilai as $ii); ?>
							<script>
							$(document).ready(function(){
								$('.title-class').html('<?php echo $ii["nama_ujian"]?>');
							});
							</script>
					<?php
					$nomer=0;
					foreach($queryNilai as $nilaiSiswa){
						$nomer++;
						echo "<tr>";
						echo "<td>$nomer</td>";
						echo "<td>$nilaiSiswa[nama_siswa]</td>";
						/*echo "<td>$nilaiSiswa[nisn]</td>";
						echo "<td>$nilaiSiswa[nik]</td>";
						*/
						echo "<td>$nilaiSiswa[jumlah_ujian]</td>";
						if($nilaiSiswa["jumlah_jawab"] != 0){
							echo "<td>$nilaiSiswa[jumlah_jawab]</td>";
						}else {
							echo "<td></td>";
						}
						echo "<td>$nilaiSiswa[salah]</td>";
						echo "<td>$nilaiSiswa[benar]</td>";
						echo "<td>$nilaiSiswa[nilai_murni]</td>";
						echo "<td>$nilaiSiswa[nilai_persentase]</td>";
						echo "</tr>";
					}
					echo "</table>";
		}
	}
	public function ujian(){
		if(!empty($_GET)){
			if($_GET["kelas_id"] != ''){
				$arrayWhere = array(
					"kelas_id" => $_GET["kelas_id"]
				);
			} else {
				$arrayWhere = "";
			}
		} else {
			$arrayWhere = "";
		}
		$queryDataRead = array(
			"tampilData" => $this->crud_function_model->readData("ujian", "", $arrayWhere, "nama_ujian ASC"),
			"idDb" => "id_bank_soal"
		);	
		$this->load->view("admin/content/penilayan/a/get_ujian", $queryDataRead);
	}
	public function kelas(){
		$queryDataRead = array(
			"tampilData" => $this->crud_function_model->readData("kelas", "", "", "nama_kelas ASC"),
			"idDb" => "id_bank_soal"
		);	
		$this->load->view("admin/content/penilayan/a/get_kelas", $queryDataRead);
	}
	public function data_siswa_nilai(){
		$queryDataRead = array(
			"tampilData" => $this->Function_model_manually->readDataManuallyController("
			
			SELECT
			  COUNT(*),
			  b.`nama_siswa`,
			  b.`nisn`,
			  b.`nik`,
			  c.`id_ujian`
			FROM
			  jawaban_siswa_essay AS a
			  JOIN data_siswa AS b
			  JOIN ujian AS c
				ON a.`nisn` = b.`nisn`
				AND a.`nik` = b.`nik`
				AND a.`token` = c.`token`
			WHERE c.`id_ujian` = '$_GET[id_ujian]'
			GROUP BY a.`nisn`
			ORDER BY b.`nama_siswa` ASC
			
			
			"),
			"idDb" => "id_bank_soal"
		);	
		$this->load->view("admin/content/penilayan/a/data_siswa", $queryDataRead);
	}
	public function view_jawaban_essay(){
		$queryDataRead = array(
			"tampilData" => $this->Function_model_manually->readDataManuallyController("
			
			SELECT
			  a.`nisn`,
			  a.`nik`,
			  a.`token`,
			  a.`no_soal`,
			  c.`soal`,
			  a.`jawaban`,
			  d.`nilai`,
			  CASE
				WHEN (d.`nisn` IS NULL)
				THEN 0
				ELSE 1
			  END AS status_nilai
			FROM
			  jawaban_siswa_essay AS a
			  JOIN ujian AS b
			  JOIN bank_soal_essay AS c
				ON a.`token` = b.`token`
				AND b.`id_ujian` = c.`ujian_id`
				AND a.`no_soal` = c.`id_bank_soal_essay`
			LEFT JOIN nilai_siswa_essay AS d
				ON a.`nisn` = d.`nisn`
				AND a.`nik` = d.`nik`
				AND a.`token` = d.`token`
				AND a.`no_soal` = d.`no_soal`
			WHERE a.`nisn` = '$_GET[nisn]'
				  AND a.`nik` = '$_GET[nik]'
				  AND b.`id_ujian` = '$_GET[id_ujian]'
			
			"),
			"tampilData2" => $this->Function_model_manually->readDataManuallyController("
			
			
			SELECT
			  *,
			  SUM(
				CASE
				  WHEN (a.`jawaban` IS NULL)
				  THEN 1
				  ELSE 1
				END
			  ) AS jumlah_soal,
			  (b.`persen_essay` / SUM(
				CASE
				  WHEN (a.`jawaban` IS NULL)
				  THEN 1
				  ELSE 1
				END
			  )) AS nilai_persoal
			FROM
			  jawaban_siswa_essay AS a
			  JOIN ujian AS b
			  JOIN bank_soal_essay AS c
				ON a.`token` = b.`token`
				AND b.`id_ujian` = c.`ujian_id`
				AND a.`no_soal` = c.`id_bank_soal_essay`
			WHERE a.`nisn` = '$_GET[nisn]'
				  AND a.`nik` = '$_GET[nik]'
				  AND b.`id_ujian` = '$_GET[id_ujian]'
			ORDER BY c.`id_bank_soal_essay` ASC
			
			"),
			"idDb" => "id_bank_soal"
		);	
		$this->load->view("admin/content/penilayan/a/get_data_jawaban_essay", $queryDataRead);
	}
	public function save_nilai_siswa_essay(){
		
		if($_GET["pg"] == 1){
			if(!empty($_GET["nisn"]) && !empty($_GET["nik"]) && !empty($_GET["token"]) && !empty($_GET["token"])){
				$paramGet = array(
					"nisn" => $_GET["nisn"],
					"nik" => $_GET["nik"],
					"token" => $_GET["token"],
					"no_soal" => $_GET["no_soal"]
				);
				$paramGetNilai = array(
					"nilai" => $_GET["nilai"]
				);
				$param = array(
					"nisn" => $_GET["nisn"],
					"nik" => $_GET["nik"],
					"token" => $_GET["token"],
					"no_soal" => $_GET["no_soal"],
					"nilai" => $_GET["nilai"]
				);
				$queryLogin = $this->crud_function_model->login("nilai_siswa_essay", $paramGet);
				if($queryLogin > 0){
					$this->crud_function_model->insertData("nilai_siswa_essay", $param);
					
					$message =  array(
						"message" => "Data Berhasil di simpan"
						);
				} else {
					$this->crud_function_model->updateData("nilai_siswa_essay", $paramGet, $paramGetNilai);
					$message =  array(
						"message" => "data berhasil di ubah"
						);
				}
				$this->load->view("admin/valids/validationmessage", $message);
			} else {
				$message =  array(
						"message" => "ddddddddddd"
						);
				$this->load->view("admin/valids/validationmessage", $message);
			}
		}
	}
	public function print_title(){
		if($this->input->get("pg") == "1"){
			$query = $this->Function_model_manually->readDataManuallyController("
				SELECT
				  a.`nama_ujian`,
				  c.`nama_materi`,
				  b.`nama_guru`
				FROM
				  ujian AS a
				  LEFT JOIN guru AS b
					ON a.`guru_id` = b.`id_guru`
				  LEFT JOIN materi AS c
					ON a.`materi_id` = c.`nama_materi`
				WHERE a.`id_ujian` = '20'
			
			");
			foreach($query as $item){
				echo $item["nama_ujian"].$item["nama_materi"].$item["nama_guru"];
			}
		}
	}
}
