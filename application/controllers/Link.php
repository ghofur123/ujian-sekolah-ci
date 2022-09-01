<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
		/*if(empty($_SESSION['username'])){
			redirect('login');
		} else {	
		}*/
	}
	public function index()
	{
		if(empty($_GET)){}else {
			if($this->input->get('dashboard') == 'bank_soal'){
				$this->load->view('admin/content/bank_soal/depan');
			}
			else if($this->input->get('dashboard') == 'data_siswa'){
				$this->load->view('admin/content/data_siswa/depan');
			}
			else if($this->input->get('dashboard') == 'guru'){
				$this->load->view('admin/content/guru/depan');
			}
			else if($this->input->get('dashboard') == 'kelas'){
				$this->load->view('admin/content/kelas/depan');
			}
			else if($this->input->get('dashboard') == 'materi'){
				$this->load->view('admin/content/materi/depan');
			}
			else if($this->input->get('dashboard') == 'ujian'){
				$this->load->view('admin/content/ujian/depan');
			}
			else if($this->input->get('dashboard') == 'bank_soal_essay'){
				$this->load->view('admin/content/bank_soal_essay/depan');
			}
			else if($this->input->get('dashboard') == 'soal_essay'){
				$this->load->view('siswa/a/halaman_soal_essay');
			}
			else if($this->input->get('dashboard') == 'progres_nilai'){
				$this->load->view('siswa/a/progress_nilai');
			}
			else if($this->input->get('dashboard') == 'nilai_bank_soal'){
				$this->load->view('admin/content/penilayan/a/nilai_bank_soal');
			}
			else if($this->input->get('dashboard') == 'nilai_bank_soal_essay'){
				$this->load->view('admin/content/penilayan/a/nilai_bank_soal_essay');
			}
			else if($this->input->get('dashboard') == 'profile_sekolah'){
				$this->load->view('admin/content/profile_sekolah/depan');
			}
			else if($this->input->get('dashboard') == 'jurusan'){
				$this->load->view('admin/content/jurusan/depan');
			}
			else if($this->input->get('dashboard') == 'save_nilai'){
				$this->load->view('admin/content/save_nilai/depan');
			}
			else if($this->input->get('dashboard') == 'jurusan'){
				$this->load->view('admin/content/jurusan/depan');
			}
			else if($this->input->get('dashboard') == 'absensi'){
				$this->load->view('admin/content/absensi/depan');
			}
			else if($this->input->get('dashboard') == 'jenis_ujian'){
				$this->load->view('admin/content/jenis_ujian/depan');
			}
			else if($this->input->get('dashboard') == 'absen_struktur'){
				$this->load->view('admin/content/absen_struktur/depan');
			}
			else if($this->input->get('dashboard') == 'absen_input_guru'){
				$this->load->view('admin/content/absen_input_guru/depan');
			}
			//untuk siswa
			// else if($this->input->get('dashboard') == 'halaman_siswa'){
				// $this->load->view('siswa/a/halaman_soal');
			// }
			else if($this->input->get('dashboard') == 'halaman_siswa'){
				if($_SESSION["metode"] == 1){
					$this->load->view('siswa/a/halaman_soal');
				} else if($_SESSION["metode"] == 2){
					$this->load->view('siswa/a/halaman_soal');
				} else if($_SESSION["metode"] == 3){
					$this->load->view('siswa/b/halaman_soal');
				} else {
					$this->load->view('siswa/a/halaman_soal');
				}
				
			}
		} 
			
	}
}
