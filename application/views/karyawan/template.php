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
      <div class="container-fluid">
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
    <div class="container-fluid" style="padding: 0 10px;">
      <br>
      <!-- Content Header (Page header) -->
      <!-- Algoritma untuk Pesan / KEsalahan -->
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
      <div class="modal" id="modal-default">
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
      <!--Cari Data Karyawan-->
      <div class="row">
        <!-- Banner Hai-->
        <div class="well">
          <div class="row">
            <div class="col-xs-12 col-md-12 text-center">
              <h3>Selamat Datang di E-Raport Pandawa24Jam</h3>
              <p>Data Laporan Kinerja Karyawan</p>
            </div>
          </div>
        </div>
      </div>


      <!--Data Karyawan-->
      <div class="row">
        <div class="col-md-4 col-xs-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue">
              <div class="widget-user-image">
                <img style="border: 2px solid #ddd;" class="img-circle" src="<?php echo base_url();?>assets/foto/<?php echo $data->foto; ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h4 class="widget-user-username"><?php echo $data->nama_lengkap;?></h4>
              <h5 class="widget-user-desc"><?php echo $data->jabatan;?></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">

                <li><a href="<?php echo site_url('karyawan');?>"><span class="fa fa-file-pdf-o"></span> &nbsp; Laporan Bulanan </a></li>
                <li><a href="<?php echo site_url('karyawan/home/slipgaji');?>"><span class="fa fa-file-pdf-o"></span> &nbsp; Slip Gaji <span class="label label-danger pull-right"></span></a></li>
                <li><a href="<?php echo site_url('karyawan/home/detail_koperasi');?>"><span class="fa fa-file-pdf-o"></span> &nbsp; Koperasi Karyawan </a></li>
                <li><a href="<?php echo site_url('karyawan/home/data_pribadi');?>"><span class="fa fa-user-secret"></span> &nbsp; Data Pribadi </a></li>
                <li><a href="<?php echo site_url('karyawan/home/grafik');?>"><span class="fa fa-area-chart"></span> &nbsp; Grafik <span class="label label-danger pull-right"></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
        <!-- MAIN KONTENT-->
        <?php $this->load->view($main_page);?>        

      </div>

      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
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
