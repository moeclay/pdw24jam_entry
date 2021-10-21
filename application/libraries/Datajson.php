<?php
// to library json file folder secret
class Datajson {

    public function showdashboard(){
    	$CI = get_instance();
    	
    	if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            // data 14hari
            $hari14 = $CI->App_model->total14hari();
            $datahari14a = [];
            $datahari14b = [];
            for ($i=0; $i <count($hari14); $i++) { 
              	array_push($datahari14a, $hari14[$i]->tanggal);
              	array_push($datahari14b, $hari14[$i]->jumlah);
            }
                  
            // data bulanan
            $bulanan = $CI->App_model->totalbulanan();
            $bulan_a = [];
            $bulan_b = [];
            
            for ($i=0; $i <count($bulanan); $i++) { 
              	array_push($bulan_a, $bulanan[$i]->bulan);
              	array_push($bulan_b, $bulanan[$i]->jumlah);
            }

            // data berjalan
            $bln = date('m');
            $databerjalansemua = $CI->App_model->totalberjalansemua($bln);
            $databerjalansudahdiambil = $CI->App_model->totalberjalansudahdiambil($bln);
            $databerjalanbelumdiambil = $CI->App_model->totalberjalanbelumdiambil($bln);
            $databerjalandiproses = $CI->App_model->totalberjalandiproses($bln);

            $databerjalanpersentage = $CI->App_model->totalberjalanpersentage();
            $hijau = $databerjalanpersentage[0];
            $kuning = $databerjalanpersentage[1];
            $merah = $databerjalanpersentage[2];
            $orange = $databerjalanpersentage[3];
            $putih = $databerjalanpersentage[4];

            // output akhir
            $d = array(
             'hari14_param' 	=> $datahari14a,
             'hari14_data'	=> $datahari14b,
             'bulan_param' 	=> $bulan_a,
             'bulan_data' 	=> $bulan_b,
                'totalberjalansemua' => $databerjalansemua,
                'totalberjalansudahdiambil' => $databerjalansudahdiambil,
                'totalberjalanbelumdiambil' => $databerjalanbelumdiambil,
                'totalberjalandiproses'     => $databerjalandiproses,
                'totalhijau'     => $hijau,
                'totalkuning'     => $kuning,
                'totalmerah'     => $merah,
                'totalorange'     => $orange,
                'totalputih'     => $putih,
            );

            // echo json_encode($d);
            $json_data = json_encode($d);
            file_put_contents(getnamefolderclay().'/dashboard.json', $json_data);
            return true;
		}else{
			redirect('user');
		}
    }

    public function showpenerimaan(){
        $CI = get_instance();
        
        if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            $query = "SELECT * FROM v_total_penerimaan_detail ORDER BY putih DESC";
            $d = $CI->App_model->getALL($query);

            // echo json_encode($d);
            $json_data = json_encode($d);
            file_put_contents(getnamefolderclay().'/penerimaan_semua.json', $json_data);
            return true;
        }else{
            redirect('user');
        }
    }


    public function showdivisidevelop(){
        $CI = get_instance();
        
        if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            $query = "SELECT * FROM v_kinerja_detail WHERE nama_divisi='Develop'";
            $d = $CI->App_model->getALL($query);

            // echo json_encode($d);
            $json_data = json_encode($d);
            file_put_contents(getnamefolderclay().'/divisi_develop.json', $json_data);
            return true;
        }else{
            redirect('user');
        }
    }

    public function showdivisibanner(){
        $CI = get_instance();
        
        if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            $query = "SELECT * FROM v_kinerja_detail WHERE nama_divisi='Banner'";
            $d = $CI->App_model->getALL($query);

            // echo json_encode($d);
            $json_data = json_encode($d);
            file_put_contents(getnamefolderclay().'/divisi_banner.json', $json_data);
            return true;
        }else{
            redirect('user');
        }
    }

    public function showdivisifotocopy(){
        $CI = get_instance();
        
        if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            $query = "SELECT * FROM v_kinerja_detail WHERE nama_divisi='Fotocopy'";
            $d = $CI->App_model->getALL($query);

            // echo json_encode($d);
            $json_data = json_encode($d);
            file_put_contents(getnamefolderclay().'/divisi_fotocopy.json', $json_data);
            return true;
        }else{
            redirect('user');
        }
    }
    
    
    // library dashboard
    public function totalharianberjalan(){
        $CI = get_instance();
        
        if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            // call model 14day total transaksi
            $d = $CI->App_model->graphberjalan14day();

            // echo json_encode($d);
            $json_data = json_encode($d);
            file_put_contents(getnamefolderclay().'/fix_totalharianberjalan.json', $json_data);
            return true;
        }else{
            redirect('user');
        }
    }

    // json graph dashboard
    public function showdatabase(){
        $CI = get_instance();
        
        if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            // call model bulan berjalan
            $d['graphhari'] = $CI->App_model->graphberjalan14day();
            $d['graphbulan'] = $CI->App_model->graphbulanberjalan();
            
            // query graph tahun
            $sql3 = "SELECT 
            	sum(total) as total_tahun, 
            	sum(total_putih) as total_tahun_putih, 
            	sum(total_hijau) as total_tahun_hijau, 
            	sum(total_kuning) as total_tahun_kuning, 
            	sum(total_merah) as total_tahun_merah, 
            	sum(total_ungu) as total_tahun_ungu 
            FROM total_kinerja_bulanan_report";
            $d['tahunberjalan'] = $CI->App_model->getROW($sql3);
            
            // ----------------------------------------------------------------------------------------------------
            // staff produksi terbaik
            $array_staff_terbaik = array();
            $sql_fotocopy = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Fotocopy' ORDER BY selisih DESC LIMIT 1";
            array_push($array_staff_terbaik, $CI->App_model->getALL($sql_fotocopy) );
            
            $sql_develop = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Digital A3+' ORDER BY selisih DESC LIMIT 1";
            array_push($array_staff_terbaik, $CI->App_model->getALL($sql_develop));
            
            $sql_creative = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Creative' ORDER BY selisih DESC LIMIT 1";
            array_push($array_staff_terbaik, $CI->App_model->getALL($sql_creative));
            
            $sql_banner = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Banner' ORDER BY selisih DESC LIMIT 1";
            array_push($array_staff_terbaik, $CI->App_model->getALL($sql_banner));
            
            $sql_penjilidan = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Penjilidan' ORDER BY selisih DESC LIMIT 1";
            array_push($array_staff_terbaik, $CI->App_model->getALL($sql_penjilidan));
            
            $sql_bengkel_buku = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Bengkel Buku' ORDER BY selisih DESC LIMIT 1";
            array_push($array_staff_terbaik, $CI->App_model->getALL($sql_bengkel_buku));
            
            $d['staff_terbaik'] = $array_staff_terbaik;
            
            // ----------------------------------------------------------------------------------------------------
            // staff produksi terburuk
            $array_staff_terburuk = array();
            $sql_fotocopy1 = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Fotocopy' ORDER BY selisih ASC LIMIT 1";
            array_push($array_staff_terburuk, $CI->App_model->getALL($sql_fotocopy1) );
            
            $sql_develop1 = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Digital A3+' ORDER BY selisih ASC LIMIT 1";
            array_push($array_staff_terburuk, $CI->App_model->getALL($sql_develop1));
            
            $sql_creative1 = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Creative' ORDER BY selisih ASC LIMIT 1";
            array_push($array_staff_terburuk, $CI->App_model->getALL($sql_creative1));
            
            $sql_banner1 = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Banner' ORDER BY selisih ASC LIMIT 1";
            array_push($array_staff_terburuk, $CI->App_model->getALL($sql_banner1));
            
            $sql_penjilidan1 = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Penjilidan' ORDER BY selisih ASC LIMIT 1";
            array_push($array_staff_terburuk, $CI->App_model->getALL($sql_penjilidan1));
            
            $sql_bengkel_buku1 = "SELECT  id_karyawan as id,
            	nama,
            	nama_divisi,
            	total_putih, 
            	total_hijau,
            	total_kuning,
            	total_merah,
            	total_ungu,
            	total_personal, 
            	(total_hijau)*-1 as t_hijau,
            	(total_kuning)*-5 as t_kuning,
            	(total_merah)*-10 as t_merah,
            	(total_ungu)*-15 as t_ungu,
            	( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) as sum_telat,
            	(total_putih + ( (total_hijau)*-1 + (total_kuning)*-5 + (total_merah)*-10 + (total_ungu)*-15 ) ) as selisih
            FROM total_kinerja_berjalan_produksi 
            	WHERE nama_divisi='Bengkel Buku' ORDER BY selisih ASC LIMIT 1";
            array_push($array_staff_terburuk, $CI->App_model->getALL($sql_bengkel_buku1));
            
            $d['staff_terburuk'] = $array_staff_terburuk;
            	
            
            // kinerja divisi
            $sql6 = "select * from total_kinerja_berjalan_divisi_ranking order by nama_divisi desc";
            $d['kinerjadivisi'] = $CI->App_model->getALL($sql6);
            
            $json_data = json_encode(array_reverse($d, true));
            file_put_contents(getnamefolderclay().'/fix_database.json', $json_data);
            return true;
        }else{
            redirect('user');
        }
    }
    
    public function detailpersonal(){
        $CI = get_instance();
        
        if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            // call model bulan berjalan
            $sql1 = "select * from total_kinerja_berjalan_produksi";
            $sql2 = "select * from total_berjalan";
            $sql3 = "select sum(total_putih) as total_putih, sum(total_hijau) as total_hijau, sum(total_kuning) as total_kuning,sum(total_merah) as total_merah ,sum(total_ungu) as total_ungu from total_kinerja_berjalan_produksi order by total_personal desc";
            $sql4 = "SELECT nama_pot, rupiah_pot FROM potongan";
            
            // divisi develop
            $sql5 = "SELECT  id_karyawan, nama, total_putih, total_hijau,  total_kuning,  total_merah, total_ungu, total_personal, ((total_putih-(total_hijau+total_kuning+total_merah+total_ungu))/total_personal)*100 AS selisih FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Develop' ORDER BY selisih DESC";
            $d['kinerja_develop'] = $CI->App_model->getALL($sql5);
            $sql6 = "SELECT sum(total_putih) as total_ontime, (sum(total_hijau)+sum(total_kuning)+sum(total_merah)+sum(total_ungu)) as total_offtime, sum(total_personal) as total_divisi, sum(total_hijau) as total_hijau, sum(total_kuning) as total_kuning, sum(total_merah) as total_merah, sum(total_ungu) as total_ungu FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Develop'";
            $d['grafik_develop']  = $CI->App_model->getALL($sql6);
            
            // divisi banner
            $sql7 = "SELECT  id_karyawan, nama, total_putih, total_hijau,  total_kuning,  total_merah, total_ungu, total_personal, ((total_putih-(total_hijau+total_kuning+total_merah+total_ungu))/total_personal)*100 AS selisih FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Banner' ORDER BY selisih DESC";
            $d['kinerja_banner'] = $CI->App_model->getALL($sql7);
            $sql8 = "SELECT sum(total_putih) as total_ontime, (sum(total_hijau)+sum(total_kuning)+sum(total_merah)+sum(total_ungu)) as total_offtime, sum(total_personal) as total_divisi, sum(total_hijau) as total_hijau, sum(total_kuning) as total_kuning, sum(total_merah) as total_merah, sum(total_ungu) as total_ungu FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Banner'";
            $d['grafik_banner']  = $CI->App_model->getALL($sql8);
            
            // divisi penjilidan
            $sql9 = "SELECT  id_karyawan, nama, total_putih, total_hijau,  total_kuning,  total_merah, total_ungu, total_personal, ((total_putih-(total_hijau+total_kuning+total_merah+total_ungu))/total_personal)*100 AS selisih FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Penjilidan' ORDER BY selisih DESC";
            $d['kinerja_penjilidan'] = $CI->App_model->getALL($sql9);
            $sql10 = "SELECT sum(total_putih) as total_ontime, (sum(total_hijau)+sum(total_kuning)+sum(total_merah)+sum(total_ungu)) as total_offtime, sum(total_personal) as total_divisi, sum(total_hijau) as total_hijau, sum(total_kuning) as total_kuning, sum(total_merah) as total_merah, sum(total_ungu) as total_ungu FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Penjilidan'";
            $d['grafik_penjilidan']  = $CI->App_model->getALL($sql10);
            
            // divisi bengkel buku
            $sql11 = "SELECT  id_karyawan, nama, total_putih, total_hijau,  total_kuning,  total_merah, total_ungu, total_personal, ((total_putih-(total_hijau+total_kuning+total_merah+total_ungu))/total_personal)*100 AS selisih FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Bengkel Buku' ORDER BY selisih DESC";
            $d['kinerja_bengkelbuku'] = $CI->App_model->getALL($sql11);
            $sql12 = "SELECT sum(total_putih) as total_ontime, (sum(total_hijau)+sum(total_kuning)+sum(total_merah)+sum(total_ungu)) as total_offtime, sum(total_personal) as total_divisi, sum(total_hijau) as total_hijau, sum(total_kuning) as total_kuning, sum(total_merah) as total_merah, sum(total_ungu) as total_ungu FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Bengkel Buku'";
            $d['grafik_bengkelbuku']  = $CI->App_model->getALL($sql12);
            
            // divisi creative
            $sql13 = "SELECT  id_karyawan, nama, total_putih, total_hijau,  total_kuning,  total_merah, total_ungu, total_personal, ((total_putih-(total_hijau+total_kuning+total_merah+total_ungu))/total_personal)*100 AS selisih FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Creative' ORDER BY selisih DESC";
            $d['kinerja_creative'] = $CI->App_model->getALL($sql13);
            $sql14 = "SELECT sum(total_putih) as total_ontime, (sum(total_hijau)+sum(total_kuning)+sum(total_merah)+sum(total_ungu)) as total_offtime, sum(total_personal) as total_divisi, sum(total_hijau) as total_hijau, sum(total_kuning) as total_kuning, sum(total_merah) as total_merah, sum(total_ungu) as total_ungu FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Creative'";
            $d['grafik_creative']  = $CI->App_model->getALL($sql14);
            
            // divisi fotocopy
            $sql15 = "SELECT  id_karyawan, nama, total_putih, total_hijau,  total_kuning,  total_merah, total_ungu, total_personal, ((total_putih-(total_hijau+total_kuning+total_merah+total_ungu))/total_personal)*100 AS selisih FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Fotocopy' ORDER BY selisih DESC";
            $d['kinerja_fotocopy'] = $CI->App_model->getALL($sql15);
            $sql16 = "SELECT sum(total_putih) as total_ontime, (sum(total_hijau)+sum(total_kuning)+sum(total_merah)+sum(total_ungu)) as total_offtime, sum(total_personal) as total_divisi, sum(total_hijau) as total_hijau, sum(total_kuning) as total_kuning, sum(total_merah) as total_merah, sum(total_ungu) as total_ungu FROM total_kinerja_berjalan_produksi WHERE nama_divisi='Fotocopy'";
            $d['grafik_fotocopy']  = $CI->App_model->getALL($sql16);
            
            // personal pecah dulu
            $personal            = $CI->App_model->getALL($sql1);
            $d['total_berjalan'] = $CI->App_model->getROW($sql2);
            $d['total_column']   = $CI->App_model->getROW($sql3);
            $d['potongan']       = $CI->App_model->getALL($sql4);
            
            // tes data personal
            $mypersonal = array();
            for($i=0; $i<count($personal); $i++){
                $id_karyawan    = $personal[$i]->id_karyawan;
                $nama           = $personal[$i]->nama;
                $nama_divisi    = $personal[$i]->nama_divisi;
                $total_personal = (int) $personal[$i]->total_personal;
                $total_putih    = (int) $personal[$i]->total_putih;
                $total_hijau    = (int) $personal[$i]->total_hijau;
                $total_kuning   = (int) $personal[$i]->total_kuning;
                $total_merah    = (int) $personal[$i]->total_merah;
                $total_ungu     = (int) $personal[$i]->total_ungu;
                $total_telat    = ($total_hijau+$total_kuning+$total_merah+$total_ungu);
                $selisih        = (($total_putih-$total_telat)/$total_personal)*100;
                
                $data = array(
                    'id_karyawan'   => $id_karyawan,
                    'nama'          => $nama,
                    'nama_divisi'   => $nama_divisi,
                    'total_putih'   => $total_putih,
                    'total_hijau'   => $total_hijau,
                    'total_kuning'  => $total_kuning,
                    'total_merah'   => $total_merah,
                    'total_ungu'    => $total_ungu,
                    'total_telat'   => $total_telat,
                    'total_personal'=> $total_personal,
                    'selisih'       => (float) sprintf('%0.2f', $selisih)
                );
                // hitung total_telat
                array_push($mypersonal, $data);
            }
            $d['personal'] = $mypersonal;
            
            // encode json and write file
            $json_data = json_encode(array_reverse($d, true));
            file_put_contents(getnamefolderclay().'/fix_personal.json', $json_data);
            return true;
        }else{
            redirect('user');
        }
    }
    
    public function detaildivisi(){
        $CI = get_instance();
        
        if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            // call model divisi berjalan
            $sql1 = "select * from total_kinerja_berjalan_divisi";
            $sql2 = "select * from total_berjalan";
            
            $d['divisi'] = $CI->App_model->getALL($sql1);
            $d['total_berjalan'] = $CI->App_model->getROW($sql2);

            // echo json_encode($d);
            $json_data = json_encode(array_reverse($d, true));
            file_put_contents(getnamefolderclay().'/fix_divisi.json', $json_data);
            return true;
        }else{
            redirect('user');
        }
    }
    
    public function detailbulan(){
        $CI = get_instance();
        
        if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            $sql1 = "SELECT * FROM total_kinerja_bulanan_report";
            $d['bulan'] = $CI->App_model->getALL($sql1);
            
            $json_data = json_encode($d);
            file_put_contents(getnamefolderclay().'/fix_bulan.json', $json_data);
            return true;
        }else{
            redirect('user');
        }
    }
    
    // sales area
    public function detailsales(){
        $CI = get_instance();
        
        if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            // call model bulan berjalan
            $sql1 = "select * from total_sales_berjalan_kinerja";
            $sql4 = "SELECT nama_pot, rupiah_pot FROM potongan";
            
            // personal pecah dulu
            $personal            = $CI->App_model->getALL($sql1);
            
            // tes data personal
            $mypersonal = array();
            for($i=0; $i<count($personal); $i++){
                $id_karyawan    = $personal[$i]->id_karyawan;
                $nama           = $personal[$i]->nama;
                $nama_divisi    = $personal[$i]->nama_divisi;
                $total_personal = (int) $personal[$i]->total_personal;
                $total_putih    = (int) $personal[$i]->total_putih;
                $total_hijau    = (int) $personal[$i]->total_hijau;
                $total_kuning   = (int) $personal[$i]->total_kuning;
                $total_merah    = (int) $personal[$i]->total_merah;
                $total_ungu     = (int) $personal[$i]->total_ungu;
                $total_telat    = ($total_hijau+$total_kuning+$total_merah+$total_ungu);
                $selisih        = (($total_putih-$total_telat)/$total_personal)*100;
                
                $data = array(
                    'id_karyawan'   => $id_karyawan,
                    'nama'          => $nama,
                    'nama_divisi'   => $nama_divisi,
                    'total_putih'   => $total_putih,
                    'total_hijau'   => $total_hijau,
                    'total_kuning'  => $total_kuning,
                    'total_merah'   => $total_merah,
                    'total_ungu'    => $total_ungu,
                    'total_telat'   => $total_telat,
                    'total_personal'=> $total_personal,
                    'selisih'       => (float) sprintf('%0.2f', $selisih)
                );
                // hitung total_telat
                array_push($mypersonal, $data);
            }
            $d['personal'] = $mypersonal;
            $d['potongan'] = $CI->App_model->getALL($sql4);
            
            // encode json and write file
            $json_data = json_encode(array_reverse($d, true));
            file_put_contents(getnamefolderclay().'/fix_sales.json', $json_data);
            return true;
        }else{
            redirect('user');
        }
    }
    
    
    // barangjadi
    public function detailbarangjadi(){
        $CI = get_instance();
        
        if($CI->session->userdata('is_logged_in') && $CI->session->userdata('status')=='admin'){
            $sql1    = "SELECT * FROM total_barangjadi_kinerja";
            $kinerja = $CI->App_model->getALL($sql1);
            
            $mypersonal = array();
            for($i=0; $i<count($kinerja); $i++){
                $operator    = $kinerja[$i]->operator;
                $totalinput  = (int) $kinerja[$i]->total_input;
                $totalambil  = (int) $kinerja[$i]->total_ambil;
                $rata2       = (float) ($totalinput+$totalambil)/2;
                
                $data = array(
                    'operator'    => $operator,
                    'totalinput'  => $totalinput,
                    'totalambil'  => $totalambil,
                    'rata2'       => $rata2
                );
                // hitung total_telat
                array_push($mypersonal, $data);
            }
            
            $json_data = json_encode(["kinerja" => $mypersonal]);
            file_put_contents(getnamefolderclay().'/fix_barangjadi.json', $json_data);
            return true;
        }else{
            redirect('user');
        }
    }
    
}