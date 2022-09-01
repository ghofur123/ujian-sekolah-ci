<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bank_soal_essay extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
	}
	public function index(){
	}
	public function load(){
		if(empty($_GET["act"])){
							
		} else {
			if($_GET["act"] == "insert"){
			
				$arrayPost = array(
				"soal" => $this->input->post("soal"),"ujian_id" => $this->input->post("ujian_id"),
				);
				$this->form_validation->set_rules("soal", "soal", "required");$this->form_validation->set_rules("ujian_id", "ujian_id", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->insertData("bank_soal_essay", $arrayPost);
					$message =  array(
					"message" => "Data Berhasil Di Simpan"
					);
				} else {
					$message =  array(
					"message" => validation_errors()
					);
				}
				$this->load->view("admin/valids/validationmessage", $message);
			
			} // end insert
			
			else if($_GET["act"] == "load"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("bank_soal_essay", "", "ujian_id = '$_GET[ujian_id]'", "id_bank_soal_essay desc"),
					"idDb" => "id_bank_soal_essay"
				);
				$this->load->view("admin/content/bank_soal_essay/table", $queryDataRead);
			} // end load
			else if($_GET["act"] == "delete"){
				
				$this->crud_function_model->deleteData("bank_soal_essay", "id_bank_soal_essay = $_GET[id]");
			} // end delete	
			else if($_GET["act"] == "view"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readDataManuallyFunction("
					
					SELECT
					  a.`soal`, b.`nama_ujian`
					FROM
					  bank_soal_essay AS a
					  JOIN ujian AS b
						ON a.`ujian_id` = b.`id_ujian`
					WHERE a.`id_bank_soal_essay` = '$_GET[id]'
					
					"),
					"idDb" => "id_bank_soal_essay"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
					
						<tr>
							<td>soal</td>
							<td>"; echo $item["soal"]; echo "</td>
						</tr>
						
						<tr>
							<td>ujian_id</td>
							<td>"; echo $item["nama_ujian"]; echo "</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view
			else if($_GET["act"] == "viewEdit"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readDataManuallyFunction("
					
					SELECT
					  a.`id_bank_soal_essay`, a.`soal`, b.`nama_ujian`, a.`ujian_id`
					FROM
					  bank_soal_essay AS a
					  JOIN ujian AS b
						ON a.`ujian_id` = b.`id_ujian`
					WHERE a.`id_bank_soal_essay` = '$_GET[id]'
					
					"),
					"tampilDataUjian" => $this->crud_function_model->readData("ujian", "", "", "nama_ujian ASC"),
					"idDb" => "id_bank_soal_essay"
				);	
				$this->load->view("admin/content/bank_soal_essay/edit", $queryDataRead);
			} // end view edit
			else if($_GET["act"] == "update"){
				
				$arrayId = array(
					"id_bank_soal_essay" => $this->input->post("id")
				);
				$arrayPost = array(
				"soal" => $this->input->post("soal"),
				"ujian_id" => $this->input->post("id_ujian"),
				);
				$this->form_validation->set_rules("soal", "soal", "required");
				$this->form_validation->set_rules("id_ujian", "nama ujian", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->updateData("bank_soal_essay", $arrayPost, $arrayId);
					$message =  array(
					"message" => "Data Berhasil Di Simpan"
					);
				} else {
					$message =  array(
					"message" => validation_errors()
					);
				}
				$this->load->view("admin/valids/validationmessage", $message);
			
			}// end update 
			else if($_GET["act"] == "search"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("bank_soal_essay", "", "ujian_id = '$_GET[ujian_id]' && id_bank_soal_essay like '%$_GET[id]%'  || soal like '%$_GET[id]%' || ujian_id like '%$_GET[id]%' ", "id_bank_soal_essay desc"),
					"idDb" => "id_bank_soal_essay"
				);
				$this->load->view("admin/content/bank_soal_essay/table", $queryDataRead);
			}// end search
			
			
		}// end else // pertama
	}
}
			