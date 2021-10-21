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
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?php echo base_url(); ?>assets/preloader/jquery.min.js" type="text/javascript"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo site_url('karyawan');?>" class="navbar-brand"><b><?php echo config_item('web_title'); ?></b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse navbar-right" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('nama_lengkap'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="" data-toggle="modal" data-target="#modal-default"> <span class="fa fa-lock"></span> Ubah Password</a></li>
                <li><a href="<?php echo site_url('user/keluar');?>"><span class="fa fa-sign-out"></span> Keluar</a></li>
              </ul>
            </li>
          </form>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <br>
      <!-- alert pesan-->
      <?php if($this->session->flashdata('pesan')) { ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $this->session->flashdata('pesan'); ?>
        </div>
        <br>
      <?php } ?>
      <!-- alert pesan sukses-->
      <?php if($this->session->flashdata('sukses')) { ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $this->session->flashdata('sukses'); ?>
        </div>
        <br>
      <?php } ?>
      

      <!-- Model Ubah Password -->
      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-lock"></span> Ubah Password</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" action="<?php echo site_url('user/simpan_password');?>" method="post">
                  <div class="box-body">
                    <input type="hidden" name="id_form" value="<?php echo $this->session->userdata('id_user'); ?>" />
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="pass_lama" placeholder="Password Lama">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="password" class="form-control" name="pass_baru" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="password" class="form-control" name="ulangi_pass_baru" placeholder="Ulangi Password">
                      </div>
                    </div>
                  </div>

                  <div class="box-footer text-center">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary pull-right">Ubah</button>
                  </div>
                  <!-- /.box-footer -->

                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>

      <!-- Banner Hai-->
      <div class="well">
        <div class="row">
          <div class="col-xs-12 col-md-12 text-center">
            <h3>Selamat Datang di E-Raport Pandawa24Jam</h3>
            <p>Data Laporan Kinerja Karyawan</p>
          </div>
        </div>
      </div>

      <!--Data Karyawan-->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <!--Cari Data Karyawan-->
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
                    <a href="<?php echo site_url('karyawan');?>" class="navbar-brand"><small>Data Karyawan</small></a>
                  </div> 
                  <div class="collapse navbar-collapse" id="raport_cari_karyawan">
                    <ul class="nav navbar-nav navbar-right">
                      <?php echo form_open("karyawan/home/cari_grafik", 'class="navbar-form"'); ?>
                        <div class="form-group">
                            <select name="grafik_bulan" class="form-control">
                              <?php
                                $bln = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                                for($i=0; $i<count($bln); $i++){
                              ?>
                              <option value="<?php echo $i+1; ?>"><?php echo $bln[$i];?></option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="grafik_tahun" class="form-control">
                              <?php
                                for($i=2018; $i<=2050; $i++){
                              ?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                              <?php }?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-search"></i> <small>Cari Grafik</small></button>
                      <?php echo form_close(); ?>
                       
                    </ul>
                  </div>
                </div>
              </nav>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">

                  <p><span class="fa fa-area-chart"></span> Grafik - <?php echo ambilNamaBulan($bulan)."/".$tahun;?></p>
                  <div class="box-tools pull-right">
                    <button title="Hide" type="button" class="btn btn-danger btn-xs" data-widget="collapse"><i class="fa fa-minus"> </i>
                    </button>
                  </div>
                </div>
            
                <!-- /.box-header -->
                <div id="data_pribadi" class="box-body table-responsive">
                  <h4 class="text-center"><span class="fa fa-area-chart"></span> Grafik <?php echo ambilNamaBulan($bulan)."/".$tahun;?> - <b>Divisi <?php echo get_namadivisi($data->id_divisi);?></b></h4>
                  <br>

                  <!--grafik per divisi-->
                  <script src="<?php echo base_url('grafik_reza/');?>Chart.bundle.js"></script>
                  <script src="<?php echo base_url('grafik_reza/');?>utils.js"></script>            
              
                  <div class="col-xs-12 col-md-12">
                    <div style="width: 100%">
                      <canvas id="myChart"></canvas>
                    </div>
                  </div>

                  <script type="text/javascript">
                    var ctx = document.getElementById("myChart");
                    var barChartData = {
                      labels: [<?php for($i=0; $i<count($grafik); $i++){echo "'".$grafik[$i]['nama']."', "; }?>],

                      datasets: [{
                          label: 'Edit / Hari',
                          backgroundColor: window.chartColors.red,
                          data: [
                            <?php for($i=0; $i<count($grafik); $i++){echo "'".$grafik[$i]['edit_hari']."', "; }?>
                          ]
                      }, {
                          label: 'Trs Point / Hari',
                          backgroundColor: window.chartColors.blue,
                          data: [
                            <?php for($i=0; $i<count($grafik); $i++){echo "'".$grafik[$i]['trs_point_hari']."', "; }?>
                          ]
                      }]

                    };
                    
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: barChartData,
                      options: {
                          scales: {
                              yAxes: [{
                                      ticks: {
                                          beginAtZero: true
                                      }
                                  }]
                          },
                          tooltips: {
                            mode: 'index',
                            intersect: true
                          }
                        }
                      });
                  </script>
                </div>
              </div>
            </div>
          </div>
          

        <!-- script for printing -->
        <script type="text/javascript">
          function printData(el){
            var restorePage  = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorePage; 
          }
        </script>
      </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 18.3.0
      </div>
      <strong>Copyright &copy; 2017-<?php echo date('Y');?> <a href="#">Team Geek</a>.</strong>
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->


<!-- SlimScroll -->
<script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js');?>"></script>
<script src="<?php echo base_url('assets/bower_components/chart.js/Chart.js');?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
</body>
</html>
