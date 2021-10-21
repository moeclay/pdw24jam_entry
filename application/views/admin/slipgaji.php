    <!-- production version, optimized for size and speed -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

      <!--box list order-->
      <div class="row" id="app">
        <div class="col-xs-12">
          <div class="box box-danger">
            <div class="box-header">
              <div class="row">
                <div class="col-md-6">
                    <h4 class="box-title text-danger"><b>SlipGaji Karyawan</b></h4>
                </div>
                <div class="col-md-6">
                    <p class="text-right">
                        <button class="btn btn-success btn-sm" @click="tambahSlip"><i class="fa fa-file-pdf-o"></i> Atur SlipGaji</button>
                    </p>
                </div>
              </div>
            </div>
            
            <div class="box-body table-responsive">
              <!--kode untuk realtime orderan masuk-->
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th><small>ID.</small></th>
                    <th><small>ID Karyawan</small></th>
                    <th><small>Nama Karyawan</small></th>
                    <th><small>Kode Slip</small></th>
                    <th><small>Tahun & Bulan</small></th>
                    <th><small>Link Slip</small></th>
                  </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in list_slip">
                      <td>{{ index+1 }}</td>
                      <td>{{ item.idkaryawan }}</td>
                      <td>{{ item.nama_lengkap }}</td>
                      <td>{{ item.kodeslip }}</td>
                      <td>{{ item.tahun_bulan }}</td>
                      <td><a target="_blank" v-bind:href="item.link_slip">{{ item.link_slip }}</a></td>
                    </tr>
                </tbody>
              </table>
            </div>
            
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="slipModal" tabindex="-1" role="dialog" aria-labelledby="slipModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              </div>
              <div class="modal-body">
                <form class="form-horizontal">

                  <div class="form-group">
                    <label for="secureCode" class="col-sm-2 control-label">KodeSlip</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="secureCode" v-model="securecode" readonly />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tahun & Bulan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" v-model="tahun_bulan" placeholder="2021_09">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="penerimaan" class="col-sm-2 control-label">Nama Karyawan</label>
                    <div class="col-sm-10">
                      <select id="idkaryawan" name="cari_nama" class="form-control" @change="onChange($event)">
                        <option value="00" selected disabled>-- Cari Nama Karyawan --</option>
                        <?php
                          foreach($semua_karyawan as $k){
                        ?>
                          <option value="<?php echo $k->id_karyawan;?>"><?php echo $k->nama_lengkap;?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="link_file" class="col-sm-2 control-label">Link File</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="link_file" v-model="link_file" placeholder="http://...">
                    </div>
                  </div>

                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" @click="simpanSlip">Simpan</button>
              </div>
            </div>
          </div>
        </div>

      </div>

    <!-- script for printing -->
    <script>
      var app = new Vue({
        el: '#app',
        data: {
          tahun_bulan: '<?= $tahun_bulan; ?>',
          securecode: '<?= $secure_kode; ?>',
          baseurl: '<?= base_url(); ?>',
          list_slip: [],
          link_file: '',
          idkaryawan: ''
        },
        methods: {
          getSlip: async function(){
            var url_slipgaji = this.baseurl+"admin/karyawan/jsonslipgaji";
            await axios.get(url_slipgaji)
            .then(function (response) {
              app.list_slip = response.data;
            })
            .catch(function (error) {
              console.log(error);
            });
          },
          tambahSlip: function(){
            $("#slipModal").modal({
              backdrop: 'static',
              show: true
            });
          },
          simpanSlip: async function(){
            var idkaryawan = $("#idkaryawan :selected").val();
            var securecode = this.securecode;
            var tahun_bulan = this.tahun_bulan;
            var link_file = this.link_file;
            
            var url_slipgaji = this.baseurl+"admin/karyawan/insertslip?link="+link_file+"&id="+idkaryawan+"&tb="+tahun_bulan+"&sc="+securecode;
            await axios.get(url_slipgaji)
            .then(function (response) {
              alert('berhasil disimpan');
              location.reload();
            })
            .catch(function (error) {
              console.log(error);
            });

          },
          onChange: function(event){
              this.idkaryawan = event.target.value;
              this.link_file = this.baseurl+'assets/slip/'+this.tahun_bulan+'/'+event.target.value+'.pdf';
          }
        },
        mounted(){
          this.getSlip();
        },
      })
    </script>