<?php
// fungsi ambil bulan terakhir
function data_bulan_terakhir(){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->bulanAkhir();

    return $data;
}

// fungsi ambil tahun terakhir
function data_tahun_terakhir(){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->tahunAkhir();

    return $data;
}

function hari_kerja($id, $bulan, $tahun){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->DataAbsen($id, $bulan, $tahun);

    if($data){
        $hari = $data->hari_kerja;
        
        // kalkulasi
        if($hari){
            $hk = $hari;
        }else{
            $hk   = 0;
        }
    }else{
        $hk = 0;
    }

    return $hk;
}
function rumus_jam_hari($id, $bulan, $tahun){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->semuaData($id, $bulan, $tahun);

    if($data){
        $tot_jam  = $data->jam_kerja;
        $tot_hari  = $data->hari_kerja;

        // kalkulasi
        if($tot_jam == 0 || $tot_hari == 0){
            return $jam_hari = 0;
        }else{
            return $jam_hari = $tot_jam / $tot_hari;
        }
    }else{
        $jam_hari = 0;
    }

    return $jam_hari;
}

function rumus_edit_hari($id, $bulan, $tahun){
    /* rumus : point_edit  / hari_kerja */
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->semuaData($id, $bulan, $tahun);

    if($data){
        $tot_pe  = $data->point_edit;
        $tot_jam  = $data->jam_kerja;
        $tot_hari  = $data->hari_kerja;

        // kalkulasi
        if($tot_pe == 0 || $tot_jam == 0 || $tot_hari == 0){
            return $edit_hari = 0;
        }else{
            return $edit_hari = $tot_pe / ($tot_jam / $tot_hari);
        }
    }else{
        $edit_hari = 0;
    }

    return $edit_hari;
}

function rumus_transaksi_hari($id, $bulan, $tahun){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->semuaData($id, $bulan, $tahun);

    if($data){
        $tot_pt  = $data->transaksi;
        $tot_jam  = $data->jam_kerja;
        $tot_hari  = $data->hari_kerja;

        // kalkulasi
        if($tot_pt == 0 || $tot_jam == 0 || $tot_hari == 0){
            return $trs_hari = 0;
        }else{
            return $trs_hari = $tot_pt / ($tot_jam / $tot_hari);
        }
    }else{
        $trs_hari = 0;
    }

    return $trs_hari;
}

function rumus_kinerja_hari($id, $bulan, $tahun){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->semuaData($id, $bulan, $tahun);

    if($data){
        $tot_pk  = $data->point_kinerja;
        $tot_jam  = $data->jam_kerja;
        $tot_hari  = $data->hari_kerja;

        // kalkulasi
        if($tot_pk == 0 || $tot_jam == 0 || $tot_hari == 0){
            return $point_hari = 0;
        }else{
            return $point_hari = $tot_pk / ($tot_jam / $tot_hari);
        }
    }else{
        $point_hari = 0;
    }

    return $point_hari;
}

function rumus_transaksi_kinerja_hari($id, $bulan, $tahun){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->semuaData($id, $bulan, $tahun);

    if($data){
        $data_transaksi = rumus_transaksi_hari($id, $bulan, $tahun);
        $data_kinerja   = rumus_kinerja_hari($id, $bulan, $tahun);

        // kalkulasi
        if($data_transaksi == 0 || $data_kinerja == 0){
            return $trs_point_hari = 0;
        }else{
            return $trs_point_hari = ($data_transaksi+ $data_kinerja) / 2;
        }
    }else{
        $trs_point_hari = 0;
    }

    return $trs_point_hari;
}

function total_bonus($id, $bulan, $tahun){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->semuaData($id, $bulan, $tahun);

    if($data){
        $a  = $data->tj_edit;
        $b  = $data->tj_kinerja;
        $c  = $data->bonus_absen;
        $d  = $data->bonus_tambah;

        // kalkulasi
        if($a == 0 || $b == 0 || $c == 0 || $d == 0){
            return $total_bonus = ($a + $b + $c + $d);
        }else{
            return $total_bonus = 0;
        }
    }else{
        $total_bonus = 0;
    }

    return $total_bonus;
}

