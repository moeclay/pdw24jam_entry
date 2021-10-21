    <!-- production version, optimized for size and speed -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <div class="col-md-8 col-xs-12" id="app">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <nav class="navbar navbar-default"> 
            <div class="container-fluid"> 
              <div class="navbar-header"> 
                <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#raport_cari_karyawan" aria-expanded="false"> 
                  <span class="sr-only">Toggle navigation</span> 
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                  <span class="icon-bar"></span> 
                </button>
                <a href="<?php echo site_url('karyawan');?>" class="navbar-brand"><small>Cari Raport Karyawan</small></a>
              </div> 
              <div class="collapse navbar-collapse" id="raport_cari_karyawan">
                <ul class="nav navbar-nav navbar-right">
                  <?php echo form_open("karyawan/home/cari_raport", 'class="navbar-form"'); ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="tahun" value="<?= date('Y'); ?>" readonly />
                    </div>
                    <div class="form-group">
                        <select name="raport_bulan" class="form-control" @change="onChange($event)">
                          <?php
                            $numbulan = date('m');
                            $bln = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                            for($i=0; $i<count($bln); $i++){
                              if(($i+1) == intval($numbulan)-1){
                            ?>
                              <option selected value="<?php echo $i+1; ?>"><?php echo $bln[$i];?></option>
                            <?php }else{ ?>
                              <option value="<?php echo $i+1; ?>"><?php echo $bln[$i];?></option>
                            <?php } } ?>
                        </select>
                    </div>
                  <?php echo form_close(); ?>
                   
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>

      <!-- Data Raport Karyawan -->
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
		            <p><span class="fa fa-file-pdf-o"></span> Data Kinerja <?= get_namadivisi($iddivisi); ?></p>
            <!-- /.box-header -->
            <div id="report_end" class="box-body table-responsive">
              <img class="img-responsive" v-bind:src="imgURL" alt=" Report kinerja kosong" />
            </div>
          </div>
          <!-- /.box -->
        </div>      
      </div>

    </div>

    <!-- script for printing -->
    <script>
      var app3 = new Vue({
        el: '#app',
        data: {
          baseurl: '<?= base_url(); ?>',
          tahun: '<?= date("Y"); ?>',
          divisi: '<?= $iddivisi; ?>',
          bulan: '',
          imgfilter: '',
          defaultmonth: '<?= date('m'); ?>',
          imgURL: ''
        },
        mounted(){
          this.buildURL();
          this.urlImage();
          console.log(this.imgURL);
        },
        methods: {
            buildURL: function(){
              this.imgfilter = '2021_09'+'_'+this.divisi+'.png';
            },
            urlImage: function(val){
              if(!val){
                this.imgURL = this.baseurl+'assets/kinerja/'+this.imgfilter;  
              }else{
                this.imgURL = this.baseurl+'assets/kinerja/'+val;
              }
              
            },
            onChange(event) {
              var tmpbulan = event.target.value;
              if(tmpbulan.length == '1'){
                this.bulan = '0'+(tmpbulan);
              }else{
                this.bulan = (tmpbulan);
              }
              // set imagefilter
              this.imgfilter = this.tahun+'_'+this.bulan+'_'+this.divisi+'.png';
              this.urlImage(this.imgfilter)
            }
        }
      })
    </script>
