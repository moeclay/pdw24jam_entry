    <!-- Data Produksi Terlambat -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="alert alert-warning alert-dismissible text-black" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Ohh Tidak !</strong> &nbsp;&nbsp;&nbsp;&nbsp; Beberapa <strong>DAFTAR PESANAN</strong> tidak diproses dengan benar.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
          <div class="box box-warning">
            <div class="box-header text-center bg-warning">
              <h4 class="box-title text-warning"><b>Daftar Produksi Terlambat</b></h4>
            </div>
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered">
              <tbody>
                  <tr>
                    <th class="col-md-2 col-xs-12 text-center">Tanggal Order</th>
                    <th class="col-md-2 col-xs-12 text-center">No Invoice</th>
                    <th class="col-md-2 col-xs-12 text-center">Operator Sales</th>
                    <th class="col-md-1 col-xs-12 text-center">Status</th>
                    <th class="col-md-2 col-xs-12 text-center" title="Jadwal Tanggal Ambil Konsumen">Commit Time</th>
                    <th class="col-md-3 col-xs-12 text-center">Durasi Pengerjaan</th>
                  </tr>
                  <?php
                    if(isset($data)){
                      for($i=0; $i<sizeof($data); $i++){            
                  ?>
                  <tr>
                    <td class="col-md-2 col-xs-12 text-center"><?php echo $data[$i]->tanggal_input; ?></td>
                    <td class="col-md-2 col-xs-12 text-center"><?php echo $data[$i]->no_invoice; ?></td>
                    <td class="col-md-2 col-xs-12 text-center"><?php echo strtoupper($data[$i]->penerimaan); ?></td>
                    <td class="col-md-1 col-xs-12 text-center">
                      <?php
                          $data_r = strtolower($data[$i]->faktur_status);
                          if($data_r=="diproses"){
                            echo "<p><span class='label label-success'>Diproses</span></p>";
                          }else if($data_r=="belum diambil"){
                            echo "<p><span class='label label-success'>Diproses</span> &nbsp;-&nbsp; <span class='label label-danger'>Siap Diambil</span></p>";
                          }else if($data_r=="sudah diambil"){
                            echo "<p><span class='label label-success'>Diproses</span> &nbsp;-&nbsp; <span class='label label-danger'>Siap Diambil</span> &nbsp;-&nbsp;<span class='label label-primary'>Telah Diambil</span></p>";
                          }
                      ?>
                    </td>
                    <td class="col-md-2 col-xs-12 text-center"><?php echo strtoupper($data[$i]->commit_time); ?></td>
                    <?php
                        if($data[$i]->faktur_status == 'Diproses'){
                            // creates DateTime objects 
                            $datetime1 = date_create($data[$i]->waktu_sekarang);
                            // waktu konsumen commit
                            $datetime2 = date_create($data[$i]->commit_time);
                            
                            // calculates the difference between DateTime objects 
                            $interval = date_diff($datetime1, $datetime2);
                            
                            // printing result in days format 
                            echo "<td class='col-md-3 col-xs-12 text-center text-danger'><b>".$interval->format('- %d hari %h jam %i menit')."</b></td>";
                        }else{
                            echo "<td class='col-md-3 col-xs-12 text-center'><b><i>-</i></b></td>";     
                        }
                        
                    ?>
                  </tr>
              <?php
                }
              }else{
              ?>
                <tr>
                  <td style="text-align: center; color: #f00;" colspan="4"><b>Data tidak ditemukan !</b></td>
                </tr>
              <?php
              }
              ?>
              
              </tbody></table>
            </div>
          </div>
        </div>
    </div>