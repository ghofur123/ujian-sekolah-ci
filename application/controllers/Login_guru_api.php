<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_guru_api extends CI_Controller {
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
	public function validation(){
		if(!empty($_GET["act"])){
			if($_GET["act"] == 1){
				$response = array();
				$where = array(
					"username" => $this->input->post("username"),
					"password" => sha1($this->input->post("password"))
				);
				$this->form_validation->set_rules("username", "username", "required");
				$this->form_validation->set_rules("password", "password", "required");
				if($this->form_validation->run() == true){
					$queryLogin = $this->crud_function_model->login("guru", $where);
					if ($queryLogin > 0) {
						$queryAmbilData = $this->crud_function_model->readData("guru", "", $where, "");
						foreach($queryAmbilData as $item){
							$message = array( 
								"nama_guru" => $item["nama_guru"],
								"username" => $item["username"],
								"password" => $item["password"],
								"status_login" => "1"
								);
							array_push($response, $message);
						}
						$message =  array(
							"message" => "selamat datang...."
						);
						array_push($response, $message);
					} else {
						$message =  array(
							"message" => "username atau password salah"
						);
						array_push($response, $message);
					}
				} else {
					$message =  array(
						"message" => validation_errors()
					);
					array_push($response, $message);
				}
				echo json_encode($response);
			}else {}
		}else {}
	}
}