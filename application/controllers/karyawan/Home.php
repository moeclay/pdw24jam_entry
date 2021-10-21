<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
/*
* README before edit script
*
* Perubahan terakhir di April 2019
* - Nama pelanggan dihilangkan
* - Status : Diproses, Belum Diambil, Sudah Diambil
* - No Rak disatukan.
*/

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}


// function inti
	public function index(){
		// status member
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){

			$where = array('id_karyawan'=> $this->session->userdata('id_user'));
			$d['data'] = $this->App_model->sekarangKaryawan($where);

			$id = $this->session->userdata('id_user');
			// $bulan = data_bulan_terakhir();
			// $tahun = data_tahun_terakhir();
			$bulan = 8;
			$tahun = 2021;

			$d['bulan'] 		= $bulan;
			$d['tahun']			= $tahun;
			// $data 		        = $this->Karyawan_model->semuaData($id, $bulan, $tahun);

			// hari_kerja
			if($data){
				$d['jam_kerja']     = $data->jam_kerja;
				$d['point_kinerja'] = $data->point_kinerja;
				$d['point_edit'] 	= $data->point_edit;
				$d['transaksi'] 	= $data->transaksi;

				$d['tunjangan_edit'] 		= $data->tj_edit;
				$d['tunjangan_kinerja'] 	= $data->tj_kinerja;
				$d['bonus_absen'] 			= $data->bonus_absen;
				$d['bonus_tambah'] 			= $data->bonus_tambah;
				$d['total_bonus'] 			= total_bonus($id, $bulan, $tahun);
			}else{
				$d['jam_kerja']     		= "0"; 	
				$d['point_kinerja'] 		= "0"; 	
				$d['point_edit'] 			= "0";
				$d['transaksi'] 			= "0";
				$d['tunjangan_edit'] 		= "0";
				$d['tunjangan_kinerja'] 	= "0";
				$d['bonus_absen']   		= "0"; 	
				$d['bonus_tambah']    		= "0"; 	
				$d['total_bonus']    		= "0"; 	
			}

			// cari id toko
			$data_toko_divisi = cari_id_toko($id);
			$id_divisi 	= $data_toko_divisi->id_divisi;
			$id_toko 	= $data_toko_divisi->id_toko; 

			// $d['total_karyawan_divisi'] = total_karyawan_divisi($id_divisi, $id_toko, $bulan, $tahun);

			// $d['hari_kerja']  			= hari_kerja($id, $bulan, $tahun);

			// $d['data_jam_hari']  		= rumus_jam_hari($id, $bulan, $tahun);
			// $d['data_point_edit_hari']  = rumus_edit_hari($id, $bulan, $tahun);
			// $d['data_point_kinerja_hari']  = rumus_kinerja_hari($id, $bulan, $tahun);
			// $d['data_point_transaksi_hari']  = rumus_transaksi_hari($id, $bulan, $tahun);
			// $d['data_transaksi_kinerja_hari']  = rumus_transaksi_kinerja_hari($id, $bulan, $tahun);
			
			// // cari nilai
			// $rank_nilai = cari_rank_nilai($id, $id_divisi, $id_toko, $bulan, $tahun);

			// // cari data ranking
			// $rank_edit = cari_rank_edit($id, $id_divisi, $id_toko, $bulan, $tahun);

			// nilai ranking
			if(empty($rank_edit)){
				$d['nilai_e']   = "0";
				$d['nilai_t']	= "0";
				$d['nilai_k']	= "0";
			}else{
				$d['nilai_e']   = $rank_edit[0]['nilai_edit']; 
				$d['nilai_t']	= $rank_edit[0]['nilai_transaksi'];
				$d['nilai_k']	= $rank_edit[0]['total_nilai'];
			}

			// data ranking
			if(empty($rank_nilai)){
				$d['rank'] 		= "0";
			}else{
				$d['rank'] 		= $rank_nilai[0]['ranking'];
			}

			// load view
			$d['main_page']				= 'karyawan/dashboard';
			$d['iddivisi']				= $id_divisi;
			$this->load->view('karyawan/template', $d);
		}else{
			redirect('user');
		}
	}

	// function inti
	public function dashboard_lama(){
		// status member
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){

			$where = array('id_karyawan'=> $this->session->userdata('id_user'));
			$d['data'] = $this->App_model->sekarangKaryawan($where);

			$id = $this->session->userdata('id_user');
			// $bulan = data_bulan_terakhir();
			// $tahun = data_tahun_terakhir();
			$bulan = 8;
			$tahun = 2021;

			$d['bulan'] 		= $bulan;
			$d['tahun']			= $tahun;
			// $data 		        = $this->Karyawan_model->semuaData($id, $bulan, $tahun);

			// hari_kerja
			if($data){
				$d['jam_kerja']     = $data->jam_kerja;
				$d['point_kinerja'] = $data->point_kinerja;
				$d['point_edit'] 	= $data->point_edit;
				$d['transaksi'] 	= $data->transaksi;

				$d['tunjangan_edit'] 		= $data->tj_edit;
				$d['tunjangan_kinerja'] 	= $data->tj_kinerja;
				$d['bonus_absen'] 			= $data->bonus_absen;
				$d['bonus_tambah'] 			= $data->bonus_tambah;
				$d['total_bonus'] 			= total_bonus($id, $bulan, $tahun);
			}else{
				$d['jam_kerja']     		= "0"; 	
				$d['point_kinerja'] 		= "0"; 	
				$d['point_edit'] 			= "0";
				$d['transaksi'] 			= "0";
				$d['tunjangan_edit'] 		= "0";
				$d['tunjangan_kinerja'] 	= "0";
				$d['bonus_absen']   		= "0"; 	
				$d['bonus_tambah']    		= "0"; 	
				$d['total_bonus']    		= "0"; 	
			}

			// cari id toko
			$data_toko_divisi = cari_id_toko($id);
			$id_divisi 	= $data_toko_divisi->id_divisi;
			$id_toko 	= $data_toko_divisi->id_toko; 

			// $d['total_karyawan_divisi'] = total_karyawan_divisi($id_divisi, $id_toko, $bulan, $tahun);

			// $d['hari_kerja']  			= hari_kerja($id, $bulan, $tahun);

			// $d['data_jam_hari']  		= rumus_jam_hari($id, $bulan, $tahun);
			// $d['data_point_edit_hari']  = rumus_edit_hari($id, $bulan, $tahun);
			// $d['data_point_kinerja_hari']  = rumus_kinerja_hari($id, $bulan, $tahun);
			// $d['data_point_transaksi_hari']  = rumus_transaksi_hari($id, $bulan, $tahun);
			// $d['data_transaksi_kinerja_hari']  = rumus_transaksi_kinerja_hari($id, $bulan, $tahun);
			
			// // cari nilai
			// $rank_nilai = cari_rank_nilai($id, $id_divisi, $id_toko, $bulan, $tahun);

			// // cari data ranking
			// $rank_edit = cari_rank_edit($id, $id_divisi, $id_toko, $bulan, $tahun);

			// nilai ranking
			if(empty($rank_edit)){
				$d['nilai_e']   = "0";
				$d['nilai_t']	= "0";
				$d['nilai_k']	= "0";
			}else{
				$d['nilai_e']   = $rank_edit[0]['nilai_edit']; 
				$d['nilai_t']	= $rank_edit[0]['nilai_transaksi'];
				$d['nilai_k']	= $rank_edit[0]['total_nilai'];
			}

			// data ranking
			if(empty($rank_nilai)){
				$d['rank'] 		= "0";
			}else{
				$d['rank'] 		= $rank_nilai[0]['ranking'];
			}

			// load view
			$d['main_page']				= 'karyawan/dashboard_lama';
			$this->load->view('karyawan/template', $d);
		}else{
			redirect('user');
		}
	}

	// function cari_report
	public function cari_raport(){
		// status member
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){

			if($this->input->post("raport_bulan")=="" || $this->input->post("raport_tahun")==""){
				redirect('karyawan');
			}

			$where = array('id_karyawan'=> $this->session->userdata('id_user'));
			$d['data'] = $this->App_model->sekarangKaryawan($where);

			$id = $this->session->userdata('id_user');
			$bulan = ambilIDBulan($this->input->post('raport_bulan'));
			$tahun = $this->input->post('raport_tahun');

			$d['bulan'] 		= $bulan;
			$d['tahun']			= $tahun;
			$data 		= $this->Karyawan_model->semuaData($id, $bulan, $tahun);

			// hari_kerja
			if($data){
				$d['jam_kerja']     = $data->jam_kerja;
				$d['point_kinerja'] = $data->point_kinerja;
				$d['point_edit'] 	= $data->point_edit;
				$d['transaksi'] 	= $data->transaksi;

				$d['tunjangan_edit'] 		= $data->tj_edit;
				$d['tunjangan_kinerja'] 	= $data->tj_kinerja;
				$d['bonus_absen'] 			= $data->bonus_absen;
				$d['bonus_tambah'] 			= $data->bonus_tambah;
				$d['total_bonus'] 			= total_bonus($id, $bulan, $tahun);
			}else{
				$d['jam_kerja']     		= "0"; 	
				$d['point_kinerja'] 		= "0"; 	
				$d['point_edit'] 			= "0";
				$d['transaksi'] 			= "0";
				$d['tunjangan_edit'] 		= "0";
				$d['tunjangan_kinerja'] 	= "0";
				$d['bonus_absen']   		= "0"; 	
				$d['bonus_tambah']    		= "0"; 	
				$d['total_bonus']    		= "0";
			}

			// cari id toko
			$data_toko_divisi = cari_id_toko($id);
			$id_divisi 	= $data_toko_divisi->id_divisi;
			$id_toko 	= $data_toko_divisi->id_toko; 

			$d['total_karyawan_divisi'] = total_karyawan_divisi($id_divisi, $id_toko, $bulan, $tahun);

			$d['hari_kerja']  			= hari_kerja($id, $bulan, $tahun);

			$d['data_jam_hari']  		= rumus_jam_hari($id, $bulan, $tahun);
			$d['data_point_edit_hari']  = rumus_edit_hari($id, $bulan, $tahun);
			$d['data_point_kinerja_hari']  = rumus_kinerja_hari($id, $bulan, $tahun);
			$d['data_point_transaksi_hari']  = rumus_transaksi_hari($id, $bulan, $tahun);
			$d['data_transaksi_kinerja_hari']  = rumus_transaksi_kinerja_hari($id, $bulan, $tahun);
			
			// cari nilai
			$rank_nilai = cari_rank_nilai($id, $id_divisi, $id_toko, $bulan, $tahun);

			// cari data ranking
			$rank_edit = cari_rank_edit($id, $id_divisi, $id_toko, $bulan, $tahun);

			// nilai ranking
			if(empty($rank_edit)){
				$d['nilai_e']   = "0";
				$d['nilai_t']	= "0";
				$d['nilai_k']	= "0";
			}else{
				$d['nilai_e']   = $rank_edit[0]['nilai_edit']; 
				$d['nilai_t']	= $rank_edit[0]['nilai_transaksi'];
				$d['nilai_k']	= $rank_edit[0]['total_nilai'];
			}

			// data ranking
			if(empty($rank_nilai)){
				$d['rank'] 		= "0";
			}else{
				$d['rank'] 		= $rank_nilai[0]['ranking'];
			}

			// load view
			$d['main_page']	 	= 'karyawan/dashboard';
			$this->load->view('karyawan/template', $d);
		}else{
			redirect('user');
		}
	}

	// function data_pribadi
	public function data_pribadi(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){

			$where = array('id_karyawan'=> $this->session->userdata('id_user'));
			$d['data'] = $this->App_model->sekarangKaryawan($where);
			
			// load view
			$d['main_page']		= 'karyawan/data_pribadi';
			$this->load->view('karyawan/template', $d);
		}else{
			redirect('user');
		}
	}

	// cari karyawan
    public function grafik(){
        if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){

            
			$where = array('id_karyawan'=> $this->session->userdata('id_user'));
           
			$d['data'] 		= $this->App_model->sekarangKaryawan($where);

            $d['main_page'] = 'karyawan/grafik';
            $this->load->view('karyawan/template',$d);
        }else{
            redirect('user');
        }
    }

    public function slipgaji(){
        if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){
			$where = array('id_karyawan'=> $this->session->userdata('id_user'));
           
			$d['data'] 		= $this->App_model->sekarangKaryawan($where);
			$d['id_user'] = $this->session->userdata('id_user');
			
			$table = 'tbl_slipgaji';
			$d['list_slip'] = $this->Slip_model->getSlipById($table, $d['id_user']);
            $d['main_page'] = 'karyawan/slipgaji';
            $this->load->view('karyawan/template',$d);
        }else{
            redirect('user');
        }
    }
    
    public function getslipgaji($kode=null){
        if(isset($kode) && $kode != null){
            $table = 'tbl_slipgaji';
            $result = $this->Slip_model->getSlipByKode($table, $kode);
            redirect($result->link_slip);
        }else{
            redirect('/');
        }
    }

	// function grafik
	public function grafik_lama(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){
			// parameter yg dicari

			$id = $this->session->userdata('id_user');
			$data_toko_divisi = cari_id_toko($id);
			$id_divisi 	= $data_toko_divisi->id_divisi;
			$id_toko 	= $data_toko_divisi->id_toko; 

			$bulan = data_bulan_terakhir();
			$tahun = data_tahun_terakhir();

			$d['bulan'] = $bulan;
			$d['tahun'] = $tahun;
			$where = array('id_karyawan'=> $this->session->userdata('id_user'));
			
			$d['data'] = $this->App_model->sekarangKaryawan($where);

			$d['grafik'] = $this->Karyawan_model->Grafik_Karyawan($id_divisi, $id_toko, $bulan, $tahun);
			
			// load view
			$this->load->view('karyawan/grafik', $d);
		}else{
			redirect('user');
		}
	}

	// function cari_grafik
	public function cari_grafik(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){

			if($this->input->post("grafik_bulan")=="" || $this->input->post("grafik_tahun")==""){
				redirect('karyawan');
			}

			$id = $this->session->userdata('id_user');
			$bulan = ambilIDBulan($this->input->post('grafik_bulan'));
			$tahun = $this->input->post('grafik_tahun');

			$d['bulan'] 		= $bulan;
			$d['tahun']			= $tahun;

			$id = $this->session->userdata('id_user');
			$data_toko_divisi = cari_id_toko($id);
			$id_divisi 	= $data_toko_divisi->id_divisi;
			$id_toko 	= $data_toko_divisi->id_toko;
			 
			$where = array('id_karyawan'=> $this->session->userdata('id_user'));
			$d['data'] = $this->App_model->sekarangKaryawan($where);
			$d['grafik'] = $this->Karyawan_model->Grafik_Karyawan($id_divisi, $id_toko, $bulan, $tahun);
			
			// load view
			$this->load->view('karyawan/grafik', $d);
		}else{
			redirect('user');
		}
	}

	// cari karyawan
    public function detail_koperasi(){
        if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='karyawan'){

            // data data record
            // pagination karyawan
            $page=$this->uri->segment(4);
            $limit=25;

            if(!$page):
                $offset = 0;
            else:
                $offset = $page;
            endif;
            
			$where = array('id_karyawan'=> $this->session->userdata('id_user'));
			$kata = $this->session->userdata('id_user');
            
            // data kinerja
            $hasil = $this->App_model->cariKinerjaMtr($kata,$offset,$limit);
            $totall = $this->App_model->cariTotalNabung($kata);
            
            $config['base_url'] = base_url().'karyawan/home/index/';
            
            // hitung semua data
            $data_total = $this->db->query("SELECT COUNT(*) as total FROM bj_koperasi");
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
            
            // karyawan
			$d['data'] 		= $this->App_model->sekarangKaryawan($where);
            $d["paginator"] = $this->pagination->create_links();
            $d['kinerjaDB'] = $hasil->result();
            $d['total']     = $totall->result();
            
            // cari isi pencarian
            $data_total_pencarian = $this->db->query("SELECT * FROM karyawan WHERE nama LIKE '%$kata%'");
            $d['user'] = $data_total_pencarian->row();

            $d['main_page'] = 'karyawan/koperasi';
            $this->load->view('karyawan/template',$d);
        }else{
            redirect('user');
        }
    }
    
}