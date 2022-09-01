<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
	}
	public function log(){
		if($_SESSION["status_user"] == "guru"){
			$this->session->sess_destroy();
			 echo "<script>
			 window.localStorage.clear();
			 window.location = '../login_guru';
			 </script>";
		} else {
			$this->session->sess_destroy();
			 echo "<script>
			 window.localStorage.clear();
			 window.location = '../login_siswa';
			 </script>";
		}
	}
}
			