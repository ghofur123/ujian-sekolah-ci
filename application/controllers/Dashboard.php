<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
		if(empty($_SESSION['status_user'])){
			echo "<script>
			 window.location = 'login_siswa';
			 </script>";
		} else {	
		}
	}
	public function index()
	{
		$this->load->view('admin/page/header');
		$this->load->view('admin/page/left_menu');
		$this->load->view('admin/page/loader_cube');
		$this->load->view('admin/page/load');
		$this->load->view('admin/page/footer');
		
	}
}
