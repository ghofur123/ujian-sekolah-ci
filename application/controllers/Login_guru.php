<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_guru extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
		$this->load->library('session', 'url');
	}
	public function index(){
		$this->load->view("admin/login/login_guru");
	}
	public function validation(){
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
					$arraySession = array( 
						"nama" => $item["nama_guru"],
						"username" => $item["username"],
						"password" => $item["password"],
						"status_user" => "guru"
						);
					$this->session->set_userdata($arraySession);
				}
				$message =  array(
					"message" => "selamat datang...."
				);
				echo "<script>window.location = 'dashboard';</script>";
			} else {
				$message =  array(
					"message" => "username atau password salah"
				);
			}
		} else {
			$message =  array(
				"message" => validation_errors()
			);
		}
		$this->load->view("admin/valids/validationmessagenatural", $message);
	}
}