<!--data absensi-->
<div class="row">
  <div class="col-xs-12 col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <div class="box box-danger">
              <br/>
              <form class="form-horizontal" action="<?php echo site_url('admin/karyawan/simpan_karyawan');?>" method="post">
                <div class="box-body">
                  <div class="form-group col-xs-12 col-md-12">
                    <input type="hidden" class="form-control" name="id_karyawan" value="<?php echo get_nextidkaryawan();?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="id_kode">Id : 
                    </label>
                    <input type="text" class="form-control" name="id_kode" placeholder="Contoh : 001" autofocus />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="kode">Kode : 
                    </label>
                    <input type="text" class="form-control" name="kode" placeholder="Contoh : 00 001" autofocus />
                  </div>

                  <div class="form-group col-xs-12 col-md-3" style="margin-right: 10px;">
                    <label for="nama_lengkap">Nama Lengkap : 
                    </label>
                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Contoh : Jhonatan" autofocus />
                  </div>

                  <div class="form-group col-xs-12 col-md-3" style="margin-right: 10px;">
                    <label for="nama">Nama Panggilan : 
                    </label>
                    <input type="text" class="form-control" name="nama" placeholder="Contoh : Jhon" autofocus />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="no_ktp">No KTP : 
                    </label>
                    <input type="number" class="form-control" name="no_ktp" placeholder="Contoh : 32011xxxxxxxxxxx" autofocus />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="tempat_lahir">Tempat Lahir : 
                    </label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Contoh : Depok" autofocus />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="tgl_lahir">Tgl Lahir : 
                    </label>
                    <input type="date" class="form-control" name="tgl_lahir"/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="jenis_kelamin">Jenis Kelamin : 
                    </label>
                    <select name="jenis_kelamin" class="form-control">
                      <?php 
                        $jk = array('Laki-laki','Perempuan');
                        for($i=0; $i<count($jk); $i++){
                        ?>
                      <option value="<?php echo $jk[$i];?>">
                        <?php echo $jk[$i]; ?>
                      </option>
                      <?php }?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="telp">No HP : 
                    </label>
                    <input type="number" class="form-control" name="telp" placeholder="Contoh : 08xxxxxxxxxx" autofocus />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="email">Email : 
                    </label>
                    <input type="email" class="form-control" name="email" placeholder="Contoh : jhon@domain.com" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="pendidikan">Pendidikan : 
                    </label>
                    <input type="text" class="form-control" name="pendidikan" placeholder="Contoh : D3 BSI Multimedia" />
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="alamat">Alamat : 
                    </label>
                    <textarea class="form-control" name="alamat" placeholder="" autofocus style="height: 7.5em;"></textarea>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="img_avatar">Foto Avatar : 
                    </label>
                    <select name="img_avatar" class="form-control">
                      <?php 
                        $avatar = array('men01.png','men02.png','men03.png','men04.png',"men05.png",'men06.png','men07.png','men08.png','women01.png','women02.png','women03.png','women04.png','women05.png','women06.png','women07.png','women08.png');
                        for($i=0; $i<count($avatar); $i++){
                        ?>
                      <option value="<?php echo $avatar[$i];?>">
                        <?php echo $avatar[$i]; ?>
                      </option>
                      <?php }?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="toko">Toko : 
                    </label>
                    <select name="toko" class="form-control">
                      <?php foreach($toko as $t) {?>
                      <option value="<?php echo $t->id_toko; ?>">
                        <?php echo $t->nama_toko; ?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="divisi">Divisi : 
                    </label>
                    <select name="divisi" class="form-control">
                      <?php foreach($divisi as $d) {?>
                      <option value="<?php echo $d->id_divisi; ?>">
                        <?php echo $d->nama_divisi; ?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="jabatan">Jabatan : 
                    </label>
                    <input type="text" class="form-control" name="jabatan" placeholder="Contoh : Operator Design" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="tgl_masuk">Tgl Masuk Kerja : 
                    </label>
                    <input type="date" class="form-control" name="tgl_masuk"/>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="gaji_kotor">Gaji Kotor : 
                    </label>
                    <input type="text" class="form-control" name="gaji_kotor" placeholder="Contoh : 0" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="user">User : 
                    </label>
                    <input type="text" class="form-control" name="user" placeholder="Contoh : jhon" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="password">Password : 
                    </label>
                    <input type="password" class="form-control" name="password" placeholder="Contoh : 1234" />
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="stts_login">Status Login : 
                    </label>
                    <select name="stts_login" class="form-control">
                      <?php 
                        $sl = array('admin','staff','bj','mitra','reseller','it','karyawan');
                        for($i=0; $i<count($sl); $i++){
                        ?>
                      <option value="<?php echo $sl[$i];?>">
                        <?php echo $sl[$i]; ?>
                      </option>
                      <?php }?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="stts_kinerja">Status Kinerja : 
                    </label>
                    <select name="stts_kinerja" class="form-control">
                      <?php 
                        $sk = array('Aktif','Nonaktif');
                        for($i=0; $i<count($sk); $i++){
                        ?>
                      <option value="<?php echo $sk[$i];?>">
                        <?php echo $sk[$i]; ?>
                      </option>
                      <?php }?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="status">Status : 
                    </label>
                    <select name="status" class="form-control">
                      <?php 
                        $statuss = array('Aktif','Nonaktif');
                        for($i=0; $i<count($statuss); $i++){
                        ?>
                      <option value="<?php echo $statuss[$i];?>">
                        <?php echo $statuss[$i]; ?>
                      </option>
                      <?php }?>
                    </select>
                  </div>
                </div>


                  <!-- /.box-body -->
                  <div class="box-footer text-center">
                    <button type="submit" class="btn btn-primary">Tambah
                    </button>
                    <button type="reset" class="btn btn-info">Reset
                    </button>
                    <a class="btn btn-warning" href="<?php echo site_url('');?>admin/karyawan" role="button">Kembali
                    </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>