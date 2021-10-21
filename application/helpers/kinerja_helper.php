<?php
    // getUserIpAddr
    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    // ambilNamaBulan
    function ambilNamaType($type){
        $typee = array(
            'kosong'=>'Kosong',
            '1'=>'Koperasi Bulanan',
            '2'=>'Koperasi Harian',
            '3'=>'Ulang Tahun',
            '4'=>'Sukarela',
            '5'=>'Penarikan',
            '6'=>'Bonus'
        );
        return $typee[$type];
    }
    
    // ambilNamaBulan
    function ambilNamaBulan($bln){
    	$bulan = array(
    		'01'=>'Januari',
    		'02'=>'Februari',
    		'03'=>'Maret',
    		'04'=>'April',
    		'05'=>'Mei',
    		'06'=>'Juni',
    		'07'=>'Juli',
    		'08'=>'Agustus',
    		'09'=>'September',
    		'10'=>'Oktober',
    		'11'=>'November',
    		'12'=>'Desember'
    	);
    	return $bulan[$bln];
    }
    
	// Algoritma bulan sebelumnya
	function bulanSebelumnya($blnSekarang){
	    $index_bulan = array(
	        '1'=>'01',
	        '2'=>'02',
	        '3'=>'03',
	        '4'=>'04',
	        '5'=>'05',
	        '6'=>'06',
	        '7'=>'07',
	        '8'=>'08',
	        '9'=>'09',
	        '10'=>'10',
	        '11'=>'11',
	        '12'=>'12'
	    );
    	
    	// algoritma
    	$bln_temp = intval($blnSekarang-1);
    	if($bln_temp == 0){
    	    $bln_value = 12;
    	}else{
    	    $bln_value = $bln_temp;
    	}
    	
    	return $index_bulan[strval($bln_value)];
	}
	
	function tahunSekarang($bulan=null){
	    $tahun = date('Y');
	    
	    if($bulan == '01'){
	        $tahun_1 = intval($tahun-1);
	    }else{
	        $tahun_1 = $tahun;
	    }
	    return $tahun_1;
	}

    // hapus semua captcha
    function hapus_captcha(){
        $files = glob('./captcha/*'); 
        foreach($files as $file){ 
            // iterate files
            if(is_file($file))
                unlink($file);
        }
    }
    
    // random string
    function RandomString($num=null){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        
        if(isset($num) && $num != null){
            for ($i = 0; $i < $num; $i++) {
                $randstring .= $characters[rand(0, strlen($characters))];
            }
        }else{
            for ($i = 0; $i < 3; $i++) {
                $randstring .= $characters[rand(0, strlen($characters))];
            }
        }
        
        return $randstring;
    }

    // get nomer kinerja
    function getNomerKinerja(){
        $hour       = date('H');
        $minute     = date('i');
        $second     = date('s');

        $compact = $hour+$minute+$second;
        $data2 = $compact.RandomString();
        return $data2;
    }
    
    function getNamaKaryawan($idKaryawan=null){
        if($idKaryawan != null){
            $CI =& get_instance();
            $query = $CI->db->query("SELECT nama FROM karyawan WHERE id_karyawan='$idKaryawan'");
            $data = $query->row()->nama;
            if($data != null){
                return $data;   
            }else{
                return "-";
            }
        }else{
            return "-";
        }
    }

    function getNamaDivisi($idDivisi=null){
        if($idDivisi != null){
            $CI =& get_instance();
            $query = $CI->db->query("SELECT nama_divisi FROM divisi WHERE id_divisi='$idDivisi'");
            $data = $query->row()->nama_divisi;
            if($data != null){
                return $data;   
            }else{
                return "-";
            }
        }else{
            return "-";
        }
    }
    
    function getNamaLengkapKaryawan($idKaryawan=null){
        if($idKaryawan != null){
            $CI =& get_instance();
            $query = $CI->db->query("SELECT nama_lengkap FROM karyawan WHERE id_karyawan='$idKaryawan'");
            $data = $query->row()->nama_lengkap;
            if($data != null){
                return $data;   
            }else{
                return "-";
            }
        }else{
            return "-";
        }
    }
    
    // format uang
    function format_uang($uang){
        return number_format($uang,0,'','.');
    }
    

    // ---------------------------------------------
    // Helper for Manage Karyawan
    // ---------------------------------------------
    // get nama_toko dengan id
    function get_namatoko($data){
        $CI = get_instance();
        $CI->load->model('App_model');
        $obj_arr = $CI->App_model->semuaTokoID();

        for($i=0; $i<sizeof($obj_arr); $i++){
            if($obj_arr[$i]['id_toko'] == $data){
                $hasil = $obj_arr[$i]['nama_toko'];
            }
        }

        return $hasil;
    }
    // get nama_area dengan id
    function get_namaarea($data){
        $CI = get_instance();
        $CI->load->model('App_model');
        $obj_arr = $CI->App_model->semuaAreaID();

        for($i=0; $i<sizeof($obj_arr); $i++){
            if($obj_arr[$i]['id_area'] == $data){
                $hasil = $obj_arr[$i]['nama_area'];
            }
        }

        return $hasil;
    }

    // get nama divisi dengan id
    function get_namadivisi($data){
        $CI = get_instance();
        $CI->load->model('App_model');
        $obj_arr = $CI->App_model->semuaDivisiID();

        for($i=0; $i<sizeof($obj_arr); $i++){
            if($obj_arr[$i]['id_divisi'] == $data){
                $hasil = $obj_arr[$i]['nama_divisi'];
            }
        }

        return $hasil;
    }

    // HELPER CARI MASA KERJA
    function cari_masa_kerja($data){
        $lama = date_diff(date_create($data), date_create());
        $hasil = $lama->format("%Y tahun, %m bulan");
        
        return $hasil;
    }

    // ID Karyawan
    // fungsi id karyawan - otomatis
    function get_maxidkaryawan(){
        $CI = get_instance();
        $CI->load->model('App_model');
        $data = $CI->App_model->idakhirKaryawan();

        return $data;
    }

    function get_nextidkaryawan(){
        $array = [];
        $data = get_maxidkaryawan();
        $a = count($data);

        for($i=0;$i<$a;$i++){
            $b = $data[$i]['id_karyawan'];
            $c = substr($b, 1);
            array_push($array, $c);
        }

        sort($array);
        $d = max($array);
        $d = $d + 1;

        return $d;  
    }

    function post_nextidkaryawan($data){
        $hasil = 'K'.$data;

        return $hasil;
    }

    // helper folderclay
    function getnamefolderclay(){
        $CI =& get_instance();
        $query = $CI->db->query("SELECT folder_name FROM folderclay");
        $data = $query->row()->folder_name;
        return $data;
    }
    function getclaylastupdate(){
        $CI =& get_instance();
        $query = $CI->db->query("SELECT folder_update FROM folderclay");
        $data = $query->row()->folder_update;
        return $data;
    }
    function getclaynextupdate(){
        $CI =& get_instance();
        $query = $CI->db->query("SELECT next_update FROM folderclay");
        $data = $query->row()->next_update;
        return $data;
    }

    // function to access secure folder and return JSON type
    function accesssecure($param){
        // instance model
        $CI = get_instance();
        $CI->load->model('App_model');

        // get next update, change to unixtime
        $nowtime_unixtime    = strtotime(date('Y-m-d H:i:s')); 
        $nextupdate_unixtime = strtotime(getclaynextupdate());

        // buat random folder -> set database (name)
        $kar = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for($i=0;$i<5;$i++){
            $pos = rand(0, strlen($kar)-1);
            $string .= $kar[$pos];
        }

        // update foldername & update next_time & update kontent JSON
        if($nowtime_unixtime > $nextupdate_unixtime){
            // update foldername
            $foldername = getnamefolderclay();
            rename($foldername, $string);
            $CI->App_model->updatefolderclay($string);
            // update next_time
            $datetime = date('Y-m-d H:i:s',strtotime('+10000 seconds',$nowtime_unixtime));
            $CI->App_model->updatefileclay($datetime);

            // baru, buat baru data
            if(file_exists(getnamefolderclay().'/'.$param)){
                // mode development
                unlink(getnamefolderclay().'/'.$param);

                // daftar kontent JSON
                if($param == 'fix_database.json'){
                    // buat file json dashboard
                    $CI->datajson->showdatabase();
                }
                if($param == 'fix_personal.json'){
                    $CI->datajson->detailpersonal();
                }
                if($param == 'fix_divisi.json'){
                    $CI->datajson->detaildivisi();
                }
                if($param == 'fix_bulan.json'){
                    $CI->datajson->detailbulan();
                }
                if($param == 'fix_sales.json'){
                    $CI->datajson->detailsales();
                }
                if($param == 'fix_barangjadi.json'){
                    $CI->datajson->detailbarangjadi();
                }
                
                // read fileJSON 
                $file = file_get_contents(getnamefolderclay().'/'.$param);
                $fileJSON = json_decode($file);
                $data = json_encode($fileJSON);
            }

        // jika waktu unix lebih kecil dari waktu update
        }else{
            // read fileJSON
            $file = file_get_contents(getnamefolderclay().'/'.$param);
            $fileJSON = json_decode($file, true);
            $data = json_encode($fileJSON);
        }
        return $data;
    }

    // fungsi cari produk pesanan
    // function cari_produk_pesanan($id){
    //     $CI = get_instance();
    //     $CI->load->model('Karyawan_model');
    //     $data = $CI->Karyawan_model->Cari_Id_Toko($id);

    //     return $data;    
    // }
    
?>