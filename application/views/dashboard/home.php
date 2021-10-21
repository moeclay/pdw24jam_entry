<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo config_item('web_title'); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href='<?php echo base_url();?>assets/images/favicon.ico' type='image/x-icon' rel='shortcut icon'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
    <style type="text/css">
         li {list-style-type: none;}li a {display: block;color: #000;padding: 8px 16px;text-decoration: none;}li a.active {background-color: #4CAF50;color: white;}li a:hover:not(.active) {background-color: #555;color: white;}
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="<?php echo base_url(); ?>assets/preloader/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>

    <!-- font nunito -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet"> 
    <style>
      body{ font-family: 'Nunito', sans-serif; }
    </style>
</head>
<body class="hold-transition skin-green fixed sidebar-mini">

 <div class="wrapper">
    <!-- loadnavigation -->
    <?php $this->load->view('dashboard/nav_topleft'); ?>
    <!-- end of loadnavigation -->
  
   <div class="content-wrapper">
       
        <!-- alert notif -->
        <?php if($this->session->flashdata('pesan')) { ?>
        <div class="alert alert-danger alert-dismissible" id="notif-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $this->session->flashdata('pesan'); ?>
        </div>
        <br>
        <?php } ?>
    
        <?php if($this->session->flashdata('sukses')) { ?>
        <div class="alert alert-success alert-dismissible" id="notif-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $this->session->flashdata('sukses'); ?>
        </div>
        <?php } ?>

      <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Tahun Grafik Produksi & Prestasi Kinerja -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-warning">
                            <div class="box-header bg-warning">
                                <p><b>TAHUNAN | GRAFIK PRODUKSI</b></p>
                            </div>
                            <div class="box-body">
                                <div class="chart-container">
                                    <p id="tahunan_loading"><strong>sedang memproses...</strong></p>
                                    <canvas id="tahunan" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-warning">
                            <div class="box-header bg-warning">
                                <p><b>PERSENTASI KINERJA</b></p>
                            </div>
                            <div class="box-body">
                                <div class="chart-container">
                                    <p id="ontimevstelat_loading"><strong>sedang memproses...</strong></p>
                                    <canvas id="ontimevstelat" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bulanan Trnasaksi & Total Kinerja Divisi -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-success">
                            <div class="box-header bg-success">
                                <p><i class="fa fa-graph"></i> <b> BULANAN | TRANSAKSI </b></p>
                            </div>
                            <div class="box-body">
                                <!--graphics-->
                                <div class="chart-container">
                                    <p id="myChartBulanan_loading"><strong>sedang memproses...</strong></p>
                                    <canvas id="myChartBulanan" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-success">
                            <div class="box-header bg-success">
                                <p><i class="fa fa-graph"></i> <b> TOTAL KINERJA | DIVISI </b></p>
                            </div>
                            
                            <div class="box-body">
                                <!--graphics-->
                                <div class="chart-container">
                                    <p id="kinerjaDivisi_loading"><strong>sedang memproses...</strong></p>
                                    <canvas id="kinerjaDivisi" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Staff Produksi Tertinggi & Terrendah -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header bg-info">
                                <p><i class="fa fa-graph"></i> <b> STAFF PRODUKSI | TERTINGGI </b></p>
                            </div>
                            <div class="box-body">
                                <!--graphics-->
                                <div class="chart-container">
                                    <p id="limaterbaik_loading"><strong>sedang memproses...</strong></p>
                                    <canvas id="limaterbaik" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-danger">
                            <div class="box-header bg-danger">
                                <p><i class="fa fa-graph"></i> <b> STAFF PRODUKSI | TERENDAH </b></p>
                            </div>
                            <div class="box-body">
                                <!--graphics-->
                                <div class="chart-container">
                                    <p id="limaterburuk_loading"><strong>sedang memproses...</strong></p>
                                    <canvas id="limaterburuk" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </section>
   </div>

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> <?php echo config_item('version_app'); ?>
      </div>
      <strong>Copyright &copy; 2017-<?php echo date('Y');?> <a href="#">Pandawa24Jam</a>.</strong>
  </footer>
  
 </div>
 
<script type="text/javascript">
// call method asyncronus
tahunanGraph();
persentasiKinerja();
bulananGraph();
kinerjaDivisi();
limaterbaik();
limaterburuk();

// total tahunan
async function tahunanGraph() {
    $("#tahunan").hide();

    var xlabel = new Array();
    var xlabel2 = new Array();

    let result1 = await fetch('<?= base_url("admin/graph/year_stat"); ?>');
    let result = await result1.json();
    let resultdata = result.tahunberjalan[0];

    var total = parseInt(resultdata.total_tahun);
    var total_putih = parseInt(resultdata.total_tahun_putih);
    var total_hijau = parseInt(resultdata.total_tahun_hijau);
    var total_kuning = parseInt(resultdata.total_tahun_kuning);
    var total_merah = parseInt(resultdata.total_tahun_merah);
    var total_ungu = parseInt(resultdata.total_tahun_ungu);

    var persentage_putih = (total_putih / total) * 100;
    var persentage_hijau = (total_hijau / total) * 100;
    var persentage_kuning = (total_kuning / total) * 100;
    var persentage_merah = (total_merah / total) * 100;
    var persentage_ungu = (total_ungu / total) * 100;

    // parsing data
    var color = Chart.helpers.color;
    var horizontalBarChartData = {
        labels: ['OnTime', '<10mnt', '<30mnt', '<60mnt', '>60mnt'],
        datasets: [{
            label: 'Persen',
            backgroundColor: [
                '#dddddddd',
                '#25d970dd',
                '#ffc305dd',
                '#ff1b1bdd',
                '#c91bffdd'
            ],
            borderColor: '#000000',
            borderWidth: 0.5,
            data: [
                persentage_putih.toFixed(1),
                persentage_hijau.toFixed(1),
                persentage_kuning.toFixed(1),
                persentage_merah.toFixed(1),
                persentage_ungu.toFixed(1)
            ]
        }]

    };

    const ctx = document.getElementById('tahunan').getContext('2d');
    $("#tahunan_loading").hide();
    $("#tahunan").show();

    const myHorizontalBar = new Chart(ctx, {
        type: 'pie',
        data: horizontalBarChartData,
        options: {
            elements: {
                rectangle: {
                    borderWidth: 1,
                }
            },
            responsive: true,

            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            tooltips: {
                 mode: 'dataset'
            }
        }
    });
}

// persentasi kinerja
async function persentasiKinerja() {
    $("#ontimevstelat").hide();
    var xlabel = new Array();
    var xlabel2 = new Array();

    let result1 = await fetch('<?= base_url("admin/graph/year_stat"); ?>');
    let result = await result1.json();
    let resultdata = result.tahunberjalan[0];

    var total = parseInt(resultdata.total_tahun);
    var total_putih = parseInt(resultdata.total_tahun_putih);
    var total_hijau = parseInt(resultdata.total_tahun_hijau);
    var total_kuning = parseInt(resultdata.total_tahun_kuning);
    var total_merah = parseInt(resultdata.total_tahun_merah);
    var total_ungu = parseInt(resultdata.total_tahun_ungu);

    var persentage_putih = (total_putih / total) * 100;
    var persentage_hijau = (total_hijau / total) * 100;
    var persentage_kuning = (total_kuning / total) * 100;
    var persentage_merah = (total_merah / total) * 100;
    var persentage_ungu = (total_ungu / total) * 100;
    var persentage_telat = (persentage_hijau + persentage_kuning + persentage_merah + persentage_ungu);

    // parsing data
    var color = Chart.helpers.color;
    var horizontalBarChartData = {
        labels: ['ONTIME', 'OFFTIME'],
        datasets: [{
            label: 'Persen',
            backgroundColor: [
                '#dddddddd',
                '#ff1b1bdd'
            ],
            borderColor: '#000000',
            borderWidth: 0.5,
            data: [
                persentage_putih.toFixed(1),
                persentage_telat.toFixed(1)
            ]
        }]

    };

    const ctx = document.getElementById('ontimevstelat').getContext('2d');
    $("#ontimevstelat_loading").hide();
    $("#ontimevstelat").show();
    const myHorizontalBar = new Chart(ctx, {
        type: 'pie',
        data: horizontalBarChartData,
        options: {
            elements: {
                rectangle: {
                    borderWidth: 2,
                }
            },
            responsive: true,

            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            tooltips: {
                 mode: 'dataset'
            }
        }
    });
}

// persentasi bulanan
async function bulananGraph() {
    Object.size = function(obj) {
      var size = 0,
        key;
      for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
      }
      return size;
    };

    // Get the size of an object
    // const myObj = {}
    // var size = Object.size(myObj);

    $("#myChartBulanan").hide();

    let result1 = await fetch('<?= base_url("admin/graph/month_orderfinish"); ?>');
    let result = await result1.json();
    const myObj = result.graphbulan;
    var xlabel = new Array(
        'jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'des'
    );
    var xlabel2 = new Array(
      myObj.jan, myObj.feb, myObj.mar, myObj.apr, myObj.mei, myObj.jun, myObj.jul, myObj.aug, myObj.sep, myObj.oct, myObj.nov, myObj.des  
    );    
    

    // chartjs
    const ctx = document.getElementById('myChartBulanan').getContext('2d');
    $("#myChartBulanan_loading").hide();
    $("#myChartBulanan").show();
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: xlabel,
            datasets: [{
                label: 'Total Transaksi Bulanan',
                data: xlabel2,
                backgroundColor: 'rgb(80, 191, 169)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

// kinerja divisi
async function kinerjaDivisi() {
    $("#kinerjaDivisi").hide();
    var xlabel = new Array();
    var xlabel2 = new Array();

    let result1 = await fetch('<?= base_url("admin/graph/divisi_stat"); ?>');
    let result = await result1.json();
    var panjang = result.kinerjadivisi.length.toString();

    for (var i = 0; i < panjang; i++) {
        if(result.kinerjadivisi[i].nama_divisi == 'Develop'){
            xlabel.push("Digital A3+");    
        }else{
            xlabel.push(result.kinerjadivisi[i].nama_divisi);
        }
        
        xlabel2.push(result.kinerjadivisi[i].total_divisi);
    }
    // chartjs
    const ctx = document.getElementById('kinerjaDivisi').getContext('2d');
    $("#kinerjaDivisi_loading").hide();
    $("#kinerjaDivisi").show();
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: xlabel,
            datasets: [{
                label: 'Kinerja Divisi',
                data: xlabel2,
                backgroundColor: 'rgb(255, 114, 0)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

// limaterbaik
async function limaterbaik() {
    $("#limaterbaik").hide();

    var xlabel = new Array();
    var xlabel2 = new Array();

    let result1 = await fetch('<?= base_url("admin/graph/employee_good"); ?>');
    let result = await result1.json();
    var panjang = result.kinerjadivisi.length.toString();
    for (var i = 0; i < panjang; i++) {
        var divdata = result.kinerjadivisi;
        // error handling if data undefined
        if(divdata){
            var d1 = result.kinerjadivisi[i].nama_divisi;
            xlabel.push(result.kinerjadivisi[i].nama +" ("+d1+")");
            var selisihdata = result.kinerjadivisi[i].selisih;
            xlabel2.push(selisihdata);
        }
    }

    // chartjs
    const ctx = document.getElementById('limaterbaik').getContext('2d');
    $("#limaterbaik_loading").hide();
    $("#limaterbaik").show();
    const myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: xlabel,
            datasets: [{
                label: '5 Tertinggi',
                data: xlabel2,
                backgroundColor: 'rgba(19, 159, 255)',
                borderWidth: 1
            }]
        },
        options: {
            tooltipTemplate: "xxx : yyy",
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

// limaterburuk
async function limaterburuk() {
    $("#limaterburuk").hide();
    var xlabel = new Array();
    var xlabel2 = new Array();

    let result1 = await fetch('<?= base_url("admin/graph/employee_bad"); ?>');
    let result = await result1.json();
    var panjang = result.kinerjadivisi.length.toString();

    for (var i = 0; i < panjang; i++) {
        var divdata = result.kinerjadivisi;
        // error handling if data undefined
        if(divdata){
            var d1 = result.kinerjadivisi[i].nama_divisi;
            xlabel.push(result.kinerjadivisi[i].nama +" ("+d1+")");
            xlabel2.push(result.kinerjadivisi[i].selisih);
        }
    }
    // chartjs
    const ctx = document.getElementById('limaterburuk').getContext('2d');
    $("#limaterburuk_loading").hide();
    $("#limaterburuk").show();

    const myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: xlabel,
            datasets: [{
                label: '5 Terendah',
                data: xlabel2,
                backgroundColor: 'rgb(173, 40, 3)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}
</script> 
</body>
</html>
