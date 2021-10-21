<style>
.select2-choice { background-color: #00f !important; }
</style>

<div id="app">

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
                        <a style="font-family: Nunito;" href="<?php echo site_url('staff');?>" class="navbar-brand"><small>Cari Faktur</small></a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar_absensi" aria-expanded="false" style="height: 1px;">
                        <ul class="nav navbar-nav navbar-right">
                            <?php echo form_open("staff/home/cari_record", 'class="navbar-form"'); ?>
                            <div class="form-group">
                              <input v-on:keyup.enter="handleCariFaktur" type="text" name="cari_kinerja" class="form-control" id="cari_kinerja" placeholder="Nomer Faktur" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required />
                            </div> 
                            <button id="cari_faktur" type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-search"></i> <small>Cari Faktur</small></button>
                            <?php echo form_close(); ?>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>    

    <div class="row">
      <div class="col-xs-12 col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <!--code here-->
            <h5 style="font-family: Nunito;"><i class="fa fa-laptop"> </i> <b>Form Kinerja</b></h5>
            <hr>
    
            <div class="row">
              <div class="col-xs-12 col-md-12">
                
                <!-- <form class="form-inline" action="<?php echo site_url('staff/home/simpan_kinerja');?>" method="post"> -->
                <div class="form-inline">
                    <div class="box-body">
                        
                        <!-- tgl_spk & no_invoice -->
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="form-group col-md-1">
                                <label for="tgl_spk" class="control-label">TGL.SPK</label>
                            </div>
                            <div class="form-group col-md-5">
                                <input class="form-control" style="width: 100% !important" name="tgl_spk" type="date" v-model="tgl_spk" />
                            </div>
                        
                            <div class="form-group col-sm-1">
                              <label for="no_invoice" class="control-label">NO.INV</label>
                            </div>
                            <div class="form-group col-sm-5">
                                <input class="form-control" style="width: 100% !important" name="no_invoice" type="text" placeholder="Contoh : 54252" onkeypress='return event.charCode >= 48 && event.charCode <= 57' v-model="no_invoice" />
                            </div>
                        </div>

                        <!-- tgl_ambil & desain_edit -->
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="form-group col-sm-1">
                              <label for="design_edit" class="control-label">TGL.AMBIL</label>
                            </div>
                            <div class="form-group col-sm-5">
                                <input id="tgl_commit" class="form-control" style="width: 50% !important" name="tgl_commit" type="date" v-model="tgl_commit" />
                                <!-- <input class="form-control" style="width: 11% !important" name="tgl1" id="tgl1" type="text" placeholder="<?php echo date('d'); ?>" maxlength="2" title="tanggal" required v-model="hari" />&nbsp;<b>/</b>&nbsp;
                                <input class="form-control" style="width: 11% !important" name="tgl2" id="tgl2" type="text" placeholder="<?php echo date('m'); ?>" maxlength="2" title="bulan" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required v-model="bulan" />&nbsp;<b>/</b>&nbsp;
                                <input class="form-control" style="width: 15% !important" name="tgl3" id="tgl3" type="text" v-model="tahun" maxlength="4" title="tahun" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />&nbsp;&nbsp;&nbsp;&nbsp; -->
                                <span style="margin-left:25px;">
                                    <b>Jam </b>&nbsp;
                                    <input class="form-control" style="width: 10% !important" name="jam" id="jam" type="text" placeholder="<?php echo date('H'); ?>" maxlength="2" title="jam" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required v-model="jam" />&nbsp;<b>:</b>&nbsp;
                                    <input class="form-control" style="width: 10% !important" name="menit" id="menit" type="text" placeholder="<?php echo date('i'); ?>" maxlength="2" title="menit" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required  @focusout="handleFocusOut" v-model="menit"/>
                                </span>
                                <p class="help-block" style="color: #f00;"><b>Jam diinput sesuai dengan keterangan spk</b></p>
                            </div>
                            
                            <div class="form-group col-sm-1">
                              <label for="design_edit" class="control-label">DESIGN EDIT</label>
                            </div>
                            <div class="form-group col-sm-5">
                                <input class="form-control" style="width: 100% !important" name="design_edit" type="text" placeholder="Contoh : 5 (menit)" onkeypress='return event.charCode >= 48 && event.charCode <= 57' v-model="desain_edit" />
                            </div>
                        </div>

                        <!-- op_staff -->
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="form-group col-sm-1">
                                <label for="penerimaan" class="control-label">OP.STAFF</label>
                            </div>
                            <div class="form-group col-sm-11">
                                <select id="op_staff" class="select-form-multiple" style="width: 100%;" name="penerimaan[]" multiple="multiple" required>
                                <?php 
                                  foreach($semuaIDKaryawan as $semuaID){
                                  $nama_penerima = $semuaID->nama." - ".$semuaID->nama_divisi;
                                ?>
                                    <option value="<?= $semuaID->id_karyawan; ?>"><?= $nama_penerima; ?></option>
                                <?php } ?>
                                </select>
                           </div>
                        </div>

                        <!-- produk -->
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="form-group col-sm-1">
                                <label for="penerimaan" class="control-label">PRODUK</label>
                            </div>
                            <div class="form-group col-sm-11">
                                <select id="produk" class="select-form-multiple" style="width: 100%;" name="produk[]" multiple="multiple" required>
                                <?php 
                                  foreach($listProduk as $produk){
                                ?>
                                    <option value="<?= $produk->kode; ?>">[<?= $produk->group_produk; ?>] - <?= $produk->produk; ?></option>
                                <?php } ?>
                                </select>
                           </div>
                        </div>
                    </div>
                    
                    <div class="box-footer text-center">
                      <button @click="handleReset" type="reset" class="btn btn-warning">Reset</button>
                      <button @click="handleSubmit" type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </div>
                <!-- </form> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
</div>

<!-- script vuejs -->
<script>
var app = new Vue({
  el: '#app',
  data: {
    base_url: '<?= base_url(); ?>',
    tgl_spk: '<?= date("Y-m-d"); ?>',
    no_invoice: '',
    desain_edit: 0,
    tgl_commit: '',
    jam: '',
    menit: '',
    commit_time: '',
    commit_unixtime: ''
  },
  methods: {
    handleFocusOut: function(){
        var tgl_commit   = $("#tgl_commit").val();
        var jam     = $("#jam").val();
        var menit   = $("#menit").val();

        Pjam1 = Math.round((new Date()).getTime() / 1000);
        
        detik = new Date().getSeconds().toString();
        format_tgljam_input = (tgl_commit+' '+jam+':'+menit+':'+detik);
        Pjam2 = Math.round(new Date(format_tgljam_input) / 1000);

        // set commit time konsumen
        this.commit_time = format_tgljam_input;
        this.commit_unixtime = Pjam2;

        if(Pjam2 < Pjam1){
          swal("Format tanggal/jam salah.");
          this.tgl_commit = '';
          this.jam = '';
          this.menit = '';
          this.commit_time =  '';
          this.commit_unixtime = '';
        }
    },
    handleReset: function(){
        this.no_invoice = '';
        this.tgl_commit = '';
        this.jam = '';
        this.menit = '';
        this.desain_edit = '';
        var $selMulti1 = $("#op_staff").select2();
        $selMulti1.val(null).trigger("change");
        var $selMulti2 = $("#produk").select2();
        $selMulti2.val(null).trigger("change");


    },
    handleSubmit: async function(){
        var op_staff = $("#op_staff").val();
        var produk = $("#produk").val();
        var tgl_spk = this.tgl_spk;
        var no_invoice = this.no_invoice;
        var desain_edit = this.desain_edit;
        var commit_time = this.commit_time;
        var commit_unixtime = this.commit_unixtime;

        if((tgl_spk !== "") && (no_invoice !== "") && (produk !== null) && (op_staff !== null) && (desain_edit !== "")){
            let dataInput = {
                tgl_spk: tgl_spk,
                no_invoice: no_invoice,
                commit_time: commit_time,
                commit_unixtime: commit_unixtime,
                desain_edit: parseInt(desain_edit),
                op_staff: op_staff.join(),
                produk: produk.join()
            };
            
            // post to rest input kasir
            fetch(this.base_url+'api/home/savekasir',{
                method:'POST',
                headers: {
                    "Content-type": "application/json;charset=UTF-8",
                    "api-key": "x-pdw24jam-dgprint-cloud"
                },
                body:JSON.stringify(dataInput)
            })
            .then((res) => res.json())
            .then((json) => {
                let respons = JSON.parse(JSON.stringify(json));
                if(respons.status === 'failed'){
                    swal("Gagal", respons.msg, "error");
                }
                if(respons.status === 'success'){
                    swal("Berhasil", "data telah terinput", "success");
                    this.handleReset();
                }
            });
        }else{
            swal("Periksa kembali data input !");
        }
    },
    handleCariFaktur: function(event){
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("cari_faktur").click();
        }
    }
  },
  mounted(){
    // log started 
  }
});
</script>