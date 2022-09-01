<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_siswa extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
		$this->load->model("Function_model_manually");
	}
	public function index(){
	}
	public function load(){
		if(empty($_GET["act"])){
							
		} else {
			if($_GET["act"] == "insert"){
			
				$arrayPost = array(
				"nama_siswa" => $this->input->post("nama_siswa"),
				"nisn" => $this->input->post("nisn"),
				"nik" => $this->input->post("nik"),
				"kelas_id" => $this->input->post("kelas_id"),
				"jurusan_id" => $this->input->post("jurusan_id")
				);
				$this->form_validation->set_rules("nama_siswa", "nama_siswa", "required");$this->form_validation->set_rules("nisn", "nisn", "required");$this->form_validation->set_rules("nik", "nik", "required");$this->form_validation->set_rules("kelas_id", "kelas_id", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->insertData("data_siswa", $arrayPost);
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
				if(!empty($_GET["jurusanId"])){
					$jurusanGet = "AND a.`jurusan_id` = $_GET[jurusanId]";
				} else {
					$jurusanGet = "";
				}
				$queryDataRead = array(
					"tampilData" => $this->Function_model_manually->readDataManuallyController("
						SELECT
						  *
						FROM
						  data_siswa AS a
						  JOIN kelas AS b
							ON a.`kelas_id` = b.`id_kelas`
						WHERE b.`id_kelas` = $_GET[kelasId] ".$jurusanGet."
						ORDER BY a.`nama_siswa` ASC
					"),
					"idDb" => "id_data_siswa"
				);
				$this->load->view("admin/content/data_siswa/table", $queryDataRead);
			} // end load
			else if($_GET["act"] == "load2"){
				if(!empty($_GET["jurusan_id"])){
					if($_GET["jurusan_id"] == "clear"){
						$wr="";
					} else {
						$wr = "AND a.`jurusan_id` = $_GET[jurusan_id]";
					}
				} else {
					$wr="";
				}
				$queryDataRead = array(
					"tampilData" => $this->Function_model_manually->readDataManuallyController("
						SELECT
						  *
						FROM
						  data_siswa AS a
						  JOIN kelas AS b
							ON a.`kelas_id` = b.`id_kelas`
						WHERE b.`id_kelas` = $_GET[kelasId] ".$wr."
						ORDER BY a.`nama_siswa` ASC
					"),
					"idDb" => "id_data_siswa"
				);
				$this->load->view("admin/content/data_siswa/table2", $queryDataRead);
			} // end load
			else if($_GET["act"] == "load3"){
				if(!empty($_GET["jurusan_id"])){
					if($_GET["jurusan_id"] == "clear"){
						$wr="";
					} else {
						$wr = "AND a.`jurusan_id` = $_GET[jurusan_id]";
					}
				} else {
					$wr="";
				}
				$queryDataRead = array(
					"tampilData" => $this->Function_model_manually->readDataManuallyController("
						SELECT
						  *
						FROM
						  data_siswa AS a
						  JOIN kelas AS b
							ON a.`kelas_id` = b.`id_kelas`
						WHERE b.`id_kelas` = $_GET[kelasId] ".$wr."
						ORDER BY a.`nama_siswa` ASC
					"),
					"idDb" => "id_data_siswa"
				);
				$this->load->view("admin/content/data_siswa/table3", $queryDataRead);
			} // end load
			else if($_GET["act"] == "delete"){
				
				$this->crud_function_model->deleteData("data_siswa", "id_data_siswa = $_GET[id]");
			} // end delete	
			else if($_GET["act"] == "view"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("data_siswa", "", "id_data_siswa = $_GET[id]", "id_data_siswa desc"),
					"idDb" => "id_data_siswa"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
					
						<tr>
							<td>nama_siswa</td>
							<td>"; echo $item["nama_siswa"]; echo "</td>
						</tr>
						
						<tr>
							<td>nisn</td>
							<td>"; echo $item["nisn"]; echo "</td>
						</tr>
						
						<tr>
							<td>nik</td>
							<td>"; echo $item["nik"]; echo "</td>
						</tr>
						
						<tr>
							<td>kelas_id</td>
							<td>"; 
							
							echo $item["kelas_id"]; echo "</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view
			else if($_GET["act"] == "viewEdit"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("data_siswa", "", "id_data_siswa = $_GET[id]", "id_data_siswa desc"),
					"idDb" => "id_data_siswa"
				);	
				echo "<table class='table'>"; 
				foreach($queryDataRead["tampilData"] as $item){
					echo "
						<tr>
							<input type='hidden' name='id' class='form-control' style='width:100%;' value='"; echo $item["id_data_siswa"]; echo "' hidden>
						
							<td>nama_siswa</td>
							<td>
							
									<input type='text' name='nama_siswa' class='form-control' style='width:100%;' value='"; echo $item["nama_siswa"]; echo "' >
								
							</td>
						</tr>
						
							<td>nisn</td>
							<td>
							
									<input type='text' name='nisn' class='form-control' style='width:100%;' value='"; echo $item["nisn"]; echo "' >
								
							</td>
						</tr>
						
							<td>nik</td>
							<td>
							
									<input type='text' name='nik' class='form-control' style='width:100%;' value='"; echo $item["nik"]; echo "' >
								
							</td>
						</tr>
						
							<td>kelas_id</td>
							<td>
							";
							echo "<select class='form-control select-kelas-form' name='kelas_id' style='width:60%;'>"; 
							$jurusan = $this->crud_function_model->readData("kelas", "", "", "nama_kelas ASC");
							foreach($jurusan as $jur){
								if($jur["id_kelas"] == $item["kelas_id"]){
									echo "<option selected value='"; echo $jur["id_kelas"]; echo "'>"; echo $jur["nama_kelas"]; echo "</option>";
								}else {
									echo "<option value='"; echo $jur["id_kelas"]; echo "'>"; echo $jur["nama_kelas"]; echo "</option>";
								}
							}
							echo "</select>";
							echo "</td>
							<td>
							";
							echo "<select class='form-control select-jurusan-form' name='jurusan_id' style='width:60%;'>"; 
							$jurusan2 = $this->crud_function_model->readData("jurusan", "", "", "nama_jurusan ASC");
							foreach($jurusan2 as $jur2){
								if($jur2["id_jurusan"] == $item["jurusan_id"]){
									echo "<option selected value='"; echo $jur2["id_jurusan"]; echo "'>"; echo $jur2["nama_jurusan"]; echo "</option>";
								}else {
									echo "<option value='"; echo $jur2["id_jurusan"]; echo "'>"; echo $jur2["nama_jurusan"]; echo "</option>";
								}
							}
							echo "</select>";
							echo "</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view edit
			else if($_GET["act"] == "update"){
				
				$id = $this->input->post("id");
				$arrayPost = array(
				"nama_siswa" => $this->input->post("nama_siswa"),
				"nisn" => $this->input->post("nisn"),
				"nik" => $this->input->post("nik"),
				"kelas_id" => $this->input->post("kelas_id"),
				"jurusan_id" => $this->input->post("jurusan_id")
				);
				$this->form_validation->set_rules("nama_siswa", "nama_siswa", "required");$this->form_validation->set_rules("nisn", "nisn", "required");$this->form_validation->set_rules("nik", "nik", "required");$this->form_validation->set_rules("kelas_id", "kelas_id", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->updateData("data_siswa", $arrayPost, "id_data_siswa = '$id'");
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
					"tampilData" => $this->Function_model_manually->readDataManuallyController("
						SELECT
						  *
						FROM
						  data_siswa AS a
						  JOIN kelas AS b
							ON a.`kelas_id` = b.`id_kelas`
						WHERE a.`nama_siswa` LIKE '%$_GET[id]%'
						  OR b.`nama_kelas` LIKE '%$_GET[id]%'
						ORDER BY a.`nama_siswa` ASC
					"),
					"idDb" => "id_data_siswa"
				);
				$this->load->view("admin/content/data_siswa/table", $queryDataRead);
			}// end search
			else if($_GET["act"] == "view_kelas"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("kelas", "", "", "nama_kelas ASC"),
					"idDb" => "id_bank_soal"
				);	
				echo "<select class='form-control select-kelas-form' name='kelas_id' style='width:60%;'>"; 
				echo "<option value=''>Pilih Kelas</option>";
				foreach($queryDataRead["tampilData"] as $item){
					echo "
						<option value='"; echo $item["id_kelas"]; echo "'>"; echo $item["nama_kelas"]; echo "</option>
					"; 
				}
				echo "</select>";
			} // end view
			else if($_GET["act"] == "view_jurusan"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("jurusan", "", "", "nama_jurusan ASC"),
					"idDb" => "id_bank_soal"
				);	
				$this->load->view("admin/content/data_siswa/jurusan", $queryDataRead);
			} // end view
			
			
		}// end else // pertama
	}
}
			