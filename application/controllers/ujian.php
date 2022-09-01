<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ujian extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
		$this->load->model("Function_model_manually");
		$this->load->library('session', 'url');
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
				"nama_ujian" => $this->input->post("nama_ujian"),
				"kelas_id" => $this->input->post("kelas_id"),
				"token" => $this->input->post("token"),
				"guru_id" => $this->input->post("guru_id"),
				"materi_id" => $this->input->post("materi_id"),
				"jumlah_ujian" => $this->input->post("jumlah_ujian"),
				"persen_multiple_coice" => $this->input->post("persen_multiple_coice"),
				"persen_essay" => $this->input->post("persen_essay"),
				"waktu" => $this->input->post("waktu"),
				"metode" => $this->input->post("metode"),
				"jenis_ujian" => $this->input->post("jenis_ujian_id"),
				);
				$this->form_validation->set_rules("nama_ujian", "nama_ujian", "required");
				$this->form_validation->set_rules("kelas_id", "kelas_id", "required");
				$this->form_validation->set_rules("token", "token", "required");
				$this->form_validation->set_rules("guru_id", "guru_id", "required");
				$this->form_validation->set_rules("materi_id", "materi_id", "required");
				$this->form_validation->set_rules("jumlah_ujian", "jumlah_ujian", "required");
				$this->form_validation->set_rules("persen_multiple_coice", "persen_multiple_coice", "required");
				$this->form_validation->set_rules("persen_essay", "persen_essay", "required");
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
				if(!empty($_GET["kelasId"])){
					$whr = "WHERE a.`kelas_id` = '$_GET[kelasId]'";
					$arraySession = array( 
						"kelas_session" => $_GET["kelasId"],
						);
					$this->session->set_userdata($arraySession);
				} else if(!empty($_GET["materiId"])) {
					$whr = "WHERE a.`kelas_id` = '$_SESSION[kelas_session]' AND a.`materi_id` = '$_GET[materiId]'";
					$arraySession = array( 
						"materi_session" => $_GET["materiId"],
						);
					$this->session->set_userdata($arraySession);
				} else if(!empty($_GET["jenisUjianId"])) {
					$whr = "WHERE a.`kelas_id` = '$_SESSION[kelas_session]' AND a.`materi_id` = '$_SESSION[materi_session]' AND a.`jenis_ujian` = '$_GET[jenisUjianId]'";
					$arraySession = array( 
						"jenis_ujian_session" => $_GET["jenisUjianId"],
						);
					$this->session->set_userdata($arraySession);
				} else {
					$whr ="";
				}
				$queryDataRead = array(
					"tampilData" => $this->Function_model_manually->readDataManuallyController("
					
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
					"),
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
						
						<tr>
							<td>persen_multiple_coice</td>
							<td>"; echo $item["persen_multiple_coice"]; echo "</td>
						</tr>
						
						<tr>
							<td>persen_essay</td>
							<td>"; echo $item["persen_essay"]; echo "</td>
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
						
							<td>kelas</td>
							<td>
							<select name='kelas_id' class='form-control'>
							";
							$queryDataReadKelas =  $this->crud_function_model->readData("kelas", "", "", "nama_kelas ASC");
							foreach($queryDataReadKelas as $kelasViewA){
								if($item["kelas_id"] == $kelasViewA["id_kelas"]){
									echo "
										<option selected value='$kelasViewA[id_kelas]'>$kelasViewA[nama_kelas] </option>
									";
								} else {
									echo "
										<option value='$kelasViewA[id_kelas]'>$kelasViewA[nama_kelas] </option>
									";
								}
								
							}
							echo "
							</select>
							</td>
						</tr>
						
							<td>token</td>
							<td>
							
									<input readonly type='text' name='token' class='form-control' style='width:100%;' value='"; echo $item["token"]; echo "' >
								
							</td>
						</tr>
						
							<td>guru</td>
							<td>
							
							<select name='guru_id' class='form-control'>
							";
							$queryDataReadGuru =  $this->crud_function_model->readData("guru", "", "", "nama_guru ASC");
							foreach($queryDataReadGuru as $guruViewA){
								if($item["guru_id"] == $guruViewA["id_guru"]){
									echo "
										<option selected value='$guruViewA[id_guru]'>$guruViewA[nama_guru] </option>
									";
								} else {
									echo "
										<option value='$guruViewA[id_guru]'>$guruViewA[nama_guru] </option>
									";
								}
								
							}
							echo "
							</select>
							</td>
						</tr>
						
							<td>materi</td>
							<td>
							
							<select name='materi_id' class='form-control'>
							";
							$queryDataReadMateri =  $this->crud_function_model->readData("materi", "", "", "nama_materi ASC");
							foreach($queryDataReadMateri as $materiViewA){
								if($item["materi_id"] == $materiViewA["id_materi"]){
									echo "
										<option selected value='$materiViewA[id_materi]'>$materiViewA[nama_materi] </option>
									";
								} else {
									echo "
										<option value='$materiViewA[id_materi]'>$materiViewA[nama_materi] </option>
									";
								}
								
							}
							echo "
							</select>
							</td>
						</tr>
						
							<td>jumlah_ujian</td>
							<td>
							
									<input type='text' name='jumlah_ujian' class='form-control' style='width:100%;' value='"; echo $item["jumlah_ujian"]; echo "' >
								
							</td>
						</tr>
						
							<td>persen_multiple_coice</td>
							<td>
							
									<input type='text' name='persen_multiple_coice' class='form-control' style='width:100%;' value='"; echo $item["persen_multiple_coice"]; echo "' >
								
							</td>
						</tr>
						
							<td>persen_essay</td>
							<td>
							
									<input type='text' name='persen_essay' class='form-control' style='width:100%;' value='"; echo $item["persen_essay"]; echo "' >
								
							</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view edit
			else if($_GET["act"] == "update"){
				
				$id = $this->input->post("id");
				$arrayPost = array(
				"nama_ujian" => $this->input->post("nama_ujian"),"kelas_id" => $this->input->post("kelas_id"),"token" => $this->input->post("token"),"guru_id" => $this->input->post("guru_id"),"materi_id" => $this->input->post("materi_id"),"jumlah_ujian" => $this->input->post("jumlah_ujian"),"persen_multiple_coice" => $this->input->post("persen_multiple_coice"),"persen_essay" => $this->input->post("persen_essay"),
				);
				$this->form_validation->set_rules("nama_ujian", "nama_ujian", "required");$this->form_validation->set_rules("kelas_id", "kelas_id", "required");$this->form_validation->set_rules("token", "token", "required");$this->form_validation->set_rules("guru_id", "guru_id", "required");$this->form_validation->set_rules("materi_id", "materi_id", "required");$this->form_validation->set_rules("jumlah_ujian", "jumlah_ujian", "required");$this->form_validation->set_rules("persen_multiple_coice", "persen_multiple_coice", "required");$this->form_validation->set_rules("persen_essay", "persen_essay", "required");
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
					"tampilData" => $this->Function_model_manually->readDataManuallyController("
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
						WHERE a.`nama_ujian` LIKE '%$_GET[id]%'
						  OR b.`nama_kelas` LIKE '%$_GET[id]%'
						  OR c.`nama_materi` LIKE '%$_GET[id]%'
						  OR d.`nama_guru` LIKE '%$_GET[id]%'
						ORDER BY a.`nama_ujian` ASC
					"),
					"idDb" => "id_ujian"
				);
				$this->load->view("admin/content/ujian/table", $queryDataRead);
			}// end search
			else if($_GET["act"] == "view_kelas"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("kelas", "", "", "nama_kelas ASC"),
					"idDb" => "id_bank_soal"
				);	
				$this->load->view("admin/content/ujian/kelas_select", $queryDataRead);
			} // end view
			else if($_GET["act"] == "view_materi"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("materi", "", "", "nama_materi ASC"),
					"idDb" => "id_bank_soal"
				);	
				$this->load->view("admin/content/ujian/materi_select", $queryDataRead);
			} // end view
			else if($_GET["act"] == "view_jenis_ujian"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("jenis_ujian", "", "", "nama_jenis_ujian ASC"),
					"idDb" => "id_bank_soal"
				);	
				$this->load->view("admin/content/ujian/jenis_ujian_select", $queryDataRead);
			} // end view
		}// end else // pertama
	}
}
			