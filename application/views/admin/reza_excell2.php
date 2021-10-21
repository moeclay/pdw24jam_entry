<table class="table">
                <thead>
                </style>
                  <tr>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Total Personal</th>
                    <th class="text-center">Total Putih</th>
                    <th class="text-center">Total Hijau</th>
                    <th class="text-center">Total Kuning</th>
                    <th class="text-center">Total Merah</th>
                    <th class="text-center">Total Ungu</th>
                  </tr>
                </thead>
                <tbody>
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
                            <!-- START OF STATUS_BIRU -->
                                <tr class="text-center" id="row-biru">
                                    <td><?= $kDB->no_invoice; ?></td>
                                    <td><?= $kDB->faktur_rak; ?></td>
                                    <td><?= $kDB->design_edit; ?></td>
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
                                    
                                <!-- proses start -->
                                    <td>
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
                                    <td title="<?php echo $ket1.' - '.$ket2; ?>"><?php echo $durasi4; ?></td>
                                <!-- status commit order -->
                                
                                <!-- staff-bj start -->
                                    <td><?= strtoupper($kDB->operator_input); ?></td>
                                    <td><?= strtoupper($kDB->operator_ambil); ?></td>
                                <!-- staff-bj end -->
                                </tr>
                            <!-- END OF STATUS_BIRU -->
                            
                            <?php 
                            } else if( (($diff->d*24)+$diff->h)=='0' && ($diff->i <= 29) ){
                            ?>
                            
                            <!-- START OF STATUS_HIJAU -->
                                <tr class="text-center" id="row-hijau">
                                    <td><?= $kDB->no_invoice; ?></td>
                                    <td><?= $kDB->faktur_rak; ?></td>
                                    <td><?= $kDB->tanggal_input; ?></td>
                                    <td><?= $kDB->tanggal_selesai; ?></td>
                                    <td><?= $kDB->tanggal_ambil; ?></td>
                                    <td><?= $kDB->design_edit; ?></td>
                                
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
                                    
                                <!-- proses start -->
                                    <td>
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
                                    <td title="<?php echo $ket1.' - '.$ket2; ?>"><?php echo $durasi4; ?></td>
                                <!-- status commit order -->
                                
                                <!-- staff-bj start -->
                                    <td><?= strtoupper($kDB->operator_input); ?></td>
                                    <td><?= strtoupper($kDB->operator_ambil); ?></td>
                                <!-- staff-bj end -->
                                </tr>
                            <!-- END OF STATUS_HIJAU -->
                            
                            <?php 
                            } else if( (($diff->d*24)+$diff->h)=='0' && ($diff->i <= 59) ){
                            ?>
                            
                            <!-- START OF STATUS_KUNING -->
                                <tr class="text-center" id="row-kuning">
                                    <td><?= $kDB->no_invoice; ?></td>
                                    <td><?= $kDB->faktur_rak; ?></td>
                                    <td><?= $kDB->tanggal_input; ?></td>
                                    <td><?= $kDB->tanggal_selesai; ?></td>
                                    <td><?= $kDB->tanggal_ambil; ?></td>
                                    <td><?= $kDB->design_edit; ?></td>
                                
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
                                    
                                <!-- proses start -->
                                    <td>
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
                                    <td title="<?php echo $ket1.' - '.$ket2; ?>"><?php echo $durasi4; ?></td>
                                <!-- status commit order -->
                                
                                <!-- staff-bj start -->
                                    <td><?= strtoupper($kDB->operator_input); ?></td>
                                    <td><?= strtoupper($kDB->operator_ambil); ?></td>
                                <!-- staff-bj end -->
                                </tr>
                            <!-- END OF STATUS_KUNING -->
                            
                            <?php
                            }else{
                            ?>
                            
                            <!-- START OF STATUS_MERAH -->
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
                                    
                                <!-- proses start -->
                                    <td>
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
                                    <td title="<?php echo $ket1.' - '.$ket2; ?>"><?php echo $durasi4; ?></td>
                                <!-- status commit order -->
                                
                                <!-- staff-bj start -->
                                    <td><?= strtoupper($kDB->operator_input); ?></td>
                                    <td><?= strtoupper($kDB->operator_ambil); ?></td>
                                <!-- staff-bj end -->
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
                                <td><?= $kDB->design_edit; ?></td>
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
                                
                            <!-- proses start -->
                                <td>
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
                                <td> SESUAI </td>
                                <td> - </td>
                            <!-- status commit order -->
                            
                            <!-- staff-bj start -->
                                <td><?= strtoupper($kDB->operator_input); ?></td>
                                <td><?= strtoupper($kDB->operator_ambil); ?></td>
                            <!-- staff-bj end -->
                            </tr>
                        <?php
                        }
                    ?>
                    <!-- data embedd end  -->
                    
                    
                    <?php } ?>
                </tbody>
              </table>