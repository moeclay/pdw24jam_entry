<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Origin: *");

class Realtime extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		// load model 45 row {result}
		// no_invoice, faktur_status
		$data = $this->App_model->gen2();
	 	echo json_encode($data);
	}
	
	public function apiscr($id='null'){
	    if($id=='null'){
	        $data = array(
	            'status' => '404',
	            'data'   => 'data kosong'
	        );
	        echo json_encode($data);
	    }else{
		    $ol = $this->App_model->apiscr($id);
		    echo json_encode($ol);
	    }
	}
}
