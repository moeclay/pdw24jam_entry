<?php
class Dashboard_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	// jumlah no_invoice dalam setahun (berjalan)
	public function yearCount($year=null){
		$sql_year_finished = "SELECT COUNT(DISTINCT `no_invoice`) as 'total_order_selesai' 
		FROM `bj_reportkinerja` 
		WHERE `faktur_status`= 'Sudah Diambil' AND (year(`bj_reportkinerja`.`tanggal_input`) = $year)";
		$hasil = $this->db->query($sql_year_finished);
		return $hasil->row();
	}

	// jumlah no_invoice tiap bulan (berjalan)
	public function graphMonthly($year=null){
		$sql_month_in_year="SELECT
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '01') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `jan` ,
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '02') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `feb`,
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '03') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `mar`,
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '04') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `apr`,
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '05') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `mei`,
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '06') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `jun`,
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '07') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `jul`,
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '08') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `aug`,
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '09') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `sep`,
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '10') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `oct`,
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '11') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `nov`,
			(SELECT count(0) from `bj_reportkinerja` where ((MONTH(`bj_reportkinerja`.`tanggal_input`) = '12') and (year(`bj_reportkinerja`.`tanggal_input`) = $year) and  `bj_reportkinerja`.`faktur_status`='Sudah Diambil')) AS `des` 
			FROM bj_reportkinerja 
			WHERE (year(`bj_reportkinerja`.`tanggal_input`) = $year)";
		$hasil = $this->db->query($sql_month_in_year);
		return $hasil->row_array();
	}

	// status telat dalam setahun (berjalan)
	public function yearStat(){
		$sql_yearstat="SELECT 
            	sum(total) as total_tahun, 
            	sum(total_putih) as total_tahun_putih, 
            	sum(total_hijau) as total_tahun_hijau, 
            	sum(total_kuning) as total_tahun_kuning, 
            	sum(total_merah) as total_tahun_merah, 
            	sum(total_ungu) as total_tahun_ungu 
            FROM total_kinerja_bulanan_report";
		$hasil = $this->db->query($sql_yearstat);
		return $hasil->result();
	}

	// status kinerja divisi
	public function divisiStat(){
		$sql_kinerja_divisi = "SELECT * FROM total_kinerja_berjalan_divisi_ranking ORDER BY nama_divisi DESC";
		$hasil = $this->db->query($sql_kinerja_divisi);
		return $hasil->result();
	}

	// stat employe terburuk
	public function employeeBad(){
		// define array empty
        $array_staff_terburuk = array();

        $sql_fotocopy1 = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Fotocopy' ORDER BY selisih ASC LIMIT 1";
        array_push($array_staff_terburuk, $this->db->query($sql_fotocopy1)->row());
        
        $sql_develop1 = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Digital A3+' ORDER BY selisih ASC LIMIT 1";
        array_push($array_staff_terburuk, $this->db->query($sql_develop1)->row());
        
        $sql_creative1 = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Creative' ORDER BY selisih ASC LIMIT 1";
        array_push($array_staff_terburuk, $this->db->query($sql_creative1)->row());
        
        $sql_banner1 = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Banner' ORDER BY selisih ASC LIMIT 1";
        array_push($array_staff_terburuk, $this->db->query($sql_banner1)->row());
        
        $sql_penjilidan1 = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Penjilidan' ORDER BY selisih ASC LIMIT 1";
        array_push($array_staff_terburuk, $this->db->query($sql_penjilidan1)->row());
        
        $sql_bengkel_buku1 = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Bengkel Buku' ORDER BY selisih ASC LIMIT 1";
        array_push($array_staff_terburuk, $this->db->query($sql_bengkel_buku1)->row());
        
        return $array_staff_terburuk;
	}

	// stat employee terbaik
	public function employeeGood(){
		// define array empty
		$array_staff_terbaik = array();
        
        $sql_fotocopy = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Fotocopy' ORDER BY selisih DESC LIMIT 1";
        array_push($array_staff_terbaik, $this->db->query($sql_fotocopy)->row());
        
        $sql_develop = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Digital A3+' ORDER BY selisih DESC LIMIT 1";
        array_push($array_staff_terbaik, $this->db->query($sql_develop)->row());
        
        $sql_creative = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Creative' ORDER BY selisih DESC LIMIT 1";
        array_push($array_staff_terbaik, $this->db->query($sql_creative)->row());
        
        $sql_banner = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Banner' ORDER BY selisih DESC LIMIT 1";
        array_push($array_staff_terbaik, $this->db->query($sql_banner)->row());
        
        $sql_penjilidan = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Penjilidan' ORDER BY selisih DESC LIMIT 1";
        array_push($array_staff_terbaik, $this->db->query($sql_penjilidan)->row());
        
        $sql_bengkel_buku = "SELECT  id_karyawan as id,
        	nama,
        	nama_divisi,
        	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
        FROM total_kinerja_berjalan_produksi 
        	WHERE nama_divisi='Bengkel Buku' ORDER BY selisih DESC LIMIT 1";
        array_push($array_staff_terbaik, $this->db->query($sql_bengkel_buku)->row());
        
        return $array_staff_terbaik;
	}
}