<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index() {
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='koperasi'){
		    // param semuaIDKaryawan
		    $d['semuaIDKaryawan'] = $this->App_model->semuaIDKaryawan();
		    
            // karyawan
            $d['karyawan']  = $this->App_model->allKaryawan();

			// load view
			$d['main_page']	= 'koperasi/input_kinerja';
			$this->load->view('koperasi/template', $d);
		}else{
			redirect('user');
		}
	}

    public function laporan() {
        // cek status
        if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='koperasi'){

            // data data record
            // pagination karyawan
            $page=$this->uri->segment(4);
            $limit=25;

            if(!$page):
                $offset = 0;
            else:
                $offset = $page;
            endif;
            
            // data kinerja
            $hasil = $this->App_model->semua_data_koperasi($offset,$limit);
            
            $config['base_url'] = base_url().'koperasi/home/index/';
            
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
            $d['karyawan']  = $this->App_model->allKaryawan();

            $d["paginator"] = $this->pagination->create_links();
            $d['kinerjaDB'] = $hasil->result();

            // load view
            $d['main_page'] = 'koperasi/dashboard';
            $this->load->view('koperasi/template', $d);
        }else{
            redirect('user');
        }
    }

	public function simpan_kinerja(){
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='koperasi'){
		    
		    // validasi form
		    $this->form_validation->set_rules('nominal','Nominal','trim|required');

		    if($this->form_validation->run() == TRUE){
    			// daftar input post
    			$invoice_terakhir   = getNomerKinerja();
    			$tgl_spk            = $this->input->post('tgl_spk');
    			$opx1               = $this->input->post('penerimaan');
    			$type               = $this->input->post('type');
                $nominal            = $this->input->post('nominal');
    
                if(isset($opx1) && $opx1!=null){
                    $penerimaan = implode(",",$opx1);
                }else{
                    $penerimaan = 'kosong';
                }

                if(isset($type) && $type!=null){
                    $type = implode(",",$type);
                }else{
                    $type = 'kosong';
                }

                // algoritma data
                $year       = date('y');
                $month      = date('m');
                $day        = date('d');
                $header_id  = $year.$month.$day; 
    			
                $data = array(
    				'id_kinerja'     	=> $header_id.$invoice_terakhir,
    				'tgl_spk'	        => $tgl_spk,
    				'penerimaan'        => $penerimaan,
    				'type'              => $type,
                    'nominal'           => $nominal
    			);
			
                $table = 'bj_koperasi';
                $this->App_model->tambah_data($table, $data);
                $this->session->set_flashdata("sukses","Berhasil, Tabungan berhasil ditambahkan !");
                $this->session->set_flashdata("simpan","Nomer Tabungan : $invoice_terakhir");
                header('location:'.site_url('koperasi/home'));
		    }else{
		        $this->session->set_flashdata("pesan","Gagal Lengkapi data anda !");
		        redirect('koperasi/home');
		    }
		}else{
			redirect('user');
		}
	}

	public function cariKinerjaReport() {
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='koperasi'){

			// cari karyawan
			if($this->input->post("cari_kinerja")==""){
				redirect('koperasi');
			} else {
				$sess_data['kata'] = $this->input->post("cari_kinerja");
				$this->session->set_userdata($sess_data);
				$kata = $this->session->userdata('kata');
			}
			
		
			// pagination data offset dan limit
			$page=$this->uri->segment(4);
			$limit=25;
			if(!$page):
				$offset = 0;
			else:
				$offset = $page;
			endif;
			
			$d['tot'] = $offset;
			$hasil = $this->App_model->cariKinerjaMtr($kata,$offset,$limit);
			
			// check result 'hasil pencarian'
			if($hasil->row() == null){
			    $this->session->set_flashdata("pesan","Hasil pencarian kosong !");
			    redirect('koperasi');
			}else{
			    $config['base_url'] = base_url().'koperasi/home/index/';
    			$config['total_rows'] = $hasil->num_rows();
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
    			$kinerjaDB = $hasil->row();
    			

    			// parsing list_penerimaan
    			$data1 = $kinerjaDB->penerimaan;
                if($data1 == 'kosong'){
                    $data4 = 'kosong';
                }else{
                    $data2 = explode(",",$data1);
                    // buat array penampung
                    $data3 = array();
                    foreach($data2 as $d){
                        array_push($data3,getNamaKaryawan($d));
                    }
                    $data4 = implode("  /  ",$data3);
                }
    			
    			
    			// parsing list_type
    			$data6 = $kinerjaDB->type;
                if($data6 == 'kosong'){
                    $data9 = 'kosong';
                }else{
                    $data7 = explode(",",$data6);
                    // buat array penampung
                    $data8 = array();
                    foreach($data7 as $e){
                        array_push($data8,getNamaKaryawan($e));
                    }
                    $data9 = implode("  /  ",$data8);
                }
    			
    			
    		    // data parsing DB
    		    $param['view_idkinerja']  = $kinerjaDB->id_kinerja;
    		    $param['view_tglspk']     = $kinerjaDB->tgl_spk;
    		    $param['view_noinvoice']  = $kinerjaDB->no_invoice;
    		    $param['view_designedit'] = $kinerjaDB->design_edit;
    		    $param['view_penerimaan'] = $data4;
    		    $param['view_type'] = $data9;
    		    
                // load data base to list
                $param['kinerjaDB2'] = $hasil->result();
    			
                // load view
    			$this->load->view('koperasi/template_cari', $param);
			}
		}else{
		    $this->session->set_flashdata("pesan","Maaf, Akses terbatas.");
			redirect('user');
		}
	}

    public function export_file(){
        // cek status
        if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='koperasi'){
            header("Content-type: application/vnd-ms-excel");
 
            // Mendefinisikan nama file ekspor "kinerja_semua.xls"
            header("Content-Disposition: attachment; filename=kinerja_koperasi.xls");
 
            // Tambahkan table
            $hasil = $this->App_model->laporan_koperasi();
            $d['kinerjaDB'] = $hasil->result();
            
            $this->load->view('koperasi/reza_excel', $d);
        }else{
            redirect('user');
        }
    }

    // cari karyawan
    public function cari_karyawan(){
        if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='koperasi'){
            // cari karyawan
            if($this->input->post("cari_nama")==""){
                $kata = $this->session->userdata('kata');
                redirect('koperasi');
            } else {
                $sess_data['kata'] = $this->input->post("cari_nama");
                $this->session->set_userdata($sess_data);
                $kata = $this->session->userdata('kata');
            }

            // data data record
            // pagination karyawan
            $page=$this->uri->segment(4);
            $limit=25;

            if(!$page):
                $offset = 0;
            else:
                $offset = $page;
            endif;
            
            // data kinerja
            $hasil = $this->App_model->cariKinerjaMtr($kata,$offset,$limit);
            $totall = $this->App_model->cariTotalNabung($kata);
            
            $config['base_url'] = base_url().'koperasi/home/index/';
            
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
            $d['karyawan']  = $this->App_model->allKaryawan();

            $d["paginator"] = $this->pagination->create_links();
            $d['kinerjaDB'] = $hasil->result();
            $d['total']     = $totall->result();
            
            // cari isi pencarian
            $data_total_pencarian = $this->db->query("SELECT * FROM karyawan WHERE nama LIKE '%$kata%'");
            $d['user'] = $data_total_pencarian->row();

            $d['main_page'] = 'koperasi/carikaryawan';
            $this->load->view('koperasi/template',$d);
        }else{
            redirect('user');
        }
    }


}
