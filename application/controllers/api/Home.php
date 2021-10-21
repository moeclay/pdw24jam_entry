<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// ini_set("allow_url_fopen", true);
// error_reporting(0);

// CORS data json
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Home extends REST_Controller {
    public $auth_apikey = "x-pdw24jam-dgprint-cloud";

    function __construct($config = 'rest'){
        parent::__construct($config);

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    // route default
    // GET-URL: http://ddns.pandawa-mqzz.com:81/api/home
    // update: 6 february 2021
    public function index_get(){
        $data = array(
            'application'   => 'json/application',
            'code'          => 'rest kinerja',
            'author'        => 'Moeamar Reza R',
            'created'       => '6 February 2021'
        );
        $this->response($data, REST_Controller::HTTP_OK);
    }
    
    // daftar 45 data invoice 'Diproses' produksi
    // GET-URL: http://ddns.pandawa-mqzz.com:81/api/home/statusorder
    // update: 6 february 2021
    public function statusorder_get(){
        $dataSO = $this->App_model->gen3();
        $this->response($dataSO, REST_Controller::HTTP_OK);
    }
    
    public function statusordervue_get(){
        $oi = $this->App_model->gen3();
        $dataresponse = array();
        if(count($oi) >= 1){
	        foreach ($oi as $value) {
	        	$tanggal_input = $value->tanggal_input;
	        	$no_invoice = $value->no_invoice;
	        	$penerimaan = $value->penerimaan;
	        	$faktur_status = $value->faktur_status;
	        	$commit_time = $value->commit_time;
	        	$waktu_sekarang = $value->waktu_sekarang;

	        	$data_r = strtolower($faktur_status);
		        if($data_r == "diproses"){
		        	$resfakturstatus = "diproses";
		        }else if($data_r == "belum diambil"){
		        	$resfakturstatus = "siap diambil";
		        }else if($data_r == "sudah diambil"){
		        	$resfakturstatus = "telah diambil";
		        }
		        if($faktur_status == 'Diproses'){
	                $datetime1 = date_create($waktu_sekarang);
	                $datetime2 = date_create($commit_time);
	                $interval = date_diff($datetime1, $datetime2); 
	                $resdurasi = $interval->format('%d hari %h jam %i menit');
	            }else{
	                $resdurasi = "-";
	            }

	        	array_push($dataresponse, array($tanggal_input, $no_invoice, $penerimaan, $resfakturstatus, $resdurasi));
	        }
	        $this->response($dataresponse, REST_Controller::HTTP_OK);
        }else{
        	$this->response($dataresponse, REST_Controller::HTTP_OK);
        }
    }
    
    // cari invoice dari table 'bj_reportkinerja'
    // GET-URL: http://ddns.pandawa-mqzz.com:81/api/kinerja/cariinvoice/293155
    // update: 6 february 2021
    public function cariinvoice_get($invoice=null){
        // convert to number only
        $invoice = intval(preg_replace("/[^0-9.]/", "", $invoice));
        if(isset($invoice) && $invoice !== NULL){
            // ambil data dg parameter no_invoice jika ada
            $cekdata   = $this->App_model->apiscr($invoice);
            $hasildata = count($cekdata);
            
            if($hasildata >= 1){
                // OK (200) being the HTTP response code
                $this->response($cekdata, REST_Controller::HTTP_OK); 
            }else{
                $this->response([
                    'code' => 404,
                    'status' => FALSE,
                    'message' => 'invoice '.$invoice.' tidak ditemukan, URL: cariinvoice/12345'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }else{
            // membutuhkan nomoer invoice
            // NOT_FOUND (404) being the HTTP response code
            $this->response([
                'code' => 404,
                'status' => FALSE,
                'message' => 'invoice '.$invoice.' tidak ditemukan, URL: cariinvoice/12345'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    // proses kasir "invoice kinerja dibuat"
    // cari invoice + tambah dari table 'bj_reportkinerja'
    // POST-URL: http://localhost/entry/api/home/savekasir
    public function saveKasir_post(){
        // get header request
        $apikey = $this->input->get_request_header('api-key');

        if($apikey === $this->auth_apikey){
            // data post kinerja
            $data = file_get_contents('php://input');
            $json = json_decode($data);

            $tgl_spk            = $json->tgl_spk;
            $no_invoice         = $json->no_invoice;
            $commit_time        = $json->commit_time;
            $commit_unixtime    = $json->commit_unixtime;
            $desain_edit        = $json->desain_edit;
            $op_staff           = $json->op_staff;
            $produk             = $json->produk;
            
            $invoice_terakhir   = getNomerKinerja();
            $nomer_invoiceterakhir = $commit_unixtime.$invoice_terakhir;
            
            // validasi form input
            if(isset($tgl_spk) && isset($no_invoice) && isset($commit_time) && isset($commit_unixtime) && isset($desain_edit) && isset($op_staff) && isset($produk)){
            
                // check if no_invoice exists
                $cekdata   = $this->App_model->apiscr($no_invoice);
                $hasildata = count($cekdata);
                if($hasildata >= 1){
                    $this->response(['status' => 'failed', 'msg' => 'nomor invoice sudah ada'], REST_Controller::HTTP_BAD_REQUEST);
                }else{                
                    // array simpan ke database
                    $dataPostDB = array(
                        'id_kinerja'        => $nomer_invoiceterakhir,
                        'tgl_spk'           => $tgl_spk,
                        'no_invoice'        => intval($no_invoice),
                        'design_edit'       => intval($desain_edit),
                        'penerimaan'        => $op_staff,
                        'produk_pesanan'    => strtolower($produk),
                        'faktur_status'     => 'Diproses',
                        'ip_input'          => getUserIpAddr(),
                        'commit_time'       => $commit_time,
                        'commit_unix'       => strval($commit_unixtime)
                    );
                    $table = 'bj_reportkinerja';
                    $insertresult = $this->App_model->tambah_data($table, $dataPostDB);
                    $this->response(['status' => 'success'], REST_Controller::HTTP_OK);

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
                }
            }else{
                $this->response(['status' => 'failed', 'msg' => 'data tidak tervalidasi'], REST_Controller::HTTP_OK);
            }   
        }else{
            $this->response(['status' => 'failed', 'msg' => 'data tidak tervalidasi'], REST_Controller::HTTP_OK);
        }
    }
    
    // daftar staff/operator kinerja pandawa24jam
    // GET-URL: http://ddns.pandawa-mqzz.com:81/api/home/daftarstaff
    public function daftarstaff_get(){
        $allStaff = $this->App_model->semuaIDKaryawan();
        $this->response($allStaff, REST_Controller::HTTP_OK);
    }
    
    // cari nama karyawan
    // GET-URL: http://ddns.pandawa-mqzz.com:81/api/home/caristaff/$nama
    // update: 6 february 2021
    public function caristaff_get($nama=null){
        if(isset($nama)){
            $allStaff = $this->App_model->cariIDKaryawan($nama);
        }else{
            $allStaff = array(
                'code'  => 404,
                'error' => 'caristaff/$name, dibutuhkan parameter nama'
            );
        }
        $this->response($allStaff, REST_Controller::HTTP_OK);
    }


    /*
        URL: http://localhost/entry/api/home/divisiproduksi
        parameter: none
    */
    public function divisiproduksi_get(){
        $query = "SELECT id_divisi, nama_divisi FROM `divisi` WHERE bagian='produksi'";
        $listDivisi = $this->App_model->getALL($query);
        $this->response($listDivisi, REST_Controller::HTTP_OK);
    }

}
