<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile_sekolah extends CI_Controller {
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
				"nama" => $this->input->post("nama"),"kode" => $this->input->post("kode"),"alamat" => $this->input->post("alamat"),"kepsek" => $this->input->post("kepsek"),"no_tlp" => $this->input->post("no_tlp"),
				);
				$this->form_validation->set_rules("nama", "nama", "required");$this->form_validation->set_rules("kode", "kode", "required");$this->form_validation->set_rules("alamat", "alamat", "required");$this->form_validation->set_rules("kepsek", "kepsek", "required");$this->form_validation->set_rules("no_tlp", "no_tlp", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->insertData("profile_sekolah", $arrayPost);
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
					"tampilData" => $this->crud_function_model->readData("profile_sekolah", "", "", "id_profile_sekolah desc"),
					"idDb" => "id_profile_sekolah"
				);
				$this->load->view("admin/content/profile_sekolah/table", $queryDataRead);
			} // end load
			else if($_GET["act"] == "delete"){
				
				$this->crud_function_model->deleteData("profile_sekolah", "id_profile_sekolah = $_GET[id]");
			} // end delete	
			else if($_GET["act"] == "view"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("profile_sekolah", "", "id_profile_sekolah = $_GET[id]", "id_profile_sekolah desc"),
					"idDb" => "id_profile_sekolah"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
					
						<tr>
							<td>nama</td>
							<td>"; echo $item["nama"]; echo "</td>
						</tr>
						
						<tr>
							<td>kode</td>
							<td>"; echo $item["kode"]; echo "</td>
						</tr>
						
						<tr>
							<td>alamat</td>
							<td>"; echo $item["alamat"]; echo "</td>
						</tr>
						
						<tr>
							<td>kepsek</td>
							<td>"; echo $item["kepsek"]; echo "</td>
						</tr>
						
						<tr>
							<td>no_tlp</td>
							<td>"; echo $item["no_tlp"]; echo "</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view
			else if($_GET["act"] == "viewEdit"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("profile_sekolah", "", "id_profile_sekolah = $_GET[id]", "id_profile_sekolah desc"),
					"idDb" => "id_profile_sekolah"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
						<tr>
							<input type='hidden' name='id' class='form-control' style='width:100%;' value='"; echo $item["id_profile_sekolah"]; echo "' hidden>
						
							<td>nama</td>
							<td>
							
									<input type='text' name='nama' class='form-control' style='width:100%;' value='"; echo $item["nama"]; echo "' >
								
							</td>
						</tr>
						
							<td>kode</td>
							<td>
							
									<input type='text' name='kode' class='form-control' style='width:100%;' value='"; echo $item["kode"]; echo "' >
								
							</td>
						</tr>
						
							<td>alamat</td>
							<td>
							
									<input type='text' name='alamat' class='form-control' style='width:100%;' value='"; echo $item["alamat"]; echo "' >
								
							</td>
						</tr>
						
							<td>kepsek</td>
							<td>
							
									<input type='text' name='kepsek' class='form-control' style='width:100%;' value='"; echo $item["kepsek"]; echo "' >
								
							</td>
						</tr>
						
							<td>no_tlp</td>
							<td>
							
									<input type='text' name='no_tlp' class='form-control' style='width:100%;' value='"; echo $item["no_tlp"]; echo "' >
								
							</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view edit
			else if($_GET["act"] == "update"){
				
				$id = $this->input->post("id");
				$arrayPost = array(
				"nama" => $this->input->post("nama"),"kode" => $this->input->post("kode"),"alamat" => $this->input->post("alamat"),"kepsek" => $this->input->post("kepsek"),"no_tlp" => $this->input->post("no_tlp"),
				);
				$this->form_validation->set_rules("nama", "nama", "required");$this->form_validation->set_rules("kode", "kode", "required");$this->form_validation->set_rules("alamat", "alamat", "required");$this->form_validation->set_rules("kepsek", "kepsek", "required");$this->form_validation->set_rules("no_tlp", "no_tlp", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->updateData("profile_sekolah", $arrayPost, "id_profile_sekolah = '$id'");
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
					"tampilData" => $this->crud_function_model->readData("profile_sekolah", "", "id_profile_sekolah like '%$_GET[id]%'  || nama like '%$_GET[id]%' || kode like '%$_GET[id]%' || alamat like '%$_GET[id]%' || kepsek like '%$_GET[id]%' || no_tlp like '%$_GET[id]%' ", "id_profile_sekolah desc"),
					"idDb" => "id_profile_sekolah"
				);
				$this->load->view("admin/content/profile_sekolah/table", $queryDataRead);
			}// end search
		}// end else // pertama
	}
}
			