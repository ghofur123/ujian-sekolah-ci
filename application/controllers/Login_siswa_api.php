<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_siswa_api extends CI_Controller {
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
		$this->load->library('session', 'url');
	}
	public function index(){
	}
	public function api_login_siswa_android_sinc(){
		if(!empty($_GET["act"])){
			if($_GET["act"] == 1){
				$response = array();
				$where = array(
						"nisn" => $this->input->post("nisn"),
						"nik" => $this->input->post("nik"),
					);
				$this->form_validation->set_rules("nisn", "nisn", "required");
				$this->form_validation->set_rules("nik", "nik", "required");
				if($this->form_validation->run() == true){
					$queryLogin = $this->crud_function_model->login("data_siswa", $where);
					if($queryLogin > 0){
						$queryCheck = $this->crud_function_model->readData("data_siswa", "", $where, "");
						foreach($queryCheck as $item){
							$message = array( 
								"nisn" => $item["nisn"],
								"nik" => $item["nik"],
								"nama" => $item["nama_siswa"],
								"kelas_id_siswa" => $item["kelas_id"],
								"jurusan_id_siswa" => $item["jurusan_id"],
								"message" => "Berhasil",
								"status_login" => "1"
							);
						}
						array_push($response, $message);
					} else {
						$message =  array(
							"status_login" => "0",
							"message" => "NISN atau NIK salah"
						);
						array_push($response, $message);
					}
				} else {
					$message =  array(
						"status_login" => "0",
						"message" => validation_errors()
					);
					array_push($response, $message);
				}
				echo json_encode($response);
			}else {}
		}
	}
}