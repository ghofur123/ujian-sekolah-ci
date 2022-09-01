<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ujian extends CI_Controller {
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
				"nama_ujian" => $this->input->post("nama_ujian"),"kelas_id" => $this->input->post("kelas_id"),"token" => $this->input->post("token"),"guru_id" => $this->input->post("guru_id"),"materi_id" => $this->input->post("materi_id"),"jumlah_ujian" => $this->input->post("jumlah_ujian"),
				);
				$this->form_validation->set_rules("nama_ujian", "nama_ujian", "required");$this->form_validation->set_rules("kelas_id", "kelas_id", "required");$this->form_validation->set_rules("token", "token", "required");$this->form_validation->set_rules("guru_id", "guru_id", "required");$this->form_validation->set_rules("materi_id", "materi_id", "required");$this->form_validation->set_rules("jumlah_ujian", "jumlah_ujian", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->insertData("ujian", $arrayPost);
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
					"tampilData" => $this->crud_function_model->readData("ujian", "", "kelas_id = $_GET[kelasId]", "id_ujian desc"),
					"idDb" => "id_ujian"
				);
				$this->load->view("admin/content/ujian/table", $queryDataRead);
			} // end load
			else if($_GET["act"] == "delete"){
				
				$this->crud_function_model->deleteData("ujian", "id_ujian = $_GET[id]");
			} // end delete	
			else if($_GET["act"] == "view"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("ujian", "", "id_ujian = $_GET[id]", "id_ujian desc"),
					"idDb" => "id_ujian"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
					
						<tr>
							<td>nama_ujian</td>
							<td>"; echo $item["nama_ujian"]; echo "</td>
						</tr>
						
						<tr>
							<td>kelas_id</td>
							<td>"; echo $item["kelas_id"]; echo "</td>
						</tr>
						
						<tr>
							<td>token</td>
							<td>"; echo $item["token"]; echo "</td>
						</tr>
						
						<tr>
							<td>guru_id</td>
							<td>"; echo $item["guru_id"]; echo "</td>
						</tr>
						
						<tr>
							<td>materi_id</td>
							<td>"; echo $item["materi_id"]; echo "</td>
						</tr>
						
						<tr>
							<td>jumlah_ujian</td>
							<td>"; echo $item["jumlah_ujian"]; echo "</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view
			else if($_GET["act"] == "viewEdit"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("ujian", "", "id_ujian = $_GET[id]", "id_ujian desc"),
					"idDb" => "id_ujian"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
						<tr>
							<input type='hidden' name='id' class='form-control' style='width:100%;' value='"; echo $item["id_ujian"]; echo "' hidden>
						
							<td>nama_ujian</td>
							<td>
							
									<input type='text' name='nama_ujian' class='form-control' style='width:100%;' value='"; echo $item["nama_ujian"]; echo "' >
								
							</td>
						</tr>
						
							<td>kelas_id</td>
							<td>
							
									<input type='text' name='kelas_id' class='form-control' style='width:100%;' value='"; echo $item["kelas_id"]; echo "' >
								
							</td>
						</tr>
						
							<td>token</td>
							<td>
							
									<input type='text' name='token' class='form-control' style='width:100%;' value='"; echo $item["token"]; echo "' >
								
							</td>
						</tr>
						
							<td>guru_id</td>
							<td>
							
									<input type='text' name='guru_id' class='form-control' style='width:100%;' value='"; echo $item["guru_id"]; echo "' >
								
							</td>
						</tr>
						
							<td>materi_id</td>
							<td>
							
									<input type='text' name='materi_id' class='form-control' style='width:100%;' value='"; echo $item["materi_id"]; echo "' >
								
							</td>
						</tr>
						
							<td>jumlah_ujian</td>
							<td>
							
									<input type='text' name='jumlah_ujian' class='form-control' style='width:100%;' value='"; echo $item["jumlah_ujian"]; echo "' >
								
							</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view edit
			else if($_GET["act"] == "update"){
				
				$id = $this->input->post("id");
				$arrayPost = array(
				"nama_ujian" => $this->input->post("nama_ujian"),"kelas_id" => $this->input->post("kelas_id"),"token" => $this->input->post("token"),"guru_id" => $this->input->post("guru_id"),"materi_id" => $this->input->post("materi_id"),"jumlah_ujian" => $this->input->post("jumlah_ujian"),
				);
				$this->form_validation->set_rules("nama_ujian", "nama_ujian", "required");$this->form_validation->set_rules("kelas_id", "kelas_id", "required");$this->form_validation->set_rules("token", "token", "required");$this->form_validation->set_rules("guru_id", "guru_id", "required");$this->form_validation->set_rules("materi_id", "materi_id", "required");$this->form_validation->set_rules("jumlah_ujian", "jumlah_ujian", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->updateData("ujian", $arrayPost, "id_ujian = '$id'");
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
					"tampilData" => $this->crud_function_model->readData("ujian", "", "id_ujian like '%$_GET[id]%'  || nama_ujian like '%$_GET[id]%' || kelas_id like '%$_GET[id]%' || token like '%$_GET[id]%' || guru_id like '%$_GET[id]%' || materi_id like '%$_GET[id]%' || jumlah_ujian like '%$_GET[id]%' ", "id_ujian desc"),
					"idDb" => "id_ujian"
				);
				$this->load->view("admin/content/ujian/table", $queryDataRead);
			}// end search
		}// end else // pertama
	}
}
			