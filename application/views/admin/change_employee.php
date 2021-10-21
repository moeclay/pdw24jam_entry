<div class="row">
  <div class="col-xs-12 col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <!--code here-->
        <h5><i class="fa fa-user"></i> Ubah Staff </h5>
        <hr>

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <!-- kontent here-->
            <form class="form-horizontal" action="<?php echo site_url('admin/staff/update_staff');?>" method="post">
                <div class="box-body">
                <input type="hidden" name="id_karyawan" value="<?php echo $ss->id_karyawan; ?>" />

                  <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="nama" value="<?php echo $ss->nama;?>" type="text" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="user" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="user" value="<?php echo $ss->user;?>" type="text" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pass_baru" class="col-sm-2 control-label">Password Baru</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="pass_baru" placeholder="Contoh : 1234" type="password" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pass_baru2" class="col-sm-2 control-label">Konfirmasi Password</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="pass_baru2" placeholder="Contoh : 1234" type="password" required>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right">
                  <a class="btn btn-default" href="javascript: window.history.go(-1)" role="button">Kembali</a>
                  <button type="submit" class="btn btn-warning">Ubah</button>
                </div>
                <!-- /.box-footer -->
              </form>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>

<!-- Validasi Form Input -->
<script type="text/javascript">
$("form input[type=text]").on("change invalid", function() {
    var textfield = $(this).get(0);

    // hapus dulu pesan yang sudah ada
    textfield.setCustomValidity("");
    if (!textfield.validity.valid) {
      textfield.setCustomValidity("Tidak boleh kosong!");  
    }
});
</script>