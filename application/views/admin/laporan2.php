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
        li {
          list-style-type: none;
        }

        li a {
          display: block;
          color: #000;
          padding: 8px 16px;
          text-decoration: none;
        }

        li a.active {
          background-color: #4CAF50;
          color: white;
        }

        li a:hover:not(.active) {
          background-color: #555;
          color: white;
        }
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
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container-fluid">

        <div class="navbar-header">
          <a href="<?php echo site_url('admin/home');?>" class="navbar-brand"><b>KEY PERFORMANCE INDICATOR</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url('admin/home');?>">Data Kinerja</a></li>
            <li class="dropdown"><a href="<?php echo site_url('admin/laporan');?>">Laporan Data</a></li>
            <li><a href="<?php echo site_url('admin/staff');?>"><span class="fa fa-user"> Data Staff </a></li>
            <li><a href="<?php echo site_url('admin/karyawan');?>"><i class="fa fa-users"></i> Daftar Karyawan</a></li>
            <li class="dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-user"></span> <?php echo $this->session->userdata('nama_lengkap'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <!--<li><a href="<?php echo site_url('user/ubah_password'); ?>"> <span class="fa fa-lock"></span> Ubah Password</a></li>-->
                <li><a href="<?php echo site_url('user/keluar');?>"><span class="fa fa-sign-out"></span> Keluar</a></li>
              </ul>
            </li>
          </ul>
        </div>

      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  <div class="content-wrapper">
    <div class="container-fluid">
      <br>
      <!-- Content Header (Page header) -->
      <!-- Algoritma untuk Pesan / KEsalahan -->
      <!-- alert pesan-->
      <?php if($this->session->flashdata('pesan')) { ?>
        <div class="alert alert-danger alert-dismissible" id="notif-alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $this->session->flashdata('pesan'); ?>Tah
        </div>
        <br>
      <?php } ?>
      <!-- alert pesan sukses-->
      <?php if($this->session->flashdata('sukses')) { ?>
        <div class="alert alert-success alert-dismissible" id="notif-alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $this->session->flashdata('sukses'); ?>
        </div>
      <?php } ?>

        <!-- START OF MAIN CONTENT -->
        <div class="row">
            <!--Data Widget-->
            <div class="col-md-2">
                <div class="box box-danger">
                    <div class="box-header">
                        <p><b><i class="fa fa-bandcamp" aria-hidden="true"></i> MAIN MENU </b></p>
                    </div>
                    <div class="box-body">
                          <li><a class="active" href="<?php echo site_url('admin/laporan');?>"><i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;&nbsp;Dashboard</a></li>
                          <li><a href="<?php echo site_url('admin/laporan/detail');?>"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp;Personal</a></li>
                          <li><a href="<?php echo site_url('admin/laporan/divisi');?>"><i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;&nbsp;Dept/Div</a></li>
                          <li><a href="<?php echo site_url('admin/laporan/bulan');?>"><i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;&nbsp;Bulan</a></li>
                          <!-- <li><a href="<?php echo site_url('admin/laporan/download');?>"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Export</a></li>-->
                    </div>
                </div>
            </div>
            <!-- Detail & Grapkhics -->    
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-success">
                            <div class="box-header">
                                <p><i class="fa fa-graph"></i> <b> HARIAN | TRANSAKSI </b></p>
                            </div>
                            <div class="box-body">
                                <!--graphics-->
                                <div class="chart-container">
                                    <canvas id="myChartHarian" height="100"></canvas>
                                </div>
                                <script type="text/javascript">
                                    hello();
                                    async function hello(){
                                        var xlabel = new Array();
                                        var xlabel2 = new Array();

                                        let result1 = await fetch("http://server.org/koperasi/admin/laporan/kalkulasi");
                                        let result  = await result1.json();
                                        var panjang = result.graphhari.length.toString();
                                        
                                        for(var i=0; i<panjang; i++){
                                            xlabel.push(result.graphhari[i].tanggal_title);
                                            xlabel2.push(result.graphhari[i].total);
                                        }
                                        // chartjs
                                        const ctx = document.getElementById('myChartHarian').getContext('2d');
                                        const myChart = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: xlabel,
                                                datasets: [{
                                                    label: 'Total Transaksi Harian',
                                                    data: xlabel2,
                                                    backgroundColor: 'rgba(19, 159, 255)',
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
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-success">
                            <div class="box-header">
                                <p><i class="fa fa-graph"></i> <b> BULANAN | TRANSAKSI </b></p>
                            </div>
                            <div class="box-body">
                                <!--graphics-->
                                <div class="chart-container">
                                    <canvas id="myChartBulanan" height="100"></canvas>
                                </div>
                                <script>
                                hello1();
                                async function hello1(){
                                    var xlabel = new Array();
                                    var xlabel2 = new Array();

                                    let result1 = await fetch("http://server.org/koperasi/admin/laporan/kalkulasi");
                                    let result  = await result1.json();
                                    var panjang = result.graphbulan.length.toString();
                                    for(var i=0; i<panjang; i++){
                                        xlabel.push(result.graphbulan[i].bulan_title.slice(0, 3));
                                        xlabel2.push(result.graphbulan[i].total);
                                    }


                                    // chartjs
                                    const ctx = document.getElementById('myChartBulanan').getContext('2d');
                                    const myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: xlabel.reverse(),
                                            datasets: [{
                                                label: 'Total Transaksi Bulanan 2019',
                                                data: xlabel2.reverse(),
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
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-danger">
                            <div class="box-header">
                                <p><i class="fa fa-graph"></i> <b> PRODUKSI | 5 TERBAIK </b></p>
                            </div>
                            <div class="box-body">
                                <!--graphics-->
                                <div class="chart-container">
                                    <canvas id="limaterbaik" height="100"></canvas>
                                </div>
                                <script type="text/javascript">
                                    hello4();
                                    async function hello4(){
                                        var xlabel = new Array();
                                    var xlabel2 = new Array();

                                    let result1 = await fetch("http://server.org/koperasi/admin/laporan/kalkulasi");
                                    let result  = await result1.json();
                                    var panjang = result.limaterbaik.length.toString();
                                    for(var i=0; i<panjang; i++){
                                        xlabel.push(result.limaterbaik[i].nama);
                                        var selisihdata = result.limaterbaik[i].selisih;
                                        xlabel2.push(selisihdata);
                                    }


                                    // chartjs
                                    const ctx = document.getElementById('limaterbaik').getContext('2d');
                                    const myChart = new Chart(ctx, {
                                        type: 'horizontalBar',
                                        data: {
                                            labels: xlabel,
                                            datasets: [{
                                                label: '% Kinerja',
                                                data: xlabel2,
                                                backgroundColor: 'rgb(255, 114, 0)',
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-danger">
                            <div class="box-header">
                                <p><i class="fa fa-graph"></i> <b> PRODUKSI | 5 TERBURUK </b></p>
                            </div>
                            <div class="box-body">
                                <!--graphics-->
                                <div class="chart-container">
                                    <canvas id="limaterburuk" height="100"></canvas>
                                </div>
                                <script>
                                hello5();
                                async function hello5(){
                                    var xlabel = new Array();
                                    var xlabel2 = new Array();

                                    let result1 = await fetch("http://server.org/koperasi/admin/laporan/kalkulasi");
                                    let result  = await result1.json();
                                    var panjang = result.limaterburuk.length.toString();
                                    for(var i=0; i<panjang; i++){
                                        xlabel.push(result.limaterburuk[i].nama);
                                        xlabel2.push(result.limaterburuk[i].selisih);
                                    }


                                    // chartjs
                                    const ctx = document.getElementById('limaterburuk').getContext('2d');
                                    const myChart = new Chart(ctx, {
                                        type: 'horizontalBar',
                                        data: {
                                            labels: xlabel,
                                            datasets: [{
                                                label: '% Kinerja',
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
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-warning">
                            <div class="box-header">
                                <p><i class="fa fa-graph"></i> <b> TAHUNAN | GRAFIK PRODUKSI </b></p>
                            </div>
                            <div class="box-body">
                                <div class="chart-container">
                                    <canvas id="tahunan" height="100"></canvas>
                                </div>
                                <script type="text/javascript">
                                    hello2();
                                    async function hello2(){
                                        var xlabel = new Array();
                                        var xlabel2 = new Array();
    
                                        let result1 = await fetch("http://server.org/koperasi/admin/laporan/kalkulasi");
                                        let result  = await result1.json();
                                        
                                        var total       = parseInt(result.tahunberjalan.total_tahun);
                                        var total_putih = parseInt(result.tahunberjalan.total_tahun_putih);
                                        var total_hijau = parseInt(result.tahunberjalan.total_tahun_hijau);
                                        var total_kuning = parseInt(result.tahunberjalan.total_tahun_kuning);
                                        var total_merah = parseInt(result.tahunberjalan.total_tahun_merah);
                                        var total_ungu = parseInt(result.tahunberjalan.total_tahun_ungu);
                                        
                                        var persentage_putih = (total_putih/total)*100;
                                        var persentage_hijau = (total_hijau/total)*100;
                                        var persentage_kuning = (total_kuning/total)*100;
                                        var persentage_merah = (total_merah/total)*100;
                                        var persentage_ungu = (total_ungu/total)*100;
                                        
                                        // parsing data
                                		var color = Chart.helpers.color;
                                		var horizontalBarChartData = {
                                			labels: ['OnTime', '<5mnt', '<10mnt', '<60mnt', '>60mnt'],
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
                                				borderWidth: 1,
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
                                		const myHorizontalBar = new Chart(ctx, {
                                			type: 'pie',
                                			data: horizontalBarChartData,
                                			options: {
                                				elements: {
                                					rectangle: {
                                						borderWidth: 0.5,
                                					}
                                				},
                                				responsive: true,
                                				
                                				scales: {
                                			        xAxes: [{
                                			            ticks: {
                                			                beginAtZero: true
                                			            }
                                			        }]
                                			    }
                                			}
                                		});
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-warning">
                            <div class="box-header">
                                <p><i class="fa fa-graph"></i> <b> TAHUNAN | ONTIME VS TELAT </b></p>
                            </div>
                            <div class="box-body">
                                <div class="chart-container">
                                    <canvas id="ontimevstelat" height="100"></canvas>
                                </div>
                                <script type="text/javascript">
                                    hello3();
                                    async function hello3(){
                                        var xlabel = new Array();
                                        var xlabel2 = new Array();
    
                                        let result1 = await fetch("http://server.org/koperasi/admin/laporan/kalkulasi");
                                        let result  = await result1.json();
                                        
                                        var total       = parseInt(result.tahunberjalan.total_tahun);
                                        var total_putih = parseInt(result.tahunberjalan.total_tahun_putih);
                                        var total_hijau = parseInt(result.tahunberjalan.total_tahun_hijau);
                                        var total_kuning = parseInt(result.tahunberjalan.total_tahun_kuning);
                                        var total_merah = parseInt(result.tahunberjalan.total_tahun_merah);
                                        var total_ungu = parseInt(result.tahunberjalan.total_tahun_ungu);
                                        
                                        var persentage_putih  = (total_putih/total)*100;
                                        var persentage_hijau  = (total_hijau/total)*100;
                                        var persentage_kuning = (total_kuning/total)*100;
                                        var persentage_merah  = (total_merah/total)*100;
                                        var persentage_ungu   = (total_ungu/total)*100;
                                        var persentage_telat  = (persentage_hijau+persentage_kuning+persentage_merah+persentage_ungu);
                                        
                                        // parsing data
                                		var color = Chart.helpers.color;
                                		var horizontalBarChartData = {
                                			labels: ['OnTime', 'Telat'],
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
                                			    }
                                			}
                                		});
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF MAIN CONTENT -->
    </div>
  </div>

  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> <?php echo config_item('version_app'); ?>
      </div>
      <strong>Copyright &copy; 2017-<?php echo date('Y');?> <a href="#">Pandawa24Jam</a>.</strong>
    </div>
    <!-- /.container -->
  </footer>
</div>
</body>
</html>
