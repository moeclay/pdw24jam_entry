<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

// open connection without cors
header("Access-Control-Allow-Origin: *");

class Karyawan extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index() {
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			// pagination absensi
			$page=$this->uri->segment(4);
			$limit=25;

			if(!$page):
				$offset = 0;
			else:
				$offset = $page;
			endif;
			
			$d['tot'] = $offset;
			$config['base_url'] = base_url().'admin/karyawan/index/';
			
			// hitung semua data
			$data_total = $this->db->query("SELECT COUNT(*) as total_karyawan FROM karyawan");
			$data_total1 = $data_total->row();
			$data_total2 = $data_total1->total_karyawan;
			
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
			$d["paginator"] =$this->pagination->create_links();

			// lampiran file
			$d['karyawan'] 	= $this->App_model->allLoginKaryawan();
			$d['users'] 	= $this->App_model->allKaryawan($offset,$limit);

			$d['main_page']	= 'admin/daftar_karyawan';
			$this->load->view('admin/template',$d);
		}else{
			redirect('user');
		}
	}

	public function detail_karyawan($id=null){
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$id_data 	= array('id_karyawan'=>$id);
			$d['sk'] 	= $this->App_model->sekarangKaryawan($id_data);

			$d['main_page']	= 'admin/detail_karyawan';
			$this->load->view('admin/template',$d);
		}else{
			redirect('user');
		}
	}

	// hapus karyawan
	public function hapus_karyawan($id){
		if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$where 	= array('id_karyawan'=>$id);

			$this->App_model->deleteKaryawan($where);
			$this->session->set_flashdata("sukses","Berhasil, Data Karyawan telah terhapus !");
			redirect('admin/karyawan');
		}else{
			redirect('user');
		}
	}

	// cari karyawan
	public function cari_karyawan(){
		if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			// cari karyawan
			if($this->input->post("cari_nama")==""){
				$kata = $this->session->userdata('kata');
				redirect('admin/karyawan');
			} else {
				$sess_data['kata'] = $this->input->post("cari_nama");
				$this->session->set_userdata($sess_data);
				$kata = $this->session->userdata('kata');
			}

			// karyawan
			$d['karyawan'] 	= $this->App_model->allLoginKaryawan();
			
			// cari isi pencarian
			$data_total_pencarian = $this->db->query("SELECT * FROM karyawan WHERE nama LIKE '%$kata%'");
			$d['user'] = $data_total_pencarian->row();

			$d['main_page']	= 'admin/carikaryawan';
			$this->load->view('admin/template',$d);
		}else{
			redirect('user');
		}
	}

	// tambah karyawan
	public function tambah_karyawan(){
		if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){

			// lampiran
			$d['divisi']= $this->App_model->dataDivisi();
			$d['toko'] 	= $this->App_model->semuaToko();
			
			$d['main_page']	= 'admin/tambah_karyawan';
			$this->load->view('admin/template',$d);
		}else{
			redirect('user');
		}
	}

	// simpan karyawan
	public function simpan_karyawan(){
		if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			// data simpan karyawan
			$this->form_validation->set_rules('nama_lengkap','nama lengkap','trim|required');
			$this->form_validation->set_rules('pendidikan','pendidikan','trim|required');
			$this->form_validation->set_rules('telp','telp','trim|required');

			// validasi form
			if($this->form_validation->run() == TRUE){
				// daftar yg di post
       			$id_karyawan 	= $this->input->post('id_karyawan');
       			$id 			= $this->input->post('id_kode');
       			$kode 			= $this->input->post('kode');
       			$nama_lengkap 	= $this->input->post('nama_lengkap');
       			$nama 			= $this->input->post('nama');
       			$no_ktp 		= $this->input->post('no_ktp');
       			$tempat_lahir 	= $this->input->post('tempat_lahir');
       			$tgl_lahir 		= $this->input->post('tgl_lahir');
       			$jenis_kelamin 	= $this->input->post('jenis_kelamin');
       			$telp 			= $this->input->post('telp');
       			$alamat 		= $this->input->post('alamat');
       			$email 			= $this->input->post('email');
       			$pendidikan 	= $this->input->post('pendidikan');
				$avatar 		= $this->input->post('img_avatar');
				$toko			= $this->input->post('toko');
       			$divisi 		= $this->input->post('divisi');
				$jabatan 		= $this->input->post('jabatan');
				$tgl_masuk 		= $this->input->post('tgl_masuk');
       			$gaji_kotor 	= $this->input->post('gaji_kotor');
				$user 			= $this->input->post('user');
				$password 		= $this->input->post('password');
				$stts_login 	= $this->input->post('stts_login');
				$stts_kinerja 	= $this->input->post('stts_kinerja');
				$status 		= $this->input->post('status');

			
				$data 	= array(
					'id_karyawan'	=> post_nextidkaryawan($id_karyawan),
					'id' 			=> $id,
					'kode' 			=> $kode,
					'nama_lengkap' 	=> $nama_lengkap,
					'nama' 			=> $nama,
					'no_ktp' 		=> $no_ktp,
					'tempat_lahir' 	=> $tempat_lahir,
					'tgl_lahir' 	=> $tgl_lahir,
					'jenis_kelamin' => $jenis_kelamin,
					'telp'			=> $telp,
					'alamat' 		=> $alamat,
					'email'			=> $email,
					'pendidikan'	=> $pendidikan,
					'foto'			=> $avatar,
					'id_toko'		=> $toko,
					'id_divisi'		=> $divisi,
					'jabatan'		=> $jabatan,
					'masa_kerja' 	=> $tgl_masuk,
					'gaji_kotor' 	=> $gaji_kotor,
					'user' 			=> $user,
					'pass'			=> md5('kin_'.$password),
					'stts_login'	=> $stts_login,
					'stts_kinerja' 	=> $stts_kinerja,
					'status' 		=> $status,
				);
				$this->App_model->addKaryawan($data);
				$this->session->set_flashdata("sukses","Berhasil, Data Karyawan telah ditambahkan !");
				redirect('admin/karyawan/tambah_karyawan');
			}else{
				$this->session->set_flashdata("pesan","Gagal, Isi data form dengan benar !");
				redirect('admin/karyawan/tambah_karyawan');
			}
		}else{
			redirect('user');
		}
	}

	// ubah karyawan
	public function ubah_karyawan($id){
		if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$id_data 	= array('id_karyawan'=>$id);
			$d['sk'] 	= $this->App_model->sekarangKaryawan($id_data);
			$d['divisi']= $this->App_model->dataDivisi();
			$d['toko'] 	= $this->App_model->semuaToko();
			
			$d['main_page']	= 'admin/ubah_karyawan';
			$this->load->view('admin/template',$d);
		}else{
			redirect('user');
		}	
	}

	// update karyawan
	public function update_karyawann(){
		if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$this->form_validation->set_rules('nama_lengkap','nama lengkap','trim|required');

			// validasi form
			if($this->form_validation->run() == TRUE){
				// daftar yg di post
       			$id 			= $this->input->post('id_kode');
       			$kode 			= $this->input->post('kode');
       			$nama_lengkap 	= $this->input->post('nama_lengkap');
       			$nama 			= $this->input->post('nama');
       			$id_karyawan 	= $this->input->post('id_karyawan');
       			$pendidikan 	= $this->input->post('pendidikan');
       			$telp 			= $this->input->post('telp');
       			$email 			= $this->input->post('email');
       			$divisi 		= $this->input->post('divisi');
				$toko			= $this->input->post('toko');
				$jabatan		= $this->input->post('jabatan');
				$avatar			= $this->input->post('img_avatar');
				$gaji_kotor		= $this->input->post('gaji_kotor');

				// update per id
				$where 	= array('id_karyawan'=>$id_karyawan);
			
				$data 	= array(
					'id_karyawan'	=> $id_karyawan,
					'id'			=> $id,
					'kode'			=> $kode,
					'nama_lengkap'	=> $nama_lengkap,
					'nama'			=> $nama,
					'pendidikan'	=> $pendidikan,
					'telp'			=> $telp,
					'email'			=> $email,
					'id_divisi'		=> $divisi,
					'id_toko'		=> $toko,
					'jabatan'		=> $jabatan,
					'foto'			=> $avatar,
					'gaji_kotor'	=> $gaji_kotor,
					'update_at'		=> date('Y-m-d')
				);
				$this->App_model->updateKaryawan($data, $where);
				$this->session->set_flashdata("sukses","Berhasil, Data Karyawan telah diubah !");
				header('location:'.site_url('admin/karyawan'));
			}else{
				$this->session->set_flashdata("pesan","Gagal, Lengkap data dengan benar !");
				redirect('admin/karyawan');
			}
		}else{
			redirect('user');
		}
	}

	// update karyawan
	public function update_karyawan(){
		if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$this->form_validation->set_rules('nama_lengkap','nama lengkap','trim|required');

			// validasi form
			if($this->form_validation->run() == TRUE){
				// daftar yg di post
       			$id_karyawan 	= $this->input->post('id_karyawan');
       			$id 			= $this->input->post('id_kode');
       			$kode 			= $this->input->post('kode');
       			$nama_lengkap 	= $this->input->post('nama_lengkap');
       			$nama 			= $this->input->post('nama');
       			$no_ktp 		= $this->input->post('no_ktp');
       			$tempat_lahir 	= $this->input->post('tempat_lahir');
       			$tgl_lahir 		= $this->input->post('tgl_lahir');
       			$jenis_kelamin 	= $this->input->post('jenis_kelamin');
       			$telp 			= $this->input->post('telp');
       			$alamat 		= $this->input->post('alamat');
       			$email 			= $this->input->post('email');
       			$pendidikan 	= $this->input->post('pendidikan');
				$toko			= $this->input->post('toko');
       			$divisi 		= $this->input->post('divisi');
				$jabatan 		= $this->input->post('jabatan');
				$tgl_masuk 		= $this->input->post('tgl_masuk');
       			$gaji_kotor 	= $this->input->post('gaji_kotor');
				$user 			= $this->input->post('user');
				$password 		= $this->input->post('password');
				$stts_login 	= $this->input->post('stts_login');
				$stts_kinerja 	= $this->input->post('stts_kinerja');
				$status 		= $this->input->post('status');

				// update per id
				$where 	= array('id_karyawan'=>$id_karyawan);
			
				$data 	= array(
					'id_karyawan'	=> $id_karyawan,
					'id' 			=> $id,
					'kode' 			=> $kode,
					'nama_lengkap' 	=> $nama_lengkap,
					'nama' 			=> $nama,
					'no_ktp' 		=> $no_ktp,
					'tempat_lahir' 	=> $tempat_lahir,
					'tgl_lahir' 	=> $tgl_lahir,
					'jenis_kelamin' => $jenis_kelamin,
					'telp'			=> $telp,
					'alamat' 		=> $alamat,
					'email'			=> $email,
					'pendidikan'	=> $pendidikan,
					'id_toko'		=> $toko,
					'id_divisi'		=> $divisi,
					'jabatan'		=> $jabatan,
					'masa_kerja' 	=> $tgl_masuk,
					'gaji_kotor' 	=> $gaji_kotor,
					'user' 			=> $user,
					'pass'			=> md5('kin_'.$password),
					'stts_login'	=> $stts_login,
					'stts_kinerja' 	=> $stts_kinerja,
					'status' 		=> $status,
					'update_at'		=> date('Y-m-d H:i:s')
				);
				$this->App_model->updateKaryawan($data, $where);
				$this->session->set_flashdata("sukses","Berhasil, Data Karyawan telah diubah !");
				header('location:'.site_url('admin/karyawan'));
			}else{
				$this->session->set_flashdata("pesan","Gagal, Lengkap data dengan benar !");
				redirect('admin/karyawan');
			}
		}else{
			redirect('user');
		}
	}
	
	// slipgaji
    public function slipgaji($kode=null){
        if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
            $tahun = date('Y');
            $bulan = date('m')-1;
            
            if(strlen($bulan) == 1){
                $bulanfix = '0'.$bulan;
            }else{
                $bulanfix = $bulan;
            }
            
            $d['tahun_bulan'] = $tahun.'_'.$bulanfix;
			$d['semua_karyawan'] = $this->App_model->allLoginKaryawanById();
			$d['secure_kode']	= RandomString(10);
			$d['main_page']	= 'admin/slipgaji';
			$this->load->view('admin/template',$d);
        }else{
            redirect('/');
        }
    }

    public function jsonslipgaji($kode=null){
        if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
			$data = $this->Slip_model->getSlipAll('tbl_slipgaji');
			echo json_encode($data);
        }else{
            redirect('/');
        }
    }
    
    public function insertslip(){
        if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
            $data = array(
                'idkaryawan' => $this->input->get('id'),
                'kodeslip' => $this->input->get('sc'),
                'tahun_bulan' => $this->input->get('tb'),
                'link_slip' => $this->input->get('link')
            );
            $result = $this->App_model->tambah_data('tbl_slipgaji', $data);
			echo json_encode(['status' => $result]);
        }else{
            redirect('/');
        }
    }

    public function randomKode($kode=null){
    	$allkode = array();

    	for ($i=0; $i < 100; $i++) { 
    		$kode = RandomString(10);
        	array_push($allkode, $kode);
    	}

    	echo json_encode($allkode);
    }
    
}