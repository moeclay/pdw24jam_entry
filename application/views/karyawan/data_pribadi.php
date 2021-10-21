        <div class="col-md-8 col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <p><span class="fa fa-user-secret"></span> Data Pribadi </p>
              <div class="box-tools pull-right">
                  <button title="Cetak" type="button" class="btn btn-success btn-xs" onclick="printData('data_pribadi')"><i class="fa fa-print"> print</i>
                  </button>
                  <button title="Hide" type="button" class="btn btn-danger btn-xs" data-widget="collapse"><i class="fa fa-minus"> </i>
                  </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div id="data_pribadi" class="box-body table-responsive">
              <h4 class="text-center"><span class="fa fa-user-secret"></span> Data Riwayat Karyawan</h4>
              <br>
              <table class="table table-bordered table-striped">
              <tbody>
                <div class="form-group col-xs-12 col-md-3" style="margin-right: 10px;">
                    <label for="id_karyawan">Id Kinerja : 
                    </label>
                    <input type="text" class="form-control" name="id_karyawan"  value="<?php echo $data->id_karyawan; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="id_kode">Id : 
                    </label>
                    <input type="text" class="form-control" name="id_kode"  value="<?php echo $data->id; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="kode">Kode : 
                    </label>
                    <input type="text" class="form-control" name="kode"  value="<?php echo $data->kode; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-6" style="margin-right: 10px;">
                    <label for="nama_lengkap">Nama Lengkap : 
                    </label>
                    <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $data->nama_lengkap; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-5" style="margin-right: 10px;">
                    <label for="nama">Nama Panggilan : 
                    </label>
                    <input type="text" class="form-control" name="nama"  value="<?php echo $data->nama; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-6" style="margin-right: 10px;">
                    <label for="no_ktp">No KTP : 
                    </label>
                    <input type="number" class="form-control" name="no_ktp" value="<?php echo $data->no_ktp; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-5" style="margin-right: 10px;">
                    <label for="jenis_kelamin">Jenis Kelamin : 
                    </label>
                    <input type="text" class="form-control" name="jenis_kelamin" value="<?php echo $data->jenis_kelamin; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-6" style="margin-right: 10px;">
                    <label for="tempat_lahir">Tempat Lahir : 
                    </label>
                    <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $data->tempat_lahir; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-5" style="margin-right: 10px;">
                    <label for="tgl_lahir">Tgl Lahir : 
                    </label>
                    <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $data->tgl_lahir; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-6" style="margin-right: 10px;">
                    <label for="email">Email : 
                    </label>
                    <input type="email" class="form-control" name="email"  value="<?php echo $data->email; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-5" style="margin-right: 10px;">
                    <label for="telp">No HP : 
                    </label>
                    <input type="number" class="form-control" name="telp"  value="<?php echo $data->telp; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-6" style="margin-right: 10px;">
                    <label for="alamat">Alamat : 
                    </label>
                    <textarea class="form-control" name="alamat" placeholder="" autofocus style="height: 7.5em;"disabled><?php echo $data->alamat; ?></textarea>
                  </div>

                  <div class="form-group col-xs-12 col-md-5" style="margin-right: 10px;">
                    <label for="pendidikan">Pendidikan : 
                    </label>
                    <input type="text" class="form-control" name="pendidikan" value="<?php echo $data->pendidikan; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-5" style="margin-right: 10px;">
                    <label for="toko">Toko : </label>
                    <input type="text" class="form-control" name="toko" value="<?php echo get_namatoko($data->id_toko); ?>" disabled />
                  </div>

                  <div class="form-group col-xs-12 col-md-6" style="margin-right: 10px;">
                    <label for="divisi">Divisi : </label>
                    <input type="text" class="form-control" name="divisi" value="<?php echo get_namadivisi($data->id_divisi); ?>" disabled />
                  </div>

                  <div class="form-group col-xs-12 col-md-5" style="margin-right: 10px;">
                    <label for="jabatan">Jabatan : 
                    </label>
                    <input type="text" class="form-control" name="jabatan"  value="<?php echo $data->jabatan; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-6" style="margin-right: 10px;">
                    <label for="tgl_masuk">Tgl Masuk Kerja : 
                    </label>
                    <input type="date" class="form-control" name="tgl_masuk" value="<?php echo $data->masa_kerja; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-5" style="margin-right: 10px;">
                    <label for="tgl_masuk">Lama Kerja : </label>
                    <input type="text" class="form-control" name="tgl_masuk" value="<?php echo cari_masa_kerja($data->masa_kerja); ?>" disabled />
                  </div>

                  <div class="form-group col-xs-12 col-md-3" style="margin-right: 10px;">
                    <label for="stts_login">Status Login :
                    </label>
                    <input type="text" class="form-control" name="stts_login"  value="<?php echo $data->stts_login; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="stts_kinerja">Status Kinerja :
                    </label>
                    <input type="text" class="form-control" name="stts_kinerja"  value="<?php echo $data->stts_kinerja; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="status">Status :
                    </label>
                    <input type="text" class="form-control" name="status"  value="<?php echo $data->status; ?>" disabled/>
                  </div>
              </tbody>
            </table>
            </div>
          </div>
          <!-- /.box -->
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