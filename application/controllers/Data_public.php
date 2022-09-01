<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_public extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
	}
	public function index(){
	}
	public function kelas(){
		$queryDataRead = array(
			"tampilData" => $this->crud_function_model->readData("kelas", "", "", "nama_kelas ASC"),
			"idDb" => "id_bank_soal"
		);	
		echo "<select class='form-control select-kelas-form' style='width:60%;' name='kelas_id'>"; 
		echo "<option value=''>Pilih Kelas</option>";
		foreach($queryDataRead["tampilData"] as $item){
			echo "
				<option value='"; echo $item["id_kelas"]; echo "'>"; echo $item["nama_kelas"]; echo "</option>
			"; 
		}
		echo "</select>";
	}
	public function guru(){
		$queryDataRead = array(
			"tampilData" => $this->crud_function_model->readData("guru", "", "", "nama_guru ASC"),
			"idDb" => "id_bank_soal"
		);	
		echo "<select class='form-control select-guru-form' style='width:60%;' name='guru_id'>"; 
		echo "<option value=''>Pilih guru</option>";
		foreach($queryDataRead["tampilData"] as $item){
			echo "
				<option value='"; echo $item["id_guru"]; echo "'>"; echo $item["nama_guru"]; echo "</option>
			"; 
		}
		echo "</select>";
	}
	public function materi(){
		$queryDataRead = array(
			"tampilData" => $this->crud_function_model->readData("materi", "", "", "nama_materi ASC"),
			"idDb" => "id_bank_soal"
		);	
		echo "<select class='form-control select-materi-form' style='width:60%;' name='materi_id'>"; 
		echo "<option value=''>Pilih materi</option>";
		foreach($queryDataRead["tampilData"] as $item){
			echo "
				<option value='"; echo $item["id_materi"]; echo "'>"; echo $item["nama_materi"]; echo "</option>
			"; 
		}
		echo "</select>";
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
		echo "<select class='form-control select-ujian-form' style='width:60%;'>"; 
		echo "<option value=''>Pilih ujian</option>";
		foreach($queryDataRead["tampilData"] as $item){
			echo "
				<option value='"; echo $item["id_ujian"]; echo "'>"; echo $item["nama_ujian"]; echo "</option>
			"; 
		}
		echo "</select>";
	}
	public function ujian2(){
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
		$this->load->view("admin/content/public_folder/view_ujian", $queryDataRead);
	}
	public function ujian_form(){
		$queryDataRead = array(
			"tampilData" => $this->crud_function_model->readData("ujian", "", "", "nama_ujian ASC"),
			"idDb" => "id_bank_soal"
		);	
		echo "<select class='form-control select-ujian-form2' name='ujian_id' id='ujian_id' style='width:45%;'>"; 
		echo "<option value=''>Pilih ujian</option>";
		foreach($queryDataRead["tampilData"] as $item){
			echo "
				<option value='"; echo $item["id_ujian"]; echo "'>"; echo $item["nama_ujian"]; echo "</option>
			"; 
		}
		echo "</select>";
	}
	public function ujian_siswa(){
		$queryDataRead = array(
			"tampilData" => $this->crud_function_model->readData("data_siswa", "", "", "nama_ujian ASC"),
			"idDb" => "id_bank_soal"
		);	
		echo "<select class='form-control select-ujian-form2' name='ujian_id' id='ujian_id' style='width:60%;'>"; 
		echo "<option value=''>Pilih ujian</option>";
		foreach($queryDataRead["tampilData"] as $item){
			echo "
				<option value='"; echo $item["id_ujian"]; echo "'>"; echo $item["nama_ujian"]; echo "</option>
			"; 
		}
		echo "</select>";
	}
}