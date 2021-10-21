    <!-- Style Coloring -->
    <style type="text/css">
      table {
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
                              <input type="text" name="cari_kinerja" class="form-control" id="cari_kinerja" placeholder="Nomor Faktur" required />
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
          <div class="box box-danger">
            <div class="box-body table-responsive">
              <!--kode untuk realtime orderan masuk-->
              <table class="table">
                <thead>
                </style>
                  <tr>
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
                    <th class="text-center" title="status pengerjaan">STATUS BARANG</th>
                    <th class="text-center" title="status waktu (sesuai/tidaksesuai)">STATUS WAKTU</th>
                    <th class="text-center" title="total telat (jam:menit:detik)">TELAT</th>
                  </tr>
                </thead>
                
                <tbody>
                    <!-- data embedd start  -->
                    <tr class="text-center tabledetail" id="">
                        <td><?= $kinerjaDB->no_invoice; ?></td>
                        <td>
                        <?php
                            $rak = $kinerjaDB->faktur_rak; 
                            if($rak == ""){
                                $rak1 = '-';
                            }else{
                                $rak1 = $rak;
                            }
                            echo strtoupper($rak1);
                        ?>
                        </td>
                        
                        <td><?= $kinerjaDB->tanggal_input; ?></td>
                        <td><?= $kinerjaDB->tanggal_selesai; ?></td>
                        <td><?= $kinerjaDB->tanggal_ambil; ?></td>
                        
                        <td><?php
                            $data1 = $kinerjaDB->penerimaan;
                            if($data1 == ''){
                                $data4 = '-';
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
                        ?></td>
                        <td><?php
                            $data6 = $kinerjaDB->pengerjaan;
                            if($data6 == ''){
                                $data9 = '-';
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
                        ?></td>
                        
                        <td><?php 
                            $opinput = $kinerjaDB->operator_input; 
                            if($opinput == ''){
                                echo '-';
                            }else{
                                echo $opinput;
                            }
                        ?></td>
                        
                        <td><?php 
                            $opambil = $kinerjaDB->operator_ambil; 
                            if($opambil == ''){
                                echo '-';
                            }else{
                                echo $opambil;
                            }
                        ?></td>
                        
                        <td>
                            <?php
                                // waktu proses
                                // tgl_selesai - tgl_input
                                if($kinerjaDB->tanggal_selesai == '0000-00-00 00:00:00'){
                                    echo '-';
                                }else{
                                    $s1     = $kinerjaDB->tanggal_input;
                                    $date1  = strtotime($s1);
                                    $data1 = date('Y-M-d H:i:s', $date1);
                
                                    $s2     = $kinerjaDB->tanggal_selesai;
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
                        <td>
                        <?php
                            // waktu dirak
                            // tgl_ambil - tgl_selesai
                            if($kinerjaDB->tanggal_ambil == '0000-00-00 00:00:00'){
                                echo '-';
                            }else{
                                $s3     = $kinerjaDB->tanggal_selesai;
                                $date3  = strtotime($s3);
                                $data3 = date('Y-M-d H:i:s', $date3);
            
                                $s4     = $kinerjaDB->tanggal_ambil;
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
                        
                        <td>
                        <?php
                            // waktu konsumen
                            // commit_time - tanggal_input
                            if($kinerjaDB->commit_time == NULL){
                                echo '-';
                            }else{
                                $s4     = $kinerjaDB->commit_time;
                                $date4  = strtotime($s4);
                                $data4 = date('Y-M-d H:i:s', $date4);
            
                                $s5     = $kinerjaDB->tanggal_input;
                                $date5  = strtotime($s5);
                                $data5  = date('Y-M-d H:i:s', $date5);
                                
                                $awal3  = date_create($data4);
                                $akhir3 = date_create($data5);
                                $diff3  = date_diff($awal3, $akhir3);
            
                                $durasi3 =  (($diff3->d*24)+$diff3->h).':'.$diff3->i.':'.$diff3->s;
                                echo $durasi3;
                            }
                        ?>
                        </td>
                        <td><?= strtoupper($kinerjaDB->faktur_status); ?></td>
                        <td><span id="status_waktu">-</span></td>
                        <td>
                        <?php
                            if( intval($kinerjaDB->commit_unix) <= intval(strtotime($kinerjaDB->tanggal_selesai)) ){
                                $data1 = date('Y-M-d H:i:s', $kinerjaDB->commit_unix);
                                $data2 = date('Y-M-d H:i:s', strtotime($kinerjaDB->tanggal_selesai));
                                            
                                $awal  = date_create($data1);
                                $akhir = date_create($data2);
                                $diff  = date_diff( $awal, $akhir);
                        
                                $durasi4 =  (($diff->d*24)+$diff->h).':'.$diff->i.':'.$diff->s;
                                echo $durasi4;
                            }else{
                                echo strtoupper("-");
                            }
                        ?>
                        </td>
                    </tr>
                    <!-- data embedd end  -->
                </tbody>
                
                

              </table>
            </div>

          </div>
        </div>
    </div>

    <script type="text/javascript">
        <?php
            $data1 = date('Y-M-d H:i:s', $kinerjaDB->commit_unix);
            $data2 = date('Y-M-d H:i:s', strtotime($kinerjaDB->tanggal_selesai));
            
            $ket1  = $data1;
            $ket2  = $data2;
                        
            $awal  = date_create($data1);
            $akhir = date_create($data2);
            $diff  = date_diff( $awal, $akhir);

            if( intval($kinerjaDB->commit_unix) <= intval(strtotime($kinerjaDB->tanggal_selesai)) ){
                $status_waktu = "TIDAK SESUAI";
                if( (($diff->d*24)+$diff->h)=='0' && ($diff->i <= 9) ){
                    $warna = "row-hijau";
                }else if( (($diff->d*24)+$diff->h)=='0' && ($diff->i <= 29) ){
                    $warna = "row-kuning";
                }else if( (($diff->d*24)+$diff->h)=='0' && ($diff->i <= 59) ){
                    $warna = "row-merah";
                }else{
                    $warna = "row-ungu";
                }
            }else{
                $status_waktu = "SESUAI";
                $warna = "row-putih";
            }
        ?>
        console.log("warna_waktu  = <?= $warna; ?>");
        console.log("status_waktu = <?= $status_waktu; ?>");
        $(".tabledetail").attr("id", "<?= $warna; ?>");
        $("#status_waktu").text("<?= $status_waktu; ?>");
    </script>