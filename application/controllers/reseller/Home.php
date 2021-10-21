<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index() {
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='reseller'){
		    // param semuaIDKaryawan
		    // $d['semuaIDKaryawan'] = $this->App_model->semuaIDKaryawan();
		    
			// // load view
			// $d['main_page']	= 'mitra/input_kinerja';
			// $this->load->view('mitra/template', $d);
            echo json_encode($this->session->userdata());
		}else{
			redirect('user');
		}
	}

    public function laporan() {
        // cek status
        if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='mitra'){

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
            $hasil = $this->App_model->semua_data_mitra($offset,$limit);
            
            $config['base_url'] = base_url().'mitra/home/index/';
            
            // hitung semua data
            $data_total = $this->db->query("SELECT COUNT(*) as total FROM bj_mitra");
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
            $d['main_page'] = 'mitra/dashboard';
            $this->load->view('mitra/template', $d);
        }else{
            redirect('user');
        }
    }

	public function simpan_kinerja(){
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='mitra'){
		    
		    // validasi form
		    $this->form_validation->set_rules('no_invoice','No Invoice','trim|required');

		    if($this->form_validation->run() == TRUE){
    			// daftar input post
    			$invoice_terakhir   = getNomerKinerja();
    			$tgl_spk            = $this->input->post('tgl_spk');
    			$no_invoice         = $this->input->post('no_invoice');
    			$design_edit        = $this->input->post('design_edit');
    			$opx1               = $this->input->post('penerimaan');
    			$opx2               = $this->input->post('pengerjaan');
    
                if(isset($opx1) && $opx1!=null){
                    $penerimaan = implode(",",$opx1);
                }else{
                    $penerimaan = 'kosong';
                }

                if(isset($opx2) && $opx2!=null){
                    $pengerjaan = implode(",",$opx2);
                }else{
                    $pengerjaan = 'kosong';
                }

                // algoritma data
                $year       = date('y');
                $month      = date('m');
                $day        = date('d');
                $header_id  = $year.$month.$day; 
    			
                $data = array(
    				'id_kinerja'     	=> $header_id.$invoice_terakhir,
    				'tgl_spk'	        => $tgl_spk,
    				'no_invoice'	    => $no_invoice,
    				'design_edit'       => $design_edit,
    				'penerimaan'        => $penerimaan,
    				'pengerjaan'        => $pengerjaan
    			);
			
                $table = 'bj_mitra';
                $this->App_model->tambah_data($table, $data);
                $this->session->set_flashdata("sukses","Berhasil, Nomer faktur berhasil ditambahkan !");
                $this->session->set_flashdata("simpan","Nomer ID Kinerja : $invoice_terakhir");
                header('location:'.site_url('mitra/home'));
		    }else{
		        $this->session->set_flashdata("pesan","Gagal Lengkapi data anda !");
		        redirect('mitra/home');
		    }
		}else{
			redirect('user');
		}
	}

	public function cariKinerjaReport() {
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='mitra'){

			// cari karyawan
			if($this->input->post("cari_kinerja")==""){
				redirect('mitra');
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
			    redirect('mitra');
			}else{
			    $config['base_url'] = base_url().'mitra/home/index/';
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
    			
    			
    			// parsing list_pengerjaan
    			$data6 = $kinerjaDB->pengerjaan;
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
    		    $param['view_pengerjaan'] = $data9;
    		    
                // load data base to list
                $param['kinerjaDB2'] = $hasil->result();
    			
                // load view
    			$this->load->view('mitra/template_cari', $param);
			}
		}else{
		    $this->session->set_flashdata("pesan","Maaf, Akses terbatas.");
			redirect('user');
		}
	}

    public function export_file(){
        // cek status
        if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='mitra'){
            header("Content-type: application/vnd-ms-excel");
 
            // Mendefinisikan nama file ekspor "kinerja_semua.xls"
            header("Content-Disposition: attachment; filename=kinerja_mitra.xls");
 
            // Tambahkan table
            $hasil = $this->App_model->laporan_mitra();
            $d['kinerjaDB'] = $hasil->result();
            
            $this->load->view('mitra/reza_excel', $d);
        }else{
            redirect('user');
        }
    }
}
