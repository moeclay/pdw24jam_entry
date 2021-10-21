    <!--Navigasi Control Staff-->
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
                        <a href="<?php echo site_url('admin/staff')?>" class="navbar-brand">Daftar Staff</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!--Daftar Table Staff-->
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header text-center bg-success">
              <h4 style="font-family: Nunito;" class="box-title"><b>Daftar Staff Entry Data</b></h4>
            </div>
            <div class="box-body table-responsive">
              <!--kode untuk realtime orderan masuk-->
              <table class="table table-striped table-hover" id="mydata">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Password</th>
                    <th class="text-center">Hak Akses</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <!-- data embedd -->
                    <?php foreach($staff as $s){static $i=1;?>
                    <?php
                        if($s->user == "admin"){
                            continue;
                        }else{
                    ?>
                    
                        <tr class="text-center">
                            <td><?php echo $i++;?></td>
                            <td><?php echo $s->nama;?></td>
                            <td><?php echo $s->user;?></td>
                            <td><?php echo $s->pass;?></td>
                            <td><?php echo $s->stts_login;?></td>
                            <td class="text-center">
                              <a style="font-weight: bold;" title="Edit" href="<?php echo site_url('admin/staff/ubah_staff/').$s->id_karyawan;?>"><i class="glyphicon glyphicon-pencil"></i>edit</a>
                              <a style="font-weight: bold;" class="text-danger" title="Hapus" href="<?php echo site_url('admin/staff/hapus_staff/').$s->id_karyawan;?>"><i class="glyphicon glyphicon-trash"></i> hapus</a>
                          </td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
              </table>
            </div>

            <div class="box-footer">

              <!--taro pagination-->
              <div>
                  <?php echo $paginator;?>
              </div>

            </div>

          </div>
        </div>
    </div>