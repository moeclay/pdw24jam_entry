<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct(){
		parent::__construct();

		// status member
		if($this->session->userdata('is_logged_in')){
		    $this->session->sess_destroy();
    		$this->session->unset_userdata('user_name');
    		$this->session->unset_userdata('id_user');
    		$this->session->unset_userdata('nama_lengkap');
    		$this->session->unset_userdata('status');
    		$this->session->unset_userdata('is_logged_in');
    		redirect('app');
		}
	}

	public function index()
	{
		$this->load->view('app');
	}
}
