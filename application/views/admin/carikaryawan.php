      <div class="row">
        <div class="col-xs-12">
          <nav class="navbar navbar-default"> 
            <div class="container-fluid"> 
              <div class="navbar-header"> 
                <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#navbar_karyawan" aria-expanded="false"> 
                  <span class="sr-only">Toggle navigation</span> 
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                </button> 
                <a href="<?php echo site_url();?>admin/karyawan" class="navbar-brand"><small>Daftar Karyawan</small></a> 
              </div> 
              <div class="collapse navbar-collapse" id="navbar_karyawan">
                <ul class="nav navbar-nav">
                  <li><a href="<?php echo site_url();?>admin/karyawan/tambah_karyawan"><i class="fa fa-users"></i> <small>Karyawan Baru</small></a></li> 
                </ul> 
                <ul class="nav navbar-nav navbar-right">

                  <?php echo form_open("admin/karyawan/cari_karyawan", 'class="navbar-form"'); ?>
                    <div class="form-group">
                        <select name="cari_nama" class="form-control">
                          <option value="">Cari Nama Karyawan</option>
                        <?php
                          foreach($karyawan as $k){
                        ?>
                          <option value="<?php echo $k->nama;?>"><?php echo $k->nama;?></option>
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
      <!--box list order-->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
            <div class="box-header text-center">
              <h4 class="box-title text-danger"><b>Hasil Pencarian Karyawan</b></h4>
            </div>
            <div class="box-body table-responsive">
              <!--kode untuk realtime orderan masuk-->
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center"><small>ID.</small></th>
                    <th class="text-center"><small>Nama</small></th>
                    <th class="text-center"><small>Divisi</small></th>
                    <th class="text-center"><small>Toko</small></th>
                    <th class="text-center"><small>Hak Akses</small></th>
                    <th class="text-center"><small>Aksi</small></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center">
                      <td><small><?php echo $user->id_karyawan;?></small></td>
                      <td><small><?php echo $user->nama;?></small></td>
                      <td><small><?php echo get_namadivisi($user->id_divisi);?></small></td>
                      <td><small><?php echo get_namatoko($user->id_toko);?></small></td>
                      <td><small><?php echo $user->stts_login;?></small></td>
                      <td>
                        <small style="font-size: 5px;" class="text-center">
                          <a title="Details" href="<?php echo site_url('admin/karyawan/detail_karyawan/').$user->id_karyawan;?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>
                          <a title="Edit" href="<?php echo site_url('admin/karyawan/ubah_karyawan/').$user->id_karyawan;?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-pencil"></i> </a>
                          <a title="Hapus" href="<?php echo site_url('admin/karyawan/hapus_karyawan/').$user->id_karyawan;?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> </a>
                        </small>
                      </td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>