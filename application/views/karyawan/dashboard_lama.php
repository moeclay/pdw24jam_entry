    <div class="col-md-8 col-xs-12">
      <!--Cari Data Karyawan-->
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <nav class="navbar navbar-default"> 
            <div class="container-fluid"> 
              <div class="navbar-header"> 
                <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#raport_cari_karyawan" aria-expanded="false"> 
                  <span class="sr-only">Toggle navigation</span> 
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                </button>
                <a href="<?php echo site_url('karyawan');?>" class="navbar-brand"><small>Cari Raport Karyawan</small></a>
              </div> 
              <div class="collapse navbar-collapse" id="raport_cari_karyawan">
                <ul class="nav navbar-nav navbar-right">
                  <?php echo form_open("karyawan/home/cari_raport", 'class="navbar-form"'); ?>
                    <div class="form-group">
                        <select name="raport_bulan" class="form-control">
                          <?php
                            $bln = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                            for($i=0; $i<count($bln); $i++){
                          ?>
                          <option value="<?php echo $i+1; ?>"><?php echo $bln[$i];?></option>
                          <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="raport_tahun" class="form-control">
                          <?php
                            for($i=2018; $i<=2050; $i++){
                          ?>
                          <option value="<?php echo $i;?>"><?php echo $i;?></option>
                          <?php }?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-search"></i> <small>Cari Laporan</small></button>
                  <?php echo form_close(); ?>
                   
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>

      <!-- Data Raport Karyawan -->
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
		            <p><span class="fa fa-file-pdf-o"></span> Data Kinerja </p>
                <div class="box-tools pull-right">
                  <button title="Print" type="button" class="btn btn-success btn-xs"  onclick="printData('report_end')"><i class="fa fa-print"> print</i>
                  </button>
                  <button title="Hide" type="button" class="btn btn-danger btn-xs" data-widget="collapse"><i class="fa fa-minus"> </i>
                  </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div id="report_end" class="box-body table-responsive">
              <h4 class="text-center"><span class="fa fa-file-pdf-o"></span> Raport Bulan : <?php echo ambilNamaBulan($bulan)." ".$tahun;?></h4>
              <br>
              <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                  <th class="text-center" style="width: 50px">No</th>
                  <th class="text-center">Data Kinerja</th>
                  <th class="text-center" style="width: 150px">Nilai Data</th>
                </tr>
                <tr>
                  <td class="text-center">1.</td>
                  <td class="text-center">Hari Kerja</td>
                  <td class="text-center"><span class="badge bg-blue"> <?php echo $hari_kerja." hari";?></span></td>
                </tr>
                <tr>
                  <td class="text-center">2.</td>
                  <td class="text-center">Jam Kerja</td>
                  <td class="text-center"><span class="badge bg-blue"> <?php echo $jam_kerja." jam"; ?></span></td>
                </tr>
                <tr>
                  <td class="text-center">3.</td>
                  <td class="text-center">Point Kinerja</td>
                  <td class="text-center"><span class="badge bg-blue"> <?php echo $point_kinerja." point"; ?></span></td>
                </tr>
                <tr>
                  <td class="text-center">4.</td>
                  <td class="text-center">Point Edit</td>
                  <td class="text-center"><span class="badge bg-blue"> <?php echo $point_edit." point";?></span></td>
                </tr>
                <tr>
                  <td class="text-center">5.</td>
                  <td class="text-center">Transaksi</td>
                  <td class="text-center"><span class="badge bg-blue"> <?php echo $transaksi." point";?></span></td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box -->
        </div>      
      </div>

      <!-- Data Kalkulasi -->
      <div class="row">
        <div class="col-xs-12 col-md-12">
        <div class="box box-warning">
          <div class="box-header with-border">
            <p><span class="fa fa-file-pdf-o"></span> Data Kalkulasi </p>
                <div class="box-tools pull-right">
                  <button title="Print" type="button" class="btn btn-success btn-xs"  onclick="printData('report_kalkulasi')"><i class="fa fa-print"> print</i>
                  </button>
                  <button title="Hide" type="button" class="btn btn-danger btn-xs" data-widget="collapse"><i class="fa fa-minus"> </i>
                  </button>
                </div>
          </div>

          <div id="report_kalkulasi" class="box-body table-responsive">
            <h4 class="text-center"><span class="fa fa-file-pdf-o"></span> Kalkulasi Bulan : <?php echo ambilNamaBulan($bulan)." ".$tahun;?></h4>
              <br>
              <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                  <th class="text-center" style="width: 50px">No</th>
                  <th class="text-center">Data Kalkulasi</th>
                  <th class="text-center" style="width: 150px">Nilai Kalkulasi</th>
                </tr>
                <tr>
                  <td class="text-center">1.</td>
                  <td class="text-center">Jam/Hari</td>
                  <td class="text-center"><span class="badge bg-yellow"> <?php echo format_2decimal($data_jam_hari)." jam/hari";?></span></td>
                </tr>
                <tr>
                  <td class="text-center">2.</td>
                  <td class="text-center">Point Edit/Hari</td>
                  <td class="text-center"><span class="badge bg-yellow"> <?php echo format_2decimal($data_point_edit_hari)." point";?></span></td>
                </tr>
                <tr>
                  <td class="text-center">3.</td>
                  <td class="text-center">Point Kinerja/Hari</td>
                  <td class="text-center"><span class="badge bg-yellow"> <?php echo format_2decimal($data_point_kinerja_hari)." point";?></span></td>
                </tr>
                <tr>
                  <td class="text-center">4.</td>
                  <td class="text-center">Point Transaksi/Hari</td>
                  <td class="text-center"><span class="badge bg-yellow"> <?php echo format_2decimal($data_point_transaksi_hari)." point";?></span></td>
                </tr>
                <tr>
                  <td class="text-center">5.</td>
                  <td class="text-center">Jumlah Trasaksi &amp; Kinerja/Hari</td>
                  <td class="text-center"><span class="badge bg-yellow"> <?php echo format_2decimal($data_transaksi_kinerja_hari)." point";?></span></td>
                </tr>
                </tbody>
              </table>
          </div>
        </div>
        </div>
      </div>

      <!-- Data Ranking -->
      <div class="row">
        <div class="col-xs-12 col-md-12">
        <div class="box box-danger">
          <div class="box-header with-border">
            <p><span class="fa fa-file-pdf-o"></span> Data Ranking </p>
                <div class="box-tools pull-right">
                  <button title="Print" type="button" class="btn btn-success btn-xs"  onclick="printData('report_ranking')"><i class="fa fa-print"> print</i>
                  </button>
                  <button title="Hide" type="button" class="btn btn-danger btn-xs" data-widget="collapse"><i class="fa fa-minus"> </i>
                  </button>
                </div>
          </div>

          <div id="report_ranking" class="box-body table-responsive">
            <h4 class="text-center"><span class="fa fa-file-pdf-o"></span> Ranking Bulan : <?php echo ambilNamaBulan($bulan)." ".$tahun;?></h4>
              <br>

              <!-- Data Table -->
              <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                  <th class="text-center" style="width: 50px">No</th>
                  <th class="text-center">Data Ranking</th>
                  <th class="text-center" style="width: 150px">Urutan Ranking</th>
                </tr>
                <tr>
                  <td class="text-center">1.</td>
                  <td class="text-center">Nilai Edit</td>
                  <td class="text-center"><span class="badge bg-red"> <?php echo $nilai_e; ?></span></td>
                </tr>
                <tr>
                  <td class="text-center">2.</td>
                  <td class="text-center">Nilai Transaksi</td>
                  <td class="text-center"><span class="badge bg-red"> <?php echo $nilai_t; ?></span></td>
                </tr>
                <tr>
                  <td class="text-center">3.</td>
                  <td class="text-center">Nilai Keseluruhan</td>
                  <td class="text-center"><span class="badge bg-red"><?php echo $nilai_k; ?></span></td>
                </tr>
                <tr>
                  <td class="text-center">4.</td>
                  <td class="text-center">Ranking / Divisi</td>
                  <td class="text-center"><span class="badge bg-red"><?php echo $rank." dari ".$total_karyawan_divisi." orang";?></span></td>
                </tr>
              </tbody></table>
          </div>
        </div>
        </div>
      </div>

      <!-- Data Bonus -->
      <div class="row">
        <div class="col-xs-12 col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <p><span class="fa fa-file-pdf-o"></span> Data Bonus </p>
                <div class="box-tools pull-right">
                  <button title="Print" type="button" class="btn btn-success btn-xs"  onclick="printData('report_bonus')"><i class="fa fa-print"> print</i>
                  </button>
                  <button title="Hide" type="button" class="btn btn-danger btn-xs" data-widget="collapse"><i class="fa fa-minus"> </i>
                  </button>
                </div>
          </div>

          <div id="report_bonus" class="box-body table-responsive">
            <h4 class="text-center"><span class="fa fa-file-pdf-o"></span> Bonus Bulan : <?php echo ambilNamaBulan($bulan)." ".$tahun;?></h4>
              <br>

              <!-- Data Table -->
              <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                  <th class="text-center" style="width: 50px">No</th>
                  <th class="text-center">Data Bonus</th>
                  <th class="text-center" style="width: 150px">Nilai Bonus</th>
                </tr>
                <tr>
                  <td class="text-center">1.</td>
                  <td class="text-center">Tunjangan Edit</td>
                  <td class="text-center"><span title="Turun Dikit" class="badge bg-green"> <?php echo "Rp ".format_uang($tunjangan_edit);?></span></td>
                </tr>
                <tr>
                  <td class="text-center">2.</td>
                  <td class="text-center">Tunjangan Kinerja</td>
                  <td class="text-center"><span title="Turun Dikit" class="badge bg-green"> <?php echo "Rp ".format_uang($tunjangan_kinerja);?></span></td>
                </tr>
                <tr>
                  <td class="text-center">3.</td>
                  <td class="text-center">Bonus Absensi</td>
                  <td class="text-center"><span title="Turun Dikit" class="badge bg-green"><?php echo "Rp ".format_uang($bonus_absen);?></span></td>
                </tr>
                <tr>
                  <td class="text-center">4.</td>
                  <td class="text-center">Bonus Tambahan</td>
                  <td class="text-center"><span title="Turun Dikit" class="badge bg-green"><?php echo "Rp ".format_uang($bonus_tambah);?></span></td>
                </tr>
                <tr>
                  <td class="text-center">5.</td>
                  <td class="text-center">Total Bonus</td>
                  <td class="text-center"><span title="Turun Dikit" class="badge bg-green"><?php echo "Rp ".format_uang($total_bonus);?></span></td>
                </tr>
              </tbody></table>
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
