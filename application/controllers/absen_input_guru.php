<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class absen_input_guru extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
		if(empty($_SESSION['username'])){
			redirect('login');
		} else {	
		}
	}
	public function index(){
	}
	public function load(){
		if(empty($_GET["act"])){
							
		} else {
			if($_GET["act"] == "insert"){
			
				$arrayPost = array(
				"guru_id" => $this->input->post("guru_id"),
				"kode_absen_struktur_guru_id" => $this->input->post("kode_absen_struktur_guru_id"),
				);
				$this->form_validation->set_rules("guru_id", "guru_id", "required");
				$this->form_validation->set_rules("kode_absen_struktur_guru_id", "kode_absen_struktur_guru_id", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->insertData("absen_input_guru", $arrayPost);
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
					"tampilData" => $this->crud_function_model->readData("absen_input_guru", "", "", "id_absen_input_guru desc"),
					"idDb" => "id_absen_input_guru"
				);
				$this->load->view("admin/content/absen_input_guru/table", $queryDataRead);
			} // end load
			else if($_GET["act"] == "delete"){
				
				$this->crud_function_model->deleteData("absen_input_guru", "id_absen_input_guru = $_GET[id]");
			} // end delete	
			else if($_GET["act"] == "view"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("absen_input_guru", "", "id_absen_input_guru = $_GET[id]", "id_absen_input_guru desc"),
					"idDb" => "id_absen_input_guru"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
					
						<tr>
							<td>guru_id</td>
							<td>"; echo $item["guru_id"]; echo "</td>
						</tr>
						
						<tr>
							<td>time_guru</td>
							<td>"; echo $item["time_guru"]; echo "</td>
						</tr>
						
						<tr>
							<td>kode_absen_struktur_guru_id</td>
							<td>"; echo $item["kode_absen_struktur_guru_id"]; echo "</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view
			else if($_GET["act"] == "viewEdit"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("absen_input_guru", "", "id_absen_input_guru = $_GET[id]", "id_absen_input_guru desc"),
					"idDb" => "id_absen_input_guru"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
						<tr>
							<input type='hidden' name='id' class='form-control' style='width:100%;' value='"; echo $item["id_absen_input_guru"]; echo "' hidden>
						
							<td>guru_id</td>
							<td>
							
									<input type='text' name='guru_id' class='form-control' style='width:100%;' value='"; echo $item["guru_id"]; echo "' >
								
							</td>
						</tr>
						
							<td>time_guru</td>
							<td>
							
									<input type='text' name='time_guru' class='form-control' style='width:100%;' value='"; echo $item["time_guru"]; echo "' >
								
							</td>
						</tr>
						
							<td>kode_absen_struktur_guru_id</td>
							<td>
							
									<input type='text' name='kode_absen_struktur_guru_id' class='form-control' style='width:100%;' value='"; echo $item["kode_absen_struktur_guru_id"]; echo "' >
								
							</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view edit
			else if($_GET["act"] == "update"){
				
				$id = $this->input->post("id");
				$arrayPost = array(
				"guru_id" => $this->input->post("guru_id"),"time_guru" => $this->input->post("time_guru"),"kode_absen_struktur_guru_id" => $this->input->post("kode_absen_struktur_guru_id"),
				);
				$this->form_validation->set_rules("guru_id", "guru_id", "required");$this->form_validation->set_rules("time_guru", "time_guru", "required");$this->form_validation->set_rules("kode_absen_struktur_guru_id", "kode_absen_struktur_guru_id", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->updateData("absen_input_guru", $arrayPost, "id_absen_input_guru = '$id'");
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
					"tampilData" => $this->crud_function_model->readData("absen_input_guru", "", "id_absen_input_guru like '%$_GET[id]%'  || guru_id like '%$_GET[id]%' || time_guru like '%$_GET[id]%' || kode_absen_struktur_guru_id like '%$_GET[id]%' ", "id_absen_input_guru desc"),
					"idDb" => "id_absen_input_guru"
				);
				$this->load->view("admin/content/absen_input_guru/table", $queryDataRead);
			}// end search
		}// end else // pertama
	}
}
			