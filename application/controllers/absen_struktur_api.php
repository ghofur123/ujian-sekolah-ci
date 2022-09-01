<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen_struktur_api extends CI_Controller {
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
				$queryDataRead = $this->crud_function_model->readData("absen_struktur", "", "", "nama_absen_struktur ASC");
				foreach($queryDataRead as $item){
					$struktur = array(
						"id_absen_struktur" => $item["id_absen_struktur"],
						"nama_absen_struktur" => $item["nama_absen_struktur"],
						"nilai_absen_struktur" => $item["nilai_absen_struktur"],
						"jam_absen_struktur" => $item["jam_absen_struktur"],
						"kode_absen_struktur" => $item["kode_absen_struktur"]
					);
					array_push($response, $struktur);
				}
				echo json_encode($response);
			} // end load
		}// end else // pertama
	}
}