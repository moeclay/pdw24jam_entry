<?php
error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index() {
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){

			// data data record
			// pagination karyawan
			$page=$this->uri->segment(4);
			$limit=100;

			if(!$page):
				$offset = 0;
			else:
				$offset = $page;
			endif;
			
			// data kinerja
			$hasil = $this->App_model->semua_data_kinerja($offset,$limit);
			
			$config['base_url'] = base_url().'admin/home/index/';
			
			// hitung semua data
			$data_total = $this->db->query("SELECT COUNT(*) as total FROM bj_reportkinerja");
			$data_total1 = $data_total->row();
			$data_total2 = $data_total1->total;
			
    		$config['total_rows'] = intval($data_total2);
    		$config['per_page'] = $limit;
    		$config['uri_segment'] = 4;
			$config['full_tag_open'] = '<ul class="pagination">';
        	$config['full_tag_close'] = '</ul>';
        	$config['first_link'] = 'first';
        	$config['last_link'] = 'last';
        	$config['first_tag_open'] = '<li>';
        	$config['first_tag_close'] = '</li>';
        	$config['prev_link'] = '&laquo';
        	$config['prev_tag_open'] = '<li class="prev">';
        	$config['prev_tag_close'] = '</li>';
        	$config['next_link'] = '&raquo';
        	$config['next_tag_open'] = '<li>';
        	$config['next_tag_close'] = '</li>';
        	$config['last_tag_open'] = '<li>';
        	$config['last_tag_close'] = '</li>';
        	$config['cur_tag_open'] = '<li class="active"><a href="#">';
        	$config['cur_tag_close'] = '</a></li>';
        	$config['num_tag_open'] = '<li>';
        	$config['num_tag_close'] = '</li>';
    		$config['first_link'] = 'Awal';
    		$config['last_link'] = 'Akhir';
    		$config['next_link'] = 'Selanjutnya';
    		$config['prev_link'] = 'Sebelumnya';
    		$this->pagination->initialize($config);
    		$d["paginator"] = $this->pagination->create_links();
    		$d['kinerjaDB'] = $hasil->result();

			// load view
			$d['main_page']	= 'admin/dashboard';
			$this->load->view('admin/template', $d);
		}else{
			redirect('user');
		}
	}

	public function cari_record() {
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
            
            // cari karyawan
			if($this->input->post("cari_kinerja")==""){
				redirect('admin');
			} else {
				$sess_data['kata'] = $this->input->post("cari_kinerja");
				$this->session->set_userdata($sess_data);
				$kata = $this->session->userdata('kata');
			}
			
		
			// pagination
			$page=$this->uri->segment(4);
			$limit=5;
			if(!$page):
				$offset = 0;
			else:
				$offset = $page;
			endif;
			
			$hasil = $this->App_model->cariKinerjaDB($kata,$offset,$limit);
			
			// check result 'hasil pencarian'
			if($hasil->row() == null){
			    $this->session->set_flashdata("pesan","Hasil pencarian kosong !");
			    redirect('admin');
			}else if(count($hasil->result()) > 1){
    			$d["kinerjaDB"] = $hasil->result();
			}else{
				$d["kinerjaDB"] = $hasil->row();
			}

			// load view
   			$d['main_page']	= 'admin/carikinerja';
    		$this->load->view('admin/template', $d);
		}else{
	        redirect('user');
		}
    }

}
