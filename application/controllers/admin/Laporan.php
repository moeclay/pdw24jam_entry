<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	// method index
	public function index() {
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			redirect('admin/laporan2');
		}else{
			redirect('user');
		}
	}

	public function kalkulasidashboard(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			try{
				$path = 'dashboard.json';
				echo accesssecure($path);
			}catch(Exception $e){
				echo "Error : ".$e->getMessage();
			}
		}else{
			redirect('user');
		}	
	}

	public function kalkulasipenerimaan(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			try{
				$path = 'penerimaan_semua.json';
				echo accesssecure($path);
			}catch(Exception $e){
				echo "Error : ".$e->getMessage();
			}
		}else{
			redirect('user');
		}	
	}

	// laporan divisi
	public function kalkulasidivisidevelop(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			try{
				$path = 'divisi_develop.json';
				echo accesssecure($path);
			}catch(Exception $e){
				echo "Error : ".$e->getMessage();
			}
		}else{
			redirect('user');
		}	
	}
	public function kalkulasidivisibanner(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			try{
				$path = 'divisi_banner.json';
				echo accesssecure($path);
			}catch(Exception $e){
				echo "Error : ".$e->getMessage();
			}
		}else{
			redirect('user');
		}	
	}
	public function kalkulasidivisifotocopy(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			try{
				$path = 'divisi_fotocopy.json';
				echo accesssecure($path);
			}catch(Exception $e){
				echo "Error : ".$e->getMessage();
			}
		}else{
			redirect('user');
		}	
	}
	
	// --------------------------------------------------------------------------------------------------------------
	// REPAIR DASHBOARD 
	public function kalkulasihariberjalan(){
	    if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			try{
				// $path = 'fix_totalharianberjalan.json';
				// echo accesssecure($path);
				echo json_encode($this->App_model->graphberjalan14day());
			}catch(Exception $e){
				echo "Error : ".$e->getMessage();
			}
		}else{
			redirect('user');
		}
	}
	
	public function kalkulasibulanberjalan(){
	    if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			try{
				// $path = 'fix_totalbulanberjalan.json';
				// echo accesssecure($path);
				echo json_encode($this->App_model->graphbulanberjalan());
			}catch(Exception $e){
				echo "Error : ".$e->getMessage();
			}
		}else{
			redirect('user');
		}
	}
	
	public function kalkulasi(){
	    if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			try{
				$path = 'fix_database.json';
				echo accesssecure($path);
			}catch(Exception $e){
				echo "Error : ".$e->getMessage();
			}
		}else{
			redirect('user');
		}
	}
	
	public function kalkulasipersonal(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			try{
			    $path = 'fix_personal.json';
				echo accesssecure($path);
			}catch(Exception $e){
				echo "Error : ".$e->getMessage();
			}
		}else{
			redirect('user');
		}	
	}
	
	public function kalkulasidivisi(){
	    if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
	        try{
	            $path = 'fix_divisi.json';
	            echo accesssecure($path);
	        }catch(Exception $e){
	            echo "Error : ".$e->getMessage();
	        }
	    }else{
	        redirect('user');
	    }
	}
	
	public function kalkulasibulan(){
	    if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
	        try{
	            $path = 'fix_bulan.json';
	            echo accesssecure($path);
	        }catch(Exception $e){
	            echo "Error : ".$e->getMessage();
	        }
	    }else{
	        redirect('user');
	    }
	}
	
	
	// sales area
	public function kalkulasisales(){
	    if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
	        try{
	            $path = 'fix_sales.json';
	            echo accesssecure($path);
	        }catch(Exception $e){
	            echo "Error : ".$e->getMessage();
	        }
	    }else{
	        redirect('user');
	    }
	}
	
	
	// barang jadi
	public function kalkulasibarangjadi(){
	    if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
	        try{
	            $path = 'fix_barangjadi.json';
	            echo accesssecure($path);
	        }catch(Exception $e){
	            echo "Error : ".$e->getMessage();
	        }
	    }else{
	        redirect('user');
	    }
	}

}