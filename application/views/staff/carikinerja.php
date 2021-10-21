<div class="row">
      <div class="col-xs-12 col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <!--code here-->
            <h5 style="font-family: Nunito;"><i class="fa fa-laptop"> </i> <b>Form Kinerja</b></h5>
            <hr>
                        
            
            <!-- cek data -->
            <?php if(!empty($kinerjaDB)){?>
            <div class="row">
              <div class="col-xs-12 col-md-12">
                <div class="box-body">
                    
                    <!-- tgl.spk & no.invoice -->
                    <div class="form-group">
                      <label for="tgl_spk" class="col-sm-2 control-label">TGL.SPK</label>
                      <div class="col-sm-4">
                        <input class="form-control" name="tgl_spk" type="text" value="<?php echo $kinerjaDB->tgl_spk;?>" readonly>
                      </div>
                      
                      <label for="no_invoice" class="col-sm-2 control-label">NO.INV</label>
                      <div class="col-sm-4">
                        <input class="form-control" name="no_invoice" type="text" value="<?php echo $kinerjaDB->no_invoice;?>" readonly>
                      </div>
                    </div>
                    <br><br>

                    <!-- op.staff & design edit -->
                    <div class="form-group">
                      <label for="penerima" class="col-sm-2 control-label">OP.STAFF</label>
                      <div class="col-sm-4">
                        <input class="form-control" name="penerima" type="text" value="<?php $data1 = $kinerjaDB->penerimaan;
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
                      <label for="design_edit" class="col-sm-2 control-label">DESIGN EDIT</label>
                      <div class="col-sm-4">
                        <input class="form-control" name="design_edit" type="text" value="<?php echo $kinerjaDB->design_edit; ?> menit" readonly>
                      </div>
                    </div>
                    <br/><br/>

                    <!-- tgl.ambil & divisi produksi -->
                    <div class="form-group">
                      <label for="tgl_ambil" class="col-sm-2 control-label">TGL.AMBIL</label>
                      <div class="col-sm-10">
                        <input style="font-weight: bold; background-color: #c62d2d4a;" class="form-control" name="tgl_ambil" type="text" value="<?php echo $kinerjaDB->commit_time; ?>" readonly>
                      </div>
                   </div>
                   <br><br>


                   <!-- produk_pesanan -->
                   <div class="form-group">
                     <label for="penerima" class="col-sm-2 control-label">Produk Pesanan</label>
                      <div class="col-sm-10">
                        <?php 
                          $listpesanan = array();
                          foreach($produk_pesanan as $pp){
                            array_push($listpesanan, "(".$pp->produk.")");
                          }
                          $pesanan = implode(",  ",$listpesanan);
                        ?>
                        <input style="font-weight: bold; background-color: #c62d2d4a;" class="form-control" name="penerima" type="text" value="<?= $pesanan; ?>" readonly />
                      </div>
                   </div>
                </div>
              </div>
            </div>
            <?php }else{ ?>
              <div class="row">
                <div class="col-xs-12 col-md-12">
                  <h4>Data tidak ditemukan !</h4>
                  <p><small>harap hubungi administrator</small></p>
                </div>
              </div>
            <?php } ?>


        </div>
      </div>
    </div>
  </div>
</div>