<?php
class Karyawan_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	// cari karyawan
	public function semuaData($id, $bulan, $tahun){
		$sql = "SELECT a.*, b.*, c.*, d.*, e.*
		FROM karyawan a 
		LEFT JOIN divisi b ON b.id_divisi = a.id_divisi
		LEFT JOIN toko c ON c.id_toko = a.id_toko
		LEFT JOIN bj_reportkinerja d ON d.id_karyawan = a.id_karyawan 
		LEFT JOIN absen e ON e.id_karyawan = a.id_karyawan 
		WHERE a.id_karyawan='$id' AND e.bulan='$bulan' AND e.tahun='$tahun' AND d.bulan='$bulan' AND d.tahun='$tahun'";
		$query = $this->db->query($sql);

		return $query->row();
	}

	public function bulanAkhir(){
		$sql = "SELECT max(bulan) as bulan_terakhir FROM bj_reportkinerja";
		$query = $this->db->query($sql);
		$data = $query->row();

		return $data->bulan_terakhir;
	}

	public function tahunAkhir(){
		$sql = "SELECT max(tahun) as tahun_terakhir FROM bj_reportkinerja";
		$query = $this->db->query($sql);
		$data = $query->row();

		return $data->tahun_terakhir;
	}

	public function DataAbsen($id, $bulan, $tahun){
		$sql = "SELECT * FROM absen WHERE id_karyawan='$id' AND bulan='$bulan' AND tahun='$tahun'";
		$query = $this->db->query($sql);
		$data = $query->row();

		return $data;
	}


	// -------------------------------   CARI RANKING PER DIVISI     --------------------------------------

	// CARI BANYAK KARYAWAN PER TOKO - DIVISI
	public function Total_Operator_Per_Divisi_Pandawa24Jam(){
		$sql   = "SELECT id_divisi, count(*) as total_orang FROM karyawan WHERE id_toko='T01' GROUP BY id_divisi" ;
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	public function Total_Operator_Per_Divisi_Mitra(){
		$sql   = "SELECT id_divisi, count(*) as total_orang FROM karyawan WHERE id_toko='T02' GROUP BY id_divisi" ;
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	public function Total_Operator_Per_Divisi_Kresna(){
		$sql   = "SELECT id_divisi, count(*) as total_orang FROM karyawan WHERE id_toko='T03' GROUP BY id_divisi" ;
		$query = $this->db->query($sql);

		return $query->result_array();
	}


	// cari ranking semua, order by id_karyawan
	public function Ranking_Divisi($id_divisi, $id_toko, $bulan, $tahun){
		$sql   = "
			SELECT 
				a.id_karyawan,
				a.nama, 
				b.bulan, 
				b.tahun, 
				b.hari_kerja, 
				c.point_edit, 
				c.point_bj_reportkinerja, 
				c.transaksi, 				
				round((c.point_edit/(b.jam_kerja/b.hari_kerja)),2) as nilai_edit,  
				round(((c.transaksi/(b.jam_kerja/b.hari_kerja)) + (c.point_bj_reportkinerja/(b.jam_kerja/b.hari_kerja)) / 2), 2) as nilai_transaksi, 
				round(((c.point_edit/(b.jam_kerja/b.hari_kerja))+((c.transaksi/(b.jam_kerja/b.hari_kerja)) + (c.point_bj_reportkinerja/(b.jam_kerja/b.hari_kerja)) / 2)), 2) as total_nilai
			FROM karyawan a  
			LEFT JOIN absen b ON a.id_karyawan=b.id_karyawan 
			LEFT JOIN bj_reportkinerja c ON a.id_karyawan=c.id_karyawan
			WHERE a.id_divisi='$id_divisi'  
				AND a.id_toko='$id_toko'  
				AND b.bulan='$bulan'  
				AND b.tahun='$tahun'  
				AND c.bulan='$bulan'  
				AND c.tahun='$tahun'  
			ORDER BY a.nama";

		$query = $this->db->query($sql);

		return $query;
	}

	public function Ambil_Total_Nilai($id_divisi, $id_toko, $bulan, $tahun){
		$sql = "SELECT
			a.id_karyawan, a.nama,
			round(((c.point_edit/(b.jam_kerja/b.hari_kerja))+((c.transaksi/(b.jam_kerja/b.hari_kerja)) + (c.point_bj_reportkinerja/(b.jam_kerja/b.hari_kerja)) / 2)), 2) as total_nilai
		FROM karyawan a
		LEFT JOIN absen b ON a.id_karyawan=b.id_karyawan 
		LEFT JOIN bj_reportkinerja c ON a.id_karyawan=c.id_karyawan
		WHERE a.id_divisi='$id_divisi'  
			AND a.id_toko='$id_toko'  
			AND b.bulan='$bulan'  
			AND b.tahun='$tahun'  
			AND c.bulan='$bulan'  
			AND c.tahun='$tahun' 
		ORDER BY total_nilai DESC";
		$query = $this->db->query($sql);

		return $query;
	}

	public function Cari_Id_Toko($id){
		$sql = "SELECT id_karyawan, nama, id_toko, id_divisi FROM karyawan WHERE id_karyawan='$id'";
		$query = $this->db->query($sql);
		$data  = $query->row();

		return $data;
	}

	// ambil data per divisi
	public function Grafik_Karyawan($id_divisi, $id_toko, $bulan, $tahun){
		$sql = "SELECT 
				a.id_karyawan, 
				a.nama, 
				round((c.point_edit/(b.jam_kerja/b.hari_kerja)),2) as edit_hari,  
				round(((c.transaksi/(b.jam_kerja/b.hari_kerja)) + (c.point_bj_reportkinerja/(b.jam_kerja/b.hari_kerja)) / 2), 2) as trs_point_hari , 
				round(((c.point_edit/(b.jam_kerja/b.hari_kerja))+((c.transaksi/(b.jam_kerja/b.hari_kerja)) + (c.point_bj_reportkinerja/(b.jam_kerja/b.hari_kerja)) / 2)), 2) as total_nilai
			FROM karyawan a   
				LEFT JOIN absen b ON a.id_karyawan=b.id_karyawan  
				LEFT JOIN bj_reportkinerja c ON a.id_karyawan=c.id_karyawan 
			WHERE a.id_divisi='$id_divisi'   
				AND a.id_toko='$id_toko'   
				AND b.bulan='$bulan'   
				AND b.tahun='$tahun'   
				AND c.bulan='$bulan'   
				AND c.tahun='$tahun'   
		ORDER BY total_nilai DESC";
		$query = $this->db->query($sql);
		$data  = $query->result_array();

		return $data;
	}
}
