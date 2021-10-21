<div class="row">
  <div class="col-xs-12 col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <!--code here-->
        <h5><i class="fa fa-user"></i> Tambah Staff </h5>
        <hr>

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <!-- kontent here-->
            <form class="form-horizontal" action="<?php echo site_url('admin/staff/simpan_staff');?>" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="nama" placeholder="Contoh : Andi K" type="text" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="user" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="user" placeholder="Contoh : andi" type="text" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pass" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="pass" placeholder="Contoh : andi123" type="text" required>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right">
                  <button type="reset" class="btn btn-default">Reset</button> 
                  <button type="submit" class="btn btn-info">Tambah</button>
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