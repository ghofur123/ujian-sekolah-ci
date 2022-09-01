<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_modul extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->database();
		// $this->load->model("crud_function_model");
		// if(empty($_SESSION['username'])){
		// 	redirect('../login_guru');
		// } else {	
		// }
	}
	public function index()
	{
		$this->load->view('admin/content/setting/header');
		$queryDataRead = array(
			"postAction" => $this->input->post('for'),
			"jumlah" => $this->input->post('jumlah')
		);
		$this->load->view('admin/content/setting/depan', $queryDataRead);
		$this->load->view('admin/page/footer');
		
	}
}
