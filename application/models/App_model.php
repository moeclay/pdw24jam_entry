<?php
class App_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	// output semua data berdasarkan table
	// didasari dari offset && limit
	public function semua_data($table, $offset=null, $limit=null){
		if($offset == null && $limit==null){
			$hasil = $this->db->query("SELECT * FROM $table WHERE stts_login='bj' OR stts_login='staff' OR stts_login='koperasi'");
		}else{
			$hasil = $this->db->query("SELECT * FROM $table WHERE stts_login='bj' OR stts_login='staff' OR stts_login='koperasi' LIMIT $offset, $limit");
		}
		
		return $hasil->result();
	}
	
	public function semua_data_kinerja($offset=null, $limit=null){
		if($offset == null && $limit==null){
			$hasil = $this->db->query("SELECT * FROM bj_reportkinerja WHERE faktur_status='Sudah Diambil' ORDER BY tanggal_ambil DESC");
		}else{
			$hasil = $this->db->query("SELECT * FROM bj_reportkinerja WHERE faktur_status='Sudah Diambil' ORDER BY tanggal_ambil DESC LIMIT $offset, $limit");
		}
		
		return $hasil;
	}

	public function cari_produk($produk=null){
		if(isset($produk)){
			$string = $produk;
			$array  = explode(',', $string);
			$array2  = implode("','",$array);
			$query  = "SELECT kode, produk, group_produk FROM daftar_produk WHERE kode IN ('".$array2."')";
			$hasil = $this->db->query($query);
			return $hasil->result();
		}
	}
	
	public function semua_data_koperasi($offset=null, $limit=null){
		if($offset == null && $limit==null){
			$hasil = $this->db->query("SELECT * FROM bj_koperasi ORDER BY tanggal_input DESC");
		}else{
			$hasil = $this->db->query("SELECT * FROM bj_koperasi ORDER BY tanggal_input DESC LIMIT $offset, $limit");
		}
		
		return $hasil;
	}

	public function laporan_koperasi(){
		$sql = "SELECT * FROM bj_koperasi";
		$query = $this->db->query($sql);

		return $query;
	}


	// cek nomor faktur
	public function cekNoFaktur(){
		$sql = "SELECT no_invoice FROM bj_reportkinerja";
		$query = $this->db->query($sql);
		$data = $query->result_array();

		return $data;
	}
	
	public function semuaIDKaryawanKinerja(){
	    $urlimg = base_url('assets/foto/');
	    $hasil = $this->db->query("SELECT 
        	a.id_karyawan, 
        	a.nama, a.jabatan,
        	b.nama_divisi
        	FROM karyawan as a
        	LEFT JOIN divisi b 	
        	ON a.id_divisi=b.id_divisi
            LEFT JOIN area c
        	ON b.id_area=c.id_area
        	WHERE a.stts_kinerja = 'aktif'
        	ORDER BY b.nama_divisi ASC
	    ");
	    return $hasil->result();
	}
	
	public function semuaIDKaryawan(){
	    $urlimg = base_url('assets/foto/');
	    $hasil = $this->db->query("SELECT 
        	a.id_karyawan, a.nama, a.jabatan, concat('$urlimg',a.foto) as foto, a.pendidikan, a.telp, a.email, a.stts_login, a.masa_kerja,
        	b.nama_divisi, 
        	c.nama_area 
        	FROM karyawan as a
        	LEFT JOIN divisi b 	
        	ON a.id_divisi=b.id_divisi
            LEFT JOIN area c
        	ON b.id_area=c.id_area;
	    ");
	    return $hasil->result();
	}
	
	public function cariIDKaryawan($nama){
	    $urlimg = base_url('assets/foto/');
	    // $hasil = $this->db->query("SELECT a.id_karyawan,a.nama, b.nama_divisi FROM karyawan as a, divisi b WHERE a.id_divisi=b.id_divisi");
	    $hasil = $this->db->query("SELECT 
        	a.id_karyawan, a.nama, a.jabatan, concat('$urlimg',a.foto) as foto, a.pendidikan, a.telp, a.email, a.stts_login, a.masa_kerja,
        	b.nama_divisi, 
        	c.nama_area 
        	FROM karyawan as a
        	LEFT JOIN divisi b 	
        	ON a.id_divisi=b.id_divisi
            LEFT JOIN area c
        	ON b.id_area=c.id_area
        	WHERE a.nama LIKE '%$nama%'
	    ");
	    return $hasil->result();
	}

	// detail bj_reportkinerja
	public function edit_rak($where){
		$this->db->from('bj_reportkinerja');
		$this->db->where($where);
		$query = $this->db->get();

		// cek apakah data ada
		if($query->num_rows() == 1){
			return $query->row();
		}
	}

	// output data sekarang berdasarkan table
	// di dasari array where
	public function sekarang_data($table, $where){
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();

		// cek apkah data ada
		if($query->num_rows() == 1){
			return $query->row();
		}
	}

	// output tambah data
	public function tambah_data($table, $data){
		$this->db->insert($table, $data);
		return TRUE;
	}

	// output ubah data
	public function ubah_data($table, $data, $where){
		$this->db->where($where);
		$this->db->update($table, $data);
		return TRUE;
	}

	// output hapus data
	public function hapus_data($table, $where){
		$this->db->where($where);
		$this->db->delete($table);
		return TRUE;
	}

	// output semua data berdasarkan where
	public function semua_data_where($table, $where=null){
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result();
	}

	// data cari_faktur sekarang
	// cari karyawan
	public function cariKinerjaDB($kata=null,$offset=null,$limit=null){
		$sql = "SELECT * FROM bj_reportkinerja WHERE no_invoice LIKE '$kata' ORDER BY no_invoice DESC LIMIT ".$offset.",".$limit;
		$query = $this->db->query($sql);

		return $query;
	}

	// coari data dari kasir
	public function cariKinerjaKasir($kata=null,$offset=null,$limit=null){
		$sql = "SELECT id_kinerja, no_invoice, faktur_status, tgl_spk, total_harga, design_edit, penerimaan FROM bj_reportkinerja WHERE no_invoice LIKE '$kata' ORDER BY no_invoice DESC LIMIT ".$offset.",".$limit;
		$query = $this->db->query($sql);

		return $query;
	}

	// data cari_faktur sekarang
	// cari karyawan
	public function cariTotalNabung($kata=null){
		$sql = " SELECT  SUM(IF( `type` = 1 AND `penerimaan` = '$kata', nominal, 0)) AS kb,
			        	SUM(IF( `type` = 2 AND `penerimaan` = '$kata', nominal, 0)) AS kh,
			        	SUM(IF( `type` = 3 AND `penerimaan` = '$kata', nominal, 0)) AS ut,
			        	SUM(IF( `type` = 4 AND `penerimaan` = '$kata', nominal, 0)) AS s,
			        	SUM(IF( `type` = 4 AND `penerimaan` = '$kata', nominal, 0)) AS p,
			        	SUM(IF( `type` = 4 AND `penerimaan` = '$kata', nominal, 0)) AS b
					FROM `bj_koperasi`";

		$query = $this->db->query($sql);

		return $query;
	}

	public function cariTotalNabungg($where,$offset=null,$limit=null){
		$sql = " SELECT  SUM(IF( `type` = 1 AND `penerimaan` = '$kata', nominal, 0)) AS kb,
			        	SUM(IF( `type` = 2 AND `penerimaan` = '$kata', nominal, 0)) AS kh,
			        	SUM(IF( `type` = 3 AND `penerimaan` = '$kata', nominal, 0)) AS ut,
			        	SUM(IF( `type` = 4 AND `penerimaan` = '$kata', nominal, 0)) AS s,
			        	SUM(IF( `type` = 4 AND `penerimaan` = '$kata', nominal, 0)) AS p,
			        	SUM(IF( `type` = 4 AND `penerimaan` = '$kata', nominal, 0)) AS b
					FROM `bj_koperasi`";

		$query = $this->db->query($sql);

		return $query;
	}


	public function cariKinerjaMtr($kata=null,$offset=null,$limit=null){
		$sql = "SELECT * FROM bj_koperasi WHERE penerimaan LIKE '$kata' ORDER BY tanggal_input DESC LIMIT ".$offset.",".$limit;
		$query = $this->db->query($sql);

		return $query;
	}

	// data cari_faktur sekarang
	// cari karyawan
	public function cariFaktur($kata=null,$offset=null,$limit=null){
		$sql = "SELECT produk_pesanan, produk_selesai, commit_time, no_invoice, penerimaan, faktur_status, design_edit,  pengerjaan, faktur_rak, tanggal_ambil, operator_ambil, note  
			FROM bj_reportkinerja
			WHERE no_invoice LIKE '$kata' 
			ORDER BY no_invoice 
			DESC LIMIT ".$offset.",".$limit;
		$query = $this->db->query($sql);

		return $query;
	}

	//------------------------------------------------------------------------------
	public function nama_staff(){
		$sql = "SELECT user FROM bj_staff WHERE stts_login='staff'";
		$data = $this->db->query($sql);
		return $data->result();
	}
	
	//-------------------------------------------------------------------------------

	// Model Laporan
	public function total_kinerja(){
		$sql = "SELECT * FROM bj_reportkinerja";
		$query = $this->db->query($sql);
		$data = $query->result_array();

		return $data;
	}
	public function laporan_kinerja(){
		$sql = "SELECT * FROM bj_reportkinerja";
		$query = $this->db->query($sql);

		return $query;
	}
	public function total_sudah_diambil(){
		$sql = "SELECT * FROM bj_reportkinerja WHERE faktur_status='Sudah Diambil'";
		$query = $this->db->query($sql);
		$data = $query->result_array();

		return $data;
	}
	public function total_belum_diambil(){
		$sql = "SELECT * FROM bj_reportkinerja WHERE faktur_status='Belum Diambil'";
		$query = $this->db->query($sql);
		$data = $query->result_array();

		return $data;
	}
	public function total_diproses(){
		$sql = "SELECT * FROM bj_reportkinerja WHERE faktur_status='Diproses'";
		$query = $this->db->query($sql);
		$data = $query->result_array();

		return $data;
	}

	// Model Laporan
	public function total_terakhir_kinerja($bln=null){
		$sql = "SELECT * FROM bj_reportkinerja WHERE month(tanggal_input)='$bln'";
		$query = $this->db->query($sql);
		$data = $query->result_array();

		return $data;
	}
	public function total_terakhir_sudah_diambil($bln=null){
		$sql = "SELECT * FROM bj_reportkinerja WHERE month(tanggal_input)='$bln' AND faktur_status='Sudah Diambil'";
		$query = $this->db->query($sql);
		$data = $query->result_array();

		return $data;
	}
	public function total_terakhir_belum_diambil($bln=null){
		$sql = "SELECT * FROM bj_reportkinerja WHERE month(tanggal_input)='$bln' AND faktur_status='Belum Diambil'";
		$query = $this->db->query($sql);
		$data = $query->result_array();

		return $data;
	}
	public function total_terakhir_diproses($bln=null){
		$sql = "SELECT * FROM bj_reportkinerja WHERE month(tanggal_input)='$bln' AND faktur_status='Diproses'";
		$query = $this->db->query($sql);
		$data = $query->result_array();

		return $data;
	}

	// Export Excell
	public function export_excellmonthly($month=null,$year=null){
		$sql = "SELECT * FROM bj_reportkinerja WHERE MONTH(tanggal_input)='$month' AND YEAR(tanggal_input)='$year'";
		$query = $this->db->query($sql);

		return $query;
	}


    // realtime lokal
	public function gen2(){
		$sql   = "SELECT a.tanggal_input, a.no_invoice, a.faktur_status, b.nama as penerimaan, a.commit_time as commit_time, now() as waktu_sekarang FROM bj_reportkinerja a LEFT JOIN karyawan b ON a.penerimaan = b.id_karyawan ORDER BY tanggal_input DESC LIMIT 0,45";
		$query = $this->db->query($sql);
		$data  = $query->result();

		return $data;  
	}
	
	// realtime web
	public function gen3(){
		$sql   = "SELECT a.tanggal_input, a.no_invoice, a.faktur_status, b.nama as penerimaan, a.commit_time as commit_time, now() as waktu_sekarang, a.commit_unix FROM bj_reportkinerja a LEFT JOIN karyawan b ON a.penerimaan = b.id_karyawan WHERE faktur_status='Diproses' AND commit_time > NOW() ORDER BY a.commit_unix ASC LIMIT 0,45";
		$query = $this->db->query($sql);
		$data  = $query->result();

		return $data;  
	}
	public function gen4(){
		$sql   = "SELECT a.tanggal_input, a.no_invoice, a.faktur_status, b.nama as penerimaan, a.commit_time as commit_time, now() as waktu_sekarang, a.commit_unix FROM bj_reportkinerja a LEFT JOIN karyawan b ON a.penerimaan = b.id_karyawan WHERE faktur_status='Diproses' AND commit_time < NOW() ORDER BY a.commit_unix ASC LIMIT 0,45";
		$query = $this->db->query($sql);
		$data  = $query->result();

		return $data;  
	}
	public function apiscr($fak) {
		$sql = "SELECT a.tanggal_input, a.no_invoice, a.faktur_status, b.nama as penerimaan, a.commit_time as commit_time, now() as waktu_sekarang FROM bj_reportkinerja a LEFT JOIN karyawan b ON a.penerimaan = b.id_karyawan WHERE no_invoice=$fak";
		$query = $this->db->query($sql);
		$data = $query->result();
		return $data;
		
	}

	// -------------------------------------------------------------
	// Modeling for Manage Karyawan
	// -------------------------------------------------------------
	// semua karyawan dari pagination
	public function allLoginKaryawan(){
		$sql = sprintf("SELECT * FROM karyawan WHERE stts_login = 'karyawan' ORDER BY nama ASC");
		$query = $this->db->query($sql);
		$data_user = $query->result();

		return $data_user;
	}

	public function allLoginKaryawanById(){
		$sql = sprintf("SELECT id_karyawan, nama_lengkap FROM karyawan WHERE stts_login = 'karyawan' AND nama_lengkap IS NOT NULL ORDER BY id ASC");
		$query = $this->db->query($sql);
		$data_user = $query->result();

		return $data_user;
	}

	// semua karyawan dari pagination
	public function allKaryawan(){
		$sql = sprintf("SELECT * FROM karyawan WHERE status = 'aktif' ORDER BY nama ASC");
		$query = $this->db->query($sql);
		$data_user = $query->result();

		return $data_user;
	}

	public function semuaKaryawan($offset=null,$limit=null){
		$sql = sprintf("SELECT * FROM karyawan ORDER BY nama ASC LIMIT ".$offset.",".$limit);
		$query = $this->db->query($sql);
		$data_user = $query->result();

		return $data_user;
	}

	// detail karyawan
	public function sekarangKaryawan($where){
		$this->db->from('karyawan');
		$this->db->where($where);
		$query = $this->db->get();

		// cek apakah data ada
		if($query->num_rows() == 1){
			return $query->row();
		}
	}

	// hapus karyawan
	public function deleteKaryawan($where){
		$this->db->where($where);
		$this->db->delete('karyawan');
		return TRUE;
	}

	// cari karyawan
	public function cariKaryawan($kata){
		$sql = "SELECT * FROM karyawan WHERE nama LIKE '%$kata%'";
		$query = $this->db->query($sql);

		return $query;
	}

	// tambah karyawan
	public function addKaryawan($data=null){
		$this->db->insert('karyawan',$data);
		return TRUE;
	}

	// update karyawan
	public function updateKaryawan($data, $where){
		$this->db->where($where);
		$this->db->update('karyawan',$data);
		return TRUE;
	}
	// ---------------------------------------------------
	// Connect with Helper
	// ---------------------------------------------------

	// data semua berdasarkan id
	public function semuaAreaID(){
		$sql = sprintf("SELECT id_area, nama_area FROM area");
		$query = $this->db->query($sql);
		$data_area = $query->result_array();

		return $data_area;
	}
	public function semuaTokoID(){
		$sql = sprintf("SELECT id_toko, nama_toko FROM toko");
		$query = $this->db->query($sql);
		$data_toko = $query->result_array();

		return $data_toko;
	}
	public function semuaDivisiID(){
		$sql = sprintf("SELECT id_divisi, nama_divisi FROM divisi ORDER BY nama_divisi ASC");
		$query = $this->db->query($sql);
		$data_divisi = $query->result_array();

		return $data_divisi;
	}

	public function idakhirKaryawan(){
		$sql = "SELECT id_karyawan FROM karyawan";
		$query = $this->db->query($sql);
		$data = $query->result_array();

		return $data;
	}

	public function dataDivisi(){
		$sql = sprintf("SELECT * FROM divisi ORDER BY id_divisi ASC");
		$query = $this->db->query($sql);
		$data_divisi = $query->result();

		return $data_divisi;
	}

	public function semuaToko(){
		$sql = sprintf("SELECT * FROM toko");
		$query = $this->db->query($sql);
		$data_toko = $query->result();

		return $data_toko;
	}
	
	public function report_status(){
	    $a1 = $this->db->query("SELECT COUNT(*) as data_diproses FROM bj_reportkinerja WHERE faktur_status='Diproses'")->row();
	    $a2 = $this->db->query("SELECT COUNT(*) as data_diproses FROM bj_reportkinerja WHERE faktur_status='Belum Diambil'")->row();
	    $a3 = $this->db->query("SELECT COUNT(*) as data_diproses FROM bj_reportkinerja WHERE faktur_status='Sudah Diambil'")->row();
	    
	    $data = array(
	        'total_diproses' => $a1->data_diproses,
	        'total_selesai' => $a2->data_diproses,
	        'total_diambil' => $a3->data_diproses
	    );
	    return $data;
	}

	// report laporan2 grafik
	public function total14hari(){
		$sql = sprintf("SELECT tanggal,jumlah FROM v_total_14hari ORDER BY tanggal ASC");
		$data = $this->db->query($sql)->result();

		return $data;
	}
	
	public function totalbulanan(){
		$sql = sprintf("SELECT bulan,jumlah FROM v_total_bulan_2019 ORDER BY bulan ASC");
		$data = $this->db->query($sql)->result();

		return $data;
	}
	public function totalberjalansemua($bln=null){
		$sql = "SELECT count(*) as total FROM bj_reportkinerja WHERE month(tanggal_input)='$bln'";
		$data = $this->db->query($sql)->row();
		return $data->total;
	}
	public function totalberjalansudahdiambil($bln=null){
		$sql = "SELECT count(*) as total FROM bj_reportkinerja WHERE month(tanggal_input)='$bln' and faktur_status='Sudah Diambil'";
		$data = $this->db->query($sql)->row();
		return $data->total;
	}
	public function totalberjalanbelumdiambil($bln=null){
		$sql = "SELECT count(*) as total FROM bj_reportkinerja WHERE month(tanggal_input)='$bln' and faktur_status='Belum Diambil'";
		$data = $this->db->query($sql)->row();
		return $data->total;
	}
	public function totalberjalandiproses($bln=null){
		$sql = "SELECT count(*) as total FROM bj_reportkinerja WHERE month(tanggal_input)='$bln' and faktur_status='Diproses'";
		$data = $this->db->query($sql)->row();
		return $data->total;
	}
	public function totalberjalanpersentage(){
		$sql = "SELECT * from v_month_persentage ORDER BY status_kinerja ASC";
		$data = $this->db->query($sql)->result();
		return $data;
	}

    // -------------------------------------------------------------------------------------
	// QUERY FAST REZA
	public function updatefolderclay($name){
		$sql = $this->db->query("UPDATE folderclay SET folder_name='$name'");
		return true;
	}
	public function updatefileclay($time){
		$sql = $this->db->query("UPDATE folderclay SET next_update='$time'");
		return true;
	}
	public function getALL($query){
		$sql = $this->db->query($query);
		return $sql->result();
	}
	public function getROW($query){
		$sql = $this->db->query($query);
		return $sql->row();
	}
	
	public function graphberjalan14day(){
	    $sql = "SELECT
	        date(tanggal_input) as tanggal_real,
	        day(tanggal_input) as tanggal_title,
	        count(tanggal_input) as total 
        FROM bj_reportkinerja 
        WHERE date(tanggal_input) > (now() - interval 14 day)
        GROUP BY day(tanggal_input) 
	    ORDER BY tanggal_input ASC";
	    $data = $this->db->query($sql);
	    return $data->result();
	}
	
	public function graphbulanberjalan(){
	    $sql = "SELECT 
	        year(tanggal_input) as tahun, 
	        monthname(tanggal_input) as bulan_title, 
	        count(tanggal_input) as total  
            FROM bj_reportkinerja 
            WHERE year( tanggal_input ) = year( now( ) ) 
            GROUP BY month(tanggal_input)  ORDER BY tanggal_input desc limit 0,12";
        $data = $this->db->query($sql);
        return $data->result();
	}
}
