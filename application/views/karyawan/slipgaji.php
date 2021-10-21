        <div class="col-md-8 col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <p><span class="fa fa-file-pdf-o"></span> Slip Gaji</p>
            </div>
            <!-- /.box-header -->
            <div id="data_pribadi" class="box-body table-responsive">
              <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th width="10%">No.</th>
                        <th width="20%">Kode Slip</th>
                        <th width="20%">Tahun & Bulan</th>
                        <th width="30%">Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $total_slip = count($list_slip);
                        for($i=0; $i<$total_slip; $i++){
                            $kodeslip = $list_slip[$i]->kodeslip;
                    ?>
                      <tr>
                        <th scope="row"><?= ($i+1); ?></th>
                        <td><?= $kodeslip; ?></td>
                        <td><?= $list_slip[$i]->tahun_bulan; ?></td>
                        <td><a target="_blank" href="<?= site_url('karyawan/home/getslipgaji/').$kodeslip; ?>"><i class="fa fa-download" aria-hidden="true"></i> Lihat Slip</a></td>
                      </tr>
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