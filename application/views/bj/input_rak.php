<div class="row">
  <div class="col-xs-12 col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <!--code here-->
        <div class="row">
          <div class="col-md-6">
            <h5 style="font-family: Nunito;"><b>Input Pengerjaan & Rak</b></h5>
          </div>
          <div class="col-md-6 text-right">
            <h5 style="font-family: Nunito; font-weight: bold;"><span class="text-white" id="date_time"></span></h5>
          </div>
        </div>
        <hr>

        <!-- diproses -->
        <?php if(!empty($faktur) && $faktur->faktur_status == 'Diproses'){ ?>
          <div class="row">
            <div class="col-xs-12 col-md-12">
              <!-- kontent here-->
              <!-- <form class="form-horizontal" action="<?php echo site_url('bj/home/update_statusbj');?>" method="post"> -->
              <div class="form-horizontal">
                  <div class="box-body">
                    <!-- data Transaksi -->

                    <!-- no invoice -->
                    <div class="form-group">
                      <label for="no_invoice" class="col-sm-2 control-label">NO.INVOICE</label>
                      <div class="col-sm-3">
                        <input class="form-control" name="no_invoice" type="text" value="<?php echo $faktur->no_invoice;?>" readonly/>
                      </div>
                      <label for="no_invoice" class="col-sm-3 control-label">TGL.AMBIL KONSUMEN</label>
                      <div class="col-sm-4">
                        <input class="form-control" name="no_invoice" type="text" value="<?php echo $faktur->commit_time;?>" readonly/>
                      </div>
                    </div>

                    <!-- nama penerima -->
                    <div class="form-group">
                      <label for="penerima" class="col-sm-2 control-label">PENERIMAAN</label>
                      <div class="col-sm-3">
                        <input class="form-control" name="penerima" type="text" value="<?php $data1 = $faktur->penerimaan;
                              if($data1 == 'kosong'){
                                $data4 = 'kosong';
                              }else{
                                $data2 = explode(",",$data1);
                                $data3 = array();
                                  foreach($data2 as $d2){
                                    array_push($data3,getNamaKaryawan($d2));
                                  }
                                $data4 = implode("  /  ",$data3);
                              }
                        //output
                        echo $data4;?>" readonly />
                      </div>
                    </div>

                    <?php 
                      foreach($produk_pesanan as $pp){
                        $produkproduksi = strtoupper($pp->produk);
                    ?>
                      <hr>
                      <h5 id="title" data-kode="<?= $pp->kode; ?>" class="text-success bg-success" style="font-family: Nunito; padding: 5px; border-radius: 5px;"><span class="text-black"><b>Produk Pesanan:</b></span> <b> <?= $produkproduksi; ?></b></h5>
                      <!-- rak barang -->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">RACK BIASA</label>
                        <div class="col-sm-3">
                          <select name="no_rak2" class="form-control" id="jenis_rak2">
                            <optgroup label="No Rak">
                              <option value="-">---</option>
                              <!-- rak biasa -->
                              <?php for($i=1; $i<=62; $i++){
                                echo "<option value='R".$i."'>R".$i."</option>";
                              } ?>
                            </optgroup>
                          </select>
                        </div>
                        <label class="col-sm-3 control-label">RACK BANNER</label>
                        <div class="col-sm-4">
                          <select name="no_rak1" class="form-control" id="jenis_rak1">
                            <optgroup label="No Rak">
                              <option value="-">---</option>
                              <!-- rak banner -->
                              <?php for($i=1; $i<=4; $i++){
                                echo "<option value='RB".$i."'>RB".$i."</option>";
                              } ?>
                            </optgroup>
                          </select>
                        </div>
                      </div>

                      <!-- input pengerjaan -->
                      <div class="form-group">
                        <label for="pengerjaan" class="col-sm-2 control-label">PENGERJAAN</label>
                        <div class="col-sm-3">
                          <select class="select-form-multiple" style="width: 100%;" name="pengerjaan[]" multiple="multiple" required>
                            <?php 
                              foreach($semuaIDKaryawan as $semuaID){ 
                              $nama_pengerjaan = $semuaID->nama." - ".$semuaID->nama_divisi;
                            ?>
                              <option value="<?= $semuaID->id_karyawan; ?>"><?= $nama_pengerjaan; ?></option>
                            <?php } ?>
                          </select>
                        </div>

                        <label class="col-sm-3 control-label">RACK TOKPED/SHOPEE</label>
                        <div class="col-sm-4">
                          <div class="checkbox">
                              <label>
                                <input id="marketplace" name="marketplace" value="TOKPED/SHOPEE" type="checkbox"> Pilih Rack
                              </label>
                          </div>
                        </div>
                      </div>
                    <?php } ?>

                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-4">
                          <a role="button" class="btn btn-primary" href="<?= base_url('bj');?>">Batal</a>
                          <button id="simpanbarang" type="submit" class="btn btn-danger">Simpan Rak</button>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-footer -->
              <!-- </form> -->
              </div>
            </div>
          </div>
        <?php  } ?>

        <!-- selesai -->
        <?php if(!empty($faktur) && $faktur->faktur_status == 'Belum Diambil'){ ?>
                    <div class="row">
            <div class="col-xs-12 col-md-12">
              <!-- kontent here-->
              <form class="form-horizontal" action="<?php echo site_url('bj/home/update_barcode');?>" method="post">
                  <div class="box-body">
                    <!-- data Transaksi -->

                    <!-- no invoice -->
                    <div class="form-group">
                      <label for="no_invoice" class="col-sm-2 control-label">TRANSAKSI</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input class="form-control" name="no_invoice" type="text" value="<?php echo $faktur->no_invoice;?>" readonly/>
                      </div>

                      <label for="no_rak" class="col-sm-2 control-label">NO. RACK</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input class="form-control" name="no_rak" type="text" value="<?php echo $faktur->faktur_rak;?>" readonly/>
                      </div>

                      <label for="design_edit" class="col-sm-2 control-label">EDIT</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input class="form-control" name="design_edit" type="text" value="<?php echo $faktur->design_edit;?>" readonly/>
                      </div>
                    </div>

                    <!-- nama penerima -->
                    <div class="form-group">
                      <label for="penerima" class="col-sm-2 control-label">PENERIMAAN</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input class="form-control" name="penerima" type="text" value="<?php $data1 = $faktur->penerimaan;
                              if($data1 == 'kosong'){
                                $data4 = 'kosong';
                              }else{
                                $data2 = explode(",",$data1);
                                $data3 = array();
                                  foreach($data2 as $d2){
                                    array_push($data3,getNamaKaryawan($d2));
                                  }
                                $data4 = implode("  /  ",$data3);
                              }
                        //output
                        echo $data4;?>" readonly />
                      </div>

                      <label for="pengerjaan" class="col-sm-2 control-label">PENGERJAAN</label>
                      <div class="col-sm-6" style="margin-left: -1.5em;">
                        <input class="form-control" name="pengerjaan" type="text" value="<?php $data5 = $faktur->pengerjaan;
                              if($data5 == 'kosong'){
                                $data8 = 'kosong';
                              }else{
                                $data6 = explode(",",$data5);
                                $data7 = array();
                                  foreach($data6 as $d1){
                                    array_push($data7,getNamaKaryawan($d1));
                                  }
                                $data8 = implode("  /  ",$data7);
                              }
                        //output
                        echo $data8;?>" readonly />
                      </div>
                    </div>

                    <!-- status -->
                    <div class="form-group">
                      <label for="status_barang" class="col-sm-2 control-label">STATUS</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input class="form-control" type="text" name="status_barang" value="<?php echo $faktur->faktur_status; ?>" readonly />
                      </div>

                      <label for="barcode_barang" class="col-sm-2 control-label">BARCODE</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input type="text" name="barcode_barang" class="form-control" placeholder="Kode Barcode" autofocus required />
                      </div>
                    </div>
                    
                    <!-- note -->
                    <div class="form-group">
                      <label for="note" class="col-sm-2 control-label">NOTE</label>
                      <div class="col-sm-6" style="margin-left: -1.5em;">
                        <input type="text" name="note" class="form-control" placeholder="Catatan"/>
                      </div>
                    </div>

                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-right">
                    <a role="button" class="btn btn-primary" href="<?= base_url('bj');?>">Batal</a>
                    <button type="submit" class="btn btn-warning">Barang Diambil</button>
                  </div>
                  <!-- /.box-footer -->
              </form>
            </div>
          </div>
        <?php  } ?>

        <!-- sudah diambil -->
        <?php if(!empty($faktur) && $faktur->faktur_status == 'Sudah Diambil'){ ?>
                    <div class="row">
            <div class="col-xs-12 col-md-12">
              <!-- kontent here-->
              <form class="form-horizontal" action="#" method="post">
                  <div class="box-body">
                    <!-- data Transaksi -->

                    <!-- no invoice -->
                    <div class="form-group">
                      <label for="no_invoice" class="col-sm-2 control-label">TRANSAKSI</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input class="form-control" name="no_invoice" type="text" value="<?php echo $faktur->no_invoice;?>" readonly/>
                      </div>

                      <label for="no_rak" class="col-sm-2 control-label">NO. RACK</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input class="form-control" name="no_rak" type="text" value="<?php echo $faktur->faktur_rak;?>" readonly/>
                      </div>

                      <label for="design_edit" class="col-sm-2 control-label">EDIT</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input class="form-control" name="design_edit" type="text" value="<?php echo $faktur->design_edit;?>" readonly/>
                      </div>
                    </div>

                    <!-- nama penerima -->
                    <div class="form-group">
                      <label for="penerima" class="col-sm-2 control-label">PENERIMAAN</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input class="form-control" name="penerima" type="text" value="<?php $data1 = $faktur->penerimaan;
                              if($data1 == 'kosong'){
                                $data4 = 'kosong';
                              }else{
                                $data2 = explode(",",$data1);
                                $data3 = array();
                                  foreach($data2 as $d2){
                                    array_push($data3,getNamaKaryawan($d2));
                                  }
                                $data4 = implode("  /  ",$data3);
                              }
                        //output
                        echo $data4;?>" readonly />
                      </div>

                      <label for="pengerjaan" class="col-sm-2 control-label">PENGERJAAN</label>
                      <div class="col-sm-6" style="margin-left: -1.5em;">
                        <input class="form-control" name="pengerjaan" type="text" value="<?php $data5 = $faktur->pengerjaan;
                              if($data5 == 'kosong'){
                                $data8 = 'kosong';
                              }else{
                                $data6 = explode(",",$data5);
                                $data7 = array();
                                  foreach($data6 as $d1){
                                    array_push($data7,getNamaKaryawan($d1));
                                  }
                                $data8 = implode("  /  ",$data7);
                              }
                        //output
                        echo $data8;?>" readonly />
                      </div>
                    </div>

                    <!-- status -->
                    <div class="form-group">
                      <label for="status_barang" class="col-sm-2 control-label">STATUS</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input class="form-control" type="text" name="status_barang" value="<?php echo $faktur->faktur_status; ?>" readonly />
                      </div>

                      <label for="barcode_barang" class="col-sm-2 control-label">TGL AMBIL</label>
                      <div class="col-sm-2" style="margin-left: -1.5em;">
                        <input type="text" name="barcode_barang" class="form-control" value="<?php echo $faktur->tanggal_ambil;?>" readonly/>
                      </div>
                      </div>
                      
                       
                     <label for="barcode_barang" class="col-sm-2 control-label">OP AMBIL</label>
                      <div class="col-sm-2" style="margin-left: -2.2em;">
                    <input type="text" name="barcode_barang" class="form-control" value="<?php echo $faktur->operator_ambil;?>" readonly/>
                      </div>
                      
                     <div class="form-group">
                    <!-- note -->
                    <div class="form-group">
                      <label for="note" class="col-sm-2 control-label">NOTE</label>
                      <div class="col-sm-6" style="margin-left: -1.5em;">
                        <input type="text" name="note" class="form-control" value="<?php echo $faktur->note;?>" readonly/>
                      </div>
                    </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <a style="font-weight: bold;" role="button" href="<?= base_url('bj');?>"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>  Kembali</a>
                  </div>
                  <!-- /.box-footer -->
              </form>
            </div>
          </div>
        <?php  } ?>

      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <p class="text-danger">*NOTE: Jika menggunakan banyak rak isi kedua kolom rak, tetapi jika hanya pakai 1 rak, kolom rak lain pilih --- saja.</p>
    </div>
</div>

<script type="text/javascript">
window.onload = date_time('date_time');

function date_time(id){
  date = new Date;
  year = date.getFullYear();
  month = date.getMonth();
  months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
  d = date.getDate();
  h = date.getHours();
  if(h<10){
      h = "0"+h;
  }
  m = date.getMinutes();
  if(m<10) {
      m = "0"+m;
  }
  s = date.getSeconds();
  if(s<10){
          s = "0"+s;
  }
  result = d+' '+months[month]+' '+year+' '+h+':'+m+':'+s;
  document.getElementById(id).innerHTML = result;
  setTimeout('date_time("'+id+'");','1000');
  return true;
}

$("#simpanbarang").click(function(){
  console.log('barang tersimpan !');
})
</script>