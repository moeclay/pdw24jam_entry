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

	public function index() {
        // cek status
        if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='bj'){

            // data data record
            // pagination karyawan
            $page=$this->uri->segment(4);
            $limit=10;

            if(!$page):
                $offset = 0;
            else:
                $offset = $page;
            endif;
            
            // data kinerja
            $hasil = $this->App_model->semua_data_kinerja($offset,$limit);
            
            $config['base_url'] = base_url().'bj/home/index/';
            
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
            $d['main_page'] = 'bj/list';
            $this->load->view('bj/template', $d);
        }else{
            redirect('user');
        }
	}

    public function cari_faktur() {
        // cek status
        if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='bj'){

            // cari karyawan
            if($this->input->post("cari_faktur")==""){
                redirect('bj');
            } else {
                $sess_data['kata'] = $this->input->post("cari_faktur");
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
            
            $d['tot'] = $offset;
            $hasil = $this->App_model->cariFaktur($kata,$offset,$limit);
            // $config['base_url'] = base_url().'bj/home/index/';
            // $config['total_rows'] = $hasil->num_rows();
            // $config['per_page'] = $limit;
            // $config['uri_segment'] = 4;
            // $config['full_tag_open'] = '<ul class="pagination">';
            // $config['full_tag_close'] = '</ul>';
            // $config['first_link'] = 'first';
            // $config['last_link'] = 'last';
            // $config['first_tag_open'] = '<li>';
            // $config['first_tag_close'] = '</li>';
            // $config['prev_link'] = '&laquo';
            // $config['prev_tag_open'] = '<li class="prev">';
            // $config['prev_tag_close'] = '</li>';
            // $config['next_link'] = '&raquo';
            // $config['next_tag_open'] = '<li>';
            // $config['next_tag_close'] = '</li>';
            // $config['last_tag_open'] = '<li>';
            // $config['last_tag_close'] = '</li>';
            // $config['cur_tag_open'] = '<li class="active"><a href="#">';
            // $config['cur_tag_close'] = '</a></li>';
            // $config['num_tag_open'] = '<li>';
            // $config['num_tag_close'] = '</li>';
            // $config['first_link'] = 'Awal';
            // $config['last_link'] = 'Akhir';
            // $config['next_link'] = 'Selanjutnya';
            // $config['prev_link'] = 'Sebelumnya';
            // $this->pagination->initialize($config);
            // $d["paginator"] =$this->pagination->create_links();
            $d['faktur'] = $hasil->row();

            // produk pesanan
            $d['produk_pesanan'] = $this->App_model->cari_produk($d['faktur']->produk_pesanan);
            
            // param semuaIDKaryawan
            $d['semuaIDKaryawan'] = $this->App_model->semuaIDKaryawanKinerja();

            // load view
            $d['main_page'] = 'bj/input_rak';
            $this->load->view('bj/template', $d);
        }else{
            redirect('user');
        }
    }

    // ubah detail area
    public function edit($id){
        if($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='bj'){
            // area sekarang
            $where          = array('no_invoice' => $id);
            $d['faktur'] = $this->App_model->edit_rak($where);
            
            // param semuaIDKaryawan
            $d['semuaIDKaryawan'] = $this->App_model->semuaIDKaryawan();
            
            $d['main_page'] = 'bj/input_rak';
            $this->load->view('bj/template',$d);
        }else{
            redirect('user');
        }
    }

    // update rak
    public function update_statusbj(){
        if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='bj'){

            // data validasi
            $this->form_validation->set_rules('no_invoice','No Invoice','trim|required');
            $this->form_validation->set_rules('no_rak1','No Rak','trim|required');

            // validasi form
            if($this->form_validation->run() == TRUE){
                // daftar yg di post
                $opx2        = $this->input->post('pengerjaan');
                $rak1        = $this->input->post('no_rak1');
                $rak2        = $this->input->post('no_rak2');
                $marketplace = $this->input->post('marketplace');
                $invoice = $this->input->post('no_invoice');

                if(isset($opx2) && $opx2!=null){
                    $pengerjaan = implode(",",$opx2);
                    $datapengerjaan = explode(",",$pengerjaan);
                    if(count($datapengerjaan) == 1){
                         $data4 = getNamaKaryawan($datapengerjaan[0]);
                    }else{
                        $data3 = array();
                        foreach($datapengerjaan as $d2){
                            array_push($data3,getNamaKaryawan($d2));
                        }
                        $data4 = implode(",",$data3);   
                    }
                }else{
                    $pengerjaan = 'kosong';
                }

                $where  = array(
                    'no_invoice'        => $invoice
                ); 

                $table = 'bj_reportkinerja';
                $data = array(
                    'pengerjaan'        => $pengerjaan,
                    'faktur_rak'        => $rak1.','.$rak2.','.$marketplace,
                    'faktur_status'     => 'Belum Diambil',
                    'operator_input'    => $this->session->userdata('user_name'),
                    'tanggal_selesai'   => date("Y-m-d H:i:s"),
                    'ip_selesai'        => getUserIpAddr()
                );
                $this->App_model->ubah_data($table, $data, $where);

                $this->session->set_flashdata("sukses","Berhasil, rak berhasil ditambahkan !");
                header('location:'.site_url('bj/home'));
            }else{
                redirect('user');
            }
        }else{
            redirect('user');
        }
    }

    // update barcode
    public function update_barcode(){
        if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='bj'){

            // data validasi
            $this->form_validation->set_rules('barcode_barang','Barcode Barang','trim|required');
            $this->form_validation->set_rules('no_invoice','No Invoice','trim|required');

            // validasi form
            if($this->form_validation->run() == TRUE){
                // daftar yg di post
                $barcode_barang = $this->input->post('barcode_barang');
                $note           = $this->input->post('note');
                $invoice        = $this->input->post('no_invoice');
                
                // cek jika barcode tidak sesuai dg no invoice
                if($barcode_barang != $invoice){
                    $this->session->set_flashdata("gagal","Barcode harus sesuai no invoice.");
                    header('location:'.site_url('bj/home'));
                }else{
                    $where  = array(
                        'no_invoice'        => $invoice
                    ); 
    
                    $table = 'bj_reportkinerja';
                    $data = array(
                        'barcode'           => $barcode_barang,
                        'note'              => $note,
                        'faktur_status'     => 'Sudah Diambil',
                        'operator_ambil'    => $this->session->userdata('user_name'),
                        'tanggal_ambil'     => date("Y-m-d H:i:s"),
                        'ip_barcode'        => getUserIpAddr()
                    );
                    $lsh = $this->App_model->ubah_data($table, $data, $where);
    
                    $this->session->set_flashdata("simpan","Barang Sudah Diambil");
                    header('location:'.site_url('bj/home'));             
                }

            }else{
                redirect('user');
            }
        }else{
            redirect('user');
        }
    }
    
    public function late(){
        // cek status
        if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='bj'){
            $d['data'] = $this->App_model->gen4();
            
            $d['main_page'] = 'bj/listbad';
            $this->load->view('bj/template', $d);
        }else{
            redirect('user');
        }
    }
}
