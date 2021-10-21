<div class="row">
  <div class="col-xs-12 col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <!--code here-->
        <h5><i class="fa fa-lock fa-fw"></i> Ubah Password</h5>
        <hr>

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <!-- kontent here-->
            <form class="form-horizontal" action="<?php echo site_url('user/simpan_password');?>" method="post">
                <div class="box-body">
                  <input type="hidden" name="id_form" value="<?php echo $this->session->userdata('id_user'); ?>" />
                  <div class="form-group">
                    <label for="pass_lama" class="col-sm-2 control-label">Password Lama</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="pass_lama" placeholder="Password Lama" type="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pass_baru" class="col-sm-2 control-label">Password Baru</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="pass_baru" placeholder="Password Baru" type="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ulangi_pass_baru" class="col-sm-2 control-label">Konfirmasi Password</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="ulangi_pass_baru" placeholder="Konfirmasi Password" type="password">
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right">
                  <button type="reset" class="btn btn-default">Reset</button> 
                  <button type="submit" class="btn btn-info">Kirim</button>
                </div>
                <!-- /.box-footer -->
              </form>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>