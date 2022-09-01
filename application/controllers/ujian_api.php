<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian_api extends CI_Controller {
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
		$this->load->library('session', 'url');
	}
	public function index(){
	}
	public function load(){
		
		if(empty($_GET["act"])){
							
		} else {
			if($_GET["act"] == "load"){
				$response = array();
				if(!empty($_GET["materiId"])) {
					$whr = "WHERE a.`kelas_id` = '$_GET[kelasId]' AND a.`materi_id` = '$_GET[materiId]'";
				}else{
					$whr = "WHERE a.`kelas_id` = '$_GET[kelasId]'";
				}
				$queryDataRead =  $this->Function_model_manually->readDataManuallyController("
					SELECT
					  *
					FROM
					  ujian AS a
					  JOIN kelas AS b
					  JOIN materi AS c
					  JOIN guru AS d
						ON a.`kelas_id` = b.`id_kelas`
						AND a.`materi_id` = c.`id_materi`
						AND a.`guru_id` = d.`id_guru`
					$whr
					ORDER BY a.`id_ujian` DESC
					");
				foreach($queryDataRead as $item){
					$ujian =  array(
						"id_ujian" => $item["id_ujian"],
						"nama_ujian" => $item["nama_ujian"],
						"nama_kelas" => $item["nama_kelas"],
						"token" => $item["token"],
						"nama_guru" => $item["nama_guru"],
						"nama_materi" => $item["nama_materi"],
						"jumlah_ujian" => $item["jumlah_ujian"],
						"nama_ujian" => $item["nama_ujian"],
						"persen_multiple_coice" => $item["persen_multiple_coice"],
						"persen_essay" => $item["persen_essay"],
						"waktu" => $item["waktu"],
						"metode" => $item["metode"],
					);
					array_push($response, $ujian);
				}
				
				echo json_encode($response);
			} // end load
			
		}// end else // pertama
	}
}
			