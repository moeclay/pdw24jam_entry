        <div class="col-md-8 col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <p><span class="fa fa-user-secret"></span> Koperasi Karyawan </p>
              <div class="box-tools pull-right">
                  <button title="Cetak" type="button" class="btn btn-success btn-xs" onclick="printData('data_pribadi')"><i class="fa fa-print"> print</i>
                  </button>
                  <button title="Hide" type="button" class="btn btn-danger btn-xs" data-widget="collapse"><i class="fa fa-minus"> </i>
                  </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div id="data_pribadi" class="box-body table-responsive">
              <h4 class="text-center"><span class="fa fa-user-secret"></span> Detail Koperasi Karyawan</h4>
              <br>

            
            <div class="box-body table-responsive">
              <!--kode untuk realtime orderan masuk-->
              <table class="table table-striped table-hover">
                <thead>
                </style>
                  <tr>
                    <th class="text-center">ID NABUNG</th>
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
                        <td>Rp <?= format_uang($kDB->nominal); ?></td>
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
                  </tr>
                </tbody>
              </table>

               <?php foreach($total as $tot){ ?>

                <br>
                <h4 class="box-title text-danger" align="center"><b>Total Tabungan Rp <?= format_uang($tot->kb + $tot->kh + $tot->ut - $tot->s - $tot->p + $tot->b); ?></b></h4>
                
                <?php } ?>
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


        <!-- script for printing -->
        <script type="text/javascript">
          function printData(el){
            var restorePage  = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorePage; 
          }
        </script>