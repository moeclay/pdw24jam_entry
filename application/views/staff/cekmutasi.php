<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mutasi Bank</title>
    <link href="<?= base_url('resource'); ?>/favicon.ico?v=<?= date('s'); ?>" type='image/x-icon' rel='shortcut icon'>
    <link rel="stylesheet" type="text/css" href="<?= base_url('resource'); ?>/bootstrap-3.3.7/css/bootstrap.min.css?v=<?= date('s'); ?>" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,700;0,800;1,200&display=swap" rel="stylesheet"> 
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script type="text/javascript" src="<?= base_url('resource'); ?>/vue.js?v=<?= date('s'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('resource'); ?>/vue-router.js?v=<?= date('s'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('resource'); ?>/axios.min.js?v=<?= date('s'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('resource'); ?>/moment.js?v=<?= date('s'); ?>"></script>
    <!-- pusher realtime -->
    <script src="https://js.pusher.com/7.0/pusher.min.js?v=<?= date('s'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.3"></script>
  </head>
  <body style="font-family: Nunito; background: #bddfd1;">
    <div class="container-fluid" id="app">
           <div class="row">
                <div class="col-md-12">
                    <h2><b>{{ title }}</b></h2>
                    <p id="subtitle">{{ subtitle }}
                        <span style="margin-left: 50px;">
                            <router-link id="btnstyle" class="btn btn-warning btn-sm" to="/"><i class="fas fa-book"></i> Semua Transaksi</router-link>
                            <router-link id="btnstyle" class="btn btn-primary btn-sm" to="/info"><i class="fas fa-info"></i> Info</router-link>
                        </span>
                    </p>
                </div>
            </div>
            
          <!-- router view halaman -->
		  <router-view></router-view>
    </div>
    
    <template id="homepage">
        <div>
            <div class="row">
                <div class="col-md-12">
                  <table id="example" class="table table-bordered" style="background: #efe; border: 2px dashed #555;">
                    <tbody>
                      <tr style="background: #ddd;">
                        <th style="width: 10px;" class="text-center">ID</th>
                        <th style="width: 10px;" class="text-center">Code</th>
                        <th class="text-center">Account Number</th>
                        <th class="text-center">Account Name</th>
                        <th class="text-center">Jumlah Transfer</th>
                        <th class="text-left">Description</th>
                        <th class="text-center">Total Saldo</th>
                        <th class="text-left">Server Time</th>
                      </tr>
    
                      <tr v-for="mutasi in listmutasi">
                        <td class="text-center">{{ mutasi.data_id }}</td>
                        <td class="text-center">{{ mutasi.service_code.toUpperCase() }}</td>
                        <td class="text-center">{{ mutasi.account_number }}</td>
                        <td class="text-center">{{ mutasi.account_name }}</td>
                        <td class="text-center">{{ formatRupiah(mutasi.data_amount) }}</td>
                        <td class="text-left">{{ mutasi.data_description }}</td>
                        <td class="text-center">{{ formatRupiah(mutasi.data_balance) }}</td>
                        <td class="text-left">{{ unixDate(mutasi.data_unix_timestamp) }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
    </template>
    
    <template id="infopage">
        <div>
            <div class="row">
                <div class="col-md-4" v-for="bank in listbank">
                    <div class="panel panel-default" style="background: #efe; border: 2px dashed #555;">
                      <div class="panel-heading">{{ bank.service_name }}</div>
                      <div class="panel-body">
                        <p><i class="far fa-dot-circle"></i> A.N Rekening : {{ bank.account_name }}</p>
                        <p><i class="far fa-dot-circle"></i> No Rekening  : {{ bank.account_number }}</p>
                        <p><i class="far fa-dot-circle"></i> Total Saldo  : {{ formatRupiah(bank.balance) }}</p>
                        <p><i class="far fa-dot-circle"></i> Status Bank  : {{ bank.status }}</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <script type="text/javascript" src="<?= base_url('resource'); ?>/script.js?v=<?= date('s'); ?>"></script>
  </body>
</html>
