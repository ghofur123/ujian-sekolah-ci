<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bank_soal extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
		$this->load->helper(array('form', 'url'));
	}
	public function index(){
	}
	public function load(){
		if(empty($_GET["act"])){
							
		} else {
			if($_GET["act"] == "insert"){
			
				$arrayPost = array(
				"soal" => $this->input->post("soal"),
				"a" => $this->input->post("a"),
				"b" => $this->input->post("b"),
				"c" => $this->input->post("c"),
				"d" => $this->input->post("d"),
				"e" => $this->input->post("e"),
				"ujian_id" => $this->input->post("ujian_id"),
				"jawaban_soal" => $this->input->post("jawaban_soal"),
				);
				$this->form_validation->set_rules("soal", "soal", "required");
				$this->form_validation->set_rules("a", "a", "required");
				$this->form_validation->set_rules("b", "b", "required");
				$this->form_validation->set_rules("c", "c", "required");
				$this->form_validation->set_rules("d", "d", "required");
				$this->form_validation->set_rules("e", "e", "required");
				$this->form_validation->set_rules("ujian_id", "ujian_id", "required");
				$this->form_validation->set_rules("jawaban_soal", "jawaban_soal", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->insertData("bank_soal", $arrayPost);
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
				
				$whrr = array(
						"ujian_id" => $_GET["idUjian"],
					);
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("bank_soal", "", $whrr, "id_bank_soal ASC"),
					"idDb" => "id_bank_soal"
				);
				$this->load->view("admin/content/bank_soal/table", $queryDataRead);
			} // end load
			else if($_GET["act"] == "delete"){
				
				$this->crud_function_model->deleteData("bank_soal", "id_bank_soal = $_GET[id]");
			} // end delete	
			else if($_GET["act"] == "view"){
				$queryDataRead = $this->crud_function_model->readDataManuallyFunction("
				
				SELECT
				  a.`soal`,
				  a.`a`,
				  a.`b`,
				  a.`c`,
				  a.`d`,
				  a.`e`,
				  a.`jawaban_soal`,
				  b.`nama_ujian`
				FROM
				  bank_soal AS a
				  JOIN ujian AS b
					ON a.`ujian_id` = b.`id_ujian`
				WHERE a.`id_bank_soal` = '$_GET[id]'
				
				");
				echo "<table class='table'>"; 
				foreach($queryDataRead as $item){
					echo "
					
						<tr>
							<td>soal</td>
							<td>"; echo $item["soal"]; echo "</td>
						</tr>
						
						<tr>
							<td>a</td>
							<td>"; echo $item["a"]; echo "</td>
						</tr>
						
						<tr>
							<td>b</td>
							<td>"; echo $item["b"]; echo "</td>
						</tr>
						
						<tr>
							<td>c</td>
							<td>"; echo $item["c"]; echo "</td>
						</tr>
						
						<tr>
							<td>d</td>
							<td>"; echo $item["d"]; echo "</td>
						</tr>
						
						<tr>
							<td>e</td>
							<td>"; echo $item["e"]; echo "</td>
						</tr>
						
						<tr>
							<td>Nama Ujian</td>
							<td>"; echo $item["nama_ujian"]; echo "</td>
						</tr>
						
						<tr>
							<td>Jawaban</td>
							<td>"; echo $item["jawaban_soal"]; echo "</td>
						</tr>
						
					"; 
				}
				echo "</table>";
			} // end view
			else if($_GET["act"] == "viewEdit"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("bank_soal", "", "id_bank_soal = $_GET[id]", "id_bank_soal desc"),
					"idDb" => "id_bank_soal"
				);	
				$this->load->view("admin/content/bank_soal/edit", $queryDataRead);
			} // end view edit
			else if($_GET["act"] == "update"){
				
				$id = $this->input->post("id");
				$arrayPost = array(
				"soal" => $this->input->post("soal"),"a" => $this->input->post("a"),"b" => $this->input->post("b"),"c" => $this->input->post("c"),"d" => $this->input->post("d"),"e" => $this->input->post("e"),"ujian_id" => $this->input->post("ujian_id"),"jawaban_soal" => $this->input->post("jawaban_soal"),
				);
				$this->form_validation->set_rules("soal", "soal", "required");
				$this->form_validation->set_rules("a", "a", "required");
				$this->form_validation->set_rules("b", "b", "required");
				$this->form_validation->set_rules("c", "c", "required");
				$this->form_validation->set_rules("d", "d", "required");
				$this->form_validation->set_rules("e", "e", "required");
				$this->form_validation->set_rules("ujian_id", "ujian_id", "required");
				$this->form_validation->set_rules("jawaban_soal", "jawaban_soal", "required");
				if($this->form_validation->run() == true){
					$this->crud_function_model->updateData("bank_soal", $arrayPost, "id_bank_soal = '$id'");
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
					"tampilData" => $this->crud_function_model->readData("bank_soal", "", "ujian_id = $_GET[ujian_id] && id_bank_soal like '%$_GET[id]%'  || soal like '%$_GET[id]%' || a like '%$_GET[id]%' || b like '%$_GET[id]%' || c like '%$_GET[id]%' || d like '%$_GET[id]%' || e like '%$_GET[id]%'", "id_bank_soal desc"),
					"idDb" => "id_bank_soal"
				);
				$this->load->view("admin/content/bank_soal/table", $queryDataRead);
			}// end search	
			else if($_GET["act"] == "view_kelas"){
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("kelas", "", "", "nama_kelas ASC"),
					"idDb" => "id_bank_soal"
				);	
				$this->load->view("admin/content/bank_soal/kelas_select", $queryDataRead);
			} // end view
			else if($_GET["act"] == "view_ujian"){
				$where = array(
					"kelas_id" => $_GET["kelasId"]
				);
				$queryDataRead = array(
					"tampilData" => $this->crud_function_model->readData("ujian", "", $where, "nama_ujian ASC"),
					"idDb" => "id_bank_soal"
				);	
				$this->load->view("admin/content/bank_soal/ujian_select", $queryDataRead);
			} // end view
		}// end else // pertama
	}
	public function upload_soal_exel(){
		// validasi judul
			error_reporting(1);
            // config upload
            $config['upload_path'] = './upload_file/';
            $config['allowed_types'] = 'xls';
            $config['max_size'] = '10000';
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('upload_soal')) {
                echo $this->upload->display_errors();
                
            } else {
				$upload_data=  $this->upload->data();
				$this->load->library('Excel_reader');
				
				//tentukan file
				$this->excel_reader->setOutputEncoding('230787');
				$file = $upload_data['full_path'];
				$this->excel_reader->read($file);
				
				
				// array data
				$arr = array(
					"data" => $this->excel_reader->sheets[0]
				);
				$data = $this->excel_reader->sheets[0];
				$this->load->view("admin/content/bank_soal/exel_convert", $arr);
				unlink($file);
			}
			
	}
	public function upload_soal_exel2(){
		if($_GET["pg"] == 1){
			// validasi judul
			error_reporting(1);
            // config upload
            $config['upload_path'] = './upload_file/';
            $config['allowed_types'] = 'xls';
            $config['max_size'] = '10000';
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('upload_soal')) {
                echo $this->upload->display_errors();
                
            } else {
				if(empty($this->input->get("ujian_id"))){
					echo "Ujian Belum Di Pilih";
				} else {
					$upload_data=  $this->upload->data();
					$this->load->library('Excel_reader');
					
					//tentukan file
					$this->excel_reader->setOutputEncoding('230787');
					$file = $upload_data['full_path'];
					$this->excel_reader->read($file);
					
					
					// array data
					$arr = array(
						"data" => $this->excel_reader->sheets[0]
					);
					$data = $this->excel_reader->sheets[0];
					$dataexcel = Array();
					$no=-1;
					for ($i = 1; $i <= $data['numRows']; $i++) {
						$no++;
						if($data['cells'][$i][1] == "soal"){}
						else {
							$dataInsert = array(
								"soal" => $data['cells'][$i][1],
								"a" => $data['cells'][$i][2],
								"b" => $data['cells'][$i][3],
								"c" => $data['cells'][$i][4],
								"d" => $data['cells'][$i][5],
								"e" => $data['cells'][$i][6],
								"ujian_id" => $this->input->get("ujian_id"),
								"jawaban_soal" => $data['cells'][$i][7],
							);
							$this->crud_function_model->insertData("bank_soal", $dataInsert);
							echo "Soal berhasil di input.. untuk melihat kelengkapan soal untuk di cek kembali";
						}
					}
					unlink($file);
				}
				
			}
		} else {}
	}
}
			