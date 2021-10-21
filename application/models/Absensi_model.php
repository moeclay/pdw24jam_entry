<?php
class Absensi_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function getEvent($iddivisi=null){
		$sql_month = "SELECT id, title, start_event, end_event, color FROM events WHERE id_divisi='$iddivisi' ORDER BY id ASC";
		$hasil = $this->db->query($sql_month);
		return $hasil->result();
	}

	public function getKaryawanDivisiAktif($iddivisi=null){
		$sql_employee = "SELECT a.id_divisi, a.nama_divisi, b.id_karyawan, b.nama_lengkap FROM divisi a JOIN karyawan b ON a.id_divisi=b.id_divisi WHERE b.nama_lengkap IS NOT NULL AND b.status='aktif' AND b.id_divisi='$iddivisi' ORDER BY a.nama_divisi ASC";
		$hasil = $this->db->query($sql_employee);
		return $hasil->result();
	}

	public function getAllDivisi(){
		$sql_employee = "SELECT id_divisi, nama_divisi FROM divisi ORDER BY nama_divisi ASC";
		$hasil = $this->db->query($sql_employee);
		return $hasil->result();
	}
}