    <!-- Data Navigasi Dashboard -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_absensi" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo site_url('koperasi/home/laporan');?>" class="navbar-brand"><small>Cari Karyawan</small></a>
                        <button title="Print" type="button" class="btn btn-primary" style="margin: 10px;" onclick="window.location.href='<?php echo site_url('koperasi/home/export_file');?>'"><i class="fa fa-print"> Tarik Laporan </i></button>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar_koperasi" aria-expanded="false" style="height: 1px;">
                        <ul class="nav navbar-nav navbar-right">
                          <?php echo form_open("koperasi/home/cari_karyawan", 'class="navbar-form"'); ?>
                            <div class="form-group">
                              <select name="cari_nama" class="form-control">
                                <option value="">Cari Nama Karyawan</option>
                              <?php
                                foreach($karyawan as $k){
                              ?>
                                
                                <option value="<?php echo $k->id_karyawan;?>"><?php echo $k->nama;?></option>
                              <?php } ?>
                              
                              </select>
                            </div>
                            <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-search"></i> <small>Cari Nama</small></button>
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
            <div class="box-header text-center">
              <h4 class="box-title text-danger"><b>Daftar Koperasi </b></h4>
            </div>
            <div class="box-body table-responsive">
              <!--kode untuk realtime orderan masuk-->
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