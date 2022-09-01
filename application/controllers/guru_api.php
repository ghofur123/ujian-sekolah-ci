<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_api extends CI_Controller {
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
	}
	public function index(){
	}
	public function load(){
		if(empty($_GET["act"])){
							
		} else {
			if($_GET["act"] == "load"){
				$response = array();
				$queryDataRead = $this->crud_function_model->readData("guru", "", "", "id_guru desc");
				foreach($queryDataRead as $item){
					$guru = array(
						"id_guru" => $item["id_guru"],
						"nama_guru" => $item["nama_guru"],
						"username" => $item["username"],
						"password" => $item["password"]
					);
					array_push($response, $guru);
				}
				echo json_encode($response);
			} // end load
		}// end else // pertama
	}
}
			