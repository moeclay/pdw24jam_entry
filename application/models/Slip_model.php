<?php
class Slip_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getSlipAll($table=null){
	    if(isset($table) && ($table != null)){
	        $hasil = $this->db->query("SELECT b.idslip, a.nama_lengkap, b.idkaryawan, b.kodeslip, b.tahun_bulan, b.link_slip FROM karyawan a JOIN tbl_slipgaji b ON a.id_karyawan=b.idkaryawan ORDER BY idslip DESC");
	        return $hasil->result();
	    }else{
	        return [];
	    }
	}

	public function getSlipById($table=null, $idkaryawan=null){
	    if(isset($idkaryawan) && ($idkaryawan != null)){
	        $hasil = $this->db->query("SELECT * FROM $table WHERE idkaryawan='$idkaryawan' ORDER BY tahun_bulan DESC");
	        return $hasil->result();
	    }else{
	        return [];
	    }
	}
	
	// sql cari id
	public function getSlipByKode($table=null, $kodeslip=null){
	    if(isset($kodeslip) && ($kodeslip != null)){
	        $hasil = $this->db->query("SELECT link_slip FROM $table WHERE kodeslip='$kodeslip'");
	        return $hasil->result()[0];
	    }else{
	        return [];
	    }
	}
}