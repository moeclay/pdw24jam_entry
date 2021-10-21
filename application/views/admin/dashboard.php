    <!-- Style Coloring -->
    <style type="text/css">
      table {
        font-family: calibri !important;
        font-size: 12px;
      }
      
      #row-ungu {
        background-color: #c91bff73;
        color: #ed1010;
        font-weight: 700;
      }
      
      #row-merah {
        background-color: #ff1b1bb3;
        color: #ed1010;
        font-weight: 700;
      }
      
      #row-kuning {
        background-color: #ffc30566;
        color: #ed1010;
        font-weight: 700;
      }
      
      #row-hijau {
        background-color: #25d97066;
        color: #ed1010;
        font-weight: 700;
      }
    </style>
    <!-- end-of-style -->
    

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-collapse collapse" id="navbar_absensi" aria-expanded="false" style="height: 1px;">
                    <ul class="nav navbar-nav">
                        <li style="margin-top:15px;"><b>LEGEND</b></li>
                        <li style="margin-top:15px;"><span style="padding: 2px 10px; background-color: #c91bffb3; margin-right: 5px; margin-left:2em; margin-top:1px;"></span>Ungu : >60 Menit</li>
                        <li style="margin-top:15px;"><span style="padding: 2px 10px; background-color: #ff1b1bb3; margin-right: 5px; margin-left:2em; margin-top:1px;"></span>Merah : 30-60 Menit</li>
                        <li style="margin-top:15px;"><span style="padding: 2px 10px; background-color: #ffc30566; margin-right: 5px; margin-left:2em; margin-top:1px;"></span>Kuning : 10-30 Menit</li>
                        <li style="margin-top:15px;"><span style="padding: 2px 10px; background-color: #25d97066; margin-right: 5px; margin-left:2em; margin-top:1px;"></span>Hijau : 1-10 Menit</li>
                    </ul>
                    <!--<button style="margin-top:10px;" id="ket" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-info" aria-hidden="true"></i></button>-->
                        <ul class="nav navbar-nav navbar-right">
                            <?php echo form_open("admin/home/cari_record", 'class="navbar-form"'); ?>
                            <div class="form-group">
                              <input style="border-radius: 10px;" type="text" name="cari_kinerja" class="form-control" id="cari_kinerja" placeholder="Nomor Faktur" required />
                            </div> 
                            <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-search"></i> Cari Faktur</button>
                            <?php echo form_close(); ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>


    <!-- Data Record Kinerja Barang Jadi -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
          <div class="box box-success">
            <div class="box-body table-responsive">
              <!--kode untuk realtime orderan masuk-->
              <table class="table" style="font-family: 'Nunito', sans-serif;">
                <thead>
                  <tr style="font-family: 'Nunito', sans-serif; background-color: #00a65ab0;">
                    <th class="text-center">FAKTUR</th>
                    <th class="text-center">RAK</th>
                    <th class="text-center">INPUT</th>
                    <th class="text-center">PROSES</th>
                    <th class="text-center">DIAMBIL</th>
                    <th class="text-center">SALES</th>
                    <th class="text-center">PRODUKSI</th>
                    <th class="text-center">STAFF INPUT</th>
                    <th class="text-center">STAFF AMBIL</th>
                    <th class="text-center" title="Durasi waktu dari (input -> proses)">PROSES</th>
                    <th class="text-center" title="Durasi waktu dari (proses -> diambil)">DIRAK</th>
                    <th class="text-center" title="Durasi waktu dari (commit -> selesai)">KONSUMEN</th>
                    <!--<th class="text-center" title="Durasi waktu dari (input -> diambil)">ALL TIME</th>-->
                    <th class="text-center" title="Durasi waktu dari (input -> diambil)">STATUS</th>
                    <th class="text-center" title="Durasi waktu dari (req customer -> sekarang)">TELAT</th>
                  </tr>
                </thead>
                <tbody style="font-family: 'Nunito', sans-serif;">
                    <!-- data embedd start  -->
                    <?php foreach($kinerjaDB as $kDB){
                    
                    
                        if( (intval($kDB->commit_unix) <= intval(strtotime($kDB->tanggal_selesai))) && (isset($kDB->commit_unix)) ){
                        
                            $data1 = date('Y-M-d H:i:s', $kDB->commit_unix);
                            $data2 = date('Y-M-d H:i:s', strtotime($kDB->tanggal_selesai));
                            
                            $ket1  = $data1;
                            $ket2  = $data2;
                                        
                            $awal  = date_create($data1);
                            $akhir = date_create($data2);
                            $diff  = date_diff( $awal, $akhir);
                    
                            $durasi4 =  (($diff->d*24)+$diff->h).':'.$diff->i.':'.$diff->s;
                                      
                            if( (($diff->d*24)+$diff->h)=='0' && ($diff->i <= 9) ){
                    ?>
                            <!-- kurang dari 10 menit : HIJAU -->
                                <tr class="text-center" id="row-hijau">
                                    <td><?= $kDB->no_invoice; ?></td>
                                    <td><?= $kDB->faktur_rak; ?></td>
                                    <td><?= $kDB->tanggal_input; ?></td>
                                    <td><?= $kDB->tanggal_selesai; ?></td>
                                    <td><?= $kDB->tanggal_ambil; ?></td>
                                
                                <!-- sales start -->
                                    <td>
                                    <?php
                                        // parsing list_penerimaan
                    			        $data1 = $kDB->penerimaan;
                                        if($data1 == 'kosong'){
                                            $data4 = 'kosong';
                                        }else{
                                            $data2 = explode(",",$data1);
                                            // buat array penampung
                                            $data3 = array();
                                            foreach($data2 as $d2){
                                                array_push($data3,getNamaKaryawan($d2));
                                            }
                                            $data4 = implode("  /  ",$data3);
                                        }
                          			    //output
                          			    echo strtoupper($data4);
                          			?>
                                    </td>
                                <!-- sales end-->
                                    
                                <!-- produksi start -->
                                    <td>
                                    <?php
                                        // parsing list_pengerjaan
                                        $data6 = $kDB->pengerjaan;
                                        if($data6 == 'kosong'){
                                            $data9 = 'kosong';
                                        }else{
                                            $data7 = explode(",",$data6);
                                            // buat array penampung
                                            $data8 = array();
                                            foreach($data7 as $d7){
                                                array_push($data8,getNamaKaryawan($d7));
                                            }
                                            $data9 = implode("  /  ",$data8);
                                        }
                                        //output
                                        echo strtoupper($data9);
                                    ?>
                                    </td>
                                <!-- produksi end -->
                                
                                <!-- staff-bj start -->
                                    <td><?= strtoupper($kDB->operator_input); ?></td>
                                    <td><?= strtoupper($kDB->operator_ambil); ?></td>
                                <!-- staff-bj end -->
                                    
                                <!-- proses start -->
                                    <b><td>
                                    <?php
                                        if($kDB->tanggal_selesai == '0000-00-00 00:00:00'){
                                            echo '-';
                                        }else{
                                            $s1     = $kDB->tanggal_input;
                                            $date1  = strtotime($s1);
                                            $data1 = date('Y-M-d H:i:s', $date1);
                        
                                            $s2     = $kDB->tanggal_selesai;
                                            $date2  = strtotime($s2);
                                            $data2 = date('Y-M-d H:i:s', $date2);
                                            
                                            $awal  = date_create($data1);
                                            $akhir = date_create($data2);
                                            $diff  = date_diff( $awal, $akhir);
                                            
                                            $durasi1 =  (($diff->d*24)+$diff->h).':'.$diff->i.':'.$diff->s;
                                            echo $durasi1;
                                        }
                                    ?>
                                    </td>
                                <!-- proses end -->
                                
                                <!-- ke-konsumen start -->
                                    <td>
                                    <?php
                                        if($kDB->tanggal_ambil == '0000-00-00 00:00:00'){
                                            echo '-';
                                        }else{
                                            $s3     = $kDB->tanggal_selesai;
                                            $date3  = strtotime($s3);
                                            $data3 = date('Y-M-d H:i:s', $date3);
                        
                                            $s4     = $kDB->tanggal_ambil;
                                            $date4  = strtotime($s4);
                                            $data4 = date('Y-M-d H:i:s', $date4);
                                            
                                            $awal2  = date_create($data3);
                                            $akhir2 = date_create($data4);
                                            $diff2  = date_diff($awal2, $akhir2);
                        
                                            $durasi2 =  (($diff2->d*24)+$diff2->h).':'.$diff2->i.':'.$diff2->s;
                                            echo $durasi2;
                                        }
                                    ?>
                                    </td>
                                <!-- ke-konsumen end -->
                                
                                <!-- komit start -->
                                <td title="<?php echo $kDB->commit_time.' - '.$kDB->tanggal_input; ?>">
                                <?php
                                    if($kDB->commit_time == NULL){
                                        echo '-';
                                    }else{
                                        $s4     = $kDB->commit_time;
                                        $date4  = strtotime($s4);
                                        $data4 = date('Y-M-d H:i:s', $date4);
                    
                                        $s5     = $kDB->tanggal_input;
                                        $date5  = strtotime($s5);
                                        $data5 = date('Y-M-d H:i:s', $date5);
                                        
                                        $awal3  = date_create($data4);
                                        $akhir3 = date_create($data5);
                                        $diff3  = date_diff($awal3, $akhir3);
                    
                                        $durasi3 =  (($diff3->d*24)+$diff3->h).':'.$diff3->i.':'.$diff3->s;
                                        echo $durasi3;
                                    }
                                ?>
                                </td>
                                <!-- komit end -->
                                
                                <!-- status commit order -->
                                    <td>TIDAK SESUAI</td>
                                    <td title="<?php echo $ket1.' - '.$ket2; ?>"><?php echo $durasi4; ?></td></b>
                                <!-- status commit order -->
                                </tr>
                            <!-- END OF STATUS_BIRU -->
                            
                            <?php 
                            } else if( (($diff->d*24)+$diff->h)=='0' && ($diff->i <= 29) ){
                            ?>
                            
                            <!-- 11 menit - 30 menit : KUNING -->
                                <tr class="text-center" id="row-kuning">
                                    <td><?= $kDB->no_invoice; ?></td>
                                    <td><?= $kDB->faktur_rak; ?></td>
                                    <td><?= $kDB->tanggal_input; ?></td>
                                    <td><?= $kDB->tanggal_selesai; ?></td>
                                    <td><?= $kDB->tanggal_ambil; ?></td>
                                
                                <!-- sales start -->
                                    <td>
                                    <?php
                                        // parsing list_penerimaan
                    			        $data1 = $kDB->penerimaan;
                                        if($data1 == 'kosong'){
                                            $data4 = 'kosong';
                                        }else{
                                            $data2 = explode(",",$data1);
                                            // buat array penampung
                                            $data3 = array();
                                            foreach($data2 as $d2){
                                                array_push($data3,getNamaKaryawan($d2));
                                            }
                                            $data4 = implode("  /  ",$data3);
                                        }
                          			    //output
                          			    echo strtoupper($data4);
                          			?>
                                    </td>
                                <!-- sales end-->
                                    
                                <!-- produksi start -->
                                    <td>
                                    <?php
                                        // parsing list_pengerjaan
                                        $data6 = $kDB->pengerjaan;
                                        if($data6 == 'kosong'){
                                            $data9 = 'kosong';
                                        }else{
                                            $data7 = explode(",",$data6);
                                            // buat array penampung
                                            $data8 = array();
                                            foreach($data7 as $d7){
                                                array_push($data8,getNamaKaryawan($d7));
                                            }
                                            $data9 = implode("  /  ",$data8);
                                        }
                                        //output
                                        echo strtoupper($data9);
                                    ?>
                                    </td>
                                <!-- produksi end -->
                                
                                <!-- staff-bj start -->
                                    <td><?= strtoupper($kDB->operator_input); ?></td>
                                    <td><?= strtoupper($kDB->operator_ambil); ?></td>
                                <!-- staff-bj end -->
                                    
                                <!-- proses start -->
                                    <b><td>
                                    <?php
                                        if($kDB->tanggal_selesai == '0000-00-00 00:00:00'){
                                            echo '-';
                                        }else{
                                            $s1     = $kDB->tanggal_input;
                                            $date1  = strtotime($s1);
                                            $data1 = date('Y-M-d H:i:s', $date1);
                        
                                            $s2     = $kDB->tanggal_selesai;
                                            $date2  = strtotime($s2);
                                            $data2 = date('Y-M-d H:i:s', $date2);
                                            
                                            $awal  = date_create($data1);
                                            $akhir = date_create($data2);
                                            $diff  = date_diff( $awal, $akhir);
                                            
                                            $durasi1 =  (($diff->d*24)+$diff->h).':'.$diff->i.':'.$diff->s;
                                            echo $durasi1;
                                        }
                                    ?>
                                    </td>
                                <!-- proses end -->
                                
                                <!-- ke-konsumen start -->
                                    <td>
                                    <?php
                                        if($kDB->tanggal_ambil == '0000-00-00 00:00:00'){
                                            echo '-';
                                        }else{
                                            $s3     = $kDB->tanggal_selesai;
                                            $date3  = strtotime($s3);
                                            $data3 = date('Y-M-d H:i:s', $date3);
                        
                                            $s4     = $kDB->tanggal_ambil;
                                            $date4  = strtotime($s4);
                                            $data4 = date('Y-M-d H:i:s', $date4);
                                            
                                            $awal2  = date_create($data3);
                                            $akhir2 = date_create($data4);
                                            $diff2  = date_diff($awal2, $akhir2);
                        
                                            $durasi2 =  (($diff2->d*24)+$diff2->h).':'.$diff2->i.':'.$diff2->s;
                                            echo $durasi2;
                                        }
                                    ?>
                                    </td>
                                <!-- ke-konsumen end -->
                                
                                <!-- komit start -->
                                <td title="<?php echo $kDB->commit_time.' - '.$kDB->tanggal_input; ?>">
                                <?php
                                    if($kDB->commit_time == NULL){
                                        echo '-';
                                    }else{
                                        $s4     = $kDB->commit_time;
                                        $date4  = strtotime($s4);
                                        $data4 = date('Y-M-d H:i:s', $date4);
                    
                                        $s5     = $kDB->tanggal_input;
                                        $date5  = strtotime($s5);
                                        $data5 = date('Y-M-d H:i:s', $date5);
                                        
                                        $awal3  = date_create($data4);
                                        $akhir3 = date_create($data5);
                                        $diff3  = date_diff($awal3, $akhir3);
                    
                                        $durasi3 =  (($diff3->d*24)+$diff3->h).':'.$diff3->i.':'.$diff3->s;
                                        echo $durasi3;
                                    }
                                ?>
                                </td>
                                <!-- komit end -->
                                
                                <!-- status commit order -->
                                    <td>TIDAK SESUAI</td>
                                    <td title="<?php echo $ket1.' - '.$ket2; ?>"><?php echo $durasi4; ?></td></b>
                                <!-- status commit order -->
                                </tr>
                            <!-- END OF STATUS_HIJAU -->
                            
                            <?php 
                            } else if( (($diff->d*24)+$diff->h)=='0' && ($diff->i <= 59) ){
                            ?>
                            
                            <!-- 31menit - 60menit : MERAH -->
                                <tr class="text-center" id="row-merah">
                                    <td><?= $kDB->no_invoice; ?></td>
                                    <td><?= $kDB->faktur_rak; ?></td>
                                    <td><?= $kDB->tanggal_input; ?></td>
                                    <td><?= $kDB->tanggal_selesai; ?></td>
                                    <td><?= $kDB->tanggal_ambil; ?></td>
                                
                                <!-- sales start -->
                                    <td>
                                    <?php
                                        // parsing list_penerimaan
                    			        $data1 = $kDB->penerimaan;
                                        if($data1 == 'kosong'){
                                            $data4 = 'kosong';
                                        }else{
                                            $data2 = explode(",",$data1);
                                            // buat array penampung
                                            $data3 = array();
                                            foreach($data2 as $d2){
                                                array_push($data3,getNamaKaryawan($d2));
                                            }
                                            $data4 = implode("  /  ",$data3);
                                        }
                          			    //output
                          			    echo strtoupper($data4);
                          			?>
                                    </td>
                                <!-- sales end-->
                                    
                                <!-- produksi start -->
                                    <td>
                                    <?php
                                        // parsing list_pengerjaan
                                        $data6 = $kDB->pengerjaan;
                                        if($data6 == 'kosong'){
                                            $data9 = 'kosong';
                                        }else{
                                            $data7 = explode(",",$data6);
                                            // buat array penampung
                                            $data8 = array();
                                            foreach($data7 as $d7){
                                                array_push($data8,getNamaKaryawan($d7));
                                            }
                                            $data9 = implode("  /  ",$data8);
                                        }
                                        //output
                                        echo strtoupper($data9);
                                    ?>
                                    </td>
                                <!-- produksi end -->
                                
                                <!-- staff-bj start -->
                                    <td><?= strtoupper($kDB->operator_input); ?></td>
                                    <td><?= strtoupper($kDB->operator_ambil); ?></td>
                                <!-- staff-bj end -->
                                    
                                <!-- proses start -->
                                    <b><td>
                                    <?php
                                        if($kDB->tanggal_selesai == '0000-00-00 00:00:00'){
                                            echo '-';
                                        }else{
                                            $s1     = $kDB->tanggal_input;
                                            $date1  = strtotime($s1);
                                            $data1 = date('Y-M-d H:i:s', $date1);
                        
                                            $s2     = $kDB->tanggal_selesai;
                                            $date2  = strtotime($s2);
                                            $data2 = date('Y-M-d H:i:s', $date2);
                                            
                                            $awal  = date_create($data1);
                                            $akhir = date_create($data2);
                                            $diff  = date_diff( $awal, $akhir);
                                            
                                            $durasi1 =  (($diff->d*24)+$diff->h).':'.$diff->i.':'.$diff->s;
                                            echo $durasi1;
                                        }
                                    ?>
                                    </td>
                                <!-- proses end -->
                                
                                <!-- ke-konsumen start -->
                                    <td>
                                    <?php
                                        if($kDB->tanggal_ambil == '0000-00-00 00:00:00'){
                                            echo '-';
                                        }else{
                                            $s3     = $kDB->tanggal_selesai;
                                            $date3  = strtotime($s3);
                                            $data3 = date('Y-M-d H:i:s', $date3);
                        
                                            $s4     = $kDB->tanggal_ambil;
                                            $date4  = strtotime($s4);
                                            $data4 = date('Y-M-d H:i:s', $date4);
                                            
                                            $awal2  = date_create($data3);
                                            $akhir2 = date_create($data4);
                                            $diff2  = date_diff($awal2, $akhir2);
                        
                                            $durasi2 =  (($diff2->d*24)+$diff2->h).':'.$diff2->i.':'.$diff2->s;
                                            echo $durasi2;
                                        }
                                    ?>
                                    </td>
                                <!-- ke-konsumen end -->
                                
                                <!-- komit start -->
                                <td title="<?php echo $kDB->commit_time.' - '.$kDB->tanggal_input; ?>">
                                <?php
                                    if($kDB->commit_time == NULL){
                                        echo '-';
                                    }else{
                                        $s4     = $kDB->commit_time;
                                        $date4  = strtotime($s4);
                                        $data4 = date('Y-M-d H:i:s', $date4);
                    
                                        $s5     = $kDB->tanggal_input;
                                        $date5  = strtotime($s5);
                                        $data5 = date('Y-M-d H:i:s', $date5);
                                        
                                        $awal3  = date_create($data4);
                                        $akhir3 = date_create($data5);
                                        $diff3  = date_diff($awal3, $akhir3);
                    
                                        $durasi3 =  (($diff3->d*24)+$diff3->h).':'.$diff3->i.':'.$diff3->s;
                                        echo $durasi3;
                                    }
                                ?>
                                </td>
                                <!-- komit end -->
                                
                                <!-- status commit order -->
                                    <td>TIDAK SESUAI</td>
                                    <td title="<?php echo $ket1.' - '.$ket2; ?>"><?php echo $durasi4; ?></td></b>
                                <!-- status commit order -->
                                </tr>
                            <!-- END OF STATUS_KUNING -->
                            
                            <?php
                            }else{
                            ?>
                            
                            <!-- lebih dari 60 menit : UNGU -->
                                <tr class="text-center" id="row-ungu">
                                    <td><?= $kDB->no_invoice; ?></td>
                                    <td><?= $kDB->faktur_rak; ?></td>
                                    <td><?= $kDB->tanggal_input; ?></td>
                                    <td><?= $kDB->tanggal_selesai; ?></td>
                                    <td><?= $kDB->tanggal_ambil; ?></td>
                                
                                <!-- sales start -->
                                    <td>
                                    <?php
                                        // parsing list_penerimaan
                    			        $data1 = $kDB->penerimaan;
                                        if($data1 == 'kosong'){
                                            $data4 = 'kosong';
                                        }else{
                                            $data2 = explode(",",$data1);
                                            // buat array penampung
                                            $data3 = array();
                                            foreach($data2 as $d2){
                                                array_push($data3,getNamaKaryawan($d2));
                                            }
                                            $data4 = implode("  /  ",$data3);
                                        }
                          			    //output
                          			    echo strtoupper($data4);
                          			?>
                                    </td>
                                <!-- sales end-->
                                    
                                <!-- produksi start -->
                                    <td>
                                    <?php
                                        // parsing list_pengerjaan
                                        $data6 = $kDB->pengerjaan;
                                        if($data6 == 'kosong'){
                                            $data9 = 'kosong';
                                        }else{
                                            $data7 = explode(",",$data6);
                                            // buat array penampung
                                            $data8 = array();
                                            foreach($data7 as $d7){
                                                array_push($data8,getNamaKaryawan($d7));
                                            }
                                            $data9 = implode("  /  ",$data8);
                                        }
                                        //output
                                        echo strtoupper($data9);
                                    ?>
                                    </td>
                                <!-- produksi end -->
                                
                                <!-- staff-bj start -->
                                    <td><?= strtoupper($kDB->operator_input); ?></td>
                                    <td><?= strtoupper($kDB->operator_ambil); ?></td>
                                <!-- staff-bj end -->
                                    
                                <!-- proses start -->
                                    <b><td>
                                    <?php
                                        if($kDB->tanggal_selesai == '0000-00-00 00:00:00'){
                                            echo '-';
                                        }else{
                                            $s1     = $kDB->tanggal_input;
                                            $date1  = strtotime($s1);
                                            $data1 = date('Y-M-d H:i:s', $date1);
                        
                                            $s2     = $kDB->tanggal_selesai;
                                            $date2  = strtotime($s2);
                                            $data2 = date('Y-M-d H:i:s', $date2);
                                            
                                            $awal  = date_create($data1);
                                            $akhir = date_create($data2);
                                            $diff  = date_diff( $awal, $akhir);
                                            
                                            $durasi1 =  (($diff->d*24)+$diff->h).':'.$diff->i.':'.$diff->s;
                                            echo $durasi1;
                                        }
                                    ?>
                                    </td>
                                <!-- proses end -->
                                
                                <!-- ke-konsumen start -->
                                    <td>
                                    <?php
                                        if($kDB->tanggal_ambil == '0000-00-00 00:00:00'){
                                            echo '-';
                                        }else{
                                            $s3     = $kDB->tanggal_selesai;
                                            $date3  = strtotime($s3);
                                            $data3 = date('Y-M-d H:i:s', $date3);
                        
                                            $s4     = $kDB->tanggal_ambil;
                                            $date4  = strtotime($s4);
                                            $data4 = date('Y-M-d H:i:s', $date4);
                                            
                                            $awal2  = date_create($data3);
                                            $akhir2 = date_create($data4);
                                            $diff2  = date_diff($awal2, $akhir2);
                        
                                            $durasi2 =  (($diff2->d*24)+$diff2->h).':'.$diff2->i.':'.$diff2->s;
                                            echo $durasi2;
                                        }
                                    ?>
                                    </td>
                                <!-- ke-konsumen end -->
                                
                                <!-- komit start -->
                                <td title="<?php echo $kDB->commit_time.' - '.$kDB->tanggal_input; ?>">
                                <?php
                                    if($kDB->commit_time == NULL){
                                        echo '-';
                                    }else{
                                        $s4     = $kDB->commit_time;
                                        $date4  = strtotime($s4);
                                        $data4 = date('Y-M-d H:i:s', $date4);
                    
                                        $s5     = $kDB->tanggal_input;
                                        $date5  = strtotime($s5);
                                        $data5 = date('Y-M-d H:i:s', $date5);
                                        
                                        $awal3  = date_create($data4);
                                        $akhir3 = date_create($data5);
                                        $diff3  = date_diff($awal3, $akhir3);
                    
                                        $durasi3 =  (($diff3->d*24)+$diff3->h).':'.$diff3->i.':'.$diff3->s;
                                        echo $durasi3;
                                    }
                                ?>
                                </td>
                                <!-- komit end -->
                                
                                <!-- status commit order -->
                                    <td>TIDAK SESUAI</td>
                                    <td title="<?php echo $ket1.' - '.$ket2; ?>"><?php echo $durasi4; ?></td></b>
                                <!-- status commit order -->
                                </tr>
                            <!-- END OF STATUS_MERAH -->
                            
                            <?php
                            }
                            ?>
                            
                    <?php
                        }else{
                            // JIKA SESUAI : WAKTU PEMESANAN PENGAMBILAN COCOK 
                    ?>
                            <tr class="text-center">
                                <td><?= $kDB->no_invoice; ?></td>
                                <td><?= $kDB->faktur_rak; ?></td>
                                <td><?= $kDB->tanggal_input; ?></td>
                                <td><?= $kDB->tanggal_selesai; ?></td>
                                <td><?= $kDB->tanggal_ambil; ?></td>
                            
                            <!-- sales start -->
                                <td>
                                <?php
                                    // parsing list_penerimaan
                			        $data1 = $kDB->penerimaan;
                                    if($data1 == 'kosong'){
                                        $data4 = 'kosong';
                                    }else{
                                        $data2 = explode(",",$data1);
                                        // buat array penampung
                                        $data3 = array();
                                        foreach($data2 as $d2){
                                            array_push($data3,getNamaKaryawan($d2));
                                        }
                                        $data4 = implode("  /  ",$data3);
                                    }
                      			    //output
                      			    echo strtoupper($data4);
                      			?>
                                </td>
                            <!-- sales end-->
                                
                            <!-- produksi start -->
                                <td>
                                <?php
                                    // parsing list_pengerjaan
                                    $data6 = $kDB->pengerjaan;
                                    if($data6 == 'kosong'){
                                        $data9 = 'kosong';
                                    }else{
                                        $data7 = explode(",",$data6);
                                        // buat array penampung
                                        $data8 = array();
                                        foreach($data7 as $d7){
                                            array_push($data8,getNamaKaryawan($d7));
                                        }
                                        $data9 = implode("  /  ",$data8);
                                    }
                                    //output
                                    echo strtoupper($data9);
                                ?>
                                </td>
                            <!-- produksi end -->
                            
                            <!-- staff-bj start -->
                                <td><?= strtoupper($kDB->operator_input); ?></td>
                                <td><?= strtoupper($kDB->operator_ambil); ?></td>
                            <!-- staff-bj end -->
                                
                            <!-- proses start -->
                                <b><td class="text-primary">
                                <?php
                                    if($kDB->tanggal_selesai == '0000-00-00 00:00:00'){
                                        echo '-';
                                    }else{
                                        $s1     = $kDB->tanggal_input;
                                        $date1  = strtotime($s1);
                                        $data1 = date('Y-M-d H:i:s', $date1);
                    
                                        $s2     = $kDB->tanggal_selesai;
                                        $date2  = strtotime($s2);
                                        $data2 = date('Y-M-d H:i:s', $date2);
                                        
                                        $awal  = date_create($data1);
                                        $akhir = date_create($data2);
                                        $diff  = date_diff( $awal, $akhir);
                                        
                                        $durasi1 =  (($diff->d*24)+$diff->h).':'.$diff->i.':'.$diff->s;
                                        echo $durasi1;
                                    }
                                ?>
                                </td>
                            <!-- proses end -->
                            
                            <!-- ke-konsumen start -->
                                <td class="text-primary">
                                <?php
                                    if($kDB->tanggal_ambil == '0000-00-00 00:00:00'){
                                        echo '-';
                                    }else{
                                        $s3     = $kDB->tanggal_selesai;
                                        $date3  = strtotime($s3);
                                        $data3 = date('Y-M-d H:i:s', $date3);
                    
                                        $s4     = $kDB->tanggal_ambil;
                                        $date4  = strtotime($s4);
                                        $data4 = date('Y-M-d H:i:s', $date4);
                                        
                                        $awal2  = date_create($data3);
                                        $akhir2 = date_create($data4);
                                        $diff2  = date_diff($awal2, $akhir2);
                    
                                        $durasi2 =  (($diff2->d*24)+$diff2->h).':'.$diff2->i.':'.$diff2->s;
                                        echo $durasi2;
                                    }
                                ?>
                                </td>
                            <!-- ke-konsumen end -->
                            
                            <!-- komit start -->
                                <td class="text-primary" title="<?php echo $kDB->commit_time.' - '.$kDB->tanggal_input; ?>">
                                <?php
                                    if($kDB->commit_time == NULL){
                                        echo '-';
                                    }else{
                                        $s4     = $kDB->commit_time;
                                        $date4  = strtotime($s4);
                                        $data4 = date('Y-M-d H:i:s', $date4);
                    
                                        $s5     = $kDB->tanggal_input;
                                        $date5  = strtotime($s5);
                                        $data5 = date('Y-M-d H:i:s', $date5);
                                        
                                        $awal3  = date_create($data4);
                                        $akhir3 = date_create($data5);
                                        $diff3  = date_diff($awal3, $akhir3);
                    
                                        $durasi3 =  (($diff3->d*24)+$diff3->h).':'.$diff3->i.':'.$diff3->s;
                                        echo $durasi3;
                                    }
                                ?>
                                </td>
                            <!-- komit end -->
                            
                            <!-- status commit order -->
                                <td class="text-primary"> SESUAI </td>
                                <td class="text-primary"> - </td></b>
                            <!-- status commit order -->
                            </tr>
                            
                            
                        <?php
                        }
                    ?>
                    <!-- data embedd end  -->
                    
                    
                    <?php } ?>
                </tbody>
              </table>
            </div>

            <div class="box-footer">
              <!--taro pagination-->
              <div class="text-center">
                  <?php echo $paginator;?>
              </div>
            </div>

          </div>
        </div>
    </div>
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i style="padding: 3px 5px; border: 1px solid #000;" class="fa fa-info" aria-hidden="true"></i> INDICATOR</h4>
          </div>
          <div class="modal-body">
            <table>
                <tr>
                    <td>MERAH</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>Telat >60 Menit</td>
                </tr>
                <tr>
                    <td>KUNING</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>Telat 30-60 Menit</td>
                </tr>
                <tr>
                    <td>HIJAU</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>Telat 10-30 Menit</td>
                </tr>
                <tr>
                    <td>ORANGE</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>Telat 1-10 Menit</td>
                </tr>
                <tr>
                    <td>PUTIH</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>LEBIH CEPAT / TEPAT</td>
                </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->