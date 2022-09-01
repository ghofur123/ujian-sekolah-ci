<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class save_nilai extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("Crud_function_model");
		$this->load->model("Function_model_manually");
		if(empty($_SESSION['username'])){
			redirect('login');
		} else {	
		}
	}
	public function index(){
	}
	public function load(){
		if(empty($_GET["act"])){
							
		} else {
			if($_GET["act"] == "insert"){
				if(empty($_POST["id_ujian"])){} else {
					$queryNilai = $this->Function_model_manually->readDataManuallyController("
					
						SELECT
						a.`nisn`,
						a.`nik`,
						c.`token`,
						a.`id_data_siswa`,
						c.`id_ujian`,
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
						  ) AS nilai_persentase
						FROM
						  data_siswa AS a
						  JOIN jawaban_siswa AS b
						  JOIN ujian AS c
						  JOIN bank_soal AS d
							ON a.`nisn` = b.`nisn`
							AND a.`nik` = b.`nik`
							AND b.`token` = c.`token`
							AND b.`no_soal` = d.`id_bank_soal`
					WHERE c.`id_ujian` = '$_POST[id_ujian]'
					GROUP BY a.`nama_siswa`
					
					");
					$no=0;
					$unixRand = rand(0000000000,9999999999);
					if($this->input->post("status_ori") == 1){
						foreach($queryNilai as $nilaiSiswa){
							$no++;
							$arrayPost = array(
								"keterangan" => $this->input->post("keterangan"),
								"data_siswa_id" => $nilaiSiswa["id_data_siswa"],
								"ujian_id" => $nilaiSiswa["id_ujian"],
								"nilai_multiple" => $nilaiSiswa["nilai_persentase"],
								"nilai_essay" => "",
								"uniq" => $unixRand
							);
							$this->Crud_function_model->insertData("save_nilai", $arrayPost);
							$arrDell = array(
								"nisn" => $nilaiSiswa["nisn"],
								"nik" => $nilaiSiswa["nik"],
								"token" => $nilaiSiswa["token"]
							);
							$this->Crud_function_model->deleteData("jawaban_siswa", $arrDell);
						}
					} else {
						foreach($queryNilai as $nilaiSiswa){
							$no++;
							$arrayPost = array(
								"keterangan" => $this->input->post("keterangan"),
								"data_siswa_id" => $nilaiSiswa["id_data_siswa"],
								"ujian_id" => $nilaiSiswa["id_ujian"],
								"nilai_multiple" => $nilaiSiswa["nilai_persentase"],
								"nilai_essay" => "",
								"uniq" => $unixRand
							);
							$this->Crud_function_model->insertData("save_nilai", $arrayPost);
						}
					}
					$message = array(
						"message" => $no." data siswa tersimpan"
					);
					$this->load->view("admin/valids/validationmessage", $message);
				}
			} // end insert
			
			else if($_GET["act"] == "load"){
				$queryDataRead = array(
					"tampilData" => $this->Function_model_manually->readDataManuallyController("
						SELECT
						  *
						FROM
						  save_nilai AS a
						  JOIN data_siswa AS b
						  JOIN ujian AS c
						  JOIN materi AS d
						  JOIN kelas AS e
						  JOIN guru AS f
							ON a.`data_siswa_id` = b.`id_data_siswa`
							AND a.`ujian_id` = c.`id_ujian`
							AND c.`materi_id` = d.`id_materi`
							AND c.`kelas_id` = e.`id_kelas`
							AND c.`guru_id` = f.`id_guru`
						GROUP BY a.`uniq`
					"),
					"idDb" => "id_save_nilai"
				);
				$this->load->view("admin/content/save_nilai/table", $queryDataRead);
			} // end load
			else if($_GET["act"] == "viewDataNilai"){
				$queryNilaiView = $this->Function_model_manually->readDataManuallyController("
					SELECT
					  *
					FROM
					  save_nilai AS a
					  JOIN data_siswa AS b
					  JOIN ujian AS c
					  JOIN materi AS d
					  JOIN kelas AS e
					  JOIN guru AS f
						ON a.`data_siswa_id` = b.`id_data_siswa`
						AND a.`ujian_id` = c.`id_ujian`
						AND c.`materi_id` = d.`id_materi`
						AND c.`kelas_id` = e.`id_kelas`
						AND c.`guru_id` = f.`id_guru`
					WHERE a.`uniq` = '$_GET[id]'
					ORDER BY b.`nama_siswa` ASC
				");
				echo "<table class='table'>"; 
				echo "
					
					<tr>
						<td>No</td>
						<td>Nama</td>
						<td>Kelas</td>
						<td>Materi</td>
						<td>Guru</td>
						<td>Nilai</td>
					</tr>
						
					";
					$nomer=0;
				foreach($queryNilaiView as $nilai){
					$nomer++;
					echo "
					
					<tr>
						<td>$nomer</td>
						<td>$nilai[nama_siswa]</td>
						<td>$nilai[nama_kelas]</td>
						<td>$nilai[nama_materi]</td>
						<td>$nilai[nama_guru]</td>
						<td>$nilai[nilai_multiple]</td>
					</tr>
					"; 
				}
				echo "</table>";
			}
		}// end else // pertama
	}
}
			