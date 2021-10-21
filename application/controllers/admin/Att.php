<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');


class Att extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index($id=null){
		if(isset($id)){
			$d['divisi'] = $id;
		}else{
			// default 'D01 = Desain'
			$d['divisi'] = 'D01';
		}

		$d['list_divisi']  = $this->Absensi_model->getAllDivisi();
		$d['karyawan']  = $this->Absensi_model->getKaryawanDivisiAktif($d['divisi']);

		$d['main_page'] = 'admin/jadwal';
		$this->load->view('admin/template', $d);
	}

	public function getEvent($iddivisi=null){
		try{
			if(isset($iddivisi)){
				// require param year
				$listEvent = $this->Absensi_model->getEvent($iddivisi);
				foreach($listEvent as $row){
					$data[] = array(
					  'id'    => $row->id,
					  'title' => $row->title,
					  'start' => $row->start_event,
					  'end'   => $row->end_event,
					  'color' => $row->color
					);
				}
				echo json_encode($data);
			}else{
				echo json_encode([]);
			}
		}catch(Exception $e){
			echo "Error : ".$e->getMessage();
		}
	}

	public function addEvent(){
		if(isset($_POST["title"])){
		  	$dataInsert = array(
		  	   'id_divisi' => $_POST['divisi_karyawan'],
		  	   'id_karyawan' => $_POST['id_karyawan'],
			   'title'  => $_POST['title'],
			   'start_event' => $_POST['start'],
			   'end_event' => $_POST['end'],
			   'color' => $_POST['color']
		  	);
		  	try{
		  		$this->App_model->tambah_data('events', $dataInsert);
		  		echo json_encode('success');
		  	}catch(Error $e){
		  		echo json_encode('error');
		  	}
		}
	}

	public function updateEvent(){
		if(isset($_POST["id"])){
			$where = array('id' => $_POST['id']);
		  	$dataUpdate = array(
			   'start_event' => $_POST['start'],
			   'end_event' => $_POST['end']
		  	);
		  	try{
		  		$this->App_model->ubah_data('events', $dataUpdate, $where);
		  		echo json_encode('success');
		  	}catch(Error $e){
		  		echo json_encode('error');
		  	}
		}
	}

	public function deleteEvent(){
		if(isset($_POST["id"])){
			$where = array('id' => $_POST['id']);
		  	try{
		  		$this->App_model->hapus_data('events', $where);
		  		echo json_encode('success');
		  	}catch(Error $e){
		  		echo json_encode('error');
		  	}
		}
	}
}