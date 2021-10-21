<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	// method index
	public function index() {
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){

			// pagination karyawan
			$page=$this->uri->segment(4);
			$limit=10;

			if(!$page):
				$offset = 0;
			else:
				$offset = $page;
			endif;
			
			$d['tot'] = $offset;
			$tot_hal = $this->db->get("karyawan");
			$config['base_url'] = base_url().'admin/staff/index/';
			$config['total_rows'] = $tot_hal->num_rows();
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
			$d["paginator"] =$this->pagination->create_links();

			// lampiran file
			$table = 'karyawan';
			$d['staff'] 	= $this->App_model->semua_data($table, $offset, $limit);

			$d['main_page'] = 'admin/list_employee';
			$this->load->view('admin/template', $d);
		}else{
			redirect('user');
		}
	}

	// method tambah_staff
	public function tambah_staff(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$d['main_page'] = 'admin/add_employee';
			$this->load->view('admin/template', $d);
		}else{
			redirect('user');
		}
	}

	// method simpan_staff
	public function simpan_staff(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			
			// daftar input post
			$nama = $this->input->post('nama');
			$user = $this->input->post('user');
			$pass = $this->input->post('pass');

			$table = 'karyawan';
			$data = array(
				'nama' 			=> $nama,
				'user'			=> $user,
				'pass' 			=> md5('kin_'.$pass),
				'stts_login' 	=> 'bj',
				'create_at'  	=> date("Y-m-d H:i:s")
			);
			$this->App_model->tambah_data($table, $data);
			$this->session->set_flashdata("sukses","Berhasil, Data Staff telah ditambahkan !");
			header('location:'.site_url('admin/staff'));
		}else{
			redirect('user');
		}
	}

	// method ubah_staff
	public function ubah_staff($id){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){

			// staff sekarang
			$where = array('id_karyawan'=>$id);
			$table = 'karyawan';
			$d['ss']  = $this->App_model->sekarang_data($table, $where);

			$d['main_page'] = 'admin/change_employee';
			$this->load->view('admin/template', $d);
		}else{
			redirect('user');
		}
	}

	// method update_staff
	public function update_staff(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			
			// daftar input post
			$id   = $this->input->post('id_karyawan');
			$nama = $this->input->post('nama');
			$user = $this->input->post('user');
			$pass_baru = $this->input->post('pass_baru');
			$pass_baru2 = $this->input->post('pass_baru2');

			if($pass_baru == $pass_baru2){
				$pass = $pass_baru;
				$table = 'karyawan';

				$where = array('id_karyawan'=>$id);
				$data = array(
					'nama' 			=> $nama,
					'user'			=> $user,
					'pass' 			=> md5('kin_'.$pass_baru),
					'update_at'  	=> date("Y-m-d H:i:s")
				);
				$this->App_model->ubah_data($table, $data, $where);
				$this->session->set_flashdata("sukses","Berhasil, Perubahan data anda selesai !");
				header('location:'.site_url('admin/staff'));
			}else{
				$this->session->set_flashdata("pesan","Gagal, Password tidak sama !");
				redirect('admin/staff');
			}
		}else{
			redirect('user');
		}
	}

	// method hapus_staff
	public function hapus_staff($id){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$where 	= array('id_karyawan'=>$id);

			$table = 'karyawan';
			$this->App_model->hapus_data($table,$where);
			$this->session->set_flashdata("sukses","Berhasil, Data Staff telah terhapus !");
			redirect('admin/staff');
		}else{
			redirect('user');
		}
	}

}
