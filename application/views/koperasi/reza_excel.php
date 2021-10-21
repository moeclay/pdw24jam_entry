            <table class="table table-striped table-hover">
                <thead>
                </style>
                  <tr>
                    <th class="text-center">ID TABUNG</th>
                    <th class="text-center">TGL NABUNG</th>
                    <th class="text-center">NAMA KARYAWAN</th>
                    <th class="text-center">TYPE TABUNGAN</th>
                    <th class="text-center">NOMINAL</th>
                    <th class="text-center">TANGGAL INPUT</th>
                  </tr>
                </thead>
                <tbody>
                    <!-- data embedd -->
                    <?php foreach($kinerjaDB as $kDB){ ?>
                    <tr class="text-center">
                        <td><?= $kDB->id_kinerja; ?></td>
                        <td><?= $kDB->tgl_spk; ?></td>
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
                                    array_push($data3,getNamaLengkapKaryawan($d2));
                                }
                                $data4 = implode("  /  ",$data3);
                            }
                            //output
                            echo $data4;
                        ?>
                        </td>
                        <td><?= ambilNamaType ($kDB->type); ?></td>
                        <td><?= format_uang ($kDB->nominal); ?></td>
                        <td><?= $kDB->tanggal_input; ?></td>
                        <!-- <td>
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
                            echo $data9;
                        ?>
                        </td> -->
                    <?php } ?>
                </tbody>
              </table>