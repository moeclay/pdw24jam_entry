<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    
	public function index(){
		if ($this->session->userdata('is_logged_in') && $this->session->userdata('status')=='admin'){
		    try{
    			if(isset($_GET['bulan'])){
    			    header("Content-type: application/vnd-ms-excel");
    			    header("Content-Disposition: attachment; filename=report_kpi_bulan.xls");
    			    
    			    $bulan = $_GET['bulan'];
                    $sql = "SELECT * FROM bj_reportkinerja WHERE month(tanggal_input)='$bulan' ORDER BY tanggal_input";
                    $d['data'] = $this->App_model->getALL($sql);
                    
        			$this->load->view('report/report_kpi_bulan', $d);
    			}else{
    			    echo "cara akses report : http://192.168.4.25/entry/admin/report?bulan=12";
    			}
		    } catch(Exception $e) {
                echo $e->getMessage();
            }
		}else{
			redirect('user');
		}
	}
	
	public function personalpoint(){
	    $this->load->view('report/report_kpi_personalpoint');
	}
}