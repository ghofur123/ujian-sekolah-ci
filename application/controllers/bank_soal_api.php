<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_soal_api extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->output->set_header( "Access-Control-Allow-Origin: *" );
		$this->output->set_header( "Access-Control-Allow-Credentials: true" );
		$this->output->set_header( "Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS" );
		$this->output->set_header( "Access-Control-Max-Age: 604800" );
		$this->output->set_header( "Access-Control-Request-Headers: x-requested-with" );
		$this->output->set_header( "Access-Control-Allow-Headers: x-requested-with, x-requested-by" );
		
		$this->load->database();
		$this->load->model("crud_function_model");
		$this->load->model("Function_model_manually");
		$this->load->helper(array('form', 'url'));
	}
	public function index(){
	}
	public function load(){
		if(empty($_GET["act"])){		
		} else {
			////
			if($_GET["act"] == "load"){
				$response = array();
				///
				$queryDataRead1 =  $this->Function_model_manually->readDataManuallyController("
					SELECT
					  *
					FROM
					  ujian AS a
					WHERE a.`id_ujian` = $_GET[idUjian]
					ORDER BY a.`id_ujian` DESC
					");
				foreach($queryDataRead1 as $item){
					$ujian =  array(
						"id_ujian" => $item["id_ujian"],
						"nama_ujian" => $item["nama_ujian"],
						"kelas_id" => $item["kelas_id"],
						"token" => $item["token"],
						"guru_id" => $item["guru_id"],
						"materi_id" => $item["materi_id"],
						"jumlah_ujian" => $item["jumlah_ujian"],
						"persen_multiple_coice" => $item["persen_multiple_coice"],
						"persen_essay" => $item["persen_essay"],
						"waktu" => $item["waktu"],
						"metode" => $item["metode"],
						"jenis_ujian" => $item["jenis_ujian"],
					);
					array_push($response, $ujian);
				}
				///
				
				$whrr = array(
						"ujian_id" => $_GET["idUjian"],
					);
				$queryDataRead = $this->crud_function_model->readData("bank_soal", "", $whrr, "id_bank_soal ASC");
				foreach($queryDataRead as $item){
					$message =  array(
							"id_bank_soal" => $item["id_bank_soal"],
							"soal" => $item["soal"],
							"a" => $item["a"],
							"b" => $item["b"],
							"c" => $item["c"],
							"d" => $item["d"],
							"e" => $item["e"],
							"ujian_id" => $item["ujian_id"],
							"jawaban_soal" => $item["jawaban_soal"]
							);
					array_push($response, $message);
				}
				echo json_encode($response);
			} // end load
		}	
	}
}
			