<!--data absensi-->
<div class="row">
  <div class="col-xs-12 col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <div class="box box-danger">
              <br/>
              <form class="form-horizontal" action="<?php echo site_url('admin/karyawan/update_karyawan');?>" method="post">
                  <div class="box-body">
                  <input type="hidden" name="img_avatar" value="<?php echo $sk->foto; ?>" />
                  <input type="hidden" name="id_karyawan" value="<?php echo $sk->id_karyawan; ?>" />

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="id_kode">Id : 
                    </label>
                    <input type="text" class="form-control" name="id_kode"  value="<?php echo $sk->id; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="kode">Kode : 
                    </label>
                    <input type="text" class="form-control" name="kode"  value="<?php echo $sk->kode; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-3" style="margin-right: 10px;">
                    <label for="nama_lengkap">Nama Lengkap : 
                    </label>
                    <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $sk->nama_lengkap; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-3" style="margin-right: 10px;">
                    <label for="nama">Nama Panggilan : 
                    </label>
                    <input type="text" class="form-control" name="nama"  value="<?php echo $sk->nama; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="no_ktp">No KTP : 
                    </label>
                    <input type="number" class="form-control" name="no_ktp" value="<?php echo $sk->no_ktp; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="tempat_lahir">Tempat Lahir : 
                    </label>
                    <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $sk->tempat_lahir; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="tgl_lahir">Tgl Lahir : 
                    </label>
                    <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $sk->tgl_lahir; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="jenis_kelamin">Jenis Kelamin : 
                    </label>
                    <select name="jenis_kelamin" class="form-control">
                      <?php 
                        $jk = array('Laki-laki','Perempuan');
                        for($i=0; $i<count($jk); $i++){
                        ?>

                      <?php
                        if($sk->jenis_kelamin == $jk[$i]){
                          echo "<option value=".$jk[$i]." selected>".$jk[$i]."</option>";
                        }else{
                          echo "<option value=".$jk[$i].">".$jk[$i]."</option>";
                        }
                      ?>
                      <?php }?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="telp">No HP : 
                    </label>
                    <input type="number" class="form-control" name="telp"  value="<?php echo $sk->telp; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="email">Email : 
                    </label>
                    <input type="email" class="form-control" name="email"  value="<?php echo $sk->email; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="pendidikan">Pendidikan : 
                    </label>
                    <input type="text" class="form-control" name="pendidikan" value="<?php echo $sk->pendidikan; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="alamat">Alamat : 
                    </label>
                    <textarea class="form-control" name="alamat" placeholder="" autofocus style="height: 7.5em;"><?php echo $sk->alamat; ?></textarea>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="img_avatar">Foto Avatar : 
                    </label>
                    <select name="img_avatar" class="form-control">
                      <?php 
                        $avatar = array('men01.png','men02.png','men03.png','men04.png',"men05.png",'men06.png','men07.png','men08.png','women01.png','women02.png','women03.png','women04.png','women05.png','women06.png','women07.png','women08.png');
                        for($i=0; $i<count($avatar); $i++)
                      {?>

                      <?php
                        if($sk->foto == $avatar[$i]){
                          echo "<option value=".$avatar[$i]." selected>".$avatar[$i]."</option>";
                        }else{
                          echo "<option value=".$avatar[$i].">".$avatar[$i]."</option>";
                        }
                      ?>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="toko">Toko : <span class="label label-danger"><?php echo get_namatoko($sk->id_toko); ?></span>
                    </label>
                    <select name="toko" class="form-control">
                      <?php foreach($toko as $t) {?>
                      <?php
                        if($sk->id_toko == $t->id_toko){
                          echo "<option value=".$t->id_toko." selected>".$t->nama_toko."</option>";
                        }else{
                          echo "<option value=".$t->id_toko.">".$t->nama_toko."</option>";
                        }
                      ?>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="divisi">Divisi : <span class="label label-danger"><?php echo get_namadivisi($sk->id_divisi); ?></span></label>
                    <select name="divisi" class="form-control">
                      <?php foreach($divisi as $d) {?>
                      <?php
                        if($sk->id_divisi == $d->id_divisi){
                          echo "<option value=".$d->id_divisi." selected>".$d->nama_divisi."</option>";
                        }else{
                          echo "<option value=".$d->id_divisi.">".$d->nama_divisi."</option>";
                        }
                      ?>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="jabatan">Jabatan : 
                    </label>
                    <input type="text" class="form-control" name="jabatan"  value="<?php echo $sk->jabatan; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="tgl_masuk">Tgl Masuk Kerja : 
                    </label>
                    <input type="date" class="form-control" name="tgl_masuk" value="<?php echo $sk->masa_kerja; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="gaji_kotor">Gaji Kotor : 
                    </label>
                    <input type="text" class="form-control" name="gaji_kotor" value="<?php echo $sk->gaji_kotor; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="user">User : 
                    </label>
                    <input type="text" class="form-control" name="user"  value="<?php echo $sk->user; ?>" />
                  </div>

                  <div class="form-group col-xs-12 col-md-2" style="margin-right: 10px;">
                    <label for="password">Password : 
                    </label>
                    <input type="password" class="form-control" name="password"/>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="stts_login">Status Login :  <span class="label label-danger"><?php echo $sk->stts_login; ?></span>
                    </label>
                    <select name="stts_login" class="form-control">
                      <?php 
                        $sl = array('admin','staff','bj','mitra','reseller','it','karyawan');
                        for($i=0; $i<count($sl); $i++){
                        ?>

                      <?php
                        if($sk->stts_login == $sl[$i]){
                          echo "<option value=".$sl[$i]." selected>".$sl[$i]."</option>";
                        }else{
                          echo "<option value=".$sl[$i].">".$sl[$i]."</option>";
                        }
                      ?>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="stts_kinerja">Status Kinerja : <span class="label label-danger"><?php echo $sk->stts_kinerja; ?>
                    </label>
                    <select name="stts_kinerja" class="form-control">
                      <?php 
                        $skk = array('aktif','nonaktif');
                        for($i=0; $i<count($skk); $i++){
                        ?>

                      <?php
                        if($sk->stts_kinerja == $skk[$i]){
                          echo "<option value=".$skk[$i]." selected>".$skk[$i]."</option>";
                        }else{
                          echo "<option value=".$skk[$i].">".$skk[$i]."</option>";
                        }
                      ?>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-xs-12 col-md-4" style="margin-right: 10px;">
                    <label for="status">Status : <span class="label label-danger"><?php echo $sk->status; ?>
                    </label>
                    <select name="status" class="form-control">
                      <?php 
                        $statuss = array('aktif','nonaktif');
                        for($i=0; $i<count($statuss); $i++){
                        ?>

                      <?php
                        if($sk->status == $statuss[$i]){
                          echo "<option value=".$statuss[$i]." selected>".$statuss[$i]."</option>";
                        }else{
                          echo "<option value=".$statuss[$i].">".$statuss[$i]."</option>";
                        }
                      ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="box-footer text-center">
                  <button type="submit" class="btn btn-primary">Ubah</button>
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