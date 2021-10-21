<table border="1px">
    <small>
    <tr>
        <td>No</td>
        <td>Faktur</td>
        <td>Design Edit</td>
        <td>Rak</td>
        <td>Tanngal Input</td>
        <td>Tanggal Proses</td>
        <td>Tanggal Diambil</td>
        <td>Operator Sales</td>
        <td>Operator Produksi</td>
        <td>Proses (Input - Selesai)</td>
        <td>Diambil (Selesai - Diambil)</td>
        <td>Konsumen (Commit Selesai)</td>
        <td>Status</td>
        <td>Telat</td>
        <td>Staff Input</td>
        <td>Staff Ambil</td>
    </tr>
    <?php
        $i = 1;
        foreach($data as $d){
    ?>
    <tr>
        <td><small><?= $i; ?></small></td>
        <td><small><?= $d->no_invoice; ?></small></td>
        <td><small><?= $d->design_edit; ?></small></td>
        <td><small><?= $d->faktur_rak; ?></small></td>
        <td><small><?= $d->tanggal_input; ?></small></td>
        <td><small><?= $d->tanggal_selesai; ?></small></td>
        <td><small><?= $d->tanggal_ambil; ?></small></td>
        
        <td><small>
            <?php
                // operator sales
                $data1 = $d->penerimaan;
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
                
                // output
                echo strtoupper($data4);
            ?></small>
        </td>
        <td><small>
            <?php
                // parsing list_pengerjaan
                $data6 = $d->pengerjaan;
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
        </small></td>
        <td><small>
            <?php
                // durasi proses
                if($d->tanggal_selesai == '0000-00-00 00:00:00'){
                    echo '-';
                }else{
                    $s1     = $d->tanggal_input;
                    $date1  = strtotime($s1);
                    $data1 = date('Y-M-d H:i:s', $date1);
                        
                    $s2     = $d->tanggal_selesai;
                    $date2  = strtotime($s2);
                    $data2 = date('Y-M-d H:i:s', $date2);
                                            
                    $awal  = date_create($data1);
                    $akhir = date_create($data2);
                    $diff  = date_diff( $awal, $akhir);
                                            
                    $durasi1 =  (($diff->d*24)+$diff->h).':'.$diff->i.':'.$diff->s;
                    echo $durasi1;
                }
            ?>
        </small></td>
        <td><small>
            <?php
                // durasi diambil
                if($d->tanggal_ambil == '0000-00-00 00:00:00'){
                    echo '-';
                }else{
                    $s3     = $d->tanggal_selesai;
                    $date3  = strtotime($s3);
                    $data3 = date('Y-M-d H:i:s', $date3);
                        
                    $s4     = $d->tanggal_ambil;
                    $date4  = strtotime($s4);
                    $data4 = date('Y-M-d H:i:s', $date4);
                                            
                    $awal2  = date_create($data3);
                    $akhir2 = date_create($data4);
                    $diff2  = date_diff($awal2, $akhir2);
                        
                    $durasi2 =  (($diff2->d*24)+$diff2->h).':'.$diff2->i.':'.$diff2->s;
                    echo $durasi2;
                }
            ?>
        </small></td>
        <td><small>
            <?php
                // durasi konsumen
                if($d->tanggal_ambil == '0000-00-00 00:00:00'){
                    echo '-';
                }else{
                    $s3     = $d->tanggal_selesai;
                    $date3  = strtotime($s3);
                    $data3 = date('Y-M-d H:i:s', $date3);
                        
                    $s4     = $d->tanggal_ambil;
                    $date4  = strtotime($s4);
                    $data4 = date('Y-M-d H:i:s', $date4);
                                            
                    $awal2  = date_create($data3);
                    $akhir2 = date_create($data4);
                    $diff2  = date_diff($awal2, $akhir2);
                        
                    $durasi2 =  (($diff2->d*24)+$diff2->h).':'.$diff2->i.':'.$diff2->s;
                    echo $durasi2;
                }
            ?>
        </small></td>


        
        <?php
            // cek telat
            $data1 = date('Y-M-d H:i:s', $d->commit_unix);
            $data2 = date('Y-M-d H:i:s', strtotime($d->tanggal_selesai));
            
            $awal  = date_create($data1);
            $akhir = date_create($data2);
            $diff  = date_diff( $awal, $akhir);
                    
            $durasi4 =  (($diff->d*24)+$diff->h).':'.$diff->i.':'.$diff->s;
            
            
            // cek status
            if( ( intval($d->commit_unix) <= intval(strtotime($d->tanggal_selesai)) ) && (isset($d->commit_unix)) ) {
                echo "<td><small>TIDAK SESUAI</small></td>";
                echo "<td><small>".$durasi4."</small></td>";
            }else{
                echo "<td><small>SESUAI</small></td>";
                echo "<td><small>-</small></td>";
            }
        ?>
        <td><small><?= strtoupper($d->operator_input); ?></small></td>
        <td><small><?= strtoupper($d->operator_ambil); ?></small></td>
    </tr>  
    <?php
            $i++;
        }
    ?>
    </small>
</table>