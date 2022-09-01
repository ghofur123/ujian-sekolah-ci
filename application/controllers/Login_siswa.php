<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_siswa extends CI_Controller {
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
		$this->load->view("siswa/login/login");
	}
	public function validation(){
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
					$arraySession = array( 
						"nisn" => $item["nisn"],
						"nik" => $item["nik"],
						"nama" => $item["nama_siswa"],
						"kelas_id_siswa" => $item["kelas_id"]
					);
					$this->session->set_userdata($arraySession);
				}
				//cek token
				$whereToken = array(
					"token" => $this->input->post("token")
				);
				$queryToken = $this->crud_function_model->login("ujian", $whereToken);
				if($queryToken > 0){
					$queryTokenData = $this->crud_function_model->readData("ujian", "", $whereToken, "");
					foreach($queryTokenData as $tokenArray){
						$arraySession = array( 
							"token" => $this->input->post("token"),
							"jumlah_ujian" => $tokenArray["jumlah_ujian"],
							"status_user" => "siswa",
							"kelas_id_ujian" => $tokenArray["kelas_id"],
							"waktu" => $tokenArray["waktu"],
							"metode" => $tokenArray["metode"],
						);
					}
					$this->session->set_userdata($arraySession);
					if($_SESSION["kelas_id_siswa"] == $_SESSION["kelas_id_ujian"]){
						$message =  array(
							"message" => ""
						);
						echo "<script>window.location = 'dashboard';</script>";
					} else {
						$message =  array(
							"message" => "Anda tidak berhak masuk di kelas ini . coba periksa token lagi, apakah anda berada di kelas dengan token ini"
						);
					}
				} else {
					$message =  array(
						"message" => "Token salah"
					);
				}
			} else {
				$message =  array(
					"message" => "NISN atau NIK salah"
				);
			}
		} else {
			$message =  array(
				"message" => validation_errors()
			);
		}
		$this->load->view("admin/valids/validationmessagenatural", $message);
	}
	public function api_login_siswa_android(){
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
					$arraySession = array( 
						"nisn" => $item["nisn"],
						"nik" => $item["nik"],
						"nama" => $item["nama_siswa"],
						"kelas_id_siswa" => $item["kelas_id"]
					);
					$this->session->set_userdata($arraySession);
				}
				//cek token
				$whereToken = array(
					"token" => $this->input->post("token")
				);
				$queryToken = $this->crud_function_model->login("ujian", $whereToken);
				if($queryToken > 0){
					$queryTokenData = $this->crud_function_model->readData("ujian", "", $whereToken, "");
					foreach($queryTokenData as $tokenArray){
						$arraySession = array( 
							"token" => $this->input->post("token"),
							"jumlah_ujian" => $tokenArray["jumlah_ujian"],
							"status_user" => "siswa",
							"kelas_id_ujian" => $tokenArray["kelas_id"],
							"waktu" => $tokenArray["waktu"],
							"metode" => $tokenArray["metode"],
						);
					}
					$this->session->set_userdata($arraySession);
					if($_SESSION["kelas_id_siswa"] == $_SESSION["kelas_id_ujian"]){
						$message = array( 
							"nisn" => $_SESSION["nisn"],
							"nik" => $_SESSION["nik"],
							"nama" => $_SESSION["nama"],
							"kelas_id_siswa" => $_SESSION["kelas_id_siswa"],
							"token" => $_SESSION["token"],
							"jumlah_ujian" => $_SESSION["jumlah_ujian"],
							"status_user" => "siswa",
							"waktu" => $_SESSION["waktu"],
							"metode" => $_SESSION["metode"],
							"message" => "berhasil",
							"status_login" => "1",
						);
						//jika berhasil di sini
						array_push($response, $message);
					} else {
						$message =  array(
							"status_login" => "0",
							"message" => "Anda tidak berhak masuk di kelas ini . coba periksa token lagi, apakah anda berada di kelas dengan token ini"
						);
						array_push($response, $message);
					}
				} else {
					$message =  array(
						"status_login" => "0",
						"message" => "Token salah"
					);
					array_push($response, $message);
				}
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