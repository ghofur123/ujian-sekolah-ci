<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrasi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("crud_function_model");
		$this->load->model("Function_model_manually");
		
	}
	public function index(){
		$this->Function_model_manually->readData("
	}