<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen_struktur extends CI_Controller {
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
				"nama_absen_struktur" => $this->input->post("nama_absen_struktur"),"nilai_absen_struktur" => $this->input->post("nilai_absen_struktur"),"jam_absen_struktur" => $this->input->post("jam_absen_struktur"),"kode_absen_struktur" => $this->input->post("kode_absen_struktur"),
				);
				$this->form_validation->set_rules("nama_absen_struktur", "nama_absen_struktur", "required");$this->form_validation->set_rules("nilai_absen_struktur", "nilai_absen_struktur", "required");$this->form_validation->set_rules("jam_absen_struktur", "jam_absen_struktur", "required");$this->form_validation->set_rules("kode_absen_struktur", "kode_absen_struktur", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->insertData("absen_struktur", $arrayPost);
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
					"tampilData" => $this->crud_function_model->readData("absen_struktur", "", "", "id_absen_struktur desc"),
					"idDb" => "id_absen_struktur"
				);
				$this->load->view("admin/content/absen_struktur/table", $queryDataRead);
			} // end load
			else if($_GET["act"] == "delete"){
				
				$this->crud_function_model->deleteData("absen_struktur", "id_absen_struktur = $_GET[id]");
			} // end delete	
			else if($_GET["act"] == "view"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("absen_struktur", "", "id_absen_struktur = $_GET[id]", "id_absen_struktur desc"),
					"idDb" => "id_absen_struktur"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
					
						<tr>
							<td>nama_absen_struktur</td>
							<td>"; echo $item["nama_absen_struktur"]; echo "</td>
						</tr>
						
						<tr>
							<td>nilai_absen_struktur</td>
							<td>"; echo $item["nilai_absen_struktur"]; echo "</td>
						</tr>
						
						<tr>
							<td>jam_absen_struktur</td>
							<td>"; echo $item["jam_absen_struktur"]; echo "</td>
						</tr>
						
						<tr>
							<td>kode_absen_struktur</td>
							<td>"; echo $item["kode_absen_struktur"]; echo "</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view
			else if($_GET["act"] == "viewEdit"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("absen_struktur", "", "id_absen_struktur = $_GET[id]", "id_absen_struktur desc"),
					"idDb" => "id_absen_struktur"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
						<tr>
							<input type='hidden' name='id' class='form-control' style='width:100%;' value='"; echo $item["id_absen_struktur"]; echo "' hidden>
						
							<td>nama_absen_struktur</td>
							<td>
							
									<input type='text' name='nama_absen_struktur' class='form-control' style='width:100%;' value='"; echo $item["nama_absen_struktur"]; echo "' >
								
							</td>
						</tr>
						
							<td>nilai_absen_struktur</td>
							<td>
							
									<input type='text' name='nilai_absen_struktur' class='form-control' style='width:100%;' value='"; echo $item["nilai_absen_struktur"]; echo "' >
								
							</td>
						</tr>
						
							<td>jam_absen_struktur</td>
							<td>
							
									<input type='text' name='jam_absen_struktur' class='form-control' style='width:100%;' value='"; echo $item["jam_absen_struktur"]; echo "' >
								
							</td>
						</tr>
						
							<td>kode_absen_struktur</td>
							<td>
							
									<input type='text' name='kode_absen_struktur' class='form-control' style='width:100%;' value='"; echo $item["kode_absen_struktur"]; echo "' >
								
							</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view edit
			else if($_GET["act"] == "update"){
				
				$id = $this->input->post("id");
				$arrayPost = array(
				"nama_absen_struktur" => $this->input->post("nama_absen_struktur"),"nilai_absen_struktur" => $this->input->post("nilai_absen_struktur"),"jam_absen_struktur" => $this->input->post("jam_absen_struktur"),"kode_absen_struktur" => $this->input->post("kode_absen_struktur"),
				);
				$this->form_validation->set_rules("nama_absen_struktur", "nama_absen_struktur", "required");$this->form_validation->set_rules("nilai_absen_struktur", "nilai_absen_struktur", "required");$this->form_validation->set_rules("jam_absen_struktur", "jam_absen_struktur", "required");$this->form_validation->set_rules("kode_absen_struktur", "kode_absen_struktur", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->updateData("absen_struktur", $arrayPost, "id_absen_struktur = '$id'");
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
					"tampilData" => $this->crud_function_model->readData("absen_struktur", "", "id_absen_struktur like '%$_GET[id]%'  || nama_absen_struktur like '%$_GET[id]%' || nilai_absen_struktur like '%$_GET[id]%' || jam_absen_struktur like '%$_GET[id]%' || kode_absen_struktur like '%$_GET[id]%' ", "id_absen_struktur desc"),
					"idDb" => "id_absen_struktur"
				);
				$this->load->view("admin/content/absen_struktur/table", $queryDataRead);
			}// end search
		}// end else // pertama
	}
}
			