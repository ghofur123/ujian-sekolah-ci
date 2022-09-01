<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {
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
				"nama_jurusan" => $this->input->post("nama_jurusan"),
				);
				$this->form_validation->set_rules("nama_jurusan", "nama_jurusan", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->insertData("jurusan", $arrayPost);
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
					"tampilData" => $this->crud_function_model->readData("jurusan", "", "", "id_jurusan desc"),
					"idDb" => "id_jurusan"
				);
				$this->load->view("admin/content/jurusan/table", $queryDataRead);
			} // end load
			else if($_GET["act"] == "delete"){
				
				$this->crud_function_model->deleteData("jurusan", "id_jurusan = $_GET[id]");
			} // end delete	
			else if($_GET["act"] == "view"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("jurusan", "", "id_jurusan = $_GET[id]", "id_jurusan desc"),
					"idDb" => "id_jurusan"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
					
						<tr>
							<td>nama_jurusan</td>
							<td>"; echo $item["nama_jurusan"]; echo "</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view
			else if($_GET["act"] == "viewEdit"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("jurusan", "", "id_jurusan = $_GET[id]", "id_jurusan desc"),
					"idDb" => "id_jurusan"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
						<tr>
							<input type='hidden' name='id' class='form-control' style='width:100%;' value='"; echo $item["id_jurusan"]; echo "' hidden>
						
							<td>nama_jurusan</td>
							<td>
							
									<input type='text' name='nama_jurusan' class='form-control' style='width:100%;' value='"; echo $item["nama_jurusan"]; echo "' >
								
							</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view edit
			else if($_GET["act"] == "update"){
				
				$id = $this->input->post("id");
				$arrayPost = array(
				"nama_jurusan" => $this->input->post("nama_jurusan"),
				);
				$this->form_validation->set_rules("nama_jurusan", "nama_jurusan", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->updateData("jurusan", $arrayPost, "id_jurusan = '$id'");
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
					"tampilData" => $this->crud_function_model->readData("jurusan", "", "id_jurusan like '%$_GET[id]%'  || nama_jurusan like '%$_GET[id]%' ", "id_jurusan desc"),
					"idDb" => "id_jurusan"
				);
				$this->load->view("admin/content/jurusan/table", $queryDataRead);
			}// end search
		}// end else // pertama
	}
}
			