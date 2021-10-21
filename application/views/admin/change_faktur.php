<div class="row">
  <div class="col-xs-12 col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <!--code here-->
        <h5><i class="fa fa-user"></i> Ubah Status Barang</h5>
        <hr>

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <!-- kontent here-->
            <form class="form-horizontal" action="<?php echo site_url('admin/home/update_record');?>" method="post">
                <div class="box-body">
                  <!-- data faktur -->
                  <div class="form-group">
                    <label for="fkode" class="col-sm-2 control-label">Kode Faktur</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="fkode" type="text" value="<?php echo $sf->faktur_kode;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="faktur_nama" class="col-sm-2 control-label">Nama Pelanggan</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="faktur_nama" type="text" value="<?php echo $sf->faktur_nama;?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="faktur_rak" class="col-sm-2 control-label">Rak Barang</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="faktur_rak" type="text" value="<?php echo $sf->faktur_rak;?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="faktur_status" class="col-sm-2 control-label">Status Barang</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="faktur_status" type="text" value="<?php echo $sf->faktur_status;?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="operator" class="col-sm-2 control-label">Operator Pengambilan</label>

                    <div class="col-sm-10">
                      <script type="text/javascript">
                        $(document).ready(function() { $("#operator").select2(); });
                      </script>
                      <select class="form-control select2" multiple="multiple" data-placeholder="Contoh : Jhon"
                        style="width: 100%;" id="operator" name='operator[]''>
                          <?php foreach($nama_staff as $ns){ ?>
                          <option value="<?php echo $ns->user; ?>"><?php echo $ns->user; ?></option>
                          <?php } ?>
                      </select>

                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right">
                  <a class="btn btn-default" href="javascript: window.history.go(-1)" role="button">Kembali</a>
                  <button type="submit" class="btn btn-danger">Konfirmasi Faktur</button>
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