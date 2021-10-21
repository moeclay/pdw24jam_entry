<!--data absensi-->
<div class="row">
  <div class="col-xs-12 col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <div class="box box-danger">
              <br/>
              <form class="form-horizontal" action="#" method="post">
                  <div class="box-body">              
                  <div class="widget-user-image text-center">
                    <img style="border: 2px solid #ddd;" class="img-circle" src="<?php echo base_url();?>assets/foto/<?php echo $sk->foto; ?>" alt="User Avatar">
                  </div>
                  <br/>

                  <div class="form-group col-xs-12 col-md-1" style="margin-right: 10px;">
                    <label for="id_karyawan">Id Kinerja : 
                    </label>
                    <input type="text" class="form-control" name="id_karyawan"  value="<?php echo $sk->id_karyawan; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-1" style="margin-right: 10px;">
                    <label for="id_kode">Id : 
                    </label>
                    <input type="text" class="form-control" name="id_kode"  value="<?php echo $sk->id; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="kode">Kode : 
                    </label>
                    <input type="text" class="form-control" name="kode"  value="<?php echo $sk->kode; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-3" style="margin-right: 10px;">
                    <label for="nama_lengkap">Nama Lengkap : 
                    </label>
                    <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $sk->nama_lengkap; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-3" style="margin-right: 10px;">
                    <label for="nama">Nama Panggilan : 
                    </label>
                    <input type="text" class="form-control" name="nama"  value="<?php echo $sk->nama; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="no_ktp">No KTP : 
                    </label>
                    <input type="number" class="form-control" name="no_ktp" value="<?php echo $sk->no_ktp; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="tempat_lahir">Tempat Lahir : 
                    </label>
                    <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $sk->tempat_lahir; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="tgl_lahir">Tgl Lahir : 
                    </label>
                    <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $sk->tgl_lahir; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="jenis_kelamin">Jenis Kelamin : 
                    </label>
                    <input type="text" class="form-control" name="jenis_kelamin" value="<?php echo $sk->jenis_kelamin; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="telp">No HP : 
                    </label>
                    <input type="number" class="form-control" name="telp"  value="<?php echo $sk->telp; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="email">Email : 
                    </label>
                    <input type="email" class="form-control" name="email"  value="<?php echo $sk->email; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="pendidikan">Pendidikan : 
                    </label>
                    <input type="text" class="form-control" name="pendidikan" value="<?php echo $sk->pendidikan; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="alamat">Alamat : 
                    </label>
                    <textarea class="form-control" name="alamat" placeholder="" autofocus style="height: 7.5em;"disabled><?php echo $sk->alamat; ?></textarea>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="img_avatar">Foto Avatar : 
                    </label>
                    <input type="text" class="form-control" name="foto" value="<?php echo $sk->foto; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="toko">Toko : </label>
                    <input type="text" class="form-control" name="toko" value="<?php echo get_namatoko($sk->id_toko); ?>" disabled />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="divisi">Divisi : </label>
                    <input type="text" class="form-control" name="divisi" value="<?php echo get_namadivisi($sk->id_divisi); ?>" disabled />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="jabatan">Jabatan : 
                    </label>
                    <input type="text" class="form-control" name="jabatan"  value="<?php echo $sk->jabatan; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="tgl_masuk">Tgl Masuk Kerja : 
                    </label>
                    <input type="date" class="form-control" name="tgl_masuk" value="<?php echo $sk->masa_kerja; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="tgl_masuk">Lama Kerja : </label>
                    <input type="text" class="form-control" name="tgl_masuk" value="<?php echo cari_masa_kerja($sk->masa_kerja); ?>" disabled />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="gaji_kotor">Gaji Kotor : 
                    </label>
                    <input type="text" class="form-control" name="gaji_kotor" value="<?php echo $sk->gaji_kotor; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="user">User : 
                    </label>
                    <input type="text" class="form-control" name="user"  value="<?php echo $sk->user; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="stts_login">Status Login :
                    </label>
                    <input type="text" class="form-control" name="stts_login"  value="<?php echo $sk->stts_login; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="stts_kinerja">Status Kinerja :
                    </label>
                    <input type="text" class="form-control" name="stts_kinerja"  value="<?php echo $sk->stts_kinerja; ?>" disabled/>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="status">Status :
                    </label>
                    <input type="text" class="form-control" name="status"  value="<?php echo $sk->status; ?>" disabled/>
                  </div>
                </div>

                <div class="box-footer text-center">
                  <a class="btn btn-warning" href="<?php echo site_url();?>admin/karyawan" role="button">Kembali</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>