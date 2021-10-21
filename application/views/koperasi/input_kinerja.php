    <!-- Data Navigasi Dashboard -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_koperasi" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="" class="navbar-brand"><small>Cari Karyawan</small></a>
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

    <div class="row">
      <div class="col-xs-12 col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <!--code here-->
            <h5><i class="fa fa-laptop"> </i> <b>Form Koperasi<span class="pull-right col-sm-hide"><i class="fa fa-calendar"></i>&nbsp;<?php echo date('Y-m-d');?></span></b></h5>
            <hr>
    
            <div class="row">
              <div class="col-xs-12 col-md-12">
                <!-- kontent here-->
                <form class="form-horizontal" action="<?php echo site_url('koperasi/home/simpan_kinerja');?>" method="post">
                    <input class="form-control col-sm-12" type="hidden" name="invoice_terakhir" value="<?= getNomerKinerja(); ?>" />
                    <div class="box-body">
                        
                        <!-- data faktur -->
                        <div class="form-group">
                            <label for="tgl_spk" class="col-sm-2 control-label">Tgl Nabung</label>
                            <div class="col-sm-10">
                              <input class="form-control tanggalSekarang" name="tgl_spk" type="text" placeholder="<?php echo date('Y-m-d');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="penerimaan" class="col-sm-2 control-label">Nama Karyawan</label>
                            <div class="col-sm-10">
                              <select class="select-form-multiple" style="width: 100%;" name="penerimaan[]" multiple="multiple">
                              <?php foreach($semuaIDKaryawan as $semuaID){ ?>
                                  <option value="<?= $semuaID->id_karyawan; ?>"><?= $semuaID->nama; ?></option>
                              <?php } ?>
                              </select>
                            </div>
                       </div>
                      
                      <div class="form-group">
                            <label for="type" class="col-sm-2 control-label">Type Koperasi</label>
                            <div class="col-sm-10">
                              <select class="select-form-multiple" style="width: 100%;" name="type[]" multiple="multiple">
                                  <option value="1">Koperasi Bulanan</option>
                                  <option value="2">Koperasi Harian</option>
                                  <option value="3">Ulang Tahun</option>
                                  <option value="4">Sukarela</option>
                                  <option value="5">Penarikan</option>
                                  <option value="6">Bonus</option>
                              </select>
                            </div>
                      </div>

                        <div class="form-group">
                            <label for="nominal" class="col-sm-2 control-label">Nominal</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="nominal" type="number" placeholder="0">
                            </div>
                        </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <button type="reset" class="btn btn-warning">Reset</button>
                  <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
                <!-- /.box-footer -->
            </form>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>