// fungsi untuk mencetak semua nilai_edit dan nilai_transaksi
// digunakan untuk membuat parameter untuk mencari ranking
// SUDAH BENAR
function ranking_edit($id_divisi, $id_toko, $bulan, $tahun){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->Ranking_Divisi($id_divisi, $id_toko, $bulan, $tahun);
    $hasil = $data->result_array();

        if($hasil){
            $total_orang = count($hasil);
            for($i=0; $i<$total_orang; $i++){
            
                $rao[] = array(
                    'id_karyawan'           => $hasil[$i]['id_karyawan'],
                    'nama'                  => $hasil[$i]['nama'],
                    'hari_kerja'            => $hasil[$i]['hari_kerja'],
                    'point_edit_ranking'    => $hasil[$i]['point_edit'],
                    'point_kinerja_ranking' => $hasil[$i]['point_kinerja'],
                    'point_transaksi'       => $hasil[$i]['transaksi'],
                    'nilai_edit'            => $hasil[$i]['nilai_edit'],
                    'nilai_transaksi'       => $hasil[$i]['nilai_transaksi'],
                    'total_nilai'           => $hasil[$i]['total_nilai']
                );
            }
        }else{
            $rao = [];
        }

    return $rao;
}

// fungsi untuk mencari semua_ranking karyawan
// hasil berupa array
// SUDAH BENAR
function ranking_nilai($id_divisi, $id_toko, $bulan, $tahun){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->Ambil_Total_Nilai($id_divisi, $id_toko, $bulan, $tahun);
    $hasil = $data->result_array();

    if($hasil){
        $total_orang = count($hasil);
        for($i=0; $i<$total_orang; $i++){
            
            $rao[] = Array(
                'id_karyawan'=> $hasil[$i]['id_karyawan'],
                'nama'       => $hasil[$i]['nama'],
                'total_nilai'=> $hasil[$i]['total_nilai'],
                'ranking'   =>  $i+1
            );
        }
    }else{
        $rao = [];
    }

    return $rao;
}

// jumlah total_karyawan_divisi
function total_karyawan_divisi($id_divisi, $id_toko, $bulan, $tahun){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->Ambil_Total_Nilai($id_divisi, $id_toko, $bulan, $tahun);
    $total_orang = count($data->result());

    return $total_orang;
}


// fungsi mencari id_toko berdasarkan id_karyawan
function cari_id_toko($id){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');
    $data = $CI->Karyawan_model->Cari_Id_Toko($id);

    return $data;    
}

// ---------------------------------------------------------------------------------
// fungsi mencari data ranking berdasarkan id_karyawan
function cari_rank_nilai($id, $id_divisi, $id_toko, $bulan, $tahun){
    $hasil = ranking_nilai($id_divisi, $id_toko, $bulan, $tahun);

    if($hasil){
        $tot_data = count($hasil);
        for($i=0; $i<$tot_data; $i++){
            if($hasil[$i]['id_karyawan'] == $id){
                $crn = array_slice($hasil,$i,1);
            }else{
                continue;
            }
        }
    }

    // return $crn
    if(isset($crn)){
        return $crn;
    }else{
        return $crn = [];
    }
}

// fungsi mencari nilai berdasarkan id_karyawan
function cari_rank_edit($id, $id_divisi, $id_toko, $bulan, $tahun){
    $hasil = ranking_edit($id_divisi, $id_toko, $bulan, $tahun);

    if($hasil){
        $tot_data = count($hasil);
        for($i=0; $i<$tot_data; $i++){
            if($hasil[$i]['id_karyawan'] == $id){
                $cre = array_slice($hasil,$i,1);
            }else{
                continue;
            }
        }
    }

    // return $cre;
    if(isset($cre)){
        return $cre;
    }else{
        return $cre = [];
    }
}

// ---------------------------------------------------------------------------------

// fungsi mencari data nilai_edit, nilai-transaksi, ranking / tahun
// jika status_karyawan 'D01' = Operator Design
function cari_grafik_tahun(){
    $CI = get_instance();
    $CI->load->model('Karyawan_model');

    // bulan looping
    $i_data = [];
    for($i_bulan=1;$i_bulan<=12;$i_bulan++){
        if(strlen($i_bulan) == 1){
            $i_data[$i_bulan] = '0'.$i_bulan;
        }else{
            $i_data[$i_bulan] = $i_bulan;
        }
    }

    // tahun looping
    $i_data2 = [];
    for($i_tahun=2018; $i_tahun<=2050;$i_tahun++){
        $i_data2[$i_tahun] = $i_tahun;
    }


    // data perbulan dan tahun
    $data = array();
    $data["data"] = array();
    array_push($data['data'], $i_data2);
    
    return $data;
}