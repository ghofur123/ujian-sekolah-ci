<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class materi extends CI_Controller {
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
				"nama_materi" => $this->input->post("nama_materi"),
				);
				$this->form_validation->set_rules("nama_materi", "nama_materi", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->insertData("materi", $arrayPost);
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
					"tampilData" => $this->crud_function_model->readData("materi", "", "", "id_materi desc"),
					"idDb" => "id_materi"
				);
				$this->load->view("admin/content/materi/table", $queryDataRead);
			} // end load
			else if($_GET["act"] == "delete"){
				
				$this->crud_function_model->deleteData("materi", "id_materi = $_GET[id]");
			} // end delete	
			else if($_GET["act"] == "view"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("materi", "", "id_materi = $_GET[id]", "id_materi desc"),
					"idDb" => "id_materi"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
					
						<tr>
							<td>nama_materi</td>
							<td>"; echo $item["nama_materi"]; echo "</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view
			else if($_GET["act"] == "viewEdit"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("materi", "", "id_materi = $_GET[id]", "id_materi desc"),
					"idDb" => "id_materi"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
						<tr>
							<input type='hidden' name='id' class='form-control' style='width:100%;' value='"; echo $item["id_materi"]; echo "' hidden>
						
							<td>nama_materi</td>
							<td>
							
									<input type='text' name='nama_materi' class='form-control' style='width:100%;' value='"; echo $item["nama_materi"]; echo "' >
								
							</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view edit
			else if($_GET["act"] == "update"){
				
				$id = $this->input->post("id");
				$arrayPost = array(
				"nama_materi" => $this->input->post("nama_materi"),
				);
				$this->form_validation->set_rules("nama_materi", "nama_materi", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->updateData("materi", $arrayPost, "id_materi = '$id'");
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
					"tampilData" => $this->crud_function_model->readData("materi", "", "id_materi like '%$_GET[id]%'  || nama_materi like '%$_GET[id]%' ", "id_materi desc"),
					"idDb" => "id_materi"
				);
				$this->load->view("admin/content/materi/table", $queryDataRead);
			}// end search
		}// end else // pertama
	}
}
			