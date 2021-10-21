<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan2 extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

    // dashboard
	public function index() {
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$this->load->view('dashboard/home');
		}else{
			redirect('user');
		}
	}


	// kinerja personal
	public function personalkinerja(){
	    if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$this->load->view('dashboard/personal_kinerja');
		}else{
			redirect('user');
		}
	}
	public function personalrupiah(){
	    if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$this->load->view('dashboard/personal_point');
		}else{
			redirect('user');
		}
	}
	// sales area
	public function sales(){
	    if($this->session->userdata('is_logged_in') && $this->session->userdata('status') == 'admin'){
	        $this->load->view('dashboard/sales');
	    }else{
	        redirect('user');
	    }
	}
	public function salespoint(){
	    if($this->session->userdata('is_logged_in') && $this->session->userdata('status') == 'admin'){
	        $this->load->view('dashboard/sales_point');
	    }else{
	        redirect('user');
	    }
	}
	

	// department/divisi
	public function dept_semua(){
	    if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$this->load->view('dashboard/dept_semua');
		}else{
			redirect('user');
		}
	}
	// divisi develop
	public function dept_develop(){
	    if($this->session->userdata('is_logged_in') && $this->session->userdata('status') == 'admin'){
	        $this->load->view('dashboard/dept_develop');
	    }else{
	        redirect('user');
	    }
	}
	// divisi banner
	public function dept_banner(){
	    if($this->session->userdata('is_logged_in') && $this->session->userdata('status') == 'admin'){
	        $this->load->view('dashboard/dept_banner');
	    }else{
	        redirect('user');
	    }
	}
	// divisi penjilidan
	public function dept_penjilidan(){
	    if($this->session->userdata('is_logged_in') && $this->session->userdata('status') == 'admin'){
	        $this->load->view('dashboard/dept_penjilidan');
	    }else{
	        redirect('user');
	    }
	}
	// divisi bengkel buku
	public function dept_bengkel_buku(){
	    if($this->session->userdata('is_logged_in') && $this->session->userdata('status') == 'admin'){
	        $this->load->view('dashboard/dept_bengkel_buku');
	    }else{
	        redirect('user');
	    }
	}
	// divisi creative
	public function dept_creative(){
	    if($this->session->userdata('is_logged_in') && $this->session->userdata('status') == 'admin'){
	        $this->load->view('dashboard/dept_creative');
	    }else{
	        redirect('user');
	    }
	}
	// divisi fotocopy
	public function dept_fotocopy(){
	    if($this->session->userdata('is_logged_in') && $this->session->userdata('status') == 'admin'){
	        $this->load->view('dashboard/dept_fotocopy');
	    }else{
	        redirect('user');
	    }
	}
	// barang jadi
	public function barangjadi(){
	    if($this->session->userdata('is_logged_in') && $this->session->userdata('status') == 'admin'){
	        $this->load->view('dashboard/barangjadi');
	    }else{
	        redirect('user');
	    }
	}


    // bulan
    public function bulan(){
	    if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$this->load->view('dashboard/bulan');
		}else{
			redirect('user');
		}
	}
	
}