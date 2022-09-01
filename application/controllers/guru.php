<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class guru extends CI_Controller {
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
				"nama_guru" => $this->input->post("nama_guru"),
				"username" => $this->input->post("username"),
				"password" => sha1($this->input->post("password")),
				);
				$this->form_validation->set_rules("nama_guru", "nama_guru", "required");$this->form_validation->set_rules("username", "username", "required");$this->form_validation->set_rules("password", "password", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->insertData("guru", $arrayPost);
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
					"tampilData" => $this->crud_function_model->readData("guru", "", "", "id_guru desc"),
					"idDb" => "id_guru"
				);
				$this->load->view("admin/content/guru/table", $queryDataRead);
			} // end load
			else if($_GET["act"] == "delete"){
				
				$this->crud_function_model->deleteData("guru", "id_guru = $_GET[id]");
			} // end delete	
			else if($_GET["act"] == "view"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("guru", "", "id_guru = $_GET[id]", "id_guru desc"),
					"idDb" => "id_guru"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
					
						<tr>
							<td>nama_guru</td>
							<td>"; echo $item["nama_guru"]; echo "</td>
						</tr>
						
						<tr>
							<td>username</td>
							<td>"; echo $item["username"]; echo "</td>
						</tr>
						
						<tr>
							<td>password</td>
							<td>"; echo $item["password"]; echo "</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view
			else if($_GET["act"] == "viewEdit"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("guru", "", "id_guru = $_GET[id]", "id_guru desc"),
					"idDb" => "id_guru"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
						<tr>
							<input type='hidden' name='id' class='form-control' style='width:100%;' value='"; echo $item["id_guru"]; echo "' hidden>
						
							<td>nama_guru</td>
							<td>
							
									<input type='text' name='nama_guru' class='form-control' style='width:100%;' value='"; echo $item["nama_guru"]; echo "' >
								
							</td>
						</tr>
						
							<td>username</td>
							<td>
							
									<input type='text' name='username' class='form-control' style='width:100%;' value='"; echo $item["username"]; echo "' >
								
							</td>
						</tr>
						
							<td>password</td>
							<td>
							
									<input type='text' name='password' class='form-control' style='width:100%;' value='"; echo $item["password"]; echo "' >
								
							</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view edit
			else if($_GET["act"] == "update"){
				
				$id = $this->input->post("id");
				$arrayPost = array(
				"nama_guru" => $this->input->post("nama_guru"),
				"username" => $this->input->post("username"),
				"password" => sha1($this->input->post("password")),
				);
				$this->form_validation->set_rules("nama_guru", "nama_guru", "required");$this->form_validation->set_rules("username", "username", "required");$this->form_validation->set_rules("password", "password", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->updateData("guru", $arrayPost, "id_guru = '$id'");
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
					"tampilData" => $this->crud_function_model->readData("guru", "", "id_guru like '%$_GET[id]%'  || nama_guru like '%$_GET[id]%' || username like '%$_GET[id]%' || password like '%$_GET[id]%' ", "id_guru desc"),
					"idDb" => "id_guru"
				);
				$this->load->view("admin/content/guru/table", $queryDataRead);
			}// end search
		}// end else // pertama
	}
}
			