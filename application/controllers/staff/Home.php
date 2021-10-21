<?php
error_reporting(0);
/**
* Tanggal : 10 Oktober 2019
* Tujuan  : Penambahan form commitment to customer, for (get date & time customer) to get items ordered.
* form input kasir akan tersimpan di simpan_kinerja2
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $apimutasi = "https://pandawa24jam.com/mutasi/";

	public function __construct(){
		parent::__construct();
	}

	public function index() {
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='staff'){
		    // param semuaIDKaryawan
		    $d['semuaIDKaryawan'] = $this->App_model->semuaIDKaryawanKinerja();
		    
		    $query = "SELECT id,kode,produk,group_produk FROM daftar_produk ORDER BY id ASC";
        	$d['listProduk'] = $this->App_model->getALL($query);

			// load view
			$d['main_page']	= 'staff/input_kinerja';
			$this->load->view('staff/template', $d);
		}else{
			redirect('user');
		}
	}
	
	
	public function simpan_kinerja(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='staff'){
		    
		    // validasi form
		    $this->form_validation->set_rules('tgl_spk','Tanggal SPK','trim|required');
            $this->form_validation->set_rules('no_invoice','No Invoice','trim|required');
            $this->form_validation->set_rules('tgl1','Tanggal 1','trim|required');
            $this->form_validation->set_rules('tgl2','Tanggal 2','trim|required');
            $this->form_validation->set_rules('tgl3','Tanggal 3','trim|required');
            $this->form_validation->set_rules('jam','Jam','trim|required');
            $this->form_validation->set_rules('menit','Menit','trim|required');

		    if($this->form_validation->run() == TRUE){
    			// daftar input post
    			$invoice_terakhir   = getNomerKinerja();
    			$tgl_spk            = $this->input->post('tgl_spk');
    			$no_invoice         = $this->input->post('no_invoice');
    			$design_edit        = $this->input->post('design_edit');
                $opx1               = $this->input->post('penerimaan');
                $tgl1               = $this->input->post('tgl1');
                $tgl2               = $this->input->post('tgl2');
                $tgl3               = $this->input->post('tgl3');
                $jam                = $this->input->post('jam');
                $menit              = $this->input->post('menit');
    
                if(isset($opx1) && $opx1!=null){
                    $penerimaan = implode(",",$opx1);
                    $datapenerimaan = explode(",",$penerimaan);
                    if(count($datapenerimaan) == 1){
                         $data4 = getNamaKaryawan($datapenerimaan[0]);
                    }else{
                        $data3 = array();
                        foreach($datapenerimaan as $d2){
                            array_push($data3,getNamaKaryawan($d2));
                        }
                        $data4 = implode(",",$data3);   
                    }
                }else{
                    $penerimaan = 'kosong';
                }

                // algoritma data
                $year       = date('y');
                $month      = date('m');
                $day        = date('d');
                $header_id  = $year.$month.$day;

                $nomer_invoiceterakhir = $header_id.$invoice_terakhir;
    			
                $data = array(
    				'id_kinerja'     	=> $nomer_invoiceterakhir,
    				'tgl_spk'	        => $tgl_spk,
    				'no_invoice'	    => $no_invoice,
    				'design_edit'       => $design_edit,
    				'penerimaan'        => $penerimaan,
                    'faktur_status'     => 'Diproses',
                    'ip_input'          => getUserIpAddr(),
                    'commit_time'       => $tgl3.'-'.$tgl2.'-'.$tgl1.' '.$jam.':'.$menit.':00',
                    'commit_unix'       => strtotime($tgl3.'-'.$tgl2.'-'.$tgl1.' '.$jam.':'.$menit.':00')
    			);
			    
			    // ambil data dg parameter no_invoice jika ada
                $cekdata   = $this->App_model->apiscr($no_invoice);
                $hasildata = count($cekdata);
                
                if($hasildata >= 1){
                    $this->session->set_flashdata("warning","Nomer invoice sudah disimpan.");
                    header('location:'.site_url('staff/home'));
                }else{
                    $table = 'bj_reportkinerja';
                    $this->App_model->tambah_data($table, $data);
                    $this->session->set_flashdata("sukses","Berhasil, Nomer faktur berhasil ditambahkan !");
                    $this->session->set_flashdata("simpan","Nomer ID Kinerja : $invoice_terakhir");

                    // push with pusher
                    $options = array(
					    'cluster' => 'ap1',
					    'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					    'e9fb609c093c4a456d73',
					    '5a5f7f43dcd6d4323ad1',
					    '926404',
					    $options
					);
					$data = array('update_pusher' => date('d-m-Y H:i:s'));
					$pusher->trigger('my-channel', 'my-event', $data);
					
                    header('location:'.site_url('staff/home'));
                }
                
		    }else{
		        $this->session->set_flashdata("pesan","Gagal Lengkapi data anda !");
		        redirect('staff/home');
		    }
		}else{
			redirect('user');
		}
	}

	public function cari_record() {
		// cek status
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='staff'){
            
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
			$limit=25;
			if(!$page):
				$offset = 0;
			else:
				$offset = $page;
			endif;
			
			$hasil = $this->App_model->cariKinerjaDB($kata,$offset,$limit);

			// check result 'hasil pencarian'
			if($hasil->row() == null){
			    $this->session->set_flashdata("pesan","No invoice tidak ditemukan!");
			    redirect('staff');
			}else if(count($hasil->result()) > 1){
				// this all array result, and get 1 row first
   				$d["kinerjaDB"] = $hasil->result()[0];
			}else{
				$d["kinerjaDB"] = $hasil->row();
			}

   			$d['produk_pesanan'] = $this->App_model->cari_produk($d['kinerjaDB']->produk_pesanan);
   			$d['main_page']	= 'staff/carikinerja';
    		$this->load->view('staff/template', $d);
		}else{
	        redirect('user');
		}
    }

    public function mutasi(){
    	if($this->session->userdata('user_name') == 'online'){
    	    $url = $this->apimutasi."apicredit";
	        $ops = [
	          'http' => [
	            'header'  => "Content-type: application/json\r\n",
	            'method'  => 'GET'
	          ],
	        ];
	        $con = stream_context_create($ops);
	        $hasil = file_get_contents($url, false, $con);
	        $data['alltrx'] = json_decode($hasil);

	        $data['main_page']	= 'staff/mutasi_trx';
    		$this->load->view('staff/template', $data);
    	}else{
    		redirect('/');
    	}
    }
    public function mutasiinfo(){
    	if($this->session->userdata('user_name') == 'online'){
    	    $url = $this->apimutasi."infoRekening";
	        $ops = [
	          'http' => [
	            'header'  => "Content-type: application/json\r\n",
	            'method'  => 'GET'
	          ],
	        ];
	        $con = stream_context_create($ops);
	        $hasil = file_get_contents($url, false, $con);
	        $data['allinfo'] = json_decode($hasil);

	        $data['main_page']	= 'staff/mutasi_info';
    		$this->load->view('staff/template', $data);
    	}else{
    		redirect('/');
    	}
    }
}
