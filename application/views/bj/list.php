    <!-- Data Navigasi Dashboard -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_bj" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo site_url('bj');?>" class="navbar-brand"><small>Cari Transaksi</small></a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar_bj" aria-expanded="false" style="height: 1px;">
                        <ul class="nav navbar-nav navbar-right">
                            <?php echo form_open("bj/home/cari_faktur", 'class="navbar-form"'); ?>
                            <div class="form-group">
                              <input type="text" name="cari_faktur" class="form-control" id="cari_faktur" placeholder="Kode Transaksi">
                            </div> 
                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-search"></i> <small>Cari</small></button>
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
            <div class="box-header text-center bg-success">
              <h4 style="font-family: Nunito;" class="box-title"><b>Daftar Record Transaksi</b></h4>
            </div>
            <div class="box-body table-responsive">
              <!--kode untuk realtime orderan masuk-->
              <table class="table table-striped table-hover table-bordered">
                <thead>
                </style>
                  <tr>
                    <th class="text-center">Nomor Invoice</th>
                    <th class="text-center">Tanggal SPK</th>
                    <th class="text-center">Design Edit</th>
                    <th class="text-center">Penerimaan</th>
                    <th class="text-center">Pengerjaan</th>
                    <th class="text-center">Pilihan</th>
                  </tr>
                </thead>
                <tbody>
                    <!-- data embedd -->
                    <?php foreach($kinerjaDB as $kDB){ ?>
                    <tr class="text-center">
                        <td><?= $kDB->no_invoice; ?></td>
                        <td><?= $kDB->tgl_spk; ?></td>
                        <td><?= $kDB->design_edit; ?> mnt</td>
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
                			echo $data4;
                        ?>
                        </td>
                        <td>
                        <?php
                            // parsing list_pengerjaan
                			$data1 = $kDB->pengerjaan;
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
                			echo $data4;
                        ?>
                        </td>
                        <td>
                            <small>
                                <a class="text-success" style="font-weight: bold;" title="Ubah" href="<?php echo site_url('bj/home/edit/').$kDB->no_invoice;?>"><i class="fa fa-folder" aria-hidden="true"></i> Selesai</a>
                            </small>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>